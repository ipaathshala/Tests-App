<?php
	require_once '../includes/DB_Functions.php';
	
	if(!empty($_POST['un']) && !empty($_POST['pw'])){
		$un = htmlentities(trim($_POST['un']));
		$pw = htmlentities(trim($_POST['pw']));
		
		$username = mysql_real_escape_string($un);
		$password = mysql_real_escape_string($pw);

		$db = new DB_Functions();
		if ($db->adminExist($username)){
			echo 2;
		}
		else{
			$user = $db->adminRegs($username, $password);
			if($user){
				echo 1;
			}
			else{
				echo 0;
			}
		}
	}
?>