<?php
/*
 +=============================================================================
 | 
 | 상품 진열 페이지 - 페이지 정보 수정
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

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

/** 변수 정리 **/
$session_id				= sessionCheck();
$copy_flg				= $_POST['copy_flg'];
$display_toggle_flg		= $_POST['display_toggle_flg'];
$update_flg				= $_POST['update_flg'];

$page_idx				= $_POST['page_idx'];

$page_title         	= $_POST['page_title'];				//페이지 타이틀
$page_memo     			= $_POST['page_memo'];				//페이지 비고

$display_member_level	= $_POST['display_member_level'];
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

if ($copy_flg != null && $page_idx != null) {
	try {
		for ($i=0; $i<count($page_idx); $i++) {
			$copy_page_product_sql = "
				INSERT INTO
					PAGE_PRODUCT
				(
					BANNER_IDX,
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
				)
				SELECT
					PP.BANNER_IDX				AS BANNER_IDX,
					CONCAT(
						PP.PAGE_TITLE,'_copy'
					)							AS PAGE_TITLE,
					PP.PAGE_MEMO				AS PAGE_MEMO,
					PP.PAGE_URL					AS PAGE_URL,
					PP.DISPLAY_MEMBER_LEVEL		AS DISPLAY_MEMBER_LEVEL,
					PP.DISPLAY_START_DATE		AS DISPLAY_START_DATE,
					PP.DISPLAY_END_DATE			AS DISPLAY_END_DATE,
					PP.SEO_EXPOSURE_FLG			AS SEO_EXPOSURE_FLG,
					PP.SEO_TITLE				AS SEO_TITLE,
					PP.SEO_AUTHOR				AS SEO_AUTHOR,
					PP.SEO_DESCRIPTION			AS SEO_DESCRIPTION,
					PP.SEO_KEYWORDS				AS SEO_KEYWORDS,
					PP.SEO_ALT_TEXT				AS SEO_ALT_TEXT,
					PP.CREATER					AS CREATER,
					PP.UPDATER					AS UPDATER
				FROM
					PAGE_PRODUCT PP
				WHERE
					IDX = ".$page_idx[$i]."
			";
			
			$db->query($copy_page_product_sql);
			
			$tmp_page_idx = $db->last_id();
			
			if (!empty($tmp_page_idx)) {
				$insert_product_grid_sql = "
					INSERT INTO
						PRODUCT_GRID
					(
						PAGE_IDX,
						DISPLAY_NUM,
						TYPE,
						BACKGROUND_COLOR,
						SIZE,
						BANNER_IDX,
						PRODUCT_IDX,
						PRODUCT_CODE,
						LINK_URL,
						CREATE_DATE,
						CREATER,
						UPDATE_DATE,
						UPDATER
					)
					SELECT
						".$tmp_page_idx."		AS PAGE_IDX,
						PG.DISPLAY_NUM			AS DISPLAY_NUM,
						PG.TYPE					AS TYPE,
						PG.BACKGROUND_COLOR		AS BACKGROUND_COLOR,
						PG.SIZE					AS SIZE,
						PG.BANNER_IDX			AS BANNER_IDX,
						PG.PRODUCT_IDX			AS PRODUCT_IDX,
						PG.PRODUCT_CODE			AS PRODUCT_CODE,
						PG.LINK_URL				AS LINK_URL,
						PG.CREATE_DATE			AS CREATE_DATE,
						PG.CREATER				AS CREATER,
						PG.UPDATE_DATE			AS UPDATE_DATE,
						PG.UPDATER				AS UPDATER
					FROM
						PRODUCT_GRID PG
					WHERE
						PG.PAGE_IDX = ".$page_idx[$i]." AND
						PG.DEL_FLG = FALSE
				";
				
				$db->query($insert_product_grid_sql);
			}
		}
	} catch(mysqli_sql_exception $exception){
		$db->rollback();
		
		print_r($exception);
		$json_result['code'] = 301;
		$json_result['msg'] = "상품 진열정보 저장처리중 에러가 발생했습니다. 진열 하려는 상품의 진열정보를 확인해주세요.";
	}
}

if ($display_toggle_flg != null && $page_idx != null) {
	$display_page_product_sql = "
		UPDATE
			PAGE_PRODUCT
		SET
			DISPLAY_FLG = ".$display_flg."
		WHERE
			IDX IN (".implode(",",$page_idx).")
	";
	
	$db->query($display_page_product_sql);
}

if ($update_flg != null && $page_idx != null) {
	$display_start_date = "";
	$display_end_date = "";
	
	if($display_flg != null){
		if ($display_flg == "true") {
			$display_start_date = "NOW()";
			$display_end_date = "9999-12-31 23:59";
		} else {
			$display_start_date = $display_from." ".$display_from_h.":".$display_from_m;
			$display_end_date = $display_to." ".$display_to_h.":".$display_to_m;
		}
	}
	
	if($display_member_level == 'all'){
		$member_level = "0";
	}
	else{
		if ($member_level != null) {
			$member_level = implode(",",$member_level);
		} else {
			$member_level = "0";
		}
	}
	
	
	$update_page_product_sql = "
		UPDATE
			PAGE_PRODUCT
		SET
			PAGE_TITLE					= '".$page_title."',
			PAGE_MEMO					= '".$page_memo."',
			DISPLAY_MEMBER_LEVEL		= '".$member_level."',
			DISPLAY_START_DATE			= '".$display_start_date."',
			DISPLAY_END_DATE			= '".$display_end_date."',
			SEO_EXPOSURE_FLG			= ".$seo_exposure_flg.",
			SEO_TITLE					= '".$seo_title."',
			SEO_AUTHOR					= '".$seo_author."',
			SEO_DESCRIPTION				= '".$seo_description."',
			SEO_KEYWORDS				= '".$seo_keywords."',
			UPDATE_DATE					= NOW(),
			UPDATER						= '".$session_id."'
		WHERE
			IDX = ".$page_idx."
	";
	
	$db->query($update_page_product_sql);
}

?>