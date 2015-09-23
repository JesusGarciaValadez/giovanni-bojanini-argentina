<?php
define( 'ACTUAL_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . 'snippets' );
require_once ACTUAL_PATH . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'settings.php';

$config = Common::getConfig();

require_once SNIPPETS_PATH . 'db/connection.php';

$action    = strip_tags( trim( $_GET[ 'action' ] ) );

if ( !empty( $action ) )
{
    require_once SNIPPETS_PATH . 'controller.php';
}
