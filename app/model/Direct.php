<?php

class Direct extends Model
{
    function isExist($id)
    {
        $db = $this->db;
        $sql = $db->prepare("SELECT id FROM user   WHERE user.id = ? ");
        $sql->execute(array($id));
        if ($sql->rowCount() > 0) return true;
        else return false;
    }

    function isNewDirect($id)
    {
        $db = $this->db;
        $sql = $db->prepare("SELECT id FROM user_user WHERE (sender = ? and receiver = ?) OR (sender = ? and receiver = ?)");
        $sql->execute(array($id, $_SESSION['id'], $_SESSION['id'], $id));
        if ($sql->rowCount() > 0) return false;
        else return true;
    }

    function newDirect($id)
    {
        $db = $this->db;
        $sql = $db->prepare("INSERT INTO user_user (sender,receiver) VALUES (?,?)");
        $sql->execute(array($id, $_SESSION['id']));
    }

    function join($id)
    {
        $db = $this->db;
        $sql = $db->prepare("SELECT username FROM user WHERE id = ?");
        $sql->execute(array($id));
        return $sql->fetch();
    }

    function loadMessageDirect($id)
    {
        $db = $this->db;
        $sql = $db->prepare("SELECT id FROM user_user WHERE (sender = ? and receiver = ?) OR (sender = ? and receiver = ?)");
        $sql->execute(array($id, $_SESSION['id'], $_SESSION['id'], $id));
        $row = $sql->fetch();
        $id = $row['id'];
        $sql = $db->prepare("SELECT username,avatar, chat_user.* FROM chat_user, user 
WHERE chat_user.user_user_id =? 
AND chat_user.sender = user.id 
AND ( ( chat_user.sender = ? AND time_post > 0)
OR (chat_user.sender != ? AND time_receive > 0))
ORDER by id ASC ");
        $sql->execute(array($id, $_SESSION['id'], $_SESSION['id']));
        $r = $sql->fetchAll();
        if(count($r) > 0)
        return $r;
        else{
            $sql = $db->prepare("SELECT COUNT(id) as num FROM chat_user WHERE chat_user.user_user_id =  ? AND chat_user.sender = ? AND is_read = 0");
            $sql->execute(array($id, $_SESSION['id']));
            $row = $sql->fetch();
            $id = $row['num'];
         
            return $id;
        }
    }

    function postDirect($id, $data)
    {
        $db = $this->db;
        $sql = $db->prepare("SELECT id FROM user_user WHERE (sender = ? and receiver = ?) OR (sender = ? and receiver = ?)");
        $sql->execute(array($id, $_SESSION['id'], $_SESSION['id'], $id));
        $row = $sql->fetch();
        $id = $row['id'];
        $msg = $data['msg'];
        if ($msg != "") {
            $sql = $db->prepare("INSERT INTO chat_user (sender,message,posted,user_user_id) VALUES (?,?,NOW(),?)");
            $sql->execute(array($_SESSION['id'], $msg, $id));
        }
    }

    function countdownDirect($id, $focus)
    {
        $db = $this->db;
        $sql = $db->prepare("SELECT id FROM user_user WHERE (sender = ? and receiver = ?) OR (sender = ? and receiver = ?)");
        $sql->execute(array($id, $_SESSION['id'], $_SESSION['id'], $id));
        $row = $sql->fetch();
        $id = $row['id'];
        if($focus == 'true' ) {
            $sql = $db->prepare("UPDATE chat_user SET is_read = 1
            WHERE user_user_id = ? AND sender != ? AND  is_read = 0");
            $sql->execute(array($id, $_SESSION['id']));
        }
        $sql = $db->prepare("UPDATE chat_user SET time_post = time_post -1 
            WHERE  sender = ? AND  time_post > 0");
        $sql->execute(array($_SESSION['id']));
        $sql = $db->prepare("UPDATE chat_user SET time_receive = time_receive -1 
            WHERE is_read = 1 AND sender != ? AND  time_receive > 0");
        $sql->execute(array( $_SESSION['id']));


    }
}