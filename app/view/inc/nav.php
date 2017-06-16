<div class=" list-content col-lg-12">
    <?php
//    var_dump($userLists);
//    exit();
    $link = URL.'?ctl=Direct&act=chat&id=';
    foreach ($userLists as $key=>$userList) {
        if($userList['id'] == $_SESSION['id']) continue;
        $class="";
        if('http:'.$link.$userList['id'] == $_SERVER['HTTP_REFERER']) $class='current';
        if($userList['status'] == 1)
            echo "<div class='user online {$class}'><a href={$link}{$userList['id']}><span style='color: #4cae4c'>@ {$userList['username']}</span></a></div>";

        else
            echo "<div class='user ofline {$class}'><a href={$link}{$userList['id']}><span style='color:#a0a0a0'>@ {$userList['username']}</span></a></div>";

    }

    $link = URL.'?ctl=Room&act=chat&id=';

    foreach ($roomLists as $key=>$roomList ){

        echo "<div class='user ofline'><a href='{$link}{$roomList['id']}'><span style='color:#a0a0a0'>@ {$roomList['name']}</span></a></div>";
    }
    ?>

</div>