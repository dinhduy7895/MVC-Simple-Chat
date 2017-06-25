<?php
session_start();

class  Route
{
    private $controller = null;
    private $action = null;
    private $param = [];

    function __construct()
    {
        $this->loadScript();
        if (Auth) {

            if ($this->controller == null) {

                require APP . 'controllers/backend/AdminController.php';
                $home = new AdminController();

                if (isset($_SESSION['admin'])) {

                    $home->index();
                } else {

                    $home->login();
                }
            } elseif (file_exists(APP . 'controllers/backend/' . $this->controller . 'Controller.php')) {
                require APP . 'controllers/backend/' . $this->controller . 'Controller.php';
                $this->controller = $this->controller . 'Controller';
                $this->controller = new $this->controller();
                if (method_exists($this->controller, $this->action)) {
                    
                    if (!empty($this->param)) {
                        call_user_func_array(array($this->controller, $this->action), $this->param);
                    } else {
                        $this->controller->{$this->action}();
                    }
                } else {
                    if (strlen($this->action) == 0) {
                        $this->controller->index();
                    } else {
                        header("Location: " . URL . '?ctl=error');
                    }
                }
            } else {
                header("Location: " . URL . '?ctl=error');
            }
        } else {
            if ($this->controller == null) {
                require APP . 'controllers/HomeController.php';
                $home = new HomeController();
                $home->index();
            } elseif (file_exists(APP . 'controllers/' . $this->controller . 'Controller.php')) {
                if (!isset($_SESSION['user']) && $this->controller != 'User') {
                    header("Location: " . URL . 'User');
                }
                require APP . 'controllers/' . $this->controller . 'Controller.php';
                $this->controller = $this->controller . 'Controller';
                $this->controller = new $this->controller();
                if (method_exists($this->controller, $this->action)) {
                    if (!empty($this->param)) {
                        call_user_func_array(array($this->controller, $this->action), $this->param);
                    } else {
                        $this->controller->{$this->action}();
                    }
                } else {
                    if (strlen($this->action) == 0) {
                        $this->controller->index();
                    } else {
                        header("Location: " . URL . '?ctl=error');
                    }
                }
            } else {
                header("Location: " . URL . '?ctl=error');
            }
        }
    }

    private function loadScript()
    {
        if (isset($_GET['ctl'])) {
            $url = [];
            foreach ($_GET as $key => $value) {
                $url[$key] = $value;
            }
            if (array_key_exists('ctl', $url)) $this->controller = $url['ctl'];
            if (array_key_exists('act', $url)) $this->action = $url['act'];
            unset($url['ctl'], $url['act']);
            $this->param = $url;
        }
//        var_dump($this);
//        exit();
    }

}