<?php
	require_once '../includes/DB_Functions.php';

	$tempbatch = htmlentities(trim($_POST['batch']));
	$tempexam = htmlentities(trim($_POST['exam']));
	$newbatch = mysql_real_escape_string($tempbatch);
	$newexam = mysql_real_escape_string($tempexam);

	$array1 = $_POST['startdate'];
	$array2 = $_POST['enddate'];
	$array3 = $_POST['starttime'];
	$array4 = $_POST['endtime'];

	if(!empty($newbatch) && !empty($newexam) && !empty($array1) && !empty($array2) && !empty($array3) && !empty($array4)){
		for ($i = 0; $i < count($array1); $i++) {
			$date1 = mysql_real_escape_string(date("d-m-Y", strtotime($array1[$i])));
			$date2 = mysql_real_escape_string(date("d-m-Y", strtotime($array1[$i])));
			$time1 = mysql_real_escape_string($array3[$i]);
			$time2 = mysql_real_escape_string($array4[$i]);

			$db = new DB_Functions();
			if($user = $db->ifBatchTestExist($newbatch, $newexam, $date1, $date2, $time1, $time2)){
				echo 2;
			}
			else{
				$db->SetAllBatchTest($newbatch, $newexam, $date1, $date2, $time1, $time2);
				echo 1;
			}
		}
	}
	else{
		echo 0;
	}
?>