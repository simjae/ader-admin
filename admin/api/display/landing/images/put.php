<?php
/*
 +=============================================================================
 | 
 | 랜딩페이지 관리 - 메인 배너 정보 수정
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2023.01.13
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

include_once("/var/www/admin/api/common/common.php");

$session_id			= sessionCheck();

$main_img			= $_FILES['main_img'];

$display_num_flg	= $_POST['display_num_flg'];

$country			= $_POST['country'];
$action_type		= $_POST['action_type'];
$recent_idx			= $_POST['recent_idx'];
$recent_num			= $_POST['recent_num'];

$img_idx			= $_POST['img_idx'];
$title				= $_POST['title'];
$sub_title			= $_POST['sub_title'];
$btn_name			= $_POST['btn_name'];
$btn_url			= $_POST['btn_url'];
$btn_display_flg	= $_POST['btn_display_flg'];

if ($display_num_flg != null && $action_type != null) {
	$prev_sql = "";
	$sql = "";
	
	switch ($action_type) {
		case "up" :
			$prev_sql = "
				UPDATE
					dev.MAIN_IMG
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
					dev.MAIN_IMG
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
					dev.MAIN_IMG
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
					dev.MAIN_IMG
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

if ($img_idx != null) {
	$path = "/var/www/admin/www/images/main/img";
	$img_location_sql = "";
	
	if ($main_img['size'] > 0) {
		$upload_result = uploadMainImg($path,$main_img);
		
		if ($upload_result['code'] == 200) {
			$img_filename = $upload_result['name'];
			
			$img_location_sql = " IMG_LOCATION = '".$path.$img_filename."', ";
		}
	}
	
	$update_img_sql = "
		UPDATE
			dev.MAIN_IMG
		SET
			".$img_location_sql."
			TITLE = '".$title."',
			BTN_NAME = '".$btn_name."',
			BTN_URL = '".$btn_url."',
			BTN_DISPLAY_FLG = ".$btn_display_flg.",
			UPDATE_DATE = NOW(),
			UPDATER = '".$session_id."'
		WHERE
			IDX = ".$img_idx."
	";
	
	$db->query($update_img_sql);
}

function uploadMainImg($path,$file) {
	$filename = $file['name'];			// 파일 이름 알아내기
	$file_tmp = $file['tmp_name'];		// 파일 임시 저장 장소 알아내기
	$file_info = pathinfo($filename);	// 파일 확장자 알아내기

	// 실행 파일 업로드 불가
	if(array_key_exists('extension',$file_info) && strpos(strtolower($file_info['extension']),'.php,.asp,.jsp,.aspx')) {
		throw new Exception('Can not upload file : Permition Denied');
		return false;
	}
	
	$filename = str_replace(' ','_',strip_tags($filename));
	$filename_arr = explode('.',$filename);
	
	// 파일 이름을 타임 스탬프로 바꾸기
	$filename = "img_main_banner_".time().".".$filename_arr[1];
	
	// 파일을 정해진 저장 디렉토리에 저장
	$filename_real = $filename;
	$res = move_uploaded_file($file_tmp,$path.$filename_real);
	
	$upload_result = array();
	if ($res == true) {
		$upload_result['code'] = 200;
		$upload_result['name'] = $filename;
	} else {
		$upload_result['code'] = 301;
		$upload_result['msg'] = "배너 이미지/동영상 업로드 처리중 오류가 발생했습니다.";
	}
	
	return $upload_result;
}
?>