<?php
/*
 +=============================================================================
 | 
 | 찜한 상품 리스트 - 상품 정보 삭제
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.10.13
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$member_idx = 1;
//$member_idx = 0;
if (isset($_SESSION['MEMBER_IDX'])) {
	$member_idx = $_SESSION['MEMBER_IDX'];
}

$member_id = "adertest4";
//$member_id = null;
if (isset($_SESSION['MEMBER_ID'])) {
	$member_id = $_SESSION['MEMBER_ID'];
}

$whish_idx		= null;
if (isset($_POST['whish_idx'])) {
	$whish_idx = $_POST['whish_idx'];
};
$product_idx	= $_POST['product_idx'];

if ($member_idx == 0 || $member_id == null) {
	$json_result['code'] = 401;
	$json_result['msg'] = "로그인 후 다시 시도해 주세요.";
	return $json_result;
}

$whisi_sql = "";
if ($whish_idx != null) {
	$whish_sql = " IDX IN (".$whish_idx.") AND ";
	
} else if ($product_idx != null) {
	$whish_sql=" PRODUCT_IDX = ".$product_idx." AND ";
}

$sql = "UPDATE
			dev.WHISH_LIST
		SET
			DEL_FLG = TRUE,
			UPDATER = '".$member_id."',
			UPDATE_DATE = NOW()
		WHERE
			".$whish_sql."
			MEMBER_IDX = ".$member_idx;

$db->query($sql);
?>