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

$country		= $_POST['country'];
$story_column	= $_POST['story_column'];
$img_location	= $_POST['img_location'];
$story_title 	= xssEncode($_POST['story_title']);
$story_memo 	= xssEncode($_POST['story_memo']);
$page_idx		= $_POST['page_idx'];

if ($img_location == "" || $img_location == null) {
	$img_location = " NULL ";
} else {
	$img_location = " '".$img_location."' ";
}

if ($page_idx != null) {
	$insert_sql = "
		INSERT INTO
			dev.TMP_POSTING_STORY
		(
			COUNTRY,
			STORY_COLUMN,
			IMG_LOCATION,
			DISPLAY_NUM,
			STORY_TITLE,
			STORY_MEMO,
			PAGE_IDX,
			CREATER,
			UPDATER
		)
		SELECT
			'".$country."',
			".$story_column.",
			".$img_location.",
			1,
			'".$story_title."',
			'".$story_memo."',
			".$page_idx.",
			'Admin',
			'Admin'
		FROM
			DUAL";
	
	$db->query($insert_sql);
	
	$story_idx = $db->last_id();
	
	$update_sql = "
		UPDATE
			dev.TMP_POSTING_STORY
		SET
			DISPLAY_NUM = DISPLAY_NUM + 1
		WHERE
			COUNTRY = '".$country."' AND
			STORY_COLUMN = ".$story_column." AND
			IDX != ".$story_idx.";
	";
	
	$db->query($update_sql);
}

function xssEncode($param){
    $param = str_replace("&","&amp;",$param);
    $param = str_replace("\"","&quot;",$param);
    $param = str_replace("'","&apos;",$param);
    $param = str_replace("<","&lt;",$param);
    $param = str_replace(">","&gt;",$param);
    $param = str_replace("\r","<br>",$param);
    $param = str_replace("\n","<p>",$param);

    return $param;
}
?>