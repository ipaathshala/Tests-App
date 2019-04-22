<?php
	/*file is used to load batch list for activate test section*/
	require_once '../includes/DB_Functions.php';

	$db = new DB_Functions();

	if($db->batchList()){
		$response = array();
		$user = $db->batchList();
?>
		<option value="0">Select Batch</option>
<?php		
		foreach($user as $value){
?>
			<option value="<?php echo $response['batch_id'] = $value['batch_id'];?>"><?php echo $response['batch_title'] = strtoupper($value['batch_title']);?></option>
<?php			
		}
	}
?>