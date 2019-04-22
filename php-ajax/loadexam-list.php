<?php
	require_once '../includes/DB_Functions.php';

	$response = array();
	$db = new DB_Functions();
	if($db->examlist()){
		$user = $db->examList();
		foreach($user as $value){
?>
		<tr>
			<td><?php echo $response['eid'] = $value['eid'];?></td>
			<td><?php echo $response['etitle'] = ucwords($value['etitle']);?></td>
			<td>
				<a href="#" class="btn btn-dark waves-effect waves-light btn-sm"><i class="fa fa-edit"></i> EDIT</a>
				<a href="#" class="btn btn-primary waves-effect waves-light btn-sm"><i class="fa fa-trash"></i> DELETE</a>
			</td>
		</tr>
<?php			
		}
	}
?>