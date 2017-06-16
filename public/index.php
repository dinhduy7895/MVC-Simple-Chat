<?php

define('ROOT',dirname(__DIR__).DIRECTORY_SEPARATOR);
define('APP', ROOT.app.DIRECTORY_SEPARATOR);
require APP.'config/config.php';
require APP.'libs/Image.php';
require APP.'framework/route.php';
require APP.'framework/controller.php';
require APP.'framework/model.php';
define('CLIENT',str_replace("index.php","",URL));
$route = new Route();
?>