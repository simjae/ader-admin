<?php
/*
 +=============================================================================
 | 
 | 회원 목록
 | -------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2017.05.12
 | 최종 수정일	: 2022.06.30
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/


/** 검색 조건 **/
$where = '1=1';
/** 변수 정리 **/

$member_id = $_POST['member_id'];				//멤버ID
$drop_type = $_POST['drop_type'];				//탈퇴유형
$drop_reason = $_POST['drop_reason'];			//탈퇴이유
$search_date = $_POST['search_date'];			//탈퇴일자
$drop_from = $_POST['drop_from'];				//탈퇴일자 - 시작일
$drop_to = $_POST['drop_to'];					//탈퇴일자 - 종료일

$sort_type = $_POST['sort_type'];				//정렬타입
$sort_value = $_POST['sort_value'];				//정렬 기준값

$tables = '
	'.$_TABLE['MEMBER_DROP'].' AS A
';

/** 검색 조건 **/
$where = '1=1';
/*if ($member_id != null) {
	$where .= " AND (A.ID LIKE '%".$member_id."%') ";
}

if ($drop_type != null) {
	$where .= " AND (A.DROP_TYPE = '".$drop_type."') ";
}

if ($drop_reason != null) {
	$where .= " AND (A.DROP_REASON = '".$drop_reason."') ";
}*/

if ($search_date != null) {
	switch ($search_date) {
		case "today" :
			$where .= ' AND (A.DROP_DATE = CURDATE()) ';
			break;
		
		case "01d" :
			$where .= ' AND (A.DROP_DATE = (CURDATE() - INTERVAL 1 DAY)) ';
			break;
		
		case "03d" :
			$where .= ' AND (A.DROP_DATE >= (CURDATE() - INTERVAL 3 DAY)) ';
			break;
		
		case "07d" :
			$where .= ' AND (A.DROP_DATE >= (CURDATE() - INTERVAL 7 DAY)) ';
			break;
		
		case "15d" :
			$where .= ' AND (A.DROP_DATE >= (CURDATE() - INTERVAL 15 DAY)) ';
			break;
		
		case "01m" :
			$where .= ' AND (A.DROP_DATE >= (CURDATE() - INTERVAL 1 MONTH)) ';
			break;
		
		case "03m" :
			$where .= ' AND (A.DROP_DATE >= (CURDATE() - INTERVAL 3 MONTH)) ';
			break;
	}
} else if ($sleep_from != null && $sleep_to != null) {
	$where .= " AND (A.DROP_DATE BETWEEN '".$sleep_from."' AND '".$sleep_to."') ";
}

/** 정렬 조건 **/
$order = '';

switch ($sort_type) {
	case 'JOIN_DATE' :
		$sort_type = ' A.JOIN_DATE ';
	break;
	case 'ID' :
		$sort_type = ' A.ID ';
	break;
	case 'LEVEL' :
		$sort_type = ' A.LEVEL ';
	break;
	case 'GENDER' :
		$sort_type = ' A.GENDER ';
	break;
	case 'AGE' :
		$sort_type = ' A.AGE ';
	break;
	case 'REGION' :
		$sort_type = ' A.REGION ';
	break;
}

if ($sort_type != '') {
	$order .= $sort_type.$sort_value;
} else {
	$order = 'A.IDX DESC';
}

/** DB 처리 **/

$json_result = array(
	'total' => $db->count($tables,$where),
	'page' => intval($page),
	'pagenum' => $pagenum
);

	//검색항목
$sql = "SELECT
			A.IDX,
			A.ID,
			A.DROP_DATE,
			A.DROP_TYPE,
			A.REMARK
		FROM
			".$tables."
		WHERE
			".$where;

$db->query($sql);

foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'no'=>intval($data['IDX']),
		'num'=>$vno--,
		'id'=>$data['ID'],
		'drop_date'=>$data['DROP_DATE'],
		'drop_type'=>$data['DROP_TYPE'],
		'remark'=>$data['REMARK'],
	);
}
?>