<?php
/*
 +=============================================================================
 | 
 | 상품 목록 페이지 등록
 | -----------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.08.22
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$contents_type		= $_POST['contents_type'];
$contents_idx		= $_POST['contents_idx'];

$title				= $_POST['title'];
$type				= $_POST['type'];
$memo				= $_POST['memo'];

$rows 				= $_POST['rows'];
$page 				= $_POST['page'];

$tables = "";
if ($contents_type == "IMG") {
	$tables = "dev.DISPLAY_CONTENTS_IMG";
} else if ($contents_type == "VID") {
	$tables = "dev.DISPLAY_CONTENTS_VID";
}

$sort_value = $_POST['sort_value'];
$sort_type 	= $_POST['sort_type'];

/** 검색 조건 **/
$where = ' DEL_FLG = FALSE ';
$cnt_where = $where;

if ($contents_idx != null) {
	$where .= " AND (IDX = ".$contents_idx.") ";
}

if ($title != null) {
	$where .= " AND (".$contents_type."_TITLE = '".$title."') ";
}

if ($type != null) {
	$where .= " AND (".$contents_type."_TYPE = '".$type."') ";
}

if ($memo != null) {
	$where .= " AND (".$contents_type."_MEMO = '".$memo."') ";
}

/** 정렬 조건 **/
$order = '';
if ($sort_value != null && $sort_type != null) {
	$order = " ".$sort_value." ".$sort_type." ";
} else {
	$order = " IDX DESC ";
}

/** DB 처리 **/
$limit_start = (intval($page)-1)*$rows;
$json_result = array(
	'total' => $db->count($tables,$where),
	'total_cnt' => $db->count($tables,$cnt_where),
	'page' => intval($page)
);

$sql = "SELECT
			IDX,
			".$contents_type."_TITLE,
			".$contents_type."_TYPE,
			".$contents_type."_LOCATION,
			".$contents_type."_URL,
			CREATE_DATE,
			CREATER,
			UPDATE_DATE,
			UPDATER
		FROM
			".$tables."
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
		'num'							=>intval($total_cnt--),
		'idx'							=>intval($data['IDX']),
		'title'							=>$data[$contents_type.'_TITLE'],
		'type'							=>$data[$contents_type.'_TYPE'],
		'location'						=>$data[$contents_type.'_LOCATION'],
		'url'							=>$data[$contents_type.'_URL'],
		'create_date'					=>$data['CREATE_DATE'],
		'creater'						=>$data['CREATER'],
		'update_date'					=>$data['UPDATE_DATE'],
		'updater'						=>$data['UPDATER'],
	);
}
