# LS22Parser
Savegame parser for LS22 / Farming Simulator 22

# LS22Parser parses savegame-files from Farming Simulator 22 or "Landwirtschaftssimulator 22", puts relevant data in SQL-Database, makes queries on these datas and can send notofications based on them.

It's a non professional project with only a minimum of security mechanisms in it as for now. 

Install:
1. setup a webserver with php, SQL and phpmyadmin
2. copy all files from "/var/www/html/" into the webserver root directory
3. import ls22db.sql into your database, you can use phpmyadmin for this
4. make directory "data" writeable for the user running the script
5. edit the /config/db_connect.php
6. edit the /include/ftpdownloader.php - this config works for gportal-LS22 Server
7. edit the /include/notify.php near the "$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$" -> place your discord webhook URL here and maybe edit the default Bot-Name
8. repeat this for all following files: import_economy.php, import_farms.php, import_missions.php, import_sales.php, notify_missions.php, notify_sales.php by making search and replace for "$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$"
9. activate automatic data pulling via crontab or by manualy launching downloader.php -> you can take a crontab example from "crontab"

What is "switchtowwwdata.sh" for? if you login as a non-root user into the system you can switch with this into the bash of www-data user. You can do it manually of yourse but I cannot remember the command for it so I wrote these 2 lines
