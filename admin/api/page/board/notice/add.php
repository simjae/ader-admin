<?php
/*
 +=============================================================================
 | 
 | 공지사항 등록 API
 | -----------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.08.26
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
include_once("/var/www/admin/api/common/common.php");

/** 변수 정리 **/
$session_id			= sessionCheck();
$country			= $_POST['country'];
$category		   = $_POST['category'];
$title			  = $_POST['title'];
$contents		   = $_POST['contents'];
$contents			= str_replace("<p>&nbsp;</p>","",$contents);

$display_flg		= $_POST['display_flg'];
$display_from	   = $_POST['display_from'];
$display_from_h	 = $_POST['display_from_h'];
$display_from_m	 = $_POST['display_from_m'];
$display_to		 = $_POST['display_to'];
$display_to_h	   = $_POST['display_to_h'];
$display_to_m	   = $_POST['display_to_m'];
$fix_flg			= $_POST['fix_flg'];

$display_start_date = "";
$display_end_date = "";
if($display_flg != null){
	if ($display_flg == "true") {
		$display_start_date = "NOW()";
		$display_end_date = "'9999-12-31 23:59'";
	} else {
		$display_start_date = "'".$display_from." ".$display_from_h.":".$display_from_m."'";
		$display_end_date = "'".$display_to." ".$display_to_h.":".$display_to_m."'";
	}
}

if($title != null){
	$insert_page_board_sql = "
		INSERT PAGE_BOARD(
			COUNTRY,
			BOARD_TYPE,
			CATEGORY,
			ADMIN_IDX,
			ADMIN_ID,
			ADMIN_NAME,
			IP,
			TITLE,
			CONTENTS,
			EXPOSURE_FLG,
			EXPOSURE_START_DATE,
			EXPOSURE_END_DATE,
			FIX_FLG,
			CREATER,
			UPDATER
		)
		SELECT
			'".$country."',
			'NTC',
			'".$category."',
			IDX,
			ADMIN_ID,
			ADMIN_NAME,
			'127.0.0.8',
			'".$title."',
			'".$contents."',
			TRUE,
			".$display_start_date.",
			".$display_end_date.",
			".$fix_flg.",
			'".$session_id."',
			'".$session_id."'
		FROM
			ADMIN
		WHERE
			ADMIN_ID = '".$session_id."'
	";
	
	$db->query($insert_page_board_sql);
	
	$board_idx = $db->last_id();
	
	if (!empty($board_idx)) {
		$update_page_board_sql = "
			UPDATE
				PAGE_BOARD
			SET
				DISPLAY_NUM = DISPLAY_NUM + 1
			WHERE
				IDX != ".$board_idx." AND
				COUNTRY = '".$country."' AND
				BOARD_TYPE = 'NTC'
		";
		
		$db->query($update_page_board_sql);
	}
}
else{
	$code = 500;
}


?>