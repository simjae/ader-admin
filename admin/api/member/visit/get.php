<?php
/*
 +=============================================================================
 | 
 | 회원 목록
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

/** 변수 정리 **/
$tab_num		= $_POST['tab_num'];

$country 		= $_POST['country'];
$member_id		= $_POST['member_id'];				//ID
$login_ip		= $_POST['login_ip'];				//로그인 IP
$search_date	= $_POST['search_date'];			//검색 일자
$login_from		= $_POST['login_from'];				//접속일 - 시작일
$login_to		= $_POST['login_to'];				//접속일 - 종료일

$status			= $_POST['status'];
$member_name	= $_POST['member_name'];
$store			= $_POST['store'];
$tel_mobile		= $_POST['tel_mobile'];
$email			= $_POST['email'];
$instagram_id	= $_POST['instagram_id'];
$offline_from	= $_POST['offline_from'];			//오프라인 방문일 - 시작일
$offline_to		= $_POST['offline_to'];				//오프라인 방문일 - 종료일

$rows			= $_POST['rows'];
$page			= $_POST['page'];

$sort_type		= $_POST['sort_type'];					//정렬타입
$sort_value		= $_POST['sort_value'];					//정렬 기준값

if ($tab_num != "03") {
	$tables = ' '.$_TABLE['MEMBER'].' MEMBER';
} else {
	$tables = ' dev.OFFLINE_ENTERANCE ';
}

$where = '1=1';
/** 검색 조건 **/

//$status = "";
if ($tab_num == "02") {
	if($status != null){
		switch($status){
			case 'all':
				$where .= " AND ((STATUS = '정상' AND SUSPICION_FLG = TRUE) OR STATUS = '불량') ";
				break;
			case 'normal':
				$where .= " AND ( STATUS = '정상' AND SUSPICION_FLG = TRUE) ";
				break;
			case 'bad':
				$where .= " AND ( STATUS = '불량') ";
				break;
		}
	}
}
if($status != null && $tab_num == "01"){
	switch($status){
		case 'normal':
			$where .= " AND ( STATUS = '정상') ";
			break;
		case 'dormant':
			$where .= " AND ( STATUS = '휴면') ";
			break;
		case 'bad':
			$where .= " AND ( STATUS = '불량') ";
			break;
		case 'withdraw_wait':
			$where .= " AND ( STATUS = '탈퇴신청') ";
			break;
		case 'withdraw':
			$where .= " AND ( STATUS = '탈퇴') ";
			break;
	}
}
if ($member_id != null) {
	$where .= ' AND (ID LIKE "%'.$member_id.'%") ';
}

if ($login_ip != null) {
	$where .= ' AND (IP LIKE "%'.$login_ip.'%") ';
}
if ($search_date != null) {
	if ($tab_num == "03") {
		switch ($search_date) {
			case "today" :
				$where .= ' AND (INPUT_DATE >= CURDATE()) ';
				break;
			
			case "01d" :
				$where .= ' AND (INPUT_DATE >= (CURDATE() - INTERVAL 1 DAY)) ';
				break;
			
			case "03d" :
				$where .= ' AND (INPUT_DATE >= (CURDATE() - INTERVAL 3 DAY)) ';
				break;
			
			case "07d" :
				$where .= ' AND (INPUT_DATE >= (CURDATE() - INTERVAL 7 DAY)) ';
				break;
			
			case "15d" :
				$where .= ' AND (INPUT_DATE >= (CURDATE() - INTERVAL 15 DAY)) ';
				break;
			
			case "01m" :
				$where .= ' AND (INPUT_DATE >= (CURDATE() - INTERVAL 1 MONTH)) ';
				break;
			
			case "03m" :
				$where .= ' AND (INPUT_DATE >= (CURDATE() - INTERVAL 3 MONTH)) ';
				break;
		}
	} else {
		switch ($search_date) {
			case "today" :
				$where .= ' AND (LOGIN_DATE >= CURDATE()) ';
				break;
			
			case "01d" :
				$where .= ' AND (LOGIN_DATE >= (CURDATE() - INTERVAL 1 DAY)) ';
				break;
			
			case "03d" :
				$where .= ' AND (LOGIN_DATE >= (CURDATE() - INTERVAL 3 DAY)) ';
				break;
			
			case "07d" :
				$where .= ' AND (LOGIN_DATE >= (CURDATE() - INTERVAL 7 DAY)) ';
				break;
			
			case "15d" :
				$where .= ' AND (LOGIN_DATE >= (CURDATE() - INTERVAL 15 DAY)) ';
				break;
			
			case "01m" :
				$where .= ' AND (LOGIN_DATE >= (CURDATE() - INTERVAL 1 MONTH)) ';
				break;
			
			case "03m" :
				$where .= ' AND (LOGIN_DATE >= (CURDATE() - INTERVAL 3 MONTH)) ';
				break;
		}
	}
}
/*
if ($login_from != null && $login_to != null) {
	$where .= " AND (LOGIN_DATE BETWEEN '".$login_from."' AND '".$login_to."') ";
}
*/
if ($login_from != null){
	$where .= " AND (LOGIN_DATE >= '".$login_from."')";
}
if ($login_to != null){
	$where .= " AND (LOGIN_DATE <= '".$login_to."')";
}

if ($member_name != null) {
	$where .= ' AND (NAME LIKE "%'.$member_name.'%") ';
}

if ($store != null) {
	$where .= ' AND (STORE LIKE "%'.$store.'%") ';
}

if ($tel_mobile != null) {
	$where .= ' AND (TEL LIKE "%'.$tel_mobile.'%") ';
}

if ($email != null) {
	$where .= ' AND (EMAIL LIKE "%'.$email.'%") ';
}

if ($instagram_id != null) {
	$where .= ' AND (INSTAGRAM_ID LIKE "%'.$instagram_id.'%") ';
}

if ($offline_from != null || $offline_to != null) {	
	if ($offline_from != null && $offline_to == null) {
		$where .= " AND (INPUT_DATE >= '".$offline_from."') ";
	}
	
	if ($offline_from != null && $offline_to != null) {
		$where .= " AND (INPUT_DATE BETWEEN '".$offline_from."' AND '".$offline_to."') ";
	}
	
	if ($offline_from == null && $offline_to != null) {
		$where .= " AND (INPUT_DATE <= '".$offline_to."') ";
	}
}

/** 정렬 조건 **/
$order = '';
if ($sort_value != null && $sort_type != null) {
	$order = ' '.$sort_value." ".$sort_type." ";
} else {
	$order = ' IDX DESC ';
}
/** DB 처리 **/

$json_result = array(
	'total' => $db->count($tables,$where),
	'total_cnt' => $db->count($tables),
	'page' => intval($page)
);

$limit_start = (intval($page)-1)*$rows;

if ($tab_num != "03") {
	//검색항목
	$sql = "SELECT
				IDX,
				IFNULL(IP,'미접속') AS IP,
				IP_BAN_FLG,
				ID,
				LEVEL,
				STATUS,
				SUSPICION_FLG,
				NAME,
				TEL_MOBILE,
				JOIN_DATE,
				LOGIN_DATE,
				OFFLINE_DATE,
				RECEIVE_TEL,
				RECEIVE_SMS,
				RECEIVE_EMAIL,
				RECEIVE_PUSH,
				LOGIN_CNT,
				(SELECT COUNT(0) FROM dev.OFFLINE_ENTERANCE WHERE ID = MEMBER.ID) AS OFFLINE_CNT
			FROM
				".$tables."
			WHERE
				".$where."
			ORDER BY
				".$order."
			LIMIT
				".$limit_start.",".$rows;
} else {
	$sql = "SELECT
				IDX,
				INPUT_DATE,
				STORE,
				NAME,
				TEL,
				EMAIL,
				INSTAGRAM_ID
			FROM
				dev.OFFLINE_ENTERANCE
			WHERE
				".$where."
				AND (STORE != 'undefined' AND STORE != '' AND STORE IS NOT NULL )
			ORDER BY
				".$order."
			LIMIT
				".$limit_start.",".$rows;
}

$db->query($sql);
foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'no'			=>intval($data['IDX']),
		'num'			=>$total_cnt--,
		'ip'			=>$data['IP'],
		'ip_ban_flg'	=>$data['IP_BAN_FLG'],
		'id'			=>$data['ID'],
		'level'			=>$data['LEVEL'],
		'status'		=>$data['STATUS'],
		'suspicion_flg'	=>$data['SUSPICION_FLG'],
		'name'			=>$data['NAME'],
		'tel_mobile'	=>$data['TEL_MOBILE'],
		'join_date'		=>$data['JOIN_DATE'],
		'login_date'	=>$data['LOGIN_DATE'],
		'offline_date'	=>$data['OFFLINE_DATE'],
		'receive'		=>array(
			'email'	=>($data['RECEIVE_EMAIL']=='Y') ? true:false,
			'sms'	=>($data['RECEIVE_SMS']=='Y') ? true:false
		),
		'login_cnt'		=>$data['LOGIN_CNT'],
		'offline_cnt'	=>$data['OFFLINE_CNT'],
		
		'input_date'	=>$data['INPUT_DATE'],
		'store'			=>$data['STORE'],
		'name'			=>$data['NAME'],
		'tel'			=>$data['TEL'],
		'email'			=>$data['EMAIL'],
		'instagram_id'	=>$data['INSTAGRAM_ID']
	);
}
?>