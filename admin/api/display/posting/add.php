<?php
/*
 +=============================================================================
 | 
 | 게시물 관리 - 게시물 등록
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

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

include_once("/var/www/admin/api/common/common.php");

$session_id			= sessionCheck();

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
$seo_description 	= str_replace("<p>&nbsp;</p>","",$seo_description);
$seo_keywords		= $_POST['seo_keywords'];			//메타태그3
$seo_alt_text		= $_POST['seo_alt_text'];			//메타태그4
$seo_alt_text 		= str_replace("<p>&nbsp;</p>","",$seo_alt_text);

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

$url = "";
switch ($posting_type) {
	case "EDTL" :
		$url = "editorial";
		break;
	
	case "RNWY" :
		$url = "runway";
		break;
	
	case "COLC" :
		$url = "collection";
		break;
	
	case "COLA" :
		$url = "collaboration";
		break;
}

if ($posting_type != null && $page_title != null && $display_start_date != null && $display_end_date != null) {
	try {
		$insert_page_posting_sql = "
			INSERT INTO
				PAGE_POSTING
			(
				COUNTRY,
				POSTING_TYPE,
				PAGE_TITLE,
				PAGE_URL,
				PAGE_MEMO,

				DISPLAY_FLG,
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
			VALUES (
				'".$country."',
				'".$posting_type."',
				'".$page_title."',
				'/posting/".$url."/detail?page_idx=',
				'".$page_memo."',
				
				FALSE,
				".$display_start_date.",
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

		$db->query($insert_page_posting_sql);
		
		$page_idx = $db->last_id();
		
		if (!empty($page_idx) && $posting_type == "COLA") {
			$insert_collaboration_sql = "
				INSERT INTO
					POSTING_COLLABORATION
				(
					PAGE_IDX,
					DISPLAY_NUM,
					CREATER,
					UPDATER
				)
				SELECT
					PP.IDX		AS PAGE_IDX,
					(
						SELECT
							(MAX(DISPLAY_NUM) + 1)
						FROM
							POSTING_COLLABORATION
						WHERE
							COUNTRY = '".$country."'
					)					AS DISPLAY_NUM,
					'".$session_id."'	AS CREATER,
					'".$session_id."'	AS UPDATER
				FROM
					PAGE_POSTING PP
				WHERE
					PP.IDX = ".$page_idx."
			";
			
			$db->query($insert_collaboration_sql);
		}
		
		$db->commit();
		
	} catch (mysqli_sql_exception $exception) {
		$db->rollback();
		
		print_r($exception);
		
		$json_result['code'] = 301;
		$json_result['msg'] = '게시물 작성 중 오류가 발생했습니다.';
		
		return $json_result;
	}
}

?>