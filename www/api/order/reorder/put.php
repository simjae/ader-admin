<?php
/*
 +=============================================================================
 | 
 | 찜한 상품 리스트 - 상품 정보 수정
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

$reorder_idx	= $_POST['basket_idx'];
$product_idx	= $_POST['product_idx'];
$option_idx		= $_POST['option_idx'];

if ($member_idx != null && $reorder_idx != null) {
	$sql = "UPDATE
				dev.PRODUCT_REORDER
			SET
				DEL_FLG = TRUE
			WHERE
				IDX = ".$basket_idx." AND
				MEMBER_IDX = ".$member_idx." AND
				PRODUCT_IDX = ".$product_idx." AND
				OPTION_IDX = ".$option_idx;
}
?>