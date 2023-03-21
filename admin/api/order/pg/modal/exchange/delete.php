<?php
/*
 +=============================================================================
 | 
 | 상품 진열 페이지_상품 라이브러리 검색 모달 - 상품 라이브러리 검색
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.08.15
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$order_product_idx			= $_POST['order_product_idx'];

if ($order_product_idx != null) {
	$delete_tmp_order_product_sql = "
		DELETE FROM
			TMP_ORDER_PRODUCT
		WHERE
			IDX = ".$order_product_idx." AND
			ORDER_STATUS = 'PWT'
	";
	
	$db->query($delete_tmp_order_product_sql);
}

?>