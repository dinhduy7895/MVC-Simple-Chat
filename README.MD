Install
-Put all file in /var/www/html
-Import file SQL "Chat.SQL"
-Config virtual host by file simplechat.local
 +copy file simplechat.local into /etc/nginx/sites-available/
 	cmd line: sudo ln -s /etc/nginx/sites-available/simplechat.local  /etc/nginx/sites-enabled/
 	cmd line: sudo vim /etc/hosts
				+ add this line : "127.0.0.1 simplechat.local"
	cmd line: sudo service nginx restart			 

------------------------------------------------------------------
HOW TO RUN 
+ Public folder : simplechat.local/
+ Admin folder : simplechat.local/admin

username : admin
pass : admin
------------------------------------------------------------------
Features :
+ Messages Disappear after 15 seconds when you posted and seen (by focus on input )
+ when you do not focus on input, the messages will not start countdown and dissapear
+ when you have seen and posted, but you want to direct to the different page, the messages were still countdown and disspear
+ Chat Room: Can move scroll bar on top and load older messages
+ Direct to the different page without reload
+ See your profile and update avatar also your username 
+ Can use sticker when chat
+ Display notification when you have new messages 
