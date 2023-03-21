<?php
/*
 +=============================================================================
 | 
 | 마이페이지 회원정보 - 회원 탈퇴
 | -------
 |
 | 최초 작성	: 이은형
 | 최초 작성일	: 2023.01.16
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$member_idx = 0;
if (isset($_SESSION['MEMBER_IDX'])) {
	$member_idx = $_SESSION['MEMBER_IDX'];
}

$country = null;
if (isset($_SESSION['COUNTRY'])) {
	$country = $_SESSION['COUNTRY'];
}

if ($member_idx == 0 || $country == null) {
	$json_result['code'] = 401;
	$json_result['msg'] = "로그인 정보가 없습니다";
	return $json_result;
}

if ($country != null && $member_idx != 0) {
	$delete_member_sql = "
		UPDATE
			MEMBER_".$country."
		SET
			MEMBER_STATUS = 'DRP',
			DROP_TYPE = 'NDP',
			DROP_DATE = NOW()
		WHERE
			IDX = ".$member_idx."
	";

	$db->query($delete_member_sql);

	$db_result = $db->affectedRows();

	if ($db_result > 0) {
		$json_result['code'] = 200;
		$json_result['msg'] = '계정탈퇴에 성공했습니다.';
		
		return $json_result;
	} else {
		$json_result['code'] = 301;
		$json_result['msg'] = '계정탈퇴에 실패했습니다.';
		
		return $json_result;
	}
}

?>