<?php
include APP.'model/Chat.php';


class ChatController extends Controller{
        public $userLists;
        public $roomList;
        function home(){
            $this->loadUser();
            $userLists = $this->userLists;
            $roomLists = $this->roomLists;
            require APP.'view/inc/header.php';
            require APP.'view/inc/footer.php';
            require APP.'view/chat/home.php';

        }
        function index(){
            $this->loadUser();
            $userLists = $this->userLists;
            $roomLists = $this->roomLists;

            require APP.'view/inc/header.php';
            require APP.'view/chat/home.php';
            require APP.'view/inc/footer.php';
        }


        function AjaxOnline(){
            $this->loadUser();
            $userLists = $this->userLists;
            $roomLists = $this->roomLists;
            require APP.'view/inc/nav.php';
        }

        function loadUser(){
            $chat = new Chat($this->getDb());
            $chat->refreshUser();
            $this->userLists = $chat->loadUserOnline();

            $this->roomLists = $chat->loadRoomAvailable($_SESSION['id']);

        }
    }

?>