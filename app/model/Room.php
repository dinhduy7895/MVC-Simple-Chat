<?php
class Room extends  Model{
  
    function isExist($id){
        $db = $this->getDb();
        $sql = $db->prepare("SELECT room.name FROM room   WHERE room.id = ? ");
        $sql->execute(array($id));
        if($sql->rowCount() > 0) return true;
        else return false;
    }

    function isNewRoom($id){
        $db = $this->getDb();
        $sql = $db->prepare("SELECT COUNT(id) 
                                FROM user_room 
                                WHERE room_id = ? AND user_id = ?");
        $sql->execute(array($id, $_SESSION['id']));
        $data = $sql->fetch(PDO::FETCH_NUM);
        if($data[0] == 0) return true;
        else return false;
    }

    function join($id){
        $db = $this->getDb();

        $sql = $db->prepare("SELECT room.name FROM room   WHERE room.id = ? ");
        $sql->execute(array($id));
        return $sql->fetch();
    }
}