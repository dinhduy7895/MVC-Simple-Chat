<?php
class  BaseController extends  Controller
{
    function __construct() {
        $this->loadDB();
    }


    function loadDB() {
         $conn = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS);
         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $this->db = $conn;
     }

    function getDb()
    {
        return $this->db;
    }

    function render($viewUrl, $param = null)
    {
        if ($param != null) {
            foreach ($param as $key => $value) {
                eval('$' . $key . '=' . var_export($value,true) . ';');
            }
        }
        $chat = new Chat($this->getDb());
        $chat->refreshUser();
        $userLists = $chat->loadUserOnline();
        $roomLists = $chat->loadRoomAvailable($_SESSION['id']);
        require APP . 'view/inc/header.php';
        require APP . 'view/' . $viewUrl;
        require APP . 'view/inc/footer.php';
    }

    function route($ctl, $act = 'index', $id = null)
    {
        $url = "Location: " . URL . $ctl . '/' . $act;
        if ($id != null) {
            $url = $url . '/' . $id;
        }
        header($url);
    }
}