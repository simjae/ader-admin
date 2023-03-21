<?php
/*
 +=============================================================================
 | 
 | 스토리 관리 화면 - 스토리 저장
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

$save_type			= $_POST['save_type'];
$country			= $_POST['country'];

if ($save_type != null && $country != null) {
	if ($save_type == "KEY") {
		$db->query("DELETE FROM RECOMMEND_KEYWORD WHERE COUNTRY = '".$country."'");
		
		$insert_recommend_keyword_sql = "
			INSERT INTO
				RECOMMEND_KEYWORD
			(
				COUNTRY,
				DISPLAY_NUM,
				KEYWORD_TXT,
				MENU_SORT,
				MENU_IDX
			)
			SELECT
				TK.COUNTRY			AS COUNTRY,
				TK.DISPLAY_NUM		AS DISPLAY_NUM,
				TK.KEYWORD_TXT		AS KEYWORD_TXT,
				TK.MENU_SORT		AS MENU_SORT,
				TK.MENU_IDX			AS MENU_IDX
			FROM
				TMP_RECOMMEND_KEYWORD TK
			WHERE
				TK.COUNTRY = '".$country."'
			ORDER BY
				TK.DISPLAY_NUM ASC
		";
		
		$db->query($insert_recommend_keyword_sql);
	} else if ($save_type == "PRD") {
		$db->query("DELETE FROM POPULAR_PRODUCT WHERE COUNTRY = '".$country."'");
		
		$insert_popular_product_sql = "
			INSERT INTO
				POPULAR_PRODUCT
			(
				COUNTRY,
				DISPLAY_NUM,
				PRODUCT_IDX
			)
			SELECT
				TP.COUNTRY,
				TP.DISPLAY_NUM,
				TP.PRODUCT_IDX
			FROM
				TMP_POPULAR_PRODUCT TP
			WHERE
				TP.COUNTRY = '".$country."'
		";
		
		$db->query($insert_popular_product_sql);
	}
}
?>