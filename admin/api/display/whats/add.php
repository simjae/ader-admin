<?php
/*
 +=============================================================================
 | 
 | 상품 목록 페이지 등록
 | -----------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.07.25
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$country            = $_POST['country'];			//국가
$page_title         = $_POST['page_title'];			//페이지 타이틀
$page_title			= str_replace("'","\'",$page_title);
$page_sub_title     = $_POST['page_sub_title'];		//페이지 서브 타이틀
$page_sub_title		= str_replace("'","\'",$page_sub_title);
$page_url			= $_POST['page_url'];			//페이지 URL
$thumbnail_url      = $_POST['thumbnail_url'];		//썸네일 URL
$page_memo			= $_POST['page_memo'];			//페이지 비고
$page_memo			= str_replace("'","\'",$page_memo);
$page_content		= $_POST['page_content'];		//페이지 내용
$page_content		= str_replace("'","\'",$page_content);
$page_content		= str_replace("<p>&nbsp;</p>","",$page_content);

$display_flg		= $_POST['display_flg'];
$display_from     	= $_POST['display_from'];		//표시 시작일
$display_from_h     = $_POST['display_from_h'];		//표시 시작일 (시간)
$display_from_m     = $_POST['display_from_m'];		//표시 시작일 (분)
$display_to       	= $_POST['display_to'];			//표시 종료일
$display_to_h     	= $_POST['display_to_h'];		//표시 종료일 (시간)
$display_to_m     	= $_POST['display_to_m'];		//표시 종료일 (분)

$seo_exposure_flg	= $_POST['seo_exposure_flg'];
$seo_title			= $_POST['seo_title'];
$seo_author			= $_POST['seo_author'];
$seo_description	= $_POST['seo_description'];
$seo_keywords		= $_POST['seo_keywords'];

$table = " dev.PAGE_WHATS_NEW ";

$display_start_date = "";
$display_end_date = "";
if($display_flg != null){
	if ($display_flg == "true") {
		$display_start_date = "NOW()";
		$display_end_date = "9999-12-31 23:59";
	} else {
		$display_start_date = "'".$display_from." ".$display_from_h.":".$display_from_m."'";
		$display_end_date = $display_to." ".$display_to_h.":".$display_to_m;
	}
}

//WHAT'S NEW 페이지 등록
$db->query("SHOW TABLE STATUS WHERE NAME='PAGE_WHATS_NEW'");
$max_idx = 0;
foreach($db->fetch() as $data) {
	$max_idx = intval($data['Auto_increment']);
}

$sql = "
	INSERT INTO ".$table." (
		COUNTRY,
		PAGE_TITLE,
		PAGE_SUB_TITLE,
		PAGE_MEMO,
		PAGE_URL,
		THUMBNAIL_URL,
		PAGE_CONTENT,

		DISPLAY_FLG,
		DISPLAY_START_DATE,
		DISPLAY_END_DATE,
		
		SEO_EXPOSURE_FLG,
		SEO_TITLE,
		SEO_AUTHOR,
		SEO_DESCRIPTION,
		SEO_KEYWORDS,

		CREATER,
		UPDATER
	)
	VALUES (
		'".$country."',
		'".$page_title."',
		'".$page_sub_title."',
		'".$page_memo."',
		CONCAT(
			'/test/page/whats?page_idx=',
			".$max_idx."
		),
		'".$thumbnail_url."',
		'".$page_content."',

		FALSE,
		".$display_start_date.",
		'".$display_end_date."',

		".$seo_exposure_flg.",
		'".$seo_title."',
		'".$seo_author."',
		'".$seo_description."',
		'".$seo_keywords."',

		'Admin',
		'Admin'
	)";

$db->query($sql);

$whats_new_idx = $db->last_id();

if (!empty($whats_new_idx)) { 
	
	$img_path = "/var/www/admin/www/images/display/whats/";
	if($_FILES['img_thumbnail']['size'] > 0) {
		$file_name_arr = explode('.',$_FILES['img_thumbnail']['name']);
		$ext = $file_name_arr[1];
		
		$_FILES['img_thumbnail']['name'] = "img_whats_".$whats_new_idx.".".$ext;
		$upload_file = file_up('img_thumbnail',$img_path); // 이미지 업로드
		if ($upload_file != null) {
			for ($i=0; $i<count($upload_file); $i++) {
				$img_sql = "INSERT INTO
							dev.PAGE_IMG_WHATS_NEW
							(
								WHATS_NEW_IDX,
								IMG_TYPE,
								IMG_SIZE,
								IMG_LOCATION,
								IMG_URL,
								DEL_FLG,
								CREATE_DATE,
								CREATER,
								UPDATE_DATE,
								UPDATER
							)
							VALUES
							(
								".$whats_new_idx.",
								'main',
								'".$upload_file[$i]['img_size']."',
								'".$img_path.$upload_file[$i]['filename']."',
								'".$img_path.$upload_file[$i]['filename']."',
								FALSE,
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
?>