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

$filename = 'data/farms.xml';
if(file_exists($filename)){
	$xml = simplexml_load_file($filename);
	if($xml){

                $leeren = "TRUNCATE ls22db.farms";
                if (!$conn->query($leeren) === TRUE){
                        echo"Error: " . $leeren . "<br>" . $conn->error;
                }

                $leeren = "TRUNCATE ls22db.players";
                if (!$conn->query($leeren) === TRUE){
	                echo"Error: " . $leeren . "<br>" . $conn->error;
		}

                $leeren = "TRUNCATE ls22db.contracting";
                if (!$conn->query($leeren) === TRUE){
                        echo"Error: " . $leeren . "<br>" . $conn->error;
                }

                $leeren = "TRUNCATE ls22db.handtools";
                if (!$conn->query($leeren) === TRUE){
                        echo"Error: " . $leeren . "<br>" . $conn->error;
                }

		$num = "0";
		$err = "0";
		foreach ($xml->farm as $farm){
			$num++;
			$farmId{$num} = $farm['farmId'];
			$name{$num} = $farm['name'];
			$color{$num} = $farm['color'];
			$password{$num} = $farm['password'];
			$loan{$num} = $farm['loan'];
			$money{$num} = $farm['money'];
			$stattraveldistance{$num} = $farm->statistics->traveledDistance;
			$statfuelUsage{$num} = $farm->statistics->fuelUsage;
			$statseedUsage{$num} = $farm->statistics->seedUsage;
			$statsprayUsage{$num} = $farm->statistics->sprayUsage;
			$statworkedHectares{$num} = $farm->statistics->workedHectares;
			$statcultivatedHectares{$num} = $farm->statistics->cultivatedHectares;
			$statsownHectares{$num} = $farm->statistics->sownHectares;
			$statsprayedHectares{$num} = $farm->statistics->sprayedHectares;
			$statthreshedHectares{$num} = $farm->statistics->threshedHectares;
			$statplowedHectares{$num} = $farm->statistics->plowedHectares;
			$statharvestedGrapes{$num} = $farm->statistics->harvestedGrapes;
			$statharvestedOlives{$num} = $farm->statistics->harvestedOlives;
			$statworkedTime{$num} = $farm->statistics->workedTime;
			$statcultivatedTime{$num} = $farm->statistics->cultivatedTime;
			$statsownTime{$num} = $farm->statistics->sownTime;
			$statsprayedTime{$num} = $farm->statistics->sprayedTime;
			$statthreshedTime{$num} = $farm->statistics->threshedTime;
			$statplowedTime{$num} = $farm->statistics->plowedTime;
			$statbaleCount{$num} = $farm->statistics->baleCount;
			$statbreedCowsCount{$num} = $farm->statistics->breedCowsCount;
			$statbreedSheepCount{$num} = $farm->statistics->breedSheepCount;
			$statbreedPigsCount{$num} = $farm->statistics->breedPigsCount;
			$statbreedChickenCount{$num} = $farm->statistics->breedChickenCount;
			$statbreedHorsesCount{$num} = $farm->statistics->breedHorsesCount;
			$statfieldJobMissionCount{$num} = $farm->statistics->fieldJobMissionCount;
			$statfieldJobMissionByNPC{$num} = $farm->statistics->fieldJobMissionByNPC;
			$stattransportMissionCount{$num} = $farm->statistics->transportMissionCount;
			$statrevenue{$num} = $farm->statistics->revenue;
			$statexpenses{$num} = $farm->statistics->expenses;
			$statplayTime{$num} = $farm->statistics->playTime;
			$statplantedTreeCount{$num} = $farm->statistics->plantedTreeCount;
			$statcutTreeCount{$num} = $farm->statistics->cutTreeCount;
			$statwoodTonsSold{$num} = $farm->statistics->woodTonsSold;
			$stattreeTypesCut{$num} = $farm->statistics->treeTypesCut;
			$statpetDogCount{$num} = $farm->statistics->petDogCount;
			$statrepairVehicleCount{$num} = $farm->statistics->repairVehicleCount;
			$statrepaintVehicleCount{$num} = $farm->statistics->repaintVehicleCount;
			$stathorseJumpCount{$num} = $farm->statistics->horseJumpCount;
			$statsoldCottonBales{$num} = $farm->statistics->soldCottonBales;
			$statwrappedBales{$num} = $farm->statistics->wrappedBales;
			$stattractorDistance{$num} = $farm->statistics->tractorDistance;
			$statcarDistance{$num} = $farm->statistics->carDistance;
			$stattruckDistance{$num} = $farm->statistics->truckDistance;
			$stathorseDistance{$num} = $farm->statistics->horseDistance;

			echo"farmId:" . $farmId{$num} . "<br>";
			echo"name:" . $name{$num} . "<br>";
			echo"color:" . $color{$num} . "<br>";
			echo"password:" . $password{$num} . "<br>";
			echo"loan:" . $loan{$num} . "<br>";
			echo"money:" . $money{$num} . "<br>";
			echo"traveledDistance:" . $stattraveldistance{$num} . "<br>";
			echo"fuelUsage:" . $stattraveldistance{$num} . "<br>";
			echo"seedUsage:" . $statseedUsage{$num} . "<br>";
			echo"sprayUsage:" . $statsprayUsage{$num} . "<br>";
			echo"workedHectares:" . $statworkedHectares{$num} . "<br>";
			echo"cultivatedHectares:" . $statcultivatedHectares{$num} . "<br>";
			echo"sownHectares:" . $statsownHectares{$num} . "<br>";
			echo"sprayedHectares:" . $statsprayedHectares{$num} . "<br>";
			echo"threshedHectares:" . $statthreshedHectares{$num} . "<br>";
			echo"plowedHectares:" . $statplowedHectares{$num} . "<br>";
			echo"harvestedGrapes:" . $statharvestedGrapes{$num} . "<br>";
			echo"harvestedOlives:" . $statharvestedOlives{$num} . "<br>";
			echo"workedTime:" . $statworkedTime{$num} . "<br>";
			echo"cultivatedTime:" . $statcultivatedTime{$num} . "<br>";
			echo"sownTime:" . $statsownTime{$num} . "<br>";
			echo"sprayedTime:" . $statsprayedTime{$num} . "<br>";
			echo"threshedTime:" . $statthreshedTime{$num} . "<br>";
			echo"plowedTime:" . $statplowedTime{$num} . "<br>";
			echo"baleCount:" . $statbaleCount{$num} . "<br>";
			echo"breedCowsCount:" . $statbreedCowsCount{$num} . "<br>";
			echo"breedSheepCount:" . $statbreedSheepCount{$num} . "<br>";
			echo"breedPigsCount:" . $statbreedPigsCount{$num} . "<br>";
			echo"breedChickenCount:" . $statbreedChickenCount{$num} . "<br>";
			echo"breedHorsesCount:" . $statbreedHorsesCount{$num} . "<br>";
			echo"fieldJobMissionCount:" . $statfieldJobMissionCount{$num} . "<br>";
			echo"fieldJobMissionByNPC:" . $statfieldJobMissionByNPC{$num} . "<br>";
			echo"transportMissionCount:" . $stattransportMissionCount{$num} . "<br>";
			echo"revenue:" . $statrevenue{$num} . "<br>";
			echo"expenses:" . $statexpenses{$num} . "<br>";
			echo"playTime:" . $statplayTime{$num} . "<br>";
			echo"plantedTreeCount:" . $statplantedTreeCount{$num} . "<br>";
			echo"cutTreeCount:" . $statcutTreeCount{$num} . "<br>";
			echo"woodTonsSold:" . $statwoodTonsSold{$num} . "<br>";
			echo"treeTypesCut:" . $stattreeTypesCut{$num} . "<br>";
			echo"petDogCount:" . $statpetDogCount{$num} . "<br>";
			echo"repairVehicleCount:" . $statrepairVehicleCount{$num} . "<br>";
			echo"repaintVehicleCount:" . $statrepaintVehicleCount{$num} . "<br>";
			echo"horseJumpCount:" . $stathorseJumpCount{$num} . "<br>";
			echo"soldCottonBales:" . $statsoldCottonBales{$num} . "<br>";
			echo"wrappedBales:" . $statwrappedBales{$num} . "<br>";
			echo"tractorDistance:" . $stattractorDistance{$num} . "<br>";
			echo"carDistance:" . $statcarDistance{$num} . "<br>";
			echo"truckDistance:" . $stattruckDistance{$num} . "<br>";
			echo"horseDistance:" . $stathorseDistance{$num} . "<br>";
                        echo"############################################<br>";
			$num1 = "0";
			$num2 = "0";
			$num3 = "0";
			$num4 = "0";
			$num5 = "0";

                        $abfrage = "INSERT INTO farms (farmId, name, color, password, loan, money, traveledDistance, fuelUsage, seedUsage, sprayUsage, workedHectares, cultivatedHectares, sownHectares, sprayedHectares, threshedHectares, plowedHectares, harvestedGrapes, harvestedOlives, workedTime, cultivatedTime, sownTime, sprayedTime, threshedTime, plowedTime, baleCount, breedCowsCount, breedSheepCount, breedPigsCount, breedChickenCount, breedHorsesCount, fieldJobMissionCount, fieldJobMissionByNPC, transportMissionCount, revenue, expenses, playTime, plantedTreeCount, cutTreeCount, woodTonsSold, treeTypesCut, petDogCount, repairVehicleCount, repaintVehicleCount, horseJumpCount, soldCottonBales, wrappedBales, tractorDistance, carDistance, truckDistance, horseDistance) VALUES ('".$farmId{$num}."', '".$name{$num}."', '".$color{$num}."','".$password{$num}."','".$loan{$num}."','".$money{$num}."','".$stattraveldistance{$num}."','".$stattraveldistance{$num}."','".$statseedUsage{$num}."','".$statsprayUsage{$num}."','".$statworkedHectares{$num}."','".$statcultivatedHectares{$num}."','".$statsownHectares{$num}."','".$statsprayedHectares{$num}."','".$statthreshedHectares{$num}."','".$statplowedHectares{$num}."','".$statharvestedGrapes{$num}."','".$statharvestedOlives{$num}."','".$statworkedTime{$num}."','".$statcultivatedTime{$num}."','".$statsownTime{$num}."','".$statsprayedTime{$num}."','".$statthreshedTime{$num}."','".$statplowedTime{$num}."','".$statbaleCount{$num}."','".$statbreedCowsCount{$num}."','".$statbreedSheepCount{$num}."','".$statbreedPigsCount{$num}."','".$statbreedChickenCount{$num}."','".$statbreedHorsesCount{$num}."','".$statfieldJobMissionCount{$num}."','".$statfieldJobMissionByNPC{$num}."','".$stattransportMissionCount{$num}."','".$statrevenue{$num}."','".$statexpenses{$num}."','".$statplayTime{$num}."','".$statplantedTreeCount{$num}."','".$statcutTreeCount{$num}."','".$statwoodTonsSold{$num}."','".$stattreeTypesCut{$num}."','".$statpetDogCount{$num}."','".$statrepairVehicleCount{$num}."','".$statrepaintVehicleCount{$num}."','".$stathorseJumpCount{$num}."','".$statsoldCottonBales{$num}."','".$statwrappedBales{$num}."','".$stattractorDistance{$num}."','".$statcarDistance{$num}."','".$stattruckDistance{$num}."','".$stathorseDistance{$num}."')";
                        if(!$conn->query($abfrage) === TRUE){
        			$err++;
	                        mysqli_error($conn);
                        }

			if(empty($farm->players)){
				echo"&nbsp;no players in this farm<br>";
			        echo"&nbsp;############################################<br>";
			}else{
				foreach ($farm->players->player as $player){
					$num1++;
					$uniqueUserId{$num1} = $player['uniqueUserId'];
					$farmManager{$num1} = $player['farmManager'];
					$lastNickname{$num1} = $player['lastNickname'];
					$buyVehicle{$num1} = $player['buyVehicle'];
					$sellVehicle{$num1} = $player['sellVehicle'];
					$buyPlaceable{$num1} = $player['buyPlaceable'];
					$sellPlaceable{$num1} = $player['sellPlaceable'];
					$manageContracts{$num1} = $player['manageContracts'];
					$tradeAnimals{$num1} = $player['tradeAnimals'];
					$createFields{$num1} = $player['createFields'];
					$landscaping{$num1} = $player['landscaping'];
					$hireAssistant{$num1} = $player['hireAssistant'];
					$resetVehicle{$num1} = $player['resetVehicle'];
					$manageRights{$num1} = $player['manageRights'];
					$transferMoney{$num1} = $player['transferMoney'];
					$updateFarm{$num1} = $player['updateFarm'];
					$manageContracting{$num1} = $player['manageContracting'];

					echo"&nbsp;farmId:" . $farmId{$num} . "<br>";
					echo"&nbsp;uniqueUserId:" . $uniqueUserId{$num1} . "<br>";
					echo"&nbsp;farmManager:" . $farmManager{$num1} . "<br>";
					echo"&nbsp;lastNickname:" . $lastNickname{$num1} . "<br>";
					echo"&nbsp;buyVehicle:" . $buyVehicle{$num1} . "<br>";
					echo"&nbsp;sellVehicle:" . $sellVehicle{$num1} . "<br>";
					echo"&nbsp;buyPlaceable:" . $buyPlaceable{$num1} . "<br>";
					echo"&nbsp;sellPlaceable:" . $sellPlaceable{$num1} . "<br>";
					echo"&nbsp;manageContracts:" . $manageContracts{$num1} . "<br>";
					echo"&nbsp;tradeAnimals:" . $tradeAnimals{$num1} . "<br>";
					echo"&nbsp;createFields:" . $createFields{$num1} . "<br>";
					echo"&nbsp;landscaping:" . $landscaping{$num1} . "<br>";
					echo"&nbsp;hireAssistant:" . $hireAssistant{$num1} . "<br>";
					echo"&nbsp;resetVehicle:" . $resetVehicle{$num1} . "<br>";
					echo"&nbsp;manageRights:" . $manageRights{$num1} . "<br>";
					echo"&nbsp;transferMoney:" . $transferMoney{$num1} . "<br>";
					echo"&nbsp;updateFarm:" . $updateFarm{$num1} . "<br>";
					echo"&nbsp;manageContracting:" . $manageContracting{$num1} . "<br>";
	                        	echo"&nbsp;############################################<br>";

	                		$abfrage = "INSERT INTO players (uniqueUserId, farmId, farmManager, lastNickname, buyVehicle, sellVehicle, buyPlaceable, sellPlaceable, manageContracts, tradeAnimals, createFields, landscaping, hireAssistant, resetVehicle, manageRights, transferMoney, updateFarm, manageContracting) VALUES ('".$uniqueUserId{$num1}."', '".$farmId{$num}."', '".$farmManager{$num1}."', '".$lastNickname{$num1}."', '".$buyVehicle{$num1}."', '".$sellVehicle{$num1}."', '".$buyPlaceable{$num1}."', '".$sellPlaceable{$num1}."', '".$manageContracts{$num1}."', '".$tradeAnimals{$num1}."', '".$createFields{$num1}."', '".$landscaping{$num1}."', '".$hireAssistant{$num1}."', '".$resetVehicle{$num1}."', '".$manageRights{$num1}."', '".$transferMoney{$num1}."', '".$updateFarm{$num1}."', '".$manageContracting{$num1}."')";
		                        if(!$conn->query($abfrage) === TRUE){
						$err++;
						mysqli_error($conn);
                	        	}
				}
			}
                        if(empty($farm->contracting)){
                                echo"&nbsp;no contracts in this farm<br>";
                                echo"&nbsp;############################################<br>";
                        }else{
                                foreach ($farm->contracting->farm as $farmcontracting){
                                        $num2++;
                                        $contractor{$num2} = $farmcontracting['farmId'];

					echo"&nbsp;farmId:" . $farmId{$num} . "<br>";
                                        echo"&nbsp;contractor:" . $contractor{$num2} . "<br>";
                                        echo"&nbsp;############################################<br>";

                                        $abfrage = "INSERT INTO contracting (farmId, contrator) VALUES ('".$farmId{$num}."', '".$contractor{$num2}."')";
                                        if(!$conn->query($abfrage) === TRUE){
                                                $err++;
                                                mysqli_error($conn);
                                        }
				}
			}
                        if(empty($farm->handTools)){
                                echo"&nbsp;no handtools in this farm<br>";
                                echo"&nbsp;############################################<br>";
                        }else{
                                foreach ($farm->handTools->handTool as $handToolname){
                                        $num3++;
                                        $handToolfilename{$num3} = $handToolname['filename'];

                                        echo"&nbsp;farmId:" . $farmId{$num} . "<br>";
                                        echo"&nbsp;handTool:" . $handToolfilename{$num3} . "<br>";
                                        echo"&nbsp;############################################<br>";

                                        $abfrage = "INSERT INTO handtools (farmId, filename) VALUES ('".$farmId{$num}."', '".$handToolfilename{$num3}."')";
                                        if(!$conn->query($abfrage) === TRUE){
                                                $err++;
                                                mysqli_error($conn);
                                        }
                                }
                        }
		}
		if($err == "0"){
			echo"import finished successfull.<br>";
		        echo"############################################<br>";
		}else{
			echo $err . " error(s) occoured.<br>";
		        echo"############################################<br>";
			discordMsgSend("Miau, da hat der Fendt wohl " . $err . " kleine Katzen überfahren beim Import der Players", $webhook="https://discord.com/api/webhooks/$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$", $username="Platter Reifen", $avatar_url="https://icon-library.com/images/failed-icon/failed-icon-8.jpg");
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
