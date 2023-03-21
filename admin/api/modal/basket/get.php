<?php
/*
 +=============================================================================
 | 
 | 통합모달 - 쇼핑백 상품정보
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

$country				= $_POST['country'];
$member_idx				= $_POST['member_idx'];

$sort_value				= $_POST['sort_value'];
$sort_type				= $_POST['sort_type'];

$page					= $_POST['page'];
$rows					= $_POST['rows'];

if ($country != null && $member_idx != null) {
	$where = "
		BI.COUNTRY = '".$country."' AND
		BI.MEMBER_IDX = ".$member_idx." AND
		BI.DEL_FLG = FALSE
	";
	
	$json_result = array(
		'total' => $db->count("BASKET_INFO BI",$where),
		'total_cnt' => $db->count("BASKET_INFO BI",$where),
		'page' => $page
	);
	
	/** 정렬 조건 **/
	$order = '';
	if ($sort_value != null && $sort_type != null) {
		$order = " ".$sort_value." ".$sort_type." ";
	} else {
		$order = " BI.IDX DESC ";
	}
	
	$select_basket_info_sql = "
		SELECT
			DATE_FORMAT(
				BI.CREATE_DATE,
				'%Y-%m-%d'
			)							AS CREATE_DATE,
			DATE_FORMAT(
				BI.CREATE_DATE,
				'%H:%i'
			)							AS CREATE_TIME,
			PR.IDX						AS PRODUCT_IDX,
			PR.PRODUCT_TYPE				AS PRODUCT_TYPE,
			PR.STYLE_CODE				AS STYLE_CODE,
			PR.COLOR_CODE				AS COLOR_CODE,
			PR.PRODUCT_CODE				AS PRODUCT_CODE,
			PR.PRODUCT_NAME				AS PRODUCT_NAME,
			OO.OPTION_NAME				AS OPTION_NAME,
			OO.BARCODE					AS BARCODE,
			
			PR.PRICE_KR					AS PRICE_KR,
			PR.PRICE_EN					AS PRICE_EN,
			PR.PRICE_CN					AS PRICE_CN,
			PR.DISCOUNT_KR				AS DISCOUNT_KR,
			PR.DISCOUNT_EN				AS DISCOUNT_KR,
			PR.DISCOUNT_CN				AS DISCOUNT_KR,
			PR.SALES_PRICE_KR			AS SALES_PRICE_KR,
			PR.SALES_PRICE_CN			AS SALES_PRICE_EN,
			PR.SALES_PRICE_EN			AS SALES_PRICE_CN,
			
			PR.UPDATE_DATE				AS UPDATE_DATE,
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
			(
				SELECT
					IFNULL(SUM(S_PS.STOCK_QTY),0)
				FROM
					PRODUCT_STOCK S_PS
				WHERE
					S_PS.PRODUCT_IDX = PR.IDX AND
					S_PS.STOCK_DATE <= NOW()
			)							AS STOCK_QTY,
			(
				SELECT
					IFNULL(SUM(S_PS.STOCK_SAFE_QTY),0)
				FROM
					PRODUCT_STOCK S_PS
				WHERE
					S_PS.PRODUCT_IDX = PR.IDX AND
					S_PS.STOCK_DATE <= NOW()
			)							AS SAFE_QTY,
			(
				SELECT
					IFNULL(SUM(S_OP.PRODUCT_QTY),0)
				FROM
					ORDER_PRODUCT S_OP
				WHERE
					S_OP.ORDER_STATUS IN ('PCP','PPR','DPR','DPG','DCP') AND
					S_OP.PRODUCT_IDX = PR.IDX
			)							AS ORDER_QTY
		FROM
			BASKET_INFO BI
			LEFT JOIN SHOP_PRODUCT PR ON
			BI.PRODUCT_IDX = PR.IDX
			LEFT JOIN ORDERSHEET_OPTION OO ON
			BI.OPTION_IDX = OO.IDX
		WHERE
			".$where."
		ORDER BY
			".$order."
	";
	
	$db->query($select_basket_info_sql);
	
	foreach($db->fetch() as $basket_data) {
		$json_result['data'][] = array(
			'create_date'		=>$basket_data['CREATE_DATE'],
			'create_time'		=>$basket_data['CREATE_TIME'],
			
			'img_location'		=>$basket_data['IMG_LOCATION'],
			
			'product_idx'		=>$basket_data['PRODUCT_IDX'],
			'product_code'		=>$basket_data['PRODUCT_CODE'],
			'product_name'		=>$basket_data['PRODUCT_NAME'],
			'option_name'		=>$basket_data['OPTION_NAME'],
			'barcode'			=>$basket_data['BARCODE'],
			'update_date'		=>$basket_data['UPDATE_DATE'],
			
			'price_kr'			=>$basket_data['PRICE_KR'],
			'price_en'			=>$basket_data['PRICE_EN'],
			'price_cn'			=>$basket_data['PRICE_CN'],
			'discount_kr'		=>$basket_data['DISCOUNT_KR'],
			'discount_en'		=>$basket_data['DISCOUNT_EN'],
			'discount_cn'		=>$basket_data['DISCOUNT_CN'],
			'sales_price_kr'	=>$basket_data['SALES_PRICE_KR'],
			'sales_price_en'	=>$basket_data['SALES_PRICE_EN'],
			'sales_price_cn'	=>$basket_data['SALES_PRICE_CN'],
			
			'stock_qty'			=>$basket_data['STOCK_QTY'],
			'safe_qty'			=>$basket_data['SAFE_QTY'],
			'order_qty'			=>$basket_data['ORDER_QTY'],
			'product_qty'		=>intval($basket_data['STOCK_QTY'] - $basket_data['ORDER_QTY'])
		);
	}
}

?>