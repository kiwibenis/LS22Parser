<?php
	function ftpDownload($serverfile,$localfile){
		$ftp_server = "";
		$ftp_port = "";
		$ftp_username = "";
		$ftp_userpass = "";
		$ftp_timeout = "15";
		$localfile = "/var/www/html/data/" . $localfile;
		$serverfile = "/profile/savegame2/" . $serverfile;

		$ftp_connection = ftp_connect($ftp_server, $ftp_port, $ftp_timeout) or die("Could not connect to $ftp_server");

		if($ftp_connection){
			$login = ftp_login($ftp_connection, $ftp_username, $ftp_userpass);
			if($login){
				ftp_pasv($ftp_connection, true);
				if(ftp_get($ftp_connection, $localfile, $serverfile, FTP_BINARY)){
					echo"<br>Successfully downloaded from " . $serverfile . " to " . $localfile . ".<br>";
					echo"############################################<br>";
				}else{
					echo"<br>Error while downloading from " . $serverfile . " to " . $localfile . ".<br>";
					echo"############################################<br>";
				}
			}else{
				die("login failed!");
			}
			ftp_close($ftp_connection);
		}else{
			die("no connection to server.");
		}
	}
?>
