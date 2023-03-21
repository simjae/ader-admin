<?php
/*
 +=============================================================================
 | 
 | 회원 방문관리 페이지 - 멤버 리스트 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.07.07
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$country 			= $_POST['country'];

$search_type		= $_POST['search_type'];		//검색유형 - 이름, 아이디, 이메일, 전화번호, 휴대폰번호, 휴면일자
$search_keyword		= $_POST['search_keyword'];		//검색 키워드

$member_level		= $_POST['member_level'];			//로그인 IP
$login_ip			= $_POST['login_ip'];			//로그인 IP

$member_status		= $_POST['member_status'];

$search_date		= $_POST['search_date'];		//검색 일자
$login_from			= $_POST['login_from'];			//접속일 - 시작일
$login_to			= $_POST['login_to'];			//접속일 - 종료일

$rows				= $_POST['rows'];
$page				= $_POST['page'];

$sort_type			= $_POST['sort_type'];			//정렬타입
$sort_value			= $_POST['sort_value'];			//정렬 기준값

$where = '1=1';
$where .= " AND (MB.LOGIN_DATE IS NOT NULL) ";
$where_cnt = $where;

if ($search_keyword != null) {
	switch ($search_type) {
		case 'member_id':
			$where .= ' AND (MB.MEMBER_ID LIKE "%'.$search_keyword.'%") ';
		break;
		
		case 'member_name':
			$where .= ' AND (MB.MEMBER_NAME LIKE "%'.$search_keyword.'%") ';
		break;
		
		case 'tel_mobile':
			$where .= ' AND (MB.TEL_MOBILE LIKE "%'.$search_keyword.'%") ';
		break;
		
		case 'member_addr':
			$where .= "
				AND (
					MB.ROAD_ADDR LIKE '%".$search_keyword."%' OR
					MB.LOT_ADDR LIKE '%".$search_keyword."%'
				)
			";
		break;
	}
}

if ($member_level != null && $member_level != "ALL") {
	$where .= " AND (MB.LEVEL_IDX = ".$member_level.") ";
}

if ($login_ip != null) {
	$where .= " AND (MB.IP LIKE '%".$login_ip."%') ";
}

if ($member_status != null && $member_status != "ALL") {
	switch ($member_status) {
		case "NML" :
			$where .= " AND (MB.MEMBER_STATUS = 'NML') ";
			break;
		
		case "SLP" :
			$where .= " AND (MB.MEMBER_STATUS = 'SLP') ";
			break;
		
		case "BMB" :
			$where .= " AND (MB.MEMBER_STATUS = 'BMB') ";
			break;
		
		case "NDP" :
			$where .= " AND (MB.MEMBER_STATUS = 'DRP' AND DROP_TYPE = 'NDP') ";
			break;
		
		case "FDP" :
			$where .= " AND (MB.MEMBER_STATUS = 'DRP' AND DROP_TYPE = 'FDP') ";
			break;
	}
}

if ($search_date != null) {
	switch ($search_date) {
		case "today" :
			$where .= " AND (DATE_FORMAT(MB.LOGIN_DATE,'%Y-%m-%d') = CURDATE()) ";
			break;
		
		case "01d" :
			$where .= " AND (DATE_FORMAT(MB.LOGIN_DATE,'%Y-%m-%d') = (CURDATE() - INTERVAL 1 DAY)) ";
			break;
		
		case "03d" :
			$where .= " AND (DATE_FORMAT(MB.LOGIN_DATE,'%Y-%m-%d') >= (CURDATE() - INTERVAL 3 DAY)) ";
			break;
			
		case "07d" :
			$where .= " AND (DATE_FORMAT(MB.LOGIN_DATE,'%Y-%m-%d') >= (CURDATE() - INTERVAL 7 DAY)) ";
			break;
		
		case "15d" :
			$where .= " AND (DATE_FORMAT(MB.LOGIN_DATE,'%Y-%m-%d') >= (CURDATE() - INTERVAL 15 DAY)) ";
			break;
		
		case "01m" :
			$where .= " AND (DATE_FORMAT(MB.LOGIN_DATE,'%Y-%m-%d') >= (CURDATE() - INTERVAL 1 MONTH)) ";
			break;
		
		case "03m" :
			$where .= " AND (DATE_FORMAT(MB.LOGIN_DATE,'%Y-%m-%d') >= (CURDATE() - INTERVAL 3 MONTH)) ";
			break;

		case "01y" :
			$where .= " AND (DATE_FORMAT(MB.LOGIN_DATE,'%Y-%m-%d') >= (CURDATE() - INTERVAL 1 YEAR)) ";
			break;
	}
}

if ($login_from != null || $login_to != null) {
	if ($login_from != null && $login_to == null) {
		$where .= " AND (LOGIN_DATE >= '".$login_from."')";
	} else if ($login_from == null && $login_to != null) {
		$where .= " AND (LOGIN_DATE <= '".$login_to."')";
	} else if ($login_from != null && $login_to != null) {
		$where .= " AND (LOGIN_DATE BETWEEN '".$login_from."' AND '".$login_to."')";
	}
}

$order = '';
if ($sort_value != null && $sort_type != null) {
	$order = ' '.$sort_value." ".$sort_type." ";
} else {
	$order = ' MB.IDX DESC ';
}

$total_cnt = $db->count("MEMBER_".$country." MB",$where_cnt);
$json_result = array(
	'total' => $db->count("MEMBER_".$country." MB",$where),
	'total_cnt' => $total_cnt,
	'page' => intval($page)
);

$limit_start = (intval($page)-1)*$rows;

$select_member_sql = "
	SELECT
		MB.IDX					AS MEMBER_IDX,
		MB.COUNTRY				AS COUNTRY,
		MB.MEMBER_STATUS		AS MEMBER_STATUS,
		MB.MEMBER_ID			AS MEMBER_ID,
		LV.TITLE				AS MEMBER_LEVEL,
		MB.MEMBER_NAME			AS MEMBER_NAME,
		MB.MEMBER_BIRTH			AS MEMBER_BIRTH,
		ROUND(
			(
				TO_DAYS(NOW()) - (
					TO_DAYS(MB.MEMBER_BIRTH)
				)
			) / 365
		)						AS AGE,
		MB.MEMBER_GENDER		AS MEMBER_GENDER,
		MB.ZIPCODE				AS ZIPCODE,
		MB.ROAD_ADDR			AS ROAD_ADDR,
		MB.LOT_ADDR				AS LOT_ADDR,
		MB.DETAIL_ADDR			AS DETAIL_ADDR,
		MB.TEL_MOBILE			AS TEL_MOBILE,
		MB.RECEIVE_SMS_FLG		AS RECEIVE_SMS_FLG,
		MB.RECEIVE_PUSH_FLG		AS RECEIVE_PUSH_FLG,
		MB.RECEIVE_EMAIL_FLG	AS RECEIVE_EMAIL_FLG,
		IFNULL(
			DATE_FORMAT(
				MB.JOIN_DATE,
				'%Y-%m-%d %H:%i'
			),'-'
		)						AS JOIN_DATE,		
		IFNULL(
			DATE_FORMAT(
				MB.LOGIN_DATE,
				'%Y-%m-%d %H:%i'
			),'-'
		)						AS LOGIN_DATE,
		MB.IP					AS LOGIN_IP,
		MB.LOGIN_CNT			AS LOGIN_CNT,
		IFNULL(
			DATE_FORMAT(
				MB.SLEEP_DATE,
				'%Y-%m-%d'
			),'-'
		)						AS SLEEP_DATE,
		
		DATE_FORMAT(
			MB.SLEEP_OFF_DATE,
			'%Y-%m-%d'
		)						AS SLEEP_OFF_DATE,
		DATE_FORMAT(
			MB.DROP_DATE,
			'%Y-%m-%d'
		)						AS DROP_DATE,
		MB.DROP_TYPE			AS DROP_TYPE,
		MB.SUSPICION_FLG		AS SUSPICION_FLG,
		(
			SELECT
				IFNULL(
					COUNT(S_OI.IDX),0
				)
			FROM
				ORDER_INFO S_OI
			WHERE
				S_OI.ORDER_STATUS IN ('PCP','PPR','DPR','DPG','DCP') AND
				S_OI.MEMBER_IDX = MB.IDX
		)						AS ORDER_CNT
	FROM
		MEMBER_".$country." MB
		LEFT JOIN MEMBER_LEVEL LV ON
		MB.LEVEL_IDX = LV.IDX
	WHERE
		".$where."
	ORDER BY
		".$order."
";

if ($rows != null && $select_idx_flg == null) {
	$select_member_sql .= " LIMIT ".$limit_start.",".$rows;
}

$db->query($select_member_sql);

foreach($db->fetch() as $member_data) {
	$member_status = "";
	switch ($member_data['MEMBER_STATUS']) {
		case "NML" :
			$member_status = "정상";
			break;
		
		case "SLP" :
			$member_status = "휴면";
			break;
		
		case 'BMB':
			$member_status = "불량";
			break;
		
		case "DRP" :
			if ($member_data['DROP_TYPE'] == "NDP") {
				$member_status = "일반탈퇴";
			} else if ($member_data['DROP_TYPE'] == "FDP") {
				$member_status = "강제탈퇴";
			}
			
			break;
	}
	
	$member_gender = "";
	if ($member_data['MEMBER_GENDER'] == "M") {
		$member_gender = "남자";
	} else if ($member_data['MEMBER_GENDER'] == "F") {
		$member_gender = "여자";
	} else {
		$member_gender = "미선택";
	}
	
	$region = null;
	$road_addr = $member_data['ROAD_ADDR'];
	$lot_addr = $member_data['LOT_ADDR'];
	
	$tmp_addr = array();
	if (!empty($road_addr) && $road_addr != null) {
		$tmp_addr = explode(" ",$road_addr);
	} else if (!empty($lot_addr) && $lot_addr != null) {
		$tmp_addr = explode(" ",$lot_addr);
	}
	
	$region = $tmp_addr[0];
	
	$drop_type = "";
	if ($member_data['DROP_TYPE'] != null) {
		switch ($member_data['DROP_TYPE']) {
			case "NDP" :
				$drop_type = "일반탈퇴";
				break;
			
			case "FDP" :
				$drop_type = "강제탈퇴";
				break;
		}
	}
	
	$ip_ban_flg = false;
	
	$ip_cnt = $db->count("IP_BAN","IP = '".$member_data['LOGIN_IP']."'");
	if ($ip_cnt > 0) {
		$ip_ban_flg = true;
	}
	
	$off_visit_cnt = $db->count("OFFLINE_ENTERANCE","EMAIL = '".$member_data['MEMBER_ID']."' OR TEL = '".str_replace("-","",$member_data['TEL_MOBILE'])."'");
	
	$json_result['data'][] = array(
		'num'					=>$total_cnt--,
		'member_idx'			=>$member_data['MEMBER_IDX'],
		'country'				=>$member_data['COUNTRY'],
		'member_status'			=>$member_status,
		'member_id'				=>$member_data['MEMBER_ID'],
		'member_level'			=>$member_data['MEMBER_LEVEL'],
		'member_name'			=>$member_data['MEMBER_NAME'],
		'member_birth'			=>$member_data['MEMBER_BIRTH'],
		'age'					=>$member_data['AGE'],
		'member_gender'			=>$member_gender,
		'join_date'				=>$member_data['JOIN_DATE'],
		'zipcode'				=>$member_data['ZIPCODE'],
		'road_addr'				=>$member_data['ROAD_ADDR'],
		'lot_addr'				=>$member_data['LOT_ADDR'],
		'detail_addr'			=>$member_data['DETAIL_ADDR'],
		'region'				=>$region,
		'tel_mobile'			=>$member_data['TEL_MOBILE'],
		'receive_sms_flg'		=>$member_data['RECEIVE_SMS_FLG'],
		'receive_push_flg'		=>$member_data['RECEIVE_PUSH_FLG'],
		'receive_email_flg'		=>$member_data['RECEIVE_EMAIL_FLG'],
		'join_date'				=>$member_data['JOIN_DATE'],
		'login_date'			=>$member_data['LOGIN_DATE'],
		'login_ip'				=>$member_data['LOGIN_IP'],
		'ip_ban_flg'			=>$ip_ban_flg,
		'login_cnt'				=>$member_data['LOGIN_CNT'],
		'off_visit_cnt'			=>$off_visit_cnt,
		'sleep_date'			=>$member_data['SLEEP_DATE'],
		'sleep_off_date'		=>$member_data['SLEEP_OFF_DATE'],
		'drop_date'				=>$member_data['DROP_DATE'],
		'drop_type'				=>$drop_type,
		'suspicioun_flg'		=>$member_data['SUSPICION_FLG'],
		'order_cnt'				=>$member_data['ORDER_CNT'],
		'order_date'			=>$order_info['order_date'],
		'order_code'			=>$order_info['order_code'],
		'pg_payment'			=>$order_info['pg_payment'],
		'price_product'			=>number_format($order_info['price_product']),
		'price_total'			=>number_format($order_info['price_total'])
	);
}
?>