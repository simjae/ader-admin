<?php
/*
 +=============================================================================
 | 
 | 추천 검색어 관리 - 페이지 검색 모달_게시물/상품 페이지 리스트 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.12.05
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$country		= $_POST['country'];
$menu_sort		= $_POST['menu_sort'];
$menu_type		= $_POST['menu_type'];
$menu_title		= $_POST['menu_title'];

$sort_type 		= $_POST['sort_type'];				//정렬 타입
$sort_value 	= $_POST['sort_value'];				//정렬 값

$rows			= $_POST['rows'];
$page			= $_POST['page'];

$menu_table = "";
switch ($menu_sort) {
	case "L":
		$menu_table = " TMP_MENU_LRG MI ";
		break;
	
	case "M":
		$menu_table = " TMP_MENU_MDL MI ";
		break;
	
	case "S":
		$menu_table = " TMP_MENU_SML MI ";
		break;
}

$where  = "
	MI.COUNTRY = '".$country."' AND
	MI.DEL_FLG = FALSE
";

$where_cnt = $where;

if ($menu_type != null && $menu_type != "ALL") {
	$where .= " AND (MI.MENU_TYPE = '".$menu_type."') ";
}

if ($menu_title != null) {
	$where .= " AND (MI.MENU_TITLE = '".$menu_title."') ";
}

/** 정렬 조건 **/
$order = '';
if ($sort_value != null && $sort_type != null) {
	$order = ' MI.'.$sort_value." ".$sort_type." ";
} else {
	$order = ' MENU_IDX DESC';
}

$limit_start = (intval($page)-1)*$rows;

$json_result = array(
	'total' => $db->count($menu_table,$where),
	'total_cnt' => $db->count($menu_table,$where_cnt),
	'page' => $page
);

$select_menu_sql = "
	SELECT
		MI.IDX				AS MENU_IDX,
		MI.MENU_TITLE		AS MENU_TITLE,
		MI.MENU_LOCATION	AS MENU_LOCATION,
		
		MI.LINK_TYPE		AS LINK_TYPE,
		MI.LINK_URL			AS LINK_URL
	FROM
		".$menu_table."
	WHERE
		".$where."
";

if ($rows != null && $select_idx_flg == null) {
	$select_menu_sql .= " LIMIT ".$limit_start.",".$rows;
}

$db->query($select_menu_sql);

foreach($db->fetch() as $menu_data) {
	$menu_idx = $menu_data['MENU_IDX'];
	
	if ($menu_data['LINK_TYPE'] != "EC") {
		$menu_link = $menu_data['LINK_URL']."&menu_sort=".$menu_sort."&menu_idx=".$menu_idx;
	} else {
		$menu_link = "http://".$menu_data['LINK_URL'];
	}
	
	$select_menu_location_sql = "";
	switch ($menu_sort) {
		case "L":
			$menu_table = " TMP_MENU_LRG MI ";
			$select_menu_location_sql = "
				SELECT
					ML.MENU_TITLE		AS MENU_LOCATION
				FROM
					TMP_MENU_LRG ML
				WHERE
					ML.IDX = ".$menu_idx."
			";
			
			break;
		
		case "M":
			$menu_table = " TMP_MENU_MDL MI ";
			$select_menu_location_sql = "
				SELECT
					CONCAT(
						ML.MENU_TITLE,
						' > ',
						MM.MENU_TITLE
					)		AS MENU_LOCATION
				FROM
					TMP_MENU_MDL MM
					LEFT JOIN TMP_MENU_LRG ML ON
					MM.MENU_LRG_IDX = ML.IDX
				WHERE
					MM.IDX = ".$menu_idx."
			";
			
			break;
		
		case "S":
			$menu_table = " TMP_MENU_SML MI ";
			$select_menu_location_sql = "
				SELECT
					CONCAT(
						ML.MENU_TITLE,
						' > ',
						MM.MENU_TITLE,
						' > ',
						MS.MENU_TITLE
					)		AS MENU_LOCATION
				FROM
					TMP_MENU_MDL MM
					LEFT JOIN TMP_MENU_LRG ML ON
					MM.MENU_LRG_IDX = ML.IDX
					LEFT JOIN TMP_MENU_SML MS ON
					MM.IDX = MS.MENU_MDL_IDX
				WHERE
					MS.IDX = ".$menu_idx."
			";
			break;
	}
	
	$db->query($select_menu_location_sql);
	
	$menu_location = "";
	foreach($db->fetch() as $location_data) {
		$menu_location = $location_data['MENU_LOCATION'];
	}
	
	$json_result['data'][] = array(
		'menu_idx'		=>$menu_data['MENU_IDX'],
		'menu_sort'		=>$menu_sort,
		'menu_title'	=>$menu_data['MENU_TITLE'],
		'menu_location'	=>$menu_location,
		
		'link_url'		=>$menu_link,
	);
}
?>