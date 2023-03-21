<?php
/*
 +=============================================================================
 | 
 | 메뉴 관리 - 메뉴 개별 삭제
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.12.21
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$country	= $_POST['country'];
$menu_sort	= $_POST['menu_sort'];
$menu_idx	= $_POST['menu_idx'];

if ($country != null && $menu_sort != null && $menu_idx != null) {
	$menu_table = "";
	switch ($menu_sort) {
		case "L" :
			$menu_table = " TMP_MENU_LRG ";
			break;
		
		case "M" :
			$menu_table = " TMP_MENU_MDL ";
			break;
		
		case "S" :
			$menu_table = " TMP_MENU_SML ";
			break;
	}

	$delete_menu_sql = "
		UPDATE
			".$menu_table."
		SET
			DEL_FLG = TRUE
		WHERE
			COUNTRY = '".$country."' AND
			IDX = ".$menu_idx;

	$db->query($delete_menu_sql);
}

?>