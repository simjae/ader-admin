<?php
/*
 +=============================================================================
 | 
 | What's New 조회 API
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.07.28
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

/** 변수 정리 **/
$page_idx				= $_POST['page_idx'];		//WHAT'S NEW 페이지 IDX
$img_flg				= $_POST['img_flg'];	//현재 진열중인 WHAT'S NEW 조회용 플래그

$rows					= $_POST['rows'];
$page					= $_POST['page'];

$sort_value				= $_POST['sort_value'];
$sort_type				= $_POST['sort_type'];

$tables = " dev.PAGE_WHATS_NEW WHATS ";

/** 검색 조건 **/
$where = ' WHATS.DEL_FLG = FALSE ';
$cnt_where = $where;

/** DB 처리 **/
$json_result = array(
	'total' => $db->count($tables,$where),
	'total_cnt' => $db->count($tables,$cnt_where),
	'page' => intval($page)
);

$limit_start = (intval($page)-1) * $rows;

/* 현재 전시중인 WHAT'S NEW 검색 플래그 */
$order = "";
$limit = "";

if($img_flg == "true") {
	$sql = "SELECT
				WHATS.IDX,
				WHATS.PAGE_TITLE,
				WHATS.PAGE_SUB_TITLE,
				IMG.IMG_LOCATION
			FROM
				dev.PAGE_WHATS_NEW WHATS
				LEFT JOIN dev.PAGE_IMG_WHATS_NEW IMG ON
				WHATS.IDX = IMG.WHATS_NEW_IDX
			WHERE
				WHATS.DEL_FLG = FALSE AND
				WHATS.DISPLAY_FLG = TRUE AND
				IMG.DEL_FLG = FALSE AND
				( NOW() BETWEEN DISPLAY_START_DATE AND DISPLAY_END_DATE ) AND
				IMG.IMG_SIZE = 'org'
			ORDER BY
				WHATS.IDX DESC
			LIMIT
				0,4";
} else {
	/** 정렬 조건 **/
	if ($sort_value != null && $sort_type != null) {
		$order = " ORDER BY ".$sort_value." ".$sort_type.", ";
	}

	$order .= ' IDX DESC ';
	$limit = " LIMIT ".$limit_start.",".$rows;
	
	/* 검색조건 : IDX (단일 페이지 업데이트 창에서 사용) */
	$display_sql = "";

	if ($page_idx != null) {
		$display_sql .= " DATE_FORMAT(DISPLAY_START_DATE, '%Y-%m-%d') AS DISPLAY_START_DATE, ";
		$display_sql .= " DATE_FORMAT(DISPLAY_START_DATE, '%H') AS DISPLAY_START_H, ";
		$display_sql .= " DATE_FORMAT(DISPLAY_START_DATE, '%i') AS DISPLAY_START_M, ";
		$display_sql .= " DATE_FORMAT(DISPLAY_END_DATE, '%Y-%m-%d') AS DISPLAY_END_DATE, ";
		$display_sql .= " DATE_FORMAT(DISPLAY_END_DATE, '%H') AS DISPLAY_END_H, ";
		$display_sql .= " DATE_FORMAT(DISPLAY_END_DATE, '%i') AS DISPLAY_END_M, ";
		
		$where .= " AND (WHATS.IDX = ".$page_idx.") ";
		$order = "";
		$limit = "";
	} else {
		$display_sql .= " DATE_FORMAT(DISPLAY_START_DATE, '%Y-%m-%d %H:%i') AS DISPLAY_START_DATE, ";
		$display_sql .= " DATE_FORMAT(DISPLAY_END_DATE, '%Y-%m-%d %H:%i') AS DISPLAY_END_DATE, ";
	}

	$sql = "SELECT
				WHATS.IDX,
				WHATS.COUNTRY,
				WHATS.PAGE_TITLE,
				WHATS.PAGE_SUB_TITLE,
				(SELECT IMG_LOCATION FROM dev.PAGE_IMG_WHATS_NEW WHERE DEL_FLG = FALSE AND IMG_SIZE = 'org' AND WHATS_NEW_IDX = WHATS.IDX) AS IMG_LOCATION,
				WHATS.PAGE_URL,
				WHATS.PAGE_CONTENT,
				WHATS.PAGE_MEMO,
				WHATS.DISPLAY_FLG,
				".$display_sql."
				WHATS.SEO_EXPOSURE_FLG,
				WHATS.SEO_TITLE,
				WHATS.SEO_AUTHOR,
				WHATS.SEO_DESCRIPTION,
				WHATS.SEO_KEYWORDS,
				WHATS.SEO_ALT_TEXT,
				WHATS.CREATE_DATE,
				WHATS.CREATER,
				WHATS.UPDATE_DATE,
				WHATS.UPDATER
			FROM
				dev.PAGE_WHATS_NEW WHATS
			WHERE
				".$where."
			".$order."
			".$limit;
}

$db->query($sql);

foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'num'									=>$total_cnt--,
		'idx'                       			=>intval($data['IDX']),
		'country'                				=>$data['COUNTRY'],
		'page_title'                 			=>$data['PAGE_TITLE'],
		'page_sub_title'                  		=>$data['PAGE_SUB_TITLE'],
		'page_url'               				=>$data['PAGE_URL'],
		'img_location'             				=>$data['IMG_LOCATION'],
		'page_content'      					=>$data['PAGE_CONTENT'],
		'page_memo'               				=>$data['PAGE_MEMO'],
		'display_flg'        					=>$data['DISPLAY_FLG'],
		'display_start_date'					=>$data['DISPLAY_START_DATE'],
		'display_start_h'						=>$data['DISPLAY_START_H'],
		'display_start_m'						=>$data['DISPLAY_START_M'],
		'display_end_date'  					=>$data['DISPLAY_END_DATE'],
		'display_end_h'  						=>$data['DISPLAY_END_H'],
		'display_end_m'  						=>$data['DISPLAY_END_M'],
		
		'seo_exposure_flg'						=>$data['SEO_EXPOSURE_FLG'],
		'seo_title'								=>$data['SEO_TITLE'],
		'seo_author'							=>$data['SEO_AUTHOR'],
		'seo_description'						=>$data['SEO_DESCRIPTION'],
		'seo_keywords'							=>$data['SEO_KEYWORDS'],
		'seo_alt_text'							=>$data['SEO_ALT_TEXT'],

		'del_flg'                   			=>$data['DEL_FLG'],
		'create_date'               			=>$data['CREATE_DATE'],
		'creater'                   			=>$data['CREATER'],
		'update_date'               			=>$data['UPDATE_DATE'],
		'updater'                   			=>$data['UPDATER']
	);
}
?>