<?php
define( 'ACTUAL_PATH', dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'snippets' );

$settings       = ACTUAL_PATH . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'settings.php';
$sessionHandler = ACTUAL_PATH . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'session-handler.php';
require_once $settings;
require_once $sessionHandler;

switch ( $_SESSION[ "template" ] ) {
    case 'mujer':
        $locationFail       = SITE_URL . 'mujer.html';
        break;
    case 'hombre':
        $locationFail       = SITE_URL . 'hombre.html';
        break;
    case 'generico':
    default:
        $locationFail       = SITE_URL;
        break;
}

if ( array_key_exists( 'id', $_SESSION ) && !empty( $_SESSION[ 'id' ] ) )
{
    header( 'Location: ' . $locationFail );
}
else
{
    $_SESSION[ 'id' ] = $_SESSION[ 'email' ];
    switch ( $_SESSION[ "template" ] ) {
        case 'mujer':
            $file   = 'thank-you-women.tpl';
            break;
        case 'hombre':
            $file   = 'thank-you-men.tpl';
            break;
        case 'generico':
        default:
            $file   = 'thank-you.tpl';
            break;
    }
    $codes  = array( '' => '' );
    $tpl    = ParserTemplate::parseTemplate( $file, $codes );
    echo $tpl;
}
