<?php
/*
 +=============================================================================
 | 
 | 상품 진열 페이지_상품 라이브러리 검색 모달 - 상품 라이브러리 검색
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.08.15
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

include_once("/var/www/admin/api/common/common.php");

$session_id					= sessionCheck();
$order_product_idx			= $_POST['order_product_idx'];
$order_product_qty			= $_POST['order_product_qty'];
$action_type				= $_POST['action_type'];

if ($order_product_idx != null && $action_type != null) {
	$select_product_info_sql = "
		SELECT
			OI.COUNTRY				AS COUNTRY,
			PR.SALES_PRICE_KR		AS SALES_PRICE_KR,
			PR.SALES_PRICE_EN		AS SALES_PRICE_EN,
			PR.SALES_PRICE_CN		AS SALES_PRICE_CN,
			(
				SELECT
					IFNULL(SUM(S_PS.STOCK_QTY),0)
				FROM
					PRODUCT_STOCK S_PS
				WHERE
					S_PS.PRODUCT_IDX = OP.PRODUCT_IDX AND
					S_PS.OPTION_IDX = OP.OPTION_IDX AND
					S_PS.STOCK_DATE <= NOW()
			)						AS STOCK_QTY,
			(
				SELECT
					IFNULL(SUM(S_OP.PRODUCT_QTY),0)
				FROM
					ORDER_PRODUCT S_OP
				WHERE
					S_OP.ORDER_STATUS IN ('PCP','PPR','DPR','DPG','DCP') AND
					S_OP.PRODUCT_IDX = OP.PRODUCT_IDX AND
					S_OP.OPTION_IDX = OP.OPTION_IDX
			)						AS ORDER_QTY
		FROM
			SHOP_PRODUCT PR
			LEFT JOIN ORDERSHEET_OPTION OO ON
			PR.ORDERSHEET_IDX = OO.IDX
			LEFT JOIN TMP_ORDER_PRODUCT OP ON
			PR.IDX = OP.PRODUCT_IDX
			LEFT JOIN ORDER_INFO OI ON
			OP.ORDER_CODE = OI.ORDER_CODE
		WHERE
			OP.IDX = '".$order_product_idx."'
	";
	
	$db->query($select_product_info_sql);
	
	$product_info = array();
	foreach($db->fetch() as $product_data) {
		$country = $product_data['COUNTRY'];
		$product_info = array(
			'country'			=>$country,
			'sales_price'		=>$product_data['SALES_PRICE_'.$country],
			'stock_qty'			=>$product_data['STOCK_QTY'],
			'order_qty'			=>$product_data['ORDER_QTY'],
			'stock_left'		=>intval($product_data['STOCK_QTY'] - $product_data['ORDER_QTY']),
		);
	}
	
	if ($product_info['stock_left'] > 0) {
		if ($action_type == "UP") {
			$order_product_qty += 1;
			$update_product_qty = " PRODUCT_QTY = PRODUCT_QTY + 1 ";
		} else if ($action_type == "DOWN") {
			$order_product_qty -= 1;
			$update_product_qty = " PRODUCT_QTY = PRODUCT_QTY - 1 ";
		}
		
		if ($product_info['stock_left'] >= $order_product_qty && strlen($update_product_qty) > 0) {
			$product_price = intval($order_product_qty * $product_info['sales_price']);
			
			$update_product_qty_sql = "
				UPDATE
					TMP_ORDER_PRODUCT
				SET
					".$update_product_qty.",
					PRODUCT_PRICE = ".$product_price.",
					UPDATE_DATE = NOW(),
					UPDATER = '".$session_id."'
				WHERE
					IDX = ".$order_product_idx."
			";
			
			$db->query($update_product_qty_sql);
		} else {
			$json_result['code'] = 302;
			$json_result['msg'] = "교환대상 상품의 재고가 부족합니다. 재고수량을 확인해주세요.";
		}
	} else {
		$json_result['code'] = 301;
		$json_result['msg'] = "이미 품절된 상품입니다.";
	}
}

?>