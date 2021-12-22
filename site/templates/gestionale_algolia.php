<?php 

/** MOTORE DI SINCRONIZZAZIONE SCHEDE CON ALGOLIA
 * 
 * La pagina crea un file json che viene poi inviato ad Algolia
 * le immagini vanno prima ridotte a dimensione per l'output e poi consegnate ad Algolia
 * 
 * DA FARE: prepare le immagini in un altro script altrimenti mi si fonda il server se deve processare 1000 immagini
 * 
 * Lo script php di algolia e' inserito tramite Composer
*/


// 1 prepara il json
	$jsonName = "algolia.json";
	$filePath = $config->paths->assets . $jsonName;
	$algoliaJson = fopen("$filePath", "w");

	// prepare il contenuto del json, con le schede aventi almento una immagine
	$json = '[';
	$schede = $pages->find("template=gestionale_scheda, limit=20");
	$nSchede = count($schede);
	$n = 1;
	$fotoFinalWidth = 260; // larghezza delle immagini per l'output di algolia (260 e' la variazione creata da lister (tabella) del backend) // da modificare poi con 600px?
	foreach ($schede as $scheda) {
		if (count($scheda->immagini)) {
			
			// immagine 
				// check if there is our variation
				/* PRODUCTION
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
		}
		$json .= ($n < $nSchede) ? ',': ''; 
		$n++;
	}
	$json .= ']';
	fwrite($algoliaJson, $json);
	fclose($algoliaJson);


	// URL 
	$algoliaURL = $config->urls->httpAssets . $jsonName;
	echo $algoliaURL; // controlla che sia tutto OK


// 2. manda tutto ad algolia
/*
	// $client = new \AlgoliaSearch\Client('NK1J7ES7IV', '15310a01b90b40aa75122bf82fec47d9');
	$client = \Algolia\AlgoliaSearch\SearchClient::create('NK1J7ES7IV', '15310a01b90b40aa75122bf82fec47d9');
	$index = $client->initIndex('siamoAlpi');

	$records = json_decode(file_get_contents("$algoliaURL"), true);

	// Batching is done automatically by the API client
	$index->saveObjects($records, ['autoGenerateObjectIDIfNotExist' => true]);

*/
	/*
		$client = \Algolia\AlgoliaSearch\SearchClient::create('NK1J7ES7IV', '15310a01b90b40aa75122bf82fec47d9');
		$index = $client->initIndex('contacts');
		$batch = json_decode(file_get_contents('https://raw.githubusercontent.com/algolia/datasets/master/contacts/contacts.json'), true);
		$index->saveObjects($batch, ['autoGenerateObjectIDIfNotExist' => true]);
	*/
?>