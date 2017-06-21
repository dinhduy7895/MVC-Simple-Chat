<?php
include APP . 'model/Chat.php';


class ChatController extends Controller
{
    public $userLists;
    public $roomList;

    function home()
    {
        $this->loadUser();
        $userLists = $this->userLists;
        $roomLists = $this->roomLists;
        require APP . 'view/inc/header.php';
        require APP . 'view/chat/home.php';
        require APP . 'view/inc/footer.php';

    }

    function index()
    {
        $this->loadUser();
        $userLists = $this->userLists;
        $roomLists = $this->roomLists;
        require APP . 'view/inc/header.php';
        require APP . 'view/chat/home.php';
        require APP . 'view/inc/footer.php';
    }


    function AjaxOnline($param)
    {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $pos = strpos($_GET['type'],'Room');
            if($pos === false) $_GET['ctl'] = 'Direct';
            else $_GET['ctl'] = 'Room';
        }

        $this->loadUser();
        $userLists = $this->userLists;
        $roomLists = $this->roomLists;
        require APP . 'view/inc/nav.php';
    }

    function loadUser()
    {
        $chat = new Chat($this->getDb());
        $chat->refreshUser();
        $this->userLists = $chat->loadUserOnline();
        $this->roomLists = $chat->loadRoomAvailable($_SESSION['id']);
    }
}

?>