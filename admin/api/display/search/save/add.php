<?php
/*
 +=============================================================================
 | 
 | 검색 관리 화면 - 추천 검색어/실시간 인기 상품  저장
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

if ($country != null) {
	$db->query("DELETE FROM dev.RECOMMEND_KEYWORD WHERE COUNTRY = '".$country."'");
	
	$db_result_keyword = $db->affectedRows();
	
	if ($db_result > 0) {
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
				TR.COUNTRY			AS COUNTRY,
				TR.DISPLAY_NUM		AS DISPLAY_NUM,
				TR.KEYWORD_TXT		AS KEYWORD_TXT,
				TR.MENU_SORT		AS MENU_SORT,
				TR.MENU_IDX			AS MENU_IDX
			FROM
				dev.TMP_RECOMMEND_KEYWOD TR
			WHERE
				TR.COUNTRY = '".$country."'
			ORDER BY
				TR.DISPLAY_NUM ASC
		";
	}
	
	$db->query("DELETE FROM dev.POPULAR_PRODUCT WHERE COUNTRY = '".$country."'");
	
	$db_result_product = $db->affectedRows();
	
	if ($db_result_product > 0) {
		$insert_product_sql = "
			INSERT INTO
				dev.POPULAR_PRODUCT
			(
				COUNTRY,
				DISPLAY_NUM,
				PRODUCT_IDX
			)
			SELECT
				TP.COUNTRY		AS COUNTRY,
				TP.DISPLAY_NUM	AS DISPLAY_NUM,
				TP.PRODUCT_IDX	AS PRODUCT_IDX
			FROM
				dev.TMP_POPULAR_PRODUCT TP
			WHERE
				TP.COUNTRY = '".$country."'
			ORDER BY
				DISPLAY_NUM ASC
		";
		
		$db->query($insert_product_sql);
	}
}
?>