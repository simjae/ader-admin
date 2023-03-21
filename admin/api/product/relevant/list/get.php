<?php
/*
 +=============================================================================
 | 
 | 회원 목록
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.07.24
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$relevant_idx			= $_POST['relevant_idx'];

$product_name			= $_POST['product_name'];
$product_code			= $_POST['product_code'];

$rows					= $_POST['rows'];
$page					= $_POST['page'];

$sort_type				= $_POST['sort_type'];				//정렬타입
$sort_value				= $_POST['sort_value'];				//정렬 기준값

$where = "1=1";
$where .= " AND (PR.PRODUCT_TYPE = 'B' AND PR.SALE_FLG = TRUE) ";
$where .= " AND (PR.DEL_FLG = FALSE AND PR.INDP_FLG = FALSE) ";
$cnt_where .= $where;

if ($relevant_idx != null) {
	$where .= " AND (PR.IDX NOT IN (".$relevant_idx.")) ";
}

if ($product_name != null) {
	$product_name = str_replace(",","|",$product_name);
	
	$where .= " AND (PR.PRODUCT_NAME REGEXP '".$product_name."') ";
}

if ($product_code != null) {
	$product_code = str_replace(",","|",$product_code);
	$where .= " AND (PR.PRODUCT_CODE REGEXP '".$product_code."') ";
}

$order = '';
if ($sort_value != null && $sort_type != null) {
	$order = ' PR.'.$sort_value." ".$sort_type." ";
} else {
	$order = ' PR.IDX DESC';
}

$json_result = array(
	'total' => $db->count("SHOP_PRODUCT PR LEFT JOIN ORDERSHEET_OPTION OO ON PR.ORDERSHEET_IDX = OO.ORDERSHEET_IDX",$where),
	'total_cnt' => $db->count("SHOP_PRODUCT PR LEFT JOIN ORDERSHEET_OPTION OO ON PR.ORDERSHEET_IDX = OO.ORDERSHEET_IDX",$cnt_where),
	'page' => intval($page)
);

$limit_start = (intval($page)-1)*$rows;

$select_relevant_product_sql = "
	SELECT
		PR.IDX					AS PRODUCT_IDX,
		PR.PRODUCT_TYPE			AS PRODUCT_TYPE,
		OM.STYLE_CODE			AS STYLE_CODE,
		OM.COLOR_CODE			AS COLOR_CODE,
		CASE
			WHEN
				(SELECT COUNT(*) FROM PRODUCT_IMG WHERE PRODUCT_IDX = PR.IDX) > 0
					THEN
						(
							SELECT
								REPLACE(S_PI.IMG_LOCATION,'/var/www/admin/www','')
							FROM
								PRODUCT_IMG S_PI
							WHERE
								S_PI.PRODUCT_IDX = PR.IDX AND
								S_PI.IMG_TYPE = 'P' AND
								S_PI.IMG_SIZE = 'S'
							LIMIT
								0,1
						)
				ELSE
					'/images/default_product_img.jpg'
		END						AS IMG_LOCATION,
		PR.PRODUCT_CODE			AS PRODUCT_CODE,
		PR.PRODUCT_NAME			AS PRODUCT_NAME,
		PR.PRICE_KR				AS PRICE_KR,
		PR.PRICE_EN				AS PRICE_EN,
		PR.PRICE_CN				AS PRICE_CN,
		PR.DISCOUNT_KR			AS DISCOUNT_KR,
		PR.DISCOUNT_EN			AS DISCOUNT_EN,
		PR.DISCOUNT_CN			AS DISCOUNT_CN,
		PR.SALES_PRICE_KR		AS SALES_PRICE_KR,
		PR.SALES_PRICE_EN		AS SALES_PRICE_EN,
		PR.SALES_PRICE_CN		AS SALES_PRICE_CN,
		PR.CREATE_DATE			AS CREATE_DATE,
		PR.UPDATE_DATE			AS UPDATE_DATE
	FROM
		SHOP_PRODUCT PR
		LEFT JOIN ORDERSHEET_MST OM ON
		PR.ORDERSHEET_IDX = OM.IDX
	WHERE
		".$where."
	ORDER BY
		".$order."
";

if ($rows != null) {
	$select_relevant_product_sql .= " LIMIT ".$limit_start.",".$rows;
}

$db->query($select_relevant_product_sql);

foreach($db->fetch() as $relevant_data) {
	$relevant_idx = $relevant_data['PRODUCT_IDX'];
	
	$relevant_product_stock = getProductStock($db,$relevant_idx);
	
	$json_result['data'][] = array(
		'product_idx'				=>$relevant_data['PRODUCT_IDX'],
		'product_type'				=>$relevant_data['PRODUCT_TYPE'],
		'style_code'				=>$relevant_data['STYLE_CODE'],
		'color_code'				=>$relevant_data['COLOR_CODE'],
		'img_location'				=>$relevant_data['IMG_LOCATION'],
		'product_code'				=>$relevant_data['PRODUCT_CODE'],
		'product_name'				=>$relevant_data['PRODUCT_NAME'],
		'price_kr'					=>number_format($relevant_data['PRICE_KR']),
		'price_en'					=>number_format($relevant_data['PRICE_EN']),
		'price_cn'					=>number_format($relevant_data['PRICE_CN']),
		'discount_kr'				=>number_format($relevant_data['DISCOUNT_KR']),
		'discount_en'				=>number_format($relevant_data['DISCOUNT_EN']),
		'discount_cn'				=>number_format($relevant_data['DISCOUNT_CN']),
		'sales_price_kr'			=>number_format($relevant_data['SALES_PRICE_KR']),
		'sales_price_en'			=>number_format($relevant_data['SALES_PRICE_EN']),
		'sales_price_cn'			=>number_format($relevant_data['SALES_PRICE_CN']),
		'create_date'				=>$relevant_data['CRAETE_DATE'],
		'update_date'				=>$relevant_data['UPDATE_DATE'],
		
		'relevant_product_stock'	=>$relevant_product_stock
	);
}

function getProductStock($db,$product_idx){
	$select_product_stock_sql = "
		SELECT
			OO.OPTION_NAME		AS OPTION_NAME,
			OO.BARCODE			AS BARCODE,
			(
				SELECT
					IFNULL(SUM(S_PS.STOCK_QTY),0)
				FROM
					PRODUCT_STOCK S_PS
				WHERE
					S_PS.PRODUCT_IDX = PR.IDX AND
					S_PS.OPTION_IDX = OO.IDX AND
					S_PS.STOCK_DATE <= NOW()
			)					AS STOCK_QTY,
			(
				SELECT
					IFNULL(SUM(S_PS.STOCK_SAFE_QTY),0)
				FROM
					PRODUCT_STOCK S_PS
				WHERE
					S_PS.PRODUCT_IDX = PR.IDX AND
					S_PS.OPTION_IDX = OO.IDX AND
					S_PS.STOCK_DATE <= NOW()
			)					AS SAFE_QTY,
			(
				SELECT
					IFNULL(SUM(S_OP.PRODUCT_QTY),0)
				FROM
					ORDER_PRODUCT S_OP
				WHERE
					S_OP.ORDER_STATUS IN ('PCP','PPR','DPR','DPG','DCP') AND
					S_OP.PRODUCT_IDX = PR.IDX AND
					S_OP.OPTION_IDX = OO.IDX
			)					AS ORDER_QTY
		FROM
			SHOP_PRODUCT PR
			LEFT JOIN ORDERSHEET_OPTION OO ON
			PR.ORDERSHEET_IDX = OO.ORDERSHEET_IDX
		WHERE
			PR.IDX = ".$product_idx."
		ORDER BY
			OO.IDX
	";
	
	$db->query($select_product_stock_sql);
	
	$stock_info = array();
	foreach($db->fetch() as $stock_data) {
		$product_qty = intval($stock_data['STOCK_QTY']) - intval($stock_data['ORDER_QTY']);
		
		$stock_info[] = array(
			'option_name'		=>$stock_data['OPTION_NAME'],
			'barcode'			=>$stock_data['BARCODE'],
			'stock_qty'			=>$stock_data['STOCK_QTY'],
			'safe_qty'			=>$stock_data['SAFE_QTY'],
			'order_qty'			=>$stock_data['ORDER_QTY'],
			'product_qty'		=>$product_qty
		);
	}
	
	return $stock_info;
}
?>