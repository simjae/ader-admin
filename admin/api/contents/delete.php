<?php
$no = intval($no);

if(!$db->update($_TABLE['CONT'],array('STATUS'=>'DELETE'),'IDX=?',array($no))) {
	$code = 500;
}

?>