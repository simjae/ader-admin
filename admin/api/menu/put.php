<?php
/*
 +=============================================================================
 | 
 | 전시관리 게시물 수정 API
 | -------
 |
 | 최초 작성	: 심재형
 | 최초 작성일	: 2022.09.06
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$tmp_flg				= $_POST['tmp_flg'];
$table_type 			= $_POST['table_type'];
$menu_idx 				= $_POST['menu_idx'];
$menu_title 			= $_POST['menu_title'];
$menu_url 				= $_POST['menu_url'];
$menu_type 				= $_POST['menu_type'];

$tbl_menu = array();
if ($tmp_flg == "true") {
	$tbl_menu[0] = "dev.TMP_MENU_LRG";
	$tbl_menu[1] = "dev.TMP_MENU_MDL";
	$tbl_menu[2] = "dev.TMP_MENU_SML";
} else {
	$tbl_menu[0] = "dev.MENU_LRG";
	$tbl_menu[1] = "dev.MENU_MDL";
	$tbl_menu[2] = "dev.MENU_SML";
}

$table = "";
if ($table_type != null) {
	switch ($table_type) {
		case "LRG" :
			$table = $tbl_menu[0];
			break;
		case "MDL" :
			$table = $tbl_menu[1];
			break;
		case "SML" :
			$table = $tbl_menu[2];
			break;
	}
}

if ($table_type != null && $menu_idx != null) {
	if ($table_type == "SML") {
		$setSql = " MENU_".$table_type."_TITLE = '".$menu_title."',
					MENU_".$table_type."_URL ='".$menu_url."' ";
			
	} else {
		$setSql = " MENU_".$table_type."_TITLE = '".$menu_title."' ,
					MENU_".$table_type."_URL = '".$menu_url."' ,
					MENU_".$table_type."_TYPE = '".$menu_type."' "; 
	}

	$sql  = "UPDATE ".$table." 
			SET 
				".$setSql."	
			WHERE 
				IDX ='".$menu_idx."'";
	$db->query($sql);
} 
?>