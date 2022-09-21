<?php

$no = intval($no);
if($no > 0) {
	if($db->delete($_TABLE['BIZTALK_LOG'],'IDX=?',array($no)) == FALSE) {
		$code = 500;
	}
}

?>