<?php 
// thanks to //https://processwire.com/talk/topic/11688-copying-pages-or-content-from-one-processwire-instance-to-another/

// il cron job esportazione singoli musei (aka Task in Plesk) - parte alle 1am. 
//I cronjob sono nell'account "museostorianaturale.it" in Plesk (anche se non necessari)

// mentre il cron job per le importazioni e' in obake.pro -  parte alle 1:30am. 

$eventi = WireArray();

$items_msn = simplexml_load_file('https://www.museostorianaturale.it/appuntamenti_xml/');
$items_mus = simplexml_load_file('https://www.museolivigno.it/appuntamenti_xml/');
$items_vfa = simplexml_load_file('https://www.museovalfurva.it/appuntamenti_xml/');
$items_bor = simplexml_load_file('https://www.museocivicobormio.it/appuntamenti_xml/');
$items_vvv = simplexml_load_file('https://www.villaviscontivenosta.it/appuntamenti_xml/');

$eventi->add($items_vvv);
$eventi->add($items_bor);
$eventi->add($items_vfa);
$eventi->add($items_mus);
$eventi->add($items_msn);

foreach ($eventi as $evento) {

    foreach($evento as $item) {
        //check if any xml out is there
        $museoCodice = $sanitizer->pageName($item->codice);
        if ($museoCodice) {
            
            $pageId = $sanitizer->text($item->pageId);
            $codiceUnivoco = $museoCodice.$pageId;

            //check if appuntamento is already there
            $alreadyImported = $pages->findOne("template=appuntamento, codice=$codiceUnivoco")->title;
            if (!$alreadyImported) {
                    
                $p = new Page();

                //define template & parent
                $p->template = "appuntamento";

                $p->title = $sanitizer->text(base64_decode($item->title));
                $p->name  = $sanitizer->pageName($p->title, true);
                $p->parent = $pages->get(1025);

                // ??? while($pages->find('parent='.$p->parent.',name='.$p->name)->count() > 0) $p->name .= '-';

                $p->codice = $sanitizer->pageName($item->codice);
                $p->titleH1 = $sanitizer->text(base64_decode($item->titleH1));
                $p->subtitleH1 = $sanitizer->text(base64_decode($item->subtitleH1));
                $p->evento_start = $sanitizer->date($item->evento_start);
                $p->evento_end = $sanitizer->date($item->evento_end);
                $p->museo_URL = $sanitizer->httpUrl($item->url);

                // codice univoco
                $p->codice = $codiceUnivoco;

                // add images
                $p->save();
                if(strlen($item->images)){
                    $p->images->add((string)$item->images);
                } 

                $p->save();
                echo 'new page <a href="' . $p->editUrl . '" target="_blank">' . $p->path . '</a><br>';
            }else{
                echo $alreadyImported.'<br>';
            }
        }
    }

}
die();

/* 
 # guida ####################################################################
 
Di seguito alcune considerazioni tecniche per importare gli eventi/appuntamenti dei siti SMV "non-ProcessWire", un piccola guida da inoltrare a chi gestisce gli altri siti.

Il museo dovrebbe esportare gli eventi in formato XML, un linguaggio molto standard, con alcune semplice caratteristiche.

Se prendiamo in riferimento il sito di Livigno, che attualmente ha quattro eventi in corso, la pagina coi cui interagire è questa:
https://www.museolivigno.it/appuntamenti_xml/

Il campo <pages> raccoglie tutti gli eventi, definiti in <page>, in questo modo:

<pages>
   <page></pages>
   <page></pages>
   <page></pages>
</pages>

Poi nello specifico ogni <page> ha i seguenti valori da impostare:

<museo></museo>
<codice></codice>
<pageId></pageId>
<title></title>
<titleH1><titleH1/>
<subtitleH1><subtitleH1/>
<evento_start>1625090400</evento_start>
<evento_end>1630792800</evento_end>
<images>
</images>
<url>
</url>


Ogni valore è così impostato:

1. <museo>

Il nome del museo, codificato con base64_encode
Campo obbligatorio.

2. <codice>

Il codice di tre caratteri che identifica il museo. Il codice è già stato assegnato per ogni museo. Per esempio, i codice dei musei non ProcessWire sono:

evg = Ecomuseo Valgerola
sas = Museo dei Sanatori Sondalo
fvo = Forte Venini Oga

Campo obbligatorio.

3. <pageId>
Codice identificativo della pagina da importare. Il codice è alfanumerico e liberamente impostabile, ma deve essere univoco. Può contenere solo numeri e lettere ([0-9,a-z]). Questo codice impedisce che la stessa pagina venga importata più volte.
Campo obbligatorio.

4. <title>
Il titolo dell'evento. Codificato con base64_encode
Campo obbligatorio.

5. <titleH1>
Titolo esteso dell'evento, possibilmente con parole chiave. Codificato con base64_encode
Campo facoltativo.

6. <subtitleH1>
Sottotitolo. Codificato con base64_encode
Campo facoltativo.

7. <evento_start>
Data di inizio dell'evento. Codificato in unix timestamp
Campo obbligatorio.

8. <evento_end>
Data di fine  dell'evento. Codificato in unix timestamp
Campo obbligatorio.

9. <images>
Un URL assoluto ed accessibile di un'immagine di locandina
Campo facoltativo.

10. <URL>
L'URL della pagina a cui reindirizzare le visite.
*/
?>