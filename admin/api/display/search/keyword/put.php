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

$display_num_flg	= $_POST['display_num_flg'];
$update_flg			= $_POST['update_flg'];

$country			= $_POST['country'];

$action_type		= $_POST['action_type'];
$recent_idx			= $_POST['recent_idx'];
$recent_num			= $_POST['recent_num'];

$keyword_idx		= $_POST['keyword_idx'];
$keyword_txt		= $_POST['keyword_txt'];
$menu_sort			= $_POST['menu_sort'];
$menu_idx			= $_POST['menu_idx'];

if ($display_num_flg != null && $country != null && $action_type != null) {
	$prev_sql = "";
	$sql = "";
	
	switch ($action_type) {
		case "up" :
			$prev_sql ="
				UPDATE
					TMP_RECOMMEND_KEYWORD
				SET
					DISPLAY_NUM = ".$recent_num."
				WHERE
					COUNTRY = '".$country."' AND
					DISPLAY_NUM = ".intval($recent_num - 1)."
			";
			
			$sql = "
				UPDATE
					TMP_RECOMMEND_KEYWORD
				SET
					DISPLAY_NUM = ".intval($recent_num - 1)."
				WHERE
					COUNTRY = '".$country."' AND
					IDX = ".$recent_idx."
			";
			
			break;
		
		case "down" :
			$prev_sql = "
				UPDATE
						TMP_RECOMMEND_KEYWORD
					SET
						DISPLAY_NUM = ".$recent_num."
					WHERE
						COUNTRY = '".$country."' AND
						DISPLAY_NUM = ".intval($recent_num + 1)."
			";
			
			$sql = "
				UPDATE
					TMP_RECOMMEND_KEYWORD
				SET
					DISPLAY_NUM = ".intval($recent_num + 1)."
				WHERE
					COUNTRY = '".$country."' AND
					IDX = ".$recent_idx."
			";
			
			break;
	}
	
	$db->query($prev_sql);
	$db->query($sql);
}

if ($update_flg != null && $keyword_idx != null) {
	$update_recommend_keyword_sql = "
		UPDATE
			TMP_RECOMMEND_KEYWORD
		SET
			KEYWORD_TXT = '".$keyword_txt."',
			MENU_SORT = '".$menu_sort."',
			MENU_IDX = ".$menu_idx."
		WHERE
			IDX = ".$keyword_idx;
	
	$db->query($update_recommend_keyword_sql);
}

?>