<?php
	require('config/db_connect.php');
	require('include/ftpdownloader.php');

	$conn = OpenSQLConnection();

	$abfrage = "SELECT filename,hash,lastdownload,lastchange FROM filelist";
	$result = $conn->query($abfrage);

        if(mysqli_num_rows($result) > 0){
		$filelist = array();
	        while($row_filelist = mysqli_fetch_all($result, MYSQLI_ASSOC)){
			$filelist[] = $row_filelist;
			foreach($row_filelist as $file){
				ftpDownload($file["filename"],$file["filename"]);
				echo $file['filename'] . "<br>";
				$filehash = hash_file("sha256", "data/" . $file["filename"]);
				if(strcmp($filehash,$file["hash"]) !== 0){
					$update = "UPDATE filelist SET hash = '" . $filehash . "' WHERE filelist.filename = '" . $file['filename'] . "';";
					if($conn->query($update) === TRUE){
						echo"update successful.<br>";
						echo"############################################<br>";
						if($file["filename"] == "missions.xml"){
							include('import_missions.php');
						}elseif($file["filename"] == "sales.xml"){
                                                        include('import_sales.php');
						}elseif($file["filename"] == "economy.xml"){
                                                        include('import_economy.php');
						}elseif($file["filename"] == "farms.xml"){
                                                        include('import_farms.php');
						}else{
							echo"No import job defined.<br>";
							echo"############################################<br>";
						}
					}else{
						echo"Error updating record: " . $conn->error . "<br>";
						echo"############################################<br>";
					}
				}else{
					echo"hashes match - nothing to do.<br>";
					echo"############################################<br>";
				}
	               	}
		}
        }else{
		echo"Error. Everything went horrible wrong.<br>";
		echo"############################################<br>";
	}

	CloseSQLConnection($conn);
?>
