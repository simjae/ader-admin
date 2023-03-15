<?php
/*
 +=============================================================================
 | 
 | 결제정보 입력화면 - 배송지 정보 조회
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

$member_idx = 0;
if (isset($_SESSION['MEMBER_IDX'])) {
	$member_idx = $_SESSION['MEMBER_IDX'];
}

$order_to_idx = 0;
if (isset($_POST['order_to_idx'])) {
	$order_to_idx = $_POST['order_to_idx'];
}

if ($member_idx == 0) {
	$json_result['code'] = 401;
	$json_result['msg'] = "로그인 후 다시 시도해 주세요.";
	exit;
}

if ($member_idx > 0 && $order_to_idx > 0) {
	$delete_order_to_sql = "
		DELETE FROM
			dev.ORDER_TO
		WHERE
			IDX = ".$order_to_idx." AND
			MEMBER_IDX = ".$member_idx."
	";
	
	$db->query($delete_order_to_sql);
}
?>