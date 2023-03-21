<?php
/*
 +=============================================================================
 | 
 | 회원 방문관리 페이지 - 오프라인 방문기록
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.03.06
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$search_type		= $_POST['search_type'];		//검색유형 - 아이디, 이름, 휴대전화
$search_keyword		= $_POST['search_keyword'];		//검색 키워드

$country			= $_POST['country'];

$off_store			= $_POST['off_store'];
$off_instagram		= $_POST['off_instagram'];

$offline_from		= $_POST['offline_from'];			//오프라인 방문일 - 시작일
$offline_to			= $_POST['offline_to'];				//오프라인 방문일 - 종료일

$rows				= $_POST['rows'];
$page				= $_POST['page'];

$sort_type			= $_POST['sort_type'];					//정렬타입
$sort_value			= $_POST['sort_value'];					//정렬 기준값

$tables = ' OFFLINE_ENTERANCE ';

$where = '1=1';
/** 검색 조건 **/

if ($search_keyword != null) {
	switch ($search_type) {
		case 'customer_id':
			$where .= ' AND (OE.ID LIKE "%'.$search_keyword.'%") ';
		break;
		
		case 'customer_name':
			$where .= ' AND (OE.NAME LIKE "%'.$search_keyword.'%") ';
		break;
		
		case 'customer_tel':
			$where .= ' AND (OE.TEL LIKE "%'.$search_keyword.'%") ';
		break;
		case 'customer_email':
			$where .= ' AND (OE.EMAIL LIKE "%'.$search_keyword.'%") ';
		break;
	}
}

if ($country != null) {
	$where .= ' AND (COUNTRY = "'.$country.'") ';
}

if ($off_store != null) {
	if($off_store == 'empty'){
		$off_store = '';
	}
	$where .= ' AND (STORE = "'.$off_store.'") ';
}

if ($off_instagram != null) {
	$where .= ' AND (INSTAGRAM_ID LIKE "%'.$off_instagram.'%") ';
}

if ($search_date != null) {
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
		case "01y" :
			$where .= ' AND (INPUT_DATE >= (CURDATE() - INTERVAL 1 YEAR)) ';
			break;
	}
}

if ($offline_from != null && $offline_to != null) {
	$where .= " AND (INPUT_DATE BETWEEN '".$offline_from."' AND '".$offline_to."') ";
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

$sql = "SELECT
				IDX,
				INPUT_DATE,
				STORE,
				ID,
				NAME,
				TEL,
				TEL_CP,
				EMAIL,
				INSTAGRAM_ID,
				IP
			FROM
				OFFLINE_ENTERANCE
			WHERE
				".$where."
			ORDER BY
				".$order."
			LIMIT
				".$limit_start.",".$rows;

$db->query($sql);
foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'no'			=>intval($data['IDX']),
		'num'			=>$total_cnt--,

		'input_date' 	=> $data['INPUT_DATE'],
		'store' 		=> $data['STORE'],
		'id' 			=> $data['ID'],
		'name' 			=> $data['NAME'],
		'tel' 			=> $data['TEL'],
		'tel_cp' 		=> $data['TEL_CP'],
		'email' 		=> $data['EMAIL'],
		'instagram_id' 	=> $data['INSTAGRAM_ID'],
		'ip' 			=> $data['IP']
	);
}
?>