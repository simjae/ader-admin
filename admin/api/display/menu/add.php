<?php
/*
 +=============================================================================
 | 
 | 메뉴 관리 - 메뉴 등록
 | -----------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.12.21
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

include_once("/var/www/admin/api/common/common.php");

$session_id		= sessionCheck();
$country		= $_POST['country'];
$menu_sort		= $_POST['menu_sort'];
$menu_idx		= $_POST['menu_idx'];

if ($menu_sort != null && $menu_idx != null) {
	$menu_table = "";
	$parent_idx = "";
	
	$select_menu_location_sql = "";
	switch ($menu_sort) {
		case "L":
			$menu_table = " TMP_MENU_MDL";
			$parent_idx = " MENU_LRG_IDX, ";
			
			$select_menu_location_sql = "
				SELECT
					CONCAT(
						ML.MENU_TITLE,
						' > ',
						'신규 메뉴'
						
					)		AS MENU_LOCATION
				FROM
					TMP_MENU_LRG ML
				WHERE
					ML.IDX = ".$menu_idx."
			";
			
			break;
		
		case "M":
			$menu_table = " TMP_MENU_SML ";
			$parent_idx = " MENU_MDL_IDX, ";
			
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
					TMP_MENU_MDL MM
					LEFT JOIN TMP_MENU_LRG ML ON
					MM.MENU_LRG_IDX = ML.IDX
				WHERE
					MM.IDX = ".$menu_idx."
			";
			
			break;
	}
	
	$db->query($select_menu_location_sql);
	
	$menu_location = "";
	foreach($db->fetch() as $menu_data) {
		$menu_location = $menu_data['MENU_LOCATION'];
	}
	
	$insert_menu_sql = "
		INSERT INTO
			".$menu_table."
		(
			COUNTRY,
			".$parent_idx."
			MENU_TITLE,
			MENU_LOCATION,
			CREATER,
			UPDATER
		) VALUES (
			'".$country."',
			".$menu_idx.",
			'신규 메뉴',
			'".$menu_location."',
			'".$session_id."',
			'".$session_id."'
		)
	";
	
	$db->query($insert_menu_sql);
}
?>