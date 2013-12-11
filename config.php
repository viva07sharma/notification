<?php
define('DOMAIN_HOST','localhost');
define('DOMAIN_PORT','9001');
define('PROJECT_DIR','notification');
define('WEBSOCKET_LOCATION',PROJECT_DIR.'/index.php');
define('WEBSOCKET_URI','ws://'.DOMAIN_HOST.':'.DOMAIN_PORT.'/'.PROJECT_DIR.'/server.php');
?>
