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
$story_type			= $_POST['story_type'];
$posting_type		= $_POST['posting_type'];

$display_status		= $_POST['display_status'];
$display_start_date	= $_POST['display_start_date'];
$display_end_date	= $_POST['display_end_date'];

$page_title			= $_POST['page_title'];
$page_memo			= $_POST['page_memo'];

$sort_type 			= $_POST['sort_type'];				//정렬 타입
$sort_value 		= $_POST['sort_value'];				//정렬 값

$rows				= $_POST['rows'];
$page				= $_POST['page'];

$where = "
	PP.IDX NOT IN (
		SELECT
			S_PS.PAGE_IDX
		FROM
			POSTING_STORY S_PS
		WHERE
			S_PS.STORY_TYPE != 'COLC' AND
			S_PS.DEL_FLG = FALSE
	) AND
	PP.COUNTRY = '".$country."' AND
	PP.DEL_FLG = FALSE
";

if ($story_type != "NEW") {
	$where .= " AND (PP.POSTING_TYPE = '".$story_type."') ";
} else {
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

$where_cnt = $where;

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
	$order = ' PS.IDX DESC';
}

$limit_start = (intval($page)-1)*$rows;

$total_cnt = $db->count("PAGE_POSTING PP",$where_cnt);
$json_result = array(
	'total' => $db->count("PAGE_POSTING PP",$where),
	'total_cnt' => $total_cnt,
	'page' => $page
);

$select_page_posting_sql = "
	SELECT
		PP.IDX					AS PAGE_IDX,
		PP.COUNTRY				AS COUNTRY,
		PP.POSTING_TYPE			AS POSTING_TYPE,
		PP.PAGE_TITLE			AS PAGE_TITLE,
		PP.PAGE_URL				AS PAGE_URL,
		IFNULL(
			PP.PAGE_MEMO,
			'-'
		)						AS PAGE_MEMO,
		PP.PAGE_VIEW			AS PAGE_VIEW,
		PP.DISPLAY_FLG			AS DISPLAY_FLG,
		DATE_FORMAT(
			PP.DISPLAY_START_DATE, '%Y-%m-%d %H:%i'
		)						AS DISPLAY_START_DATE,
		DATE_FORMAT(
			PP.DISPLAY_END_DATE, '%Y-%m-%d %H:%i'
		)						AS DISPLAY_END_DATE
	FROM
		PAGE_POSTING PP
	WHERE
		".$where."
	ORDER BY
		PP.IDX DESC
";

if ($rows != null && $select_idx_flg == null) {
	$select_page_posting_sql .= " LIMIT ".$limit_start.",".$rows;
}

$db->query($select_page_posting_sql);

foreach($db->fetch() as $page_data) {
	$posting_type = "";
	switch ($page_data['POSTING_TYPE']) {
		case "EDTL" :
			$posting_type = "에디토리얼";
			break;
		
		case "RNWY" :
			$posting_type = "런웨이";
			break;
		
		case "COLA" :
			$posting_type = "콜라보레이션";
			break;
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
		'page_idx'				=>$page_data['PAGE_IDX'],
		'country'				=>$page_data['COUNTRY'],
		'posting_type'			=>$posting_type,
		'page_title'			=>$page_data['PAGE_TITLE'],
		'page_url'				=>$page_data['PAGE_URL'],
		'page_memo'				=>$page_data['PAGE_MEMO'],
		'page_view'				=>$page_data['PAGE_VIEW'],
		'display_status'		=>$display_status,
		'display_start_date'	=>$page_data['DISPLAY_START_DATE'],
		'display_end_date'		=>$page_data['DISPLAY_END_DATE'],
		'page_view'				=>$page_data['PAGE_VIEW'],
	);
}
?>