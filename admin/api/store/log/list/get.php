<?php
/*
 +=============================================================================
 | 
 | 회원 목록
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.07.19
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$permition_idx 		= $_POST['permition_idx'];	//권한 검색분류
$creater 			= $_POST['creater'];		//권한 검색 키워드

$search_date 		= $_POST['search_date'];	//날짜검색 옵션
$admin_from 		= $_POST['admin_from'];		//날짜검색 시작일
$admin_to 			= $_POST['admin_to'];		//날짜검색 종료일

$sort_type 			= $_POST['sort_type'];		//정렬 타입
$sort_value 		= $_POST['sort_value'];		//정렬 값			

$rows 				= $_POST['rows'];
$page 				= $_POST['page'];

//검색 유형 - 디폴트
$where = '1=1 ';
$where_cnt = $where;

$tables = "
	dev.ADMIN_LOG AL
	LEFT JOIN dev.ADMIN AD ON
	AL.CREATER = AD.ADMIN_ID
";

if ($permition_idx != null && $permition_idx != "ALL") {
	$where .= " AND (AD.PERMITION_IDX = ".$permition_idx.") ";
}

if ($creater != null) {
	$where .= " AND (AL.CREATER LIKE '%".$creater."%') ";
}

//검색 유형 - 상품 등록일
if ($search_date != null) {
	switch ($search_date) {
		case "today" :
			$where .= ' AND (A.CREATE_DATE = CURDATE()) ';
			break;
		
		case "01d" :
			$where .= ' AND (A.CREATE_DATE = (CURDATE() - INTERVAL 1 DAY)) ';
			break;
		
		case "03d" :
			$where .= ' AND (A.CREATE_DATE >= (CURDATE() - INTERVAL 3 DAY)) ';
			break;
		
		case "07d" :
			$where .= ' AND (A.CREATE_DATE >= (CURDATE() - INTERVAL 7 DAY)) ';
			break;
		
		case "15d" :
			$where .= ' AND (A.CREATE_DATE >= (CURDATE() - INTERVAL 15 DAY)) ';
			break;
		
		case "01m" :
			$where .= ' AND (A.CREATE_DATE >= (CURDATE() - INTERVAL 1 MONTH)) ';
			break;
		
		case "03m" :
			$where .= ' AND (A.CREATE_DATE >= (CURDATE() - INTERVAL 3 MONTH)) ';
			break;
	}
}
if ($admin_from != null && $admin_to != null) {
	$where .= " AND (A.CREATE_DATE BETWEEN '".$admin_from."' AND '".$admin_to."') ";
}

/** 정렬 조건 **/
$order = '';
if ($sort_value != null && $sort_type != null) {
	$order = ' AL.'.$sort_value." ".$sort_type." ";
} else {
	$order = ' AL.IDX DESC';
}

$limit_start = (intval($page)-1)*$rows;

$total_cnt = $db->count($tables,$where_cnt);
$json_result = array(
	'total' => $db->count($tables,$where),
	'total_cnt' => $total_cnt,
	'page' => $page
);

$select_log_sql = "
	SELECT 
		AL.IDX				AS LOG_IDX,
		AL.LOG_TYPE			AS LOG_TYPE,
		AL.LOG_CONTENTS		AS LOG_CONTENTS,
		AL.CREATE_DATE		AS CREATE_DATE,
		AL.CREATER			AS CREATER,
		AL.CREATER_LEVEL	AS CREATER_LEVEL,
		AL.CREATER_IP		AS CREATER_IP
	FROM
		".$tables."
	WHERE 
		".$where."
	ORDER BY 
		".$order."
";

if ($rows != null) {
	$select_log_sql .= " LIMIT ".$limit_start.",".$rows;
}

$db->query($select_log_sql);

foreach($db->fetch() as $log_data) {
	$json_result['data'][] = array(
		'num'			    =>$total_cnt--,
		'log_idx'			=>$log_data['LOG_IDX'],
		'log_type'			=>$log_data['LOG_TYPE'],
		'log_contents'		=>$log_data['LOG_CONTENTS'],
		'create_date'		=>$log_data['CREATE_DATE'],
		'creater'		    =>$log_data['CREATER'],
		'creater_level'		=>$log_data['CREATER_LEVEL'],
        'creater_ip'        =>$log_data['CREATER_IP']
	);
}

?>