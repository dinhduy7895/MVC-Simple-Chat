<?php

class  Controller{
    private  $db ;
    
    function __construct(){
        $this->loadDB();
    }
    function loadDB(){
        $conn = new PDO(DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME.';charset='.DB_CHARSET, DB_USER, DB_PASS);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->db = $conn;
    }
    function getDb(){
        return $this->db;
    }
    function render(){
        $chat = new Chat($this->getDb());
        $chat->refreshUser();
        $this->userLists = $chat->loadUserOnline();
        $this->roomLists = $chat->loadRoomAvailable($_SESSION['id']);
    }

}