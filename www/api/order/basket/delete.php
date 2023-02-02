<?php
/*
 +=============================================================================
 | 
 | 장바구니 화면 - 상품 정보 삭제
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.10.14
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

$member_id = null;
if (isset($_SESSION['MEMBER_ID'])) {
	$member_id = $_SESSION['MEMBER_ID'];
}

$basket_idx = null;
if (isset($_POST['basket_idx'])) {
	$basket_idx	= $_POST['basket_idx'];
}

if ($member_idx == 0 || $member_id == null) {
	$json_result['code'] = 401;
	$json_result['msg'] = "로그인 후 다시 시도해 주세요.";
	return $json_result;
}

if ($member_idx > 0 && $basket_idx != null) {
	$delete_basket_sql = "
		UPDATE
			dev.BASKET_INFO
		SET
			DEL_FLG = TRUE,
			UPDATE_DATE = NOW(),
			UPDATER = '".$member_id."'
		WHERE
			IDX IN (".implode(",",$basket_idx).") AND
			MEMBER_IDX = ".$member_idx;
	
	$db->query($delete_basket_sql);
}
?>