<?php
include APP . 'model/User.php';
include APP . 'controllers/ChatController.php';

class UserController extends BaseController
{
    public function index()
    {
        require APP . 'view/user/login.php';
    }

    public function login()
    {
        require APP . 'view/user/login.php';
    }

    public function signup()
    {
        $data = $_POST;
        $user = new User($this->getDb());
        if ($user->signup($data)) {
            $this->route('Chat');
        } else {
            $this->route('User');
        }
    }

    public function register()
    {
        $data = $_POST;
        $user = new User($this->getDb());
        if ($user->register($data)) {
            $this->route('Chat');
        } else {
            $this->route('User');
        }
    }

    public function logout()
    {
        $user = new User($this->getDb());
        $user->logout();
        $this->route('Home');
    }

    public function update()
    {
        if (!isset($_POST)) {
            $this->route('Chat');
        }
        $data = $_POST;
        $user = new User($this->getDb());
        $user->update($data, $_SESSION['id']);
        $this->route('User', 'show');
    }

    public function changePassword()
    {
        if (!isset($_POST)) {
            $this->route('Chat');
        }
        $data = $_POST;
        $user = new User($this->getDb());
        if (!$user->changePassword($data))
            $this->route('User', 'show');
        else
            $this->route('Chat');
    }

    public function show()
    {
        $this->render('user/show.php');
    }

    public function changeAvatar()
    {
        if (isset($_POST)) {
            $user = new User($this->getDb());
            $user->changeAvatar($_FILES);
        }
        $this->route('Chat');
    }

    public function join($param)
    {
        $user = new User($this->getDb());
        $user->join($param);
        $this->route('Room', 'chat', $param);
    }
}