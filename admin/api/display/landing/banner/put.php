<?php
/*
 +=============================================================================
 | 
 | 랜딩페이지 관리 - 메인_배너 정보 수정
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

$main_banner		= $_FILES['main_banner'];

$display_num_flg	= $_POST['display_num_flg'];
$update_flg			= $_POST['update_flg'];

$country			= $_POST['country'];
$action_type		= $_POST['action_type'];
$recent_idx			= $_POST['recent_idx'];
$recent_num			= $_POST['recent_num'];

$banner_idx			= $_POST['banner_idx'];
$img_location		= $_POST['img_location'];
$title				= $_POST['title'];
$sub_title			= $_POST['sub_title'];
$background_color	= $_POST['background_color'];
$btn1_name			= $_POST['btn1_name'];
$btn1_url			= $_POST['btn1_url'];
$btn1_display_flg	= $_POST['btn1_display_flg'];
$btn2_name			= $_POST['btn2_name'];
$btn2_url			= $_POST['btn2_url'];
$btn2_display_flg	= $_POST['btn2_display_flg'];

if ($display_num_flg != null && $action_type != null) {
	$prev_sql = "";
	$sql = "";
	
	switch ($action_type) {
		case "up" :
			$prev_sql = "
				UPDATE
					TMP_MAIN_BANNER
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
					TMP_MAIN_BANNER
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
					TMP_MAIN_BANNER
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
					TMP_MAIN_BANNER
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

if ($update_flg != null && $banner_idx != null) {
	$update_banner_sql = "
		UPDATE
			TMP_MAIN_BANNER
		SET
			IMG_LOCATION = '/var/www/admin/www".$img_location."',
			TITLE = '".$title."',
			SUB_TITLE = '".$sub_title."',
			BACKGROUND_COLOR = '".$background_color."',
			BTN1_NAME = '".$btn1_name."',
			BTN1_URL = '".$btn1_url."',
			BTN1_DISPLAY_FLG = ".$btn1_display_flg.",
			BTN2_NAME = '".$btn2_name."',
			BTN2_URL = '".$btn2_url."',
			BTN2_DISPLAY_FLG = ".$btn2_display_flg.",
			UPDATE_DATE = NOW(),
			UPDATER = '".$session_id."'
		WHERE
			IDX = ".$banner_idx."
	";
	
	$db->query($update_banner_sql);
}

?>