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

$country		= $_POST['country'];
$menu_sort		= $_POST['menu_sort'];
$menu_idx		= $_POST['menu_idx'];
$menu_type		= $_POST['menu_type'];

if ($menu_sort != null && $menu_idx != null) {
	$menu_table = "";
	$parent_idx = "";
	switch ($menu_sort) {
		case "L":
			$menu_table = " dev.TMP_MENU_MDL";
			$parent_idx = " MENU_LRG_IDX, ";
			break;
		
		case "M":
			$menu_table = " dev.TMP_MENU_SML ";
			$parent_idx = " MENU_MDL_IDX, ";
			break;
	}
	
	$sql = "INSERT INTO
				".$menu_table."
			(
				COUNTRY,
				".$parent_idx."
				MENU_TITLE,
				MENU_TYPE,
				PAGE_IDX,
				CREATER,
				UPDATER
			) VALUES (
				'".$country."',
				".$menu_idx.",
				'신규 메뉴',
				'".$menu_type."',
				0,
				'Admin',
				'Admin'
			)";
	
	$db->query($sql);
}
?>