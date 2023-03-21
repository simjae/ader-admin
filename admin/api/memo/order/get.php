<?php
/*
 +=============================================================================
 | 
 | 메모 리스트 조회 - 주문
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

$country			= $_POST['country'];
$order_code			= $_POST['order_code'];
$order_from			= $_POST['order_from'];
$order_from			= $_POST['order_to'];
$product_code		= $_POST['product_code'];
$product_name		= $_POST['product_name'];
$to_name			= $_POST['to_name'];
$to_mobile			= $_POST['to_mobile'];
$to_addr			= $_POST['to_addr'];
$to_detail_addr		= $_POST['to_detail_addr'];

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
	LEFT JOIN ORDER_INFO OI ON
	ML.TYPE_IDX = OI.IDX
	LEFT JOIN ORDER_PRODUCT OP ON
	OI.IDX = OP.ORDER_IDX
";

$where .= " ML.MEMO_TYPE = 'OR' ";

$where_cnt = $where;

if ($country != "ALL" && $country != null) {
	$where .= " AND (OI.COUNTRY = '".$country."') ";
}

if ($order_code != null) {
	$where .= " AND (OI.ORDER_CODE LIKE '%".$order_code."%') ";
}

if ($order_from != null || $order_to != null) {
	if ($order_from != null && $order_to == null) {
		$where .= " AND (OI.ORDER_DATE >= '".$order_from."')";
	} else if ($order_from == null && $order_to != null) {
		$where .= " AND (OI.ORDER_DATE <= '".$order_to."')";
	} else if ($order_from != null && $order_to != null) {
		$where .= " AND (OI.ORDER_DATE BETWEEN '".$order_from."' AND '".$order_to."')";
	}
}

if ($product_code != null) {
	$where .= " AND (OP.PRODUCT_CODE LIKE '%".$product_code."%') ";
}

if ($product_name != null) {
	$where .= " AND (OP.PRODUCT_NAME LIKE '%".$product_name."%') ";
}

if ($to_name != null) {
	$where .= " AND (OI.TO_NAME LIKE '%".$to_name."%') ";
}

if ($to_mobile != null) {
	$where .= " AND (OI.TO_MOBILE LIKE '%".$to_mobile."%') ";
}

if ($to_addr != null) {
	$where .= "
		AND (
			OI.TO_ROAD_ADDR LIKE '%".$to_addr."%' OR
			OI.TO_LOT_ADDR LIKE '%".$to_addr."%'
		)
	";
}

if ($to_detail_addr != null) {
	$where .= " AND (OI.TO_DETAIL_ADDR LIKE '%".$to_detail_addr."%') ";
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
		ML.TYPE_COUNTRY		AS TYPE_COUNTRY,
		ML.TYPE_IDX			AS TYPE_IDX,
		
		OI.IDX				AS ORDER_IDX,
		OI.ORDER_CODE		AS ORDER_CODE,
		OI.ORDER_DATE		AS ORDER_DATE,
		OI.ORDER_TITLE		AS ORDER_TITLE,
		
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
	
	$json_result['data'][] = array(
		'num'				=>$total_cnt--,
		'type_idx'			=>$memo_data['TYPE_IDX'],
		'type_country'		=>$memo_data['TYPE_COUNTRY'],
		'txt_type_country'	=>$txt_type_country,
		
		'order_idx'			=>$memo_data['ORDER_IDX'],
		'order_code'		=>$memo_data['ORDER_CODE'],
		'order_date'		=>$memo_data['ORDER_DATE'],
		'order_title'		=>$memo_data['ORDER_TITLE'],
		
		'create_date'		=>$memo_data['CREATE_DATE'],
		'creater'			=>$memo_data['CREATER'],
		
		'memo_cnt'			=>$memo_cnt
	);
}

?>