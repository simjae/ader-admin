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

/** 변수 정리 **/
$page_idx			= $_POST['page_idx'];
$tab_num			= $_POST['tab_num'];

$country			= $_POST['country'];

$rows 				= $_POST['rows'];
$page 				= $_POST['page'];

$tables = ' dev.PAGE_POSTING ';

$sort_value = $_POST['sort_value'];
$sort_type 	= $_POST['sort_type'];

/** 검색 조건 **/
$where = ' DEL_FLG = FALSE ';

/* 탭 조건 : POSTING_TYPE*/
if(isset($tab_num)){
	switch($tab_num){
		case '01':
			$where .= " AND POSTING_TYPE = 'collection' ";
			break;
		case '02':
			$where .= " AND POSTING_TYPE = 'editorial' ";
			break;
		case '03':
			$where .= " AND POSTING_TYPE = 'collaboration' ";
			break;
		case '04':
			$where .= " AND POSTING_TYPE = 'exhibition' ";
			break;
	}
}

if($country != null && $country != "all"){
	$where .= " AND COUNTRY = '".$country."' ";
}
$cnt_where = $where;

/* 중복체크 */
if(isset($title)){
	$title = str_replace("'","\'",$title);
	$where .= " AND PAGE_TITLE = '".$title."' ";
}
if(isset($url)){
	$where .= " AND PAGE_URL = '".$url."' ";
}

/* 검색조건 : IDX (단일 페이지 업데이트 창에서 사용) */
$country_sql = "";
if(isset($page_idx)){
	$where .= ' AND IDX = '.$page_idx.' ';
	$country_sql .= " COUNTRY, ";
} else {
	$country_sql .= "CASE
						WHEN COUNTRY='KR'
							THEN '한국몰' 
						WHEN COUNTRY='EN'
							THEN '영문몰'
						WHEN COUNTRY='CN'
							THEN '중문몰'
					END AS COUNTRY,";
}

/** 정렬 조건 **/
$order = "";
if ($sort_value != null && $sort_type != null) {
	$order = " ORDER BY ".$sort_value." ".$sort_type.", ";
	$order .= " IDX DESC ";
}

/** DB 처리 **/
$json_result = array(
	'total' => $db->count($tables,$where),
	'total_cnt' => $db->count($tables,$cnt_where),
	'page' => intval($page)
);

$limit_start = (intval($page)-1)*$rows;

/* 검색조건 : IDX (단일 페이지 업데이트 창에서 사용) */
$display_sql = "";
if ($page_idx != null) {
	$display_sql .= " DATE_FORMAT(DISPLAY_START_DATE, '%Y-%m-%d') AS DISPLAY_START_DATE, ";
	$display_sql .= " DATE_FORMAT(DISPLAY_START_DATE, '%H') AS DISPLAY_START_H, ";
	$display_sql .= " DATE_FORMAT(DISPLAY_START_DATE, '%i') AS DISPLAY_START_M, ";
	$display_sql .= " DATE_FORMAT(DISPLAY_END_DATE, '%Y-%m-%d') AS DISPLAY_END_DATE, ";
	$display_sql .= " DATE_FORMAT(DISPLAY_END_DATE, '%H') AS DISPLAY_END_H, ";
	$display_sql .= " DATE_FORMAT(DISPLAY_END_DATE, '%i') AS DISPLAY_END_M, ";
	
	$where .= " AND (IDX = ".$page_idx.") ";
	$order = "";
	$limit = "";
} else {
	$display_sql .= " DATE_FORMAT(DISPLAY_START_DATE, '%Y-%m-%d %H:%i') AS DISPLAY_START_DATE, ";
	$display_sql .= " DATE_FORMAT(DISPLAY_END_DATE, '%Y-%m-%d %H:%i') AS DISPLAY_END_DATE, ";
}

$sql = "SELECT
			IDX,
			POSTING_TYPE,
			".$country_sql."
			PAGE_TITLE,
			PAGE_URL,
			PAGE_MEMO,
			PAGE_VIEW,
			DISPLAY_FLG,
			".$display_sql."
			
			SEO_EXPOSURE_FLG,
			SEO_TITLE,
			SEO_AUTHOR,
			SEO_DESCRIPTION,
			SEO_KEYWORDS,
			SEO_ALT_TEXT,
			
			CREATE_DATE,
			CREATER,
			UPDATE_DATE,
			UPDATER
		FROM
			".$tables."
		WHERE
			".$where."
		".$order;
if ($rows != null) {
	$sql .= " LIMIT ".$limit_start.",".$rows;
}

$db->query($sql);
foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'num'									=>intval($total_cnt--),
		'idx'                       			=>intval($data['IDX']),
		'postring_type'                			=>$data['POSTING_TYPE'],
		'country'                				=>$data['COUNTRY'],
		'page_title'                 			=>$data['PAGE_TITLE'],
		'page_url'               				=>$data['PAGE_URL'],
		'page_memo'               				=>$data['PAGE_MEMO'],
		'page_view'               				=>$data['PAGE_VIEW'],
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

		'create_date'               			=>$data['CREATE_DATE'],
		'creater'                   			=>$data['CREATER'],
		'update_date'               			=>$data['UPDATE_DATE'],
		'updater'                   			=>$data['UPDATER']
	);
}
?>