<?php
/*
 +=============================================================================
 | 
 | 랜딩페이지 관리 - 메인 배너 정보 복사
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2023.01.13
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

include_once("/var/www/admin/api/common/common.php");

$session_id				= sessionCheck();
$param_banner_idx		= $_POST['banner_idx'];

if ($param_banner_idx != null) {
	$copy_main_banner_sql = "
		INSERT INTO
			TMP_MAIN_BANNER
		(
			COUNTRY,
			DISPLAY_NUM,
			IMG_LOCATION,
			TITLE,
			SUB_TITLE,
			BACKGROUND_COLOR,
			BTN1_NAME,
			BTN1_URL,
			BTN1_DISPLAY_FLG,
			BTN2_NAME,
			BTN2_URL,
			BTN2_DISPLAY_FLG,
			CREATER,
			UPDATER
		)
		SELECT
			COUNTRY				AS COUNTRY,
			1					AS DISPLAY_NUM,
			IMG_LOCATION		AS IMG_LOCATION,
			TITLE				AS TITLE,
			SUB_TITLE			AS SUB_TITLE,
			BACKGROUND_COLOR	AS BACKGROUND_COLOR,
			BTN1_NAME			AS BTN1_NAME,
			BTN1_URL			AS BTN1_URL,
			BTN1_DISPLAY_FLG	AS BTN1_DISPLAY_FLG,
			BTN2_NAME			AS BTN2_NAME,
			BTN2_URL			AS BTN2_URL,
			BTN2_DISPLAY_FLG	AS BTN2_DISPLAY_FLG,
			'".$session_id."'	AS CREATER,
			'".$session_id."'	AS UPDATER
		FROM
			TMP_MAIN_BANNER
		WHERE
			IDX = ".$param_banner_idx."
	";
	
	$db->query($copy_main_banner_sql);
	
	$banner_idx = $db->last_id();
	
	if (!empty($banner_idx)) {
		$update_main_banner_sql = "
			UPDATE
				TMP_MAIN_BANNER
			SET
				DISPLAY_NUM = DISPLAY_NUM + 1
			WHERE
				IDX != ".$banner_idx."
		";
		
		$db->query($update_main_banner_sql);
	}
}

?>