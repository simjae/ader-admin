<?php
/*
 +=============================================================================
 | 
 | 전시정보 수정 - 게시물 리스트_수정
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.12.06
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$list_idx			= $_POST['list_idx'];
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

if ($list_idx != null) {
	$country_str = "";
	if ($country != null) {
		$country_str = " COUNTRY = '".$country."', ";
	}
	
	$page_idx_str = "";
	if ($page_idx != null) {
		$page_idx_str = " PAGE_IDX = ".$page_idx.", ";
	}
	
	$list_title_str = "";
	if ($list_title != null) {
		$list_title_str = " LIST_TITLE = '".$list_title."', ";
	}
	
	$display_flg_str = "";
	if ($display_flg != null) {
		$display_flg_str = " DISPLAY_FLG = ".$display_flg.", ";
	}
	
	$display_str_date_str = "";
	if ($display_start_date != null && $display_start_h != null && $display_start_m != null) {
		$display_start_date_str = " DISPLAY_START_DATE = '".$display_start_date." ".$display_start_h.":".$display_start_m."', ";
	}
	
	$display_end_date_str = "";
	if ($display_end_date != null && $display_end_h != null && $display_end_m != null) {
		$display_end_date_str = " DISPLAY_END_DATE = '".$display_end_date." ".$display_end_h.":".$display_end_m."', ";
	}
	
	$sql = "UPDATE
				dev.POSTING_LIST
			SET
				".$country_str."
				".$page_idx_str."
				".$list_title_str."
				LIST_MEMO = '".$list_memo."',
				".$display_flg_str."
				".$display_start_date_str."
				".$display_end_date_str."
				UPDATE_DATE = NOW(),
				UPDATER = 'Admin'
			WHERE
				IDX = ".$list_idx;
	
	$db->query($sql);
}
?>