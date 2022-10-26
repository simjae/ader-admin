<?php
/*
 +=============================================================================
 | 
 | 공통 - 상품 정보 수정
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.10.17
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
if (isset($_SESSION['MEMBER_IDX'])) {
	$member_id = $_SESSION['MEMBER_ID'];
}

$reorder_idx	= $_POST['reorder_idx'];

if ($member_idx == 0 || $member_id == null) {
	$json_result['code'] = 401;
	$json_result['msg'] = "로그인 후 다시 시도해 주세요.";
	exit;
}

if ($reorder_idx != null) {
	$sql = "UPDATE
				dev.PRODUCT_REORDER
			SET
				DEL_FLG = TRUE,
				UPDATER = '".$member_id."',
				UPDATE_DATE = NOW()
			WHERE
				IDX IN (".$reorder_idx.") AND
				MEMBER_IDX = ".$member_idx;
	
	$db->query($sql);
}
?>