<?php
include APP . 'model/User.php';
include APP . 'controllers/ChatController.php';

class AdminController extends BaseController
{
    public function index()
    {
        require APP . 'view/backend/layouts/header.php';
        require APP . 'view/backend/layouts/left.php';
        require APP . 'view/backend/admin/index.php';
        require APP . 'view/backend/layouts/footer.php';

    }

    public function login()
    {
        require APP . 'view/backend/admin/login.php';
    }

    public function signup()
    {
        $data = $_POST;
        $user = new User($this->getDb());
        $user->signupAdmin($data); 
        header("Location: " . URL . '?ctl=Admin');
    }
    
    public function logout()
    {
        $user = new User($this->getDb());
        $user->logoutAdmin();
        header("Location: " . URL . '?ctl=Admin&act=login');
    }

    public function update($id)
    {        
        $user = new User($this->getDb());
        if (!isset($_POST['update'])) {
            $row = $user->find($id);
            require APP . 'view/backend/layouts/header.php';
            require APP . 'view/backend/layouts/left.php';
            require APP . 'view/backend/admin/update.php';
            require APP . 'view/backend/layouts/footer.php';
        }
        $data = $_POST;
        if ($user->find($id))
        $user->updateAdmin($data,$id);
        header("Location: " . URL . '?ctl=Admin&act=listUser');
    }

    public function create(){
        $user = new User($this->getDb());
        if (!isset($_POST['create'])) {
            require APP . 'view/backend/layouts/header.php';
            require APP . 'view/backend/layouts/left.php';
            require APP . 'view/backend/admin/create.php';
            require APP . 'view/backend/layouts/footer.php';
        }
        $data = $_POST;
        $user->create($data);
        header("Location: " . URL . '?ctl=Admin&act=listUser');
    }
    
    public function view($id){
        $user = new User($this->getDb());
        $row = $user->find($id);
        require APP . 'view/backend/layouts/header.php';
        require APP . 'view/backend/layouts/left.php';
        require APP . 'view/backend/admin/view.php';
        require APP . 'view/backend/layouts/footer.php';
    }
    
    public function listUser()
    {
        $user = new User($this->getDb());
        $rows = $user->all();
        require APP . 'view/backend/layouts/header.php';
        require APP . 'view/backend/layouts/left.php';
        require APP . 'view/backend/admin/listUser.php';
        require APP . 'view/backend/layouts/footer.php';
    }

    public function delete($id)
    {
        $user = new User($this->getDb());
        $user->delete($id);
        $rows = $user->all();
        require APP . 'view/backend/layouts/header.php';
        require APP . 'view/backend/layouts/left.php';
        require APP . 'view/backend/admin/listUser.php';
        require APP . 'view/backend/layouts/footer.php';
    }

    public  function search(){
        $user = new User($this->getDb());
        $rows = $user->search($_POST);
        require APP . 'view/backend/admin/table.php';
    }
    
}