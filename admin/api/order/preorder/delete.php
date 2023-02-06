<?php
/*
 +=============================================================================
 | 
 | 프리오더 관리 화면 - 프리오더 삭제
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.01.15
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$country		= $_POST['country'];
$preorder_idx	= $_POST['preorder_idx'];

if ($country != null && $preorder_idx != null) {
	$entry_cnt = $db->count("dev.ENTRY_PREORDER","PREORDER_IDX = ".$preorder_idx);
	
	if ($entry_cnt > 0) {
		$json_result['code'] = 401;
		$json_result['msg'] = "현재 참가중인 프리오더 정보는 삭제할 수 없습니다.";
	} else {
		$delete_preorder_sql = "
			UPDATE
				dev.PAGE_PREORDER
			SET
				DEL_FLG = TRUE,
				UPDATE_DATE = NOW(),
				UPDATER = 'Admin'
			WHERE
				IDX = ".$preorder_idx."
		";
		
		$db->query($delete_preorder_sql);
	}
}

?>