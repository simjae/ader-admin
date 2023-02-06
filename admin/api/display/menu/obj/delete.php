<?php
/*
 +=============================================================================
 | 
 | 메뉴 관리 - 메뉴 obj 정보 삭제
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.12.22
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$menu_sort	= $_POST['menu_sort'];
$menu_idx	= $_POST['menu_idx'];
$obj_type	= $_POST['obj_type'];
$obj_idx	= $_POST['obj_idx'];

if ($menu_sort != null && $menu_idx != null && $obj_idx != null) {
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

	$delete_obj_sql = "
		DELETE FROM
			".$obj_table."
		WHERE
			IDX = ".$obj_idx."
	";
	
	$db->query($delete_obj_sql);
	
	$result = $db->affectedRows();
	
	if ($result > 0) {
		$tmp_sql = "
			SELECT
				IDX
			FROM
				".$obj_table."
			WHERE
				MENU_SORT = '".$menu_sort."' AND
				MENU_IDX = ".$menu_idx."
			ORDER BY
				DISPLAY_NUM ASC
		";
		
		$db->query($tmp_sql);
		
		$tmp_obj = array();
		foreach($db->fetch() as $tmp_data) {
			$tmp_obj[] = array(
				'idx'	=>$tmp_data['IDX']
			);
		}
		
		$cnt = count($tmp_obj);
		for ($i=0; $i<$cnt; $i++) {
			$update_obj_sql = "
				UPDATE
					".$obj_table."
				SET
					DISPLAY_NUM = ".($i+1)."
				WHERE
					IDX = ".$tmp_obj[$i]['idx']."
			";
			
			$db->query($update_obj_sql);
		}
		
		$img_location_sql = "";
		if ($obj_type == "SL" || $obj_type == "UP") {
			$img_location_sql = " ,MO.IMG_LOCATION ";
		}
		
		$select_obj_sql = "
			SELECT
				MO.IDX				AS OBJ_IDX,
				MO.OBJ_TITLE		AS OBJ_TITLE
				".$img_location_sql."
			FROM
				".$obj_table." MO
			WHERE
				MO.MENU_SORT = '".$menu_sort."' AND
				MO.MENU_IDX = ".$menu_idx."
			ORDER BY
				MO.DISPLAY_NUM ASC
		";
		
		$db->query($select_obj_sql);
		
		foreach($db->fetch() as $data) {
			$json_result['data'][] = array(
				'obj_idx'		=>$data['OBJ_IDX'],
				'obj_title'		=>$data['OBJ_TITLE'],
				'img_location'	=>$data['IMG_LOCATION']
			);
		}
	}
}

?>