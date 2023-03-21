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

$menu_sort		= $_POST['menu_sort'];
$menu_idx		= $_POST['menu_idx'];

$menu_table = "";
switch ($menu_sort) {
	case "L":
		$menu_table = " MENU_LRG MI ";
		break;
	
	case "M":
		$menu_table = " MENU_MDL MI ";
		break;
	
	case "S":
		$menu_table = " MENU_SML MI ";
		break;
}

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
		MI.IDX = ".$menu_idx."
";

$db->query($select_menu_sql);

foreach($db->fetch() as $menu_data) {
	$menu_idx = $menu_data['MENU_IDX'];
	
	$json_result['data'][] = array(
		'menu_idx'		=>$menu_data['MENU_IDX'],
		'menu_title'	=>$menu_data['MENU_TITLE'],
		'menu_location'	=>$menu_data['MENU_LOCATION'],
		
		'link_url'		=>$menu_data['LINK_URL']
	);
}
?>