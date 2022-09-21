<?php
/*
 +=============================================================================
 | 
 | 전시관리-게시물관리 페이지 등록
 | -----------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.08.01
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$page_idx						= $_POST['page_idx'];
$tbl_posting = array();
if ($tmp_flg == "true") {
	$tbl_posting[0] = "dev.TMP_DISPLAY_POSTING_COLLABORATION";
	$tbl_posting[1] = "dev.TMP_POSTING_IMG_COLLABORATION";
} else {
	$tbl_posting[0] = "dev.DISPLAY_POSTING_COLLABORATION";
	$tbl_posting[1] = "dev.POSTING_IMG_COLLABORATION";
	
	//임시저장이 아닌 경우 논리 삭제
	$update_posting_sql = "UPDATE dev.DISPLAY_POSTING_COLLABORATION SET DEL_FLG = TRUE WHERE PAGE_IDX = ".$page_idx;
	$db->query($update_posting_sql);

	$update_img_sql = "UPDATE dev.POSTING_IMG_COLLABORATION SET DEL_FLG = TRUE WHERE PAGE_IDX = ".$page_idx;
	$db->query($update_img_sql);
}

//tmp 테이블 물리 삭제
$delete_tmp_posting_sql = "DELETE FROM dev.TMP_DISPLAY_POSTING_COLLABORATION WHERE PAGE_IDX = ".$page_idx;
$db->query($delete_tmp_posting_sql);

$delete_tmp_img_sql = "DELETE FROM dev.TMP_POSTING_IMG_COLLABORATION WHERE PAGE_IDX = ".$page_idx;
$db->query($delete_tmp_img_sql);

$exhibition_date_arr = array();
$exhibition_date				= $_POST['exhibition_date'];
if ($exhibition_date != null) {
	$exhibition_date_arr[0] = " EXHIBITION_DATE, ";
	$exhibition_date_arr[1] = "'".$exhibition_date."',";
}

$exhibition_title_arr = array();
$exhibition_title			= $_POST['exhibition_title'];
if ($exhibition_title != null) {
	$exhibition_title_arr[0] = " EXHIBITION_TITLE, ";
	$exhibition_title_arr[1] = "'".$exhibition_title."',";
}

$exhibition_description_arr = array();
$exhibition_description		= $_POST['exhibition_description'];
if ($exhibition_description != null) {
	$exhibition_description_arr[0] = " EXHIBITION_DESCRIPTION, ";
	$exhibition_description_arr[1] = "'".$exhibition_dscription."',";
}

$exhibition_script_arr = array();
$exhibition_script			= $_POST['exhibition_script'];
if ($exhibition_script != null) {
	$exhibition_script_arr[0] = " EXHIBITION_SCRIPT, ";
	$exhibition_script_arr[1] = "'".$exhibition_script."',";
}

$btn_product_top_display_flg_arr = array();
$btn_product_top_display_flg	= $_POST['btn_product_top_display_flg'];
if ($btn_product_top_display_flg != null) {
	$btn_product_top_display_flg_arr[0] = " BTN_PRODUCT_TOP_DISPLAY_FLG, ";
	$btn_product_top_display_flg_arr[1] = "'".$btn_product_top_display_flg."',";
}

$btn_product_top_text_arr = array();
$btn_product_top_text			= $_POST['btn_product_top_text'];
if ($btn_product_top_text != null) {
	$btn_product_top_text_arr[0] = " BTN_PRODUCT_TOP_TEXT, ";
	$btn_product_top_text_arr[1] = "'".$btn_product_top_text."',";
}

$btn_product_top_url_arr = array();
$btn_product_top_url			= $_POST['btn_product_top_url'];
if ($btn_product_top_url != null) {
	$btn_product_top_url_arr[0] = " BTN_PRODUCT_TOP_URL, ";
	$btn_product_top_url_arr[1] = "'".$btn_product_top_url."',";
}

$btn_product_bot_display_flg_arr = array();
$btn_product_bot_display_flg	= $_POST['btn_product_bot_display_flg'];
if ($btn_product_bot_display_flg != null) {
	$btn_product_bot_display_flg_arr[0] = " BTN_PRODUCT_BOT_DISPLAY_FLG, ";
	$btn_product_bot_display_flg_arr[1] = "'".$btn_product_bot_display_flg."',";
}

$btn_product_bot_text_arr = array();
$btn_product_bot_text			= $_POST['btn_product_bot_text'];
if ($btn_product_bot_text != null) {
	$btn_product_bot_text_arr[0] = " BTN_PRODUCT_BOT_TEXT, ";
	$btn_product_bot_text_arr[1] = "'".$btn_product_bot_text."',";
}

$btn_product_bot_url_arr = array();
$btn_product_bot_url			= $_POST['btn_product_bot_url'];
if ($btn_product_bot_url != null) {
	$btn_product_bot_url_arr[0] = " BTN_PRODUCT_BOT_URL, ";
	$btn_product_bot_url_arr[1] = "'".$btn_product_bot_url."',";
}

$posting_sql = "INSERT INTO
					dev.DISPLAY_POSTING_EXHIBITION
				(
					PAGE_IDX,
					".$exhibition_date_arr[0]."
					".$exhibition_title_arr[0]."
					".$exhibition_description_arr[0]."
					".$exhibition_script_arr[0]."
					".$exhibition_video_url_arr[0]."
					
					".$btn_product_top_display_flg_arr[0]."
					".$btn_product_top_text_arr[0]."
					".$btn_product_top_url_arr[0]."
					
					".$btn_product_bot_display_flg_arr[0]."
					".$btn_product_bot_text_arr[0]."
					".$btn_product_bot_url_arr[0]."
					
					".$btn_video_display_flg_arr[0]."
					".$btn_video_text_arr[0]."
					
					".$btn_img_display_flg_arr[0]."
					".$btn_img_text_arr[0]."
					".$btn_img_url_arr[0]."
					
					".$exhibition_img_script_arr[0]."
					
					CREATE_DATE,
					CREATER,
					UPDATE_DATE,
					UPDATER
				)
				VALUES
				(
					".$exhibition_date_arr[1]."
					".$exhibition_title_arr[1]."
					".$exhibition_description_arr[1]."
					".$exhibition_script_arr[1]."
					".$exhibition_video_url_arr[1]."
					
					".$btn_product_top_display_flg_arr[1]."
					".$btn_product_top_text_arr[1]."
					".$btn_product_top_url_arr[1]."
					
					".$btn_product_bot_display_flg_arr[1]."
					".$btn_product_bot_text_arr[1]."
					".$btn_product_bot_url_arr[1]."
					
					".$btn_video_display_flg_arr[1]."
					".$btn_video_text_arr[1]."
					
					".$btn_img_display_flg_arr[1]."
					".$btn_img_text_arr[1]."
					".$btn_img_url_arr[1]."
					
					".$exhibition_img_script_arr[1]."
					NOW(),
					'Admin',
					NOW(),
					'Admin'
				)";
$db->query($posting_sql);

$exhibition_idx = $db->last_id();

if ($exhibition_idx != null) {
	$path = "/var/www/admin/www/images/posting/exhibition/";
	
	if($_FILES['img_main']['size'] > 0) {
		$file_name_arr = explode('.',$_FILES['img_main']['name']);
		$ext = $file_name_arr[1];
		
		$_FILES['img_main']['name'] = "img_exhibition_main_".$exhibition_idx.".".$ext;
		$upload_file = file_up('img_main',$path); // 이미지 업로드
		
		if ($upload_file != null) {
			$img_sql = "INSERT INTO
					dev.POSTING_IMG_EXHIBITION
				(
					PAGE_IDX,
					EXHIBITION_IDX,
					IMG_TYPE,
					IMG_SIZE,
					IMG_LOCATION,
					IMG_URL,
					CREATE_DATE,
					CREATER,
					UPDATE_DATE,
					UPDATER
				)
				VALUES
				(
					".$page_idx.",
					".$exhibition_idx.",
					'MAIN',
					'".$upload_file['img_size']."',
					'".$path.$upload_file['filename']."',
					'".$path.$upload_file['filename']."',
					NOW(),
					'Admin',
					NOW(),
					'Admin'
				)";
			
			$db->query($img_sql);
		} 
	}
}
?>