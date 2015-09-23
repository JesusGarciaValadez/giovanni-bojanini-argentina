<?php
define( 'ACTUAL_PATH', dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'snippets' );

$settings       = ACTUAL_PATH . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'settings.php';
$sessionHandler = ACTUAL_PATH . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'session-handler.php';
require_once $settings;
require_once $sessionHandler;

if ( array_key_exists( 'id', $_SESSION ) && !empty( $_SESSION[ 'id' ] ) )
{
    header( 'Location: ' . SITE_URL );
}
else
{
    $_SESSION[ 'id' ] = $_SESSION[ 'email' ];

    $file   = 'thank-you.tpl';
    $codes  = array( '' => '' );
    $tpl    = ParserTemplate::parseTemplate( $file, $codes );
    echo $tpl;
}
