<?php
/*
 +=============================================================================
 | 
 | 7-2. 취소/교환/반훔/환불 - 교환 주문 추가
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.11.08
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

include_once("/var/www/admin/api/common/common.php");

$session_id				= sessionCheck();
$order_code				= $_POST['order_code'];
$product_idx			= $_POST['product_idx'];
$option_idx				= $_POST['option_idx'];
$product_qty			= $_POST['product_qty'];

if ($order_code && $product_idx != null && $option_idx != null) {
	$tmp_order_product_cnt = $db->count("TMP_ORDER_PRODUCT","ORDER_CODE = '".$order_code."' AND PRODUCT_IDX = ".$product_idx." AND OPTION_IDX = ".$option_idx);
	if ($tmp_order_product_cnt > 0) {
		$json_result['code'] = 301;
		$json_result['msg'] = "중복된 상품을 교환대상 상품으로 지정할 수 없습니다.";
	}
	
	$select_product_stock_sql = "
		SELECT
			(
				SELECT
					IFNULL(SUM(S_PS.STOCK_QTY),0)
				FROM
					PRODUCT_STOCK S_PS
				WHERE
					S_PS.PRODUCT_IDX = PR.IDX AND
					S_PS.OPTION_IDX = OO.IDX AND
					S_PS.STOCK_DATE <= NOW()
			)			AS STOCK_QTY,
			(
				SELECT
					IFNULL(SUM(S_OP.PRODUCT_QTY),0)
				FROM
					ORDER_PRODUCT S_OP
				WHERE
					S_OP.ORDER_STATUS IN ('PCP','PPR','DPR','DPG','DCP') AND
					S_OP.PRODUCT_IDX = PR.IDX AND
					S_OP.OPTION_IDX = OO.IDX
			)			AS ORDER_QTY
		FROM
			SHOP_PRODUCT PR
			LEFT JOIN ORDERSHEET_OPTION OO ON
			PR.ORDERSHEET_IDX = OO.ORDERSHEET_IDX
		WHERE
			PR.IDX = '".$product_idx."' AND
			OO.IDX = '".$option_idx."'
	";
	
	$stock_qty = 0;
	$order_qty = 0;
	
	$db->query($select_product_stock_sql);
	
	foreach($db->fetch() as $stock_data) {
		$stock_qty = $stock_data['STOCK_QTY'];
		$order_qty = $stock_data['ORDER_QTY'];
	}
	
	$stock_left = intval($stock_qty - $order_qty);
	
	if ($stock_left > 0) {
		$product_cnt = $db->count("ORDER_PRODUCT","ORDER_CODE = '".$order_code."' AND PRODUCT_CODE NOT LIKE 'VOUXXX%%%'");
		
		$select_exchange_product_sql = "
			SELECT
				PR.IDX						AS PRODUCT_IDX,
				PR.PRODUCT_TYPE				AS PRODUCT_TYPE,
				PR.PRODUCT_CODE				AS PRODUCT_CODE,
				PR.PRODUCT_NAME				AS PRODUCT_NAME,
				PR.SALES_PRICE_KR			AS SALES_PRICE_KR,
				PR.SALES_PRICE_EN			AS SALES_PRICE_EN,
				PR.SALES_PRICE_CN			AS SALES_PRICE_CN,
				PR.REORDER_CNT				AS REORDER_CNT,
				OM.PREORDER_FLG				AS PREORDER_FLG,
				PR.INDP_FLG					AS INDP_FLG,
				OO.IDX						AS OPTION_IDX,
				OO.BARCODE					AS BARCODE,
				OO.OPTION_NAME				AS OPTION_NAME
			FROM
				SHOP_PRODUCT PR
				LEFT JOIN ORDERSHEET_MST OM ON
				PR.ORDERSHEET_IDX = OM.IDX
				LEFT JOIN ORDERSHEET_OPTION OO ON
				PR.ORDERSHEET_IDX = OO.ORDERSHEET_IDX
			WHERE
				PR.IDX = ".$product_idx." AND
				OO.IDX = ".$option_idx." AND
				PR.DEL_FLG = FALSE
		";
		
		$db->query($select_exchange_product_sql);
		
		$product_info = array();
		foreach($db->fetch() as $product_data) {
			$product_info = array(
				'product_idx'		=>$product_data['PRODUCT_IDX'],
				'product_type'		=>$product_data['PRODUCT_TYPE'],
				'sales_price_kr'	=>$product_data['SALES_PRICE_KR'],
				'sales_price_en'	=>$product_data['SALES_PRICE_EN'],
				'sales_price_cn'	=>$product_data['SALES_PRICE_CN'],
				'reorder_cnt'		=>$product_data['REORDER_CNT'],
				'preorder_flg'		=>$product_data['PREORDER_FLG'],
				'product_code'		=>$product_data['PRODUCT_CODE'],
				'product_name'		=>$product_data['PRODUCT_NAME'],
				'indp_flg'			=>$product_data['INDP_FLG'],
				'option_idx'		=>$product_data['OPTION_IDX'],
				'barcode'			=>$product_data['BARCODE'],
				'option_name'		=>$product_data['OPTION_NAME']
			);
		}
		
		$insert_tmp_order_product_sql = "
			INSERT INTO
				TMP_ORDER_PRODUCT
			(
				ORDER_IDX,
				ORDER_CODE,
				ORDER_PRODUCT_CODE,
				ORDER_STATUS,
				PRODUCT_IDX,
				PRODUCT_TYPE,
				REORDER_CNT,
				PREORDER_FLG,
				PRODUCT_CODE,
				PRODUCT_NAME,
				PRODUCT_PRICE,
				OPTION_IDX,
				BARCODE,
				OPTION_NAME,
				PRODUCT_QTY,
				CREATER,
				UPDATER
			)
			SELECT
				OI.IDX									AS ORDER_IDX,
				OI.ORDER_CODE							AS ORDER_CODE,
				CONCAT(
					OI.ORDER_CODE,
					'_".intval($product_cnt + 1)."'
				)										AS ORDER_PRODUCT_CODE,
				'PWT'									AS ORDER_STATUS,
				".$product_info['product_idx']."		AS PRODUCT_IDX,
				'".$product_info['product_type']."'		AS PRODUCT_TYPE,
				".$product_info['reorder_cnt']."		AS REORDER_CNT,
				".$product_info['preorder_flg']."		AS PREORDER_FLG,
				'".$product_info['product_code']."'		AS PRODUCT_CODE,
				'".$product_info['product_name']."'		AS PRODUCT_NAME,
				CASE
					WHEN
						OI.COUNTRY = 'KR'
						THEN
							".$product_info['sales_price_kr']."
					WHEN
						OI.COUNTRY = 'EN'
						THEN
							".$product_info['sales_price_en']."
					WHEN
						OI.COUNTRY = 'CN'
						THEN
							".$product_info['sales_price_cn']."
				END										AS PRODUCT_PRICE,
				".$product_info['option_idx']."			AS OPTION_IDX,
				'".$product_info['barcode']."'			AS BARCODE,
				'".$product_info['option_name']."'		AS OPTION_NAME,
				".$product_qty."						AS PRODUC_QTY,
				'".$session_id."'						AS CREATER,
				'".$session_id."'						AS UPDATER
			FROM
				ORDER_INFO OI
			WHERE
				OI.ORDER_CODE = '".$order_code."'
		";
		
		$db->query($insert_tmp_order_product_sql);
		
		$product_cnt++;
	} else {
		$json_result['code'] = 301;
		$json_result['msg'] = "이미 품절된 상품은 추가할 수 없습니다.";
	}
}

?>