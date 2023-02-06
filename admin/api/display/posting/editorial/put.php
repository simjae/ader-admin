<?php
/*
 +=============================================================================
 | 
 | 에디토리얼 관리 화면 - 에디토리얼 썸네일 진열순서 변경
 | -----------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2023.01.27
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$action_type		= $_POST['action_type'];
$recent_idx			= $_POST['recent_idx'];
$recent_num			= $_POST['recent_num'];

if ($action_type != null && $recent_idx != null && $recent_num != null) {
	$prev_sql = "";
	$sql = "";
	
	switch ($action_type) {
		case "up" :
			$prev_sql = "
				UPDATE
					dev.EDITORIAL_THUMB
				SET
					DISPLAY_NUM = -1
				WHERE
					PAGE_IDX = ".$recent_idx."
				AND
					DISPLAY_NUM = ".$recent_num."
				AND
					DEL_FLG = FALSE
			";

			$sql = "
				UPDATE
					dev.EDITORIAL_THUMB
				SET
					DISPLAY_NUM = ".$recent_num."
				WHERE
					PAGE_IDX = ".$recent_idx."
				AND
					DISPLAY_NUM = ".intval($recent_num - 1)."
				AND
					DEL_FLG = FALSE
			";

			$next_sql = "
				UPDATE
					dev.EDITORIAL_THUMB
				SET
					DISPLAY_NUM = ".intval($recent_num - 1)."
				WHERE
					PAGE_IDX = ".$recent_idx."
				AND
					DISPLAY_NUM = -1
				AND
					DEL_FLG = FALSE
			";
			
			break;
		
		case "down" :
			$prev_sql = "
				UPDATE
					dev.EDITORIAL_THUMB
				SET
					DISPLAY_NUM = -1
				WHERE
					PAGE_IDX = ".$recent_idx."
				AND
					DISPLAY_NUM = ".$recent_num."
				AND
					DEL_FLG = FALSE
			";

			$sql = "
				UPDATE
					dev.EDITORIAL_THUMB
				SET
					DISPLAY_NUM = ".$recent_num."
				WHERE
					PAGE_IDX = ".$recent_idx."
				AND
					DISPLAY_NUM = ".intval($recent_num + 1)."
				AND
					DEL_FLG = FALSE
			";
			
			$next_sql = "
				UPDATE
					dev.EDITORIAL_THUMB
				SET
					DISPLAY_NUM = ".intval($recent_num + 1)."
				WHERE
					PAGE_IDX = ".$recent_idx."
				AND
					DISPLAY_NUM = -1
				AND
					DEL_FLG = FALSE
			";
			
			break;
	}
	
	if (strlen($prev_sql) > 0) {
		$db->query($prev_sql);
	}
	
	if (strlen($sql) > 0) {
		$db->query($sql);
	}

	if (strlen($next_sql) > 0) {
		$db->query($next_sql);
	}
}
?>