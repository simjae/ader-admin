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

$country		= $_POST['country'];

if ($country != null) {
	$db->query("DELETE FROM dev.POSTING_STORY WHERE COUNTRY = '".$country."'");
	
	$db_result = $db->affectedRows();
	
	if ($db_result > 0) {
		$insert_story_sql = "
			INSERT INTO
				dev.POSTING_STORY
			(
				COUNTRY,
				STORY_COLUMN,
				DISPLAY_NUM,
				IMG_LOCATION,
				STORY_TITLE,
				STORY_SUB_TITLE,
				STORY_MEMO,
				PAGE_IDX,
				ACTIVE_FLG,
				CREATER,
				UPDATER
			)
			SELECT
				TP.COUNTRY			AS COUNTRY,
				TP.STORY_COLUMN		AS STORY_COLUMN,
				TP.DISPLAY_NUM		AS DISPLAY_NUM,
				TP.IMG_LOCATION		AS IMG_LOCATION,
				TP.STORY_TITLE		AS STORY_TITLE,
				TP.STORY_SUB_TITLE	AS STORY_SUB_TITLE,
				TP.STORY_MEMO		AS STORY_MEMO,
				TP.PAGE_IDX			AS PAGE_IDX,
				TP.ACTIVE_FLG		AS ACTIVE_FLG,
				TP.CREATER			AS CREATER,
				TP.UPDATER			AS UPDATER
			FROM
				dev.TMP_POSTING_STORY TP
			WHERE
				TP.COUNTRY = '".$country."'
			ORDER BY
				TP.STORY_COLUMN ASC,
				TP.DISPLAY_NUM ASC
		";
		
		$db->query($insert_story_sql);
	}
}
?>