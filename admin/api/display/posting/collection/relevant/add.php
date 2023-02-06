<?php
/*
 +=============================================================================
 | 
 | 룩북 관리 화면 - 프로젝트 이미지 관련상품 등록
 | -----------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2023.01.26
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$country			= $_POST['country'];
$collection_idx		= $_POST['collection_idx'];
$c_product_idx		= $_POST['c_product_idx'];
$product_idx		= $_POST['product_idx'];

if ($country != null && $collection_idx != null && $c_product_idx != null && $product_idx != null) {
	$product_cnt = $db->count(
		"dev.COLLECTION_RELEVANT_PRODUCT",
		"COUNTRY = '".$country."' AND COLLECTION_IDX = ".$collection_idx." AND C_PRODUCT_IDX = ".$c_product_idx." AND PRODUCT_IDX = ".$product_idx
	);
	
	if ($product_cnt > 0) {
		$json_result['code'] = 301;
		$json_result['msg'] = "이미 등록된 상품입니다.";
	} else {
		$insert_relevant_sql = "
			INSERT INTO
				dev.COLLECTION_RELEVANT_PRODUCT
			(
				COUNTRY,
				COLLECTION_IDX,
				C_PRODUCT_IDX,
				PRODUCT_IDX
			) VALUES (
				'".$country."',
				".$collection_idx.",
				".$c_product_idx.",
				".$product_idx."
			)
		";
		
		$db->query($insert_relevant_sql);
	}
}

?>