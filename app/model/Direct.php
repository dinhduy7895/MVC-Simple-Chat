<?php
class Direct extends  Model{
   
    function isExist($id){
        $db = $this->getDb();
        $sql = $db->prepare("SELECT id FROM user   WHERE user.id = ? ");
        $sql->execute(array($id));
        if($sql->rowCount() > 0) return true;
        else return false;
    }

    function isNewDirect($id){
        $db = $this->getDb();
        $sql = $db->prepare("SELECT id FROM user_user WHERE (sender = ? and receiver = ?) OR (sender = ? and receiver = ?)");
        $sql->execute(array($id,$_SESSION['id'],$_SESSION['id'],$id));
        if($sql->rowCount() > 0) return false;
        else return true;
    }

    function newDirect($id){
        $db = $this->getDb();
        $sql = $db->prepare("INSERT INTO user_user (sender,receiver) VALUES (?,?)");
        $sql->execute(array($id,$_SESSION['id']));
    }

    function join($id){
        $db = $this->getDb();
        $sql = $db->prepare("SELECT username FROM user WHERE id = ?");
        $sql->execute(array($id));
        return $sql->fetch();
    }
}