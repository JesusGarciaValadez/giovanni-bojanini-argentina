<?php

define( 'SITE_URL', 'http://localhost/giovanni-bojanini-argentina' . DIRECTORY_SEPARATOR );
define( 'BASE_URL', 'http://localhost/giovanni-bojanini-argentina' . DIRECTORY_SEPARATOR );
define( 'SNIPPETS_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR );
define( 'CLASSES_PATH', SNIPPETS_PATH . 'classes'. DIRECTORY_SEPARATOR );
define( 'LIBS_PATH', SNIPPETS_PATH . 'libs' . DIRECTORY_SEPARATOR );
define( 'TEMPLATES_PATH', LIBS_PATH . 'templates' . DIRECTORY_SEPARATOR );

//require_once LIBS_PATH . 'Common.php';

function _convertUTF8 ( &$item , $keys ){
    $item = utf8_encode($item);
}
?>
