<?php
/*
 +=============================================================================
 | 
 | 마이페이지 회원정보 - 배송지 목록 조회
 | -------
 |
 | 최초 작성	: 윤재은
 | 최초 작성일	: 2023.01.11
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$country = null;
if (isset($_SESSION['COUNTRY'])) {
	$country = $_SESSION['COUNTRY'];
}

$member_idx = 0;
if (isset($_SESSION['MEMBER_IDX'])) {
  $member_idx = $_SESSION['MEMBER_IDX'];
}

if ($country == null || $member_idx == 0) {
	$json_result['code'] = 401;
	$json_result['msg'] = "로그인 후 다시 시도해 주세요.";
	return $json_result;
}

if ($country != null && $member_idx > 0) {
	$select_order_to_sql = "
		SELECT
			OT.IDX				AS ORDER_TO_IDX,
			OT.TO_PLACE			AS TO_PLACE,
			OT.TO_NAME			AS TO_NAME,
			OT.TO_MOBILE		AS TO_MOBILE,
			OT.TO_ZIPCODE		AS TO_ZIPCODE,
			OT.TO_LOT_ADDR		AS TO_LOT_ADDR,
			OT.TO_ROAD_ADDR		AS TO_ROAD_ADDR,
			OT.TO_DETAIL_ADDR	AS TO_DETAIL_ADDR,
			OT.DEFAULT_FLG		AS DEFAULT_FLG
		FROM
			dev.ORDER_TO OT
		WHERE
			OT.COUNTRY = '".$country."' AND
			OT.MEMBER_IDX = ".$member_idx."
		ORDER BY
			OT.DEFAULT_FLG DESC
	";

	$db->query($select_order_to_sql);

	foreach($db->fetch() as $data) {
		$json_result['data'][] = array(
			'order_to_idx'		=>$data['ORDER_TO_IDX'],
			'to_place'			=>$data['TO_PLACE'],
			'to_name'			=>$data['TO_NAME'],
			'to_mobile'			=>$data['TO_MOBILE'],
			'to_zipcode'		=>$data['TO_ZIPCODE'],
			'to_lot_addr'		=>$data['TO_LOT_ADDR'],
			'to_road_addr'		=>$data['TO_ROAD_ADDR'],
			'to_detail_addr'	=>$data['TO_DETAIL_ADDR'],
			'default_flg'		=>$data['DEFAULT_FLG']
		);
	}
}
?>