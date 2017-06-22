<div class="chatbox-wrapper">
Update your Username
<form action="<?php echo URL.'User/update' ;?>" method="post">
   Username: <input type="text" name="username" value="<?php echo $_SESSION['user'];?>">
    <input type="submit" name="update">
</form>
<hr>

Change your Password
<form action="<?php echo URL.'User/changePassword' ;?>" method="post">
   Password <input type="password" name="pass" >
    New Password : <input type="password" name="newPass" >
    Confirm Password : <input type="password" name="rePass" >

    <input type="submit" name="update">
</form>
    </div>