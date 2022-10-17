<?php
/*
 +=============================================================================
 | 
 | 장바구니 화면 - 상품 정보 삭제
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.10.14
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$member_idx		= $_SESSION[SS_HEAD.'MEMBER_IDX'];
$basket_idx		= $_POST['basket_idx'];

if ($member_idx != null && $product_idx != null) {
	$sql = "DELETE FROM
				dev.BASKET_INFO
			WHERE
				IDX IN (".$basket_idx.") AND
				MEMBER_IDX = ".$member_idx;
	
	$db->query($sql);
}
?>