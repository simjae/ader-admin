<?php
/*
 +=============================================================================
 | 
 | 랜딩페이지 관리 - 메인 배너 정보 수정
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

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

include_once("/var/www/admin/api/common/common.php");

$session_id			= sessionCheck();

$main_img			= $_FILES['main_img'];

$display_num_flg	= $_POST['display_num_flg'];

$country			= $_POST['country'];
$action_type		= $_POST['action_type'];
$recent_idx			= $_POST['recent_idx'];
$recent_num			= $_POST['recent_num'];

$img_idx			= $_POST['img_idx'];
$title				= $_POST['title'];
$sub_title			= $_POST['sub_title'];
$btn_name			= $_POST['btn_name'];
$btn_url			= $_POST['btn_url'];
$btn_display_flg	= $_POST['btn_display_flg'];

if ($display_num_flg != null && $action_type != null) {
	$prev_sql = "";
	$sql = "";
	
	switch ($action_type) {
		case "up" :
			$prev_sql = "
				UPDATE
					TMP_MAIN_IMG
				SET
					DISPLAY_NUM = ".$recent_num.",
					UPDATE_DATE = NOW(),
					UPDATER = '".$session_id."'
				WHERE
					COUNTRY = '".$country."' AND
					DISPLAY_NUM = ".intval($recent_num - 1)." AND
					DEL_FLG = FALSE
			";
			
			$sql = "
				UPDATE
					TMP_MAIN_IMG
				SET
					DISPLAY_NUM = ".intval($recent_num - 1).",
					UPDATE_DATE = NOW(),
					UPDATER = '".$session_id."'
				WHERE
					IDX = ".$recent_idx." AND 
					COUNTRY = '".$country."' AND
					DEL_FLG = FALSE
			";
			
			break;
		
		case "down" :
			$prev_sql = "
				UPDATE
					TMP_MAIN_IMG
				SET
					DISPLAY_NUM = ".$recent_num.",
					UPDATE_DATE = NOW(),
					UPDATER = '".$session_id."'
				WHERE
					COUNTRY = '".$country."' AND
					DISPLAY_NUM = ".intval($recent_num + 1)." AND
					DEL_FLG = FALSE
			";
			
			$sql = "
				UPDATE
					TMP_MAIN_IMG
				SET
					DISPLAY_NUM = ".intval($recent_num + 1).",
					UPDATE_DATE = NOW(),
					UPDATER = '".$session_id."'
				WHERE
					IDX = ".$recent_idx." AND
					COUNTRY = '".$country."' AND
					DEL_FLG = FALSE
			";
			
			break;
	}
		
	if (strlen($prev_sql) > 0) {
		$db->query($prev_sql);
	}
	
	if (strlen($sql) > 0) {
		$db->query($sql);
	}
}

if ($update_flg != null && $img_idx != null) {
	$update_img_sql = "
		UPDATE
			TMP_MAIN_IMG
		SET
			IMG_LOCATION = '/var/www/admin/www".$img_location."',
			TITLE = '".$title."',
			BTN_NAME = '".$btn_name."',
			BTN_URL = '".$btn_url."',
			BTN_DISPLAY_FLG = ".$btn_display_flg.",
			UPDATE_DATE = NOW(),
			UPDATER = '".$session_id."'
		WHERE
			IDX = ".$img_idx."
	";
	
	$db->query($update_img_sql);
}

?>