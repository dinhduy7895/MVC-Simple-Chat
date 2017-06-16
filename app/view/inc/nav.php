<div class=" list-content col-lg-12">
    <?php
//    var_dump($userLists);
//    exit();
    $link = URL.'?ctl=Chat&act=direct&id=';
    foreach ($userLists as $key=>$userList) {
        if($userList['id'] == $_SESSION['id']) continue;
        if($userList['status'] == 1)
            echo "<div class='user online'><a href={$link}{$userList['id']}><span style='color: #4cae4c'>@ {$userList['username']}</span></a></div>";
        else
            echo "<div class='user ofline'><a href={$link}{$userList['id']}><span style='color:#a0a0a0'>@ {$userList['username']}</span></a></div>";
    }


    foreach ($roomLists as $key=>$roomList ){
        echo "<div class='user ofline'><a href='index.php?idRoom={$roomList['id']}'><span style='color:#a0a0a0'>@ {$roomList['name']}</span></a></div>";
    }
    ?>

</div>