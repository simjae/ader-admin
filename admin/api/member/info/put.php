<?php
/*
 +=============================================================================
 | 
 | 회원 조회 페이지 - 회원 상태 변경
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.05.01
 | 최종 수정일	: 
 | 버전		: 1.1
 | 설명		: 
 | 
 +=============================================================================
*/

$country			= $_POST['country'];

$suspicion_flg		= $_POST['suspicion_flg'];
$drop_flg			= $_POST['drop_flg'];

$member_idx			= $_POST['member_idx'];

if ($country != null && $member_idx != null && $suspicion_flg != null) {
	$update_member_suspicion_sql = "
		UPDATE
			dev.MEMBER_".$country."
		SET
			SUSPICION_FLG = ".$suspicion_flg."
		WHERE
			IDX IN (".implode(",",$member_idx).")
	";
	
	$db->query($update_member_suspicion_sql);
}

if ($country != null && $member_idx != null && $drop_flg != null) {
	$update_member_drop_sql = "
		UPDATE
			dev.MEMBER_".$country."
		SET
			MEMBER_STATUS = 'DRP',
			DROP_TYPE = 'FDP',
			DROP_DATE = NOW()
		WHERE
			IDX IN (".implode(",",$member_idx).")
	";
	
	$db->query($update_member_drop_sql);
}

?>