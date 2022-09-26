<?php
/*
 +=============================================================================
 | 
 | 전시관리-게시물관리 페이지 등록
 | -----------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.08.22
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$contents_type		= $_POST['contents_type'];

$img_title			= $_POST['img_title'];
$img_type			= $_POST['img_type'];
$img_memo			= $_POST['page_idx'];

$vid_title			= $_POST['vid_title'];
$vid_type			= $_POST['vid_type'];
$vid_memo			= $_POST['vid_memo'];

if ($contents_type == "IMG") {
	if ($img_title != null && $img_type != null) {
		$img_path = "/var/www/admin/www/images/display/contents/";
		
		if($_FILES['contents_img']['size'] > 0) {
			$file_name_arr = explode('.',$_FILES['contents_img']['name']);
			$ext = $file_name_arr[1];
			
			$_FILES['contents_img']['name'] = "img_contents.".$ext;
			$upload_file = file_up('contents_img',$img_path); // 이미지 업로드
			
			if ($upload_file != null) {
				for ($i=0; $i<count($upload_file); $i++) {
					
					$img_sql = "INSERT INTO
									dev.DISPLAY_CONTENTS_IMG
								(
									IMG_TITLE,
									IMG_TYPE,
									IMG_SIZE,
									IMG_LOCATION,
									IMG_URL,
									IMG_MEMO,
									CREATE_DATE,
									CREATER,
									UPDATE_DATE,
									UPDATER
								) VALUES (
									'".$img_title."',
									'".$img_type."',
									'".$upload_file[$i]['img_size']."',
									'".$img_path.$upload_file[$i]['filename']."',
									'".$img_path.$upload_file[$i]['filename']."',
									'".$img_memo."',
									NOW(),
									'Admin',
									NOW(),
									'Admin'
								)";
					
					$db->query($img_sql);
				}
			} 
		}
	}
} else if ($contents_type == "VID") {
	if ($vid_title != null && $vid_type != null) {
		$vid_path = "/var/www/admin/www/images/display/contents/";
		
		if($_FILES['contents_vid']['size'] > 0) {
			$file_name_arr = explode('.',$_FILES['contents_vid']['name']);
			$ext = $file_name_arr[1];
			
			$file_tmp = $_FILES['contents_vid']['tmp_name'];
			
			$_FILES['contents_vid']['name'] = "video_contents_".time().".".$ext;
			$file_name = $_FILES['contents_vid']['name'];
			
			$res = move_uploaded_file($file_tmp,$vid_path.$file_name);
			
			if ($res == true) { 
				$vid_sql = "INSERT INTO
									dev.DISPLAY_CONTENTS_VID
								(
									VID_TITLE,
									VID_TYPE,
									VID_SIZE,
									VID_LOCATION,
									VID_URL,
									VID_MEMO,
									CREATE_DATE,
									CREATER,
									UPDATE_DATE,
									UPDATER
								) VALUES (
									'".$vid_title."',
									'".$vid_type."',
									'".$vid_path.$file_name."',
									'".$vid_path.$file_name."',
									'".$vid_memo."',
									NOW(),
									'Admin',
									NOW(),
									'Admin'
								)";
					
					$db->query($vid_sql);
			}
		}
	}
}
?>