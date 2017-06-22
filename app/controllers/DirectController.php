<?php
include APP . 'model/Direct.php';
include APP . 'controllers/ChatController.php';

class DirectController extends ChatController
{
    function index()
    {
        $this->render('chat/home.php');
    }

    function chat($param)
    {
        $direct = new Direct($this->getDb());
        $id = $param;
        if ($direct->isExist($id)) {
            if ($direct->isNewDirect($id)) {
                $direct->newDirect($id);
            }
            $row = $direct->join($id);
            $receiver = $row['username'];
        } else header("Location:" . URL . '?ctl=Direct');
        $messages = $direct->loadMessageDirect($id);
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            require APP . 'view/direct/direct.php';
            die();
        }
        $this->render('direct/direct.php', [
            'messages' => $messages,
            'receiver' => $receiver
        ]);
    }

    function directAjaxPost($param)
    {
        $id = $param;
        $direct = new Direct($this->getDb());
        $direct->postDirect($id, $_POST);
    }

    function directAjaxMessage($param)
    {
        $id = $param;
        $direct = new Direct($this->getDb());
        $messages = $direct->loadMessageDirect($id);
        require APP . 'view/direct/message.php';

    }

    function directAjaxCountdown($param)
    {
       
        $id = $param;
        $direct = new Direct($this->getDb());
        $direct->countdownDirect($id);

    } 
}