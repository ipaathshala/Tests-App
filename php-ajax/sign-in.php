<?php
	require_once '../includes/DB_Functions.php';

	if(!empty($_POST['un']) && !empty($_POST['pw'])){
		$un = htmlentities(trim($_POST['un']));
		$pw = htmlentities(trim($_POST['pw']));

		$username = mysql_real_escape_string($un);
		$password = mysql_real_escape_string($pw);

		$db = new DB_Functions();
		$user = $db->adminLogin($username, $password);
		if($user != false){
			$userid = $_SESSION["user_id"] = $user["admin_id"];
			$username = $_SESSION["user_name"] = $user["email"];
			echo 1;
		}
		else if($user == false){
			echo 0;
		}
		else{
			echo 2;
		}
	} 
?>