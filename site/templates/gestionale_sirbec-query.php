<?php 


/* CAMPI 
- title
- codice_esportato
- codice (resumption token)


http://www.oai.servizirl.it/oai/interfaccia.jsp?verb=ListRecords&metadataPrefix=pico&set=AFRLSUP
http://www.oai.servizirl.it/oai/interfaccia.jsp?verb=ListRecords&resumptionToken=null%7Cnull%7CAFRLSUP%7Cpico%7C300%7C2021-11-29T10:39:04Z

&metadataPrefix=pico&set=AFRLSUP

*/




$schedeSirbec = WireArray();

// $xmlSirbec = "http://www.oai.servizirl.it/oai/interfaccia.jsp?verb=ListRecords" . $page->codice_esportato;

// $items = simplexml_load_file("http://www.oai.servizirl.it/oai/interfaccia.jsp?verb=ListRecords&metadataPrefix=pico&set=AFRLSUP");

// $xmlstr = file_get_contents('http://www.oai.servizirl.it/oai/interfaccia.jsp?verb=ListRecords&metadataPrefix=pico&set=AFRLSUP');
$xmlstr = file_get_contents("test-sirbec.xml");
$xml = new SimpleXMLElement($xmlstr);

define('PICO', 'http://purl.org/pico/1.0/');
define('DC', 'http://purl.org/dc/elements/1.1/');
define('DCTERMS', 'http://purl.org/dc/terms/');



foreach ($xml->ListRecords->record as $records) {
    echo $records->header->identifier;
    echo "<br>";
    echo $records->metadata->children(PICO)->record->object; // url foto
    echo "<br>";
    echo $records->metadata->children(PICO)->record->children(DC)->title;
    echo "<br>";
    echo $records->metadata->children(PICO)->record->children(DCTERMS)->alternative;
    echo "<br>";
    echo $records->metadata->children(PICO)->record->children(DC)->subject;
    echo "<br>";
    echo $records->metadata->children(PICO)->record->children(DCTERMS)->isReferencedBy; // url scheda
    echo "<br>";
    echo $records->metadata->children(PICO)->record->children(DCTERMS)->isPartOf; // extra info
    echo "<br>";
    
    echo "<hr>";

}
// die()
/* 
 # guida ####################################################################
 
*/
?>