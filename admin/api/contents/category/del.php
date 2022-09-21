<?php
$where = 'IDX='.$no;
$status = db_get($_TABLE['GOODS'],$where,'STATUS');
if($status == 'DELETE') {
	$result = db_delete($_TABLE['GOODS'],$where);
	$json_result['status'] = null;
}
else {
	$result = db_update($_TABLE['GOODS'],'STATUS="DELETE"',$where);
	$json_result['status'] = 'delete';
}
if(!$result) {
	$code = 500;
	$json_result['status'] = null;
}
?>