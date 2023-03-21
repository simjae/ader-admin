<?php
/*
 +=============================================================================
 | 
 | 게시물 관리 - 게시물 리스트 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.07.31
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$posting_type		= $_POST['posting_type'];
$country			= $_POST['country'];

$rows				= $_POST['rows'];
$page				= $_POST['page'];

$sort_type			= $_POST['sort_type'];				//정렬타입
$sort_value			= $_POST['sort_value'];				//정렬 기준값

$where = " DEL_FLG = FALSE ";
$where .= " AND (POSTING_TYPE = '".$posting_type."') ";

$where_cnt = $where;

if ($country != null && $country != "ALL") {
	$where .= "AND (COUNTRY = '".$country."') ";
}

$order = '';
if ($sort_value != null && $sort_type != null) {
	$order = ' PP.'.$sort_value." ".$sort_type." ";
} else {
	$order = ' PP.IDX DESC';
}

$total_cnt = $db->count("PAGE_POSTING",$where);
$json_result = array(
	'total' => $db->count("PAGE_POSTING",$where),
	'total_cnt' => $total_cnt,
	'page' => intval($page)
);

$limit_start = (intval($page)-1)*$rows;

$select_page_posting_sql = "
	SELECT
		PP.IDX						AS PAGE_IDX,
		PP.COUNTRY					AS COUNTRY,
		PP.POSTING_TYPE				AS POSTING_TYPE,
		PP.PAGE_TITLE				AS PAGE_TITLE,
		PP.PAGE_URL					AS PAGE_URL,
		IFNULL(
			PP.PAGE_MEMO,'-'
		)							AS PAGE_MEMO,
		PP.PAGE_VIEW				AS PAGE_VIEW,
		PP.DISPLAY_FLG				AS DISPLAY_FLG,
		PP.DISPLAY_START_DATE		AS DISPLAY_START_DATE,
		PP.DISPLAY_END_DATE			AS DISPLAY_END_DATE,
		PP.CREATE_DATE				AS CREATE_DATE,
		PP.UPDATE_DATE				AS UPDATE_DATE
	FROM
		PAGE_POSTING PP
	WHERE
		".$where."
	ORDER BY
		".$order."
";

if ($rows != null && $select_idx_flg == null) {
	$select_page_posting_sql .= " LIMIT ".$limit_start.",".$rows;
}

$db->query($select_page_posting_sql);

foreach($db->fetch() as $posting_data) {
	$now = strtotime(date('Y-m-d H:i:s'));
	
	$display_status = "";
	$display_flg = $posting_data['DISPLAY_FLG'];
	$display_start_date = $posting_data['DISPLAY_START_DATE'];
	$display_end_date = $posting_data['DISPLAY_END_DATE'];
	
	if ($display_flg == false) {
		$display_status = "진열안함";
	} else if ($display_flg == true) {
		if ($display_end_date == '9999-12-31 23:59') {
			$display_status = "상시진열";
		} else {			
			if ((int)strtotime($display_start_date) > $now) {
				$display_status = "진열대기";
			} else if ((int)strtotime($display_end_date) < $now) {
				$display_status = "진열종료";
			} else if ((int)strtotime($display_start_date) <= $now && (int)strtotime($display_end_date) >= $now) {
				$display_status = "진열중";
			}
		}
	}
	
	$page_url = $posting_data['PAGE_URL'].$posting_data['PAGE_IDX'];
	
	$json_result['data'][] = array(
		'num'					=>$total_cnt--,
		'page_idx'				=>$posting_data['PAGE_IDX'],
		'country'				=>$posting_data['COUNTRY'],
		'posting_type'			=>$posting_data['POSTING_TYPE'],
		'page_title'			=>$posting_data['PAGE_TITLE'],
		'page_url'				=>$page_url,
		'page_memo'				=>$posting_data['PAGE_MEMO'],
		'page_view'				=>$posting_data['PAGE_VIEW'],
		'display_status'		=>$display_status,
		'display_flg'			=>$display_flg,
		'display_start_date'	=>$posting_data['DISPLAY_START_DATE'],
		'display_end_date'		=>$posting_data['DISPLAY_END_DATE'],
		'create_date'			=>$posting_data['CREATE_DATE'],
		'update_date'			=>$posting_data['UPDATE_DATE']
	);
}

?>