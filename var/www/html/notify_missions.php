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


	$sql_notify = "SELECT id, type, reward, status, field, sellPointPlaceableId, fruitTypeName, expectedLiters FROM missions WHERE notified='0'";
	$result_notify = $conn->query($sql_notify);
	if($result_notify->num_rows){
		while($row_notify = mysqli_fetch_all($result_notify, MYSQLI_ASSOC)){
			$notify_list[] = $row_notify;
			foreach($row_notify as $notify){
				$update_notify = "";
				echo "id: " . $notify["id"]. "<br>";
				echo "type: " . $notify["type"]. "<br>";
				echo "reward: " . $notify["reward"]. "<br>";
				echo "status: " . $notify["status"]. "<br>";
				echo "field: " . $notify["field"]. "<br>";
				echo "sellPointPlaceableId: " . $notify["sellPointPlaceableId"]. "<br>";
				echo "fruitTypeName: " . $notify["fruitTypeName"]. "<br>";
				echo "expectedLiters: " . $notify["expectedLiters"]. "<br>";

				if($notify["expectedLiters"] == NULL){
	                                $notify["expectedLiters"]='0';
                        	}

				if($notify["type"] == "fertilize" && $notify["status"] == "0" && $notify["reward"] >= 8000){
					echo"notified<br>";
					discordMsgSend("Mission: Düngen auf Feld " . $notify["field"] . " für " . $notify["reward"] . "€.", $webhook="https://discord.com/api/webhooks/$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$", $username="An-Bauer", $avatar_url="https://ic-cdn.flipboard.com/gamespot.com/0c06267f5375da5e4a509ef8bacf37fa1e8176a4/_small.jpeg");
					$update_notify = "UPDATE missions SET notified = '1' WHERE missions.id = '" . $notify["id"] . "';";
//Baumwolle
/*				}elseif($notify["type"] == "harvest" && $notify["status"] == "0" && $notify["fruitTypeName"] == "COTTON"){
                                        echo"notified<br>";
					discordMsgSend("Mission: " . $notify["expectedLiters"] . " Liter Baumwolle auf Feld " . $notify["field"] . " zur Spinnerei!", $webhook="https://discord.com/api/$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$", $username="An-Bauer", $avatar_url="https://ic-cdn.flipboard.com/gamespot.com/0c06267f5375da5e4a509ef8bacf37fa1e8176a4/_small.jpeg");
					$update_notify = "UPDATE missions SET notified = '1' WHERE missions.id = '" . $notify["id"] . "';";
*/
				}elseif($notify["type"] == "harvest" && $notify["status"] == "0" && $notify["sellPointPlaceableId"] == "34" && ($notify["fruitTypeName"] == "SORGHUM" || $notify["fruitTypeName"] == "WHEAT" || $notify["fruitTypeName"] == "OAT" || $notify["fruitTypeName"] == "BARLEY")){
					echo"notified<br>";
					discordMsgSend("Mission: Getreideernte auf Feld " . $notify["field"] . " zur Mühle!", $webhook="https://discord.com/api/webhooks/$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$", $username="An-Bauer", $avatar_url="https://ic-cdn.flipboard.com/gamespot.com/0c06267f5375da5e4a509ef8bacf37fa1e8176a4/_small.jpeg");
					$update_notify = "UPDATE missions SET notified = '1' WHERE missions.id = '" . $notify["id"] . "';";
/*				}elseif($notify["type"] == "cultivate" && $notify["status"] == "0" && ($notify["fruitTypeName"] == "SORGHUM" || $notify["fruitTypeName"] == "WHEAT" || $notify["fruitTypeName"] == "OAT" || $notify["fruitTypeName"] == "BARLEY")){
					echo"notified<br>";
//					discordMsgSend("Mission: Getreideanbau auf Feld " . $notify["field"], $webhook="https://discord.com/api/webhooks/$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$", $username="An-Bauer", $avatar_url="https://ic-cdn.flipboard.com/gamespot.com/0c06267f5375da5e4a509ef8bacf37fa1e8176a4/_small.jpeg");
					$update_notify = "UPDATE missions SET notified = '1' WHERE missions.id = '" . $notify["id"] . "';";
*/
				}else{
					echo"Auftrag nicht interessant oder bereits angenommen<br>";
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
