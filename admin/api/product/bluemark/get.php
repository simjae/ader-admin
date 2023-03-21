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
$status				= $_POST['status'];					//블루마크 인증 상태
$search_date 		= $_POST['search_date'];			//일자검색 옵션
$date_from 			= $_POST['date_from'];				//검색시작일
$date_to 			= $_POST['date_to'];				//검색종료일

$rows = $_POST['rows'];
$page = $_POST['page'];

//검색 유형 - 디폴트
$where = '1=1';
$where .= ' AND (BI.DEL_FLG = FALSE) ';
$where_cnt = $where;

//검색 유형 - 검색분류
if ($search_type != null && $search_keyword != null) {
	switch ($search_type) {
		case "product_code" :
			$where .= ' AND (BI.PRODUCT_CODE LIKE "%'.$search_keyword.'%") ';
			break;
		
		case "product_name" :
			$where .= ' AND (BI.PRODUCT_NAME LIKE "%'.$search_keyword.'%") ';
			break;
		
		case "barcode" :
			$where .= ' AND (BI.BARCODE LIKE "%'.$search_keyword.'%") ';
			break;
		
		case "option_name" :
			$where .= ' AND (BI.OPTION_NAME LIKE "%'.$search_keyword.'%") ';
			break;
		
		case "serial_code" :
			$where .= ' AND (BI.SERIAL_CODE LIKE "%'.$search_keyword.'%") ';
			break;
		
		case "member_id" :
			$where .= ' AND (BI.MEMBER_ID LIKE "%'.$search_keyword.'%") ';
			break;
		
		case "member_name" :
			$where .= ' AND (BI.MEMBER_NAME LIKE "%'.$search_keyword.'%") ';
			break;
		
		case "tel_mobile" :
			$where .= ' AND (BI.TEL_MOBILE LIKE "%'.$search_keyword.'%") ';
			break;
			
		case "email" :
			$where .= ' AND (BI.EMAIL LIKE "%'.$search_keyword.'%") ';
			break;
	}
}

if ($status != null && $status != "all") {
	$where .= "AND (BI.STATUS = ".$status.") ";
}
//검색 유형 - 상품 등록일
if ($search_date != null && $search_date != 'all') {
	switch ($search_date) {
		case "today" :
			$where .= ' AND (BI.CREATE_DATE = CURDATE()) ';
			break;
		case "01d" :
			$where .= ' AND (BI.CREATE_DATE = (CURDATE() - INTERVAL 1 DAY)) ';
			break;
		case "03d" :
			$where .= ' AND (BI.CREATE_DATE >= (CURDATE() - INTERVAL 3 DAY)) ';
			break;
		case "07d" :
			$where .= ' AND (BI.CREATE_DATE >= (CURDATE() - INTERVAL 7 DAY)) ';
			break;
		case "15d" :
			$where .= ' AND (BI.CREATE_DATE >= (CURDATE() - INTERVAL 15 DAY)) ';
			break;
		case "01m" :
			$where .= ' AND (BI.CREATE_DATE >= (CURDATE() - INTERVAL 1 MONTH)) ';
			break;
		case "03m" :
			$where .= ' AND (BI.CREATE_DATE >= (CURDATE() - INTERVAL 3 MONTH)) ';
			break;
		case "01y" :
			$where .= ' AND (BI.CREATE_DATE >= (CURDATE() - INTERVAL 1 YEAR)) ';
			break;
	}
}

if ($bluemark_from != null && $bluemark_to != null) {
	$where .= " AND (BI.CREATE_DATE BETWEEN '".$bluemark_from."' AND '".$bluemark_to."') ";
}

/** 정렬 조건 **/
$order = '';
if ($sort_value != null && $sort_type != null) {
	$order = ' BI.'.$sort_value." ".$sort_type." ";
} else {
	$order = ' BI.IDX DESC';
}

$json_result = array(
	'total' => $db->count("BLUEMARK_INFO BI",$where),
	'total_cnt' => $db->count("BLUEMARK_INFO BI",$where_cnt),
	'page' => $page
);

$limit_start = (intval($page)-1)*$rows;

$sql = "SELECT
			BI.IDX				AS BLUEMARK_IDX,
			BI.PRODUCT_CODE		AS PRODUCT_CODE,
			BI.PRODUCT_NAME		AS PRODUCT_NAME,
			BI.BARCODE			AS BARCODE,
			BI.OPTION_NAME		AS OPTION_NAME,
			BI.SERIAL_CODE		AS SERIAL_CODE,
			IFNULL(
				BI.SEASON,'-'
			)					AS SEASON,
			DATE_FORMAT(
				BI.CREATE_DATE,
				'%Y-%m-%d %H:%i'
			)					AS CREATE_DATE,
			BI.STATUS			AS STATUS,
			IFNULL(
				BI.MEMBER_ID,'-'
			)					AS MEMBER_ID,
			IFNULL(
				BI.MEMBER_NAME,'-'
			)					AS MEMBER_NAME,
			IFNULL(
				BI.TEL_MOBILE,'-'
			)					AS TEL_MOBILE,
			IFNULL(
				BI.EMAIL,'-'
			)					AS EMAIL,
			IFNULL(
				(
					SELECT
						MAX(DATE_FORMAT(REG_DATE,'%Y-%m-%d %H:%i'))
					FROM
						BLUEMARK_LOG S_BL
					WHERE
						S_BL.BLUEMARK_IDX = BI.IDX
				),
				'-'
			)					AS REG_DATE
		FROM
			BLUEMARK_INFO BI
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
		'idx'				=>$data['BLUEMARK_IDX'],
		'product_code'		=>$data['PRODUCT_CODE'],
		'product_name'		=>$data['PRODUCT_NAME'],
		'barcode'			=>$data['BARCODE'],
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