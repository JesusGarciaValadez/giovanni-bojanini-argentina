<?php
define( 'ACTUAL_PATH', dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'snippets' );

$settings       = ACTUAL_PATH . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'settings.php';
$sessionHandler = ACTUAL_PATH . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'session-handler.php';
require_once $settings;
require_once $sessionHandler;


$file  = "index.tpl";

if ( array_key_exists( 'id', $_SESSION ) && !empty( $_SESSION[ 'id' ] ) )
{
  $param[ 'response' ] = "Gracias por confiar en nosotros. Su información ya ha sido enviada por usted previamente. Pronto nos estaremos comunicando contigo. Saludos!";
}
else
{
  $param[ "response" ] = "";
}
$tpl    = ParserTemplate::parseTemplate( $file, $param );
echo $tpl;
