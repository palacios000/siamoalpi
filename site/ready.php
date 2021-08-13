<?php 

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
