<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Tour Manager Login Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="<?php  echo PATH; ?>plugins/myCss/login.css">
</head>
<body>
<div class="pen-title">
    <h1>Tour  Manager Login Form</h1>
    <div class="container">
        <div class="card"></div>
        <div class="card">
            <h1 class="title">Login</h1>
            <?php
            if(isset($_GET['mess'])){
                echo "<h1>".$_GET['mess']."</h1>";
            }
            ?>
            <form action="<?php echo URL.'?ctl=Admin&act=signup';?>" method="post">
                <div class="input-container">
                    <input type="text"  name="username" required="required"/>
                    <label for="username">Username</label>
                    <div class="bar"></div>
                </div>
                <div class="input-container">
                    <input type="password" name="password" required="required"/>
                    <label for="password">Password</label>
                    <div class="bar"></div>
                </div>
                <div class="button-container">
                    <button type="submit" name="submit"><span>Go</span></button>
                </div>
                <div class="footer"><a href="#">Forgot your password?</a></div>
            </form>
        </div>
    </div>
    <script src="<?php  echo PATH; ?>plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="<?php  echo PATH; ?>plugins/myJs/login.js"></script>
</body>
</html>
