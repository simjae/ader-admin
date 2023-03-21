<?php
/*
 +=============================================================================
 | 
 | 메모 리스트 조회 - 상품
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.08.07
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$product_type		= $_POST['product_type'];
$product_code		= $_POST['product_code'];
$product_name		= $_POST['product_name'];

$date_param			= $_POST['date_param'];
$date_from			= $_POST['date_from'];
$date_to			= $_POST['date_to'];

$creater			= $_POST['creater'];
$memo				= $_POST['memo'];

$page				= $_POST['page'];
$rows				= $_POST['rows'];

$sort_type			= $_POST['sort_type'];
$sort_value			= $_POST['sort_value'];

$memo_table = "
	MEMO_LOG ML
	LEFT JOIN SHOP_PRODUCT PR ON
	ML.TYPE_IDX = PR.IDX
";

$where .= " ML.MEMO_TYPE = 'PR' ";

$where_cnt = $where;

if ($product_type != null) {
	$where .= " AND (PR.PRODUCT_TYPE = '".$product_type."') ";
}

if ($product_code != null) {
	$where .= " AND (PR.PRODUCT_CODE LIKE '%".$product_code."%') ";
}

if ($product_name != null) {
	$where .= " AND (PR.PRODUCT_NAME LIKE '%".$product_name."%') ";
}

if ($date_param != null || $date_from != null || $date_to != null) {
	if ($date_param != null) {
		switch ($date_param) {
			case "today" :
				$where .= ' AND (ML.CREATE_DATE = CURDATE()) ';
				break;
			case "01d" :
				$where .= ' AND (ML.CREATE_DATE >= (CURDATE() - INTERVAL 1 DAY)) ';
				break;
			case "03d" :
				$where .= ' AND (ML.CREATE_DATE >= (CURDATE() - INTERVAL 3 DAY)) ';
				break;
			case "07d" :
				$where .= ' AND (ML.CREATE_DATE >= (CURDATE() - INTERVAL 7 DAY)) ';
				break;
			case "15d" :
				$where .= ' AND (ML.CREATE_DATE >= (CURDATE() - INTERVAL 15 DAY)) ';
				break;
			case "01m" :
				$where .= ' AND (ML.CREATE_DATE >= (CURDATE() - INTERVAL 1 MONTH)) ';
				break;
			case "03m" :
				$where .= ' AND (ML.CREATE_DATE >= (CURDATE() - INTERVAL 3 MONTH)) ';
				break;
			case "01y" :
				$where .= ' AND (ML.CREATE_DATE >= (CURDATE() - INTERVAL 1 YEAR)) ';
				break;
		}
	} else if ($date_from != null || $date_to != null) {
		if ($date_start != null && $date_to == null) {
			$where .= " AND (ML.CREATE_DATE >= '".$date_from."') ";
		} else if ($date_from == null && $date_to != null) {
			$where .= " AND (ML.CREATE_DATE <= '".$date_to."') ";
		} else if ($date_from != null && $date_to != null) {
			$where .= " AND (ML.CREATE_DATE BETWEEN '".$date_from."' AND '".$date_to."') ";
		}
	}
}

if ($creater != null) {
	$where .= " AND (ML.CREATER LIKE '%".$creater."%') ";
}

if ($memo != null) {
	$where .= " AND (ML.MEMO LIKE '%".$memo."%') ";
}

/** 정렬 조건 **/
$order = '';
if ($sort_value != null && $sort_type != null) {
	$order = " ".$sort_value." ".$sort_type." ";
} else {
	$order = " ML.IDX DESC ";
}

$total_cnt = $db->count($memo_table,$where_cnt);

$json_result = array(
	'total' => $db->count($memo_table,$where),
	'total_cnt' => $total_cnt,
	'page' => $page
);

$select_memo_sql = "
	SELECT
		ML.IDX				AS MEMO_IDX,
		ML.MEMO_TYPE		AS MEMO_TYPE,
		ML.TYPE_COUNTRY		AS TYPE_COUNTRY,
		ML.TYPE_IDX			AS TYPE_IDX,
		
		PR.IDX				AS PRODUCT_IDX,
		PR.PRODUCT_TYPE		AS PRODUCT_TYPE,
		PR.PRODUCT_CODE		AS PRODUCT_CODE,
		PR.PRODUCT_NAME		AS PRODUCT_NAME,
		IFNULL(
			(
				SELECT
					S_PI.IMG_LOCATION
				FROM
					PRODUCT_IMG S_PI
				WHERE
					S_PI.PRODUCT_IDX = PR.IDX AND
					S_PI.IMG_TYPE = 'P' AND
					S_PI.IMG_SIZE = 'S'
			),'/images/default_product_img.jpg'
		)					AS IMG_LOCATION,
		
		ML.MEMO				AS MEMO,
		
		DATE_FORMAT(
			ML.CREATE_DATE,
			'%Y-%m-%d %H:%i'
		)					AS CREATE_DATE,
		ML.CREATER			AS CREATER
	FROM
		".$memo_table."
	WHERE
		".$where."
	ORDER BY
		".$order."
";

$limit_start = (intval($page)-1)*$rows;	
if ($rows != null) {
	$select_memo_sql .= " LIMIT ".$limit_start.",".$rows;
}

$db->query($select_memo_sql);

foreach($db->fetch() as $memo_data) {
	$memo_cnt = $db->count("MEMO_LOG","TYPE_IDX = ".$memo_data['TYPE_IDX']);
	
	$txt_type_country = "";
	switch ($memo_data['TYPE_COUNTRY']) {
		case "KR" :
			$txt_type_country = "한국몰";
			break;
		
		case "EN" :
			$txt_type_country = "영문몰";
			break;
		
		case "CN" :
			$txt_type_country = "중문몰";
			break;
	}
	
	$txt_product_type = "";
	switch ($memo_data['PRODUCT_TYPE']) {
		case "B" :
			$txt_product_type = "일반상품";
			break;
		
		case "S" :
			$txt_product_type = "세트상품";
			break;
	}
	
	$json_result['data'][] = array(
		'num'				=>$total_cnt--,
		'type_idx'			=>$memo_data['TYPE_IDX'],
		'type_country'		=>$memo_data['TYPE_COUNTRY'],
		'txt_type_country'	=>$txt_type_country,
		
		'product_idx'		=>$memo_data['PRODUCT_IDX'],
		'product_type'		=>$memo_data['PRODUCT_TYPE'],
		'txt_product_type'	=>$txt_product_type,
		'product_code'		=>$memo_data['PRODUCT_CODE'],
		'product_name'		=>$memo_data['PRODUCT_NAME'],
		'img_location'		=>$memo_data['IMG_LOCATION'],
		
		'create_date'		=>$memo_data['CREATE_DATE'],
		'creater'			=>$memo_data['CREATER'],
		
		'memo_cnt'			=>$memo_cnt
	);
}

?>