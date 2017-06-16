<?php
class User extends Model{


    function signup($data){

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

    function register($data){
        $db = $this->getDb();
        $username = $data['username'];
        $pass = $data['pass'];
        $rePass = $data['rePass'];
        $reset = null;
        if ($pass != $rePass) {
            $_SESSION['error'] = "Password khong khop";
            return false;
        }
        else {
            $sql = "SELECT * FROM user WHERE username=:Name";
            $stmt = $db->prepare($sql);
            $stmt->bindparam(":Name", $username);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

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
    
    function logout(){
        $db = $this->getDb();
        $sql = $db->prepare("UPDATE user SET status=0 WHERE id=?");
        $sql->execute(array($_SESSION['id']));
        session_destroy();
    }
    function show(){
        $db = $this->getDb();
        $sql = $db->prepare("SELECT user.* FROM user  WHERE id=?");
        $sql->execute(array($_SESSION['id']));
        return $sql->fetch();
    }
    function find($id){
        $db = $this->getDb();
        $sql = $db->prepare("SELECT user.* FROM user  WHERE id=?");
        $sql->execute(array($_SESSION['id']));
        return $sql->fetch();
    }
    function update($data){
        $db = $this->getDb();

        $username = $data['username'];
        $pass = $data['pass'];
        $sql = "UPDATE  user SET username=?, password = ? WHERE id = ?";
        $stmt = $db->prepare($sql);
        if( $stmt->execute(array($username,$pass,$_SESSION['id'])) == false ){
            $_SESSION['error'] = "update khong hop le";
            return false;
        }
       return true;
    }
    function changeAvatar($data){
        $db = $this->getDb();
        $image = $data['image']['name'];
        Image::upload($_FILES['image']);
        $sql = $db->prepare("UPDATE user SET avatar=? WHERE id=?");
        if($sql->execute(array($image,$_SESSION['id'])) == false ){
            $_SESSION['error'] = "Update Avatar khong hop le";
            return false;
        }
        $_SESSION['avatar'] = $image;
       return true;
    }

}