<?php
foreach($messages as $r) {
    if ($r['username'] == $_SESSION['user']) echo "<li class='self'>";
    else echo "<li class='other'>";
    $url = Image::getImage($r['avatar']);
    echo "<span>00:0{$r['time_post']}</span>";

    echo " <div class='wrapper-chat'> <div class='wrapper-mess'>
      <div class='avatar' ><img class='img-avatar' src='{$url}' draggable='false'/></div>
      <div class='msg' title='{$r['posted']}'>";
    $mess = $r['message'];
    Emojis::Smilify($mess);
    echo "  <p class='mess_content'>{$mess}</p> ";
    echo "    <time>{$r['posted']}</time>
      </div>
      </div>
      </div><div class='user-name'> {$r['username']} </div> </li>";
}
