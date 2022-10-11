<?php
require_once('config/db_connect.php');
require_once('include/notify.php');

if(!isset($conn)){
	echo"import-script is running in manual mode.<br>";
	echo"############################################<br>";
	$conn = OpenSQLConnection();
	$manualconn=1;
}else{
        echo"import-script is running in automatic mode.<br>";
        echo"############################################<br>";
	$manualconn=0;
}

$filename = 'data/missions.xml';
if(file_exists($filename)){
	$xml = simplexml_load_file($filename);
	if($xml){
		$leeren = "TRUNCATE ls22db.missions";
		if (!$conn->query($leeren) === TRUE){
			echo"Error: " . $leeren . "<br>" . $conn->error;
		}
		$num = "0";
		$err = "0";
		foreach ($xml->mission as $mission){
			$num++;
			$type{$num} = $mission['type'];
			$reward{$num} = $mission['reward'];
			$status{$num} = $mission['status'];
			$success{$num} = $mission['success'];
			$farmId{$num} = $mission['farmId'];
			$field{$num} = $mission->field['id'];
			$fruitTypeName{$num} = $mission->field['fruitTypeName'];
			$sowfruitTypeName{$num} = $mission->sow['fruitTypeName'];
			$sellPointPlaceableId{$num} = $mission->harvest['sellPointPlaceableId'];
			$expectedLiters{$num} = $mission->harvest['expectedLiters'];
			$depositedLiters{$num} = $mission->harvest['depositedLiters'];
			$missionhash{$num} = hash('sha256', $type{$num}.$reward{$num}.$field{$num});

	                if($farmId{$num} == NULL){
        	                $farmId{$num}='0';
                	}
                        if($sowfruitTypeName{$num} != NULL){
                                $fruitTypeName{$num}=$sowfruitTypeName{$num};
                        }
                        if($sellPointPlaceableId{$num} == NULL){
                                $sellPointPlaceableId{$num}='0';
                        }
                        if($expectedLiters{$num} == NULL){
                                $expectedLiters{$num}='0';
                        }
                        if($depositedLiters{$num} == NULL){
                                $depositedLiters{$num}='0';
                        }

                        echo"type: " . $type{$num} . "<br>";
                        echo"reward: " . $reward{$num} . "<br>";
                        echo"status: " . $status{$num} . "<br>";
                        echo"success: " . $success{$num} . "<br>";
                        echo"farmId: " . $farmId{$num} . "<br>";
                        echo"field: " . $field{$num} . "<br>";
                        echo"fruitTypeName: " . $fruitTypeName{$num} . "<br>";
                        echo"sellPointPlaceableId: " . $sellPointPlaceableId{$num} . "<br>";
                        echo"expectedLiters: " . $expectedLiters{$num} . "<br>";
                        echo"depositedLiters: " . $depositedLiters{$num} . "<br>";
                        echo"missionhash: " . $missionhash{$num} . "<br>";

                        $abfrage = "INSERT INTO missions (hash, type, reward, status, success, farmId, field, fruitTypeName, sellPointPlaceableId, expectedLiters, depositedLiters) VALUES ('".$missionhash{$num}."', '".$type{$num}."', '".$reward{$num}."', '".$status{$num}."', '".$success{$num}."', '".$farmId{$num}."', '".$field{$num}."', '".$fruitTypeName{$num}."', '".$sellPointPlaceableId{$num}."', '".$expectedLiters{$num}."', '".$depositedLiters{$num}."')";
       	                if(!$conn->query($abfrage) === TRUE){
				$err++;
                       	}
		}
		if($err == "0"){
			echo"import finished successfull.<br>";
			echo"############################################<br>";
			require_once('notify_missions.php');
		}else{
			echo $err . " error(s) occoured.<br>";
			echo"############################################<br>";
			discordMsgSend("Miau, da hat der Fendt wohl " . $err . " kleine Katzen überfahren beim Import der Missionen", $webhook="https://discord.com/api/webhooks/$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$", $username="Platter Reifen", $avatar_url="https://icon-library.com/images/failed-icon/failed-icon-8.jpg");
		}
	}
}else{
	echo"file $filename not found.<br>";
	echo"############################################<br>";
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
