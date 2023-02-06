<?php
/*
 +=============================================================================
 | 
 | 실시간 인기 제품 모달 검색 - 개별 상품 선택
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.11.30
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$product_idx		= $_POST['product_idx'];

if ($product_idx != null) {
	$sql = "SELECT
				PR.IDX				AS PRODUCT_IDX,
				PR.PRODUCT_CODE		AS PRODUCT_CODE,
				PR.PRODUCT_NAME		AS PRODUCT_NAME
			FROM
				dev.SHOP_PRODUCT PR
			WHERE
				PR.IDX = ".$product_idx;
}

$db->query($sql);
foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'product_idx'		=>$data['PRODUCT_IDX'],
		'product_code'		=>$data['PRODUCT_CODE'],
		'product_name'		=>$data['PRODUCT_NAME']
	);
}
?>