<?php
/*
 +=============================================================================
 | 
 | 스토리 관리 화면 - 스토리 등록
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.12.05
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

include_once("/var/www/admin/api/common/common.php");

$session_id			= sessionCheck();
$country			= $_POST['country'];
$story_type			= $_POST['story_type'];
$page_idx			= $_POST['page_idx'];
$story_title 		= xssEncode($_POST['story_title']);

$story_sub_title = "NULL";
if (isset($_POST['story_sub_title']) && $_POST['story_sub_title'] != null) {
	$story_sub_title 	= xssEncode($_POST['story_sub_title']);
}

$story_memo = "NULL";
if (isset($_POST['story_memo']) && $_POST['story_memo'] != null) {
	$story_memo = xssEncode($_POST['story_memo']);
}

$img_location = "NULL";
if (isset($_POST['img_location']) && $_POST['img_location'] != null) {
	$img_location = "'/var/www/admin/www".$_POST['img_location']."'";
}

if ($page_idx != null) {
	$insert_posting_story_sql = "
		INSERT INTO
			TMP_POSTING_STORY
		(
			COUNTRY,
			STORY_TYPE,
			PAGE_IDX,
			IMG_LOCATION,
			DISPLAY_NUM,
			STORY_TITLE,
			STORY_SUB_TITLE,
			STORY_MEMO,
			CREATER,
			UPDATER
		) VALUES (
			'".$country."',
			'".$story_type."',
			".$page_idx.",
			".$img_location.",
			1,
			".$story_title.",
			".$story_sub_title.",
			".$story_memo.",
			'".$session_id."',
			'".$session_id."'
		)
	";
	
	$db->query($insert_posting_story_sql);
	
	$story_idx = $db->last_id();
	
	$update_posting_story_sql = "
		UPDATE
			TMP_POSTING_STORY
		SET
			DISPLAY_NUM = DISPLAY_NUM + 1
		WHERE
			COUNTRY = '".$country."' AND
			STORY_TYPE = '".$story_type."' AND
			IDX != ".$story_idx.";
	";
	
	$db->query($update_posting_story_sql);
}

function xssEncode($param){
    $param = str_replace("&","&amp;",$param);
    $param = str_replace("\"","&quot;",$param);
    $param = str_replace("'","&apos;",$param);
    $param = str_replace("<","&lt;",$param);
    $param = str_replace(">","&gt;",$param);
    $param = str_replace("\r","<br>",$param);
    $param = str_replace("\n","<p>",$param);

    return "'".$param."'";
}
?>