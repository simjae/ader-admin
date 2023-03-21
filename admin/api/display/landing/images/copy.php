<?php
/*
 +=============================================================================
 | 
 | 랜딩페이지 관리 - 메인 이미지 정보 복사
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
$param_img_idx			= $_POST['img_idx'];

if ($param_img_idx != null) {
	$copy_main_img_sql = "
		INSERT INTO
			TMP_MAIN_IMG
		(
			COUNTRY,
			DISPLAY_NUM,
			IMG_LOCATION,
			TITLE,
			BTN_NAME,
			BTN_URL,
			BTN_DISPLAY_FLG,
			CREATER,
			UPDATER
		)
		SELECT
			COUNTRY				AS COUNTRY,
			1					AS DISPLAY_NUM,
			IMG_LOCATION		AS IMG_LOCATION,
			TITLE				AS TITLE,
			BTN_NAME			AS BTN_NAME,
			BTN_URL				AS BTN_URL,
			BTN_DISPLAY_FLG		AS BTN_DISPLAY_FLG,
			'".$session_id."'	AS CREATER,
			'".$session_id."'	AS UPDATER
		FROM
			TMP_MAIN_IMG
		WHERE
			IDX = ".$param_img_idx."
	";
	
	$db->query($copy_main_img_sql);
	
	$img_idx = $db->last_id();
	
	if (!empty($img_idx)) {
		$update_main_img_sql = "
			UPDATE
				TMP_MAIN_IMG
			SET
				DISPLAY_NUM = DISPLAY_NUM + 1
			WHERE
				IDX != ".$img_idx."
		";
		
		$db->query($update_main_img_sql);
	}
}

?>