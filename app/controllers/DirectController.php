<?php
include APP.'model/Direct.php';
include APP.'controllers/ChatController.php';
class DirectController extends ChatController{
    function index(){
        $this->loadUser();
        $userLists = $this->userLists;
        $roomLists = $this->roomLists;
        require APP.'view/inc/header.php';
        require APP.'view/chat/home.php';
        require APP.'view/inc/footer.php';
    }
    
    function chat($param){
        $direct = new Direct($this->getDb());
        $id = $param;
        if($direct->isExist($id)){
            if($direct->isNewDirect($id)){
                $direct->newDirect($id);
            }
            $row = $direct->join($id);
            $receiver = $row['username'];
        }
        else header("Location:". URL . '?ctl=Direct');
        $messages = $direct->loadMessageDirect($id);
        $this->loadUser();
        $userLists = $this->userLists;
        $roomLists = $this->roomLists;
        require APP.'view/inc/header.php';
        require APP.'view/direct/direct.php';
        require APP.'view/inc/footer.php';
    }

    function directAjaxPost($param){
        $id = $param;

        $direct = new Direct($this->getDb());
        $direct->postDirect($id,$_POST);
    }

    function directAjaxMessage($param){
        $id = $param;
        $direct = new Direct($this->getDb());
        $messages = $direct->loadMessageDirect($id);
        require APP.'view/direct/message.php';

    }
}