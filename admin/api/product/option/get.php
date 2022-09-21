<?php
/*
 +=============================================================================
 | 
 | 회원 목록
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.07.18
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$product_code = $_POST['product_code'];
$search_type = $_POST['search_type'];
$search_keyword = $_POST['search_keyword'];
$option_code = $_POST['option_code'];

$where = "1=1";

if ($product_code != null) {
	$where .= ' AND (OPTION.OPTION_CODE LIKE "'.$product_code.'%") ';
} else if ($search_type != null && $search_keyword != null) {
	switch ($search_type) {
		case "product_code" :
			$where .= ' AND (PRODUCT.PRODUCT_CODE LIKE "%'.$search_keyword.'%") ';
			break;
		
		case "product_name" :
			$where .= ' AND (PRODUCT.PRODUCT_NAME LIKE "%'.$search_keyword.'%") ';
			break;
	}
} else if ($option_code != null) {
	$where .= " AND (OPTION.OPTION_CODE = '".$option_code."') ";
}

//검색 유형 - 디폴트
$sql = 	"SELECT
			OPTION.IDX,
			OPTION.PRODUCT_CODE,
			PRODUCT.PRODUCT_NAME,
			OPTION.OPTION_CODE,
			OPTION.OPTION_NAME,
			OPTION.STOCK_MANAGEMENT,
			OPTION.STOCK_GRADE,
			OPTION.QTY_CHECK_TYPE,
			OPTION.SOLD_OUT_FLG
		FROM
			dev.PRODUCT_OPTION OPTION
			LEFT JOIN dev.SHOP_PRODUCT PRODUCT ON
			OPTION.PRODUCT_CODE = PRODUCT.PRODUCT_CODE
		WHERE
			".$where;

$db->query($sql);
foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'no'				=>intval($data['IDX']),
		'option_code'		=>$data['OPTION_CODE'],
		'option_name'		=>$data['OPTION_NAME'],
		'product_code'		=>$data['PRODUCT_CODE'],
		'product_name'		=>$data['PRODUCT_NAME'],
		'stock_management'	=>$data['STOCK_MANAGEMENT'],
		'stock_grade'		=>$data['STOCK_GRADE'],
		'qty_check_type'	=>$data['QTY_CHECK_TYPE'],
		'sold_out_flg'		=>$data['SOLD_OUT_FLG'],
	);
}
?>