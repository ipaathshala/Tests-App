<?php
	require_once '../includes/DB_Functions.php';

	$db = new DB_Functions();

	if($db->questionexamList()){
		$response = array();
		$user = $db->questionexamList();
?>
		<option value="0">Select Exam</option>
<?php		
		foreach($user as $value){
?>
			<option value="<?php echo $response['eid'] = $value['eid'];?>"><?php echo $response['etitle'] = ucwords($value['etitle']);?></option>
<?php			
		}
	}
?>