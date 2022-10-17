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

$member_idx		= $_SESSION[SS_HEAD.'MEMBER_IDX'];
$member_id		= $_SESSION[SS_HEAD.'MEMBER_ID'];

$product_idx	= $_POST['product_idx'];

if ($member_idx == null || $member_id == null) {
	$code = 401;
	$msg = "로그인 후 다시 시도해 주세요.";
	exit;
}

if ($product_idx != null) {
	//찜한 상품 리스트 등록 전 동일 상품 중복체크
	$whish_list_cnt => $db->count("dev.WHISH_LIST"," MEMBER_IDX = ".$member_idx." AND PRODUCT_IDX = ".$product_idx." AND DEL_FLG = FALSE");
	
	if ($whish_list_cnt > 0) {
		$code = 402;
		$msg = "해당 상품은 이미 위시 리스트에 등록된 상품입니다.";
		exit;
	} else {
		$sql = "INSERT INTO
					dev.WHISH_LIST
				(
					MEMBER_IDX,
					MEMBER_ID,
					PRODUCT_IDX,
					PRODUCT_CODE,
					PRODUCT_NAME,
					CREATER,
					UPDATER
				)
				SELECT
					".$member_idx.",
					'".$member_id."',
					IDX					AS PRODUCT_IDX,
					PRODUCT_CODE,
					PRODUCT_NAME,
					'".$member_id."',
					'".$member_id."'
				FROM
					dev.SHOP_PRODUCT
				WHERE
					IDX = ".$product_idx;
	
		$db->query($sql);
	}
}
?>