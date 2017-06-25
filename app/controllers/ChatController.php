<?php
include APP . 'model/Chat.php';

class ChatController extends BaseController
{
    protected $userLists;
    protected $roomLists;
    protected $rooms;
    function home()
    {
        $chat = new Chat();
        $userLists = $chat->loadUserOnline();
        $roomLists = $chat->loadRoomAvailable($_SESSION['id']);
        $this->render('chat/home', [
            'userLists' => $userLists,
            'roomLists' => $roomLists,
        ]);

    }

    function index()
    {
        $chat = new Chat();
        $userLists = $chat->loadUserOnline();
        $roomLists = $chat->loadRoomAvailable($_SESSION['id']);
        $rooms = $chat->loadAllRoom();
        $this->render('chat/home', [
            'rooms' => $rooms,
            'userLists' => $userLists,
            'roomLists' => $roomLists,
        ]);
    }

    function AjaxOnline($param)
    {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
           $_GET['ctl'] = $_GET['type'];
        }
        $this->loadUser();
        $userLists = $this->userLists;
        $roomLists = $this->roomLists;
        $rooms = $this->rooms;
        require APP . 'view/inc/nav.php';
    }

    function loadUser()
    {
        $chat = new Chat();
        $chat->refreshUser();
        $this->userLists = $chat->loadUserOnline();
        $this->roomLists = $chat->loadRoomAvailable($_SESSION['id']);
        $this->rooms = $chat->loadAllRoom();

    }
}

?>