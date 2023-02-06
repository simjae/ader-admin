<?php
/*
 +=============================================================================
 | 
 | 메뉴 관리 - 메뉴 정보 수정
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

$country		= $_POST['country'];
$menu_sort		= $_POST['menu_sort'];
$menu_idx		= $_POST['menu_idx'];

$menu_title		= xssEncode($_POST['menu_title']);
$menu_type		= $_POST['menu_type'];
$page_idx		= $_POST['page_idx'];

$menu_table = "";
switch ($menu_sort) {
	case "L" :
		$menu_table = "dev.TMP_MENU_LRG";
		break;
	
	case "M" :
		$menu_table = "dev.TMP_MENU_MDL";
		break;
	
	case "S" :
		$menu_table = "dev.TMP_MENU_SML";
		break;
}

$sql = "UPDATE
			".$menu_table."
		SET
			MENU_TITLE = '".$menu_title."',
			MENU_TYPE = '".$menu_type."',
			PAGE_IDX = ".$page_idx."
		WHERE
			COUNTRY = '".$country."' AND
			IDX = ".$menu_idx;

$db->query($sql);

function xssEncode($param){
    $param = str_replace("&","&amp;",$param);
    $param = str_replace("\"","&quot;",$param);
    $param = str_replace("'","&apos;",$param);
    $param = str_replace("<","&lt;",$param);
    $param = str_replace(">","&gt;",$param);
    $param = str_replace("\r","<br>",$param);
    $param = str_replace("\n","<p>",$param);

    return $param;
}
?>