<?php
/*
 +=============================================================================
 | 
 | 회원등급 삭제처리 API
 | ----------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.07.06
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		:
 | 
 +=============================================================================
*/

include_once("/var/www/admin/api/common/common.php");

$session_id		= sessionCheck();

$level_idx		= $_POST['level_idx'];

if ($level_idx != null) {
	$member_kr_cnt = $db->count("MEMBER_KR","LEVEL_IDX IN (".implode(",",$level_idx).") AND MEMBER_STATUS = 'NML'");
	$member_en_cnt = $db->count("MEMBER_EN","LEVEL_IDX IN (".implode(",",$level_idx).") AND MEMBER_STATUS = 'NML'");
	$member_cn_cnt = $db->count("MEMBER_CN","LEVEL_IDX IN (".implode(",",$level_idx).") AND MEMBER_STATUS = 'NML'");
	
	if ($member_kr_cnt > 0 || $member_en_cnt > 0 || $member_cn_cnt > 0) {
		$json_result['code'] = 301;
		$json_result['msg'] = "선택 한 레벨의 멤버가 존재 할 경우 삭제할 수 없습니다.";
	} else {
		$update_level_sql = "
			UPDATE
				MEMBER_LEVEL
			SET
				DEL_FLG = TRUE,
				UPDATE_DATE = NOW(),
				UPDATER = '".$session_id."'
			WHERE
				IDX IN (".implode(",",$level_idx).")
		";
		
		$db->query($update_level_sql);
	}
}

?>