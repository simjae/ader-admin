<?php
/*
 +=============================================================================
 | 
 | 실시간 인기 제품 등록
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.11.29
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$country			= $_POST['country'];
$product_idx		= $_POST['product_idx'];

if ($product_idx != null) {
	$insert_popular_product_sql = "
		INSERT INTO
			TMP_POPULAR_PRODUCT
		(
			COUNTRY,
			DISPLAY_NUM,
			PRODUCT_IDX
		) VALUES (
			'".$country."',
			1,
			".$product_idx.",
		)
	";
	
	$db->query($insert_popular_product_sql);
	
	$popular_idx = $db->last_id();
	
	$update_popular_product_sql = "
		UPDATE
			TMP_POPULAR_PRODUCT
		SET
			DISPLAY_NUM = DISPLAY_NUM + 1
		WHERE
			IDX != ".$popular_idx." AND
			COUNTRY = '".$country."'
	";
	
	$db->query($update_popular_sql);
}
?>