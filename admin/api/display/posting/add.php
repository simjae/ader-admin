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

$posting_type       = $_POST['posting_type'];           //포스팅 타입
$country      		= $_POST['country'];				//국가
$page_title         = $_POST['page_title'];           	//페이지 타이틀
$page_title			= str_replace("'","\'",$page_title);
$page_memo     		= $_POST['page_memo'];         		//페이지 메모
$page_memo			= str_replace("'","\'",$page_memo);

$display_flg        = $_POST['display_flg'];        	//전시 플래그
$display_from     	= $_POST['display_from'];			//전시 시작일
$display_from_h     = $_POST['display_from_h'];			//전시 시작일 (시간)
$display_from_m     = $_POST['display_from_m'];			//전시 시작일 (분)
$display_to       	= $_POST['display_to'];			    //전시 종료일
$display_to_h     	= $_POST['display_to_h'];			//전시 종료일 (시간)
$display_to_m     	= $_POST['display_to_m'];			//전시 종료일 (분)

$seo_exposure_flg	= $_POST['seo_exposure_flg'];		//검색엔진 노출 플래그
$seo_title			= $_POST['seo_title'];				//브라우저 타이틀
$seo_author			= $_POST['seo_author'];				//메타태그1
$seo_description	= $_POST['seo_description'];		//메타태그2
$seo_keywords		= $_POST['seo_keywords'];			//메타태그3
$seo_alt_text		= $_POST['seo_alt_text'];			//메타태그4

$table = " dev.PAGE_POSTING ";

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

//포스팅 페이지 등록
$db->query("SHOW TABLE STATUS WHERE NAME='PAGE_POSTING'");
$max_idx = 0;
foreach($db->fetch() as $data) {
	$max_idx = intval($data['Auto_increment']);
}

$sql = "
	INSERT INTO ".$table." (
		POSTING_TYPE,
		PAGE_TITLE,
		PAGE_MEMO,
		PAGE_URL,
		COUNTRY,

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
		'".$posting_type."',
		'".$page_title."',
		'".$page_memo."',
		CONCAT(
			'/test/page/posting?page_idx=',
			".$max_idx."
		),
		'".$country."',

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
	)
";
$db->query($sql);
?>