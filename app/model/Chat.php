<?php

class Chat extends Model
{


    function refreshUser()
    {
        $db = $this->db;
        $sql = $db->prepare("SELECT username FROM user WHERE id=?");
        $sql->execute(array($_SESSION['id']));
        if ($sql->rowCount() != 0) {
            $sql = $db->prepare("UPDATE user SET seen=NOW() WHERE id=?");
            $sql->execute(array($_SESSION['id']));
        }
        $sql = $db->prepare("SELECT * FROM user");
        $sql->execute();
        while ($r = $sql->fetch()) {
            $curtime = strtotime(date("Y-m-d H:i:s", strtotime('-60 seconds', time())));
            if (strtotime($r['seen']) < $curtime) {
                $stmt = $db->prepare("UPDATE user SET status=0 WHERE id=?");
                $stmt->execute(array($r['id']));
            }
        }
    }

    function loadUserOnline()
    {
        $db = $this->db;
        $sql = $db->prepare("SELECT user.*, sub.count FROM user LEFT JOIN  
( SELECT chat_user.sender as name , COUNT(is_read) as count FROM chat_user 
WHERE chat_user.sender != ? AND is_read = 0 AND user_user_id in 
(SELECT id FROM user_user WHERE user_user.sender = ? OR user_user.receiver = ?)
GROUP BY chat_user.sender ) as sub ON sub.name = user.id");
        $sql->execute(array($_SESSION['id'], $_SESSION['id'], $_SESSION['id']));
        $r = $sql->fetchAll();
        return $r;

    }

    function loadRoomAvailable($id)
    {
        $db = $this->db;
        $sql = $db->prepare("SELECT room.id, room.name, user_room.is_read  FROM room 
                            INNER JOIN user_room 
                            on room.id = user_room.room_id
                            WHERE user_room.user_id = ?");
        $sql->execute(array($id));
        $r = $sql->fetchAll();
        return $r;
    }

    function loadAllRoom()
    {
        $db = $this->db;
        $sql = $db->prepare("SELECT room.id, room.name FROM room ");
        $sql->execute();
        $r = $sql->fetchAll();
        return $r;
    }
}