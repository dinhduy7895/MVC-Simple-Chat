<?php
include APP . 'model/User.php';
include APP . 'controllers/ChatController.php';

class UserController extends Controller
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
            header("Location: " . URL . '?ctl=Chat');
        } else {
            header("Location: " . URL . '?ctl=User');
        }
    }

    public function register()
    {
        $data = $_POST;
        $user = new User($this->getDb());
        if ($user->register($data)) {
            header("Location: " . URL . '?ctl=Chat');
        } else {
            header("Lcation: " . URL . '?ctl=User');
        }
    }

    public function logout()
    {
        $user = new User($this->getDb());
        $user->logout();
        header("Location: " . URL . '?ctl=Home');
    }

    public function update()
    {
        if (!isset($_POST)) {
            header("Location: " . URL . '?ctl=Chat');
        }
        $data = $_POST;
        $user = new User($this->getDb());
        $user->update($data,$_SESSION['id']);
        header("Location: " . URL . '?ctl=User&act=show');
    }

    public function changePassword()
    {
        if (!isset($_POST)) {
            header("Location: " . URL . '?ctl=Chat');
        }
        $data = $_POST;
        $user = new User($this->getDb());
        if (!$user->changePassword($data))
            header("Location: " . URL . '?ctl=User&act=show');
        else
            header("Location: " . URL . '?ctl=Chat');
    }

    public function show()
    {
        $chat = new ChatController();
        $chat->loadUser();
        $userLists = $chat->userLists;
        $roomLists = $chat->roomLists;
        require APP . 'view/inc/header.php';
        require APP . 'view/user/show.php';
        require APP . 'view/inc/footer.php';
    }

    public function changeAvatar()
    {
        if (isset($_POST)) {
            $user = new User($this->getDb());
            $user->changeAvatar($_FILES);
        }
        header("Location: " . URL . '?ctl=Chat');
    }

    public function join($param)
    {
        $user = new User($this->getDb());
        $user->join($param);
        header("Location: " . URL . '?ctl=Room&act=chat&id=' . $param);
    }
}