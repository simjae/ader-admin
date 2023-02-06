<?php
/*
 +=============================================================================
 | 
 | 드로우 관리 화면 - 드로우 응모정보 조회
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

$draw_idx			= $_POST['draw_idx'];
$param_option_idx	= $_POST['param_option_idx'];

$member_name		= $_POST['member_name'];
$purchase_flg		= $_POST['purchase_flg'];
$prize_flg			= $_POST['prize_flg'];
$apply_start_date	= $_POST['apply_start_date'];
$apply_end_date		= $_POST['apply_end_date'];

$rows 				= $_POST['rows'];
$page 				= $_POST['page'];


/*엔트리 검색 조건*/





/*              */

if ($country != null && $draw_idx != null) {
	$select_draw_sql = "
		SELECT
			PD.IDX					AS DRAW_IDX,
			PD.COUNTRY				AS COUNTRY,
			PD.PRODUCT_IDX			AS PRODUCT_IDX,
			PD.MEMBER_LEVEL			AS MEMBER_LEVEL,
			CASE
				WHEN
					(
						SELECT
							COUNT(S_PI.IDX)
						FROM
							dev.PRODUCT_IMG S_PI
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
								dev.PRODUCT_IMG S_PI
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
			PD.SALES_PRICE			AS SALES_PRICE,
			PD.DISPLAY_FLG			AS DISPLAY_FLG,
			PD.ENTRY_START_DATE		AS ENTRY_START_DATE,
			PD.ENTRY_END_DATE		AS ENTRY_END_DATE,
			PD.ANNOUNCE_DATE		AS ANNOUNCE_DATE,
			PD.PURCHASE_START_DATE	AS PURCHASE_START_DATE,
			PD.PURCHASE_END_DATE	AS PURCHASE_END_DATE
		FROM
			dev.PAGE_DRAW PD
			LEFT JOIN dev.SHOP_PRODUCT PR ON
			PD.PRODUCT_IDX = PR.IDX
		WHERE
			PD.IDX = ".$draw_idx." AND
			PD.COUNTRY = '".$country."'
	";	
	
	$db->query($select_draw_sql);
	$qty_info = array();

	$total = 0;
	$total_cnt = 0;


	foreach($db->fetch() as $draw_data) {
		$draw_idx = $draw_data['DRAW_IDX'];
		if (!empty($draw_idx)) {
			$select_qty_sql = "
				SELECT
					QD.IDX					AS QTY_IDX,
					QD.OPTION_IDX			AS OPTION_IDX,
					QD.OPTION_NAME			AS OPTION_NAME,
					QD.BARCODE				AS BARCODE,
					QD.PRODUCT_QTY			AS PRODUCT_QTY
				FROM
					dev.QTY_DRAW QD
				WHERE
					QD.DRAW_IDX = ".$draw_idx."
			";
			
			if ($param_option_idx != null) {
				$select_qty_sql .= " AND (QD.OPTION_IDX = ".$param_option_idx.") ";
			}
			
			$db->query($select_qty_sql);
			
			$order = '';
			if ($sort_value != null && $sort_type != null) {
				$order = ' ED.'.$sort_value." ".$sort_type." ";
			} else {
				$order = ' ED.IDX DESC';
			}
			
			$limit_start = (intval($page)-1)*$rows;
			$limit = '';
			if ($rows != null) {
				$limit .= " LIMIT ".$limit_start.",".$rows;
			}

			foreach ($db->fetch() as $qty_data) {
				$option_idx = $qty_data['OPTION_IDX'];
				
				if (!empty($option_idx)) {
					$entry_where = "
						ED.DRAW_IDX = ".$draw_idx." AND
						ED.OPTION_IDX = ".$option_idx." AND
						ED.DEL_FLG = FALSE
					";

					$entry_where_cnt = $entry_where;

					if($member_name != null){
						$entry_where .= " AND ED.MEMBER_NAME LIKE '%".$member_level."%' ";
					}

					if($purchase_flg != null){
						$entry_where .= " AND ED.PURCHASE_FLG = ".$purchase_flg." ";
					}


					if($prize_flg != null){
						$entry_where .= " AND ED.PRIZE_FLG = ".$prize_flg." ";
					}

					if ($apply_start_date != null && $apply_end_date != null) {
						$entry_where .= " AND (ED.CREATE_DATE BETWEEN '".$apply_start_date."' AND '".$apply_end_date."') ";
					}

					$total += $db->count("dev.ENTRY_DRAW ED
											LEFT JOIN dev.ORDER_INFO OI ON
											ED.ORDER_IDX = OI.IDX
											LEFT JOIN dev.ORDER_PRODUCT OP ON
											ED.ORDER_IDX = OP.ORDER_IDX", $entry_where);
					$total_cnt += $db->count("dev.ENTRY_DRAW ED
											LEFT JOIN dev.ORDER_INFO OI ON
											ED.ORDER_IDX = OI.IDX
											LEFT JOIN dev.ORDER_PRODUCT OP ON
											ED.ORDER_IDX = OP.ORDER_IDX", $entry_where_cnt);

					$entry_info = array();
					
					$select_entry_sql = "
						SELECT
							ED.IDX					AS ENTRY_IDX,
							ED.MEMBER_IDX			AS MEMBER_IDX,
							ED.MEMBER_NAME			AS MEMBER_NAME,
							ED.PRIZE_FLG			AS PRIZE_FLG,
							ED.PURCHASE_FLG			AS PURCHASE_FLG,
							ED.ORDER_IDX			AS ORDER_IDX
						FROM
							dev.ENTRY_DRAW ED
							LEFT JOIN dev.ORDER_INFO OI ON
							ED.ORDER_IDX = OI.IDX
							LEFT JOIN dev.ORDER_PRODUCT OP ON
							ED.ORDER_IDX = OP.ORDER_IDX
						WHERE
							".$entry_where."
						ORDER BY
							".$order."
						".$limit."
					";
					
					$db->query($select_entry_sql);
					
					
					foreach($db->fetch() as $entry_data) {
						$order_info = array();
						$prize_flg = $entry_data['PRIZE_FLG'];
						$purchase_flg = $entry_data['PURCHASE_FLG'];
						$order_idx = $entry_data['ORDER_IDX'];
						
						if ($prize_flg == true && $purchase_flg == true && $order_idx > 0) {
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
									dev.ORDER_INFO OI
									LEFT JOIN dev.ORDER_PRODUCT OP ON
									OI.IDX = OP.ORDER_IDX
								WHERE
									OI.IDX = ".$order_idx."
							";
							
							$db->query($select_order_sql);
							
							foreach($db->fetch() as $order_data) {
								$order_info[] = array(
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
							'prize_flg'		=>$entry_data['PRIZE_FLG'],
							'purchase_flg'	=>$entry_data['PURCHASE_FLG'],
							'order_idx'		=>$entry_data['ORDER_IDX'],
							
							'order_info'	=>$order_info
						);
					}
				}
				
				$qty_info[] = array(
					'qtyt_idx'			=>$qty_data['QTY_IDX'],
					'option_idx'		=>$qty_data['OPTION_IDX'],
					'option_name'		=>$qty_data['OPTION_NAME'],
					'barcode'			=>$qty_data['BARCODE'],
					'product_qty'		=>$qty_data['PRODUCT_QTY'],
					
					'entry_info'		=>$entry_info
				);
			}
			$json_result = array(
				'total' => $total,
				'total_cnt' => $total_cnt,
				'page' => $page
			);
		}
		
		$json_result['data'][] = array(
			'draw_idx'			=>$draw_data['DRAW_IDX'],
			'country'				=>$draw_data['COUNTRY'],
			'member_level'			=>$draw_data['MEMBER_LEVEL'],
			'product_idx'			=>$draw_data['PRODUCT_IDX'],
			'img_location'			=>$draw_data['IMG_LOCATION'],
			'product_code'			=>$draw_data['PRODUCT_CODE'],
			'product_name'			=>$draw_data['PRODUCT_NAME'],
			'sales_price'			=>$draw_data['SALES_PRICE'],
			'display_flg'			=>$draw_data['DISPLAY_FLG'],
			'entry_start_date'		=>$draw_data['ENTRY_START_DATE'],
			'entry_end_date'		=>$draw_data['ENTRY_END_DATE'],
			'announce_date'			=>$draw_data['ANNOUNCE_DATE'],
			'purchase_start_date'	=>$draw_data['PURCHASE_START_DATE'],
			'purchase_end_date'		=>$draw_data['PURCHASE_END_DATE'],
			
			'qty_info'				=>$qty_info
		);
	}
}
?>