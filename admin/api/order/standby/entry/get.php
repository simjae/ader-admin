<?php
/*
 +=============================================================================
 | 
 | 스탠바이 관리 화면 - 스탠바이 응모정보 조회
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

$standby_idx		= $_POST['standby_idx'];
$param_option_idx	= $_POST['param_option_idx'];

if ($country != null && $standby_idx != null) {
	$select_standby_sql = "
		SELECT
			PS.IDX					AS STANDBY_IDX,
			PS.COUNTRY				AS COUNTRY,
			PS.PRODUCT_IDX			AS PRODUCT_IDX,
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
			PS.SALES_PRICE			AS SALES_PRICE,
			PS.DISPLAY_FLG			AS DISPLAY_FLG,
			PS.ENTRY_START_DATE		AS ENTRY_START_DATE,
			PS.ENTRY_END_DATE		AS ENTRY_END_DATE,
			PS.PURCHASE_START_DATE	AS PURCHASE_START_DATE,
			PS.PURCHASE_END_DATE	AS PURCHASE_END_DATE,
			PS.MEMBER_LEVEL			AS MEMBER_LEVEL,
			(SELECT COLOR FROM ORDERSHEET_MST WHERE IDX = PR.ORDERSHEET_IDX) AS COLOR
		FROM
			PAGE_STANDBY PS
			LEFT JOIN SHOP_PRODUCT PR ON
			PS.PRODUCT_IDX = PR.IDX
		WHERE
			PS.IDX = ".$standby_idx."
	";	
	
	$db->query($select_standby_sql);

	foreach($db->fetch() as $standby_data) {
		$standby_idx = $standby_data['STANDBY_IDX'];
		
		$qty_info = array();
		if (!empty($standby_idx)) {
			$select_qty_sql = "
				SELECT
					QS.IDX					AS QTY_IDX,
					QS.OPTION_IDX			AS OPTION_IDX,
					QS.OPTION_NAME			AS OPTION_NAME,
					QS.BARCODE				AS BARCODE,
					QS.PRODUCT_QTY			AS PRODUCT_QTY
				FROM
					QTY_STANDBY QS
				WHERE
					QS.STANDBY_IDX = ".$standby_idx."
			";
			
			if ($param_option_idx != null) {
				$select_qty_sql .= " AND (QS.OPTION_IDX = ".$param_option_idx.") ";
			}
			
			$db->query($select_qty_sql);
			
			$entry_info = array();
			foreach ($db->fetch() as $qty_data) {
				$option_idx = $qty_data['OPTION_IDX'];
				
				if (!empty($option_idx)) {
					$select_entry_sql = "
						SELECT
							ES.IDX					AS ENTRY_IDX,
							ES.MEMBER_IDX			AS MEMBER_IDX,
							ES.MEMBER_NAME			AS MEMBER_NAME,
							ES.PURCHASE_FLG			AS PURCHASE_FLG,
							ES.ORDER_IDX			AS ORDER_IDX,
							ES.CREATE_dATE			AS CREATE_DATE
						FROM
							ENTRY_STANDBY ES
							LEFT JOIN ORDER_INFO OI ON
							ES.ORDER_IDX = OI.IDX
							LEFT JOIN ORDER_PRODUCT OP ON
							ES.ORDER_IDX = OP.ORDER_IDX
						WHERE
							ES.STANDBY_IDX = ".$standby_idx." AND
							ES.OPTION_IDX = ".$option_idx." AND
							ES.DEL_FLG = FALSE
					";
					
					$db->query($select_entry_sql);
					
					foreach($db->fetch() as $entry_data) {
						$purchase_flg = $entry_data['PURCHASE_FLG'];
						$order_idx = $entry_data['ORDER_IDX'];
						
						$order_info = array();
						if ($purchase_flg == true && $order_idx > 0) {
							$select_order_sql = "
								SELECT
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
									OI.ORDER_MEMO			AS TO_ORDER_MEMO
								FROM
									ORDER_INFO OI
									LEFT JOIN ORDER_PRODUCT OP ON
									OI.IDX = OP.ORDER_IDX
								WHERE
									OI.IDX = ".$order_idx."
							";
							
							$db->query($select_order_sql);
							
							foreach($db->fetch() as $order_data) {
								$order_info = array(
									'order_code'			=>$order_data['ORDER_CODE'],
									'order_product_code'	=>$order_data['ORDER_PRODUCT_CODE'],
									'order_status'			=>$order_data['ORDER_STATUS'],
									
									'product_qty'			=>$order_data['PRODUCT_QTY'],
									
									'price_product'			=>$order_data['PRICE_PRODUCT'],
									'price_mileage_point'	=>$order_data['PRICE_MILEAGE_POINT'],
									'price_discount'		=>$order_data['PRICE_DISCOUNT'],
									'price_delivery'		=>$order_data['PRICE_DELIVERY'],
									'price_total'			=>$order_data['PRICE_TOTAL'],
									
									'to_place'				=>$order_data['TO_PLACE'],
									'to_name'				=>$order_data['TO_NAME'],
									'to_mobile'				=>$order_data['TO_MOBILE'],
									'to_zipcode'			=>$order_data['TO_ZIPCODE'],
									'to_lot_addr'			=>$order_data['TO_LOT_ADDR'],
									'to_road_addr'			=>$order_data['TO_ROAD_ADDR'],
									'to_detail_addr'		=>$order_data['TO_DETAIL_ADDR'],
									'to_order_memo'			=>$order_data['TO_ORDER_MEMO']
								);
							}
						}
						
						$entry_info[] = array(
							'entry_idx'		=>$entry_data['ENTRY_IDX'],
							'member_idx'	=>$entry_data['MEMBER_IDX'],
							'member_name'	=>$entry_data['MEMBER_NAME'],
							'member_mobile'	=>$entry_data['MEMBER_MOBILE'],
							'member_email'	=>$entry_data['MEMBER_EMAIL'],
							'purchase_flg'	=>$entry_data['PURCHASE_FLG'],
							'order_idx'		=>$entry_data['ORDER_IDX'],
							'create_date'	=>$entry_data['CREATE_DATA'],
							
							'order_info'	=>$order_info
						);
					}
				}
				
				$qty_info[] = array(
					'qty_idx'			=>$qty_data['QTY_IDX'],
					'option_idx'		=>$qty_data['OPTION_IDX'],
					'option_name'		=>$qty_data['OPTION_NAME'],
					'barcode'			=>$qty_data['BARCODE'],
					'product_qty'		=>$qty_data['PRODUCT_QTY'],
					
					'entry_info'		=>$entry_info
				);
			}
		}
		
		$json_result['data'][] = array(
			'standby_idx'			=>$standby_data['STANDBY_IDX'],
			'country'				=>$standby_data['COUNTRY'],
			'member_level'			=>$standby_data['MEMBER_LEVEL'],
			'product_idx'			=>$standby_data['PRODUCT_IDX'],
			'img_location'			=>$standby_data['IMG_LOCATION'],
			'product_code'			=>$standby_data['PRODUCT_CODE'],
			'product_name'			=>$standby_data['PRODUCT_NAME'],
			'sales_price'			=>$standby_data['SALES_PRICE'],
			'display_flg'			=>$standby_data['DISPLAY_FLG'],
			'entry_start_date'		=>$standby_data['ENTRY_START_DATE'],
			'entry_end_date'		=>$standby_data['ENTRY_END_DATE'],
			'purchase_start_date'	=>$standby_data['PURCHASE_START_DATE'],
			'purchase_end_date'		=>$standby_data['PURCHASE_END_DATE'],
			'color'					=>$standby_data['COLOR'],
			
			'qty_info'				=>$qty_info
		);
	}
}
?>