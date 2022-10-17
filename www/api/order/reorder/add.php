<?php
/*
 +=============================================================================
 | 
 | 공통 - 재입고 알림 등록
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

$member_idx		= $_SESSION[SS_HEAD.'MEMBER_IDX'];
$member_id		= $_SESSION[SS_HEAD.'MEMBER_ID'];

$product_idx	= $_POST['product_idx'];
$option_idx		= $_POST['option_idx'];

if ($product_idx != null && $option_idx != null) {
	//재입고 알림 등록 전 동일 상품 중복체크
	$reorder_cnt => $db->count("dev.PRODUCT_REORDER"," MEMBER_IDX = ".$member_idx." AND PRODUCT_IDX = ".$product_idx." AND OPTION_IDX = ".$option_idx." AND DEL_FLG = FALSE");
	
	if ($reorder_cnt > 0) {
		$code = 402;
		$msg = "해당 상품은 이미 재입고 알림 등록된 상품입니다.";
		exit;
	} else {
		$sql = "INSERT INTO
					dev.PRODUCT_REORDER
				(
					MEMBER_IDX,
					MEMBER_ID,
					PRODUCT_IDX,
					PRODUCT_CODE,
					PRODUCT_NAME,
					OPTION_IDX,
					BARCODE,
					OPTION_NAME,
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