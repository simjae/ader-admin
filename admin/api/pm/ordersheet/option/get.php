<?php
/*
 +=============================================================================
 | 
 | 오더시트 옵션 검색
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.07.18
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$category_name  = $_POST['category_name'];
$search_type    = $_POST['search_type'];
$search_keyword = $_POST['search_keyword'];

$where = "1=1";

if($category_name != null){
    $where .= ' AND OPTION.SIZE_CATEGORY = "'.$category_name.'" ';
}

if ($search_type != null && $search_keyword != null) {
    switch ($search_type) {
        case "product_code" :
            $where .= ' AND (OPTION.PRODUCT_CODE LIKE "%'.$search_keyword.'%") ';
            break;
        
        case "product_name" :
            $where .= ' AND (OM.PRODUCT_NAME LIKE "%'.$search_keyword.'%") ';
            break;
    }
}

//검색 유형 - 디폴트
$sql = 	"SELECT
			OPTION.IDX,
            OPTION.ORDERSHEET_IDX,
			OPTION.PRODUCT_CODE,
			OPTION.BARCODE,
			OPTION.OPTION_NAME,
			OM.PRODUCT_NAME,
			OPTION.SIZE_CATEGORY,
			OPTION.OPTION_SIZE_1,
			OPTION.OPTION_SIZE_2,
			OPTION.OPTION_SIZE_3,
			OPTION.OPTION_SIZE_4,
			OPTION.OPTION_SIZE_5,
			OPTION.OPTION_SIZE_6,
			SIZE.SIZE_TITLE_1,
            SIZE.SIZE_TITLE_2,
            SIZE.SIZE_TITLE_3,
            SIZE.SIZE_TITLE_4,
            SIZE.SIZE_TITLE_5,
            SIZE.SIZE_TITLE_6
		FROM
			dev.ORDERSHEET_OPTION   OPTION          LEFT JOIN 
            dev.ORDERSHEET_MST OM 
        ON
			OPTION.PRODUCT_CODE = OM.PRODUCT_CODE   LEFT JOIN 
            dev.SIZE_DESCRIPTION SIZE 
        ON
            SIZE.CATEGORY_NAME = OPTION.SIZE_CATEGORY
		WHERE
			".$where;

$db->query($sql);

foreach($db->fetch() as $data) {
	$row_arr = array('no'						=>intval($data['IDX']),
					'barcode'				    =>$data['BARCODE'],
					'option_name'				=>$data['OPTION_NAME'],
					'ordersheet_idx'			=>$data['ORDERSHEET_IDX'],
					'product_code'				=>$data['PRODUCT_CODE'],
					'product_name'				=>$data['PRODUCT_NAME'],
					'size_category'				=>$data['SIZE_CATEGORY']);
	$column_arr = array();
	for($i = 1; $i <= 6; $i++){
		if(strlen($data['SIZE_TITLE_'.$i]) > 0){
			$column_arr[$data['SIZE_TITLE_'.$i]]	= $data['OPTION_SIZE_'.$i];
		}
	}
	$row_arr['size'] = $column_arr;
	$json_result['data'][] = $row_arr;
}
?>