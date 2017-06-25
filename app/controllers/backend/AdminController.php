<?php
include APP . 'model/User.php';
//include APP . 'controllers/backend/BaseController.php';

class AdminController extends BaseController
{

    public function index()
    {
        $this->render('admin/index');
    }

    public function login()
    {
        require APP . 'view/backend/admin/login.php';
    }

    public function signup()
    {

        $user = new User();
        if (isset($_POST['submit'])) {

           $signup = $user->signupAdmin($_POST);
            if($signup)
                $this->route('Admin');
        }
        $this->route('Admin');
    }

    public function logout()
    {
        $user = new User();
        $user->logoutAdmin();
        $this->route('Admin/login');
    }

    public function update($id)
    {
        $user = new User();
        if (!isset($_POST['update'])) {
            $row = $user->find($id);
            $this->render('admin/update', [
                'row' => $row
            ]);
        }
        $data = $_POST;
        if ($user->find($id))
            $user->updateAdmin($data, $id);
        $this->route('Admin/listUser');
    }

    public function create()
    {
        $user = new User();
        if (!isset($_POST['create'])) {
            $this->render('admin/create');

        }
        $data = $_POST;
        $user->create($data);
        $this->route('Admin/listUser');
    }

    public function view($id)
    {
        $user = new User();
        $row = $user->find($id);
        $this->render('admin/view', [
            'row' => $row
        ]);
    }

    public function listUser()
    {
        $user = new User();
        $rows = $user->all();
        $this->render('admin/listUser', [
            'rows' => $rows
        ]);
    }

    public function delete($id)
    {
        $user = new User();
        $user->delete($id);
        $rows = $user->all();
        $user = new User();
        $rows = $user->all();
        $this->render('admin/listUser', [
            'rows' => $rows
        ]);
    }

    public function search()
    {
        $user = new User();
        $rows = $user->search($_POST);
        require APP . 'view/backend/admin/table.php';
    }

}