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
$idx = $_POST['member_idx'];

$sql = '
	SELECT 
		A.*
	FROM 
		dev.ADMINISTRATOR
	WHERE 
		IDX = '.$idx.'
	';	

$db->query($sql);
foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'rn'        => $data['IDX'],
		'id'        => $data['ID'],
		'name'      => $data['NAME'],
		'nick' => $data['NICK'],
		'join_date' => $data['JOIN_DATE']
	);
}
?>