<?php
class  Model{
    private $db;
    function __construct($db)
    {
        $this->db = $db;
    }
    function getDb(){
        return $this->db;
    }
}