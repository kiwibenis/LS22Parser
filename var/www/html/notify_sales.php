<?php
	require_once('config/db_connect.php');
	require_once('include/notify.php');

	if(!isset($conn)){
		echo"notify-script is running in manual mode.<br>";
		echo"############################################<br>";
		$conn = OpenSQLConnection();
		$manualconn=1;
	}else{
		echo"notify-script is running in automatic mode.<br>";
		echo"############################################<br>";
		$manualconn=0;
	}


	$sql_notify = "SELECT id, xmlFilename, age, price, damage, operatingTime FROM sales WHERE notified='0'";
	$result_notify = $conn->query($sql_notify);
	if($result_notify->num_rows){
		while($row_notify = mysqli_fetch_all($result_notify, MYSQLI_ASSOC)){
			$notify_list[] = $row_notify;
			foreach($row_notify as $notify){
				$update_notify = "";
				echo "id: " . $notify["id"]. "<br>";
				echo "xmlFilename: " . $notify["xmlFilename"]. "<br>";
				echo "age: " . $notify["age"]. "<br>";
				echo "price: " . $notify["price"]. "<br>";
				echo "damage: " . $notify["damage"]. "<br>";
				echo "operatingTime: " . $notify["operatingTime"]. "<br>";

				if($notify["age"] <= "10" && $notify["price"] <= "5000"){
					echo"notified<br>";
					discordMsgSend("Sales: " . $notify["xmlFilename"] . " für " . $notify["price"]. "€ mit " . $notify["age"] . " Betriebsstunden.", $webhook="https://discord.com/api/webhooks/$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$", $username="Honest Achmed - used cars and trailers", $avatar_url="https://buildpriceoption.com/wp-content/uploads/2018/11/used-car-salesman-tricks.jpg");
					$update_notify = "UPDATE sales SET notified = '1' WHERE sales.id = '" . $notify["id"] . "';";
				}else{
					echo"Verkaufter gegenstand nicht interessant<br>";
				}

				echo"############################################<br>";
				if(isset($update_notify) && !empty($update_notify)){
					if($conn->query($update_notify) === TRUE){
						echo"update successful.<br>";
						echo"############################################<br>";
					}else{
						echo"update failed.<br>";
						echo"############################################<br>";
					}
				}
			}
		}
	}else{
		echo "No records found";
	}

	if($manualconn){
		echo"manual closing connection.<br>";
		echo"############################################<br>";
		CloseSQLConnection($conn);
	}else{
		echo"automatic closing connection.<br>";
		echo"############################################<br>";
	}
?>
