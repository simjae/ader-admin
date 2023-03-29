<?php
/*
 +=============================================================================
 | 
 | 상품 진열 페이지_상품 라이브러리 검색 모달 - 상품 라이브러리 검색
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.08.15
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

header("Access-Control-Allow-Origin: *");

$search_type		= $_POST['search_type'];
$search_keyword		= $_POST['search_keyword'];

$product_idx		= $_POST['product_idx'];
$product_name		= $_POST['product_name'];
$product_code		= $_POST['product_code'];
$barcode			= $_POST['barcode'];
$option_name		= $_POST['option_name'];

$min_price_kr		= $_POST['min_price_kr'];
$max_price_kr		= $_POST['max_price_kr'];
$min_price_en		= $_POST['min_price_en'];
$max_price_en		= $_POST['max_price_en'];
$min_price_cn		= $_POST['min_price_cn'];
$max_price_cn		= $_POST['max_price_cn'];

$rows				= $_POST['rows'];
$page				= $_POST['page'];

$sort_type			= $_POST['sort_type'];				//정렬타입
$sort_value			= $_POST['sort_value'];				//정렬 기준값

$table = "
	SHOP_PRODUCT PR
	LEFT JOIN ORDERSHEET_OPTION OO ON
	PR.ORDERSHEET_IDX = OO.IDX
";

/** 검색 조건 **/
$where = "1=1";
$where .= " AND (PR.DEL_FLG = FALSE AND PR.SALE_FLG = TRUE AND PR.SOLD_OUT_FLG = FALSE) ";
$where .= "
	AND (
		(
			SELECT
				COUNT(S_PI.IDX)
			FROM
				PRODUCT_IMG S_PI
			WHERE
				S_PI.PRODUCT_IDX = PR.IDX
		) > 0
	)
";

$where .= "
	AND (
		(
			SELECT
				OM.COLOR
			FROM
				ORDERSHEET_MST OM
			WHERE
				OM.IDX = PR.ORDERSHEET_IDX
		) IS NOT NULL
	)
";

$where .= "
	AND (
		PR.PRICE_KR > 0 OR
		PR.PRICE_EN > 0 OR
		PR.PRICE_CN > 0
	) 
";

$where .= "
	AND (
		PR.SALES_PRICE_KR > 0 OR
		PR.SALES_PRICE_EN > 0 OR
		PR.SALES_PRICE_CN > 0
	)
";

$where .= "
	AND (
		PR.DETAIL_KR IS NOT NULL OR
		PR.DETAIL_EN IS NOT NULL OR
		PR.DETAIL_CN IS NOT NULL
	)
";

$where .= "
	AND (
		PR.CARE_KR IS NOT NULL OR
		PR.CARE_EN IS NOT NULL OR
		PR.CARE_CN IS NOT NULL
	)
";

$where .= "
	AND (
		PR.MATERIAL_KR IS NOT NULL OR
		PR.MATERIAL_EN IS NOT NULL OR
		PR.MATERIAL_CN IS NOT NULL
	)
";

if ($product_idx != null) {
	$where .= " AND (PR.IDX NOT IN (".$product_idx."))";
}

$cnt_where = $where;

if ($product_name != null) {
	$product_name = str_replace(",","|",$product_name);
	
	$where .= " AND (PR.PRODUCT_NAME REGEXP '".$product_name."') ";
}

if ($product_code != null) {
	$product_code = str_replace(",","|",$product_code);
	$where .= " AND (PR.PRODUCT_CODE REGEXP '".$product_code."') ";
}

if ($barcode != null) {
	$barcode = str_replace(",","|",$barcode);
	
	$where .= " AND (OO.BARCODE REGEXP '".$barcode."') ";
}

if ($option_name != null) {
	$option_name = str_replace(",","|",$option_name);
	
	$where .= " AND (OO.OPTION_NAME REGEXP '".$option_name."') ";
}

if ($min_price_kr != null || $max_price_kr != null) {
	if ($min_price_kr != null && $max_price_kr == null) {
		$where .= " AND (PR.SALES_PRICE_KR >= ".$min_price_kr.") ";
	} else if ($min_price_kr == null && $max_price_kr != null) {
		$where .= " AND (PR.SALES_PRICE_KR <= ".$max_price_kr.") ";
	} else if ($min_price_kr != null && $max_price_kr != null) {
		$where .= " AND (PR.SALES_PRICE_KR BETWEEN ".$min_price_kr." AND ".$max_price_kr.") ";
	}
}

if ($min_price_en != null || $max_price_en != null) {
	if ($min_price_en != null && $max_price_en == null) {
		$where .= " AND (PR.SALES_PRICE_EN >= ".$min_price_en.") ";
	} else if ($min_price_en == null && $max_price_en != null) {
		$where .= " AND (PR.SALES_PRICE_EN <= ".$max_price_en.") ";
	} else if ($min_price_en != null && $max_price_en != null) {
		$where .= " AND (PR.SALES_PRICE_EN BETWEEN ".$min_price_en." AND ".$max_price_en.") ";
	}
}

if ($min_price_cn != null || $max_price_cn != null) {
	if ($min_price_cn != null && $max_price_cn == null) {
		$where .= " AND (PR.SALES_PRICE_CN >= ".$min_price_cn.") ";
	} else if ($min_price_cn == null && $max_price_cn != null) {
		$where .= " AND (PR.SALES_PRICE_CN <= ".$max_price_cn.") ";
	} else if ($min_price_cn != null && $max_price_cn != null) {
		$where .= " AND (PR.SALES_PRICE_CN BETWEEN ".$min_price_cn." AND ".$max_price_cn.") ";
	}
}

$order = '';
if ($sort_value != null && $sort_type != null) {
	$order = ' '.$sort_value." ".$sort_type." ";
} else {
	$order = ' PRODUCT_IDX DESC';
}

/** DB 처리 **/
$json_result = array(
	'total' => $db->count($table,$where),
	'total_cnt' => $db->count($table,$cnt_where),
	'page' => intval($page)
);

$limit_start = (intval($page)-1)*$rows;

$select_product_lib_sql = "
	SELECT
		*
	FROM
		(
			SELECT
				PR.IDX				AS PRODUCT_IDX,
				PR.PRODUCT_TYPE		AS PRODUCT_TYPE,
				PR.PRODUCT_CODE		AS PRODUCT_CODE,
				PR.PRODUCT_NAME		AS PRODUCT_NAME,
				(
					SELECT
						REPLACE(S_PI.IMG_LOCATION,'/var/www/admin/www','')
					FROM
						PRODUCT_IMG S_PI
					WHERE
						S_PI.PRODUCT_IDX = PR.IDX AND
						S_PI.IMG_TYPE = 'P' AND
						S_PI.IMG_SIZE = 'S'
					ORDER BY
						S_PI.IDX ASC
					LIMIT
						0,1
				)					AS IMG_LOCATION,
				PR.PRICE_KR			AS PRICE_KR,
				PR.PRICE_EN			AS PRICE_EN,
				PR.PRICE_CN			AS PRICE_CN,
				PR.DISCOUNT_KR		AS DISCOUNT_KR,
				PR.DISCOUNT_EN		AS DISCOUNT_EN,
				PR.DISCOUNT_CN		AS DISCOUNT_CN,
				PR.SALES_PRICE_KR	AS SALES_PRICE_KR,
				PR.SALES_PRICE_EN	AS SALES_PRICE_EN,
				PR.SALES_PRICE_CN	AS SALES_PRICE_CN,
				
				(
					SELECT
						IFNULL(SUM(S_PS.STOCK_QTY),0)
					FROM
						PRODUCT_STOCK S_PS
					WHERE
						S_PS.PRODUCT_IDX = PR.IDX AND
						S_PS.OPTION_IDX = OO.IDX AND
						S_PS.STOCK_DATE <= NOW()
				)							AS STOCK_QTY,
				(
					SELECT
						IFNULL(SUM(S_OP.PRODUCT_QTY),0)
					FROM
						ORDER_PRODUCT S_OP
					WHERE
						S_OP.ORDER_STATUS IN ('PCP','PPR','DPR','DPG','DCP') AND
						S_OP.PRODUCT_IDX = PR.IDX AND
						S_OP.OPTION_IDX = OO.IDX
				)							AS ORDER_QTY,
				PR.CREATE_DATE		AS CREATE_DATE
			FROM
				".$table."
			WHERE
				".$where."
			GROUP BY
				PR.IDX
		)	AS LIB
	ORDER BY
		".$order."
";

if ($rows != null) {
	$select_product_lib_sql .= " LIMIT ".$limit_start.",".$rows;
}

$db->query($select_product_lib_sql);

foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'product_idx'			=>$data['PRODUCT_IDX'],
		'product_type'			=>$data['PRODUCT_TYPE'],
		'product_code'			=>$data['PRODUCT_CODE'],
		'product_name'			=>$data['PRODUCT_NAME'],
		'img_location'			=>$data['IMG_LOCATION'],
		
		'price_kr'				=>number_format($data['PRICE_KR']),
		'price_en'				=>number_format($data['PRICE_EN']),
		'price_cn'				=>number_format($data['PRICE_CN']),
		'discount_kr'			=>number_format($data['DISCOUNT_KR']),
		'discount_en'			=>number_format($data['DISCOUNT_EN']),
		'discount_cn'			=>number_format($data['DISCOUNT_CN']),
		'sales_price_kr'		=>number_format($data['SALES_PRICE_KR']),
		'sales_price_en'		=>number_format($data['SALES_PRICE_EN']),
		'sales_price_cn'		=>number_format($data['SALES_PRICE_CN']),
		
		'stock_qty'				=>$data['STOCK_QTY'],
		'order_qty'				=>$data['ORDER_QTY'],
		'product_qty'			=>intval($data['STOCK_QTY'] - $data['ORDER_QTY'])
	);
}

?>