<?php
include APP.'model/User.php';

class UserController extends Controller {
    public function index(){
      
        require APP.'view/user/login.php';
    }
    public function login(){
        require APP.'view/user/login.php';
    }
    public function signup(){

        $data  = $_POST;

        $user = new User($this->getDb());

        if($user->signup($data)){
            
            header("Location: ".URL.'?ctl=Chat');
        }else {
            header("Lcation: ". URL . '?ctl=User');
        }

    }
    public  function register(){
        $data  = $_POST;
        $user = new User($this->getDb());
        if($user->register($data)){
            header("Location: ".URL.'?ctl=Chat');
        }else {
            header("Lcation: ". URL . '?ctl=User');
        }
    }
}