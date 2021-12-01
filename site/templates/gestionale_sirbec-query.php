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
// $xmlstr = simplexml_load_file("test-sirbec.xml");


$library = new SimpleXMLElement($xmlstr);

// $schedeSirbec->add($items);

//$sxe = new SimpleXMLElement($items); 

foreach ($library as $records) {


    foreach($records as $record) {
        
        echo $record->header->identifier . "<br>";
        

        $namespaces = $record->metadata->getNamespaces(true);
        // print_r($namespaces);
       
         $pico = $record->metadata->pico;
        // $pico2 = new SimpleXMLElement($pico);
         print_r($pico);

        // var_dump($record->metadata->pico);
        echo $record->metadata->children->pico;
        echo "<br>";


        // $pico->registerXPathNamespace('dc', 'http://purl.org/pico/1.0/');
        // $result = $pico->xpath('//dc:title');
        // foreach ($result as $title)
        //   {
        //   echo $title . "<br>";
        //   }



        // foreach($record->metadata->children($namespaces['dc']) as $child) {
        //   var_dump($child) . "<br>";
        // }

        // // 
        // // $xml = new SimpleXMLElement($r);
        // $xml->registerXPathNamespace('e', 'http://www.webex.com/schemas/2002/06/service/event');

        // foreach($xml->xpath('//e:event') as $event) {
        //     $event->registerXPathNamespace('e', 'http://www.webex.com/schemas/2002/06/service/event');
        //     var_export($event->xpath('//e:sessionKey'));
        // }

        // 

        // echo $record->metadata['dcterms:alternative'] . "<br>";

        /*


$xml = new SimpleXMLElement($r);
$xml->registerXPathNamespace('e', 'http://www.webex.com/schemas/2002/06/service/event');

foreach($xml->xpath('//e:event') as $event) {
    $event->registerXPathNamespace('e', 'http://www.webex.com/schemas/2002/06/service/event');
    var_export($event->xpath('//e:sessionKey'));
}

        */
    }

}
die();

/* 
 # guida ####################################################################
 
*/
?>