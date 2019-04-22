<?php
	require_once '../includes/DB_Functions.php';

	if(!empty($_POST['exam']) && !empty($_FILES["file"]["type"]) && !empty($_POST['ans']) && !empty($_POST['positive'])){

		$tempexam = htmlentities(trim($_POST['exam']));
		$tempans = htmlentities(trim($_POST['ans']));
		$tempplus = htmlentities(trim($_POST['positive']));
		$tempminus = htmlentities(trim($_POST['negative']));

		$exam = mysql_real_escape_string($tempexam);
		$answer = mysql_real_escape_string($tempans);
		$plus = mysql_real_escape_string($tempplus);
		$minus = mysql_real_escape_string($tempminus);

		$fileName = time().'_'.$_FILES['file']['name'];
		$temporary = explode(".", $_FILES["file"]["name"]);
		$file_extension = end($temporary);
		$sourcePath = $_FILES['file']['tmp_name'];
		$targetPath = "../upload/".$fileName;

		if(move_uploaded_file($sourcePath,$targetPath)){
			$db = new DB_Functions();	
			$user = $db->saveNewTest($exam, $fileName, $answer, $plus, $minus);
			echo 1;
		}
	}
?>