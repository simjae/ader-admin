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

$obj_update_flg		= $_POST['obj_update_flg'];
$obj_display_flg	= $_POST['obj_display_flg'];

$country			= $_POST['country'];
$menu_sort			= $_POST['menu_sort'];
$menu_idx			= $_POST['menu_idx'];
$obj_type			= $_POST['obj_type'];
$obj_idx			= $_POST['obj_idx'];
$link_type			= $_POST['link_type'];
$obj_title			= xssEncode($_POST['obj_title']);
$img_location 		= $_POST['img_location'];
$page_idx			= $_POST['page_idx'];

$action_type		= $_POST['action_type'];
$recent_idx			= $_POST['recent_idx'];
$recent_num			= $_POST['recent_num'];

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

if ($obj_display_flg != null && $obj_display_flg == true && $action_type != null) {
	$prev_sql = "";
	$sql = "";
	
	switch ($action_type) {
		case "up" :
			$prev_sql ="UPDATE
							".$obj_table."
						SET
							DISPLAY_NUM = ".$recent_num."
						WHERE
							COUNTRY = '".$country."' AND
							MENU_SORT = '".$menu_sort."' AND
							MENU_IDX = ".$menu_idx." AND
							DISPLAY_NUM = ".intval($recent_num - 1);
			
			$sql = "UPDATE
						".$obj_table."
					SET
						DISPLAY_NUM = ".intval($recent_num - 1)."
					WHERE
						IDX = ".$recent_idx;
			break;
		
		case "down" :
			$prev_sql ="UPDATE
							".$obj_table."
						SET
							DISPLAY_NUM = ".$recent_num."
						WHERE
							COUNTRY = '".$country."' AND
							MENU_SORT = '".$menu_sort."' AND
							MENU_IDX = ".$menu_idx." AND
							DISPLAY_NUM = ".intval($recent_num + 1);
			
			$sql = "UPDATE
						".$obj_table."
					SET
						DISPLAY_NUM = ".intval($recent_num + 1)."
					WHERE
						IDX = ".$recent_idx;
			break;
	}
	
	$db_result = 0;
	if (strlen($prev_sql) > 0) {
		$db->query($prev_sql);
		$prev_result = $db->affectedRows();
		if ($prev_result > 0) {
			$db_result++;
		}
	}
	
	if (strlen($sql) > 0) {
		$db->query($sql);
		$result = $db->affectedRows();
		if ($result > 0) {
			$db_result++;
		}
	}
	
	if ($db_result > 0) {
		$json_result['data'][] = returnObjInfo($db,$obj_table,$obj_type,$menu_sort,$menu_idx);
	}
}

if ($obj_update_flg != null && $obj_update_flg == true && $obj_idx != null) {
	$img_location_sql = "";
	if ($obj_type == "SL" || $obj_type == "UP") {
		$img_location_sql = " IMG_LOCATION = '".$img_location."', ";
	}

	$menu_obj_sql = "
		UPDATE
			".$obj_table."
		SET
			LINK_TYPE = '".$link_type."',
			OBJ_TITLE = '".$obj_title."',
			".$img_location_sql."
			PAGE_IDX = ".$page_idx."
		WHERE
			IDX = ".$obj_idx."
	";

	$db->query($menu_obj_sql);
	
	$result = $result = $db->affectedRows();
	
	if ($result > 0) {
		$json_result['data'][] = returnObjInfo($db,$obj_table,$obj_type,$menu_sort,$menu_idx);
	}
}

function returnObjInfo($db,$obj_table,$obj_type,$menu_sort,$menu_idx) {
	$img_location_sql = "";
	if ($obj_type == "SL" || $obj_type == "UP") {
		$img_location_sql = " ,MO.IMG_LOCATION ";
	}
		
	$select_obj_sql = "
		SELECT
			MO.IDX				AS OBJ_IDX,
			MO.OBJ_TITLE		AS OBJ_TITLE
			".$img_location_sql."
			,MO.DISPLAY_NUM		AS DISPLAY_NUM
		FROM
			".$obj_table." MO
		WHERE
			MO.MENU_SORT = '".$menu_sort."' AND
			MO.MENU_IDX = ".$menu_idx."
		ORDER BY
			MO.DISPLAY_NUM ASC
	";
	
	$db->query($select_obj_sql);
	
	$obj_info = array();
	foreach($db->fetch() as $data) {
		$obj_info[] = array(
			'obj_idx'		=>$data['OBJ_IDX'],
			'obj_title'		=>$data['OBJ_TITLE'],
			'img_location'	=>$data['IMG_LOCATION'],
			'display_num'	=>$data['DISPLAY_NUM']
		);
	}
	
	return $obj_info;
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