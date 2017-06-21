<?php

class Direct extends Model
{
    function isExist($id)
    {
        $db = $this->getDb();
        $sql = $db->prepare("SELECT id FROM user   WHERE user.id = ? ");
        $sql->execute(array($id));
        if ($sql->rowCount() > 0) return true;
        else return false;
    }

    function isNewDirect($id)
    {
        $db = $this->getDb();
        $sql = $db->prepare("SELECT id FROM user_user WHERE (sender = ? and receiver = ?) OR (sender = ? and receiver = ?)");
        $sql->execute(array($id, $_SESSION['id'], $_SESSION['id'], $id));
        if ($sql->rowCount() > 0) return false;
        else return true;
    }

    function newDirect($id)
    {
        $db = $this->getDb();
        $sql = $db->prepare("INSERT INTO user_user (sender,receiver) VALUES (?,?)");
        $sql->execute(array($id, $_SESSION['id']));
    }

    function join($id)
    {
        $db = $this->getDb();
        $sql = $db->prepare("SELECT username FROM user WHERE id = ?");
        $sql->execute(array($id));
        return $sql->fetch();
    }

    function loadMessageDirect($id)
    {
        $db = $this->getDb();
        $sql = $db->prepare("SELECT id FROM user_user WHERE (sender = ? and receiver = ?) OR (sender = ? and receiver = ?)");
        $sql->execute(array($id, $_SESSION['id'], $_SESSION['id'], $id));
        $row = $sql->fetch();
        $id = $row['id'];
        $sql = $db->prepare("SELECT username,avatar, chat_user.* FROM chat_user, user WHERE chat_user.user_user_id =? AND chat_user.sender = user.username ORDER by id ASC ");
        $sql->execute(array($id));
        $r = $sql->fetchAll();
        return $r;
    }

    function postDirect($id, $data)
    {
        $db = $this->getDb();
        $sql = $db->prepare("SELECT id FROM user_user WHERE (sender = ? and receiver = ?) OR (sender = ? and receiver = ?)");
        $sql->execute(array($id, $_SESSION['id'], $_SESSION['id'], $id));
        $row = $sql->fetch();
        $id = $row['id'];
        $msg = $data['msg'];
        if ($msg != "") {
            $sql = $db->prepare("INSERT INTO chat_user (sender,message,posted,user_user_id) VALUES (?,?,NOW(),?)");
            $sql->execute(array($_SESSION['user'], $msg, $id));
        }
    }
}