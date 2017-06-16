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

    function loadMessageDirect($id){
        $db = $this->getDb();
        $sql = $db->prepare("SELECT id FROM user_user WHERE (sender = ? and receiver = ?) OR (sender = ? and receiver = ?)");
        $sql->execute(array($id,$_SESSION['id'],$_SESSION['id'],$id));
        $row = $sql->fetch();
        $id = $row['id'];
        $sql = $db->prepare("SELECT username,avatar, chat_user.* FROM chat_user, user WHERE chat_user.user_user_id =? AND chat_user.sender = user.username ORDER by id ASC ");
        $sql->execute(array($id));
        $r = $sql->fetchAll();
        return $r;
    }

    function loadMessageRoom($id){
        $db = $this->getDb();
        $sql = $db->prepare("SELECT username,avatar, chat_room.* FROM chat_room, user WHERE chat_room.room_id =? AND chat_room.sender = user.username ORDER by id ASC ");
        $sql->execute(array($id));
        $r = $sql->fetchAll();
        return $r;
    }
    
    function postRoom($id,$data){
        $db = $this->getDb();
        $msg = $data['msg'];
        if ($msg != "") {
            $sql = $db->prepare("INSERT INTO chat_room (sender,message,posted,room_id) VALUES (?,?,NOW(),?)");
            $sql->execute(array($_SESSION['user'], $msg,$id));
        }
    }

    function postDirect($id,$data){
        $db = $this->getDb();
        $sql = $db->prepare("SELECT id FROM user_user WHERE (sender = ? and receiver = ?) OR (sender = ? and receiver = ?)");
        $sql->execute(array($id,$_SESSION['id'],$_SESSION['id'],$id));
        $row = $sql->fetch();
        $id = $row['id'];
        $msg = $data['msg'];
        if ($msg != "") {
            $sql = $db->prepare("INSERT INTO chat_user (sender,message,posted,user_user_id) VALUES (?,?,NOW(),?)");
            $sql->execute(array($_SESSION['user'], $msg,$id));
        }
    }
}