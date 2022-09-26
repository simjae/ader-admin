<?php
/*
 +=============================================================================
 | 
 | 상품 목록 페이지 조회 API
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

/** 검색 조건 **/
$where = "1=1";
$where .= " AND (PRODUCT.DEL_FLG = FALSE AND PRODUCT.SALE_FLG = TRUE) ";
$where .= " AND (IMG_TYPE = 'PRODUCT' AND IMG.IMG_SIZE = 'mdl' AND IMG.DEL_FLG = FALSE) ";

/* 검색조건 : 검색타입 - 검색키워드 */
if ($search_type != null && $search_keyword != null) {
	switch ($search_type) {
		case "product_code" :
			$where .=  " AND PRODUCT.PRODUCT_CODE LIKE '%".$search_keyword."%' ";
			break;
		
		case "product_name" :
			$where .=  " AND PRODUCT.PRODUCT_NAME LIKE '%".$search_keyword."%' ";
			break;

		case "option_code" :
			$where .=  " AND OPTION.OPTION_CODE LIKE '%".$search_keyword."%' ";
			break;
		
		case "option_name" :
			$where .=  " AND OPTION.OPTION_NAME LIKE '%".$search_keyword."%' ";
			break;
	}
}

if ($product_idx != null) {
	$product_idx = implode(',',$product_idx);
	$where .= " AND (PRODUCT.IDX NOT IN (".$product_idx.")) ";
}

/** DB 처리 **/
$sql = "SELECT
			PRODUCT.IDX											AS PRODUCT_IDX,
			PRODUCT.PRODUCT_CODE								AS PRODUCT_CODE,
			REPLACE(IMG.IMG_LOCATION,'/var/www/admin/www','')	AS IMG_LOCATION
		FROM
			dev.SHOP_PRODUCT PRODUCT
			LEFT JOIN dev.PRODUCT_IMG IMG ON
			PRODUCT.PRODUCT_CODE = IMG.PRODUCT_CODE
			LEFT JOIN dev.PRODUCT_OPTION OPTION ON
			PRODUCT.PRODUCT_CODE = OPTION.OPTION_CODE
		WHERE
			".$where."
		ORDER BY
			PRODUCT.IDX DESC";

$db->query($sql);
$sql;
foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'product_idx'	=>intval($data['PRODUCT_IDX']),
		'product_code'	=>$data['PRODUCT_CODE'],
		'img_location'	=>$data['IMG_LOCATION']
	);
}
?>