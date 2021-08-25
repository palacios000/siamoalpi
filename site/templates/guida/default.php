<?php 
$jqt = $modules->get("TextformatterJqueryUITabs");
$mcs = $modules->get("TextformatterMarkupCSS");

$body = $page->body;
$mcs->format($body);
$jqt->format($body);

$config->styles->add("/processwire_test1/site/modules/ProcessDocumentation/ProcessDocumentationDefault.css");

echo '<div class="help-doc">';

echo $body;

echo '</div>';

echo '<ul class="uk-list">';
foreach ($page->children as $sottopagina) {
	$url = str_replace('/gestionale/', '/gestione/', $sottopagina->url);
	echo "<li><a href='$url'>$sottopagina->title</a></li>";
}
echo '</ul>';


/*
un po' complicato da configurare ma almeno il menu lato back end si aggiorna subito
In pratica bisogna avere due insiemi di pagine: le pagine vere e proprie (home > gestionale > guida) e i processi sotto il lato admin (Admin > Guida > ecc).
Le pagine sotto admin devono avere il process impostato con ProcessDocumentation.

Qui sopra invece sgamo per linkare le pagine del ProcessDocumentation, in pratica cambio l'URL in modo che vadano a finire nella sezione della guida invece che nelle pagine vere e proprie.

Purtroppo per ogni pagina creata, non viene automaticamente generato il corrispondente ProcessDocumentaion, biosogna farlo a mano... Comunque le pagine della guida non saranno tante.

guida completa qui
https://processwire.com/talk/topic/17488-module-preview-process-documentation/
*/
?>
 	
 

