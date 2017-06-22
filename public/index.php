<?php
define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP', ROOT . app . DIRECTORY_SEPARATOR);
define('CLIENT', ROOT . 'public' . DIRECTORY_SEPARATOR);
define('ADMIN', CLIENT . 'admin' . DIRECTORY_SEPARATOR);
define('Auth' , false);

require APP . 'config/config.php';
require APP . 'libs/Image.php';
require APP . 'libs/Emojis.php';

require APP . 'framework/route.php';
require APP . 'framework/controller.php';
require APP . 'framework/model.php';
require APP . 'controllers/BaseController.php';

$route = new Route();
?>