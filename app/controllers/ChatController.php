<?php
include APP . 'model/Chat.php';

class ChatController extends BaseController
{
    public $userLists;
    public $roomList;

    function home()
    {
        $this->render('chat/home.php');

    }

    function index()
    {
        $this->render('chat/home.php');
    }

    function AjaxOnline($param)
    {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
           $_GET['ctl'] = $_GET['type'];
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