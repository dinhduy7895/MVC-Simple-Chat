<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define("DOMAIN",$_SERVER['HTTP_HOST']);
define("SUB_FOLDER",dirname($_SERVER['SCRIPT_NAME']).DIRECTORY_SEPARATOR);
define("PROTOCOL","//");
define("URL",PROTOCOL.DOMAIN.SUB_FOLDER.'index.php');
define("PATH",str_replace("index.php","",URL));

define('DB_TYPE', 'mysql');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'Chat');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_CHARSET', 'utf8');

?>