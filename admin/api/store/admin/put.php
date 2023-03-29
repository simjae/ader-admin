<?php
/*
 +=============================================================================
 | 
 | 운영자 관리 화면 - 운영자 상태 변경
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.07.12
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$admin_status_flg		= $_POST['admin_status_flg'];
$admin_update_flg		= $_POST['admin_update_flg'];
$admin_auth_flg			= $_POST['admin_auth_flg'];

$admin_idx				= $_POST['admin_idx'];
$action_type    		= $_POST['action_type'];

$admin_id				= $_POST['admin_id'];
$admin_name				= $_POST['admin_name'];
$admin_nick				= $_POST['admin_nick'];
$admin_pw				= $_POST['admin_pw'];
$pw_confirm				= $_POST['pw_confirm'];
$admin_email			= $_POST['admin_email'];
$tel_mobile				= $_POST['tel_mobile'];
$admin_fax				= $_POST['admin_fax'];

$permition_idx			= explode(",",$_POST['permition_idx']);

$session_id = null;
if (isset($_SESSION['ADMIN_ID'])) {
	$session_id = $_SESSION['ADMIN_ID'];
}

if ($session_id == null) {
	$json_result['code'] = 301;
	$json_result['msg'] = "로그인 후 다시 시도해주세요.";
}

if ($admin_status_flg != null) {
	if ($admin_idx != null && count($admin_idx) > 0 && $action_type != null) {
		$admin_status = null;
		if ($action_type == "ACT") {
			$admin_status = 'TRUE';
		} else if ($action_type == "DAC") {
			$admin_status = 'FALSE';
		}
		
		if ($admin_status != null) {
			$update_admin_sql = "
				UPDATE
					ADMIN
				SET
					ADMIN_STATUS = ".$admin_status."
				WHERE
					IDX IN (".implode(",",$admin_idx).")
			";
			
			$db->query($update_admin_sql);
		} else {
			$json_result['code'] = 301;
			$json_result['msg'] = "변경하려는 상태를 다시 선택해주세요.";
		}
	} else {
		$json_result['code'] = 301;
		$json_result['msg'] = "상태를 변경하려는 운영자 정보를 다시 선택해주세요.";
	}
}

if ($admin_update_flg != null && $admin_idx != null) {
	$pw_check_cnt = $db->count('ADMIN',"IDX = ".$admin_idx." AND ADMIN_PW = '".md5($admin_pw)."'");
	
	if ($pw_check_cnt > 0) {
		// 프로필 이미지 업로드
		if($_FILES['profile_img']['size'] > 0) {
			$update_profile_sql = "
				UPDATE
					ADMIN_PROFILE_IMG
				SET
					DEL_FLG = TRUE
				WHERE
					ADMIN_IDX = ".$admin_idx."
			";
			
			$db->query($update_profile_sql);
			
			$path = "/var/www/admin/www/images/profile/admin/";
			
			$file_name_arr = explode('.',$_FILES['profile_img']['name']);
			$ext = $file_name_arr[1];
			
			$_FILES['profile_img']['name'] = "img_admin_profile_".$idx.".".$ext;
			$upload_file = file_up('profile_img',$path); // 이미지 업로드
			
			$db_result = 0;
			for ($i=0; $i<count($upload_file); $i++) {
				$insert_profile_sql = "
					INSERT INTO
						ADMIN_PROFILE_IMG AI
					(
						ADMIN_IDX,
						ADMIN_ID,
						IMG_SIZE,
						IMG_LOCATION,
						IMG_URL,
						CREATER,
						UPDATER
					) VALUES (
						".$admin_idx.",
						'".$admin_id."',
						'".$upload_file[$i]['img_size']."',
						'".$path.$upload_file[$i]['filename']."',
						'".$path.$upload_file[$i]['filename']."',
						'".$session_id."',
						'".$session_id."'
					)
				";
				
				$db->query($insert_profile_sql);
			}
		}

		$update_admin_sql = "
			UPDATE
				ADMIN
			SET
				ADMIN_NAME = '".$admin_name."',
				ADMIN_NICK = '".$admin_nick."',
				ADMIN_PW = '".md5($pw_confirm)."',
				ADMIN_EMAIL = '".$admin_email."',
				TEL_MOBILE = '".$tel_mobile."',
				ADMIN_FAX = '".$admin_fax."'
			WHERE
				IDX = ".$admin_idx."
		";
	
		$db->query($update_admin_sql);
		
		$db_result = $db->affectedRows();
		
		if ($db_result > 0 && $permition_idx != null) {
			$db->query("DELETE FROM PERMITION_MAPPING WHERE ADMIN_IDX = ".$admin_idx);
			
			for ($i=0; $i<count($permition_idx); $i++) {
				$insert_permition_mapping_sql = "
					INSERT INTO
						PERMITION_MAPPING
					(
						ADMIN_IDX,
						PERMITION_IDX
					) VALUES (
						".$admin_idx.",
						".$permition_idx[$i]."
					)
				";
				
				$db->query($insert_permition_mapping_sql);
			}
		}
	} else {
		$json_result['result'] = false;
		$json_result['code'] = 778;	
		$json_result['msg'] = "현재 비밀번호와 일치하지 않습니다.";
	}
}

if ($admin_auth_flg != null && $admin_idx != null && $admin_permition != null) {
	$db->query("DELETE FROM PERMITION_MAPPING WHERE ADMIN_IDX IN (".$admin_idx.")");
	
	for ($i=0; $i<count($permition_idx); $i++) {
		$insert_admin_permition_sql = "
			INSERT INTO
				PERMITION_MAPPING
			(
				ADMIN_IDX,
				PERMITION_IDX
			) VALUES (
				".$admin_idx.",
				".$permition_idx[$i]."
			)
		";
		
		$db->query($insert_admin_permition_sql);
	}	
}
?>