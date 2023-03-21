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

$country = null;
if (isset($_SESSION['COUNTRY'])) {
	$country = $_SESSION['COUNTRY'];
}

$member_idx = 0;
if (isset($_SESSION['MEMBER_IDX'])) {
	$member_idx = $_SESSION['MEMBER_IDX'];
}

$member_id = null;
if (isset($_SESSION['MEMBER_ID'])) {
	$member_id = $_SESSION['MEMBER_ID'];
}

$reorder_idx = 0;
if (isset($_POST['reorder_idx'])) {
	$reorder_idx = $_POST['reorder_idx'];
}

if ($member_idx == 0 || $country == null) {
	$json_result['code'] = 401;
	$json_result['msg'] = "로그인 후 다시 시도해 주세요.";
	exit;
}

if ($reorder_idx > 0 && $member_idx > 0) {
	$reorder_cnt = $db->count("PRODUCT_REORDER","IDX = ".$reorder_idx." AND COUNTRY = '".$country."' AND MEMBER_IDX = ".$member_idx);
	
	if ($reorder_cnt > 0) {
		$delete_reorder_sql = "
			UPDATE
				PRODUCT_REORDER
			SET
				DEL_FLG = TRUE,
				UPDATE_DATE = NOW(),
				UPDATER = '".$member_id."'
			WHERE
				IDX = ".$reorder_idx." AND
				COUNTRY = '".$country."' AND
				MEMBER_IDX = ".$member_idx;
		
		$db->query($sql);
	} else {
		$json_result['code'] = 301;
		$json_result['msg'] = "부적절한 리오더 상품이 선택되었습니다. 위시리스트의 상품을 확인해주세요.";
		
		return $json_result;
	}
}
?>