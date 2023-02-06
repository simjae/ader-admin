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
			$menu_table = " dev.MENU_LRG ";
			break;
		
		case "M" :
			$menu_table = " dev.MENU_MDL ";
			break;
		
		case "S" :
			$menu_table = " dev.MENU_SML ";
			break;
	}
	
	$insert_keyword_sql = "
		INSERT INTO
			dev.RECOMMEND_KEYWORD
		(
			COUNTRY,
			DISPLAY_NUM,
			KEYWORD_TXT,
			MENU_SORT,
			MENU_IDX
		)
		SELECT
			'".$country."'		AS COUNTRY,
			(
				SELECT
					(MAX(DISPLAY_NUM) + 1)
				FROM
					dev.RECOMMEND_KEYWORD
				WHERE
					COUNTRY = '".$country."'
			)					AS DISPLAY_NUM,
			'".$keyword_txt."'	AS KEYWORD_TXT,
			'".$menu_sort."'	AS MENU_SORT,
			".$menu_idx."		AS MENU_IDX
		FROM
			DUAL
	";
	
	$db->query($insert_keyword_sql);
}
?>