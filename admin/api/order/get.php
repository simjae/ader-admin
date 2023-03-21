<?php
/*
 +=============================================================================
 | 
 | 주문 목록 조회
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

$order_code			= $_POST['order_code'];			//주문상태

if($order_code != null){
	$select_order_info_sql = "
		SELECT
			OI.IDX					AS ORDER_IDX,
			OI.COUNTRY				AS COUNTRY,
			OI.ORDER_CODE			AS ORDER_CODE,
			OI.ORDER_STATUS			AS ORDER_STATUS,
			OI.ORDER_TITLE			AS ORDER_TITLE,
			
			IFNULL(
				DATE_FORMAT(
					OI.ORDER_DATE,
					'%Y-%m-%d %H:%i'
				),'-'
			)						AS ORDER_DATE,
			IFNULL(
				DATE_FORMAT(
					OI.CANCEL_DATE,
					'%Y-%m-%d %H:%i'
				),'-'
			)						AS CANCEL_DATE,
			IFNULL(
				DATE_FORMAT(
					OI.EXCHANGE_DATE,
					'%Y-%m-%d %H:%i'
				),'-'
			)						AS EXCHANGE_DATE,
			IFNULL(
				DATE_FORMAT(
					OI.REFUND_DATE,
					'%Y-%m-%d %H:%i'
				),'-'
			)						AS REFUND_DATE,
			
			OI.MEMBER_IDX			AS MEMBER_IDX,
			OI.PRICE_PRODUCT		AS PRICE_PRODUCT,
			OI.PRICE_MILEAGE_POINT	AS PRICE_MILEAGE_POINT,
			OI.PRICE_CHARGE_POINT	AS PRICE_CHARGE_POINT,
			OI.PRICE_DISCOUNT		AS PRICE_DISCOUNT,
			OI.PRICE_DELIVERY		AS PRICE_DELIVERY,
			OI.PRICE_TOTAL			AS PRICE_TOTAL,

			IFNULL(
				OI.DELIVERY_TYPE,'-'
			)						AS DELIVERY_TYPE,
			IFNULL(
				OI.DELIVERY_DATE,'-'
			)						AS DELIVERY_DATE,
			IFNULL(
				OI.DELIVERY_STATUS,'-'
			)						AS DELIVERY_STATUS,
			IFNULL(
				OI.DELIVERY_NUM,'-'
			)						AS DELIVERY_NUM,
			IFNULL(
				OI.DELIVERY_START_DATE,'-'
			)						AS DELIVERY_START_DATE,
			IFNULL(
				OI.DELIVERY_END_DATE,'-'
			)						AS DELIVERY_END_DATE,

			IFNULL(
				DC.COMPANY_NAME,'-'
			)						AS COMPANY_NAME,
			IFNULL(
				DC.COMPANY_TEL,'-'
			)						AS COMPANY_TEL,
			IFNULL(
				DC.COMPANY_EMAIL,'-'
			)						AS COMPANY_EMAIL,
			IFNULL(
				DC.HOMEPAGE,'-'
			)						AS HOMEPAGE,

			IFNULL(
				PG_MID,'`'
			)						AS PG_MID,
			IFNULL(
				PG_PAYMENT,'`'
			)						AS PG_PAYMENT,
			IFNULL(
				PG_PAYMENT_KEY,'`'
			)						AS PG_PAYMENT_KEY,
			IFNULL(
				PG_STATUS,'`'
			)						AS PG_STATUS,
			IFNULL(
				PG_DATE,'`'
			)						AS PG_DATE,
			IFNULL(
				PG_PRICE,'`'
			)						AS PG_PRICE,
			IFNULL(
				PG_CURRENCY,'`'
			)						AS PG_CURRENCY,
			IFNULL(
				PG_RECEIPT_URL,'`'
			)						AS PG_RECEIPT_URL,

			IFNULL(
				OI.VBANK_NAME, '-'
			)						AS VBANK_NAME,
			IFNULL(
				OI.VBANK_ACCOUNT, '-'
			)						AS VBANK_ACCOUNT,
			IFNULL(
				OI.VBANK_NUMBER, '-'
			)						AS VBANK_NUMBER,
			IFNULL(
				OI.VBANK_DUE_DATE, '-'
			)						AS VBANK_DUE_DATE,
		
			IFNULL(
				OI.TO_PLACE, '-'
			)						AS TO_PLACE,
			IFNULL(
				OI.TO_NAME, '-'
			)						AS TO_NAME,
			IFNULL(
				OI.TO_MOBILE, '-'
			)						AS TO_MOBILE,
			IFNULL(
				OI.TO_ZIPCODE, '-'
			)						AS TO_ZIPCODE,
			IFNULL(
				OI.TO_LOT_ADDR, '-'
			)						AS TO_LOT_ADDR,
			IFNULL(
				OI.TO_ROAD_ADDR, '-'
			)						AS TO_ROAD_ADDR,
			IFNULL(
				OI.TO_DETAIL_ADDR, '-'
			)						AS TO_DETAIL_ADDR,
			IFNULL(
				OI.ORDER_MEMO,'-'
			)						AS ORDER_MEMO,
			OI.CREATE_DATE			AS CREATE_DATE,
			OI.UPDATE_DATE			AS UPDATE_DATE
		FROM
			ORDER_INFO OI
			LEFT JOIN DELIVERY_COMPANY DC ON
			OI.DELIVERY_IDX = DC.IDX
		WHERE
			OI.ORDER_CODE = '".$order_code."'
	";
	
	$db->query($select_order_info_sql);
	
	$order_info = array();
	foreach($db->fetch() as $order_info_data) {
		$order_idx = $order_info_data['ORDER_IDX'];
		$country = $order_info_data['COUNTRY'];
		$member_idx = $order_info_data['MEMBER_IDX'];
		
		$member_info = array();
		if (!empty($country) && !empty($member_idx)) {
			$select_member_sql = "
				SELECT
					MB.MEMBER_ID			AS MEMBER_ID,
					ML.TITLE				AS MEMBER_LEVEL,
					MB.MEMBER_NAME			AS MEMBER_NAME,
					MB.MEMBER_STATUS		AS MEMBER_STATUS,
					MB.MEMBER_GENDER		AS MEMBER_GENDER,
					IFNULL(
						MB.ZIPCODE, '-'
					)						AS ZIPCODE,
					IFNULL(
						MB.LOT_ADDR, '-'
					)						AS LOT_ADDR,
					IFNULL(
						MB.ROAD_ADDR, '-'
					)						AS ROAD_ADDR,
					IFNULL(
						MB.DETAIL_ADDR, '-'
					)						AS DETAIL_ADDR,
					MB.TEL_MOBILE			AS TEL_MOBILE
				FROM
					MEMBER_".$country." MB
					LEFT JOIN MEMBER_LEVEL ML ON
					MB.LEVEL_IDX = ML.IDX
				WHERE
					MB.IDX = ".$member_idx."
			";
			
			$db->query($select_member_sql);
			
			foreach($db->fetch() as $member_data) {
				$member_status = "";
				switch ($member_data['MEMBER_STATUS']) {
					case "NML" :
						$member_status = "일반";
						break;
					
					case "SLP" :
						$member_status = "휴면";
						break;
					
					case "DRP" :
						$member_status = "탈퇴";
						break;
				}
				
				$member_gender = "";
				if ($member_data['MEMBER_GENDER'] == "M") {
					$member_gender = "남자";
				} else if ($member_data['MEMBER_GENDER'] == "F") {
					$member_gender = "여자";
				}
				
				$member_info = array(
					'member_id'			=>$member_data['MEMBER_ID'],
					'member_level'		=>$member_data['MEMBER_LEVEL'],
					'member_name'		=>$member_data['MEMBER_NAME'],
					'member_status'		=>$member_status,
					'member_gender'		=>$member_gender,
					'zipcode'			=>$member_data['ZIPCODE'],
					'lot_addr'			=>$member_data['LOT_ADDR'],
					'road_addr'			=>$member_data['ROAD_ADDR'],
					'detail_addr'		=>$member_data['DETAIL_ADDR'],
					'tel_mobile'		=>$member_data['TEL_MOBILE']
				);
			}
		}
		
		$order_product_info = array();
		if (!empty($order_idx)) {
			$select_order_product_sql = "
				SELECT
					OP.IDX					AS ORDER_PRODUCT_IDX,
					OP.ORDER_STATUS			AS ORDER_STATUS,
					
					IFNULL(
						DATE_FORMAT(
							OP.CANCEL_DATE,
							'%Y-%m-%d %H:%i'
						),'-'
					)						AS CANCEL_DATE,
					IFNULL(
						DATE_FORMAT(
							OP.EXCHANGE_DATE,
							'%Y-%m-%d %H:%i'
						),'-'
					)						AS EXCHANGE_DATE,
					IFNULL(
						DATE_FORMAT(
							OP.REFUND_DATE,
							'%Y-%m-%d %H:%i'
						),'-'
					)						AS REFUND_DATE,
					
					OP.PRODUCT_IDX			AS PRODUCT_IDX,
					OP.PRODUCT_TYPE			AS PRODUCT_TYPE,
					OP.REORDER_CNT			AS REORDER_CNT,
					OP.PREORDER_FLG			AS PREORDER_FLG,
					OP.REORDER_CNT			AS REORDER_CNT,
					OP.PREORDER_FLG			AS PREORDER_FLG,
					OP.PRODUCT_CODE			AS PRODUCT_CODE,
					OP.PRODUCT_NAME			AS PRODUCT_NAME,
					IFNULL(OM.SUPPLIER,'-')	AS SUPPLIER,
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
					)						AS IMG_LOCATION,
					OP.OPTION_IDX			AS OPTION_IDX,
					OP.OPTION_NAME			AS OPTION_NAME,
					OP.BARCODE				AS BARCODE,
					OP.PRODUCT_QTY			AS PRODUCT_QTY,
					PR.SALES_PRICE_".$country." AS SALES_PRICE,
					OP.PRODUCT_PRICE		AS PRODUCT_PRICE,
					OP.REVIEW_TYPE			AS REVIEW_TYPE
				FROM
					ORDER_PRODUCT OP
					LEFT JOIN SHOP_PRODUCT PR ON
					OP.PRODUCT_IDX = PR.IDX
					LEFT JOIN ORDERSHEET_MST OM ON
					PR.ORDERSHEET_IDX = OM.IDX
				WHERE
					OP.ORDER_IDX = '".$order_idx."' AND
					OP.PRODUCT_CODE NOT LIKE 'VOU%'
			";
			
			$db->query($select_order_product_sql);
			
			foreach($db->fetch() as $order_product_data){
				$product_type = $order_product_data['PRODUCT_TYPE'];
				
				$product_idx = $order_product_data['PRODUCT_IDX'];
				$option_idx = $order_product_data['OPTION_IDX'];
				
				$set_product_info = array();
				if($product_type == 'S') {
					$select_set_product_sql = "
						SELECT
							PR.IDX						AS PRODUCT_IDX,
							PR.STYLE_CODE				AS STYLE_CODE,
							PR.COLOR_CODE				AS COLOR_CODE,
							PR.PRODUCT_CODE				AS PRODUCT_CODE,
							(
								SELECT
									REPLACE(
										S_PI.IMG_LOCATION,
										'/var/www/admin/www',
										''
									)
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
							)							AS IMG_LOCATION,
							PR.PRODUCT_NAME				AS PRODUCT_NAME,
							OO.IDX						AS OPTION_IDX,
							OO.BARCODE					AS BARCODE,
							OO.OPTION_NAME				AS OPTION_NAME
						FROM
							SHOP_PRODUCT PR
							LEFT JOIN ORDERSHEET_OPTION OO ON
							PR.ORDERSHEET_IDX = OO.ORDERSHEET_IDX
						WHERE
							PR.IDX IN (
								SELECT
									S_SP.PRODUCT_IDX
								FROM
									SET_PRODUCT S_SP
								WHERE
									S_SP.SET_PRODUCT_IDX = ".$product_idx."
							) AND
							OO.IDX = ".$option_idx."
					";
					
					$db->query($select_set_product_sql);
					
					foreach($db->fetch() as $set_product_data){
						$set_product_info[] = array(
							'product_idx'		=>$set_product_data['PRODUCT_IDX'],
							'style_code'		=>$set_product_data['STYLE_CODE'],
							'color_code'		=>$set_product_data['COLOR_CODE'],
							'product_code'		=>$set_product_data['PRODUCT_CODE'],
							'img_location'		=>$set_product_data['IMG_LOCATION'],
							'product_name'		=>$set_product_data['PRODUCT_NAME'],
							'option_idx'		=>$set_product_data['OPTION_IDX'],
							'barcode'			=>$set_product_data['BARCODE'],
							'option_name'		=>$set_product_data['OPTION_NAME']
						);
					}
				}
				
				$order_product_info[] = array(
					'order_status'			=>$order_product_data['ORDER_STATUS'],
					'cancel_date'			=>$order_product_data['CANCEL_DATE'],
					'exchange_date'			=>$order_product_data['EXCHANGE_DATE'],
					'refund_date'			=>$order_product_data['REFUND_DATE'],
					
					'product_idx'			=>$order_product_data['PRODUCT_IDX'],
					'product_type'			=>$order_product_data['PRODUCT_TYPE'],
					'reorder_cnt'			=>$order_product_data['REORDER_CNT'],
					'preorder_flg'			=>$order_product_data['PREORDER_FLG'],
					'product_code'			=>$order_product_data['PRODUCT_CODE'],
					'product_name'			=>$order_product_data['PRODUCT_NAME'],
					'img_location'			=>$order_product_data['IMG_LOCATION'],
					'supplier'				=>$order_product_data['SUPPLIER'],
					'option_idx'			=>$order_product_data['OPTION_IDX'],
					'option_name'			=>$order_product_data['OPTION_NAME'],
					'barcode'				=>$order_product_data['BARCODE'],
					'product_qty'			=>$order_product_data['PRODUCT_QTY'],
					'sales_price'			=>number_format($order_product_data['SALES_PRICE']),
					'product_price'			=>number_format($order_product_data['PRODUCT_PRICE']),
					'review_type'			=>$order_product_data['REVIEW_TYPE'],
					
					'set_product_info'		=>$set_product_info
				);
			}
		}
		
		$txt_country = "";
		switch($order_info_data['COUNTRY']) {
			case "KR" :
				$txt_country = "한국몰";
				break;
			
			case "EN" :
				$txt_country = "영문몰";
				break;
			
			case "CN" :
				$txt_country = "중문몰";
				break;
		}
		
		$order_info = array(
			'order_idx'						=>$order_info_data['ORDER_IDX'],
			'country'						=>$order_info_data['COUNTRY'],
			'txt_country'					=>$txt_country,
			'order_code'					=>$order_info_data['ORDER_CODE'],
			'order_status'					=>$order_info_data['ORDER_STATUS'],
			'order_title'					=>$order_info_data['ORDER_TITLE'],
			'order_date'					=>$order_info_data['ORDER_DATE'],
			'cancel_date'					=>$order_info_data['CANCEL_DATE'],
			'exchange_date'					=>$order_info_data['EXCHANGE_DATE'],
			'refund_date'					=>$order_info_data['REFUND_DATE'],
			
			'member_idx'					=>$order_info_data['MEMBER_IDX'],
			'member_level'					=>$member_info['member_level'],
			'member_id'						=>$member_info['member_id'],
			'member_name'					=>$member_info['member_name'],
			'member_mobile'					=>$member_info['tel_mobile'],
			'member_email'					=>$member_info['member_id'],
			'member_status'					=>$member_info['member_status'],
			'member_gender'					=>$member_info['member_gender'],
			'member_zipcode'				=>$member_info['zipcode'],
			'member_lot_addr'				=>$member_info['lot_addr'],
			'member_road_addr'				=>$member_info['road_addr'],
			'member_detail_addr'			=>$member_info['detail_addr'],
			
			'price_product'					=>number_format($order_info_data['PRICE_PRODUCT']),
			'price_mileage_point'			=>number_format($order_info_data['PRICE_MILEAGE_POINT']),
			'price_charge_point'			=>number_format($order_info_data['PRICE_CHARGE_POINT']),
			'price_discount'				=>number_format($order_info_data['PRICE_DISCOUNT']),
			'price_delivery'				=>number_format($order_info_data['PRICE_DELIVERY']),
			'price_total'					=>number_format($order_info_data['PRICE_TOTAL']),
			
			'delivery_type'					=>$order_info_data['DELIVERY_TYPE'],
			'delivery_date'					=>$order_info_data['DELIVERY_DATE'],
			'delivery_status'				=>$order_info_data['DELIVERY_STATUS'],
			'delivery_num'					=>$order_info_data['DELIVERY_NUM'],
			'delivery_start_date'			=>$order_info_data['DELIVERY_START_DATE'],
			'delivery_end_date'				=>$order_info_data['DELIVERY_END_DATE'],
			
			'company_name'					=>$order_info_data['COMPANY_NAME'],
			'company_tel'					=>$order_info_data['COMPANY_TEL'],
			'company_email'					=>$order_info_data['COMPANY_EMAIL'],
			'homepage'						=>$order_info_data['HOMEPAGE'],
			
			'pg_mid'						=>$order_info_data['PG_MID'],
			'pg_payment'					=>$order_info_data['PG_PAYMENT'],
			'pg_payment_key'				=>$order_info_data['PG_PAYMENT_KEY'],
			'pg_status'						=>$order_info_data['PG_STATUS'],
			'pg_date'						=>$order_info_data['PG_DATE'],
			'pg_price'						=>number_format($order_info_data['PG_PRICE']),
			'pg_currency'					=>$order_info_data['PG_CURRENCY'],
			'pg_receipt_url'				=>$order_info_data['PG_RECEIPT_URL'],
			
			'vbank_name'					=>$order_info_data['VBANK_NAME'],
			'vbank_account'					=>$order_info_data['VBANK_ACCOUNT'],
			'vbank_number'					=>$order_info_data['VBANK_NUMBER'],
			'vbank_due_date'				=>$order_info_data['VBANK_DUE_DATE'],
			
			'to_place'						=>$order_info_data['TO_PLACE'],
			'to_name'						=>$order_info_data['TO_NAME'],
			'to_mobile'						=>$order_info_data['TO_MOBILE'],
			'to_zipcode'					=>$order_info_data['TO_ZIPCODE'],
			'to_lot_addr'					=>$order_info_data['TO_LOT_ADDR'],
			'to_road_addr'					=>$order_info_data['TO_ROAD_ADDR'],
			'to_detail_addr'				=>$order_info_data['TO_DETAIL_ADDR'],
			
			'order_memo'					=>$order_info_data['ORDER_MEMO'],
			
			'create_date'					=>$order_info_data['CREATE_DATE'],
			'update_date'					=>$order_info_data['UPDATE_DATE'],
			
			'order_product_info'			=>$order_product_info,
		);
	}
	
	$json_result['data'] = $order_info;
}
else{
	$json_result['code'] = 301;
	$json_result['msg'] = '쇼핑몰 국가정보를 얻을 수 없습니다.';
	return $json_result;
}
?>