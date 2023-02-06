<?php
/*
 +=============================================================================
 | 
 | 스탠바이 관리 화면 - 스탠바이 삭제
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
$standby_idx	= $_POST['standby_idx'];

if ($country != null && $standby_idx != null) {
	$entry_cnt = $db->count("dev.ENTRY_STANDBY","STANDBY_IDX = ".$standby_idx);
	
	if ($entry_cnt > 0) {
		$json_result['code'] = 401;
		$json_result['msg'] = "현재 참가중인 스탠바이 정보는 삭제할 수 없습니다.";
	} else {
		$delete_standby_sql = "
			UPDATE
				dev.PAGE_STANDBY
			SET
				DEL_FLG = TRUE,
				UPDATE_DATE = NOW(),
				UPDATER = 'Admin'
			WHERE
				IDX = ".$standby_idx."
		";
		
		$db->query($delete_standby_sql);
	}
}

?>