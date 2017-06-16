<div class="menu">
    <i class="fa fa-star-o favourite" aria-hidden="true"></i>
    <i class="fa fa-hashtag hastgtag" aria-hidden="true"></i>
    <div class="name text-center"> <?php echo $receiver; ?></div>
</div>
<ol class='chat msgs'>
    <div class="msg" title="<?php echo time(); ?>"  style="display: none"></div>
    <?php
        if($new == true)require APP.'view/room/join.php';
        else         require APP.'view/room/message.php';
    ?>
</ol>
<form id="msg_form">
    <input class="textarea" type="text" placeholder="Type here!"/></div>
</form>