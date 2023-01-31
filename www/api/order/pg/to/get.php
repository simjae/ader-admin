<?php
/*
 +=============================================================================
 | 
 | 결제정보 입력화면 - 배송지 정보 조회
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

$member_idx = 0;
if (isset($_SESSION['MEMBER_IDX'])) {
	$member_idx = $_SESSION['MEMBER_IDX'];
}

$order_to_idx = 0;
if (isset($_POST['order_to_idx'])) {
	$order_to_idx = $_POST['order_to_idx'];
}

if ($member_idx == 0) {
	$json_result['code'] = 401;
	$json_result['msg'] = "로그인 후 다시 시도해 주세요.";
	exit;
}

$where = " OT.MEMBER_IDX = ".$member_idx." ";
if ($order_to_idx > 0) {
	$where .= " AND (OT.IDX = ".$order_to_idx.") ";
}

if ($member_idx > 0) {
	$select_order_to_sql = "
		SELECT
			OT.IDX				AS ORDER_TO_IDX,
			OT.TO_PLACE			AS TO_PLACE,
			OT.TO_NAME			AS TO_NAME,
			OT.TO_MOBILE		AS TO_MOBILE,
			OT.TO_ZIPCODE		AS TO_ZIPCODE,
			OT.TO_LOT_ADDR		AS TO_LOT_ADDR,
			OT.TO_ROAD_ADDR		AS TO_ROAD_ADDR,
			OT.TO_DETAIL_ADDR	AS TO_DETAIL_ADDR
		FROM
			dev.ORDER_TO OT
		WHERE
			".$where."
	";
	
	$db->query($select_order_to_sql);
	
	foreach($db->fetch() as $order_to_data) {
		$json_result['data'][] = array(
			'order_to_idx'		=>$order_to_data['ORDER_TO_IDX'],
			'to_place'			=>$order_to_data['TO_PLACE'],
			'to_name'			=>$order_to_data['TO_NAME'],
			'to_mobile'			=>$order_to_data['TO_MOBILE'],
			'to_zipcode'		=>$order_to_data['TO_ZIPCODE'],
			'to_lot_addr'		=>$order_to_data['TO_LOT_ADDR'],
			'to_road_addr'		=>$order_to_data['TO_ROAD_ADDR'],
			'to_detail_addr'	=>$order_to_data['TO_DETAIL_ADDR']
		);
	}
}
?>