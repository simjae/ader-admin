<?php
/*
 +=============================================================================
 | 
 | 추천 검색어 수정
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.11.28
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$action_type	= $_POST['action_type'];
$recent_idx		= $_POST['recent_idx'];
$recent_num		= $_POST['recent_num'];

if ($action_type != null) {
	$prev_sql = "";
	$sql = "";
	
	switch ($action_type) {
		case "up" :
			$prev_sql ="UPDATE
							dev.POPULAR_PRODUCT
						SET
							DISPLAY_NUM = ".$recent_num."
						WHERE
							DISPLAY_NUM = ".intval($recent_num - 1);
			
			$sql = "UPDATE
						dev.POPULAR_PRODUCT
					SET
						DISPLAY_NUM = ".intval($recent_num - 1)."
					WHERE
						IDX = ".$recent_idx;
			
			break;
		
		case "down" :
			$prev_sql ="UPDATE
							dev.POPULAR_PRODUCT
						SET
							DISPLAY_NUM = ".$recent_num."
						WHERE
							DISPLAY_NUM = ".intval($recent_num + 1);
			
			$sql = "UPDATE
						dev.POPULAR_PRODUCT
					SET
						DISPLAY_NUM = ".intval($recent_num + 1)."
					WHERE
						IDX = ".$recent_idx;
			break;
	}
	
	$db->query($prev_sql);
	$db->query($sql);
}
?>