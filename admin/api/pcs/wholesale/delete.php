<?php
/*
 +=============================================================================
 | 
 | 홀세일 정보 리스트 - 선택한 홀세일 정보 삭제
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.10.18
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

include_once("/var/www/admin/api/common/common.php");

$session_id		= sessionCheck();
$wholesale_idx	= $_POST['wholesale_idx'];

if ($wholesale_idx != null) {
	$delete_wholesale_sql = "
		UPDATE
			WHOLESALE_INFO
		SET
			DEL_FLG = TRUE,
			UPDATE_DATE = NOW(),
			UPDATER = '".$session_id."'
		WHERE
			IDX = ".$wholesale_idx."
	";
	
	$db->query($delete_wholesale_sql);
}
?>