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

$member_idx = 0;
if (isset($_SESSION['MEMBER_IDX'])) {
	$member_idx = $_SESSION['MEMBER_IDX'];
}

if ($member_idx == 0) {
	$json_result['code'] = 401;
	$json_result['msg'] = "로그인 후 다시 시도해 주세요.";
	return $json_result;
}

$country = $_POST['country'];

$member_pw = null;
if (isset($_POST['member_pw'])) {
  $member_pw = md5($_POST['member_pw']);
}
$member_tel_mobile = null;
if (isset($_POST['member_tel_mobile'])) {
  $member_tel_mobile = $_POST['member_tel_mobile'];
}

if ($member_idx > 0) {
  $update_member_pw_tel_mobile_sql = "
    UPDATE
      dev.MEMBER_".$country."
    SET
      MEMBER_PW = '".$member_pw."',
      TEL_MOBILE = '".$member_tel_mobile."',
      PW_DATE = NOW()
    WHERE
      IDX = ".$member_idx."
  ";
  $db->query($update_member_pw_tel_mobile_sql);
} else {
  $json_result['code'] = 401;
  $json_result['msg'] = '비밀번호, 휴대전화 번호 수정에 실패했습니다.';
  return $json_result;
}
?>