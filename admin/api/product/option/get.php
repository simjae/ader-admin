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
$product_idx = $_POST['product_idx'];
$category_name = $_POST['category_name'];
$product_code = $_POST['product_code'];
$search_type = $_POST['search_type'];
$search_keyword = $_POST['search_keyword'];
$option_code = $_POST['option_code'];

$where = "1=1";

if($product_idx != null){
	$where .= ' AND OPTION.PRODUCT_IDX = '.$product_idx.' ';
}
else{
	if($category_name != null){
		$where .= ' AND OPTION.CATEGORY_NAME = "'.$category_name.'" ';
	}
	
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
}

//검색 유형 - 디폴트
$sql = 	"SELECT
			OPTION.IDX,
			OPTION.OPTION_CODE,
			OPTION.OPTION_NAME,
			OPTION.PRODUCT_IDX,
			OPTION.PRODUCT_CODE,
			PRODUCT.PRODUCT_NAME,
			OPTION.STOCK_GRADE,
			OPTION.CATEGORY_NAME,
			OPTION.SIZE_INFO_1,
			OPTION.SIZE_INFO_2,
			OPTION.SIZE_INFO_3,
			OPTION.SIZE_INFO_4,
			OPTION.SIZE_INFO_5,
			OPTION.SIZE_INFO_6,
			SIZE.SIZE_TITLE_1,
            SIZE.SIZE_TITLE_2,
            SIZE.SIZE_TITLE_3,
            SIZE.SIZE_TITLE_4,
            SIZE.SIZE_TITLE_5,
            SIZE.SIZE_TITLE_6
		FROM
			PRODUCT_OPTION OPTION
			LEFT JOIN SHOP_PRODUCT PRODUCT ON
			OPTION.PRODUCT_CODE = PRODUCT.PRODUCT_CODE
			LEFT JOIN SIZE_DESCRIPTION SIZE ON
            SIZE.CATEGORY_NAME = OPTION.CATEGORY_NAME
		WHERE
			".$where;

$db->query($sql);

foreach($db->fetch() as $data) {
	$row_arr = array('no'						=>intval($data['IDX']),
					'option_code'				=>$data['OPTION_CODE'],
					'option_name'				=>$data['OPTION_NAME'],
					'product_idx'				=>$data['PRODUCT_IDX'],
					'product_code'				=>$data['PRODUCT_CODE'],
					'product_name'				=>$data['PRODUCT_NAME'],
					'stock_grade'				=>$data['STOCK_GRADE'],
					'category_name'				=>$data['CATEGORY_NAME']);
	$column_arr = array();
	for($i = 1; $i <= 6; $i++){
		if(strlen($data['SIZE_TITLE_'.$i]) > 0){
			$column_arr[$data['SIZE_TITLE_'.$i]]	= $data['SIZE_INFO_'.$i];
		}
	}
	$row_arr['size'] = $column_arr;
	$json_result['data'][] = $row_arr;
}
?>