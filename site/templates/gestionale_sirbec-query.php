<?php 


/* CAMPI 
- title
- codice_esportato
- codice (resumption token)
- codice_textarea (termin id ricerca)


http://www.oai.servizirl.it/oai/interfaccia.jsp?verb=ListRecords&metadataPrefix=pico&set=AFRLSUP
http://www.oai.servizirl.it/oai/interfaccia.jsp?verb=ListRecords&resumptionToken=null%7Cnull%7CAFRLSUP%7Cpico%7C300%7C2021-11-29T10:39:04Z

*/

$aoifeed = "http://www.oai.servizirl.it/oai/interfaccia.jsp?verb=ListRecords";
if ($page->codice) {
    $aoifeed .= "&resumptionToken=" . str_replace("|", "%7C", $page->codice);
}else{
    $aoifeed .= $page->codice_esportato; // &metadataPrefix=pico&set=AFRLSUP
}


$schedeSirbec = WireArray();

$xmlstr = file_get_contents("$aoifeed");
//$xmlstr = file_get_contents("test-sirbec.xml"); // local
$xml = new SimpleXMLElement($xmlstr);

define('PICO', 'http://purl.org/pico/1.0/');
define('DC', 'http://purl.org/dc/elements/1.1/');
define('DCTERMS', 'http://purl.org/dc/terms/');


$token = $xml->ListRecords->resumptionToken;
echo $token;


foreach ($xml->ListRecords->record as $records) {
    $identifier =  $records->header->identifier;
    $urlFoto = $records->metadata->children(PICO)->record->object; // url foto

    // titolo da esplodere
    $dcTitle = $records->metadata->children(PICO)->record->children(DC)->title;
    $titles = explode(";", $dcTitle);
    $finalTitle = '';
    $nTitles = count($titles);
    $counter = 1;
    foreach ($titles as $key => $value) {
        $explodeTitle = explode("=", $value);
        $finalTitle .= $explodeTitle[1];
        if ($counter >= 1 && $counter < ($nTitles-1)) {
            $finalTitle .= " / ";
        }
        $counter++;
    }
    //echo $finalTitle;

    $description = $records->metadata->children(PICO)->record->children(DCTERMS)->alternative;
    $subject = $records->metadata->children(PICO)->record->children(DC)->subject;
    $collection = $records->metadata->children(PICO)->record->children(DCTERMS)->isPartOf; // extra info

    // url scheda da esplodere
    $isReferenced = $records->metadata->children(PICO)->record->children(DCTERMS)->isReferencedBy; 
    $isReferencedExplode = explode(";", $isReferenced);
    foreach ($isReferencedExplode as $key => $value) {
        if (strstr($value, "URL=")) {
            $urlExplode = explode("=", $value);
            $urlRecord = $urlExplode[1];
        }
    }
}
// die()
/* 
 # guida ####################################################################
 
*/
?>