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
$page_idx			= $_POST['page_idx'];
$tmp_flg			= $_POST['tmp_flg'];

$prvs_img_main		= $_POST['prvs_img_main'];
$prvs_img_brand		= $_POST['prvs_img_brand'];
$prvs_img_logo		= $_POST['prvs_img_logo'];
$prvs_img_mouseover	= $_POST['prvs_img_mouseover'];

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

$collaboration_date_arr = array();
$collaboration_date				= $_POST['collaboration_date'];
if ($collaboration_date != null) {
	$collaboration_date_arr[0] = " COLLABORATION_DATE, ";
	$collaboration_date_arr[1] = "'".$collaboration_date."',";
}

$collaboration_title_arr = array();
$collaboration_title			= $_POST['collaboration_title'];
if ($collaboration_title != null) {
	$collaboration_title_arr[0] = " COLLABORATION_TITLE, ";
	$collaboration_title_arr[1] = "'".$collaboration_title."',";
}

$collaboration_description_arr = array();
$collaboration_description		= $_POST['collaboration_description'];
$collaboration_description = str_replace("<p>&nbsp;</p>","",$collaboration_description);
if ($collaboration_description != null) {
	$collaboration_description_arr[0] = " COLLABORATION_DESCRIPTION, ";
	$collaboration_description_arr[1] = "'".$collaboration_description."',";
}

$collaboration_script_arr = array();
$collaboration_script			= $_POST['collaboration_script'];
if ($collaboration_script != null) {
	$collaboration_script_arr[0] = " COLLABORATION_SCRIPT, ";
	$collaboration_script_arr[1] = "'".$collaboration_script."',";
}

$collaboration_video_url_arr = array();
if ($_FILES['collaboration_video']['size'] > 0) {
	$video_path = "/var/www/admin/www/video/display/collaboration/";
	
	$file_name_arr = explode('.',$_FILES['collaboration_video']['name']);
	$ext = $file_name_arr[1];
	
	$file_tmp = $_FILES['collaboration_video']['tmp_name'];
	
	$_FILES['collaboration_video']['name'] = "video_collaboration_".time().".".$ext;
	$file_name = $_FILES['collaboration_video']['name'];
	
	$res = move_uploaded_file($file_tmp,$video_path.$file_name);
	
	if ($res == true) { 
		$collaboration_video_url_arr[0] = " COLLABORATION_VIDEO_URL, ";
		$collaboration_video_url_arr[1] = "'".$video_path.$file_name."', ";
	}
} else {
	if ($prvs_video != null) {
		$collaboration_video_url_arr[0] = " COLLABORATION_VIDEO_URL, ";
		$collaboration_video_url_arr[1] = "'".$prvs_video."', ";
	}
}

$btn_product_top_display_flg_arr = array();
$btn_product_top_text_arr = array();
$btn_product_top_url_arr = array();

$btn_product_top_display_flg	= $_POST['btn_product_top_display_flg'];
if ($btn_product_top_display_flg != null) {
	$btn_product_top_display_flg_arr[0] = " BTN_PRODUCT_TOP_DISPLAY_FLG, ";
	$btn_product_top_display_flg_arr[1] = $btn_product_top_display_flg.",";
	
	if ($btn_product_top_display_flg == "true") {
		$btn_product_top_text			= $_POST['btn_product_top_text'];
		if ($btn_product_top_text != null) {
			$btn_product_top_text_arr[0] = " BTN_PRODUCT_TOP_TEXT, ";
			$btn_product_top_text_arr[1] = "'".$btn_product_top_text."',";
		}

		$btn_product_top_url			= $_POST['btn_product_top_url'];
		if ($btn_product_top_url != null) {
			$btn_product_top_url_arr[0] = " BTN_PRODUCT_TOP_URL, ";
			$btn_product_top_url_arr[1] = "'".$btn_product_top_url."',";
		}
	}
}

$btn_product_bot_display_flg_arr = array();
$btn_product_bot_text_arr = array();
$btn_product_bot_url_arr = array();

$btn_product_bot_display_flg	= $_POST['btn_product_bot_display_flg'];
if ($btn_product_bot_display_flg != null) {
	$btn_product_bot_display_flg_arr[0] = " BTN_PRODUCT_BOT_DISPLAY_FLG, ";
	$btn_product_bot_display_flg_arr[1] = $btn_product_bot_display_flg.",";
	
	if ($btn_product_bot_display_flg == "true") {
		$btn_product_bot_text			= $_POST['btn_product_bot_text'];
		if ($btn_product_bot_text != null) {
			$btn_product_bot_text_arr[0] = " BTN_PRODUCT_BOT_TEXT, ";
			$btn_product_bot_text_arr[1] = "'".$btn_product_bot_text."',";
		}

		$btn_product_bot_url			= $_POST['btn_product_bot_url'];
		if ($btn_product_bot_url != null) {
			$btn_product_bot_url_arr[0] = " BTN_PRODUCT_BOT_URL, ";
			$btn_product_bot_url_arr[1] = "'".$btn_product_bot_url."',";
		}
	}
}

$btn_video_display_flg_arr = array();
$btn_video_text_arr = array();

$btn_video_display_flg			= $_POST['btn_video_display_flg'];
if ($btn_video_display_flg != null) {
	$btn_video_display_flg_arr[0] = " BTN_VIDEO_DISPLAY_FLG, ";
	$btn_video_display_flg_arr[1] = $btn_video_display_flg.",";
	
	if ($btn_video_display_flg == "true") {
		$btn_video_text			= $_POST['btn_video_text'];
		if ($btn_video_text != null) {
			$btn_video_text_arr[0] = " BTN_VIDEO_TEXT, ";
			$btn_video_text_arr[1] = "'".$btn_video_text."',";
		}
	}
}

$btn_img_display_flg_arr = array();
$btn_img_text_arr = array();
$btn_img_url_arr = array();

$btn_img_display_flg			= $_POST['btn_img_display_flg'];
if ($btn_img_display_flg != null) {
	$btn_img_display_flg_arr[0] = " BTN_IMG_DISPLAY_FLG, ";
	$btn_img_display_flg_arr[1] = $btn_img_display_flg.",";
	
	if ($btn_img_display_flg == "true") {
		$btn_img_text					= $_POST['btn_img_text'];
		if ($btn_img_text != null) {
			$btn_img_text_arr[0] = " BTN_IMG_TEXT, ";
			$btn_img_text_arr[1] = "'".$btn_img_text."',";
		}

		$btn_img_url					= $_POST['btn_img_url'];
		if ($btn_img_url != null) {
			$btn_img_url_arr[0] = " BTN_IMG_URL, ";
			$btn_img_url_arr[1] = "'".$btn_img_url."',";
		}
	}
}

$collaboration_img_script_arr = array();
$collaboration_img_script		= $_POST['collaboration_img_script'];
if ($collaboration_img_script != null) {
	$collaboration_img_script_arr[0] = " COLLABORATION_IMG_SCRIPT, ";
	$collaboration_img_script_arr[1] = "'".$collaboration_img_script."',";
}

$collaboration_product_arr = array();
$collaboration_product_idx = $_POST['collaboration_product'];
if ($collaboration_product != null) {
	$collaboration_product_arr[0] = " COLLABORATION_PRODUCT, ";
	$collaboration_product_arr[1] = " '".implode(',',$collaboration_product)."', ";
}

$posting_sql = "INSERT INTO
					".$tbl_posting[0]."
				(
					PAGE_IDX,
					".$collaboration_date_arr[0]."
					".$collaboration_title_arr[0]."
					".$collaboration_description_arr[0]."
					".$collaboration_script_arr[0]."
					".$collaboration_video_url_arr[0]."
					
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
					
					".$collaboration_img_script_arr[0]."
					
					".$collaboration_product_arr[0]."
					
					CREATE_DATE,
					CREATER,
					UPDATE_DATE,
					UPDATER
				)
				VALUES
				(
					".$page_idx.",
					".$collaboration_date_arr[1]."
					".$collaboration_title_arr[1]."
					".$collaboration_description_arr[1]."
					".$collaboration_script_arr[1]."
					".$collaboration_video_url_arr[1]."
					
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
					
					".$collaboration_img_script_arr[1]."
					
					".$collaboration_product_arr[1]."
					
					NOW(),
					'Admin',
					NOW(),
					'Admin'
				)";
$db->query($posting_sql);

$collaboration_idx = $db->last_id();

if (!empty($collaboration_idx)) {
	
	$img_path = "/var/www/admin/www/images/display/collaboration/";
	
	if($_FILES['img_main']['size'] > 0) {
		$file_name_arr = explode('.',$_FILES['img_main']['name']);
		$ext = $file_name_arr[1];
		
		$_FILES['img_main']['name'] = "img_collaboration_main_".$collaboration_idx.".".$ext;
		$upload_file = file_up('img_main',$img_path); // 이미지 업로드
		
		if ($upload_file != null) {
			for ($i=0; $i<count($upload_file); $i++) {
				$img_sql = "INSERT INTO
								".$tbl_posting[1]."
							(
								PAGE_IDX,
								COLLABORATION_IDX,
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
								".$collaboration_idx.",
								'main',
								'".$upload_file[$i]['img_size']."',
								'".$img_path.$upload_file[$i]['filename']."',
								'".$img_path.$upload_file[$i]['filename']."',
								NOW(),
								'Admin',
								NOW(),
								'Admin'
							)";
				
				$db->query($img_sql);
			}
		} 
	} else {
		if ($prvs_img_main != null) {
			for ($i=0; $i<count($prvs_img_main); $i++) {
				if ($prvs_img_main[$i] != null) {
					$json_data_img = json_decode($prvs_img_main[$i]);
					$img_sql = "INSERT INTO
									".$tbl_posting[1]."
								(
									PAGE_IDX,
									COLLABORATION_IDX,
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
									".$collaboration_idx.",
									'".$json_data_img->img_type."',
									'".$json_data_img->img_size."',
									'".$json_data_img->img_location."',
									'".$json_data_img->img_url."',
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
	
	if($_FILES['img_brand']['size'] > 0) {
		$file_name_arr = explode('.',$_FILES['img_brand']['name']);
		$ext = $file_name_arr[1];
		
		$_FILES['img_brand']['name'] = "img_collaboration_brand_".$collaboration_idx.".".$ext;
		$upload_file = file_up('img_brand',$img_path); // 이미지 업로드
		
		if ($upload_file != null) {
			for ($i=0; $i<count($upload_file); $i++) {
				$img_sql = "INSERT INTO
								".$tbl_posting[1]."
							(
								PAGE_IDX,
								COLLABORATION_IDX,
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
								".$collaboration_idx.",
								'brand',
								'".$upload_file[$i]['img_size']."',
								'".$img_path.$upload_file[$i]['filename']."',
								'".$img_path.$upload_file[$i]['filename']."',
								NOW(),
								'Admin',
								NOW(),
								'Admin'
							)";
				
				$db->query($img_sql);
			}
		} 
	} else {
		if ($prvs_img_brand != null) {
			for ($i=0; $i<count($prvs_img_brand); $i++) {
				if ($prvs_img_brand[$i] != null) {
					$json_data_img = json_decode($prvs_img_brand[$i]);
					$img_sql = "INSERT INTO
									".$tbl_posting[1]."
								(
									PAGE_IDX,
									COLLABORATION_IDX,
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
									".$collaboration_idx.",
									'".$json_data_img->img_type."',
									'".$json_data_img->img_size."',
									'".$json_data_img->img_location."',
									'".$json_data_img->img_url."',
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
	
	if($_FILES['img_logo']['size'] > 0) {
		$file_name_arr = explode('.',$_FILES['img_logo']['name']);
		$ext = $file_name_arr[1];
		
		$_FILES['img_logo']['name'] = "img_collaboration_logo_".$collaboration_idx.".".$ext;
		$upload_file = file_up('img_logo',$img_path); // 이미지 업로드
		
		if ($upload_file != null) {
			for ($i=0; $i<count($upload_file); $i++) {
				$img_sql = "INSERT INTO
								".$tbl_posting[1]."
							(
								PAGE_IDX,
								COLLABORATION_IDX,
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
								".$collaboration_idx.",
								'logo',
								'".$upload_file[$i]['img_size']."',
								'".$img_path.$upload_file[$i]['filename']."',
								'".$img_path.$upload_file[$i]['filename']."',
								NOW(),
								'Admin',
								NOW(),
								'Admin'
							)";
						
						$db->query($img_sql);
			}
		} 
	} else {
		if ($prvs_img_logo != null) {
			for ($i=0; $i<count($prvs_img_logo); $i++) {
				if ($prvs_img_logo[$i] != null) {
					$json_data_img = json_decode($prvs_img_logo[$i]);
					$img_sql = "INSERT INTO
									".$tbl_posting[1]."
								(
									PAGE_IDX,
									COLLABORATION_IDX,
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
									".$collaboration_idx.",
									'".$json_data_img->img_type."',
									'".$json_data_img->img_size."',
									'".$json_data_img->img_location."',
									'".$json_data_img->img_url."',
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
	
	if($_FILES['img_mouseover']['size'] > 0) {
		$file_name_arr = explode('.',$_FILES['img_mouseover']['name']);
		$ext = $file_name_arr[1];
		
		$_FILES['img_mouseover']['name'] = "img_collaboration_mouseover_".$collaboration_idx.".".$ext;
		$upload_file = file_up('img_mouseover',$img_path); // 이미지 업로드
		
		if ($upload_file != null) {
			for ($i=0; $i<count($upload_file); $i++) {
				$img_sql = "INSERT INTO
								".$tbl_posting[1]."
							(
								PAGE_IDX,
								COLLABORATION_IDX,
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
								".$collaboration_idx.",
								'mouseover',
								'".$upload_file[$i]['img_size']."',
								'".$img_path.$upload_file[$i]['filename']."',
								'".$img_path.$upload_file[$i]['filename']."',
								NOW(),
								'Admin',
								NOW(),
								'Admin'
							)";
				
				$db->query($img_sql);
			}
		} 
	} else {
		if ($prvs_img_mouseover != null) {
			for ($i=0; $i<count($prvs_img_mouseover); $i++) {
				if ($prvs_img_mouseover[$i] != null) {
					$json_data_img = json_decode($prvs_img_mouseover[$i]);
					$img_sql = "INSERT INTO
									".$tbl_posting[1]."
								(
									PAGE_IDX,
									COLLABORATION_IDX,
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
									".$collaboration_idx.",
									'".$json_data_img->img_type."',
									'".$json_data_img->img_size."',
									'".$json_data_img->img_location."',
									'".$json_data_img->img_url."',
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
}
?>