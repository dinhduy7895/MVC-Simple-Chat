<?php

class Room extends Model
{
    function isExist($id)
    {
        $db = $this->db;
        $sql = $db->prepare("SELECT room.name FROM room   WHERE room.id = ? ");
        $sql->execute(array($id));
        return $sql->fetch();
    }

    function isNewRoom($id)
    {
        $db = $this->db;
        $sql = $db->prepare("SELECT COUNT(id) 
                                FROM user_room 
                                WHERE room_id = ? AND user_id = ?");
        $sql->execute(array($id, $_SESSION['id']));
        $data = $sql->fetch(PDO::FETCH_NUM);
        if ($data[0] == 0) return true;
        else return false;
    }

    function loadMessageRoom($id, $lastShow=0)
    {
        $db = $this->db;
        $query = "SELECT* FROM (SELECT username,avatar, chat_room.* 
        FROM chat_room, user 
        WHERE chat_room.room_id =? 
        AND chat_room.sender = user.username 
        AND chat_room.id > ?
        ORDER by id DESC LIMIT 0,20) sub ORDER BY id ASC";
        $sql = $db->prepare($query);
        $sql->execute(array($id, $lastShow));
        $r = $sql->fetchAll();
        return $r;
    }

    function loadLastMessageRoom($id, $firstShow)
    {
        $db = $this->db;
        $sql = $db->prepare("SELECT* FROM (SELECT username,avatar, chat_room.* 
        FROM chat_room, user 
        WHERE chat_room.room_id =? 
        AND chat_room.sender = user.username 
        AND chat_room.id < ?
        ORDER BY id DESC LIMIT 0,20) sub ORDER BY id ASC");
        $sql->execute(array($id, $firstShow));
        $r = $sql->fetchAll();
        return $r;
    }

    function postRoom($id, $data)
    {
        $db = $this->db;
        $msg = $data['msg'];
        if ($msg != "") {
            $sql = $db->prepare("INSERT INTO chat_room (sender,message,posted,room_id) VALUES (?,?,NOW(),?)");
            $sql->execute(array($_SESSION['user'], $msg, $id));
            $sql = $db->prepare("UPDATE user_room SET user_room.is_read = 0 WHERE user_room.room_id = ? AND user_room.user_id != ?");
            $sql->execute(array($id, $_SESSION['id']));
        }
    }

    function countdownRoom($id, $focus)
    {
        $db = $this->db;
        if($focus == 'true'){
            $sql = $db->prepare("UPDATE user_room SET is_read = 1 WHERE user_room.user_id = ? AND user_room.room_id = ?");
            $sql->execute(array( $_SESSION['id'], $id));
        }
       
    }
}