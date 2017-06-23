<div class="chatbox-wrapper">
    <div class="menu">
        <i class="fa fa-star-o favourite" aria-hidden="true"></i>
        <i class="fa fa-hashtag hastgtag" aria-hidden="true"></i>
        <div class="name text-center"> <?php echo $receiver; ?></div>
    </div>
    <ol class='chat msgs'>
        <li style="position: absolute;

    left: 50%;
    top: 7%;"><img id="loader" src="<?php echo Image::getImage('show.gif'); ?> " style="width: 50px; height: 50px;" /></li>
        <div class="msg" title="<?php echo time(); ?>"  style="display: none"></div>
        <?php
        if($new == 'true')require APP.'view/room/join.php';
        else         require APP.'view/room/message.php';
        ?>
    </ol>
</div>
<!--<form id="msg_form">-->
<!--    <input class="textarea" type="text" placeholder="Type here!"/>-->
<!--</form>-->