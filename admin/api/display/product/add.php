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

$page_title             = $_POST['page_title'];           	//페이지 타이틀
$page_memo		        = $_POST['page_memo'];     			//페이지 비고

$display_member_level	= $_POST['display_member_level'];	//접근제한 타입
$member_level           = $_POST['member_level'];          	//접근대상 LEVEL LIST
$prodIp                 = $_POST['prodIp'];             	//차단 IP LIST

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

$table = " dev.PAGE_PRODUCT_DISPLAY ";

//제한등급 문자열 생성
$display_level = "";
if($display_member_level != null){
    switch($display_member_level){
        case 'all':
            $display_level = 'all';
            break;
        
		case 'member':
			$display_level = 'member';
            break;
        
		case 'level':
			if ($member_level != null) {
				$display_level = implode(',',$member_level);
			}
            break;
    }
}

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

//상품 진열 페이지 등록
$db->query("SHOW TABLE STATUS WHERE NAME='PAGE_PRODUCT_DISPLAY'");
$max_idx = 0;
foreach($db->fetch() as $data) {
	$max_idx = intval($data['Auto_increment']);
}

$sql = "
	INSERT INTO ".$table." (
		PAGE_TITLE,
		PAGE_MEMO,
		PAGE_URL,
		DISPLAY_MEMBER_LEVEL,
		DISPLAY_FLG,
		DISPLAY_START_DATE,
		DISPLAY_END_DATE,

		SEO_EXPOSURE_FLG,
		SEO_TITLE,
		SEO_AUTHOR,
		SEO_DESCRIPTION,
		SEO_KEYWORDS,
		
		CREATE_DATE,
		CREATER,
		UPDATE_DATE,
		UPDATER
	)
	VALUES (
		'".$page_title."',
		'".$page_memo."',
		CONCAT(
			'/test/page/product?page_idx=',
			".$max_idx."
		),
		'".$display_level."',
		FALSE,
		".$display_start_date.",
		'".$display_end_date."',
		".$seo_exposure_flg.",
		'".$seo_title."',
		'".$seo_author."',
		'".$seo_description."',
		'".$seo_keywords."',
		NOW(),
		'Admin',
		NOW(),
		'Admin'
	)
";

$db->query($sql);

if($db){
	$db->query("SELECT LAST_INSERT_ID() AS IDX");
	foreach($db->fetch() as $data){
		$page_idx = $data['IDX'];
	}
}

//새롭게 등록된 페이지 IDX를 기반으로
//차단 IP등록
$table = " dev.IP_BAN ";
foreach($prodIp as $ip){
	$sql = "INSERT INTO dev.IP_BAN
			(
				PAGE_IDX,
				IP
			) VALUES (
				".$page_idx.",
				'".$ip."'
			)
	";
	$db->query($sql);
}
?>