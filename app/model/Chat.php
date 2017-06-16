<?php

class Chat extends Model
{
   

    function refreshUser()
    {
        $db = $this->getDb();
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

    function loadUserOnline(){
        $db = $this->getDb();

        $sql = $db->prepare("SELECT id, status, username FROM user");
        $sql->execute();
        $r = $sql->fetchAll();
        
        return $r;

    }

    function loadRoomAvailable($id){
        $db = $this->getDb();
        $sql = $db->prepare("SELECT room.id, room.name FROM room 
                            INNER JOIN user_room 
                            on room.id = user_room.room_id
                            WHERE user_room.user_id = ?");
        $sql->execute(array($id));
        $r = $sql->fetchAll();
        
        return $r;
    }

    
}