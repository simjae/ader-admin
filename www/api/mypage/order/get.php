<?php
/*
 +=============================================================================
 | 
 | 마이페이지_주문조회화면
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2023.01.30
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

$order_idx = 0;
if (isset($_POST['order_idx'])) {
	$order_idx = $_POST['order_idx'];
}

if ($member_idx > 0 && $order_idx > 0) {
	$select_order_sql = "
		SELECT
			OI.IDX				AS ORDER_IDX,
			OI.ORDER_CODE		AS ORDER_CODE,
			OI.ORDER_TITLE		AS ORDER_TITLE,
			OI.ORDER_STATUS		AS ORDER_STATUS,
			OI.PREORDER_FLG		AS PREORDER_FLG,
			DATE_FORMAT(
				OI.ORDER_DATE,
				'%Y.%m.%d'
			)					AS ORDER_DATE,
			DATE_FORMAT(
				OI.CANCEL_DATE,
				'%Y.%m.%d'
			)					AS CANCEL_DATE,
			DATE_FORMAT(
				OI.EXCHANGE_DATE,
				'%Y.%m.%d'
			)					AS EXCHANGE_DATE,
			DATE_FORMAT(
				OI.REFUND_DATE,
				'%Y.%m.%d'
			)						AS REFUND_DATE,
			
			OI.MEMBER_NAME			AS MEMBER_NAME,
			OI.MEMBER_MOBILE		AS MEMBER_MOBILE,
			
			OI.PRICE_PRODUCT		AS PRICE_PRODUCT,
			OI.PRICE_DELIVERY		AS PRICE_DELIVERY,
			OI.PRICE_DISCOUNT		AS PRICE_DISCOUNT,
			OI.PRICE_MILEAGE_POINT	AS PRICE_MILEAGE_POINT,
			OI.PRICE_CHARGE_POINT	AS PRICE_CHARGE_POINT,
			OI.PRICE_TOTAL			AS PRICE_TOTAL,
			
			OI.TO_ZIPCODE			AS TO_ZIPCODE,
			IFNULL(
				OI.TO_ROAD_ADDR,
				OI.TO_LOT_ADDR
			)						AS TO_ADDR,
			TO_DETAIL_ADDR			AS TO_DETAIL_ADDR,
			IFNULL(
				OI.ORDER_MEMO,
				''
			)						AS ORDER_MEMO,
			
			DC.COMPANY_NAME			AS COMPANY_NAME,
			DC.COMPANY_TEL			AS COMPANY_TEL,
			CASE
				WHEN
					OI.ORDER_STATUS = 'DCP' AND
					NOW() > DATE_ADD(OI.DELIVERY_END_DATE, INTERVAL 7 DAY)
					THEN
						'TRUE'
				ELSE
						'FALSE'
			END						AS UPDATE_FLG
		FROM
			dev.ORDER_INFO OI
			LEFT JOIN dev.DELIVERY_COMPANY DC ON
			OI.DELIVERY_IDX = DC.IDX
		WHERE
			OI.IDX = ".$order_idx." AND
			OI.MEMBER_IDX = ".$member_idx."
	";
	
	$db->query($select_order_sql);
	
	foreach($db->fetch() as $order_data) {
		$order_idx = $order_data['ORDER_IDX'];
		
		$update_flg = $order_data['UPDATE_FLG'];
		$update_flg === 'TRUE'? true: false;
		
		$order_product = array();
		if (!empty($order_idx)) {
			$select_order_product_sql = "
				SELECT
					OP.IDX				AS ORDER_PRODUCT_IDX,
					OP.ORDER_STATUS		AS ORDER_STATUS,
					(
						SELECT
							REPLACE(
								S_PI.IMG_LOCATION,
								'/var/www/admin/www',
								''
							)
						FROM
							dev.PRODUCT_IMG S_PI
						WHERE
							S_PI.PRODUCT_IDX = PR.IDX AND
							S_PI.IMG_TYPE = 'P' AND
							S_PI.IMG_SIZE = 'S'
						ORDER BY
							S_PI.IDX ASC
						LIMIT
							0,1
					)					AS IMG_LOCATION,
					OP.PRODUCT_NAME		AS PRODUCT_NAME,
					OM.COLOR			AS COLOR,
					OM.COLOR_RGB		AS COLOR_RGB,
					OP.OPTION_NAME		AS OPTION_NAME,
					OP.PRODUCT_QTY		AS PRODUCT_QTY,
					OP.PRODUCT_PRICE	AS PRODUCT_PRICE
				FROM
					dev.ORDER_PRODUCT OP
					LEFT JOIN dev.SHOP_PRODUCT PR ON
					OP.PRODUCT_IDX = PR.IDX
					LEFT JOIN dev.ORDERSHEET_MST OM ON
					PR.ORDERSHEET_IDX = OM.IDX
				WHERE
					OP.ORDER_IDX = ".$order_idx."
				ORDER BY
					OP.IDX ASC
			";
			
			$db->query($select_order_product_sql);
			
			foreach($db->fetch() as $order_product_data) {
				$order_product[] = array(
					'order_product_idx'		=>$order_product_data['ORDER_PRODUCT_IDX'],
					'img_location'			=>$order_product_data['IMG_LOCATION'],
					'product_name'			=>$order_product_data['PRODUCT_NAME'],
					'color'					=>$order_product_data['COLOR'],
					'color_rgb'				=>$order_product_data['COLOR_RGB'],
					'option_name'			=>$order_product_data['OPTION_NAME'],
					'product_qty'			=>$order_product_data['PRODUCT_QTY'],
					'product_price'			=>number_format($order_product_data['PRODUCT_PRICE'])
				);
			}
			
			$json_result['data'][] = array(
				'order_idx'				=>$order_data['ORDER_IDX'],
				'order_code'			=>$order_data['ORDER_CODE'],
				'order_title'			=>$order_data['ORDER_TITLE'],
				'order_status'			=>$order_data['ORDER_STATUS'],
				'preorder_flg'			=>$order_data['PREORDER_FLG'],
				'order_date'			=>$order_data['ORDER_DATE'],
				'cancel_date'			=>$order_data['CANCEL_DATE'],
				'exchange_date'			=>$order_data['EXCHANGE_DATE'],
				'refund_date'			=>$order_data['REFUND_DATE'],
				
				'member_name'			=>$order_data['MEMBER_NAME'],
				'member_mobile'			=>$order_data['MEMBER_MOBILE'],

				'price_product'			=>number_format($order_data['PRICE_PRODUCT']),
				'price_delivery'		=>number_format($order_data['PRICE_DELIVERY']),
				'price_discount'		=>number_format($order_data['PRICE_DISCOUNT']),
				'price_mileage_point'	=>number_format($order_data['PRICE_MILEAGE_POINT']),
				'price_charge_point'	=>number_format($order_data['PRICE_CHARGE_POINT']),
				'price_total'			=>number_format($order_data['PRICE_TOTAL']),

				'to_zipcode'			=>$order_data['TO_ZIPCODE'],
				'to_addr'				=>$order_data['TO_ADDR'],
				'to_detail_addr'		=>$order_data['TO_DETAIL_ADDR'],
				'order_memo'			=>$order_data['ORDER_MEMO'],
				
				'company_name'			=>$order_data['COMPANY_NAME'],
				'company_tel'			=>$order_data['COMPANY_TEL'],
				'update_flg'			=>$update_flg,
				
				'order_product'			=>$order_product
			);
		}
	} 
}

?>