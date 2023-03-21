<?php
/*
 +=============================================================================
 | 
 | FAQ 카테고리 리스트 
 | -----------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.03.02
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$no = intval($no);
$category_no = intval($category_no);

$where = ' STATUS="Y" AND FATHER_NO='.$category_no.' ';
$where_values = array($category_no);

$json_result['total'] = $db->count('FAQ_CATEGORY',$where);
$db->query('
	SELECT 
		IDX,
		TITLE,
		LANG 
	FROM 
		FAQ_CATEGORY
	WHERE 
		'.$where.' 
	ORDER BY 
		SEQ,
		IDX');
foreach($db->fetch() as $data) { 
	$json_result['data'][] = array(
		'no'=>intval($data['IDX']),
		'title'=>$data['TITLE'],
		'country'=>$data['LANG']
	);
}
?>