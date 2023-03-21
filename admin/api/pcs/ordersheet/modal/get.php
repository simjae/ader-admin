<?php
/*
 +=============================================================================
 | 
 | LINE/WKLA 사용중인 상품 리스트
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.02.14
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$line_idx	= NULL;
if(isset($_POST['line_idx'])){
    $line_idx = $_POST['line_idx'];
}

$wkla_idx	= NULL;
if(isset($_POST['wkla_idx'])){
    $wkla_idx = $_POST['wkla_idx'];
}

$box_idx	= NULL;
if(isset($_POST['box_idx'])){
    $box_idx = $_POST['box_idx'];
}

$search_type 		= $_POST['search_type'];			//검색분류
$search_keyword 	= $_POST['search_keyword'];			//검색 키워드

$sort_type 			= $_POST['sort_type'];				//정렬 타입
$sort_value 		= $_POST['sort_value'];				//정렬 값

$rows = $_POST['rows'];
$page = $_POST['page'];

$where_cnt=" ";

if($line_idx != NULL){
	$where_cnt .= " OM.LINE_IDX = ".$line_idx." ";
}
else if($wkla_idx != NULL){
	$where_cnt .= " OM.WKLA_IDX = ".$wkla_idx." ";
}
else if($box_idx != NULL){
	$where_cnt .= " OM.LOAD_BOX_IDX = ".$box_idx." ";
}
else if($sub_material_idx != NULL){
	$where_cnt .= " OM.IDX IN (	SELECT 
									DISTINCT ORDERSHEET_IDX 
								FROM 
									SUB_MATERIAL_MAPPING 
								WHERE 
									SUB_MATERIAL_IDX = ".$sub_material_idx." )";
}
else{
	$where_cnt .= " 1=0 ";
}

$where = '';

if ($search_type != null && $search_keyword != null) {
	$type_arr = array();
	for ($i=0; $i<count($search_type); $i++) {
		if (strlen($search_type[$i]) != 0) {
			array_push($type_arr,$search_type[$i]);
		}
	}
	
	$keyword_arr = array();
	for ($i=0; $i<count($search_keyword); $i++) {
		if (strlen($search_keyword[$i]) != 0) {
			array_push($keyword_arr,$search_keyword[$i]);
		}
	}
	
	if (count($type_arr) > 0 && count($keyword_arr) > 0) {
		$where .= " AND (";
		
		$tmp_where .= "";
		for ($i=0; $i<count($search_type); $i++) {
			$keyword_where = "";
			if ($search_type[$i] != null && $search_keyword[$i] != null) {
				if (strlen($tmp_where) > 0) {
					$tmp_where .= " AND ";
				}
				switch ($search_type[$i]) {
					case "name" :
						$keyword_where .= ' (OM.PRODUCT_NAME LIKE "%'.$search_keyword[$i].'%") ';
						break;
					
					case "code" :
						$keyword_where .= ' (OM.PRODUCT_CODE LIKE "%'.$search_keyword[$i].'%") ';
						break;
				}
				
				$tmp_where .= $keyword_where;
			}
		}
		
		$where .= $tmp_where;
		
		$where .= " ) ";
	}
}

$where = $where_cnt.$where;

/** 정렬 조건 **/
$order = '';
if ($sort_value != null && $sort_type != null) {
	$order = ' OM.'.$sort_value." ".$sort_type." ";
} else {
	$order = ' OM.IDX DESC';
}

$limit_start = (intval($page)-1)*$rows;
$json_result = array(
	'total' => $db->count("ORDERSHEET_MST OM",$where),
	'total_cnt' => $db->count("ORDERSHEET_MST OM",$where_cnt),
	'page' => $page
);

$sql = "SELECT
			OM.IDX				AS ORDERSHEET_IDX,
			OM.STYLE_CODE		AS STYLE_CODE,
			OM.COLOR_CODE		AS COLOR_CODE,
			OM.PRODUCT_CODE		AS PRODUCT_CODE,
			OM.PRODUCT_NAME		AS PRODUCT_NAME,
			CASE
				WHEN
					(
						SELECT
							COUNT(S_OI.IDX)
						FROM
							ORDERSHEET_IMG S_OI
						WHERE
							S_OI.ORDERSHEET_IDX = OM.IDX AND
							IMG_TYPE = 'P' AND
							IMG_SIZE = 'S'
					) > 0
					THEN
						(
							SELECT
								S_OI.IMG_LOCATION
							FROM
								ORDERSHEET_IMG S_OI
							WHERE
								S_OI.ORDERSHEET_IDX = OM.IDX AND
								S_OI.IMG_TYPE = 'P' AND
								S_OI.IMG_SIZE = 'S'
							ORDER BY
								S_OI.IDX ASC
							LIMIT
								0,1
						)
				ELSE
					'/images/default_product_img.jpg'
			END												AS IMG_LOCATION,
			OM.UPDATE_DATE		AS UPDATE_DATE
		FROM
			ORDERSHEET_MST OM
		WHERE
			".$where."
		ORDER BY
			".$order;

if ($rows != null && $select_idx_flg == null) {
	$sql .= " LIMIT ".$limit_start.",".$rows;
}

$db->query($sql);
foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'ordersheet_idx'		=>$data['ORDERSHEET_IDX'],
		'style_code'		=>$data['STYLE_CODE'],
		'color_code'		=>$data['COLOR_CODE'],
		'product_code'		=>$data['PRODUCT_CODE'],
		'product_name'		=>$data['PRODUCT_NAME'],
		'img_location'		=>$data['IMG_LOCATION'],
		'update_date'		=>$data['UPDATE_DATE']
	);
}
?>