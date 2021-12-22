<?php 

/** MOTORE DI SINCRONIZZAZIONE SCHEDE CON ALGOLIA
 * 
 * La pagina crea un file json che viene poi inviato ad Algolia
 * le immagini vanno prima ridotte a dimensione per l'output e poi consegnate ad Algolia
 * 
 * Le immagini le prepara un altro script, attivato con Cron, in "gestionale_algolia-imageresize.php"
 * 
 * Lo script php di algolia e' inserito tramite Composer
*/


// 1 prepara il json
	$jsonName = "algolia.json";
	$error = false;
	$filePath = $config->paths->assets . $jsonName;
	

	// prepare il contenuto del json, con le schede aventi almento una immagine
	$json = '[';
	$schede = $pages->find("template=gestionale_scheda");
	$nSchede = count($schede);
	$n = 1;
	$nSchedePronte = 0; // schede da immettere nel json
	$fotoFinalWidth = 260; // larghezza delle immagini per l'output di algolia (260 e' la variazione creata da lister (tabella) del backend) // da modificare poi con 600px?
	foreach ($schede as $scheda) {
		if (count($scheda->immagini)) {
			
			// immagine 
				// check if there is our variation
				// PRODUCTION
					/* 
					$optionsVariations = array('width' => $fotoFinalWidth);
					$nVariations = $scheda->immagini->first->getVariations($optionsVariations);
					if ( count($nVariations) === 1) {
						$immagineUrl = $nVariations->first->httpUrl;
					}else{
						$immagineUrl = $scheda->immagini->first->width($fotoFinalWidth)->httpUrl;
					}*/

				// TEMP (liste mi da' 260 per vertical e 260 orizzontali... non penso noi dovremo distinguere tra i due casi. Per ora prendo quello che c'e').
					$nVariations = $scheda->immagini->first->getVariations();
					if ( count($nVariations) >= 1) {
						$immagineUrl = $nVariations->last->httpUrl;
					}else{
						$immagineUrl = $scheda->immagini->first->width($fotoFinalWidth)->httpUrl;
					}

			// tema
				$temi = '';
				$cntTemi = count($scheda->tema);
				$nTemi = 1; 
				if ($cntTemi) {
					foreach ($scheda->tema as $tema) {
						$temi .= '"'.str_replace('"', '\"', $sanitizer->markupToLine($tema->title)).'"';
						$temi .= ($nTemi < $cntTemi) ? ',' : ''; 
						$nTemi++;
					}
				}

			// tags
				$tags = '';
				$cntTags = count($scheda->tags);
				$nTags = 1; 
				if ($cntTags) {
					foreach ($scheda->tags as $tag) {
						$tags .= '"'.str_replace('"', '\"', $sanitizer->markupToLine($tag->title)).'"';
						$tags .= ($nTags < $cntTags) ? ',' : ''; 
						$nTags++;
					}
				}

			// datazione - DA FARE - sirbec dependant

			// luogo - DA FARE - sirbec dependant

			// prepare il json
			$json .= '
			{
				"objectID" : "sa'.$scheda->id.'",
				"titolo": "'.str_replace('"', '\"', $sanitizer->markupToLine($scheda->title)).'",
				"descrizione": "'.str_replace('"', '\"', $sanitizer->markupToLine($scheda->descrizione)).'",
				"immagine": "'.$immagineUrl.'",
				"url": "'.$scheda->httpUrl.'",
				"temi": ['.$temi.'],
				"tags": ['.$tags.']
			}';
			$json .= ($n < $nSchede) ? ',': ''; 
			$nSchedePronte++;
		}
		$n++;
	}
	$json .= ']';

// 2. check if it's all valid. Scrivi il json
	$result = json_decode($json);
	switch (json_last_error()) {
	       case JSON_ERROR_NONE:
	           $error = ''; // JSON is valid // No error has occurred
	           break;
	       case JSON_ERROR_DEPTH:
	           $error = 'The maximum stack depth has been exceeded.';
	           break;
	       case JSON_ERROR_STATE_MISMATCH:
	           $error = 'Invalid or malformed JSON.';
	           break;
	       case JSON_ERROR_CTRL_CHAR:
	           $error = 'Control character error, possibly incorrectly encoded.';
	           break;
	       case JSON_ERROR_SYNTAX:
	           $error = 'Syntax error, malformed JSON.';
	           break;
	       // PHP >= 5.3.3
	       case JSON_ERROR_UTF8:
	           $error = 'Malformed UTF-8 characters, possibly incorrectly encoded.';
	           break;
	       // PHP >= 5.5.0
	       case JSON_ERROR_RECURSION:
	           $error = 'One or more recursive references in the value to be encoded.';
	           break;
	       // PHP >= 5.5.0
	       case JSON_ERROR_INF_OR_NAN:
	           $error = 'One or more NAN or INF values in the value to be encoded.';
	           break;
	       case JSON_ERROR_UNSUPPORTED_TYPE:
	           $error = 'A value of a type that cannot be encoded was given.';
	           break;
	       default:
	           $error = 'Unknown JSON error occured.';
	           break;
	   }
	if (!$error) {
		// URL 
		$algoliaURL = $config->urls->httpAssets . $jsonName;
		echo $algoliaURL; // controlla che sia tutto OK
		$algoliaJson = fopen("$filePath", "w");
		fwrite($algoliaJson, $json);
		fclose($algoliaJson);
	}else{
		echo "ERRORE!: ";
		// /* test / DEBUG -- controlla quello che viene scritto in modo da trovare l'errore */
		// echo $error;
		// $algoliaJson = fopen("$filePath", "w");
		// fwrite($algoliaJson, $json);
		// fclose($algoliaJson);

		$mail = wireMail();
		$mail->sendSingle(true);
		$mail->to('admin@siamoalpi.it'); 
		$mail->subject("Problema con Algolia, pagina: $page->name");
		$mail->body($error);
		$mail->send();
	}


// 3. aggiorna questa pagina
	if (!$error) {
		$page->of(false);
		$page->timestamp = time();
		$page->counter->records = $nSchedePronte;
		$page->save();
	}

// 4. manda tutto ad algolia
	// if ($error == "pippo") {
	if (!$error && !$page->counter->stop) {

	// $client = new \AlgoliaSearch\Client('NK1J7ES7IV', '15310a01b90b40aa75122bf82fec47d9');
	$client = \Algolia\AlgoliaSearch\SearchClient::create('NK1J7ES7IV', '15310a01b90b40aa75122bf82fec47d9');
	$index = $client->initIndex('siamoAlpi');

	$records = json_decode(file_get_contents("$algoliaURL"), true);

	// Batching is done automatically by the API client
	$index->saveObjects($records, ['autoGenerateObjectIDIfNotExist' => true]);


	/*	
	variante che non funziona
		$client = \Algolia\AlgoliaSearch\SearchClient::create('NK1J7ES7IV', '15310a01b90b40aa75122bf82fec47d9');
		$index = $client->initIndex('contacts');
		$batch = json_decode(file_get_contents('https://raw.githubusercontent.com/algolia/datasets/master/contacts/contacts.json'), true);
		$index->saveObjects($batch, ['autoGenerateObjectIDIfNotExist' => true]);
	*/
	}

exit;
?>