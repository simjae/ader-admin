<?php
/*
 +=============================================================================
 | 
 | 통합모달 - 위시리스트 상품정보
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
		WL.COUNTRY = '".$country."' AND
		WL.MEMBER_IDX = ".$member_idx." AND
		WL.DEL_FLG = FALSE
	";
	
	$json_result = array(
		'total' => $db->count("WHISH_LIST WL",$where),
		'total_cnt' => $db->count("WHISH_LIST WL",$where),
		'page' => $page
	);
	
	/** 정렬 조건 **/
	$order = '';
	if ($sort_value != null && $sort_type != null) {
		$order = " ".$sort_value." ".$sort_type." ";
	} else {
		$order = " WL.IDX DESC ";
	}
	
	$select_whish_list_sql = "
		SELECT
			DATE_FORMAT(
				WL.CREATE_DATE,
				'%Y-%m-%d'
			)							AS CREATE_DATE,
			DATE_FORMAT(
				WL.CREATE_DATE,
				'%H:%i'
			)							AS CREATE_TIME,
			PR.IDX						AS PRODUCT_IDX,
			PR.PRODUCT_TYPE				AS PRODUCT_TYPE,
			PR.STYLE_CODE				AS STYLE_CODE,
			PR.COLOR_CODE				AS COLOR_CODE,
			PR.PRODUCT_CODE				AS PRODUCT_CODE,
			PR.PRODUCT_NAME				AS PRODUCT_NAME,
			PR.PRICE_KR					AS PRICE_KR,
			PR.PRICE_EN					AS PRICE_EN,
			PR.PRICE_CN					AS PRICE_CN,
			PR.DISCOUNT_KR				AS DISCOUNT_KR,
			PR.DISCOUNT_EN				AS DISCOUNT_EN,
			PR.DISCOUNT_CN				AS DISCOUNT_CN,
			PR.SALES_PRICE_KR			AS SALES_PRICE_KR,
			PR.SALES_PRICE_EN			AS SALES_PRICE_EN,
			PR.SALES_PRICE_CN			AS SALES_PRICE_CN,
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
			WHISH_LIST WL
			LEFT JOIN SHOP_PRODUCT PR ON
			WL.PRODUCT_IDX = PR.IDX
		WHERE
			".$where."
		ORDER BY
			".$order."
	";
	
	$limit_start = (intval($page)-1)*$rows;	
	if ($rows != null) {
		$select_whish_list_sql .= " LIMIT ".$limit_start.",".$rows;
	}
	
	$db->query($select_whish_list_sql);
	
	foreach($db->fetch() as $whish_data) {
		$json_result['data'][] = array(
			'create_date'		=>$whish_data['CREATE_DATE'],
			'create_time'		=>$whish_data['CREATE_TIME'],
			
			'img_location'		=>$whish_data['IMG_LOCATION'],
			
			'product_idx'		=>$whish_data['PRODUCT_IDX'],
			'product_code'		=>$whish_data['PRODUCT_CODE'],
			'product_name'		=>$whish_data['PRODUCT_NAME'],
			'update_date'		=>$whish_data['UPDATE_DATE'],
			
			'price_kr'			=>number_format($whish_data['PRICE_KR']),
			'price_en'			=>number_format($whish_data['PRICE_EN']),
			'price_cn'			=>number_format($whish_data['PRICE_CN']),
			'discount_kr'		=>$whish_data['DISCOUNT_KR'],
			'discount_en'		=>$whish_data['DISCOUNT_EN'],
			'discount_cn'		=>$whish_data['DISCOUNT_CN'],
			'sales_price_kr'	=>number_format($whish_data['SALES_PRICE_KR']),
			'sales_price_en'	=>number_format($whish_data['SALES_PRICE_EN']),
			'sales_price_cn'	=>number_format($whish_data['SALES_PRICE_CN']),
			
			'stock_qty'			=>$whish_data['STOCK_QTY'],
			'safe_qty'			=>$whish_data['SAFE_QTY'],
			'order_qty'			=>$whish_data['ORDER_QTY'],
			'product_qty'		=>intval($whish_data['STOCK_QTY'] - $whish_data['ORDER_QTY'])
		);
	}
}

?>