<?php
/*
 +=============================================================================
 | 
 | 전시정보 조회 - 게시물 스토리 모달_선택한 게시물 정보 조회
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

$menu_sort			= $_POST['menu_sort'];
$menu_idx			= $_POST['menu_idx'];

if ($menu_sort != null && $menu_idx != null) {
	$menu_table = "";
	$select_menu_location_sql = "";
	
	switch ($menu_sort) {
		case "L":
			$menu_table = " MENU_LRG ";
			$select_menu_location_sql = "
				SELECT
					CONCAT(
						ML.MENU_TITLE,
						' > ',
						'신규 메뉴'
						
					)		AS MENU_LOCATION
				FROM
					MENU_LRG ML
				WHERE
					ML.IDX = ".$menu_idx."
			";
			
			break;
		
		case "M":
			$menu_table = " MENU_MDL ";
			$select_menu_location_sql = "
				SELECT
					CONCAT(
						ML.MENU_TITLE,
						' > ',
						MM.MENU_TITLE,
						' > ',
						'신규 메뉴'
					)		AS MENU_LOCATION
				FROM
					MENU_MDL MM
					LEFT JOIN MENU_LRG ML ON
					MM.MENU_LRG_IDX = ML.IDX
				WHERE
					MM.IDX = ".$menu_idx."
			";
			
			break;
		
		case "S":
			$menu_table = " MENU_SML ";
			
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
					MENU_SML MS
					LEFT JOIN MENU_MDL MM ON
					MM.IDX = MS.MENU_MDL_IDX
					LEFT JOIN MENU_LRG ML ON
					ML.IDX = MM.MENU_LRG_IDX
				WHERE
					MS.IDX = ".$menu_idx."
			";
			break;
	}
	
	$db->query($select_menu_location_sql);
	
	$menu_location = "";
	foreach($db->fetch() as $menu_data) {
		$menu_location = $menu_data['MENU_LOCATION'];
	}
	
	$select_menu_sql = "
		SELECT
			MI.IDX				AS MENU_IDX,
			MI.MENU_TITLE		AS MENU_TITLE,
			MI.MENU_LOCATION	AS MENU_LOCATION,
			
			MI.LINK_TYPE		AS LINK_TYPE,
			MI.LINK_URL			AS LINK_URL
		FROM
			".$menu_table." MI
		WHERE
			MI.COUNTRY = '".$country."' AND
			MI.IDX = ".$menu_idx."
	";
	
	$db->query($select_menu_sql);

	foreach($db->fetch() as $menu_data) {
		$menu_link = "";
		if ($menu_data['LINK_TYPE'] != "EC") {
			$menu_link = $menu_data['LINK_URL']."&menu_sort=".$menu_sort."&menu_idx=".$menu_data['MENU_IDX'];
		} else {
			$menu_link = "http://".$menu_data['LINK_URL'];
		}
		
		$json_result['data'][] = array(
			'menu_idx'			=>$menu_data['MENU_IDX'],
			'menu_sort'			=>$menu_sort,
			'menu_title'		=>$menu_data['MENU_TITLE'],
			'menu_location'		=>$menu_location,
			
			'menu_link'			=>$menu_link
		);
	}
}
?>