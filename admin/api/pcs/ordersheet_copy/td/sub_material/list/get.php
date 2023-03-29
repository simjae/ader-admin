<?php
/*
 +=============================================================================
 | 
 | 부자재 정보 리스트
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.11.04
 | 최종 수정일	: 
 | 버전		: 1.1
 | 설명		: 
 | 
 +=============================================================================
*/

$ordersheet_idx			= $_POST['ordersheet_idx'];

$sub_material_type 		= $_POST['sub_material_type'];		//부자재 타입

$sub_material_sort		= $_POST['sub_material_sort'];
$sub_material_name 		= $_POST['sub_material_name'];		//부자재 명
$sub_material_code 		= $_POST['sub_material_code'];		//부자재 코드

$sort_type 				= $_POST['sort_type'];				//정렬 타입
$sort_value 			= $_POST['sort_value'];				//정렬 값

$rows = $_POST['rows'];
$page = $_POST['page'];

if ($sub_material_type != null && $sub_material_type != "ALL") {
	$where = "SM.SUB_MATERIAL_TYPE = '".$sub_material_type."'";
} else {
	$where = "SM.SUB_MATERIAL_TYPE IN ('T','D')";
}

$where_cnt = $where;

$having = '';

if ($sub_material_sort != null && $sub_material_sort != "ALL") {
	$where .= " AND (SM.SUB_MATERIAL_SORT = '".$sub_material_sort."') ";
}

if($sub_material_name != null){
	$where .= ' AND (SM.SUB_MATERIAL_NAME LIKE "%'.$sub_material_name.'%") ';
}
if($sub_material_code != null){
	$where .= ' AND (SM.SUB_MATERIAL_CODE LIKE "%'.$sub_material_code.'%") ';
}

/** 정렬 조건 **/
$order = '';
if ($sort_value != null && $sort_type != null) {
	$order = ' SM.'.$sort_value." ".$sort_type." ";
} else {
	$order = ' SM.IDX DESC';
}

$limit_start = (intval($page)-1)*$rows;
$json_result = array(
	'total_cnt' => $db->count("SUB_MATERIAL_INFO SM",$where_cnt),
	'total' => $db->count("SUB_MATERIAL_INFO SM",$where),
	'page' => $page
);

$select_sub_material_sql = "
	SELECT
		SM.IDX							AS SUB_MATERIAL_IDX,
		SM.SUB_MATERIAL_TYPE			AS SUB_MATERIAL_TYPE,
		SM.SUB_MATERIAL_SORT			AS SUB_MATERIAL_SORT,
		SM.SUB_MATERIAL_CODE			AS SUB_MATERIAL_CODE,
		SM.SUB_MATERIAL_NAME			AS SUB_MATERIAL_NAME,
		IFNULL(SM.COMPANY_NAME,'')		AS COMPANY_NAME,
		IFNULL(SM.COMPANY_CHARGE,'')	AS COMPANY_CHARGE,
		IFNULL(SM.COMPANY_TEL,'')		AS COMPANY_TEL,
		IFNULL(SM.COMPANY_ADDR,'')		AS COMPANY_ADDR,
		IFNULL(SM.MEMO,'')				AS SUB_MATERIAL_MEMO,
		(
			SELECT
				COUNT(0)
			FROM
				SUB_MATERIAL_MAPPING
			WHERE
				SUB_MATERIAL_IDX = SM.IDX
		)							AS ORDERSHEET_SUB_CNT
	FROM 
		SUB_MATERIAL_INFO SM
	WHERE
		".$where."
	GROUP BY 
		SM.IDX
	ORDER BY 
		".$order."
";

if ($rows != null) {
	$select_sub_material_sql .= " LIMIT ".$limit_start.",".$rows;
}

$db->query($select_sub_material_sql);

foreach($db->fetch() as $data) {
	$image_get_query = "
		SELECT
			IDX,
			SUB_MATERIAL_IDX,
			REPLACE(SM_IMG_LOCATION,'/var/www/admin/www', '') AS SM_IMG_LOCATION,
			REPLACE(WO_IMG_LOCATION,'/var/www/admin/www', '') AS WO_IMG_LOCATION
		FROM
			SUB_MATERIAL_IMAGE
		WHERE
			SUB_MATERIAL_IDX = ".$data['SUB_MATERIAL_IDX']."
	";
	$db->query($image_get_query);
	$image_info = array();
	foreach($db->fetch() as $image_info){
		$image_info[] = array(
			'idx' => $image_info['IDX'],
			'sub_material_idx' => $image_info['SUB_MATERIAL_IDX'],
			'sm_img_location' => $image_info['SM_IMG_LOCATION'],
			'wo_img_location' => $image_info['WO_IMG_LOCATION']
		);
	}
	$json_result['data'][] = array(
		'num'						=>$total_cnt--,
		'sub_material_idx'			=>intval($data['SUB_MATERIAL_IDX']),
		'sub_material_sort'			=>$data['SUB_MATERIAL_SORT'],
		'sub_material_name'			=>$data['SUB_MATERIAL_NAME'],
		'sub_material_code'			=>$data['SUB_MATERIAL_CODE'],
		'sub_material_memo'			=>$data['SUB_MATERIAL_MEMO'],
		'sub_material_type'			=>$data['SUB_MATERIAL_TYPE'],
		'company_name'				=>$data['COMPANY_NAME'],
		'company_charge'			=>$data['COMPANY_CHARGE'],
		'company_tel'				=>$data['COMPANY_TEL'],
		'company_addr'				=>$data['COMPANY_ADDR'],
		'image_info'				=>$image_info,
		'ordersheet_sub_cnt'		=>$data['ORDERSHEET_SUB_CNT']
	);
}
?>