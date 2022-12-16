<?php
/*
 +=============================================================================
 | 
 | 결제정보 입력화면 - 배송지 정보 개별 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.12.12
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$member_idx = 1;
/*$member_idx = 0;
if (isset($_SESSION['MEMBER_IDX'])) {
	$member_idx = $_SESSION['MEMBER_IDX'];
}*/

if ($member_idx == 0) {
	$json_result['code'] = 401;
	$json_result['msg'] = "로그인 후 다시 시도해 주세요.";
	exit;
}

$to_place			= $_POST['to_place'];
$to_name			= $_POST['to_name'];
$to_mobile			= $_POST['to_mobile'];
$to_zipcode			= $_POST['to_zipcode'];
$to_lot_addr		= $_POST['to_lot_addr'];
$to_road_addr		= $_POST['to_road_addr'];
$to_detail_addr		= $_POST['to_detail_addr'];

if ($member_idx != 0) {
	$insert_sql = "
		INSERT INTO
				dev.ORDER_TO
			(
				MEMBER_IDX,
				TO_PLACE,
				TO_NAME,
				TO_MOBILE,
				TO_ZIPCODE,
				TO_LOT_ADDR,
				TO_ROAD_ADDR,
				TO_DETAIL_ADDR
			) VALUES (
				".$member_idx.",
				'".$to_place."',
				'".$to_name."',
				'".$to_mobile."',
				'".$to_zipcode."',
				'".$to_lot_addr."',
				'".$to_road_addr."',
				'".$to_detail_addr."'
			)";
	
	$db->query($insert_sql);
}
?>