<?php 

/* CAMPI ProcessWire
    # gestionale_sirbec-query
    |------------------|---------------------------|
    |     PW field     |        descrizione        |
    |------------------|---------------------------|
    | title            |                           |
    | codice_esportato | stringa di inizio ricerca |
    | codice           | resumption token          |
    | codice_textarea  | termini di ricerca        |
    |------------------|---------------------------|
    
    # gestionale_sirbec-importazione-scheda
    |--------------|---------------------------------|
    |   PW field   |            XML syntax           |
    |--------------|---------------------------------|
    | title        | dcterms:alternative             |
    | display_name | dcterms:spacial  da controllare |
    | codice       | identifier                      |
    | descrizione  | dc:subject                      |
    | immagini     | pico:ojcet                      |
    | link         | dcterms:isReferencedBy          |
    |--------------|---------------------------------|

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
$page->of(false);
$page->set('codice', $token);
$page->save();


// termini da inserire nella ricerca
$keywords =  trim(str_replace("\n", '|' , $page->codice_textarea));

foreach ($xml->ListRecords->record as $records) {

    // 1. inizia ad estrapolare i titoli e descrizioni, per poi cercare i termini di ricerca

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

    // 2. li inserisco in un WireData in modo da poter fare una ricerca con la function di PW
    $unicaStringa = $finalTitle . " " . $description . " " . $subject; 

    // 3. cerco i miei termini di ricerca
    if(preg_match("($keywords)", $unicaStringa) === 1) { 

        //prelevo tutti gli altri dati
       
            $identifier =  $records->header->identifier;
            $urlFoto = $records->metadata->children(PICO)->record->object; // url foto
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

        // inizio importazione
            //check if appuntamento is already there
            $alreadyImported = $pages->findOne("template=gestionale_sirbec-importazione-scheda, codice=$identifier")->title;
            if (!$alreadyImported) {
                $p = new Page();

                //define template & parent
                $p->template = "gestionale_sirbec-importazione-scheda";

                $p->title = $sanitizer->text($finalTitle);
                $p->name  = $sanitizer->pageName($p->title, true);
                $p->parent = $page;

                $p->display_name = $sanitizer->text($collection);
                $p->descrizione = $sanitizer->text($subject);
                $p->link = $sanitizer->url($urlRecord);

                // codice univoco
                $p->codice = $sanitizer->text($identifier);

                // add images
                $p->save();
                if(strlen($urlFoto)){
                    $p->immagini->add((string)$urlFoto);
                } 

                $p->save();
                echo 'new page <a href="' . $p->editUrl . '" target="_blank">' . $p->path . '</a><br>';
            }
    } 



}
// die()
/* 
 # guida ####################################################################
 
*/
?>