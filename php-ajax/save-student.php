<?php
	require_once '../includes/DB_Functions.php';
	$db = new DB_Functions();

	$tempbatch = htmlentities(trim($_POST['batch']));
	$batchId = mysql_real_escape_string($_POST['batch']);
	$status = 1;
	$filename = $_FILES["file"]["tmp_name"];

	if(!empty($batchId)&&!empty($filename)){
		if($_FILES["file"]["size"] > 0){
			$file = fopen($filename, "r");
			while(($getData = fgetcsv($file, 10000, ",")) !== FALSE){
				$db->studentRegs($batchId, mysql_real_escape_string($getData[0]), mysql_real_escape_string($getData[1]), mysql_real_escape_string($getData[2]), mysql_real_escape_string($getData[3]), $status);
			}
			echo 1;
			fclose($file);
		}
	}
?>