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
$link_url		= $_POST['link_url'];
$link_type		= $_POST['link_type'];
$link_idx		= $_POST['link_idx'];

$menu_table = "";
$menu_location = "";
$select_menu_location_sql = "";

switch ($menu_sort) {
	case "L" :
		$menu_table = "TMP_MENU_LRG";
		$menu_location = $menu_title;
		
		break;
	
	case "M" :
		$menu_table = "TMP_MENU_MDL";
		
		$select_menu_location_sql = "
			SELECT
				CONCAT(
					ML.MENU_TITLE,
					' > ',
					'".$menu_title."'
				)		AS MENU_LOCATION
			FROM
				TMP_MENU_MDL MM
				LEFT JOIN TMP_MENU_LRG ML ON
				MM.MENU_LRG_IDX = ML.IDX
			WHERE
				MM.IDX = ".$menu_idx."
		";
		
		break;
	
	case "S" :
		$menu_table = "TMP_MENU_SML";
		$select_menu_location_sql = "
			SELECT
				CONCAT(
					ML.MENU_TITLE,
					' > ',
					MM.MENU_TITLE,
					' > ',
					'".$menu_title."'
				)		AS MENU_LOCATION
			FROM
				TMP_MENU_SML MS
				LEFT JOIN TMP_MENU_MDL MM ON
				MS.MENU_MDL_IDX = MM.IDX
				LEFT JOIN TMP_MENU_LRG ML ON
				MM.MENU_LRG_IDX = ML.IDX
			WHERE
				MS.IDX = ".$menu_idx."
		";
		
		break;
}

if (strlen($select_menu_location_sql) > 0) {
	$db->query($select_menu_location_sql);
	
	foreach($db->fetch() as $menu_data) {
		$menu_location = $menu_data['MENU_LOCATION'];
	}
}

$update_menu_sql = "
	UPDATE
		".$menu_table."
	SET
		MENU_TITLE = '".$menu_title."',
		MENU_LOCATION = '".$menu_location."',
		LINK_TYPE = '".$link_type."',
		LINK_IDX = ".$link_idx.",
		LINK_URL = '".$link_url."'
	WHERE
		COUNTRY = '".$country."' AND
		IDX = ".$menu_idx."
";

$db->query($update_menu_sql);

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