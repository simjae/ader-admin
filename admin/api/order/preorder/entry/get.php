<?php
/*
 +=============================================================================
 | 
 | 프리오더 관리 화면 - 프리오더 응모정보 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.01.15
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$country			= $_POST['country'];

$preorder_idx		= $_POST['preorder_idx'];
$param_option_idx	= $_POST['param_option_idx'];

if ($country != null && $preorder_idx != null) {
	$select_preorder_sql = "
		SELECT
			PP.IDX					AS PREORDER_IDX,
			PP.COUNTRY				AS COUNTRY,
			PP.PRODUCT_IDX			AS PRODUCT_IDX,
			CASE
				WHEN
					(
						SELECT
							COUNT(S_PI.IDX)
						FROM
							PRODUCT_IMG S_PI
						WHERE
							S_PI.PRODUCT_IDX = PR.IDX AND
							S_PI.IMG_TYPE = 'P' AND
							S_PI.IMG_SIZE = 'S'
					) > 0
					THEN
						(
							SELECT
								REPLACE(S_PI.IMG_LOCATION,'/var/www/admin/www','')
							FROM
								PRODUCT_IMG S_PI
							WHERE
								S_PI.PRODUCT_IDX = PR.IDX AND
								S_PI.DEL_FLG = FALSE AND
								S_PI.IMG_SIZE = 'S' AND
								S_PI.IMG_TYPE = 'P'
							ORDER BY
								S_PI.IDX ASC
							LIMIT
								0,1
						)
				ELSE
					'/images/default_product_img.jpg'
			END						AS IMG_LOCATION,
			PR.PRODUCT_CODE			AS PRODUCT_CODE,
			PR.PRODUCT_NAME			AS PRODUCT_NAME,
			PP.MEMBER_LEVEL			AS MEMBER_LEVEL,
			PP.SALES_PRICE			AS SALES_PRICE,
			PP.DISPLAY_FLG			AS DISPLAY_FLG,
			PP.ENTRY_START_DATE		AS ENTRY_START_DATE,
			PP.ENTRY_END_DATE		AS ENTRY_END_DATE
		FROM
			PAGE_PREORDER PP
			LEFT JOIN SHOP_PRODUCT PR ON
			PP.PRODUCT_IDX = PR.IDX
		WHERE
			PP.IDX = ".$preorder_idx."
	";	
	
	$db->query($select_preorder_sql);

	foreach($db->fetch() as $preorder_data) {
		$preorder_idx = $preorder_data['PREORDER_IDX'];
		
		$qty_info = array();
		if (!empty($preorder_idx)) {
			$select_qty_sql = "
				SELECT
					QP.IDX					AS QTY_IDX,
					QP.OPTION_IDX			AS OPTION_IDX,
					QP.OPTION_NAME			AS OPTION_NAME,
					QP.BARCODE				AS BARCODE,
					QP.PRODUCT_QTY			AS PRODUCT_QTY,
					QP.PRODUCT_QTY_LIMIT	AS PRODUCT_QTY_LIMIT
				FROM
					QTY_PREORDER QP
				WHERE
					QP.PREORDER_IDX = ".$preorder_idx."
			";
			
			if ($param_option_idx != null) {
				$select_qty_sql .= " AND (QP.OPTION_IDX = ".$param_option_idx.") ";
			}
			
			$db->query($select_qty_sql);
			
			
			foreach ($db->fetch() as $qty_data) {
				$option_idx = $qty_data['OPTION_IDX'];
				$entry_info = array();
				if (!empty($option_idx)) {
					$select_entry_sql = "
						SELECT
							EP.IDX					AS ENTRY_IDX,
							EP.MEMBER_IDX			AS MEMBER_IDX,
							EP.MEMBER_NAME			AS MEMBER_NAME,
							OI.MEMBER_MOBILE		AS MEMBER_MOBILE,
							OI.MEMBER_EMAIL			AS MEMBER_EMAIL,
							
							OI.ORDER_CODE			AS ORDER_CODE,
							OP.ORDER_PRODUCT_CODE	AS ORDER_PRODUCT_CODE,
							OP.ORDER_STATUS			AS ORDER_STATUS,
							
							OP.PRODUCT_QTY			AS PRODUCT_QTY,
							
							OI.PRICE_PRODUCT		AS PRICE_PRODUCT,
							OI.PRICE_MILEAGE_POINT	AS PRICE_MILEAGE_POINT,
							OI.PRICE_DISCOUNT		AS PRICE_DISCOUNT,
							OI.PRICE_DELIVERY		AS PRICE_DELIVERY,
							OI.PRICE_TOTAL			AS PRICE_TOTAL,
							
							OI.TO_PLACE				AS TO_PLACE,
							OI.TO_NAME				AS TO_NAME,
							OI.TO_MOBILE			AS TO_MOBILE,
							OI.TO_ZIPCODE			AS TO_ZIPCODE,
							OI.TO_LOT_ADDR			AS TO_LOT_ADDR,
							OI.TO_ROAD_ADDR			AS TO_ROAD_ADDR,
							OI.TO_DETAIL_ADDR		AS TO_DETAIL_ADDR,
							OI.ORDER_MEMO			AS TO_ORDER_MEMO,
							EP.CREATE_DATE			AS CREATE_DATE
						FROM
							ENTRY_PREORDER EP
							LEFT JOIN ORDER_INFO OI ON
							EP.ORDER_IDX = OI.IDX
							LEFT JOIN ORDER_PRODUCT OP ON
							EP.ORDER_IDX = OP.ORDER_IDX
						WHERE
							EP.PREORDER_IDX = ".$preorder_idx." AND
							EP.OPTION_IDX = ".$option_idx." AND
							EP.DEL_FLG = FALSE
					";
					$db->query($select_entry_sql);
					
					foreach($db->fetch() as $entry_data) {
						$entry_info[] = array(
							'entry_idx'				=>$entry_data['ENTRY_IDX'],
							'member_idx'			=>$entry_data['MEMBER_IDX'],
							'member_name'			=>$entry_data['MEMBER_NAME'],
							'member_mobile'			=>$entry_data['MEMBER_MOBILE'],
							'member_email'			=>$entry_data['MEMBER_EMAIL'],
							
							'order_code'			=>$entry_data['ORDER_CODE'],
							'order_product_code'	=>$entry_data['ORDER_PRODUCT_CODE'],
							'order_status'			=>$entry_data['ORDER_STATUS'],
							
							'product_qty'			=>$entry_data['PRODUCT_QTY'],
							
							'price_product'			=>$entry_data['PRICE_PRODUCT'],
							'price_mileage_point'	=>$entry_data['PRICE_MILEAGE_POINT'],
							'price_discount'		=>$entry_data['PRICE_DISCOUNT'],
							'price_delivery'		=>$entry_data['PRICE_DELIVERY'],
							'price_total'			=>$entry_data['PRICE_TOTAL'],
							
							'to_place'				=>$entry_data['TO_PLACE'],
							'to_name'				=>$entry_data['TO_NAME'],
							'to_mobile'				=>$entry_data['TO_MOBILE'],
							'to_zipcode'			=>$entry_data['TO_ZIPCODE'],
							'to_lot_addr'			=>$entry_data['TO_LOT_ADDR'],
							'to_road_addr'			=>$entry_data['TO_ROAD_ADDR'],
							'to_detail_addr'		=>$entry_data['TO_DETAIL_ADDR'],
							'to_order_memo'			=>$entry_data['TO_ORDER_MEMO'],
							'create_date'			=>$entry_data['CREATE_DATE'],
						);
					}
				}
				
				$qty_info[] = array(
					'qty_idx'			=>$qty_data['QTY_IDX'],
					'option_idx'		=>$qty_data['OPTION_IDX'],
					'option_name'		=>$qty_data['OPTION_NAME'],
					'barcode'			=>$qty_data['BARCODE'],
					'product_qty'		=>$qty_data['PRODUCT_QTY'],
					'product_qty_limit'	=>$qty_data['PRODUCT_QTY_LIMIT'],
					
					'entry_info'		=>$entry_info
				);
			}
		}
		
		$json_result['data'][] = array(
			'preorder_idx'		=>$preorder_data['PREORDER_IDX'],
			'country'			=>$preorder_data['COUNTRY'],
			'member_level'		=>$preorder_data['MEMBER_LEVEL'],
			'product_idx'		=>$preorder_data['PRODUCT_IDX'],
			'img_location'		=>$preorder_data['IMG_LOCATION'],
			'product_code'		=>$preorder_data['PRODUCT_CODE'],
			'product_name'		=>$preorder_data['PRODUCT_NAME'],
			'sales_price'		=>$preorder_data['SALES_PRICE'],
			'display_flg'		=>$preorder_data['DISPLAY_FLG'],
			'entry_start_date'	=>$preorder_data['ENTRY_START_DATE'],
			'entry_end_date'	=>$preorder_data['ENTRY_END_DATE'],
			
			'qty_info'			=>$qty_info
		);
	}
}
?>