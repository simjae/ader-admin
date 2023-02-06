<?php
/*
 +=============================================================================
 | 
 | 배너 관리 페이지 - 베너 리스트 조회
 | -----------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2023.01.03
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$banner_type	= $_POST['banner_type'];

$banner_title	= $_POST['banner_title'];
$banner_memo	= $_POST['banner_memo'];

$rows = $_POST['rows'];
$page = $_POST['page'];

$sort_value = $_POST['sort_value'];
$sort_type 	= $_POST['sort_type'];

if ($banner_type != null) {
	$banner_table = "";
	switch ($banner_type) {
		case "HED" :
			$banner_table = "dev.BANNER_HEAD";
			break;
		
		case "IMG" :
			$banner_table = "dev.BANNER_IMG";
			break;
		
		case "VID" :
			$banner_table = "dev.BANNER_VID";
			break;
	}

	$where = " BI.DEL_FLG = FALSE ";
	$where_cnt = $where;

	if ($banner_title != null) {
		$where .= " AND (BI.BANNER_TITLE LIKE '%".$banner_title."%') ";
	}

	if ($banner_memo != null) {
		$where .= " AND (BI.BANNER_MEMO LIKE '%".$banner_memo."%' ) ";
	}
	
	/** 정렬 조건 **/
	$order = '';
	if ($sort_value != null && $sort_type != null) {
		$order = $sort_value." ".$sort_type." ";
	} else {
		$order = ' IDX DESC ';
	}
	
	$total_cnt = $db->count($banner_table." BI",$cnt_where);
	$json_result = array(
		'total' => $db->count($banner_table." BI",$where),
		'total_cnt' => $total_cnt,
		'page' => intval($page)
	);

	$limit_start = (intval($page)-1)*$rows;

	$select_banner_sql = "
		SELECT
			BI.IDX				AS BANNER_IDX,
			BI.BANNER_TITLE		AS BANNER_TITLE,
			BI.BANNER_MEMO		AS BANNER_MEMO,
			REPLACE(
				BI.BANNER_THUMBNAIL,'/var/www/admin/www',''
			)					AS BANNER_THUMBNAIL,
			REPLACE(
				BI.BANNER_THUMBNAIL,'/var/www/admin/www',''
			)					AS BANNER_LOCATION,
			BI.CREATE_DATE		AS CREATE_DATE,
			BI.CREATER			AS CREATER,
			BI.UPDATE_DATE		AS UPDATE_DATE,
			BI.UPDATER			AS UPDATER
		FROM
			".$banner_table." BI
		WHERE
			".$where."
	";
	
	if ($rows != null) {
		$select_banner_sql .= " LIMIT ".$limit_start.",".$rows;
	}
	
	$db->query($select_banner_sql);

	foreach($db->fetch() as $data) {
		$json_result['data'][] = array(
			'num'				=>$total_cnt--,
			'banner_idx'		=>$data['BANNER_IDX'],
			'banner_title'		=>$data['BANNER_TITLE'],
			'banner_memo'		=>$data['BANNER_MEMO'],
			'banner_thumbnail'	=>$data['BANNER_THUMBNAIL'],
			'banner_location'	=>$data['BANNER_LOCATION'],
			'create_date'		=>$data['CREATE_DATE'],
			'creater'			=>$data['CREATER'],
			'update_date'		=>$data['UPDATE_DATE'],
			'updater'			=>$data['UPDATER'],
		);
	}
}
?>