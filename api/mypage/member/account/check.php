<?php
/*
 +=============================================================================
 | 
 | 마이페이지 회원정보 - 현재 비밀번호 확인
 | -------
 |
 | 최초 작성	: 윤재은
 | 최초 작성일	: 2023.01.12
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$member_idx = 1;
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

if ($member_idx > 0 && $member_pw != null) {
  $member_cnt = $db->count("dev.MEMBER_".$country, "IDX = ".$member_idx." AND MEMBER_PW = '".$member_pw."'");
  $json_result = array();
  if ($member_cnt > 0) {
    $json_result['code'] = 200;
    return $json_result;
  } else {
    $json_result['code'] = 301;
    return $json_result;
  }
}
?>