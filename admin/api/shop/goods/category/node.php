<?php
/*
 +=============================================================================
 | 
 | 노드 검색
 | -------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2014.12.20
 | 최종 수정일	: 2017.07.07
 | 버전		: 0.1
 | 설명		: 
 | 
 +=============================================================================
*/

while($category) {
	$data = $db->get($_TABLE['SHOP_CATEGORY'],'IDX=?',array($category))[0];
	$category = intval($data['FATHER_NO']);
	$json_result['data'][] = array(
		'no' => intval($data['IDX']),
		'node' => $data['NODE'],
		'father' => $category,
		'title' => $data['TITLE']
	);
}
?>