<?php

header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past

error_reporting( E_ALL | E_STRICT );
ini_set( 'display_errors', 1 );
date_default_timezone_set( 'America/Mexico_City' );

define( 'CURRENT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . 'snippets' );

if ( file_exists( CURRENT_PATH . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php' ) )
{
    require_once CURRENT_PATH . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';
}
else
{
    exit('no fue posible localizar el archivo de configuración.');
}

function __autoload( $className )
{
    require_once LIBS_PATH . "{$className}.php";
}

require_once SNIPPETS_PATH . 'db/connection.php';

require_once SNIPPETS_PATH . 'controller.php';
