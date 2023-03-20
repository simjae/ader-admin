<?php
/*
 +=============================================================================
 | 
 | 상품 상세 - 찜한 상품 등록
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

if (isset($_POST['product_idx'])) {
	$product_idx	= $_POST['product_idx'];
}

if ($member_idx > 0 && $product_idx != null) {
	//찜한 상품 리스트 등록 전 동일 상품 중복체크
	$whish_list_cnt = $db->count("dev.WHISH_LIST"," MEMBER_IDX = ".$member_idx." AND PRODUCT_IDX = ".$product_idx." AND DEL_FLG = FALSE");
	
	if ($whish_list_cnt > 0) {
		$json_result['code'] = 402;
		$json_result['msg'] = "해당 상품은 이미 위시 리스트에 등록된 상품입니다.";
		
		return $json_result;
	} else {
		$insert_whish_sql = "
			INSERT INTO
				dev.WHISH_LIST
			(
				COUNTRY,
				MEMBER_IDX,
				MEMBER_ID,
				PRODUCT_IDX,
				PRODUCT_CODE,
				PRODUCT_NAME,
				CREATER,
				UPDATER
			)
			SELECT
				'".$country."'		AS COUNTRY,
				".$member_idx."		AS MEMBER_IDX,
				'".$member_id."'	AS MEMBER_ID,
				IDX					AS PRODUCT_IDX,
				PRODUCT_CODE		AS PRODUCT_CODE,
				PRODUCT_NAME		AS PRODUCT_NAME,
				'".$member_id."'	AS CREATER,
				'".$member_id."'	AS UPDATER
			FROM
				dev.SHOP_PRODUCT
			WHERE
				IDX = ".$product_idx."
		";
	
		$db->query($insert_whish_sql);
	}
	
	$whish_cnt = $db->count("dev.WHISH_LIST","MEMBER_IDX = ".$member_idx." AND DEL_FLG = FALSE");
	
	$json_result['data'] = $whish_cnt;
}
?>