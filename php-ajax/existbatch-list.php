<?php
	require_once '../includes/DB_Functions.php';

	$response = array();
	$db = new DB_Functions();
	if($db->existBatchList()){
		$user = $db->existBatchList();
		foreach($user as $value){
?>
		<tr>
			<td><?php echo $response['batch_id'] = $value['batch_id'];?></td>
			<td><?php echo $response['batch_title'] = strtoupper($value['batch_title']);?></td>
			<td>
				<a href="#" class="btn btn-dark waves-effect waves-light btn-sm"><i class="fa fa-edit"></i> EDIT</a>
				<a href="#" class="btn btn-primary waves-effect waves-light btn-sm"><i class="fa fa-trash"></i> DELETE</a>
			</td>
		</tr>
<?php			
		}
	}
?>