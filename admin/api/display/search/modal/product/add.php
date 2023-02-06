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

$country		= $_POST['country'];
$product_idx	= $_POST['product_idx'];

$product_idx_arr = explode(",",$product_idx);

if ($country != null && count($product_idx_arr) > 0) {
	for ($i=0; $i<count($product_idx_arr); $i++) {
		$sql = "INSERT INTO
					dev.POPULAR_PRODUCT
				(
					COUNTRY,
					PRODUCT_IDX,
					DISPLAY_NUM
				)
				SELECT
					'".$country."',
					".$product_idx_arr[$i]."	AS PRODUCT_IDX,
					MAX(DISPLAY_NUM) + 1		AS DISPLAY_NUM
				FROM
					dev.POPULAR_PRODUCT";
		
		$db->query($sql);
	}
}
?>