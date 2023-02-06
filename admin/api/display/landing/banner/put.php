<?php
/*
 +=============================================================================
 | 
 | 랜딩페이지 관리 - 메인_배너 정보 수정
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

$main_banner		= $_FILES['main_banner'];

$display_num_flg	= $_POST['display_num_flg'];

$country			= $_POST['country'];
$action_type		= $_POST['action_type'];
$recent_idx			= $_POST['recent_idx'];
$recent_num			= $_POST['recent_num'];

$banner_idx			= $_POST['banner_idx'];
$title				= $_POST['title'];
$sub_title			= $_POST['sub_title'];
$background_color	= $_POST['background_color'];
$btn1_name			= $_POST['btn1_name'];
$btn1_url			= $_POST['btn1_url'];
$btn1_display_flg	= $_POST['btn1_display_flg'];
$btn2_name			= $_POST['btn2_name'];
$btn2_url			= $_POST['btn2_url'];
$btn2_display_flg	= $_POST['btn2_display_flg'];

if ($display_num_flg != null && $action_type != null) {
	$prev_sql = "";
	$sql = "";
	
	switch ($action_type) {
		case "up" :
			$prev_sql = "
				UPDATE
					dev.MAIN_BANNER
				SET
					DISPLAY_NUM = ".$recent_num.",
					UPDATE_DATE = NOW(),
					UPDATER = '".$session_id."
				WHERE
					COUNTRY = '".$country."' AND
					DISPLAY_NUM = ".intval($recent_num - 1)." AND
					DEL_FLG = FALSE
			";
			
			$sql = "
				UPDATE
					dev.MAIN_BANNER
				SET
					DISPLAY_NUM = ".intval($recent_num - 1).",
					UPDATE_DATE = NOW(),
					UPDATER = '".$session_id."
				WHERE
					IDX = ".$recent_idx." AND
					COUNTRY = '".$country."' AND
					DEL_FLG = FALSE
			";
			
			break;
		
		case "down" :
			$prev_sql = "
				UPDATE
					dev.MAIN_BANNER
				SET
					DISPLAY_NUM = ".$recent_num.",
					UPDATE_DATE = NOW(),
					UPDATER = '".$session_id."
				WHERE
					COUNTRY = '".$country."' AND
					DISPLAY_NUM = ".intval($recent_num + 1)." AND
					DEL_FLG = FALSE
			";
			
			$sql = "
				UPDATE
					dev.MAIN_BANNER
				SET
					DISPLAY_NUM = ".intval($recent_num + 1).",
					UPDATE_DATE = NOW(),
					UPDATER = '".$session_id."
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

if ($banner_idx != null) {
	$path = "/var/www/admin/www/images/main/banner";	
	$img_location_sql = "";
	
	if ($main_banner['size'] > 0) {
		$upload_result = uploadMainBanner($path,$main_banner);
		
		if ($upload_result['code'] == 200) {
			$img_filename = $upload_result['name'];
			
			$img_location_sql = " IMG_LOCATION = '".$path.$img_filename."', ";
		}
	}
	
	$update_banner_sql = "
		UPDATE
			dev.MAIN_BANNER
		SET
			".$img_location_sql."
			TITLE = '".$title."',
			SUB_TITLE = '".$sub_title."',
			BTN1_NAME = '".$btn1_name."',
			BTN1_URL = '".$btn1_url."',
			BTN1_DISPLAY_FLG = ".$btn1_display_flg.",
			BTN2_NAME = '".$btn2_name."',
			BTN2_URL = '".$btn2_url."',
			BTN2_DISPLAY_FLG = ".$btn2_display_flg.",
			UPDATE_DATE = NOW(),
			UPDATER = '".$session_id."'
		WHERE
			IDX = ".$banner_idx."
	";
	
	$db->query($update_banner_sql);
}

function uploadMainBanner($path,$file) {
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