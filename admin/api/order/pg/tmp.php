<?php
/*
 +=============================================================================
 | 
 | 7-2. 취소/교환/반훔/환불 - 교환대상 상품 임시 주문 생성
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

include_once("/var/www/admin/api/common/common.php");

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$session_id				= sessionCheck();
$param_order_code		= $_POST['order_code'];

if ($param_order_code != null) {
	$tmp_cnt = $db->count("TMP_ORDER_PRODUCT","ORDER_CODE = '".$param_order_code."' AND ORDER_STATUS = 'PWT'");
	
	if ($tmp_cnt > 0) {
		$select_order_info_sql = "
			SELECT
				OI.COUNTRY			AS COUNTRY,
				
				OI.MEMBER_IDX		AS MEMBER_IDX,
				OI.MEMBER_LEVEL		AS MEMBER_LEVEL,
				OI.MEMBER_ID		AS MEMBER_ID,
				OI.MEMBER_NAME		AS MEMBER_NAME,
				OI.MEMBER_MOBILE	AS MEMBER_MOBILE,
				OI.MEMBER_EMAIL		AS MEMBER_EMAIL,
				
				OI.TO_PLACE			AS TO_PLACE,
				OI.TO_NAME			AS TO_NAME,
				OI.TO_MOBILE		AS TO_MOBILE,
				OI.TO_ZIPCODE		AS TO_ZIPCODE,
				OI.TO_LOT_ADDR		AS TO_LOT_ADDR,
				OI.TO_ROAD_ADDR		AS TO_ROAD_ADDR,
				OI.TO_DETAIL_ADDR	AS TO_DETAIL_ADDR
			FROM
				ORDER_INFO OI
			WHERE
				ORDER_CODE = '".$param_order_code."'
		";
		
		$db->query($select_order_info_sql);
		
		$order_info = array();
		foreach($db->fetch() as $order_data) {
			$order_info = array(
				'country'			=>$order_data['COUNTRY'],
				
				'member_idx'		=>$order_data['MEMBER_IDX'],
				'member_level'		=>$order_data['MEMBER_LEVEL'],
				'member_id'			=>$order_data['MEMBER_ID'],
				'member_name'		=>$order_data['MEMBER_NAME'],
				'member_mobile'		=>$order_data['MEMBER_MOBILE'],
				'member_email'		=>$order_data['MEMBER_EMAIL'],
				
				'to_place'			=>$order_data['TO_PLACE'],
				'to_name'			=>$order_data['TO_NAME'],
				'to_mobile'			=>$order_data['TO_MOBILE'],
				'to_zipcode'		=>$order_data['TO_ZIPCODE'],
				'to_lot_addr'		=>$order_data['TO_LOT_ADDR'],
				'to_road_addr'		=>$order_data['TO_ROAD_ADDR'],
				'to_detail_addr'	=>$order_data['TO_DETAIL_ADDR']
			);
		}
		
		$select_tmp_order_product_sql = "
			SELECT
				TP.PRODUCT_IDX			AS PRODUCT_IDX,
				TP.PRODUCT_TYPE			AS PRODUCT_TYPE,
				TP.REORDER_CNT			AS REORDER_CNT,
				TP.PREORDER_FLG			AS PREORDER_FLG,
				TP.PRODUCT_CODE			AS PRODUCT_CODE,
				TP.PRODUCT_NAME			AS PRODUCT_NAME,
				TP.PRODUCT_PRICE		AS PRODUCT_PRICE,
				TP.OPTION_IDX			AS OPTION_IDX,
				TP.BARCODE				AS BARCODE,
				TP.OPTION_NAME			AS OPTION_NAME,
				TP.PRODUCT_QTY			AS PRODUCT_QTY
			FROM
				TMP_ORDER_PRODUCT TP
			WHERE
				TP.ORDER_CODE = '".$param_order_code."' AND
				TP.ORDER_STATUS = 'PWT'
		";
		
		$db->query($select_tmp_order_product_sql);
		
		$tmp_product_info = array();
		
		$sum_product_price = 0;
		
		foreach($db->fetch() as $product_data) {
			$product_price = $product_data['PRODUCT_PRICE'];
			$sum_product_price += $product_price;
			
			$tmp_product_info[] = array(
				'product_idx'		=>$product_data['PRODUCT_IDX'],
				'product_type'		=>$product_data['PRODUCT_TYPE'],
				'reorder_cnt'		=>$product_data['REORDER_CNT'],
				'preorder_flg'		=>$product_data['PREORDER_FLG'],
				'product_code'		=>$product_data['PRODUCT_CODE'],
				'product_name'		=>$product_data['PRODUCT_NAME'],
				'product_price'		=>$product_price,
				'option_idx'		=>$product_data['OPTION_IDX'],
				'barcode'			=>$product_data['BARCODE'],
				'option_name'		=>$product_data['OPTION_NAME'],
				'product_qty'		=>$product_data['PRODUCT_QTY']
			);
		}
		
		$order_code = date("Ymd_").time();
		$order_title = null;
		
		$tmp_product_cnt = count($tmp_product_info);
		if ($tmp_product_cnt > 1) {
			$order_title = "주문교환 ".$tmp_product_info[0]['product_name']." 외 ".($tmp_product_cnt - 1)."건";
		} else {
			$order_title = $tmp_product_info[0]['product_name'];
		}
		
		try {
			$insert_tmp_order_info_sql = "
				INSERT INTO
					TMP_ORDER_INFO
				(
					COUNTRY,
					ORDER_CODE,
					ORDER_TITLE,
					ORDER_STATUS,
					ORDER_DATE,
					MEMBER_IDX,
					MEMBER_LEVEL,
					MEMBER_ID,
					MEMBER_NAME,
					MEMBER_MOBILE,
					MEMBER_EMAIL,
					PRICE_PRODUCT,
					PRICE_MILEAGE_POINT,
					PRICE_CHARGE_POINT,
					PRICE_DISCOUNT,
					PRICE_TOTAL,
					TO_PLACE,
					TO_NAME,
					TO_MOBILE,
					TO_ZIPCODE,
					TO_LOT_ADDR,
					TO_ROAD_ADDR,
					TO_DETAIL_ADDR,
					CREATE_DATE,
					CREATER,
					UPDATE_DATE,
					UPDATER
				) VALUES (
					'".$order_info['country']."',
					'".$order_code."',
					'".$order_title."',
					'PWT',
					NOW(),
					".$order_info['member_idx'].",
					".$order_info['member_level'].",
					'".$order_info['member_id']."',
					'".$order_info['member_name']."',
					'".$order_info['member_mobile']."',
					'".$order_info['member_email']."',
					".$sum_product_price.",
					0,
					0,
					0,
					".$sum_product_price.",
					'".$order_info['to_place']."',
					'".$order_info['to_name']."',
					'".$order_info['to_mobile']."',
					'".$order_info['to_zipcode']."',
					'".$order_info['to_lot_addr']."',
					'".$order_info['to_road_addr']."',
					'".$order_info['to_detail_addr']."',
					NOW(),
					'".$session_id."',
					NOW(),
					'".$session_id."'
				)
			";
			
			$db->query($insert_tmp_order_info_sql);
			
			$order_idx = $db->last_id();
			
			if (!empty($order_idx)) {
				$product_num = 1;
				
				for ($i=0; $i<count($tmp_product_info); $i++) {
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
							CREATE_DATE,
							CREATER,
							UPDATE_DATE,
							UPDATER
						) VALUES (
							".$order_idx.",
							'".$order_code."',
							'".$order_code."_".$product_num."',
							'PWT',
							".$tmp_product_info[$i]['product_idx'].",
							'".$tmp_product_info[$i]['product_type']."',
							".$tmp_product_info[$i]['reorder_cnt'].",
							".$tmp_product_info[$i]['preorder_flg'].",
							'".$tmp_product_info[$i]['product_code']."',
							'".$tmp_product_info[$i]['product_name']."',
							".$tmp_product_info[$i]['product_price'].",
							".$tmp_product_info[$i]['option_idx'].",
							'".$tmp_product_info[$i]['barcode']."',
							'".$tmp_product_info[$i]['option_name']."',
							".$tmp_product_info[$i]['product_qty'].",
							NOW(),
							'".$session_id."',
							NOW(),
							'".$session_id."'
						)
					";
					
					$db->query($insert_tmp_order_product_sql);
					
					$product_num++;
				}
			}
			
			$insert_order_mapping_sql = "
				INSERT INTO
					ORDER_MAPPING
				(
					ORDER_CODE,
					TMP_ORDER_CODE
				) VALUES (
					'".$param_order_code."',
					'".$order_code."'
				)
			";
			
			$db->query($insert_order_mapping_sql);
			
			$db->commit();
		} catch (mysqli_sql_exception $exception) {
			$db->rollback();
			print_r($exception);
			
			$json_result['code'] = 302;
			$json_result['msg'] = "주문정보 등록처리중 오류가 발생했습니다.";
		}
	} else {
		$json_result['code'] = 301;
		$json_result['msg'] = "선택된 교환대상 상품이 없습니다.상품 추가 후 다시 시도해주세요.";
	}
}

?>