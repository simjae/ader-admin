<?php
$no = intval($no);
$status = $db->get($_TABLE['CONT'],'IDX=?',array($no))[0]['STATUS'];
if(!$db->update($_TABLE['CONT'],array('STATUS'=>($status=='Y')?'N':'Y'),'IDX=?',array($no))) {
	$code = 500;
}
else {
	$json_result = array(
		'mode'=>($status=='Y')?'off':'on'
	);
}
?>