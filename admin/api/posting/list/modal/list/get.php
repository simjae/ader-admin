<?php
/*
 +=============================================================================
 | 
 | 전시정보 조회 - 게시물 스토리 모달_게시물 리스트 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.12.05
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$country			= $_POST['country'];
$posting_type		= $_POST['posting_type'];
$display_status		= $_POST['display_status'];
$display_start_date	= $_POST['display_start_date'];
$display_end_date	= $_POST['display_end_date'];
$page_title			= $_POST['page_title'];
$page_memo			= $_POST['page_memo'];

$sort_type 				= $_POST['sort_type'];				//정렬 타입
$sort_value 			= $_POST['sort_value'];				//정렬 값

$rows					= $_POST['rows'];
$page					= $_POST['page'];

$where  = " PP.DEL_FLG = FALSE AND
			PP.IDX NOT IN (
				SELECT
					S_PS.PAGE_IDX
				FROM
					dev.POSTING_STORY S_PS
				WHERE
					S_PS.DEL_FLG = FALSE
			) ";
$where_cnt = $where;

if ($country != null && $country != "ALL") {
	$where .= " AND (PP.COUNTRY = '".$country."') ";
}

if ($posting_type != null) {
	if ($posting_type != null) {
		$tmp_val = array();
		for ($i=0; $i<count($posting_type); $i++) {
			if ($posting_type[$i] == "ALL") {
				break;
			} else {
				array_push($tmp_val,"'".$posting_type[$i]."'");
			}
		}
		
		if (count($tmp_val) > 0) {
			$where .= " AND (PP.POSTING_TYPE IN (".implode(",",$tmp_val).")) ";
		}
	}
}

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

if ($display_start_date != null || $display_end_date != null) {
	if ($display_start_date != null && $display_end_date == null) {
		$where .= " AND (PP.DISPLAY_START_DATE >= '".$display_start_date."') ";
	} else if ($display_start_date == null && $display_end_date != null) {
		$where .= " AND (PP.DISPLAY_END_DATE <= '".$display_end_date."') ";
	} else if ($display_Start_date != null && $display_end_date != null) {
		$where .= " AND (PP.DISPLAY_START_DATE >= '".$display_start_date."' AND PP.DISPLAY_END_DATE <= '".$display_end_date."') ";
	}
}

if ($page_title != null) {
	$where .= " AND (PP.PAGE_TITLE LIKE '%".$page_title."%') ";
}

if ($page_memo != null) {
	$where .= " AND (PP.PAGE_MEMO LIKE '%".$page_memo."%') ";
}

/** 정렬 조건 **/
$order = '';
if ($sort_value != null && $sort_type != null) {
	$order = ' PS.'.$sort_value." ".$sort_type." ";
} else {
	$order = ' STORY_IDX DESC';
}

$limit_start = (intval($page)-1)*$rows;

$json_result = array(
	'total' => $db->count("dev.PAGE_POSTING PP",$where),
	'total_cnt' => $db->count("dev.PAGE_POSTING PP",$where_cnt),
	'page' => $page
);

$sql = "SELECT
			PP.IDX					AS PAGE_IDX,
			PP.COUNTRY				AS COUNTRY,
			PP.POSTING_TYPE			AS POSTING_TYPE,
			PP.PAGE_TITLE			AS PAGE_TITLE,
			PP.PAGE_URL				AS PAGE_URL,
			PP.PAGE_MEMO			AS PAGE_MEMO,
			PP.PAGE_VIEW			AS PAGE_VIEW,
			PP.DISPLAY_FLG			AS DISPLAY_FLG,
			PP.DISPLAY_START_DATE	AS DISPLAY_START_DATE,
			PP.DISPLAY_END_DATE		AS DISPLAY_END_DATE,
			PP.PAGE_VIEW			AS PAGE_VIEW
		FROM
			dev.PAGE_POSTING PP
		WHERE
			".$where."
		ORDER BY
			IDX DESC";

if ($rows != null && $select_idx_flg == null) {
	$sql .= " LIMIT ".$limit_start.",".$rows;
}

$db->query($sql);

foreach($db->fetch() as $data) {
	$now = strtotime(date('Y-m-d H:i:s'));
	
	$display_status = "";
	
	$display_flg = $data['DISPLAY_FLG'];
	$display_start_date = $data['DISPLAY_START_DATE'];
	$display_end_date = $data['DISPLAY_END_DATE'];
	
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
		'page_idx'				=>$data['PAGE_IDX'],
		'country'				=>$data['COUNTRY'],
		'posting_type'			=>$data['POSTING_TYPE'],
		'page_title'			=>$data['PAGE_TITLE'],
		'page_url'				=>$data['PAGE_URL'],
		'page_memo'				=>$data['PAGE_MEMO'],
		'page_view'				=>$data['PAGE_VIEW'],
		'display_status'		=>$display_status,
		'display_start_date'	=>$data['DISPLAY_START_DATE'],
		'display_end_date'		=>$data['DISPLAY_END_DATE'],
		'page_view'				=>$data['PAGE_VIEW'],
	);
}
?>