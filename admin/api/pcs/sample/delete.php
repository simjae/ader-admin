<?php
/*
 +=============================================================================
 | 
 | 샘플 정보 리스트 - 선택한 샘플 정보 삭제
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
$sample_idx		= $_POST['sample_idx'];

if ($sample_idx != null) {
	$delete_sample_sql = "
		UPDATE
			SAMPLE_INFO
		SET
			DEL_FLG = TRUE,
			UPDATE_DATE = NOW(),
			UPDATER = '".$session_id."'
		WHERE
			IDX = ".$sample_idx."
	";
	
	$db->query($delete_sample_sql);
}
?>