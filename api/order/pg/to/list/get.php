<?php
/*
 +=============================================================================
 | 
 | 결제정보 입력화면 - 배송지 정보 리스트 조회
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

if ($member_idx != 0) {
	$sql = "SELECT
				OT.IDX				AS TO_IDX,
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
				OT.MEMBER_IDX = ".$member_idx."
			ORDER BY
				OT.IDX DESC";
	
	$db->query($sql);
	
	foreach($db->fetch() as $to_data) {
		$json_result['data'][] = array(
			'to_idx'			=>$to_data['TO_IDX'],
			'to_place'			=>$to_data['TO_PLACE'],
			'to_name'			=>$to_data['TO_NAME'],
			'to_mobile'			=>$to_data['TO_MOBILE'],
			'to_zipcode'		=>$to_data['TO_ZIPCODE'],
			'to_lot_addr'		=>$to_data['TO_LOT_ADDR'],
			'to_road_addr'		=>$to_data['TO_ROAD_ADDR'],
			'to_detail_addr'	=>$to_data['TO_DETAIL_ADDR']
		);
	}
}
?>