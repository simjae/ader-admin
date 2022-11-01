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

$member_idx = 0;
if (isset($_SESSION['MEMBER_IDX'])) {
	$member_idx = $_SESSION['MEMBER_IDX'];
}

$basket_idx		= $_POST['basket_idx'];

if ($member_idx == 0) {
	$json_result['code'] = 401;
	$json_result['msg'] = "로그인 후 다시 시도해 주세요.";
	return $json_result;
}

if ($basket_idx != null) {
	$sql = "DELETE FROM
				dev.BASKET_INFO
			WHERE
				IDX IN (".$basket_idx.") AND
				MEMBER_IDX = ".$member_idx;
	
	$db->query($sql);
}
?>