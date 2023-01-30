<?php
/*
 +=============================================================================
 | 
 | 결제정보 입력화면 - 결제 상품 및 주문자 정보 조회
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

$country = null;
if (isset($_SESSION['COUNTRY'])) {
	$country = $_SESSION['COUNTRY'];
}

if ($member_idx == 0 || $country == null) {
	$json_result['code'] = 401;
	$json_result['msg'] = "로그인 후 다시 시도해 주세요.";
	exit;
}

$basket_idx = null;
if (isset($_POST['basket_idx'])) {
	$basket_idx = $_POST['basket_idx'];
}

if ($member_idx > 0 && $basket_idx != null) {
	$basket_cnt = $db->count("dev.BASKET_INFO","IDX IN (".implode(",",$basket_idx).") AND MEMBER_IDX = ".$member_idx);

if (count($basket_idx) != $basket_cnt) {
	$json_result['code'] = 402;
	$json_result['msg'] = "결제하려는 상품이 존재하지 않습니다. 쇼핑백에서 결제하려는 상품 정보를 확인해주세요.";
	exit;
}

if ($member_idx != 0 && $basket_idx != null) {
	$product_sql = "
		SELECT
			BI.IDX							AS BASKET_IDX,
			(
				SELECT
					REPLACE(S_PI.IMG_LOCATION,'/var/www/admin/www','')
				FROM
					dev.PRODUCT_IMG S_PI
				WHERE
					S_PI.PRODUCT_IDX = BI.PRODUCT_IDX AND
					S_PI.IMG_TYPE = 'P' AND
					S_PI.IMG_SIZE = 'S'
				ORDER BY
					S_PI.IDX ASC
				LIMIT
					0,1
			)								AS PRODUCT_IMG,
			BI.PRODUCT_NAME					AS PRODUCT_NAME,
			OM.COLOR						AS COLOR,
			OM.COLOR_RGB					AS COLOR_RGB,
			OO.OPTION_NAME					AS OPTION_NAME,
			PR.REFUND_FLG					AS REFUND_FLG,
			BI.PRODUCT_QTY					AS PRODUCT_QTY,
			PR.SALES_PRICE_".$country."		AS SALES_PRICE
		FROM
			dev.BASKET_INFO BI
			LEFT JOIN dev.SHOP_PRODUCT PR ON
			BI.PRODUCT_IDX = PR.IDX
			LEFT JOIN dev.ORDERSHEET_MST OM ON
			PR.ORDERSHEET_IDX = OM.IDX
			LEFT JOIN dev.ORDERSHEET_OPTION OO ON
			BI.OPTION_IDX = OO.IDX
		WHERE
			BI.IDX IN (".implode(",",$basket_idx).")
	";
	
	$db->query($product_sql);
	
	$product_info = array();
	foreach($db->fetch() as $product_data) {
		$product_info[] = array(
			'product_img'	=>$product_data['PRODUCT_IMG'],
			'product_name'	=>$product_data['PRODUCT_NAME'],
			'color'			=>$product_data['COLOR'],
			'color_rgb'		=>$product_data['COLOR_RGB'],
			'option_name'	=>$product_data['OPTION_NAME'],
			'refund_flg'	=>$product_data['REFUND_FLG'],
			'product_qty'	=>$product_data['PRODUCT_QTY'],
			'sales_price'	=>$product_data['SALES_PRICE'],
			'total_price'	=>intval($product_data['SALES_PRICE'] * $product_data['PRODUCT_QTY'])
		);
	}
	
	$member_sql = "
		SELECT
			MI.NAME			AS MEMBER_NAME,
			MI.TEL_MOBILE	AS MEMBER_MOBILE,
			MI.EMAIL		AS MEMBER_EMAIL
		FROM
			dev.MEMBER MI
		WHERE
			MI.IDX = ".$member_idx."
	";
	
	$db->query($member_sql);
	
	$member_info = array();
	foreach($db->fetch() as $member_data) {
		$member_info[] = array(
			'member_name'		=>$member_data['MEMBER_NAME'],
			'member_mobile'		=>$member_data['MEMBER_MOBILE'],
			'member_email'		=>$member_data['MEMBER_EMAIL']
		);
	}
	
	$to_sql = "
		SELECT
			OT.TO_PLACE		AS TO_PLACE,
			OT.TO_NAME		AS TO_NAME,
			OT.TO_MOBILE	AS TO_MOBILE,
			OT.TO_ZIPCODE	AS TO_ZIPCODE,
			IFNULL(
				OT.TO_ROAD_ADDR,OT.TO_LOT_ADDR
			)				AS TO_ADDR,
			TO_DETAIL_ADDR	AS TO_DETAIL_ADDR
		FROM
			dev.ORDER_TO OT
		WHERE
			OT.MEMBER_IDX = ".$member_idx." AND
			OT.DEFAULT_FLG = TRUE
	";
	
	$db->query($to_sql);
	
	$to_info = array();
	foreach($db->fetch() as $to_data) {
		$to_info[] = array(
			'to_place'			=>$to_data['TO_PLACE'],
			'to_name'			=>$to_data['TO_NAME'],
			'to_mobile'			=>$to_data['TO_MOBILE'],
			'to_zipcode'		=>$to_data['TO_ZIPCODE'],
			'to_addr'			=>$to_data['TO_ADDR'],
			'to_detail_addr'	=>$to_data['TO_DETAIL_ADDR']
		);
	}
	
	$json_result['data'][] = array(
		'product_info'	=>$product_info,
		'member_info'	=>$member_info,
		'to_info'		=>$to_info
	);
}
}
?>