<?php
	require_once '../includes/DB_Functions.php';
	
	$db = new DB_Functions();
	
	$tempbatch = htmlentities(trim($_POST['batch']));
	$batchName = mysql_real_escape_string($tempbatch);

	$tempexam = htmlentities(trim($_POST['exam']));
	$examName = mysql_real_escape_string($tempexam);

	$tempstudent = $_POST['student'];
	$stdname = $tempstudent;
	$status = 1;

	$array1 = $_POST['startdate'];
	$array2 = $_POST['enddate'];
	$array3 = $_POST['starttime'];
	$array4 = $_POST['endtime'];

	if(!empty($batchName) && !empty($examName) && !empty($stdname) && !empty($status) && !empty($array1) && !empty($array2) && !empty($array3) && !empty($array4)){
		foreach ($stdname as $val) {
			for ($i = 0; $i < count($array1); $i++) {
				$date1 = mysql_real_escape_string(date("d-m-Y", strtotime($array1[$i])));
				$date2 = mysql_real_escape_string(date("d-m-Y", strtotime($array2[$i])));
				$time1 = mysql_real_escape_string($array3[$i]);
				$time2 = mysql_real_escape_string($array4[$i]);

				$exist = $db->ifStudentExamExist($batchName, $examName, $val, $date1, $date2, $time1, $time2);
				if($exist){
					echo 2;
					exit();
				}
				else{
					$sql = $db->studentExam($batchName, $examName, $val, $date1, $date2, $time1, $time2, $status);	
				}
			}
		}
		echo 1;
	}
	else{
		echo 0;
	}
?>