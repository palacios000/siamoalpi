<?php 
// redirect users after logout to login-register page
if(!$user->isLoggedin() && $input->get('loggedout')) {
    $session->removeNotices();
    $session->redirect($config->urls->root . 'registrazione'); 
}

// replace PW login form with login-register.php page
$wire->addHookBefore('ProcessLogin::buildLoginForm', function (HookEvent $event) {
    $session = $this->wire('session');
    $config = $this->wire('config');
    $input = $this->wire('input');
    // inserisco la regola del get, altrimenti non mi fa loggare come admin in login-resiter
    // if ($input->get->admin != 1) { ... non funziona
    // if ($input->get->login != 1) {
        $session->redirect($config->urls->root . 'registrazione'); 
    // }
});



/* gestionale =========================== */
/* seleziona il tema della ricerca antropologia in base alla posizione in cui si trova la pagina. 
Riferimento al template "gestionale_scheda" */

$wire->addHookAfter('InputfieldPage::getSelectablePages', function($event) {
  if($event->object->hasField == 'tema') {
    $pageSchedaParentId = $event->arguments('page')->parent->id;
    $event->return = $event->pages->find("template=gestionale_tema, ente=$pageSchedaParentId");
  }
});

// SeoMaestro ### 
// Add the brand name after the title. 
// https://github.com/wanze/SeoMaestro#___renderseodatavalue
$wire->addHookAfter('SeoMaestro::renderSeoDataValue', function (HookEvent $event) {
	$sanitizer = $this->wire('sanitizer');

    $group = $event->arguments(0);
    $name = $event->arguments(1);
    $value = $event->arguments(2);
    
    if ($group === 'meta' && $name === 'description') {
        $description = $sanitizer->truncate($value, [
            'type' => 'sentence',
            'maxLength' => 300,
            'visible' => true,
            'convertEntities' => true
        ]) ;
        $event->return = $sanitizer->text($description) ;
    }
    if ($group === 'opengraph' && $name === 'description') {
        $description = $sanitizer->truncate($value, [
	        'type' => 'sentence',
	        'maxLength' => 500,
          	'visible' => true,
            'convertEntities' => true,
            'keepFormatTags' => false
          ]) ;
        $event->return = $sanitizer->text($description) ;
    }
});
