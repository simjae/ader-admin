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
		$select_product_sql = "
			SELECT
				BI.IDX							AS BASKET_IDX,
				(
					SELECT
						REPLACE(S_PI.IMG_LOCATION,'/var/www/admin/www/','')
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
				)								AS IMG_LOCATION,
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
		
		$db->query($select_product_sql);
		
		$total_price = 0;
		$product_info = array();
		foreach($db->fetch() as $product_data) {
			$total_price = intval($product_data['SALES_PRICE'] * $product_data['PRODUCT_QTY']);
			
			$product_info[] = array(
				'img_location'	=>$product_data['IMG_LOCATION'],
				'product_name'	=>$product_data['PRODUCT_NAME'],
				'color'			=>$product_data['COLOR'],
				'color_rgb'		=>$product_data['COLOR_RGB'],
				'option_name'	=>$product_data['OPTION_NAME'],
				'refund_flg'	=>$product_data['REFUND_FLG'],
				'product_qty'	=>$product_data['PRODUCT_QTY'],
				'sales_price'	=>$product_data['SALES_PRICE'],
				'total_price'	=>$total_price
			);
		}
		
		$select_member_sql = "
			SELECT
				MI.NAME			AS MEMBER_NAME,
				MI.TEL_MOBILE	AS MEMBER_MOBILE,
				MI.EMAIL		AS MEMBER_EMAIL
			FROM
				dev.MEMBER MI
			WHERE
				MI.IDX = ".$member_idx."
		";
		
		$db->query($select_member_sql);
		
		$member_info = array();
		foreach($db->fetch() as $member_data) {
			$member_info[] = array(
				'member_name'		=>$member_data['MEMBER_NAME'],
				'member_mobile'		=>$member_data['MEMBER_MOBILE'],
				'member_email'		=>$member_data['MEMBER_EMAIL']
			);
		}
		
		$select_order_to_sql = "
			SELECT
				OT.TO_PLACE			AS TO_PLACE,
				OT.TO_NAME			AS TO_NAME,
				OT.TO_MOBILE		AS TO_MOBILE,
				OT.TO_ZIPCODE		AS TO_ZIPCODE,
				OT.TO_ROAD_ADDR		AS TO_ROAD_ADDR,
				OT.TO_LOT_ADDR		AS TO_LOT_ADDR,
				TO_DETAIL_ADDR		AS TO_DETAIL_ADDR
			FROM
				dev.ORDER_TO OT
			WHERE
				OT.MEMBER_IDX = ".$member_idx." AND
				OT.DEFAULT_FLG = TRUE
		";
		
		$db->query($select_order_to_sql);
		
		$order_to_info = array();
		foreach($db->fetch() as $order_to_data) {
			$order_to_info[] = array(
				'to_place'			=>$order_to_data['TO_PLACE'],
				'to_name'			=>$order_to_data['TO_NAME'],
				'to_mobile'			=>$order_to_data['TO_MOBILE'],
				'to_zipcode'		=>$order_to_data['TO_ZIPCODE'],
				'to_road_addr'		=>$order_to_data['TO_ROAD_ADDR'],
				'to_lot_addr'		=>$order_to_data['TO_LOT_ADDR'],
				'to_detail_addr'	=>$order_to_data['TO_DETAIL_ADDR']
			);
		}
		
		$voucher_table = "
			dev.VOUCHER_MST VM
			LEFT JOIN dev.VOUCHER_ISSUE VI ON
			VM.IDX = VI.VOUCHER_IDX
		";
		
		$voucher_where = "
			VM.VOUCHER_START_DATE < NOW() AND
			VM.VOUCHER_END_DATE > NOW() AND
			VM.DEL_FLG = FALSE AND
			VI.COUNTRY = '".$country."' AND
			VI.USED_FLG = FALSE AND
			VI.USABLE_START_DATE < NOW() AND
			VI.USABLE_END_DATE > NOW() AND
			VI.MEMBER_IDX = ".$member_idx." AND
			VI.DEL_FLG = FALSE
		";
		
		$voucher_cnt = $db->count($voucher_table,$voucher_where);
		
		$select_voucher_sql = "
			SELECT
				VI.IDX				AS VOUCHER_IDX,
				VM.VOUCHER_NAME		AS VOUCHER_NAME,
				VM.SALE_PRICE		AS SALE_PRICE,
				VM.MILEAGE_FLG		AS MILEAGE_FLG
			FROM
				dev.VOUCHER_MST VM
				LEFT JOIN dev.VOUCHER_ISSUE VI ON
				VM.IDX = VI.VOUCHER_IDX
			WHERE
				
				VM.MIN_PRICE <= ".$total_price." AND
				".$voucher_where."
		";
		
		$db->query($select_voucher_sql);
		
		$voucher_info = array();
		foreach($db->fetch() as $voucher_data) {
			$voucher_info[] = array(
				'voucher_idx'		=>$voucher_data['VOUCHER_IDX'],
				'voucher_name'		=>$voucher_data['VOUCHER_NAME'],
				'sale_price'		=>$voucher_data['SALE_PRICE'],
				'mileage_flg'		=>$voucher_data['MILEAGE_FLG']
			);
		}
		
		$json_result['data'][] = array(
			'product_info'		=>$product_info,
			'member_info'		=>$member_info,
			'order_to_info'		=>$order_to_info,
			'voucher_cnt'		=>$voucher_cnt,
			'voucher_info'		=>$voucher_info
		);
	}
}
?>