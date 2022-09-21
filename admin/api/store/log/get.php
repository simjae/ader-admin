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
$admin_permition 		= $_POST['admin_permition'];	//권한 검색분류
$permition_keyword 		= $_POST['permition_keyword'];	//권한 검색 키워드

$search_date 			= $_POST['search_date'];		//날짜검색 옵션
$admin_from 			= $_POST['admin_from'];			//날짜검색 시작일
$admin_to 				= $_POST['admin_to'];			//날짜검색 종료일

$sort_type 				= $_POST['sort_type'];			//정렬 타입
$sort_value 			= $_POST['sort_value'];			//정렬 값			

$rows 					= $_POST['rows'];
$page 					= $_POST['page'];

$tables = '
	dev.ADMINISTRATOR_LOG	AS A
';

//검색 유형 - 디폴트
$where = '1=1 ';
$where_cnt = $where;

if ($admin_permition != null){
	$where .= " AND CREATER_LEVEL IN (SELECT 	TITLE
										FROM 	dev.ADMINISTRATOR_PERMITION
										WHERE	IDX LIKE '%".$admin_permition."%')";
} 
if($permition_keyword != null) {
	$where .= " AND CREATER IN (SELECT 	NAME
								FROM 	dev.ADMINISTRATOR
								WHERE	ID LIKE '%".$permition_keyword."%')";
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
	$order = ' A.'.$sort_value." ".$sort_type." ";
} else {
	$order = ' A.IDX DESC';
}

$limit_start = (intval($page)-1)*$rows;
$json_result = array(
	'total' => $db->count($tables,$where),
	'total_cnt' => $db->count($tables,$where_cnt),
	'page' => $page
);

$sql = 	'
		SELECT 
				A.*
		FROM 
			'.$tables.'
		WHERE 
			'.$where.'
		ORDER BY 
			'.$order.'
		';
if ($rows != null) {
	$sql .= " LIMIT ".$limit_start.",".$rows;
}

$db->query($sql,$where_values);
foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'no'			    =>intval($data['IDX']),
		'log_type'			=>$data['LOG_TYPE'],
		'log_contents'		=>$data['LOG_CONTENTS'],
		'create_date'		=>$data['CREATE_DATE'],
		'creater'		    =>$data['CREATER'],
		'creater_level'		=>$data['CREATER_LEVEL'],
        'creater_ip'        =>$data['CREATER_IP']
	);
}
?>