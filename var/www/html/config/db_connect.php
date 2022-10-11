<?php
	function OpenSQLConnection(){
		$dbhost = "";
		$dbuser = "";
		$dbpass = "";
		$db = "";

		$conn = @new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);

		if($conn->connect_error) {
			die("Connection to database failed.");
		}else{
			return $conn;
		}
	}

	function CloseSQLConnection($conn){
		$conn -> close();
	}
?>
