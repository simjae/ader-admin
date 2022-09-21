<?php
/*
 +=============================================================================
 | 
 | FAQ 분류 입력
 | -----------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2016. 8. 3
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$title = addslashes(trim($title));
$where = ' 1=1 ';
if($language != '') {
	$where .= ' AND LANGUAGE=? ';
	$where_values[] = $language;
}
if(!$db->insert($_TABLE['FAQ_CATE'],array('LANGUAGE'=>$language,'TITLE'=>$title))) {
	$code = 500;
}
else {
	$json_result = array(
		'no' => intval($db->last_id());
		'title' => $title
	);
}
?>