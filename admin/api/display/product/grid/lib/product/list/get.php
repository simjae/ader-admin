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

/** 변수 정리 **/
$search_type		= $_POST['search_type'];
$search_keyword		= $_POST['search_keyword'];

$product_idx		= $_POST['product_idx'];

$rows = $_POST['rows'];
$page = $_POST['page'];

/** 검색 조건 **/
$where = "1=1";
$where .= " AND (PR.DEL_FLG = FALSE AND PR.SALE_FLG = TRUE) ";
$where .= " AND (SELECT COUNT(IDX) FROM dev.PRODUCT_IMG S_PI WHERE S_PI.PRODUCT_IDX = PR.IDX > 0) ";
$cnt_where .= $where;

/* 검색조건 : 검색타입 - 검색키워드 */
if ($search_type != null && $search_keyword != null) {
	switch ($search_type) {
		case "product_code" :
			$where .=  " AND PR.PRODUCT_CODE LIKE '%".$search_keyword."%' ";
			break;
		
		case "product_name" :
			$where .=  " AND PR.PRODUCT_NAME LIKE '%".$search_keyword."%' ";
			break;

		case "barcode" :
			$where .=  " AND OO.BARCODE LIKE '%".$search_keyword."%' ";
			break;
		
		case "option_name" :
			$where .=  " AND OO.OPTION_NAME LIKE '%".$search_keyword."%' ";
			break;
	}
}

if ($product_idx != null) {
	$where .= " AND (PR.IDX NOT IN (".$product_idx.")) ";
}

/** DB 처리 **/
$json_result = array(
	'total' => $db->count("dev.SHOP_PRODUCT PR",$where),
	'total_cnt' => $db->count("dev.SHOP_PRODUCT PR",$cnt_where),
	'page' => intval($page)
);

$limit_start = (intval($page)-1)*$rows;

$sql = "SELECT
			PR.IDX				AS PRODUCT_IDX,
			PR.PRODUCT_TYPE		AS PRODUCT_TYPE,
			PR.STYLE_CODE		AS STYLE_CODE,
			PR.COLOR_CODE		AS COLOR_CODE,
			PR.PRODUCT_CODE		AS PRODUCT_CODE,
			PR.PRODUCT_NAME		AS PRODUCT_NAME,
			(
				SELECT
					REPLACE(S_PI.IMG_LOCATION,'/var/www/admin/www','')
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
			PR.PRICE_KR			AS PRICE_KR,
			PR.PRICE_EN			AS PRICE_EN,
			PR.PRICE_CN			AS PRICE_CN,
			PR.DISCOUNT_KR		AS DISCOUNT_KR,
			PR.DISCOUNT_EN		AS DISCOUNT_EN,
			PR.DISCOUNT_CN		AS DISCOUNT_CN,
			PR.SALES_PRICE_KR	AS SALES_PRICE_KR,
			PR.SALES_PRICE_EN	AS SALES_PRICE_EN,
			PR.SALES_PRICE_CN	AS SALES_PRICE_CN,
			PR.UPDATE_DATE		AS UPDATE_DATE
		FROM
			dev.SHOP_PRODUCT PR
		WHERE
			".$where."
		ORDER BY
			PR.IDX DESC";

if ($rows != null) {
	$sql .= " LIMIT ".$limit_start.",".$rows;
}

$db->query($sql);

foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'product_idx'		=>$data['PRODUCT_IDX'],
		'product_type'		=>$data['PRODUCT_TYPE'],
		'style_code'		=>$data['STYLE_CODE'],
		'color_code'		=>$data['COLOR_CODE'],
		'product_code'		=>$data['PRODUCT_CODE'],
		'product_name'		=>$data['PRODUCT_NAME'],
		'img_location'		=>$data['IMG_LOCATION'],
		'price_kr'			=>$data['PRICE_KR'],
		'price_en'			=>$data['PRICE_EN'],
		'price_cn'			=>$data['PRICE_CN'],
		'discount_kr'		=>$data['DISCOUNT_KR'],
		'discount_en'		=>$data['DISCOUNT_EN'],
		'discount_cn'		=>$data['DISCOUNT_CN'],
		'sales_price_kr'	=>$data['SALES_PRICE_KR'],
		'sales_price_en'	=>$data['SALES_PRICE_EN'],
		'sales_price_cn'	=>$data['SALES_PRICE_CN'],
		'update_date'		=>$data['UPDATE_DATE']
	);
}
?>