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

$filename = 'data/sales.xml';
if(file_exists($filename)){
	$xml = simplexml_load_file($filename);
	if($xml){
		$leeren = "TRUNCATE ls22db.sales";
		if (!$conn->query($leeren) === TRUE){
			echo"Error: " . $leeren . "<br>" . $conn->error;
		}
		$num = "0";
		$err = "0";
		foreach ($xml->item as $item){
			$num++;
			$timeLeft{$num} = $item['timeLeft'];
			$isGenerated{$num} = $item['isGenerated'];
			$xmlFilename{$num} = $item['xmlFilename'];
			$age{$num} = $item['age'];
			$price{$num} = $item['price'];
			$damage{$num} = $item['damage'];
			$wear{$num} = $item['wear'];
			$operatingTime{$num} = $item['operatingTime'];

			echo"timeLeft: " . $timeLeft{$num} . "<br>";
			echo"isGenerated: " . $isGenerated{$num} . "<br>";
			echo"xmlFilename: " . $xmlFilename{$num} . "<br>";
			echo"age: " . $age{$num} . "<br>";
			echo"price: " . $price{$num} . "<br>";
			echo"damage: " . $damage{$num} . "<br>";
			echo"wear: " . $wear{$num} . "<br>";
			echo"operatingTime: " . $operatingTime{$num} . "<br>";
			echo"############################################<br>";

			$abfrage = "INSERT INTO sales (timeLeft, isGenerated, xmlFilename, age, price, damage, wear, operatingTime) VALUES ('".$timeLeft{$num}."', '".$isGenerated{$num}."', '".$xmlFilename{$num}."', '".$age{$num}."', '".$price{$num}."', '".$damage{$num}."', '".$wear{$num}."', '".$operatingTime{$num}."')";
			if(!$conn->query($abfrage) === TRUE){
				$err++;
                        }
		}
		if($err == "0"){
			echo"import finished successfull.<br>";
			echo"############################################<br>";
			require_once('notify_sales.php');
		}else{
			echo $err . " error(s) occoured.<br>";
			echo"############################################<br>";
                        discordMsgSend("Miau, da hat der Fendt wohl " . $err . " kleine Katzen überfahren beim Import der Sales", $webhook="https://discord.com/api/webhooks/$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$", $username="Platter Reifen", $avatar_url="https://icon-library.com/images/failed-icon/failed-icon-8.jpg");
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
