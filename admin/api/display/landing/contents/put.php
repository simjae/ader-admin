<?php
/*
 +=============================================================================
 | 
 | 랜딩페이지 관리 - 메인_컨텐츠 수정
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

$session_id			= sessionCheck();
$contents_idx		= $_POST['contents_idx'];
$display_num		= $_POST['display_num'];
$title				= $_POST['title'];
$sub_title			= $_POST['sub_title'];
$background_color	= $_POST['background_color'];
$btn1_name			= $_POST['btn1_name'];
$btn1_url			= $_POST['btn1_url'];
$btn1_display_flg	= $_POST['btn1_display_flg'];
$btn2_name			= $_POST['btn2_name'];
$btn2_url			= $_POST['btn2_url'];
$btn2_display_flg	= $_POST['btn2_display_flg'];


if ($contents_idx != null) {
	$update_contents_sql = "
		UPDATE
			dev.MAIN_CONTENTS
		SET
			TITLE = '".$title."',
			SUB_TITLE = '".$sub_title."',
			BACKGROUND_COLOR = '".$background_color."',
			BTN1_NAME = '".$btn1_name."',
			BTN1_URL = '".$btn1_url."',
			BTN1_DISPLAY_FLG = ".$btn1_display_flg.",
			BTN2_NAME = '".$btn2_name."',
			BTN2_URL = '".$btn2_url."',
			BTN2_DISPLAY_FLG = ".$btn2_display_flg."
			UPDATE_DATE = NOW(),
			UPDATER = '".$session_id."'
		WHERE
			IDX = ".$contents_idx."
	";
	
	$db->query($update_contents_sql);
}
?>