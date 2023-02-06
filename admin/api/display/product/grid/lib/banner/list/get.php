<?php
/*
 +=============================================================================
 | 
 | 상품 진열 페이지_상품 라이브러리 검색 모달 - 배너 라이브러리 검색
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2023.01.09
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$banner_type	= $_POST['banner_type'];
$param_idx		= $_POST['banner_idx'];

$banner_title	= $_POST['banner_title'];
$banner_memo	= $_POST['banner_memo'];

$rows = $_POST['rows'];
$page = $_POST['page'];

$where = " BI.DEL_FLG = FALSE ";
$where_cnt = $where;

if ($param_idx != null) {
	$where .= " AND (BI.IDX NOT IN (".$param_idx.")) ";
}

if ($banner_title != null) {
	$where .= " AND(BI.BANNER_TITLE LIKE '%".$banner_title."%') ";
}

if ($banner_memo != null) {
	$where .= " AND (BI.BANNER_MEMO LIKE '%".$banner_memo."%') ";
}

$banner_table = "";
switch ($banner_type) {
	case "HED" :
		$banner_table = "dev.BANNER_HED BI";
		break;
	
	case "IMG" :
		$banner_table = "dev.BANNER_IMG BI";
		break;
	
	case "VID" :
		$banner_table = "dev.BANNER_VID BI";
		break;
}

$total_cnt = $db->count($banner_table,$where_cnt);
$json_result = array(
	'total' => $db->count($banner_table,$where),
	'total_cnt' => $total_cnt,
	'page' => intval($page)
);

$limit_start = (intval($page)-1)*$rows;

$select_banner_sql = "
	SELECT
		BI.IDX					AS BANNER_IDX,
		BI.BANNER_TITLE			AS BANNER_TITLE,
		BI.BANNER_MEMO			AS BANNER_MEMO,
		REPLACE(
			BI.BANNER_THUMBNAIL,
			'/var/www/admin/www',
			''
		)						AS BANNER_THUMBNAIL,
		BI.BANNER_LOCATION		AS BANNER_LOCATION,
		BI.CREATE_DATE			AS CREATE_DATE,
		BI.CREATER				AS CREATER,
		BI.UPDATE_DATE			AS UPDATE_DATE,
		BI.UPDATER				AS UPDATER
	FROM
		".$banner_table."
	WHERE
		".$where."
";

if ($rows != null) {
	$sql .= " LIMIT ".$limit_start.",".$rows;
}

$db->query($select_banner_sql);

foreach($db->fetch() as $banner_data) {
	$json_result['data'][] = array(
		'num'				=>$total_cnt--,
		'banner_idx'		=>$banner_data['BANNER_IDX'],
		'banner_title'		=>$banner_data['BANNER_TITLE'],
		'banner_memo'		=>$banner_data['BANNER_MEMO'],
		'banner_thumbnail'	=>$banner_data['BANNER_THUMBNAIL'],
		'banner_location'	=>$banner_data['BANNER_LOCATION'],
		'create_date'		=>$banner_data['CREATE_DATE'],
		'creater'			=>$banner_data['CREATER'],
		'update_date'		=>$banner_data['UPDATE_DATE'],
		'updater'			=>$banner_data['UPDATER']
	);
}
?>