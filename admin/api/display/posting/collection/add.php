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
$tmp_flg						= $_POST['tmp_flg'];

$tbl_posting = array();
if ($tmp_flg == "true") {
	$tbl_posting[0] = "dev.TMP_DISPLAY_POSTING_COLLECTION";
	$tbl_posting[1] = "dev.TMP_POSTING_IMG_COLLECTION";
} else {
	$tbl_posting[0] = "dev.DISPLAY_POSTING_COLLECTION";
	$tbl_posting[1] = "dev.POSTING_IMG_COLLECTION";
	
	//임시저장이 아닌 경우 논리 삭제
	$update_posting_sql = "UPDATE dev.DISPLAY_POSTING_COLLECTION SET DEL_FLG = TRUE WHERE PAGE_IDX = ".$page_idx;
	$db->query($update_posting_sql);

	$update_img_sql = "UPDATE dev.POSTING_IMG_COLLECTION SET DEL_FLG = TRUE WHERE PAGE_IDX = ".$page_idx;
	$db->query($update_img_sql);
}

//tmp 테이블 물리 삭제
$delete_tmp_posting_sql = "DELETE FROM dev.TMP_DISPLAY_POSTING_COLLECTION WHERE PAGE_IDX = ".$page_idx;
$db->query($delete_tmp_posting_sql);

$delete_tmp_img_sql = "DELETE FROM dev.TMP_POSTING_IMG_COLLECTION WHERE PAGE_IDX = ".$page_idx;
$db->query($delete_tmp_img_sql);

$collection_title_arr = array();
$collection_title				= $_POST['collection_title'];
if ($collection_title != null) {
	$collection_title_arr[0] = " COLLECTION_TITLE, ";
	$collection_title_arr[1] = "'".$collection_title."',";
}

$posting_sql = "INSERT INTO
					".$tbl_posting[0]."
				(
					PAGE_IDX,
					".$collection_title[0]."
					
					CREATE_DATE,
					CREATER,
					UPDATE_DATE,
					UPDATER
				)
				VALUES
				(
					".$page_idx."
					".$collection_title[1]."
					
					NOW(),
					'Admin',
					NOW(),
					'Admin'
				)";
$db->query($posting_sql);

$collection_idx = $db->last_id();

if ($collection_idx != null) {
	$path = "/var/www/admin/www/images/posting/collection/";
	
	if($_FILES['img_collection']['size'] > 0) {
		$file_name_arr = explode('.',$_FILES['img_main']['name']);
		$ext = $file_name_arr[1];
		
		$_FILES['img_collection']['name'] = "img_collection_".$collection_idx.".".$ext;
		$upload_file = file_up('img_collection',$path); // 이미지 업로드
		
		$display_num = 1;
		for ($i=0; $i<count($upload_file); $i++) {
			$img_sql = "INSERT INTO
					".$tbl_posting[1]."
				(
					PAGE_IDX,
					COLLECTION_IDX,
					DISPLAY_NUM,
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
					".$collection_idx.",
					".$display_num.",
					'".$upload_file[$i]['img_size']."',
					'".$path.$upload_file[$i]['filename']."',
					'".$path.$upload_file[$i]['filename']."',
					NOW(),
					'Admin',
					NOW(),
					'Admin'
				)";
			
			$db->query($img_sql);
			
			$img_idx = $db->last_id();
			if ($img_idx != null) {
				$display_num++;
			}
		} 
	}
}
?>