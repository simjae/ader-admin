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
$sort_type = $_POST['sort_type'];
$sort_value = $_POST['sort_value'];
$rows = $_POST['rows'];
$page = $_POST['page'];

$tables = ' '.$_TABLE['ADMIN'].' AS A ';
$where = ' DEL_FLG = FALSE ';
$where_cnt = $where;

$limit_start = (intval($page)-1)*$rows;

$total_cnt = $db->count($tables, $where_cnt);
$json_result = array(
	'total' => $db->count($tables,$where),
	'total_cnt' => $total_cnt,
	'page' => $page
);

$order  = $sort_value." ".$sort_type;
$sql = '
	SELECT 
		ADMIN.IDX								AS IDX, 
		ADMIN.ID								AS ID,
		ADMIN.NAME								AS NAME,
		ADMIN.NICK								AS NICK,
		ADMIN.EMAIL								AS EMAIL,
		ADMIN.TEL								AS TEL,
		ADMIN.STATUS							AS STATUS,
		(
			SELECT
				TITLE
			FROM
				dev.ADMINISTRATOR_PERMITION
			WHERE
				IDX = ADMIN.PERMITION_NO
		)										AS PERMITION,
		ADMIN.JOIN_DATE							AS JOIN_DATE
	FROM 
		dev.ADMINISTRATOR ADMIN
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
		'no'		=> $total_cnt--,
		'idx'		=> $data['IDX'],
		'id'		=> $data['ID'],
		'nick'		=> $data['NICK'],
		'name'		=> $data['NAME'],
		'permition'	=> $data['PERMITION'],
		'email'		=> $data['EMAIL'],
		'tel'		=> $data['TEL'],
		'status'	=> $data['STATUS'],
		'join_date'	=> $data['JOIN_DATE']
	);
}
?>