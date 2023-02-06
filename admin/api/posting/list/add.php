<?php
/*
 +=============================================================================
 | 
 | 전시정보 등록 - 게시물 리스트_신규 게시물 등록
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

$country			= $_POST['country'];
$page_idx			= $_POST['page_idx'];
$list_title			= $_POST['list_title'];
$list_memo			= $_POST['list_memo'];
$display_flg		= $_POST['display_flg'];

$display_start_date	= $_POST['display_start_date'];
$display_start_h	= $_POST['display_start_h'];
$display_start_m	= $_POST['display_start_m'];

$display_end_date	= $_POST['display_end_date'];
$display_end_h		= $_POST['display_end_h'];
$display_end_m		= $_POST['display_end_m'];

$display_start_date = $display_start_date." ".$display_start_h.":".$display_start_m;
$display_end_date = $display_end_date." ".$display_end_h.":".$display_end_m;

if ($page_idx != null) {
	$sql = "INSERT INTO
				dev.POSTING_LIST
			(
				COUNTRY,
				LIST_TITLE,
				LIST_MEMO,
				
				PAGE_IDX,
				DISPLAY_FLG,
				DISPLAY_START_DATE,
				DISPLAY_END_DATE
				CREATE_DATE,
				CREATER,
				UPDATE_DATE,
				UPDATER
			) VALUES (
				'".$country."',
				'".$list_title."',
				'".$list_memo."',
				
				'".$page_idx."',
				".$display_flg.",
				'".$display_start_date."',
				'".$display_end_date."'
				NOW(),
				'Admin',
				NOW(),
				'Admin'
			)";
	
	$db->query($sql);
}
?>