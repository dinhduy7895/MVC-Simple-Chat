<?php
foreach($messages as $r) {
    if ($r['username'] == $_SESSION['user']) echo "<li class='self'>";
    else echo "<li class='other'>";
    $url = Image::getImage($r['avatar']);

    echo " <div class='wrapper-mess'>
      <div class='avatar' ><img src='{$url}' draggable='false'/></div>
      <div class='msg' title='{$r['posted']}'>
        <p>{$r['message']}</p>
        <time>{$r['posted']}</time>
      </div>
      </div>
      <div class='user-name'> {$r['username']} </div> ";
}