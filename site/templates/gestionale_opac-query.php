<?php 


if (!$page->counter->stop) {

    $shelfJson = 'https://biblioteche.provinciasondrio.gov.it/data/jshelf/widget/3043/';

    // CURL esito fallito // soluzione trovata qui https://stackoverflow.com/questions/2548451/php-file-get-contents-behaves-differently-to-browser

    $opts = array('http' =>
        array(
            'method'  => 'GET',
            'user_agent '  => "Mozilla/5.0 (X11; U; Linux x86_64; en-US; rv:1.9.2) Gecko/20100301 Ubuntu/9.10 (karmic) Firefox/3.6",
            'header' => array(
                'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*\/*;q=0.8'
            ), 
        )
    );
    $context  = stream_context_create($opts);
    $f = file_get_contents("$shelfJson", false, $context);
    $json = json_decode($f);

    if ($json) {
        foreach ($json as $record) {


            echo $record->full_author . "<br>";

            // 1. inizia ad estrapolare i titoli e descrizioni, per poi cercare i termini di ricerca

            // titolo da esplodere
/*            $dcTitle = $records->metadata->children(PICO)->record->children(DC)->title;
            $titles = explode(";", $dcTitle);
            $finalTitle = '';
            $nTitles = count($titles);
            $counter = 1;*/

            //echo $finalTitle;
            
            // 3. cerco i miei termini di ricerca
            if($record->full_author == "pizza") { 


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