<?php

/*
 +=============================================================================
 | 
 |  필터 관리 - 필터 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.01.24
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$filter_type	= $_POST['filter_type'];
$country		= $_POST['country'];
$filter_name	= $_POST['filter_name'];
$rgb_color		= $_POST['rgb_color'];
$size_type		= $_POST['size_type'];

$sort_value		= $_POST['sort_value'];
$sort_type		= $_POST['sort_type'];

$rows			= $_POST['rows'];
$page			= $_POST['page'];

$where = " 1=1 ";
$where .= " AND (PF.DEL_FLG = FALSE) ";
$where_cnt = $where;

if ($filter_type != null && $filter_type != "ALL") {
	$where .= " AND (PF.FILTER_TYPE = '".$filter_type."') ";
}

if ($country != null && $filter_name != null) {
	$where .= " AND (PF.FILTER_NAME_".$country." LIKE '%".$filter_name."%') ";
}

if ($rgb_color != null) {
	$where .= " AND (PF.RGB_COLOR LIKE '%".$rgb_color."%') ";
}

if ($size_type != null && $size_type != "ALL") {
	$where .= " AND (SIZE_TYPE = '".$size_type."') ";
}

$order = "";
if ($sort_value != null && $sort_type != null) {
	$order = " PF.".$sort_value." ".$sort_type." ";
} else {
	$order = " PF.IDX DESC";
}

$limit_start = (intval($page)-1)*$rows;

$total_cnt = $db->count("PRODUCT_FILTER PF",$where_cnt);

$json_result = array(
	'total' => $db->count("PRODUCT_FILTER PF",$where),
	'total_cnt' => $total_cnt,
	'page' => $page
);

$select_filter_sql = "
	SELECT
		PF.IDX				AS FILTER_IDX,
		PF.FILTER_TYPE		AS FILTER_TYPE,
		PF.FILTER_NAME_KR	AS FILTER_NAME_KR,
		PF.FILTER_NAME_EN	AS FILTER_NAME_EN,
		PF.FILTER_NAME_CN	AS FILTER_NAME_CN,
		IFNULL(
			PF.RGB_COLOR,'-'
		)					AS RGB_COLOR,
		IFNULL(
			PF.SIZE_TYPE,'-'
		)					AS SIZE_TYPE,
		IFNULL(
			PF.MEMO,'-'
		)					AS MEMO,
		PF.CREATE_DATE		AS CREATE_DATE,
		PF.CREATER			AS CREATER,
		PF.UPDATE_DATE		AS UPDATE_DATE,
		PF.UPDATER			AS UPDATER
	FROM
		PRODUCT_FILTER PF
	WHERE
		".$where."
	ORDER BY 
		".$order."
";

if ($rows != null && $select_idx_flg == null) {
	$select_filter_sql .= " LIMIT ".$limit_start.",".$rows;
}

$db->query($select_filter_sql);

foreach($db->fetch() as $filter_data) {
	$filter_idx = $filter_data['FILTER_IDX'];
	$filter_type = $filter_data['FILTER_TYPE'];
	
	$filter_type_str = "";
	if ($filter_type == "CL") {
		$filter_type_str = "컬러";
	} else if ($filter_type == "SZ") {
		$filter_type_str = "사이즈";
	}
	
	$size_type = $filter_data['SIZE_TYPE'];
	switch ($size_type) {
		case "UP" :
			$size_type = "상의";
			break;
		
		case "LW" :
			$size_type = "하의";
			break;
		
		case "HT" :
			$size_type = "모자";
			break;
		
		case "SH" :
			$size_type = "신발";
			break;
		
		case "JW" :
			$size_type = "쥬얼리";
			break;
		
		case "AC" :
			$size_type = "악세서리";
			break;
		
		case "TA" :
			$size_type = "테크 악세서리";
			break;
	}
	
	$product_cnt = $db->count("SHOP_PRODUCT","FILTER_".$filter_type." REGEXP '".$filter_idx."'");
	
	$json_result['data'][] = array(
		'num'				=>$total_cnt--,
		'filter_idx'		=>$filter_idx,
		'filter_type'		=>$filter_type_str,
		'filter_name_kr'	=>$filter_data['FILTER_NAME_KR'],
		'filter_name_en'	=>$filter_data['FILTER_NAME_EN'],
		'filter_name_cn'	=>$filter_data['FILTER_NAME_CN'],
		'rgb_color'			=>$filter_data['RGB_COLOR'],
		'size_type'			=>$size_type,
		'memo'				=>$filter_data['MEMO'],
		'create_date'		=>$filter_data['CREATE_DATE'],
		'creater'			=>$filter_data['CREATER'],
		'update_date'		=>$filter_data['UPDATE_DATE'],
		'updater'			=>$filter_data['UPDATER'],
		'product_cnt'		=>$product_cnt
	);
}

?>
