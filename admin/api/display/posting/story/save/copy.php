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

$country_from		= $_POST['country_from'];
$country_to			= $_POST['country_to'];

if ($country_from != null && $country_to != null) {
	$db->query("DELETE FROM TMP_POSTING_STORY WHERE COUNTRY = '".$country_to."'");
	
	$copy_posting_story_sql = "
		INSERT INTO
			TMP_POSTING_STORY
		(
			COUNTRY,
			STORY_TYPE,
			PAGE_IDX,
			DISPLAY_NUM,
			IMG_LOCATION,
			STORY_TITLE,
			STORY_SUB_TITLE,
			STORY_MEMO,
			
			CREATER,
			UPDATER
		)
		SELECT
			'".$country_to."'	AS COUNTRY,
			TP.STORY_TYPE		AS STORY_TYPE,
			TP.PAGE_IDX			AS PAGE_IDX,
			TP.DISPLAY_NUM		AS DISPLAY_NUM,
			TP.IMG_LOCATION		AS IMG_LOCATION,
			TP.STORY_TITLE		AS STORY_TITLE,
			TP.STORY_SUB_TITLE	AS STORY_SUB_TITLE,
			TP.STORY_MEMO		AS STORY_MEMO,
			
			TP.CREATER			AS CREATER,
			TP.UPDATER			AS UPDATER
		FROM
			TMP_POSTING_STORY TP
		WHERE
			TP.COUNTRY = '".$country_from."' AND
			TP.DEL_FLG = FALSE
		ORDER BY
			TP.STORY_TYPE,
			TP.DISPLAY_NUM
			ASC
	";
	
	$db->query($copy_posting_story_sql);
}
?>