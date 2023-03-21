<?php
/*
 +=============================================================================
 | 
 | 스토리 관리 화면 - 스토리 복사
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

$copy_type			= $_POST['copy_type'];
$country_from		= $_POST['country_from'];
$country_to			= $_POST['country_to'];

if ($copy_type != null && $country_from != null && $country_to != null) {
	if ($copy_type == "KEY") {
		$db->query("DELETE FROM TMP_RECOMMEND_KEYWORD WHERE COUNTRY = '".$country_to."'");
		
		$copy_recommend_keyword_sql = "
			INSERT INTO
				TMP_RECOMMEND_KEYWORD
			(
				COUNTRY,
				DISPLAY_NUM,
				KEYWORD_TXT
			)
			SELECT
				'".$country_to."'	AS COUNTRY,
				TK.DISPLAY_NUM		AS DISPLAY_NUM,
				TK.KEYWORD_TXT		AS KEYWORD_TXT
			FROM
				TMP_RECOMMEND_KEYWORD TK
			WHERE
				TK.COUNTRY = '".$country_from."'
			ORDER BY
				TK.DISPLAY_NUM ASC
		";
		
		$db->query($copy_recommend_keyword_sql);
	} else if ($copy_type == "PRD") {
		$db->query("DELETE FROM TMP_POPULAR_PRODUCT WHERE COUNTRY = '".$country_to."'");
		
		$copy_popular_product_sql = "
			INSERT INTO
				TMP_POPULAR_PRODUCT
			(
				COUNTRY,
				DISPLAY_NUM,
				PRODUCT_IDX
			)
			SELECT
				'".$country_to."',
				TP.DISPLAY_NUM,
				TP.PRODUCT_IDX
			FROM
				TMP_POPULAR_PRODUCT TP
			WHERE
				TP.COUNTRY = '".$country_from."'
		";
		
		$db->query($copy_popular_product_sql);
	}
}
?>