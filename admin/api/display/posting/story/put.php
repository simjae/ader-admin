<?php
/*
 +=============================================================================
 | 
 | 스토리 관리 화면 - 스토리 수정
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
$display_num_flg	= $_POST['display_num_flg'];
$update_flg			= $_POST['update_flg'];
$toggle_flg			= $_POST['toggle_flg'];

$country			= $_POST['country'];
$story_type			= $_POST['story_type'];
$action_type		= $_POST['action_type'];
$recent_idx			= $_POST['recent_idx'];
$recent_num			= $_POST['recent_num'];

$story_idx			= $_POST['story_idx'];
$story_title 		= xssEncode($_POST['story_title']);

$story_sub_title = "NULL";
if (isset($_POST['story_sub_title']) && $_POST['story_sub_title'] != null) {
	$story_sub_title = xssEncode($_POST['story_sub_title']);
}

$story_memo = "NULL";
if (isset($_POST['story_memo']) && $_POST['story_memo'] != null) {
	$story_memo = xssEncode($_POST['story_memo']);
}

$img_location		= $_POST['img_location'];
$project_idx		= $_POST['project_idx'];
$page_idx			= $_POST['page_idx'];

if ($img_location == "" || $img_location == null) {
	$img_location = " NULL ";
} else {
	$img_location = " '/var/www/admin/www".$img_location."' ";
}

if ($display_num_flg != null && $action_type != null) {
	$prev_sql = "";
	$sql = "";
	
	switch ($action_type) {
		case "up" :
			$prev_sql ="
				UPDATE
					TMP_POSTING_STORY
				SET
					DISPLAY_NUM = ".$recent_num."
				WHERE
					COUNTRY = '".$country."' AND
					STORY_TYPE = '".$story_type."' AND
					DISPLAY_NUM = ".intval($recent_num - 1)." AND
					DEL_FLG = FALSE
			";
			
			$sql = "
				UPDATE
					TMP_POSTING_STORY
				SET
					DISPLAY_NUM = ".intval($recent_num - 1)."
				WHERE
					IDX = ".$recent_idx."
			";
			
			break;
		
		case "down" :
			$prev_sql ="
				UPDATE
					TMP_POSTING_STORY
				SET
					DISPLAY_NUM = ".$recent_num."
				WHERE
					STORY_TYPE = '".$story_type."' AND
					COUNTRY = '".$country."' AND
					DISPLAY_NUM = ".intval($recent_num + 1)." AND
					DEL_FLG = FALSE
			";
			
			$sql = "
				UPDATE
					TMP_POSTING_STORY
				SET
					DISPLAY_NUM = ".intval($recent_num + 1)."
				WHERE
					IDX = ".$recent_idx."
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

if ($update_flg == true && $story_idx != null) {
	$update_posting_story_sql = "
		UPDATE
			TMP_POSTING_STORY
		SET
			STORY_TYPE = '".$story_type."',
			STORY_TITLE = ".$story_title.",
			STORY_SUB_TITLE = ".$story_sub_title.",
			STORY_MEMO = ".$story_memo.",
			IMG_LOCATION = ".$img_location.",
			PAGE_IDX = ".$page_idx.",
			UPDATE_DATE = NOW(),
			UPDATER = '".$session_id."'
		WHERE
			IDX = ".$story_idx."
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