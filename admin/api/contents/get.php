<?php
/*
 +=============================================================================
 | 
 | 컨텐츠 목록
 | ---------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2017.05.12
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$tables = $_TABLE['CONTENTS'];
$where = '1=1';
if(is_string($page_code)) {
	$where .= ' AND CODE= ? ';
	$where_values[] = $page_code;
}
if(is_numeric($no)) {
	$where .= ' AND IDX= ? ';
	$where_values[] = $no;
}
$json_result = array(
	'total' => $db->count($tables,$where,$where_values),
	'page' => $page
);
$where_values[] = ($page-1)*$pagenum;
$where_values[] = $pagenum;
$db->query('
	SELECT * 
		FROM '.$tables.'
	WHERE 
		'.$where.'
	ORDER BY 
		STATUS DESC,SEQ ASC,IDX DESC
	LIMIT 
		?,?
',$where_values);
foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'no'=>intval($data['IDX']),
		'seq'=>intval($data['SEQ']),
		'code'=>$data['CODE'],
		'year'=>$data['YEAR'],
		'title'=>$data['TITLE'],
		'image'=>$data['IMG'],
		'image_mobile'=>$data['IMG_MOBILE'],
		'thumb'=>$data['THUMB'],
		'hit'=>intval($data['HIT']),
		'status'=>($data['STATUS']=='Y')?true:false,
		'reg_date'=>$data['FINPUT_DATE'],
		'modify_date'=>$data['LINPUT_DATE']
	);

}
?>