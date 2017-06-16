<?php
include APP.'model/Chat.php';
include APP.'model/Direct.php';
include APP.'model/Room.php';

class ChatController extends Controller{
        public $userLists;
        public $roomList;
        function home(){
            $this->loadUser();
            $userLists = $this->userLists;
            $roomLists = $this->roomLists;
            require APP.'view/inc/header.php';
            require APP.'view/chat/home.php';
            require APP.'view/inc/footer.php';
        }
        function index(){
            $this->loadUser();
            $userLists = $this->userLists;
            $roomLists = $this->roomLists;

            require APP.'view/inc/header.php';
            require APP.'view/chat/home.php';
            require APP.'view/inc/footer.php';
        }
        function room($param){
            $id = $param;
            $new = false;
            $chat = new Chat($this->getDb());
            $room = new Room($this->getDb());
            if($room->isExist($id)){    
                if($room->isNewRoom($id)){
                    $new = true;
                }
                $row = $room->join($id);
                $receiver = $row['name'];
            }
            else header("Location:". URL . '?ctl=Chat&act=home');
            $this->loadUser();
            $userLists = $this->userLists;
            $roomLists = $this->roomLists;
            require APP.'view/inc/header.php';
            require APP.'view/chat/room.php';
            require APP.'view/inc/footer.php';
        }
        
        function direct($param){

            $direct = new Direct($this->getDb());
            $chat = new Chat($this->getDb());
            $id = $param;
            if($direct->isExist($id)){
                if($direct->isNewDirect($id)){
                    $direct->newDirect($id);
                }
                $row = $direct->join($id);
                $receiver = $row['username'];
            }
            else header("Location:". URL . '?ctl=Chat&act=home');
            $messages = $chat->loadMessageDirect($id);
            $this->loadUser();
            $userLists = $this->userLists;
            $roomLists = $this->roomLists;
            require APP.'view/inc/header.php';
            require APP.'view/chat/direct.php';
            require APP.'view/inc/footer.php';
        }

        function AjaxOnline(){
            $this->loadUser();
            require APP.'view/inc/nav.php';
        }
        function roomAjaxPost($param){
            $id = $param;

            $chat = new Chat($this->getDb());
            $chat->postRoom($id,$_POST);
        }
        function directAjaxPost($param){
            $id = $param;

            $chat = new Chat($this->getDb());
            $chat->postDirect($id,$_POST);
        }
        function roomAjaxMessage($param){
            $id = $param;
            $chat = new Chat($this->getDb());
            $messages = $chat->loadMessageRoom($id);
            require APP.'view/room/message.php';

        }
        function directAjaxMessage($param){
            $id = $param;
            $chat = new Chat($this->getDb());
            $messages = $chat->loadMessageDirect($id);
            require APP.'view/direct/message.php';

        }
        function loadUser(){
            $chat = new Chat($this->getDb());
            $chat->refreshUser();
            $this->userLists = $chat->loadUserOnline();

            $this->roomLists = $chat->loadRoomAvailable($_SESSION['id']);
            
        }
    }

?>