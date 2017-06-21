<?php

class User extends Model
{
    function signup($data)
    {
        $db = $this->getDb();
        $username = htmlspecialchars($data['username']);
        $pass = $data['password'];
        $stmt = $db->prepare("SELECT * FROM user WHERE username=:Name AND password=:Pass");
        $stmt->bindparam(":Name", $username);
        $stmt->bindparam(":Pass", $pass);
        $stmt->execute();
        if ($stmt->rowCount() == 0) {
            $_SESSION['error'] = "username hoac mat khau khong dung";
            return false;
        } else {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['user'] = $row['username'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['avatar'] = $row['avatar'];
            $sql = $db->prepare("UPDATE user SET status=1 WHERE id=?");
            $sql->execute(array($_SESSION['id']));
            return true;
        }
    }

    function signupAdmin($data)
    {
        $db = $this->getDb();
        $username = htmlspecialchars($data['username']);
        $pass = $data['password'];
        $stmt = $db->prepare("SELECT * FROM user WHERE username=:Name AND password=:Pass AND role = 1");
        $stmt->bindparam(":Name", $username);
        $stmt->bindparam(":Pass", $pass);
        $stmt->execute();
        if ($stmt->rowCount() == 0) {
            $_SESSION['error'] = "You do not have permission";
            return false;
        } else {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['admin'] = $row['username'];
            $_SESSION['idAdmin'] = $row['id'];
            $_SESSION['avatarAdmin'] = $row['avatar'];
            return true;
        }
    }
    
    function register($data)
    {
        $db = $this->getDb();
        $username = $data['username'];
        $pass = $data['pass'];
        $rePass = $data['rePass'];
        $reset = null;
        if ($pass != $rePass) {
            $_SESSION['error'] = "Password khong khop";
            return false;
        } else {
            $sql = "SELECT * FROM user WHERE username=:Name";
            $stmt = $db->prepare($sql);
            $stmt->bindparam(":Name", $username);
            $stmt->execute();
            if ($stmt->rowCount() == 0) {
                $stmt1 = $db->prepare("INSERT INTO user(username, password, seen,status) VALUES (:username,:password,NOW(),1)");
                $stmt1->bindparam(":username", $username);
                $stmt1->bindparam(":password", $pass);
                $stmt1->execute();
                if ($stmt1) {
                    $_SESSION['user'] = $username;
                    $_SESSION['id'] = $db->lastInsertId();
                    $sql = "SELECT * FROM user ORDER BY id DESC LIMIT 1";
                    $stmt = $db->prepare($sql);
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $_SESSION['avatar'] = $row['avatar'];
                    return true;
                } else {
                    $_SESSION['error'] = "input khong hop le";
                    return false;
                }
            } else if ($stmt->rowCount() > 0) {
                $_SESSION['error'] = "Username da ton tai";
                return false;

            }
        }
    }

    function logout()
    {
        $db = $this->getDb();
        $sql = $db->prepare("UPDATE user SET status=0 WHERE id=?");
        $sql->execute(array($_SESSION['id']));
        session_destroy();
    }

    function find($id)
    {
        $db = $this->getDb();
        $sql = $db->prepare("SELECT user.* FROM user  WHERE id=?");
        $sql->execute(array($id));
        if($sql->rowCount() == 0) return false;
        return $sql->fetch();
    }

    function update($data,$id )
    {
        
        $db = $this->getDb();
        $username = $data['username'];
        $sql = "UPDATE  user SET username=? WHERE id = ?";
        $stmt = $db->prepare($sql);
        if ($stmt->execute(array($username, $id)) == false) {
            $_SESSION['error'] = "update khong hop le";
            return false;
        }
        $_SESSION['user'] = $username;
        return true;
    }

    function updateAdmin($data,$id )
    {

        $db = $this->getDb();
        $username = $data['username'];
        $role = $data['role'];
        $sql = "UPDATE  user SET username=? , role = ? WHERE id = ?";
        $stmt = $db->prepare($sql);
        if ($stmt->execute(array($username, $role, $id)) == false) {
            $_SESSION['error'] = "update khong hop le";
            return false;
        }
        return true;
    }
    
    function changePassword($data)
    {

        $db = $this->getDb();
        $pass = $data['pass'];
        $sql = $db->prepare("SELECT id FROM user WHERE username = ? and password = ?");
        $sql->execute(array($_SESSION['user'], $pass));
        if ($sql->rowCount() == 0) {
            return false;
        }
        $newPass = $data['newPass'];
        $rePass = $data['rePass'];
        if ($rePass != $newPass) {
            $_SESSION['error'] = "Password khong khop";
            return false;
        } else {
            $stmt1 = $db->prepare("UPDATE  user SET  password = ? WHERE  id = ? ");
            $stmt1->execute(array($newPass, $_SESSION['id']));
        }
        return true;
    }

    function changeAvatar($data)
    {
        $db = $this->getDb();
        $image = $data['image']['name'];
        Image::upload($_FILES['image']);
        $sql = $db->prepare("UPDATE user SET avatar=? WHERE id=?");
        if ($sql->execute(array($image, $_SESSION['id'])) == false) {
            $_SESSION['error'] = "Update Avatar khong hop le";
            return false;
        }
        $_SESSION['avatar'] = $image;
        return true;
    }
    
 
    function join($id)
    {
        $db = $this->getDb();
        $sql = $db->prepare("INSERT INTO user_room (`user_id`, `room_id`) VALUES (?,?)");
        $sql->execute(array($_SESSION['id'], $id));
    }

    function all(){
        $db = $this->getDb();
        $sql = $db->prepare("SELECT user.id, user.username, user.role, user.status FROM user ");
        $sql->execute();
        return $sql->fetchAll();
    }

    function delete($id){
        $db = $this->getDb();
        $sql = $db->prepare("DELETE FROM user WHERE id = ?");
        $sql->execute(array($id));
    }

    function create($data)
    {
        $db = $this->getDb();
        $username = $data['username'];
        $pass = $data['pass'];
        $rePass = $data['rePass'];
        $role = $data['role'];
        $reset = null;
        if ($pass != $rePass) {
            $_SESSION['error'] = "Password khong khop";
            return false;
        } else {
            $sql = "SELECT * FROM user WHERE username=:Name";
            $stmt = $db->prepare($sql);
            $stmt->bindparam(":Name", $username);
            $stmt->execute();
            if ($stmt->rowCount() == 0) {
                $stmt1 = $db->prepare("INSERT INTO user(username, password, seen,status, role) VALUES (:username,:password,NOW(),1, :role)");
                $stmt1->bindparam(":username", $username);
                $stmt1->bindparam(":password", $pass);
                $stmt1->bindparam(":role", $role);
                $stmt1->execute();
            } else if ($stmt->rowCount() > 0) {
                $_SESSION['error'] = "Username da ton tai";
                return false;
            }
        }
    }

    function search($data){
        $db = $this->getDb();
        $username = $data['username'];
        $status = $data['status'];
        $role = $data['role'];
        $id = $data['id'];
        $sql ="SELECT user.id, user.username, user.role, user.status FROM user WHERE username LIKE '%$username%'";
        if(is_numeric($id)){
            $sql.=" AND id = $id";
        }
        if(is_numeric($status)){
            $sql.=" AND status = $status";
        }
        if(is_numeric($role)){
            $sql.=" AND role = $role";
        }

        $sql = $db->prepare($sql);
        $sql->execute();
        return $sql->fetchAll();
    }

    function logoutAdmin()
    {
        session_destroy();
    }
}