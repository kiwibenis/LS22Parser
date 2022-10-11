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

$filename = 'data/economy.xml';
if(file_exists($filename)){
	$xml = simplexml_load_file($filename);
	if($xml){
		$num = "0";
		$err = "0";
		foreach ($xml->fillTypes as $fillTypes){
			foreach ($fillTypes as $fillType){
				$num++;
				$type{$num} = $fillType['fillType'];
				$period1{$num} = $fillType->history->period[0];
				$period2{$num} = $fillType->history->period[1];
				$period3{$num} = $fillType->history->period[2];
				$period4{$num} = $fillType->history->period[3];
				$period5{$num} = $fillType->history->period[4];
				$period6{$num} = $fillType->history->period[5];
				$period7{$num} = $fillType->history->period[6];
				$period8{$num} = $fillType->history->period[7];
				$period9{$num} = $fillType->history->period[8];
				$period10{$num} = $fillType->history->period[9];
				$period11{$num} = $fillType->history->period[10];
				$period12{$num} = $fillType->history->period[11];

				echo"&nbsp;type:" . $type{$num} . "<br>";
				echo"&nbsp;period1:" . $period1{$num} . "<br>";
				echo"&nbsp;period2:" . $period2{$num} . "<br>";
				echo"&nbsp;period3:" . $period3{$num} . "<br>";
				echo"&nbsp;period4:" . $period4{$num} . "<br>";
				echo"&nbsp;period5:" . $period5{$num} . "<br>";
				echo"&nbsp;period6:" . $period6{$num} . "<br>";
				echo"&nbsp;period7:" . $period7{$num} . "<br>";
				echo"&nbsp;period8:" . $period8{$num} . "<br>";
				echo"&nbsp;period9:" . $period9{$num} . "<br>";
				echo"&nbsp;period10:" . $period10{$num} . "<br>";
				echo"&nbsp;period11:" . $period11{$num} . "<br>";
				echo"&nbsp;period12:" . $period12{$num} . "<br>";
	                        echo"&nbsp;############################################<br>";

                		$abfrage = "INSERT INTO economy (fillType, period1, period2, period3, period4, period5, period6, period7, period8, period9, period10, period11, period12) VALUES ('".$type{$num}."', '".$period1{$num}."', '".$period2{$num}."', '".$period3{$num}."', '".$period4{$num}."', '".$period5{$num}."', '".$period6{$num}."', '".$period7{$num}."', '".$period8{$num}."', '".$period9{$num}."', '".$period10{$num}."', '".$period11{$num}."', '".$period12{$num}."')";
	                        if(!$conn->query($abfrage) === TRUE){
					$err++;
					mysqli_error($conn);
                	        }
			}
		}
		if($err == "0"){
			echo"import finished successfull.<br>";
		        echo"############################################<br>";
		}else{
			echo $err . " error(s) occoured.<br>";
		        echo"############################################<br>";
			discordMsgSend("Miau, da hat der Fendt wohl " . $err . " kleine Katzen überfahren beim Import der Economy", $webhook="https://discord.com/api/webhooks/$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$", $username="Platter Reifen", $avatar_url="https://icon-library.com/images/failed-icon/failed-icon-8.jpg");
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
