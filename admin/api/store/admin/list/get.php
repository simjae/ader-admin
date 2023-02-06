<?php
/*
 +=============================================================================
 | 
 | 관리자 : 관리자계정 리스트
 | ----------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.07.18
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$sort_type		= $_POST['sort_type'];
$sort_value		= $_POST['sort_value'];

$rows			= $_POST['rows'];
$page			= $_POST['page'];

$where .= " AD.DEL_FLG = FALSE ";
$where_cnt = $where;

$limit_start = (intval($page)-1)*$rows;

$total_cnt = $db->count("dev.ADMIN AD ",$where_cnt);
$json_result = array(
	'total'		=> $db->count("dev.ADMIN AD ",$where),
	'total_cnt'	=> $total_cnt,
	'page'		=> $page
);

$order = $sort_value." ".$sort_type;

$select_admin_sql = "
	SELECT 
		AD.IDX				AS ADMIN_IDX, 
		AD.ADMIN_ID			AS ADMIN_ID,
		AD.ADMIN_NAME		AS ADMIN_NAME,
		AD.ADMIN_NICK		AS ADMIN_NICK,
		PI.TITLE			AS ADMIN_PERMITION,
		AD.ADMIN_STATUS		AS ADMIN_STATUS,
		AD.JOIN_DATE		AS JOIN_DATE
	FROM 
		dev.ADMIN AD
		LEFT JOIN dev.PERMITION_INFO PI ON
		AD.PERMITION_IDX = PI.IDX
	WHERE 
		".$where."
	ORDER BY
		".$order."
";

if ($rows != null) {
	$select_admin_sql .= " LIMIT ".$limit_start.",".$rows;
}

$db->query($select_admin_sql);

foreach($db->fetch() as $admin_data) {
	
	$admin_status = "";
	if ($admin_data['ADMIN_STATUS'] == true) {
		$admin_status = "활성";
	} else {
		$admin_status = "비활성";
	}
	
	$json_result['data'][] = array(
		'num'					=>$total_cnt--,
		'admin_idx'				=>$admin_data['ADMIN_IDX'],
		'admin_id'				=>$admin_data['ADMIN_ID'],
		'admin_name'			=>$admin_data['ADMIN_NAME'],
		'admin_nick'			=>$admin_data['ADMIN_NICK'],
		'admin_permition'		=>$admin_data['ADMIN_PERMITION'],
		'admin_status'			=>$admin_status,
		'join_date'				=>$admin_data['JOIN_DATE']
	);
}
?>