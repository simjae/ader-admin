<?php

header('Content-type: application/json');
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
echo json_encode($json_result, JSON_UNESCAPED_UNICODE);
?>