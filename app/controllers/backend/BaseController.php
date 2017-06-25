<?php

class  BaseController extends Controller
{


    function getDb()
    {
        return $this->db;
    }

    function render($viewUrl, $param = null)
    {
        if ($param != null) {
            foreach ($param as $key => $value) {
                eval('$' . $key . '=' . var_export($value, true) . ';');
            }
        }
        require APP . 'view/backend/layouts/header.php';
        require APP . 'view/backend/layouts/left.php';
        require APP . 'view/backend/' . $viewUrl.'.php';
        require APP . 'view/backend/layouts/footer.php';    }

    function route($ctl, $act = 'index', $id = null)
    {
        $url = "Location: " . URL .'/'. $ctl . '/' . $act;
        if ($id != null) {
            $url = $url . '/' . $id;
        }
        header($url);
    }
}