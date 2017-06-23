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
        $room = new Room();
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
        $this->loadUser();
        $userLists = $this->userLists;
        $roomLists = $this->roomLists;
        $rooms = $this->rooms;
        $this->render('room/room.php', [
            'rooms' => $rooms,
            'userLists' => $userLists,
            'roomLists' => $roomLists,
            'new' => $new,
            'messages' => $messages,
            'receiver' => $receiver
        ]);
    }

    function roomAjaxPost($param)
    {
        $id = $param;
        $room = new Room();
        $room->postRoom($id, $_POST);
    }

    function roomAjaxMessage($param)
    {
        $id = $param;
        $lastShow = $_POST['lastShow'];
        $room = new Room();
        $messages = $room->loadMessageRoom($id, $lastShow);
        require APP . 'view/room/message.php';

    }

    function roomAjaxLastMessage($param)
    {
        $id = $param;
        $firstShow = $_POST['firstShow'];
        $room = new Room();
        $messages = $room->loadLastMessageRoom($id, $firstShow);
        require APP . 'view/room/message.php';

    }

    function roomAjaxCountdown($param)
    {
        $focus = $_POST['focus'];
        $id = $param;
        $room = new Room();
        $room->countdownRoom($id, $focus);
    }
}