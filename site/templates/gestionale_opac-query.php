<?php 

// ATTENZION - STO SPERIMENTANDO CON BRESCIA
// https://opac.provincia.brescia.it/data/jsonDataApi?type=sh&shelfid=1825

if (!$page->counter->stop) {

    $opacJson = 'https://opac.provincia.brescia.it/data/jsonDataApi?type=sh&shelfid=' . $page->codice;

    $str = file_get_contents('https://opac.provincia.brescia.it/data/jsonDataApi?type=sh&shelfid=1825&page=3&ttl=120');
    //aggiusta string
    //$str = '{"scaffale":'.$str.'}';
    // $str = file_get_contents('https://opac.provincia.brescia.it/data/jshelf/widget/1825/1/');
    // $str = file_get_contents('../test-scaffaleOpac.txt');
    // $str = utf8_encode($str);

/* con CURL mi da' 403 Forbidden error...
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://opac.provincia.brescia.it/data/jsonDataApi?type=sh&shelfid=1825&page=3&ttl=120");
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_exec($ch);
    curl_close($ch);
*/




    echo $ch;
    $json = json_decode($ch, true); 


    //$xmlRecords = count($xml->ListRecords->record);
    // interagisci con questa e salva le informazioni della ricerca 
    // $nCicli = ($page->counter->cicli) ? $page->counter->cicli + 1 : 1;
    // $nRecords = ($page->counter->records) ? $page->counter->records + $xmlRecords : $xmlRecords;

/*    
    $page->of(false);
    $page->counter->records = $nRecords;
    $page->save('counter');

*/
    //echo $opacjo;
    //echo $str."<br>";
    if ($json) {
        echo "json OK";
    }else{
        echo "json non c'e'";
    }
    echo '<pre>' . var_dump($json) . '</pre>';
    // echo '<pre>' . var_dump($json) . '</pre>';

    // termini da inserire nella ricerca
    // $keywords =  trim(str_replace("\n", '|' , $page->codice_textarea));

    if ($nRecords == "ciao") {
        foreach ($json as $record) {

            // 1. inizia ad estrapolare i titoli e descrizioni, per poi cercare i termini di ricerca

            // titolo da esplodere
            $dcTitle = $records->metadata->children(PICO)->record->children(DC)->title;
            $titles = explode(";", $dcTitle);
            $finalTitle = '';
            $nTitles = count($titles);
            $counter = 1;

            //echo $finalTitle;
            
            // 3. cerco i miei termini di ricerca
            if($record->full_author) { 


                // inizio importazione
                    //check if appuntamento is already there
                    $alreadyImported = $pages->findOne("template=gestionale_opac-importazione-scheda, codice=$codice")->title;
                    /*if (!$alreadyImported) {
                        $p = new Page();

                        //define template & parent
                        $p->template = "gestionale_sirbec-importazione-scheda";

                        $p->title = $sanitizer->text($finalTitle);
                        $p->name  = $sanitizer->pageName($p->title, true);
                        $p->parent = $page;

                        $p->display_name = $sanitizer->text($collection);
                        $p->descrizione = $sanitizer->text($subject);
                        $p->link = $sanitizer->url($urlRecord);

                        // codice univoco & codice datasource
                        $p->codice = $sanitizer->text($identifier);
                        $p->codice_esportato = $page->sirbec_datasource->name;

                        // add images
                        $p->save();
                        if(strlen($urlFoto)){
                            $p->immagini->add((string)$urlFoto);
                        } 

                        $p->save();
                        echo 'new page <a href="' . $p->editUrl . '" target="_blank">' . $p->path . '</a><br>';
                    }*/
            } 
        }
    }else{
        echo "no records found";
    }
}else{
    echo "ricerca interrotta";
}
die()
/* 
 # guida ####################################################################
 
 /* CAMPI ProcessWire
    # gestionale_opac-query
    |-----------------|-----------------------------|
    |     PW field    |         descrizione         |
    |-----------------|-----------------------------|
    | title           | titolo                      |
    | codice          | codice dello scaffale       |
    |-----------------|-----------------------------|
    | counter         | cicli, records, reset, stop |
    |-----------------|-----------------------------|
    
    # gestionale_opac-importazione-scheda
    |--------------|----------------------------------|
    |   PW field   |           Json syntax            |
    |--------------|----------------------------------|
    | title        | cover_title                      |
    | display_name | full_author                      |
    | codice       | ID opac, da prendere in opac_url |
    | descrizione  | abstract                         |
    | immagini *   | cover_url                        |
    | link         | opac_url                         |
    |--------------|----------------------------------|
    * note: (non so se ha senso importare la foto, forse basta l URL, comunque non possiamo usare i comperio)

    http://www.oai.servizirl.it/oai/interfaccia.jsp?verb=ListRecords&metadataPrefix=pico&set=AFRLSUP
    http://www.oai.servizirl.it/oai/interfaccia.jsp?verb=ListRecords&resumptionToken=null%7Cnull%7CAFRLSUP%7Cpico%7C300%7C2021-11-29T10:39:04Z

*/
?>