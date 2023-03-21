<?php
/*
 +=============================================================================
 | 
 | 메인 랜딩 관리 - 컨텐츠 상품 등록/삭제
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2023.01.20
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$c_product_idx			= $_POST['c_product_idx'];

if ($c_product_idx != null) {
	$delete_contents_product_sql = "
		DELETE FROM
			TMP_CONTENTS_PRODUCT
		WHERE
			IDX = ".$c_product_idx."
	";
	
	$db->query($delete_contents_product_sql);
}

?>