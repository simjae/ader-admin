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

include_once("/var/www/admin/api/common/common.php");

$session_id				= sessionCheck();
$page_title         	= $_POST['page_title'];				//페이지 타이틀
$page_memo     			= $_POST['page_memo'];				//페이지 비고

$member_level           = $_POST['member_level'];          	//접근대상 LEVEL LIST
$prodIp					= $_POST['prodIp'];             	//차단 IP LIST

$display_flg            = $_POST['display_flg'];        	//진열 플래그
$display_from     		= $_POST['display_from'];			//진열 시작일
$display_from_h     	= $_POST['display_from_h'];			//진열 시작시간 (시간)
$display_from_m     	= $_POST['display_from_m'];			//진열 시작시간 (분)
$display_to       		= $_POST['display_to'];				//진열 종료일
$display_to_h     		= $_POST['display_to_h'];			//진열 종료시간 (시간)
$display_to_m     		= $_POST['display_to_m'];			//진열 종료시간 (분)

$seo_exposure_flg		= $_POST['seo_exposure_flg'];		//검색엔진 노출 플래그
$seo_title				= $_POST['seo_title'];				//브라우저 타이틀
$seo_author				= $_POST['seo_author'];				//메타태그1
$seo_description		= $_POST['seo_description'];		//메타태그2
$seo_keywords			= $_POST['seo_keywords'];			//메타태그3
$seo_alt_text			= $_POST['seo_alt_text'];			//메타태그4

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

if ($member_level != null) {
	$member_level = implode(",",$member_level);
} else {
	$member_level = "0";
}

$insert_page_product_sql = "
	INSERT INTO
		PAGE_PRODUCT
	(
		PAGE_TITLE,
		PAGE_MEMO,
		PAGE_URL,
		DISPLAY_MEMBER_LEVEL,
		DISPLAY_START_DATE,
		DISPLAY_END_DATE,
		SEO_EXPOSURE_FLG,
		SEO_TITLE,
		SEO_AUTHOR,
		SEO_DESCRIPTION,
		SEO_KEYWORDS,
		SEO_ALT_TEXT,
		CREATER,
		UPDATER
	) VALUES (
		'".$page_title."',
		'".$page_memo."',
		'/product/list?page_idx=',
		'".$member_level."',
		'".$display_start_date."',
		'".$display_end_date."',
		".$seo_exposure_flg.",
		'".$seo_title."',
		'".$seo_author."',
		'".$seo_description."',
		'".$seo_keywords."',
		'".$seo_alt_text."',
		'".$session_id."',
		'".$session_id."'
	)
";

$db->query($insert_page_product_sql);

$page_idx = $db->last_id();

if (!empty($page_idx)) {
	foreach($prodIp as $ip){
		$insert_ip_sql = "
			INSERT INTO
				IP_BAN
			(
				PAGE_IDX,
				IP
			) VALUES (
				".$page_idx.",
				'".$ip."'
			)
		";
		
		$db->query($insert_ip_sql);
	}
}

?>