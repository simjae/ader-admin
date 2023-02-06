<?php
/*
 +=============================================================================
 | 
 | 전시정보 등록 - 룩북 모달_룩북 이미지별 관련 상품 등록
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.12.05
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$img_idx		= $_POST['img_idx'];
$product_idx	= $_POST['product_idx'];

if ($img_idx != null && $product_idx != null) {
	for ($i=0; $i<count($product_idx); $i++) {
		$sql = "INSERT INTO
					dev.LOOKBOOK_PRODUCT
				(
					IMG_IDX,
					PRODUCT_IDX
				) VALUES (
					".$img_idx.",
					".$product_idx."
				);";
		
		$db->query($sql);
	}
}
?>