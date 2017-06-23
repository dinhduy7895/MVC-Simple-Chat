<?php $_SESSION['noti'] = 0 ;?>
<!DOCTYPE html>
<html>
<head>

    <link href="<?php  echo URL; ?>css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?php  echo URL; ?>font/css/font-awesome.min.css">
    <link href="<?php  echo URL; ?>css/chat.css" rel="stylesheet"/>
    <link href="<?php  echo URL; ?>css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="<?php  echo URL; ?>css/style.css" rel="stylesheet"/>
    <script src="<?php  echo PATH; ?>plugin/jquery-3.2.1.min.js"></script>
    <title>PHP Group Chat With jQuery & AJAX</title>
</head>
<body>
<div id="content container-full">
    <div class=" container">
        <div class="users col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <div class="container info-user">
                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 infor" >
                    <div class="avatar col-lg-6 col-xs-6 col-sm-6 col-md-6" style="padding: 0px;"><img class="img-responsive"
                                             src="<?php echo Image::getImage($_SESSION['avatar']); ?>" alt=""></div>
                    <div class="username col-lg-6 col-xs-6 col-sm-6 col-md-6" style="padding: 0px;"><span><?php echo $_SESSION['user']; ?></span></div>
</div>
<div class="dropdown col-lg-2 col-md-2 col-sm-2 col-xs-2 ">
    <i class="show-status fa fa-chevron-down" aria-hidden="true"
       style="cursor: pointer; padding-right: 1em;"></i>

</div>
</div>
<div id="myDropdown" class="container dropdown-content">
    <div class="wrapper-arrow">
        <i class="fa fa-sign-out" aria-hidden="true"></i>
        <a href="<?php echo URL.'User/logout'; ?>">Log Out</a>
    </div>
    <div class="wrapper-arrow">
        <i class="fa fa-upload" aria-hidden="true"></i>
        <a data-toggle="modal" data-target="#myModal">Upload Avatar</a>
    </div>
    <div class="wrapper-arrow">
        <i class="fa fa-upload" aria-hidden="true"></i>
        <a data-toggle="modal"  href="<?php echo URL.'User/show';?>">Information</a>
    </div>
</div>
<div class="container list-users">
    <?php require APP.'view/inc/nav.php'; ?>
</div>

<footer>
    Dinh Van Duy
</footer>
</div>
<div class="chatbox col-lg-10 col-md-10 col-sm-10 col-xs-10">