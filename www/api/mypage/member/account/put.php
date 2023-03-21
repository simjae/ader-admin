<?php
/*
 +=============================================================================
 | 
 | 마이페이지 회원정보 - 비밀번호, 휴대전화 번호 수정
 | -------
 |
 | 최초 작성	: 윤재은
 | 최초 작성일	: 2023.01.13
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$country = null;
if (isset($_SESSION['COUNTRY'])) {
	$country = $_SESSION['COUNTRY'];
}

$member_idx = 0;
if (isset($_SESSION['MEMBER_IDX'])) {
	$member_idx = $_SESSION['MEMBER_IDX'];
}

$member_pw = null;
if (isset($_POST['member_pw'])) {
	$member_pw = md5($_POST['member_pw']);
}

$member_tel = null;
if (isset($_POST['member_tel'])) {
	$member_tel = $_POST['member_tel'];
}

if ($country == null || $member_idx == 0) {
	$json_result['code'] = 401;
	$json_result['msg'] = "로그인 정보가 없습니다";
	return $json_result;
}

$member_pw_sql = "";
if ($member_pw != null) {
	$member_pw_sql = "
		MEMBER_PW = '".$member_pw."',
		PW_DATE = NOW()
	";
}

$member_tel_sql = "";
if ($member_tel != null) {
	$member_tel_sql = " TEL_MOBILE = '".$member_tel."' ";
	if (strlen($member_pw_sql) > 0) {
		$member_tel_sql = " , ".$member_tel_sql;
	}
}

if ($country != null && $member_idx > 0 && ($member_pw != null || $member_tel != null)) {
	$update_member_sql = "
		UPDATE
			MEMBER_".$country."
		SET
			".$member_pw_sql."
			".$member_tel_sql."
		WHERE
			IDX = ".$member_idx."
	";
	
	$db->query($update_member_sql);
}
else{
	$json_result['code'] = 301;
	$json_result['msg'] = "변경할 회원정보를 다시 확인해주세요";
	return $json_result;
}

?>