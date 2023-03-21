<?php
/*
 +=============================================================================
 | 
 | 공장별 수주 리스트 - 선택한 공장별 수주 정보 삭제
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
$factory_idx	= $_POST['factory_idx'];

if ($factory_idx != null) {
	$delete_factory_sql = "
		UPDATE
			FACTORY_INFO
		SET
			DEL_FLG = TRUE,
			UPDATE_DATE = NOW(),
			UPDATER = '".$session_id."'
		WHERE
			IDX = ".$factory_idx."
	";
	
	$db->query($delete_factory_sql);
}
?>