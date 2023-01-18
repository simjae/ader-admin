<?php
/*
 +=============================================================================
 | 
 | 마이페이지 회원정보 - 마케팅 정보 조회
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
	return $json_result;
}

$country = null;
if (isset($_POST['country'])) {
	$country = $_POST['country'];
}

if ($member_idx > 0 && $country != null) {
	$select_marketing_sql = "
		SELECT
			MB.RECEIVE_TEL_FLG		AS RECEIVE_TEL_FLG,
			MB.RECEIVE_SMS_FLG		AS RECEIVE_SMS_FLG,
			MB.RECEIVE_EMAIL_FLG	AS RECEIVE_EMAIL_FLG
		FROM 
			dev.MEMBER_".$country." MB
		WHERE 
			MB.IDX = ".$member_idx."
	";

	$db->query($select_marketing_sql);

	foreach($db->fetch() as $data) {
		$json_result['data'][] = array(
			'receive_tel_flg'		=>$data['RECEIVE_TEL_FLG'],
			'receive_sms_flg'		=>$data['RECEIVE_SMS_FLG'],
			'receive_email_flg'		=>$data['RECEIVE_EMAIL_FLG'],
		);
	}
}
?>