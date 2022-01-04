<?php 
/** Aggiorna le coordinate delle schede interrogando Google Maps
 * info qui: https://developers.google.com/maps/documentation/geocoding/requests-geocoding?hl=it#json
 *  */

// interrompi l'haversting quando Sirbec non mi da' piu' il resumption token
    if($page->counter->cicli >= 1 && !$page->codice){
        $page->of(false);
        $page->counter->stop = 1;
        $page->save('counter');
    }
// resetta a comando
    if ($page->counter->reset) {
        $page->of(false);
        $page->counter->reset = 0;
        $page->counter->cicli = 0;
        $page->counter->records = 0;
        $page->save('counter');
        $page->codice = ""; // resetta anche resuption token
        $page->save();
    }


if (!$page->counter->stop) {  

    // creata apposita chiave per accedere via cronjob/server (limitata da IP)
    $key = "AIzaSyBp5AHXRIMToCz5wfpK5yjCLxpVUAJUFr0";
    $googleUrl = "https://maps.googleapis.com/maps/api/geocode/";
   
    // cerca le schede
    $schede = $pages->find("template=gestionale_scheda, stato_avanzamento=1112, sync.sirbec=1, sync.geocoding!=1 ");
    if (count($schede)) {
        //echo "schede: " . count($schede);
        foreach ($schede as $scheda) {
            // prendi la localita'
            $indirizzo = '';
            if ($scheda->luogo->localita) {
                $indirizzo .= $scheda->luogo->localita . ", " ; 
            }elseif ($scheda->luogo->comune) {
                $indirizzo .= $scheda->luogo->comune . ", "; 
            }
            if ($indirizzo) {
                $indirizzo .= " SO, Italia";
                $indirizzo = urlencode($indirizzo);

                //star query
                $query = "{$googleUrl}json?address={$indirizzo}&key={$key}";

                //echo $query;

                $f = file_get_contents("$query", false);
                $json = json_decode($f);

                if ($json) {
                    //foreach ($json as $record) {
                        //var_dump($record);
                        
                        $geo = $json->results;

                        $address = $geo->address_components;
                        $lat = $geo->geometry->location->lat;
                        $long = $geo->geometry->location->long;

                        echo "address: $address";
                        echo "<br>lat: $lat - long: $long";
                        
                    //}
                }
            }
        }

    }else{
        echo "nessuna scheda trovata <br>";
    }
}else{
    echo "ricerca interrotta";
}
die()
/* 
 # guida ####################################################################
 
 /* CAMPI ProcessWire
    # gestionale_sirbec-query
    |------------------------------|--------------------------------|
    |           PW field           |          descrizione           |
    |------------------------------|--------------------------------|
    | title                        |                                |
    | codice_esportato             | stringa di inizio ricerca      |
    | sirbec_datasource (page ref) | codice datasource (page->name) |
    | codice                       | resumption token               |
    | codice_textarea              | termini di ricerca             |
    |------------------------------|--------------------------------|
    | counter                      | cicli, records, reset, stop    |
    |------------------------------|--------------------------------|
    
    # gestionale_sirbec-importazione-scheda
    |-------------------|---------------------------------|--------------------------------------|
    |      PW field     |            XML syntax           |               dettagli               |
    |-------------------|---------------------------------|--------------------------------------|
    | title             | dcterms:alternative             |                                      |
    | display_name      | dcterms:spacial  da controllare |                                      |
    | codice            | identifier                      |                                      |
    | descrizione       | dc:subject                      |                                      |
    | immagini          | pico:ojcet                      | campo immagine                       |
    | link              | dcterms:isReferencedBy          |                                      |
    | codice_esportato  | origine DataSource              | sirbec_datasource (F)                |
    | autore            | AUF => AUFN                     |                                      |
    |-------------------|---------------------------------|--------------------------------------|
    | datazione (combo) | DTZ.DTZG; DTS.DTSI; DTS.DTSF;   | secolo, anno, anno_fine              |
    |-------------------|---------------------------------|--------------------------------------|
    | luogo (combo)     | LRC => LRCC; LRCL               | comune, localita                     |
    |-------------------|---------------------------------|--------------------------------------|
    | sync (combo)      | x, x, x, soggetto SGTD          | sirbec, algolia, geocoding, soggetto |
    |                   |                                 |                                      |


    http://www.oai.servizirl.it/oai/interfaccia.jsp?verb=ListRecords&metadataPrefix=pico&set=AFRLSUP
    http://www.oai.servizirl.it/oai/interfaccia.jsp?verb=ListRecords&resumptionToken=null%7Cnull%7CAFRLSUP%7Cpico%7C300%7C2021-11-29T10:39:04Z

*/
?>