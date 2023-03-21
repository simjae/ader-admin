<?php
/*
 +=============================================================================
 | 
 | 상품 진열 페이지 - 페이지 리스트 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.07.25
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

/** 변수 정리 **/
$search_type		= $_POST['search_type'];
$search_keyword     = $_POST['search_keyword'];

$display_status      = $_POST['display_status'];

$search_date        = $_POST['search_date'];
$create_from        = $_POST['create_from'];
$create_to			= $_POST['create_to'];

$page_title			= $_POST['page_title'];
$page_memo			= $_POST['page_meom'];

$rows = $_POST['rows'];
$page = $_POST['page'];

$sort_value = $_POST['sort_value'];
$sort_type 	= $_POST['sort_type'];

$where = "1=1";
$where .= " AND (PP.DEL_FLG = FALSE)";
$cnt_where .= $where;

/* 검색조건 : 검색타입 - 검색키워드 */
if ($search_type != null && $search_keyword != null) {
	switch ($search_type) {
		case "page_title" :
			$where .=  " AND PP.PAGE_TITLE LIKE '%".$search_keyword."%' ";
			break;
		
		case "page_memo" :
			$where .=  " AND PP.PAGE_MEMO LIKE '%".$search_keyword."%' ";
			break;
	}
}

/* 검색조건 진열예약, 진열상태 */ 
if ($display_status != null && $display_status != "ALL") {
	switch ($display_status) {
		case "DPC" :
			$where .= " AND (PP.DISPLAY_FLG = TRUE AND PP.DISPLAY_START_DATE <= NOW() AND PP.DISPLAY_END_DATE >= NOW())";
			break;
		
		case "DWT" :
			$where .= " AND (PP.DISPLAY_FLG = TRUE AND PP.DISPLAY_START_DATE >= NOW())";
			break;
		
		case "DED" :
			$where .= " AND (PP.DISPLAY_FLG = TRUE AND PP.DISPLAY_END_DATE < NOW())";
			break;
		
		case "DNO" :
			$where .= " AND (PP.DISPLAY_FLG = FALSE)";
			break;
	}
}

/* 검색조건 : 등록일 */
if ($search_date != null && $search_date != 'all') {
	$tmp_date = "DATE_FORMAT(PP.CREATE_DATE,'%Y-%m-%d')";
	
	switch ($search_date) {
		case "today" :
			$where .= ' AND ('.$tmp_date.' = CURDATE()) ';
			break;
		
		case "01d" :
			$where .= ' AND ('.$tmp_date.' >= (CURDATE() - INTERVAL 1 DAY)) ';
			break;
		
		case "03d" :
			$where .= ' AND ('.$tmp_date.' >= (CURDATE() - INTERVAL 3 DAY)) ';
			break;
		
		case "07d" :
			$where .= ' AND ('.$tmp_date.' >= (CURDATE() - INTERVAL 7 DAY)) ';
			break;
		
		case "15d" :
			$where .= ' AND ('.$tmp_date.' >= (CURDATE() - INTERVAL 15 DAY)) ';
			break;
		
		case "01m" :
			$where .= ' AND ('.$tmp_date.' >= (CURDATE() - INTERVAL 1 MONTH)) ';
			break;
		
		case "03m" :
			$where .= ' AND ('.$tmp_date.' >= (CURDATE() - INTERVAL 3 MONTH)) ';
			break;
		
		case "01y" :
			$where .= ' AND ('.$tmp_date.' >= (CURDATE() - INTERVAL 1 YEAR)) ';
			break;
	}
}

if ($create_from != null || $create_to != null) {
	
	if ($create_from != null && $create_to == null) {
		$where .= " AND (PP.CREATE_DATE >= '".$create_from."')";
	} else if ($create_from == null && $create_to != null) {
		$where .= " AND (PP.CREATE_DATE <= '".$create_to."')";
	} else if ($create_from != null && $create_to != null) {
		$where .= " AND (PP.CREATE_DATE BETWEEN '".$create_from."' AND '".$create_to."') ";
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
	'total' => $db->count("PAGE_PRODUCT PP",$where),
	'total_cnt' => $db->count("PAGE_PRODUCT PP",$cnt_where),
	'page' => intval($page)
);

$limit_start = (intval($page)-1)*$rows;

$sql = "SELECT
			PP.IDX						AS PAGE_IDX,
			PP.PAGE_TITLE				AS PAGE_TITLE,
			PP.PAGE_MEMO				AS PAGE_MEMO,
			PP.PAGE_URL					AS PAGE_URL,
			PP.PRODUCT_CNT				AS PRODUCT_CNT,
			PP.DISPLAY_MEMBER_LEVEL		AS DISPLAY_MEMBER_LEVEL,
			
			PP.DISPLAY_FLG				AS DISPLAY_FLG,
			DATE_FORMAT(
				PP.DISPLAY_START_DATE,
				'%Y-%m-%d %H:%i'
			)							AS DISPLAY_START_DATE,
			DATE_FORMAT(
				PP.DISPLAY_END_DATE,
				'%Y-%m-%d %H:%i'
			)							AS DISPLAY_END_DATE,
			
			PP.SEO_EXPOSURE_FLG			AS SEO_EXPOSURE_FLG,
			PP.SEO_TITLE				AS SEO_TITLE,
			PP.SEO_AUTHOR				AS SEO_AUTHOR,
			PP.SEO_DESCRIPTION			AS SEO_DESCRIPTION,
			PP.SEO_KEYWORDS				AS SEO_KEYWORDS,
			PP.SEO_ALT_TEXT				AS SEO_ALT_TEXT,
            DATE_FORMAT(
				PP.CREATE_DATE,
				'%Y-%m-%d %H:%i'
			)							AS CREATE_DATE,
            PP.CREATER					AS CREATER,
            DATE_FORMAT(
				PP.UPDATE_DATE,
				'%Y-%m-%d %H:%i'
			)							AS UPDATE_DATE,
            PP.UPDATER					AS UPDATER
		FROM
			PAGE_PRODUCT PP
		WHERE
			".$where."
		ORDER BY
			".$order;

if ($rows != null) {
	$sql .= " LIMIT ".$limit_start.",".$rows;
}

$db->query($sql);
foreach($db->fetch() as $page_data) {
	$display_member_level = "";
	if ($page_data['DISPLAY_MEMBER_LEVEL'] != "0") {
		$select_member_level_sql = "
			SELECT
				ML.TITLE		AS MEMBER_LEVEL
			FROM
				MEMBER_LEVEL ML
			WHERE
				ML.IDX IN (".$page_data['DISPLAY_MEMBER_LEVEL'].")
		";
		
		$db->query($select_member_level_sql);
		
		$member_level = array();
		foreach($db->fetch() as $level_data) {
			$member_level[] = array(
				'member_level'		=>$level_data['MEMBER_LEVEL']
			);
		}
		
		if (count($member_level) > 1) {
			$display_member_level = $member_level[0]['member_level']."<br/>외 ".(count($member_level)-1)."개 등급";
		} else {
			$display_member_level = $member_level[0]['member_level'];
		}
	} else {
		$display_member_level = "전체";
	}
	
	$now = strtotime(date('Y-m-d H:i:s'));
	
	$display_status = "";
	$display_flg = $page_data['DISPLAY_FLG'];
	$display_start_date = $page_data['DISPLAY_START_DATE'];
	$display_end_date = $page_data['DISPLAY_END_DATE'];
	
	if ($display_flg == false) {
		$display_status = "진열안함";
	} else if ($display_flg == true) {
		if ($display_end_date == '9999-12-31 23:59') {
			$display_status = "상시진열";
		} else {
			if (strtotime($display_start_date) >= $now) {
				$display_status = "진열대기";
			} else if (strtotime($display_end_date) < $now) {
				$display_status = "진열종료";
			} else if (strtotime($display_start_date) <= $now && strtotime($display_end_date) >= $now) {
				$display_status = "진열중";
			}
		}
	}
	
	$json_result['data'][] = array(
		'num'							=>$total_cnt--,
		'page_idx'						=>$page_data['PAGE_IDX'],
		'page_title'                	=>$page_data['PAGE_TITLE'],
		'page_memo'                 	=>$page_data['PAGE_MEMO'],
		'page_url'                  	=>$page_data['PAGE_URL'],
		'product_cnt'               	=>$page_data['PRODUCT_CNT'],
		'display_member_level'      	=>$display_member_level,
		
		'display_flg'					=>$display_flg,
		'display_status'				=>$display_status,
		'display_start_date'			=>$page_data['DISPLAY_START_DATE'],
		'display_end_date'				=>$page_data['DISPLAY_END_DATE'],
		
		'seo_exposure_flg'				=>$page_data['SEO_EXPOSURE_FLG'],
		'seo_title'						=>$page_data['SEO_TITLE'],
		'seo_author'					=>$page_data['SEO_AUTHOR'],
		'seo_description'				=>$page_data['SEO_DESCRIPTION'],
		'seo_keywords'					=>$page_data['SEO_KEYWORDS'],
		'seo_alt_text'					=>$page_data['SEO_ALT_TEXT'],
		
		'create_date'               	=>$page_data['CREATE_DATE'],
		'creater'                   	=>$page_data['CREATER'],
		'update_date'               	=>$page_data['UPDATE_DATE'],
		'updater'                   	=>$page_data['UPDATER']
	);
}

?>