<?php
/*
 +=============================================================================
 | 
 | 추천 검색어 등록
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2023.01.02
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$country		= $_POST['country'];
$keyword_txt	= $_POST['keyword_txt'];
$menu_sort		= $_POST['menu_sort'];
$menu_idx		= $_POST['menu_idx'];

if ($country != null && $menu_sort != null && $menu_idx != null) {
	$menu_table = "";
	switch ($menu_sort) {
		case "L" :
			$menu_table = " MENU_LRG ";
			break;
		
		case "M" :
			$menu_table = " MENU_MDL ";
			break;
		
		case "S" :
			$menu_table = " MENU_SML ";
			break;
	}
	
	$insert_recommend_keyword_sql = "
		INSERT INTO
			TMP_RECOMMEND_KEYWORD
		(
			COUNTRY,
			DISPLAY_NUM,
			KEYWORD_TXT,
			MENU_SORT,
			MENU_IDX
		) VALUES (
			'".$country."',
			1,
			'".$keyword_txt."',
			'".$menu_sort."',
			".$menu_idx."
		)
	";
	
	$db->query($insert_recommend_keyword_sql);
	
	$keyword_idx = $db->last_id();
	
	if (!empty($keyword_idx)) {
		$update_recommend_keyword_sql = "
			UPDATE
				TMP_RECOMMEND_KEYWORD
			SET
				DISPLAY_NUM = DISPLAY_NUM + 1
			WHERE
				IDX != ".$keyword_idx." AND
				COUNTRY = '".$country."'
		";
		
		$db->query($update_recommend_keyword_sql);
	}
}
?>