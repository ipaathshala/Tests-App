<?php
	require_once '../includes/DB_Functions.php';

	if(!empty($_POST['batch'])){
		$tempbatch = htmlentities(trim($_POST['batch']));
		$newbatch = mysql_real_escape_string($tempbatch);

		$db = new DB_Functions();
		if($db->ifexistBatchList($newbatch)){
			echo 2;
		}
		else{
			$user = $db->saveNewBatch($newbatch);
			if($user){
				echo 1;
			}
			else{
				echo 0;
			}
		}
	}
?>