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
	case "L" :
		$menu_table = " dev.MENU_LRG MI";
		break;
	
	case "M" :
		$menu_table = " dev.MENU_MDL MI ";
		break;
	
	case "S" :
		$menu_table = " dev.MENU_SML MI ";
		break;
}

$where  = " MI.DEL_FLG = FALSE AND
			MI.IDX NOT IN (
				SELECT
					S_RK.MENU_IDX
				FROM
					dev.RECOMMEND_KEYWORD S_RK
				WHERE
					COUNTRY = '".$country."'
			) ";

$where_cnt = $where;

if ($country != null) {
	$where .= " AND (MI.COUNTRY = '".$country."') ";
}

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

$menu_link_sql = "";
if ($menu_sort == "L" || $menu_sort == "M") {
	$menu_link_sql = "
		CASE
			WHEN
				MI.MENU_TYPE = 'PR'
				THEN
					(
						SELECT
							CONCAT(
								S_PPR.PAGE_URL,
								'menu_sort=".$menu_sort."&menu_idx=',
								MI.IDX
							)
						FROM
							dev.PAGE_PRODUCT S_PPR
						WHERE
							S_PPR.IDX = MI.PAGE_IDX
					)
			WHEN
				MI.MENU_TYPE = 'PO'
				THEN
					(
						SELECT
							CONCAT(
								S_PPO.PAGE_URL,
								'menu_sort=".$menu_sort."&menu_idx=',
								MI.IDX
							)
						FROM
							dev.PAGE_POSTING S_PPO
						WHERE
							S_PPO.IDX = MI.PAGE_IDX
					)
		END					AS MENU_LINK
	";
} else if ($menu_sort == "S") {
	$menu_link_sql = "
		(
			SELECT
				CONCAT(
					S_PPR.PAGE_URL,
					'&menu_sort=".$menu_sort."&meu_idx=',
					MI.IDX
				)
			FROM
				dev.PAGE_PRODUCT S_PPR
			WHERE
				S_PPR.IDX = MI.PAGE_IDX
		)					AS MENU_LINK
	";
}

$select_menu_sql = "
	SELECT
		MI.IDX			AS MENU_IDX,
		MI.MENU_TYPE	AS MENU_TYPE,
		MI.MENU_TITLE	AS MENU_TITLE,
		".$menu_link_sql."
	FROM
		".$menu_table."
	WHERE
		".$where."
";

if ($rows != null && $select_idx_flg == null) {
	$select_menu_sql .= " LIMIT ".$limit_start.",".$rows;
}

$db->query($select_menu_sql);

foreach($db->fetch() as $data) {
	$menu_type_str = "";
	if ($data['MENU_TYPE'] == "PR") {
		$menu_type_str = "상품";
	} else if ($data['MENU_TYPE'] == "PO") {
		$menu_type_str = "게시물";
	}
	
	$json_result['data'][] = array(
		'menu_idx'		=>$data['MENU_IDX'],
		'menu_sort'		=>$menu_sort,
		'menu_type'		=>$data['MENU_TYPE'],
		'menu_title'	=>$data['MENU_TITLE'],
		'menu_link'		=>$data['MENU_LINK'],
	);
}
?>