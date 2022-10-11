<?php
echo"hallo Mensch<br><br>";
echo"<a href='phpmyadmin/'>phpmyadmin</a><br><br>";

$fileList_import = glob('import_*.php');
$fileList_notify = glob('notify_*.php');

foreach($fileList_import as $filename_import){
    if(is_file($filename_import)){
        echo"<a href='$filename_import'>$filename_import</a><br>";
    }
}

foreach($fileList_notify as $filename_notify){
    if(is_file($filename_notify)){
        echo"<a href='$filename_notify'>$filename_notify</a><br>";
    }
}

?>
