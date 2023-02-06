<?php
/*
 +=============================================================================
 | 
 | 상품 목록 페이지 조회 API
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.07.25
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

/** 변수 정리 **/
$page_idx			= $_POST['page_idx'];			//IDX

$search_type		= $_POST['search_type'];	//검색 타입
$search_keyword     = $_POST['search_keyword'];	//검색 키워드

$display_status      = $_POST['display_status'];	//진열 상태

$search_date        = $_POST['search_date'];
$create_from        = $_POST['create_from'];     //등록일 검색 시작일자
$create_to			= $_POST['create_to'];      //등록일 검색 종료일자

$product_min    	= $_POST['product_min'];	//검색 상품갯수 최대값
$product_max    	= $_POST['product_max'];	//검색 상품갯수 최소값

$title				= $_POST['title'];
$url				= $_POST['url'];			//PAGE URL : 중복체크

$rows = $_POST['rows'];
$page = $_POST['page'];

$ip_list = array();
$mem_level_list = array();
$grade_str = '';

$sort_value = $_POST['sort_value'];
$sort_type 	= $_POST['sort_type'];

/** 검색 조건 **/
$where = "1=1";
$where .= " AND (PP.DEL_FLG = FALSE)";
$cnt_where .= $where;

/* 검색조건 : IDX (단일 페이지 업데이트 창에서 사용) */
if(isset($page_idx)){
	$where .= ' AND IDX = '.$page_idx.' ';
} else {
	/* 검색조건 : 검색타입 - 검색키워드 */
	if ($search_type != null && $search_keyword != null) {
		switch ($search_type) {
			case "subject" :
				$where .=  " AND PP.PAGE_TITLE LIKE '%".$search_keyword."%' ";
				break;
			
			case "content" :
				$where .=  " AND PP.PAGE_MEMO LIKE '%".$search_keyword."%' ";
				break;
		}
	}
	
	/* 검색조건 진열예약, 진열상태 */ 
	if($display_status != null && $display_status != "all"){
		switch ($display_status) {
			case "true" :
				$where .= " AND (PP.DISPLAY_FLG = TRUE AND NOW() >= DISPLAY_START_DATE AND NOW() <= DISPLAY_END_DATE) ";
				break;
			
			case "false" :
				$where .= " AND (PP.DISPLAY_FLG = FALSE) ";
				break;
			
			case "wait" :
				$where .= " AND (PP.DISPLAY_FLG = TRUE AND NOW() < DISPLAY_START_DATE) ";
				break;
			
			case "end" :
				$where .= " AND (PP.DISPLAY_FLG = TRUE AND NOW() >= DISPLAY_START_DATE AND NOW() >= DISPLAY_END_DATE) ";
				break;
		}
	}

	if($display_reserve != null){
		$where .=  " AND DISPLAY_RESERVE_FLG = ".intval($displayReserve)." ";
	}
	
	/* 검색조건 : 등록일 */
	if ($search_date != null) {
		switch ($search_date) {
			case "today" :
				$where .= ' AND (PP.CREATE_DATE >= CURDATE()) ';
				break;
			
			case "01d" :
				$where .= ' AND (PP.CREATE_DATE >= (CURDATE() - INTERVAL 1 DAY)) ';
				break;
			
			case "03d" :
				$where .= ' AND (PP.CREATE_DATE >= (CURDATE() - INTERVAL 3 DAY)) ';
				break;
			
			case "07d" :
				$where .= ' AND (PP.CREATE_DATE >= (CURDATE() - INTERVAL 7 DAY)) ';
				break;
			
			case "15d" :
				$where .= ' AND (PP.CREATE_DATE >= (CURDATE() - INTERVAL 15 DAY)) ';
				break;
			
			case "01m" :
				$where .= ' AND (PP.CREATE_DATE >= (CURDATE() - INTERVAL 1 MONTH)) ';
				break;
			
			case "03m" :
				$where .= ' AND (PP.CREATE_DATE >= (CURDATE() - INTERVAL 3 MONTH)) ';
				break;
		}
	}
	
	if ($create_from != null && $create_to != null) {
		$where .= " AND (PP.CREATE_DATE BETWEEN '".$create_from."' AND '".$create_to."') ";
	}

	//검색 유형 - 상품가격
	if($product_min != null){
		$where .= " AND PP.PRODUCT_CNT >= ".$product_min." ";
	} 

	if($product_max != null){
		$where .= " AND PP.PRODUCT_CNT <= ".$product_max." ";
	}	
}

/** 정렬 조건 **/
$order = '';
if ($sort_value != null && $sort_type != null) {
	$order = $sort_value." ".$sort_type." ";
} else {
	$order = ' IDX DESC ';
}

/** DB 처리 **/
$json_result = array(
	'total' => $db->count("dev.PAGE_PRODUCT PP",$where),
	'total_cnt' => $db->count("dev.PAGE_PRODUCT PP",$cnt_where),
	'page' => intval($page)
);

$limit_start = (intval($page)-1)*$rows;

$display_sql = "";
if ($page_idx != null) {
	$display_sql .= " DATE_FORMAT(PP.DISPLAY_START_DATE,	'%Y-%m-%d')	AS START_DATE, ";
	$display_sql .= " DATE_FORMAT(PP.DISPLAY_START_DATE,	'%H')		AS START_H, ";
	$display_sql .= " DATE_FORMAT(PP.DISPLAY_START_DATE,	'%i')		AS START_M, ";
	$display_sql .= " DATE_FORMAT(PP.DISPLAY_END_DATE,		'%Y-%m-%d')	AS END_DATE, ";
	$display_sql .= " DATE_FORMAT(PP.DISPLAY_END_DATE,		'%H')		AS END_H, ";
	$display_sql .= " DATE_FORMAT(PP.DISPLAY_END_DATE,		'%i')		AS END_M, ";
} else {
	$display_sql .= " DATE_FORMAT(DISPLAY_START_DATE,		'%Y-%m-%d %H:%i')	AS START_DATE, ";
	$display_sql .= " DATE_FORMAT(DISPLAY_END_DATE,			'%Y-%m-%d %H:%i')	AS END_DATE, ";
}

$sql = "SELECT
			PP.IDX						AS PAGE_IDX,
			PP.PAGE_TITLE				AS PAGE_TITLE,
			PP.PAGE_MEMO				AS PAGE_MEMO,
			PP.PAGE_URL					AS PAGE_URL,
			PP.PRODUCT_CNT				AS PRODUCT_CNT,
			PP.DISPLAY_MEMBER_LEVEL		AS DISPLAY_MEMBER_LEVEL,
			
			PP.DISPLAY_FLG				AS DISPLAY_FLG,
			".$display_sql."
			
			PP.SEO_EXPOSURE_FLG			AS SEO_EXPOSURE_FLG,
			PP.SEO_TITLE				AS SEO_TITLE,
			PP.SEO_AUTHOR				AS SEO_AUTHOR,
			PP.SEO_DESCRIPTION			AS SEO_DESCRIPTION,
			PP.SEO_KEYWORDS				AS SEO_KEYWORDS,
			PP.SEO_ALT_TEXT				AS SEO_ALT_TEXT,
            PP.CREATE_DATE				AS CREATE_DATE,
            PP.CREATER					AS CREATER,
            PP.UPDATE_DATE				AS UPDATE_DATE,
            PP.UPDATER					AS UPDATER
		FROM
			dev.PAGE_PRODUCT PP
		WHERE
			".$where."
		ORDER BY
			".$order;

if ($rows != null) {
	$sql .= " LIMIT ".$limit_start.",".$rows;
}

$db->query($sql);
foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'num'							=>$total_cnt--,
		'page_idx'						=>$data['PAGE_IDX'],
		'page_title'                	=>$data['PAGE_TITLE'],
		'page_memo'                 	=>$data['PAGE_MEMO'],
		'page_url'                  	=>$data['PAGE_URL'],
		'product_cnt'               	=>$data['PRODUCT_CNT'],
		'display_member_level'      	=>$data['DISPLAY_MEMBER_LEVEL'],
		
		'display_flg'               	=>$data['DISPLAY_FLG'],
        'start_date'        			=>$data['START_DATE'],
		'start_h'   	     			=>$data['START_H'],
		'start_m'       	 			=>$data['START_M'],
		'end_date'          			=>$data['END_DATE'],
		'end_h'     	     			=>$data['END_H'],
		'end_m'   		       			=>$data['END_M'],
		
		'seo_exposure_flg'				=>$data['SEO_EXPOSURE_FLG'],
		'seo_title'						=>$data['SEO_TITLE'],
		'seo_author'					=>$data['SEO_AUTHOR'],
		'seo_description'				=>$data['SEO_DESCRIPTION'],
		'seo_keywords'					=>$data['SEO_KEYWORDS'],
		'seo_alt_text'					=>$data['SEO_ALT_TEXT'],
		
		'create_date'               	=>$data['CREATE_DATE'],
		'creater'                   	=>$data['CREATER'],
		'update_date'               	=>$data['UPDATE_DATE'],
		'updater'                   	=>$data['UPDATER']
	);
}

if(isset($page_idx)){
	$ip_sql = "
		SELECT 	
			IP
		FROM
			dev.IP_BAN
		WHERE
			PAGE_IDX = ".$page_idx;
	$db->query($ip_sql);
	foreach($db->fetch() as $data) {
		array_push($ip_list, $data['IP']);
	}
	$json_result['data']['ip'] = $ip_list;
}
?>