<?php
/*
 +=============================================================================
 | 
 | FAQ 내용
 | -------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2016. 8. 3
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$no = intval($no);
$category_no = intval($category_no);
$where = ' 1=1 ';
$where_values = null;
if($category_no > 0) {
	$where .= ' AND (CATEGORY_NO='.$category_no.' OR CATEGORY_NO IN (SELECT IDX FROM FAQ_CATEGORY WHERE FATHER_NO = '.$category_no.' )) ';
}
if($no > 0) {
	$where .= ' AND IDX='.$no.' ';
}
$json_result['total'] = $db->count('FAQ',$where);
$db->query('
	SELECT 
			* 
		FROM FAQ
	WHERE 
		'.$where.'
	ORDER BY 
		SEQ,IDX'
);
foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'no'=>intval($data['IDX']),
		'category_no'=>intval($data['CATEGORY_NO']),
		'question'=>$data['QUESTION'],
		'answer'=>$data['ANSWER']
	);
}
?>