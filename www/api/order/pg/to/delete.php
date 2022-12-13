<?php
/*
 +=============================================================================
 | 
 | 결제정보 입력화면 - 배송지 정보 개별 삭제
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.12.12
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$member_idx = 1;
/*$member_idx = 0;
if (isset($_SESSION['MEMBER_IDX'])) {
	$member_idx = $_SESSION['MEMBER_IDX'];
}*/

if ($member_idx == 0) {
	$json_result['code'] = 401;
	$json_result['msg'] = "로그인 후 다시 시도해 주세요.";
	exit;
}

$to_idx		= $_POST['to_idx'];
$member_idx	= $_POST['member_idx'];

if ($to_idx != null && $member_idx != 0) {
	$sql = "DELETE FROM
				dev.ORDER_TO
			WHERE
				IDX = ".$to_idx." AND
				MEMBER_IDX = ".$member_idx;
	
	$db->query($sql);
}
?>