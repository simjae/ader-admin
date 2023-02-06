<?php
/*
 +=============================================================================
 | 
 | 메뉴 관리 - 메뉴 obj 정보 등록
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.12.27
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$country		= $_POST['country'];
$obj_type		= $_POST['obj_type'];
$menu_sort		= $_POST['menu_sort'];
$menu_idx		= $_POST['menu_idx'];

$obj_title		= xssEncode($_POST['obj_title']);
$link_type		= $_POST['link_type'];
$img_location	= $_POST['img_location'];
$page_idx		= $_POST['page_idx'];

$obj_table = "";
switch ($obj_type) {
	case "SL" :
		$obj_table = " dev.TMP_MENU_SLIDE ";
		break;
	
	case "UP" :
		$obj_table = " dev.TMP_MENU_UPPER_FILTER ";
		break;
	
	case "LW" :
		$obj_table = " dev.TMP_MENU_LOWER_FILTER ";
		break;
}

if ($country != null && $menu_sort != null && $menu_idx != null) {
	$img_location_arr = array();
	$img_location_sql = "";
	if ($obj_type = "SL" || $obj_type = "UP") {
		$img_location_arr[0] = " IMG_LOCATION, ";
		$img_location_arr[1] = " '".$img_location."', ";
		
		$img_location_sql = " MO.IMG_LOCATION	AS IMG_LOCATION, ";
	}
	$insert_obj_sql = "
		INSERT INTO
			".$obj_table."
		(
			COUNTRY,
			MENU_SORT,
			MENU_IDX,
			LINK_TYPE,
			OBJ_TITLE,
			".$img_location_arr[0]."
			DISPLAY_NUM,
			PAGE_IDX
		) VALUES (
			'".$country."',
			'".$menu_sort."',
			".$menu_idx.",
			'".$link_type."',
			'".$obj_title."',
			".$img_location_arr[1]."
			1,
			".$page_idx."
		)
	";
	
	$db->query($insert_obj_sql);
	
	$obj_idx = $db->last_id();
	
	if (!empty($obj_idx)) {
		$update_obj_sql = "
			UPDATE
				".$obj_table."
			SET
				DISPLAY_NUM = DISPLAY_NUM + 1
			WHERE
				COUNTRY = '".$country."' AND
				MENU_SORT = '".$menu_sort."' AND 
				MENU_IDX = ".$menu_idx." AND
				IDX != ".$obj_idx."
		";
		
		$db->query($update_obj_sql);
		
		$result = $db->affectedRows();
		
		if ($result > 0) {
			$select_obj_sql = "
				SELECT
					MO.IDX				AS OBJ_IDX,
					MO.OBJ_TITLE		AS OBJ_TITLE,
					".$img_location_sql."
					MO.DISPLAY_NUM		AS DISPLAY_NUM
				FROM
					".$obj_table." MO
				WHERE
					MO.COUNTRY = '".$country."' AND
					MO.MENU_IDX = ".$menu_idx."
				ORDER BY
					MO.DISPLAY_NUM ASC
			";
			
			$db->query($select_obj_sql);
			
			foreach($db->fetch() as $obj_data) {
				$json_result['data'][] = array(
					'obj_idx'		=>$obj_data['OBJ_IDX'],
					'obj_title'		=>$obj_data['OBJ_TITLE'],
					'img_location'	=>$obj_data['IMG_LOCATION'],
					'display_num'	=>$obj_data['DISPLAY_NUM']
				);
			}
		}
	}
}

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