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

$country		= $_POST['country'];

$action_type	= $_POST['action_type'];
$recent_idx		= $_POST['recent_idx'];
$recent_num		= $_POST['recent_num'];

$keyword_idx	= $_POST['keyword_idx'];
$keyword_txt	= $_POST['keyword_txt'];
$menu_sort		= $_POST['menu_sort'];
$menu_idx		= $_POST['menu_idx'];

if ($country != null && $action_type != null) {
	$prev_sql = "";
	$sql = "";
	
	switch ($action_type) {
		case "up" :
			$prev_sql ="UPDATE
							dev.RECOMMEND_KEYWORD
						SET
							DISPLAY_NUM = ".$recent_num."
						WHERE
							COUNTRY = '".$country."' AND
							DISPLAY_NUM = ".intval($recent_num - 1);
			
			$sql = "UPDATE
						dev.RECOMMEND_KEYWORD
					SET
						DISPLAY_NUM = ".intval($recent_num - 1)."
					WHERE
						COUNTRY = '".$country."' AND
						IDX = ".$recent_idx;
			
			break;
		
		case "down" :
			$prev_sql ="UPDATE
							dev.RECOMMEND_KEYWORD
						SET
							DISPLAY_NUM = ".$recent_num."
						WHERE
							COUNTRY = '".$country."' AND
							DISPLAY_NUM = ".intval($recent_num + 1);
			
			$sql = "UPDATE
						dev.RECOMMEND_KEYWORD
					SET
						DISPLAY_NUM = ".intval($recent_num + 1)."
					WHERE
						COUNTRY = '".$country."' AND
						IDX = ".$recent_idx;
			break;
	}
	
	$db->query($prev_sql);
	$db->query($sql);
}

if ($keyword_idx != null) {
	$sql = "UPDATE
				dev.RECOMMEND_KEYWORD
			SET
				'".$keyword_txt."',
				'".$menu_sort."',
				".$menu_idx."
			WHERE
				IDX = ".$keyword_idx;

	$db->query($sql);
}
?>