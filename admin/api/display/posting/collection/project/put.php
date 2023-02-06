<?php
/*
 +=============================================================================
 | 
 | 룩북 관리 화면 - 프로젝트 수정
 | -----------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2023.01.26
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

include_once("/var/www/admin/api/common/common.php");

$display_num_flg	= $_POST['display_num_flg'];
$update_flg			= $_POST['update_flg'];

$session_id			= sessionCheck();
$country			= $_POST['country'];

$action_type		= $_POST['action_type'];
$recent_idx			= $_POST['recent_idx'];
$recent_num			= $_POST['recent_num'];

$collection_idx		= $_POST['collection_idx'];
$project_name		= $_POST['project_name']; 
$project_desc		= $_POST['project_desc'];
$project_title		= $_POST['project_title'];
$thumb_location		= $_POST['thumb_location'];

if ($display_num_flg != null && $action_type != null) {
	$prev_sql = "";
	$sql = "";
	
	switch ($action_type) {
		case "up" :
			$prev_sql = "
				UPDATE
					dev.POSTING_COLLECTION
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
					dev.POSTING_COLLECTION
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
					dev.POSTING_COLLECTION
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
					dev.POSTING_COLLECTION
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

if ($update_flg != null && $collection_idx != null) {
	if($update_flg == 'thumbnail'){
		$update_collection_sql = "
			UPDATE
				dev.POSTING_COLLECTION
			SET
				THUMB_LOCATION = '" . $server_img_path . "',
				UPDATE_DATE = NOW(),
				UPDATER = '" . $session_id . "'
			WHERE
				IDX = " . $collection_idx . " ";
	}
	else{
		$update_collection_sql = "
			UPDATE
				dev.POSTING_COLLECTION
			SET
				PROJECT_NAME = '".$project_name."',
				PROJECT_DESC = '".$project_desc."',
				PROJECT_TITLE = '".$project_title."',
				UPDATE_DATE = NOW(),
				UPDATER = '".$session_id."'
			WHERE
				IDX = ".$collection_idx."
		";
	}
	

	$db->query($update_collection_sql);
}

?>