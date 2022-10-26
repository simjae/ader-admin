<?php
/*
 +=============================================================================
 | 
 | 상품 상세 - 장바구니 상품 등록
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
if (isset($_SESSION['MEMBER_IDX'])) {
	$member_id = $_SESSION['MEMBER_ID'];
}

$product_idx	= $_POST['product_idx'];
$option_idx		= $_POST['option_idx'];
$product_qty	= $_POST['product_qty'];

if ($member_idx == 0 || $member_id == null) {
	$json_result['code'] = 401;
	$json_result['msg'] = "로그인 후 다시 시도해 주세요.";
	exit;
}

if ($product_idx != null && $option_idx != null && product_qty != null) {
	//장바구니 등록 전 동일 상품 중복체크
	$basket_cnt => $db->count("dev.BASKET"," MEMBER_IDX = ".$member_idx." AND PRODUCT_IDX = ".$product_idx." AND OPTION_IDX = ".$option_idx);
	
	if ($basket_cnt > 0) {
		$code = 402;
		$msg = "해당 상품은 이미 위시 리스트에 등록된 상품입니다.";
		exit;
	} else {
		$sql = "INSERT INTO
					dev.BASKET_INFO
				(
					MEMBER_IDX,
					MEMBER_ID,
					PRODUCT_IDX,
					PRODUCT_CODE,
					PRODUCT_NAME,
					OPTION_IDX,
					BARCODE,
					OPTION_NAME,
					PRODUCT_QTY,
					CREATER,
					UPDATER
				)
				SELECT
					".$member_idx.",
					'".$member_id."',
					PR.IDX			AS PRODUCT_IDX,
					PR.PRODUCT_CODE	AS PRODUCT_CODE,
					PR.PRODUCT_NAME	AS PRODUCT_NAME,
					OO.IDX			AS OPTION_IDX,	
					OO.BARCODE		AS BARCODE,
					OO.OPTION_NAME	AS OPTION_NAME,
					".$product_qty.",
					'".$member_id."',
					'".$member_id."'
				FROM
					dev.SHOP_PRODUCT PR
					LEFT JOIN dev.ORDERSHEET_OPTION OO ON
					PR.ORDERSHEET_IDX = OO.ORDERSHEET_IDX AND
					OO.IDX = ".$option_idx."
				WHERE
					PR.IDX = ".$product_idx;
	
		$db->query($sql);
	}
}
?>