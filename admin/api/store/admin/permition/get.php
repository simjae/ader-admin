<?php
/*
 +=============================================================================
 | 
 | 운영자 권한 설정 - 권한 리스트 조회
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

$db->query("SELECT DISTINCT PERMITION_SORT FROM ADMIN_PERMITION");

$permition_sort = array();
foreach($db->fetch() as $sort_data) {
	$permition_sort[] = $sort_data['PERMITION_SORT'];
}

$select_admin_permition_sql = "
	SELECT
		AP.IDX					AS PERMITION_IDX,
		AP.PERMITION_TYPE		AS PERMITION_TYPE,
		AP.PERMITION_SORT		AS PERMITION_SORT,
		AP.PERMITION_NAME		AS PERMITION_NAME,
		AP.PERMITION_URL		AS PERMITION_URL,
		IFNULL(
			AP.PERMITION_TAB,
			'없음'
		)						AS PERMITION_TAB
	FROM
		ADMIN_PERMITION AP
";

$db->query($select_admin_permition_sql);

$permition_info = array();
foreach($db->fetch() as $permition_data) {
	$permition_info[$permition_data['PERMITION_SORT']][] = array(
		'permition_idx'		=>$permition_data['PERMITION_IDX'],
		'permition_type'	=>$permition_data['PERMITION_TYPE'],
		'permition_name'	=>$permition_data['PERMITION_NAME'],
		'permition_url'		=>$permition_data['PERMITION_URL'],
		'permition_tab'		=>$permition_data['PERMITION_TAB']
	);
}

$json_result['data'] = array(
	'permition_sort'		=>$permition_sort,
	'permition_info'		=>$permition_info
);

?>