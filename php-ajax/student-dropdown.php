<?php
	/*file is used to load student dropdown to set student exam*/
	require_once '../includes/DB_Functions.php';
	
	if(!empty($_REQUEST['batch'])){
		$tempbatch = htmlentities(trim($_REQUEST['batch']));
		$batch = mysql_real_escape_string($tempbatch);
		$response = array();
		$db = new DB_Functions();
		$user = $db->studentDropdown($batch);
?>
		<option value="0">Select Student</option>
		<?php		
			foreach($user as $value){
		?>
		<option value="<?php echo $response['stdid'] = $value['stdid'];?>"><?php echo $response['fn'] = strtoupper($value['fn'])." ".$response['ln'] = strtoupper($value['ln']);?></option>
<?php			
			}
	}
?>