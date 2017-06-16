<?php

define('ROOT',dirname(__DIR__).DIRECTORY_SEPARATOR);
define('APP', ROOT.app.DIRECTORY_SEPARATOR);
define('CLIENT',ROOT.'public'.DIRECTORY_SEPARATOR);

require APP.'config/config.php';
require APP.'libs/Image.php';
require APP.'framework/route.php';
require APP.'framework/controller.php';
require APP.'framework/model.php';

Image::getImage($_SESSION['avatar']);

$route = new Route();
?>