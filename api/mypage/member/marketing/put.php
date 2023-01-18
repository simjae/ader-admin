<?php
/*
 +=============================================================================
 | 
 | 마이페이지 회원정보 - 마케팅 정보 수정
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

$member_idx = 0;
if (isset($_SESSION['MEMBER_IDX'])) {
	$member_idx = $_SESSION['MEMBER_IDX'];
}

if ($member_idx == 0) {
	$json_result['code'] = 401;
	$json_result['msg'] = "로그인 후 다시 시도해 주세요.";
	exit;
}

$country = null;
if (isset($_POST['country'])) {
	$country = $_POST['country'];
}

$receive_tel_flg	= $_POST['receive_tel_flg'];
$receive_sms_flg	= $_POST['receive_sms_flg']
$receive_email_flg	= $_POST['receive_email_flg'];

$recelve_tel_date_sql = "";
if ($receive_tel_flg == true) {
	$recelve_tel_date_sql = "
		,RECEIVE_TEL_DATE = NOW()
	";
}

$receive_sms_date_sql = "";
if ($receive_sms_flg == true) {
	$receive_sms_date_sql = "
		,RECEIVE_SMS_DATE = NOW()
	";
}

$receive_email_date_sql = "";
if ($receive_email_flg == true) {
	$receive_email_date_sql = "
		,RECEIVE_EMAIL_DATE = NOW()
	";
}

$accept_marketing_flg_sql = "";
if ($receive_tel_flg == true || $receive_sms_flg == true || $receive_email_flg == true) {
	$accept_marketing_flg_sql = "
		,ACCEPT_MARKETING_FLG = TRUE
	";
}

if ($member_idx > 0 && $country != null) {
	$update_marketing_sql = "
		UPDATE
			dev.MEMBER_".$country."
		SET
			RECEIVE_TEL_FLG = ".$receive_tel_flg.",
			".$receive_tel_date_sql."
			RECEIVE_SMS_FLG = ".$receive_sms_flg.",
			".$receive_sms_date_sql."
			RECEIVE_EMAIL_FLG = ".$receive_email_flg."
			".$receive_email_date_sql."
			".$accept_marketing_flg_sql."
		WHERE
			IDX = ".$member_idx."
	";
	
	$db->query($update_marketing_sql);
}
?>