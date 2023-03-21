<?php

header("Content-Type: application/javascript");

function getUrlParamter($url, $sch_tag) {
    $parts = parse_url($url);
    parse_str($parts['query'], $query);
    return $query[$sch_tag];
}

$page_url = $_SERVER['REQUEST_URI'];
$callback = getUrlParamter($page_url, 'callback');

$order_info_sql = "
	SELECT
		OI.IDX					AS ORDER_IDX,
		OI.ORDER_DATE			AS ORDER_DATE,
		OI.ORDER_CODE			AS ORDER_CODE,
		OI.ORDER_TITLE			AS ORDER_TITLE,
		
		OI.MEMBER_ID			AS MEMBER_ID,
		OI.MEMBER_NAME			AS MEMBER_NAME,
		OI.MEMBER_MOBILE		AS MEMBER_MOBILE,
		OI.MEMBER_EMAIL			AS MEMBER_EMAIL,
		
		OI.TO_PLACE				AS TO_PLACE,
		OI.TO_NAME				AS TO_NAME,
		OI.TO_MOBILE			AS TO_MOBILE,
		OI.TO_ZIPCODE			AS TO_ZIPCODE,
		OI.TO_LOT_ADDR			AS TO_LOT_ADDR,
		OI.TO_ROAD_ADDR			AS TO_ROAD_ADDR,
		OI.TO_DETAIL_ADDR		AS TO_DETAIL_ADDR
	FROM
		ORDER_INFO OI
	WHERE
		OI.ORDER_STATUS IN ('PCP','OEX')
	ORDER BY
		OI.IDX DESC
";

$db->query($order_info_sql);

$order_info = array();
foreach($db->fetch() as $order_info_data){
    $img_path = 'http://116.124.128.246:81'.$order_info_data['IMG_LOCATION'];
	
	$order_idx = $order_info_data['ORDER_IDX'];
	$order_code = $order_info_data['ORDER_CODE'];
	
	$order_product = array();
	if (!empty($order_idx)) {
		$order_product_sql = "
			SELECT
				OP.IDX					AS ORDER_PRODUCT_IDX,
				OP.ORDER_IDX			AS ORDER_IDX,
				OP.ORDER_CODE			AS ORDER_CODE,
				OP.ORDER_PRODUCT_CODE	AS ORDER_PRODUCT_CODE,
				OP.PRODUCT_TYPE			AS PRODUCT_TYPE,
				OP.PREORDER_FLG			AS PREORDER_FLG,
				OP.PRODUCT_IDX			AS PRODUCT_IDX,
				CASE
					WHEN
						(SELECT COUNT(IDX) FROM PRODUCT_IMG WHERE PRODUCT_IDX = OP.PRODUCT_IDX) > 0
						THEN
							(
								SELECT
									REPLACE(S_PI.IMG_LOCATION,'/var/www/admin/www','')
								FROM
									PRODUCT_IMG S_PI
								WHERE
									S_PI.PRODUCT_IDX = OP.PRODUCT_IDX AND
									S_PI.IMG_TYPE = 'P' AND
									S_PI.IMG_SIZE = 'S'
								LIMIT
									0,1
							)
					ELSE
						'/images/default_product_img.jpg'
				END						AS IMG_LOCATION,
				OP.PRODUCT_CODE			AS PRODUCT_CODE,
				OP.PRODUCT_NAME			AS PRODUCT_NAME,
				OP.PRODUCT_PRICE		AS PRODUCT_PRICE,
				OP.OPTION_NAME			AS OPTION_NAME,
				OP.BARCODE				AS BARCODE,
				OP.PRODUCT_QTY			AS PRODUCT_QTY
			FROM
				ORDER_PRODUCT OP
			WHERE
				OP.ORDER_IDX = ".$order_idx." AND
				OP.ORDER_STATUS IN ('PCP','OEX') AND
				(
					(OP.PRODUCT_TYPE = 'B' AND OP.PRODUCT_CODE NOT LIKE 'SET%') OR
					(OP.PRODUCT_TYPE = 'S' AND OP.PRODUCT_CODE LIKE 'SET%')
				)
			ORDER BY
				OP.IDX ASC
		";
		
		$db->query($order_product_sql);
		
		foreach($db->fetch() as $order_product_data) {
			$product_type = $order_product_data['PRODUCT_TYPE'];
			$order_idx = $order_product_data['ORDER_IDX'];
			
			$set_product = array();
			if ($product_type == "S") {
				$set_product_sql = "
					SELECT
						OP.IDX					AS ORDER_PRODUCT_IDX,
						OP.ORDER_IDX			AS ORDER_IDX,
						OP.ORDER_CODE			AS ORDER_CODE,
						OP.ORDER_PRODUCT_CODE	AS ORDER_PRODUCT_CODE,
						OP.PRODUCT_TYPE			AS PRODUCT_TYPE,
						OP.PREORDER_FLG			AS PREORDER_FLG,
						OP.PRODUCT_IDX			AS PRODUCT_IDX,
						CASE
							WHEN
								(SELECT COUNT(IDX) FROM PRODUCT_IMG WHERE PRODUCT_IDX = OP.PRODUCT_IDX) > 0
								THEN
									(
										SELECT
											REPLACE(S_PI.IMG_LOCATION,'/var/www/admin/www','')
										FROM
											PRODUCT_IMG S_PI
										WHERE
											S_PI.PRODUCT_IDX = OP.PRODUCT_IDX AND
											S_PI.IMG_TYPE = 'P' AND
											S_PI.IMG_SIZE = 'S'
										LIMIT
											0,1
									)
							ELSE
								'/images/default_product_img.jpg'
						END						AS IMG_LOCATION,
						OP.PRODUCT_CODE			AS PRODUCT_CODE,
						OP.PRODUCT_NAME			AS PRODUCT_NAME,
						OP.PRODUCT_PRICE		AS PRODUCT_PRICE,
						OP.OPTION_NAME			AS OPTION_NAME,
						OP.BARCODE				AS BARCODE,
						OP.PRODUCT_QTY			AS PRODUCT_QTY
					FROM
						ORDER_PRODUCT OP
					WHERE
						OP.ORDER_IDX = ".$order_idx." AND
						(OP.PRODUCT_TYPE = 'S' AND OP.PRODUCT_CODE NOT LIKE 'SET%')
					ORDER BY
						OP.IDX ASC
				";
				
				$db->query($set_product_sql);
				
				foreach($db->fetch() as $set_product_data) {
					$set_product[] = array(
						'order_product_idx'		=>$set_product_data['ORDER_PRODUCT_IDX'],
						'order_idx'				=>$set_product_data['ORDER_IDX'],
						'order_code'			=>$set_product_data['ORDER_CODE'],
						'order_product_code'	=>$set_product_data['ORDER_PRODUCT_CODE'],
						'product_type'			=>$set_product_data['PRODUCT_TYPE'],
						'reorder_flg'			=>$set_product_data['REORDER_FLG'],
						'product_idx'			=>$set_product_data['PRODUCT_IDX'],
						'img_location'			=>$set_product_data['IMG_LOCATION'],
						'product_code'			=>$set_product_data['PRODUCT_CODE'],
						'product_name'			=>$set_product_data['PRODUCT_NAME'],
						'option_name'			=>$set_product_data['OPTION_NAME'],
						'barcode'				=>$set_product_data['BARCODE'],
						'product_qty'			=>$set_product_data['PRODUCT_QTY']
					);
				}
			}
			
			$order_product[] = array(
				'order_product_idx'		=>$order_product_data['ORDER_PRODUCT_IDX'],
				'order_idx'				=>$order_product_data['ORDER_IDX'],
				'order_code'			=>$order_product_data['ORDER_CODE'],
				'order_product_code'	=>$order_product_data['ORDER_PRODUCT_CODE'],
				'product_type'			=>$order_product_data['PRODUCT_TYPE'],
				'reorder_flg'			=>$order_product_data['REORDER_FLG'],
				'product_idx'			=>$order_product_data['PRODUCT_IDX'],
				'img_location'			=>$order_product_data['IMG_LOCATION'],
				'product_code'			=>$order_product_data['PRODUCT_CODE'],
				'product_name'			=>$order_product_data['PRODUCT_NAME'],
				'option_name'			=>$order_product_data['OPTION_NAME'],
				'barcode'				=>$order_product_data['BARCODE'],
				'product_qty'			=>$order_product_data['PRODUCT_QTY'],
				'set_product'			=>$set_product,
			);
		}
	}
	
    $order_info[] = array(
		'order_idx'			=>$order_info_data['ORDER_IDX'],
		'order_date'		=>$order_info_data['ORDER_DATE'],
		'order_code'		=>$order_info_data['ORDER_CODE'],
		'order_title'		=>$order_info_data['ORDER_TITLE'],
		'member_id'			=>$order_info_data['MEMBER_ID'],
		'member_name'		=>$order_info_data['MEMBER_NAME'],
		'member_mobile'		=>$order_info_data['MEMBER_MOBILE'],
		'member_email'		=>$order_info_data['MEMBER_EMAIL'],
		'to_place'			=>$order_info_data['TO_PLACE'],
		'to_name'			=>$order_info_data['TO_NAME'],
		'to_mobile'			=>$order_info_data['TO_MOBILE'],
		'to_zipcode'		=>$order_info_data['TO_ZIPCODE'],
		'to_lot_addr'		=>$order_info_data['TO_LOT_ADDR'],
		'to_road_addr'		=>$order_info_data['TO_ROAD_ADDR'],
		'to_detail_addr'	=>$order_info_data['TO_DETAIL_ADDR'],
		'order_product'		=>$order_product
    );
}

if (count($order_info) > 0) {
	$json_result['result'] = "Y";
	$json_result['info'] = $order_info;
} else {
	$json_result['result'] = "N";
	$json_result['reason'] = "err001:not found data";
}
echo $callback.'('.$json_result['data'].');';
?>