<?php
/*
 +=============================================================================
 | 
 | 전시정보 조회 - 게시물 리스트_전체 리스트 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.12.06
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$country				= $_POST['country'];
$posting_type			= $_POST['posting_type'];

$list_display_status	= $_POST['list_display_status'];
$list_date_from			= $_POST['list_date_from'];
$list_date_to			= $_POST['list_date_to'];

$posting_display_status	= $_POST['posting_display_status'];
$posting_date_from		= $_POST['posting_date_from'];
$posting_date_to		= $_POST['posting_date_to'];

$title					= $_POST['title'];
$memo					= $_POST['memo'];

$sort_type 				= $_POST['sort_type'];				//정렬 타입
$sort_value 			= $_POST['sort_value'];				//정렬 값

$rows					= $_POST['rows'];
$page					= $_POST['page'];

$where = " PL.DEL_FLG = FALSE ";
$where_cnt = $where;

if ($country != null && $country != "ALL") {
	$where .= " AND (PL.COUNTRY = '".$country."') ";
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

if ($list_display_status != null && $list_display_status != "ALL") {
	switch ($list_display_status) {
		case "DPC" :
			$where .= " AND (PL.DISPLAY_FLG = TRUE AND PL.DISPLAY_START_DATE <= NOW() AND PL.DISPLAY_END_DATE >= NOW())";
			break;
		
		case "DWT" :
			$where .= " AND (PL.DISPLAY_FLG = TRUE AND PL.DISPLAY_START_DATE >= NOW())";
			break;
		
		case "DED" :
			$where .= " AND (PL.DISPLAY_FLG = TRUE AND PL.DISPLAY_END_DATE < NOW())";
			break;
		
		case "DNO" :
			$where .= " AND (PL.DISPLAY_FLG = FALSE)";
			break;
	}
}

if ($posting_display_status != null && $posting_display_status != "ALL") {
	switch ($posting_display_status) {
		case "DPC" :
			$where .= " AND (PP.DISPLAY_FLG = TRUE AND PP.DISPLAY_START_DATE <= NOW() AND PP.DISPLAY_END_DATE >= NOW())";
			break;
		
		case "DWT" :
			$where .= " AND (PP.DISPLAY_FLG = TRUE AND PP.DISPLAY_START_DATE >= NOW())";
			break;
		
		case "DED" :
			$where .= " AND (PL.DISPLAY_FLG = TRUE AND PL.DISPLAY_END_DATE < NOW())";
		
		case "DNO" :
			$where .= " AND (PP.DISPLAY_FLG = FALSE)";
			break;
	}
}

if ($list_date_from != null || $list_date_to != null) {
	if ($list_date_from != null && $list_date_to == null) {
		$where .= " AND (PL.DISPLAY_START_DATE >= '".$list_date_from."') ";
	} else if ($list_date_from == null && $list_date_to != null) {
		$where .= " AND (PL.DISPLAY_END_DATE <= '".$list_date_to."') ";
	} else if ($list_date_from != null && $list_date_to != null) {
		$where .= " AND (PL.DISPLAY_START_DATE >= '".$list_date_from."' AND PL.DISPLAY_END_DATE <= '".$list_date_to."') ";
	}
}

if ($posting_date_from != null || $posting_date_to != null) {
	if ($posting_date_from != null && $posting_date_to == null) {
		$where .= " AND (PP.DISPLAY_START_DATE >= '".$posting_date_from."') ";
	} else if ($posting_date_from == null && $posting_date_to != null) {
		$where .= " AND (PP.DISPLAY_END_DATE <= '".$posting_date_to."') ";
	} else if ($posting_date_from != null && $posting_date_to != null) {
		$where .= " AND (PP.DISPLAY_START_DATE >= '".$posting_date_from."' AND PP.DISPLAY_END_DATE <= '".$posting_date_to."') ";
	}
}

if ($title != null) {
	$where .= " AND (
					PL.LIST_TITLE LIKE '%".$title."%' OR
					PP.PAGE_TITLE LIKE '%".$title."%'
				) ";
}

if ($memo != null) {
	$where .= " AND (
					PL.LIST_MEMO LIKE '%".$memo."%' OR
					PP.PAGE_MEMO LIKE '%".$memo."%'
				) ";
}

/** 정렬 조건 **/
$order = '';
if ($sort_value != null && $sort_type != null) {
	$order = ' PL.'.$sort_value." ".$sort_type." ";
} else {
	$order = ' LIST_IDX DESC';
}

$limit_start = (intval($page)-1)*$rows;

$total_cnt = $db->count("dev.POSTING_LIST PL LEFT JOIN dev.PAGE_POSTING PP ON PL.PAGE_IDX = PP.IDX",$where);

$table = "dev.POSTING_LIST PL LEFT JOIN dev.PAGE_POSTING PP ON PL.PAGE_IDX = PP.IDX";

$json_result = array(
	'total' => $db->count($table,$where),
	'total_cnt' => $db->count($table,$where_cnt),
	'page' => $page
);

$sql = "SELECT
			PL.IDX					AS LIST_IDX,
			PL.COUNTRY				AS COUNTRY,
			PL.LIST_TITLE			AS LIST_TITLE,
			PL.LIST_MEMO			AS LIST_MEMO,
			PL.LIST_IMG_LOCATION	AS LIST_IMG_LOCATION,
			PL.DISPLAY_FLG			AS LIST_DISPLAY_FLG,
			DATE_FORMAT(
				PL.DISPLAY_START_DATE, '%Y-%m-%d %H:%i'
			)						AS LIST_START_DATE,
			DATE_FORMAT(
				PL.DISPLAY_END_DATE, '%Y-%m-%d %H:%i'
			)						AS LIST_END_DATE,
			
			PP.POSTING_TYPE			AS POSTING_TYPE,
			PP.PAGE_TITLE			AS PAGE_TITLE,
			PP.PAGE_MEMO			AS PAGE_MEMO,
			PP.PAGE_URL				AS PAGE_URL,
			PP.DISPLAY_FLG			AS POSTING_DISPLAY_FLG,
			DATE_FORMAT(
				PP.DISPLAY_START_DATE, '%Y-%m-%d %H:%i'
			)						AS POSTING_START_DATE,
			DATE_FORMAT(
				PP.DISPLAY_END_DATE, '%Y-%m-%d %H:%i'
			)						AS POSTING_END_DATE,
			PP.PAGE_VIEW			AS PAGE_VIEW,
			PL.CREATER				AS CREATER,
			PL.CREATE_DATE			AS CREATE_DATE,
			PL.UPDATER				AS UPDATER,
			PL.UPDATE_DATE			AS UPDATE_DATE
		FROM
			dev.POSTING_LIST PL
			LEFT JOIN dev.PAGE_POSTING PP ON
			PL.PAGE_IDX = PP.IDX
		WHERE
			".$where."
		ORDER BY
			".$order;

if ($rows != null && $select_idx_flg == null) {
	$sql .= " LIMIT ".$limit_start.",".$rows;
}

$db->query($sql);

foreach($db->fetch() as $data) {
	$now = strtotime(date('Y-m-d H:i:s'));
	
	$list_display_status = "";
	
	$list_display_flg = $data['LIST_DISPLAY_FLG'];
	$list_start_date = $data['LIST_START_DATE'];
	$list_end_date = $data['LIST_END_DATE'];
	
	if ($list_display_flg == false) {
		$list_display_status = "진열안함";
	} else if ($list_display_flg == true) {
		if ($list_end_date == '9999-12-31 23:59') {
			$list_display_status = "상시진열";
		} else {
			if (strtotime($list_start_date) >= $now) {
				$list_display_status = "진열대기";
			} else if (strtotime($list_end_date) < $now) {
				$list_display_status = "진열종료";
			} else if (strtotime($list_start_date) <= $now && strtotime($list_end_date) >= $now) {
				$list_display_status = "진열중";
			}
		}
	}
	
	$posting_display_status = "";
	
	$posting_display_flg = $data['POSTING_DISPLAY_FLG'];
	$posting_start_date = $data['POSTING_START_DATE'];
	$posting_end_date = $data['POSTING_END_DATE'];
	
	if ($posting_display_flg == 0) {
		$posting_display_status == "진열안함";
	} else if ($posting_display_flg == 1) {
		if ($posting_end_date == '9999-12-31 23:59') {
			$posting_display_status = "상시진열";
		} else {
			if (strtotime($posting_start_date) >= $now) {
				$posting_display_status = "진열대기";
			} else if (strtotime($posting_end_date) < $now) {
				$posting_display_status = "진열종료";
			} else if (strtotime($posting_start_date) <= $now && strtotime($posting_end_date) >= $now) {
				$posting_display_status = "진열중";
			}
		}
	}
	
	$posting_type_str = "";
	$posting_type = $data['POSTING_TYPE'];
	switch ($posting_type) {
		case "COLA" :
			$posting_type_str = "콜라보레이션";
			break;
		
		case "COLC" :
			$posting_type_str = "컬렉션";
			break;
		
		case "EDTL" :
			$posting_type_str = "에디토리얼";
			break;

		case "EXHB" :
			$posting_type_str = "기획전";
			break;

		case "LKBK" :
			$posting_type_str = "룩북";
			break;
	}
	
	$json_result['data'][] = array(
		'list_idx'					=>$data['LIST_IDX'],
		'country'					=>$data['COUNTRY'],
		'list_title'				=>$data['LIST_TITLE'],
		'list_memo'					=>$data['LIST_MEMO'],
		'list_img_location'			=>$data['LIST_IMG_LOCATION'],
		'list_display_status'		=>$list_display_status,
		'list_start_date'			=>$data['LIST_START_DATE'],
		'list_end_date'				=>$data['LIST_END_DATE'],
		
		'posting_type'				=>$posting_type_str,
		'page_title'				=>$data['PAGE_TITLE'],
		'page_memo'					=>$data['PAGE_MEMO'],
		'page_url'					=>$data['PAGE_URL'],
		'posting_display_status'	=>$posting_display_status,
		'posting_start_date'		=>$data['POSTING_START_DATE'],
		'posting_end_date'			=>$data['POSTING_END_DATE'],
		
		'page_view'					=>$data['PAGE_VIEW'],
		'creater'					=>$data['CREATER'],
		'create_date'				=>$data['CREATE_DATE'],
		'updater'					=>$data['UPDATER'],
		'update_date'				=>$data['UPDATE_DATE']
	);
}
?>