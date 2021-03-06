<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Simple chat Login Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel='stylesheet prefetch'
          href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="<?php echo URL;?>css/login.css">
</head>

<body>
<div class="pen-title">
    <h1>Simple Chat Login Form</h1>

    <div class="container">
        <div class="card"></div>
        <div class="card">
            <h1 class="title">Login</h1>
            <?php
            if (isset($_SESSION['error'])) {
                echo "<h1>" . $_SESSION['error'] . "</h1>";
                unset($_SESSION['error']);
            }
            ?>
            <form action=<?php echo URL.'User/signup'; ?> method="post">
                <div class="input-container">
                    <input type="text" name="username" required="required"/>
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
        <div class="card alt">
            <div class="toggle"></div>
            <h1 class="title">Register
                <div class="close"></div>
            </h1>
            <form action=<?php echo URL.'User/register' ;?> method="post">
                <div class="input-container">
                    <input type="text" name="username" required="required"/>
                    <label for="username">Username</label>
                    <div class="bar"></div>
                </div>

                <div class="input-container">
                    <input type="password" name="pass" required="required"/>
                    <label for="password">Password</label>
                    <div class="bar"></div>
                </div>

                <div class="input-container">
                    <input type="password" name="rePass" required="required"/>
                    <label for="passwordRe">Repeat Password</label>
                    <div class="bar"></div>
                </div>
                <div class="button-container">
                    <button type="submit" name="register"><span>Next</span></button>
                </div>
            </form>
        </div>
    </div>

    <script src="<?php echo URL;?>plugin/jquery-3.2.1.min.js"></script>
    <script src="<?php echo URL;?>plugin/login.js"></script>

</body>
</html>
