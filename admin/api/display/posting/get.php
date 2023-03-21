<?php
/*
 +=============================================================================
 | 
 | 전시관리 게시물 조회 API
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.07.31
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$page_idx			= $_POST['page_idx'];

if ($page_idx != null) {
	$select_page_product_sql = "
		SELECT
			IDX					PAGE_IDX,
			COUNTRY				COUNTRY,
			POSTING_TYPE		POSTING_TYPE,
			PAGE_TITLE			PAGE_TITLE,
			PAGE_URL			PAGE_URL,
			IFNULL(
				PAGE_MEMO,
				''
			)					AS PAGE_MEMO,
			DATE_FORMAT(
				DISPLAY_START_DATE,
				'%Y-%m-%d'
			)					AS DISPLAY_START_DATE, 
			DATE_FORMAT(
				DISPLAY_START_DATE,
				'%H'
			)					AS DISPLAY_START_H, 
			DATE_FORMAT(
				DISPLAY_START_DATE,
				'%i'
			)					AS DISPLAY_START_M, 
			DATE_FORMAT(
				DISPLAY_END_DATE,
				'%Y-%m-%d'
			)					AS DISPLAY_END_DATE, 
			DATE_FORMAT(
				DISPLAY_END_DATE,
				'%H'
			)					AS DISPLAY_END_H, 
			DATE_FORMAT(
				DISPLAY_END_DATE,
				'%i'
			)					AS DISPLAY_END_M, 
			
			SEO_EXPOSURE_FLG	,
			IFNULL(
				SEO_TITLE,''
			)					AS SEO_TITLE,
			IFNULL(
				SEO_AUTHOR,''
			)					AS SEO_AUTHOR,
			IFNULL(
				SEO_DESCRIPTION,''
			)					AS SEO_DESCRIPTION,
			IFNULL(
				SEO_KEYWORDS,''
			)					AS SEO_KEYWORDS,
			IFNULL(
				SEO_ALT_TEXT,''
			)					AS SEO_ALT_TEXT,
			
			CREATE_DATE			AS CREATE_DATE,
			CREATER				AS CREATER,
			UPDATE_DATE			AS UPDATE_DATE,
			UPDATER				AS UPDATER
		FROM
			PAGE_POSTING
		WHERE
			IDX = ".$page_idx."
	";

	$db->query($select_page_product_sql);

	foreach($db->fetch() as $data) {
		$json_result['data'][] = array(
			'page_idx'                      =>$data['PAGE_IDX'],
			'country'                		=>$data['COUNTRY'],
			'posting_type'                	=>$data['POSTING_TYPE'],
			
			'page_title'                 	=>$data['PAGE_TITLE'],
			'page_memo'               		=>$data['PAGE_MEMO'],
			'start_date'					=>$data['DISPLAY_START_DATE'],
			'start_h'						=>$data['DISPLAY_START_H'],
			'start_m'						=>$data['DISPLAY_START_M'],
			'end_date'  					=>$data['DISPLAY_END_DATE'],
			'end_h'  						=>$data['DISPLAY_END_H'],
			'end_m'  						=>$data['DISPLAY_END_M'],
			
			'seo_exposure_flg'				=>$data['SEO_EXPOSURE_FLG'],
			'seo_title'						=>$data['SEO_TITLE'],
			'seo_author'					=>$data['SEO_AUTHOR'],
			'seo_description'				=>$data['SEO_DESCRIPTION'],
			'seo_keywords'					=>$data['SEO_KEYWORDS'],
			'seo_alt_text'					=>$data['SEO_ALT_TEXT']
		);
	}
}

?>