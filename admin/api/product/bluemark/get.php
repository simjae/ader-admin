<?php
/*
 +=============================================================================
 | 
 | 블루마크 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.08.10
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$search_type 		= $_POST['search_type'];			//검색분류
$search_keyword 	= $_POST['search_keyword'];			//검색 키워드

$status				= $_POST['status'];

$search_date 		= $_POST['search_date'];			//일자검색 옵션
$bluemark_from 		= $_POST['bluemark_from'];				//검색시작일
$bluemark_to 		= $_POST['bluemark_to'];				//검색종료일

$rows = $_POST['rows'];
$page = $_POST['page'];

//검색 유형 - 디폴트
$where = '1=1';
$where .= ' AND (BLUEMARK.DEL_FLG = FALSE) ';
$where_cnt = $where;

//검색 유형 - 검색분류
if ($search_type != null && $search_keyword != null) {
	switch ($search_type) {
		case "product_code" :
			$where .= ' AND (BLUEMARK.PRODUCT_CODE LIKE "%'.$search_keyword.'%") ';
			break;
		
		case "product_name" :
			$where .= ' AND (BLUEMARK.PRODUCT_CODE LIKE "%'.$search_keyword.'%") ';
			break;
		
		case "option_code" :
			$where .= ' AND (OPTION.OPTION_CODE LIKE "%'.$search_keyword.'%") ';
			break;
		
		case "option_name" :
			$where .= ' AND (OPTION.OPTION_NAME LIKE "%'.$search_keyword.'%") ';
			break;
		
		case "serial_code" :
			$where .= ' AND (BLUEMARK.SERIAL_CODE LIKE "%'.$search_keyword.'%") ';
			break;
		
		case "member_id" :
			$where .= ' AND (BLUEMARK.MEMBER_ID LIKE "%'.$search_keyword.'%") ';
			break;
		
		case "member_name" :
			$where .= ' AND (BLUEMARK.MEMBER_NAME LIKE "%'.$search_keyword.'%") ';
			break;
		
		case "tel_mobile" :
			$where .= ' AND (BLUEMARK.TEL_MOBILE LIKE "%'.$search_keyword.'%") ';
			break;
			
		case "email" :
			$where .= ' AND (BLUEMARK.EMAIL LIKE "%'.$search_keyword.'%") ';
			break;
	}
}

if ($status != null && $status != "all") {
	$where .= "AND (BLUEMARK.STATUS = ".$status.") ";
}

//검색 유형 - 상품 등록일
if ($search_date != null) {
	$certify_date_sql = "
		(SELECT MAX(REG_DATE) FROM dev.BLUEMARK_LOG WHERE BLUEMARK_IDX = BLUEMARK.IDX)
	";
	switch ($search_date) {
		case "today" :
			$where .= ' AND (BLUEMARK.CREATE_DATE = CURDATE()) ';
			break;
		case "01d" :
			$where .= ' AND (BLUEMARK.CREATE_DATE >= (CURDATE() - INTERVAL 1 DAY)) ';
			break;
		case "03d" :
			$where .= ' AND (BLUEMARK.CREATE_DATE >= (CURDATE() - INTERVAL 3 DAY)) ';
			break;
		case "07d" :
			$where .= ' AND (BLUEMARK.CREATE_DATE >= (CURDATE() - INTERVAL 7 DAY)) ';
			break;
		case "15d" :
			$where .= ' AND (BLUEMARK.CREATE_DATE >= (CURDATE() - INTERVAL 15 DAY)) ';
			break;
		case "01m" :
			$where .= ' AND (BLUEMARK.CREATE_DATE >= (CURDATE() - INTERVAL 1 MONTH)) ';
			break;
		case "03m" :
			$where .= ' AND (BLUEMARK.CREATE_DATE >= (CURDATE() - INTERVAL 3 MONTH)) ';
			break;
		case "01y" :
			$where .= ' AND (BLUEMARK.CREATE_DATE >= (CURDATE() - INTERVAL 1 YEAR)) ';
			break;
	}
}
if ($bluemark_from != null && $bluemark_to != null) {
	$where .= " AND (BLUEMARK.CREATE_DATE BETWEEN '".$bluemark_from."' AND '".$bluemark_to."') ";
}

/** 정렬 조건 **/
$order = '';
if ($sort_value != null && $sort_type != null) {
	$order = ' BLUEMARK.'.$sort_value." ".$sort_type." ";
} else {
	$order = ' BLUEMARK.IDX DESC';
}

$tables = "dev.BLUEMARK_INFO BLUEMARK
		LEFT JOIN dev.SHOP_PRODUCT PRODUCT ON
		BLUEMARK.PRODUCT_CODE = PRODUCT.PRODUCT_CODE
		LEFT JOIN dev.PRODUCT_OPTION OPTION ON
		BLUEMARK.OPTION_CODE = OPTION.OPTION_CODE
		";

$json_result = array(
	'total' => $db->count($tables,$where),
	'total_cnt' => $db->count($tables,$where_cnt),
	'page' => $page
);

$limit_start = (intval($page)-1)*$rows;

$sql = "SELECT
			BLUEMARK.IDX,
			IFNULL(BLUEMARK.PRODUCT_CODE,'-') AS PRODUCT_CODE,
			IFNULL(PRODUCT.PRODUCT_NAME,'-') AS PRODUCT_NAME,
			IFNULL(OPTION.OPTION_CODE,'-') AS OPTION_CODE,
			IFNULL(OPTION.OPTION_NAME,'-') AS OPTION_NAME,
			BLUEMARK.SERIAL_CODE,
			IFNULL(BLUEMARK.SEASON,'-') AS SEASON,
			DATE_FORMAT(BLUEMARK.CREATE_DATE,'%Y-%m-%d %H:%i') AS CREATE_DATE,
			BLUEMARK.STATUS,
			IFNULL(BLUEMARK.MEMBER_ID,'-') AS MEMBER_ID,
			IFNULL(BLUEMARK.MEMBER_NAME,'-') AS MEMBER_NAME,
			IFNULL(BLUEMARK.TEL_MOBILE,'-') AS TEL_MOBILE,
			IFNULL(EMAIL,'-') AS EMAIL,
			IFNULL((SELECT MAX(DATE_FORMAT(REG_DATE,'%Y-%m-%d %H:%i')) FROM dev.BLUEMARK_LOG WHERE BLUEMARK_IDX = BLUEMARK.IDX),'-') AS REG_DATE
		FROM
			".$tables."
		WHERE
			".$where."
		ORDER BY
			".$order;

if ($rows != null && $select_idx_flg == null) {
	$sql .= " LIMIT ".$limit_start.",".$rows;
}

$db->query($sql,$where_values);
foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'num'				=>$total_cnt--,
		'idx'				=>$data['IDX'],
		'product_code'		=>$data['PRODUCT_CODE'],
		'product_name'		=>$data['PRODUCT_NAME'],
		'option_code'		=>$data['OPTION_CODE'],
		'option_name'		=>$data['OPTION_NAME'],
		'serial_code'		=>$data['SERIAL_CODE'],
		'season'			=>$data['SEASON'],
		'create_date'		=>$data['CREATE_DATE'],
		'status'			=>$data['STATUS'],
		'member_id'			=>$data['MEMBER_ID'],
		'member_name'		=>$data['MEMBER_NAME'],
		'tel_mobile'		=>$data['TEL_MOBILE'],
		'email'				=>$data['EMAIL'],
		'reg_date'			=>$data['REG_DATE']
	);
}
?>