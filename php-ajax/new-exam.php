<?php
	require_once '../includes/DB_Functions.php';

	if(!empty($_POST['exam'])){
		$exam = htmlentities(trim($_POST['exam']));
		$newexam = mysql_real_escape_string(strtolower($exam));
		$db = new DB_Functions();
		
		if($db->ifExamExist($newexam)){
			echo 2;
		}
		else{
			$user = $db->saveNewExam($newexam);
			if($user){
				echo 1;
			}
			else{
				echo 0;
			}
		}
	}
?>