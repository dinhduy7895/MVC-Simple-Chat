<?php
include APP . 'model/Room.php';
include APP . 'controllers/ChatController.php';

class RoomController extends ChatController
{
    function index()
    {
        $this->render('chat/home.php');
    }

    function chat($param)
    {
        $id = $param;
        $new = 'false';
        $room = new Room($this->getDb());
        if ($room->isExist($id)) {
            if ($room->isNewRoom($id)) {
                $new = 'true';
            }
            $row = $room->isExist($id);
            $receiver = $row['name'];
        } else header("Location:" . URL . '?ctl=Room');
        $messages = $room->loadMessageRoom($id);
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            require APP . 'view/room/room.php';
            die();
        }
        $this->render('room/room.php', [
            'new' => $new,
            'messages' => $messages,
              'receiver' => $receiver
        ]);
    }

    function roomAjaxPost($param)
    {
        $id = $param;
        $room = new Room($this->getDb());
        $room->postRoom($id, $_POST);
    }

    function roomAjaxMessage($param)
    {
        $id = $param;
        $room = new Room($this->getDb());
        $messages = $room->loadMessageRoom($id);
        require APP . 'view/room/message.php';

    }
}