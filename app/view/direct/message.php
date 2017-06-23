<?php
if(is_numeric($messages)) return '';
foreach($messages as $r) {
    if ($r['username'] == $_SESSION['user']) echo "<li class='self'><span>00:{$r['time_post']}</span>";
    else echo "<li class='other'><span>00:{$r['time_receive']}</span>";
    $url = Image::getImage($r['avatar']);
               echo " <div class='wrapper-chat'> <div class='wrapper-mess'>
      <div class='avatar' ><img class='img-avatar' src='{$url}' draggable='false'/></div>
      <div class='msg' title='{$r['posted']}'>";
    $mess = $r['message'];
    Emojis::Smilify($mess);
    echo "  <p class='mess_content'>{$mess}</p> ";
    echo "    <time>{$r['posted']}</time>
      </div>
      </div>
     <div class='user-name'> {$r['username']} </div></div></li>";
}
