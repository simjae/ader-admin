<?php
/*
 +=============================================================================
 | 
 | 배너 관리 페이지 - 베너 등록
 | -----------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2023.01.03
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

include_once("/var/www/admin/api/common/common.php");

$session_id			= sessionCheck();
$banner_type		= $_POST['banner_type'];

$banner_title		= $_POST['banner_title'];
$banner_memo		= $_POST['banner_memo'];

$banner_thumb		= $_FILES['banner_thumb'];
$banner_img			= $_FILES['banner_img'];
$banner_vid			= $_FILES['banner_vid'];
$vid_preview		= $_FILES['vid_preview'];

$location_start		= $_POST['location_start'];
$location_end		= $_POST['location_end'];
$clip_info			= json_decode($_POST['clip_info']);

if ($banner_type != null) {
	$thumb_filename = null;
	$banner_filename = null;
	
	$path = "/var/www/admin/www/";
	
	$banner_table = null;
	$clip_table = null;
	
	$file_type = null;
	$banner_file = null;
	$preview_file = null;
	
	$preview_location = null;
	
	$dir_banner = null;
	$dir_thumb = null;
	
	$head_clip_sql = array();
	
	switch ($banner_type) {
		case "HED" :
			$banner_table = "BANNER_HEAD";
			
			$file_type = $banner_type;
			$banner_file = $banner_img;
			
			$dir_banner = "images/banner/head/";
			$dir_thumb = "head/";
			
			$head_clip_sql[0] = " LOCATION_START,  ";
			$head_clip_sql[2] = " ".$location_start.", ";
			
			$head_clip_sql[1] = " LOCATION_END ,";
			$head_clip_sql[3] = " ".$location_end.", ";
			break;
		
		case "IMG" :
			$banner_table = "BANNER_IMG";
			$clip_table = "BANNER_IMG_CLIP";
			
			$file_type = $banner_type;
			$banner_file = $banner_img;
			
			$dir_banner = "images/banner/img/";
			$dir_thumb = "img/";
			break;
		
		case "VID" :
			$banner_table = "BANNER_VID";
			$clip_table = "BANNER_VID_CLIP";
			
			$preview_location = $path."images/banner/vid/";
			
			$file_type = $banner_type;
			$banner_file = $banner_vid;
			$preview_file = $vid_preview;
			
			$dir_banner = "videos/banner/";
			$dir_thumb = "vid/";
			break;
	}
	
	$thumb_location = $path."images/banner/thumbnail/".$dir_thumb;
	$banner_location = $path.$dir_banner;
	
	$upload_result = array();
	
	$thumb_filename = null;
	if ($banner_thumb['size'] > 0) {
		$upload_result = uploadBannerFile($thumb_location,$file_type,$banner_thumb);
		if ($upload_result['code'] == 200) {
			$thumb_filename = $upload_result['name'];
		}
	}
	
	$preview_filename = null;
	$banner_preview_sql = array();
	if ($banner_type == "VID") {
		if ($preview_file['size'] > 0) {
			$upload_result = uploadBannerFile($preview_location,"PRE",$preview_file);
			if ($upload_result['code'] == 200) {
				$preview_filename = $upload_result['name'];
			}
		}
	}
	
	if ($preview_filename != null) {
		$banner_preview_sql[0] = " BANNER_PREVIEW, ";
		$banner_preview_sql[1] = " '".$preview_location.$preview_filename."', ";
	}
	
	$banner_filename = null;
	if ($banner_file['size'] > 0) {
		$upload_result = uploadBannerFile($banner_location,$file_type,$banner_file);
		if ($upload_result['code'] == 200) {
			$banner_filename = $upload_result['name'];
		}
	}
	
	if (
		($banner_type != "VID" && $thumb_filename != null && $banner_filename != null) ||
		($banner_type == "VID" && $thumb_filename != null && $preview_filename != null && $banner_filename != null)
	) {
		try {
		
			$banner_width_sql = array();
			$banner_height_sql = array();
			
			$insert_banner_sql = "
				INSERT INTO
					".$banner_table."
				(
					BANNER_TITLE,
					BANNER_MEMO,
					BANNER_THUMBNAIL,
					BANNER_LOCATION,
					".$banner_preview_sql[0]."
					".$head_clip_sql[0]."
					".$head_clip_sql[1]."
					CREATER,
					UPDATER
				) VALUES (
					'".$banner_title."',
					'".$banner_memo."',
					'".$thumb_location.$thumb_filename."',
					'".$banner_location.$banner_filename."',
					".$banner_preview_sql[1]."
					".$head_clip_sql[2]."
					".$head_clip_sql[3]."
					'".$session_id."',
					'".$session_id."'
				)
			";
			
			$db->query($insert_banner_sql);
			
			$banner_idx = $db->last_id();
			
			if (!empty($banner_idx) && strlen($clip_table) > 0 && $clip_info != null) {
				for ($i=0; $i<count($clip_info); $i++) {
					$insert_clip_sql = "
						INSERT INTO
							".$clip_table."
						(
							BANNER_IDX,
							CLIP_TYPE,
							LOCATION_START,
							LOCATION_END
						) VALUES (
							".$banner_idx.",
							'".$clip_info[$i][0]."',
							".$clip_info[$i][1].",
							".$clip_info[$i][2]."
						)
					";
					
					$db->query($insert_clip_sql);
				}
			}
			
			$db->commit();
		} catch(mysqli_sql_exception $exception){
			unlink($thumb_location.$thumb_filename);
			unlink($thumb_location.$banner_filename);
			
			$db->rollback();
			
			$json_result['code'] = 301;
			$msg = "배너 동영상 등록에 실패했습니다.";
		}
	} else {
		$json_result['code'] = 301;
		$msg = "파일 업로드처리에 실패했습니다. 등록하려는 동영상파일을 확인해주세요.";
	}
}

function uploadBannerFile($path,$file_type,$file) {
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
	if ($file_type != "VID") {
		$filename = "banner_".$file_type."_".$filename_arr[0].'_'.time().".".$filename_arr[1];
	} else {
		$filename = "banner_".$file_type."_".$filename_arr[0].'_'.time().".".$filename_arr[1];
	}
	
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