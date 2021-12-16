<?php 
// composer autoload
//require_once '../../vendor/autoload.php'; // gia' caricato da qualche altra parte

// prepara il json
	$jsonName = "algolia.json";
	$filePath = $config->paths->assets . $jsonName;
	$algoliaJson = fopen("$filePath", "w");

	// prepare il contenuto del json
	$json = '[';
	$schede = $pages->find("template=gestionale_scheda, limit=20");
	$nSchede = count($schede);
	$n = 1;
	foreach ($schede as $scheda) {
		$json .= '
		{
			"objectID" : "sa'.$scheda->id.'",
			"titolo": "'.str_replace('"', '\"', $sanitizer->markupToLine($scheda->title)).'",
			"descrizione": "'.str_replace('"', '\"', $sanitizer->markupToLine($scheda->descrizione)).'",
			"immagine": "'.$scheda->immagini->first->httpUrl.'",
			"url": "'.$scheda->httpUrl.'"
		}';
		$json .= ($n < $nSchede) ? ',': ''; 
		$n++;
	}
	$json .= ']';
	//$website = "vediamo se funziona!\n";
	fwrite($algoliaJson, $json);
	fclose($algoliaJson);


// URL
$algoliaURL = $config->urls->httpAssets . $jsonName;
echo $algoliaURL;




// $client = new \AlgoliaSearch\Client('NK1J7ES7IV', '15310a01b90b40aa75122bf82fec47d9');
$client = \Algolia\AlgoliaSearch\SearchClient::create('NK1J7ES7IV', '15310a01b90b40aa75122bf82fec47d9');
$index = $client->initIndex('siamoAlpi');

$records = json_decode(file_get_contents("$algoliaURL"), true);

// Batching is done automatically by the API client
$index->saveObjects($records, ['autoGenerateObjectIDIfNotExist' => true]);


/*

$client = \Algolia\AlgoliaSearch\SearchClient::create('NK1J7ES7IV', '15310a01b90b40aa75122bf82fec47d9');
$index = $client->initIndex('contacts');
$batch = json_decode(file_get_contents('https://raw.githubusercontent.com/algolia/datasets/master/contacts/contacts.json'), true);
$index->saveObjects($batch, ['autoGenerateObjectIDIfNotExist' => true]);

*/
?>