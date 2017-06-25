<?php
include APP . 'model/Direct.php';
include APP . 'controllers/ChatController.php';

class DirectController extends ChatController
{
    function index()
    {
        $this->render('chat/home');
    }

    function chat($param)
    {
        $direct = new Direct();
        $id = $param;
        if ($direct->isExist($id)) {
            if ($direct->isNewDirect($id)) {
                $direct->newDirect($id);
            }
            $row = $direct->join($id);
            $receiver = $row['username'];
        } else $this->route('Direct');
        $messages = $direct->loadMessageDirect($id);
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            require APP . 'view/direct/direct.php';
            die();
        }
        $this->loadUser();
        $userLists = $this->userLists;
        $roomLists = $this->roomLists;
        $rooms = $this->rooms;
        $this->render('direct/direct', [
            'rooms' => $rooms,
            'userLists' => $userLists,
            'roomLists' => $roomLists,
            'messages' => $messages,
            'receiver' => $receiver
        ]);
    }

    function directAjaxPost($param)
    {
        $id = $param;
        $direct = new Direct();
        $direct->postDirect($id, $_POST);
    }

    function directAjaxMessage($param)
    {
        $id = $param;
        $direct = new Direct();
        $messages = $direct->loadMessageDirect($id);
        if(is_numeric($messages)){
            if ($messages = 0)
                require APP . 'view/direct/seen.php';
            else
                return '';
        }
        else
        require APP . 'view/direct/message.php';

    }

    function directAjaxCountdown($param)
    {   $focus = $_POST['focus'];
        $id = $param;
        $direct = new Direct();
        $direct->countdownDirect($id,$focus);

    } 
}