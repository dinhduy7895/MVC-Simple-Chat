<?php

class Room extends Model
{
    function isExist($id)
    {
        $db = $this->getDb();
        $sql = $db->prepare("SELECT room.name FROM room   WHERE room.id = ? ");
        $sql->execute(array($id));
        return $sql->fetch();
    }

    function isNewRoom($id)
    {
        $db = $this->getDb();
        $sql = $db->prepare("SELECT COUNT(id) 
                                FROM user_room 
                                WHERE room_id = ? AND user_id = ?");
        $sql->execute(array($id, $_SESSION['id']));
        $data = $sql->fetch(PDO::FETCH_NUM);
        if ($data[0] == 0) return true;
        else return false;
    }

    function loadMessageRoom($id)
    {
        $db = $this->getDb();
        $sql = $db->prepare("SELECT* FROM (SELECT username,avatar, chat_room.* FROM chat_room, user WHERE chat_room.room_id =? AND chat_room.sender = user.username ORDER by id DESC LIMIT 0,20) sub ORDER BY id ASC");
        $sql->execute(array($id));
        $r = $sql->fetchAll();
        return $r;
    }

    function postRoom($id, $data)
    {
        $db = $this->getDb();
        $msg = $data['msg'];
        if ($msg != "") {
            $sql = $db->prepare("INSERT INTO chat_room (sender,message,posted,room_id) VALUES (?,?,NOW(),?)");
            $sql->execute(array($_SESSION['user'], $msg, $id));
        }
    }

}