<?php
/*
 +=============================================================================
 | 
 | What's New - 일괄선택 후 복사&삭제
 | -----------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.07.31
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

/** 변수 정리 **/
$contents_type		= $_POST['contents_type'];
$contents_idx		= $_POST['contents_idx'];

$img_title			= $_POST['img_title'];
$img_type			= $_POST['img_type'];
$img_memo			= $_POST['page_idx'];

$vid_title			= $_POST['vid_title'];
$vid_type			= $_POST['vid_type'];
$vid_memo			= $_POST['vid_memo'];

$tables = "";
if ($contents_type == "IMG") {
	$tables = "dev.DISPLAY_CONTENTS_IMG";
} else if ($contents_type == "VID") {
	$tables = "dev.DISPLAY_CONTENTS_VID";
}

$where = " 1=1 ";
$idx_list="";
if ($contents_idx != null) {
	$idx_list = implode(',',$contents_idx);
	$where .= " AND IDX IN (".$idx_list.")";
}

$sql = "";
if ($action_type != null) {
	if ($action_type == "delete") {
		$sql = "UPDATE
					".$tables."
				SET
					DEL_FLG = TRUE,
					UPDATE_DATE = NOW()
				WHERE
					".$where;
	} else if ($action_type == "update") {
		$set_sql = "";
		
		if ($contents_type == "IMG") {
			if($_FILES['contents_img']['size'] > 0) {
				$db->query("UPDATE ".$tables." SET DEL_FLG = TRUE WHERE IDX = ".$contents_idx);
				
				$img_path = "/var/www/admin/www/images/display/contents/";
				
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
										'".$img_memo."'
										NOW(),
										'Admin',
										NOW(),
										'Admin'
									)";
						
						$db->query($img_sql);
					}
				}
			} else {
				if ($img_title != null) {
					$set_sql .= " IMG_TITLE = '".$img_title."', ";
				}
				
				if ($img_type != null) {
					$set_sql .= " IMG_TYPE = '".$img_type."', ";
				}
				
				if ($img_memo != null) {
					$set_sql .= " IMG_MEMO = '".$img_memo."', "; 
				}
			}
		} else if ($contents_type == "VID") {
			if($_FILES['contents_vid']['size'] > 0) {
				$db->query("UPDATE ".$tables." SET DEL_FLG = TRUE WHERE IDX = ".$contents_idx);
				
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
										'".$vid_memo."'
										NOW(),
										'Admin',
										NOW(),
										'Admin'
									)";
						
						$db->query($vid_sql);
				}
			} else {
				if ($vid_title != null) {
					$set_sql .= " VID_TITLE = '".$vid_title."', ";
				}
				
				if ($vid_type != null) {
					$set_sql .= " VID_TYPE = '".$vid_type."', ";
				}
				
				if ($vid_memo != null) {
					$set_sql .= " VID_MEMO = '".$vid_memo."', "; 
				}
			}
		}
		
		if (strlen($set_sql) > 0) {
			$sql = "UPDATE
						".$tables."
					SET
						".$set_sql."
					WHERE
						IDX = ".$contents_idx;
			
			$db->query($sql);
		}
	}
}
?>