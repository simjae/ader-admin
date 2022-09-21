<?php
/*
 +=============================================================================
 | 
 | 로그 기록 상세
 | -----------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2015.08.21
 | 최종 수정일	: 2017.07.19
 | 버전			: 1.0
 | 설명			: (2015.08.21) 최초작성
 |                (2016.06.15) 상세 검색 기능 추가
 |                (2016.12.30) 이전 달 기록 조회 가능토록 쿼리 수정
 |                (2016.07.19) json 형식으로 변경
 | 
 +=============================================================================
*/
$tables = $_TABLE['ENTER'];
$where = '1=1';
if($name) {
	$where .= ' AND NAME = ? ';
	$where_values[] = '%'.$name.'%';
}
if(isset($store) && trim($store) != '') {
	$where .= ' AND STORE = ? ';
	$where_values[] = $store;
}
if($tel) {
	$where .= ' AND TEL LIKE ? ';
	$where_values[] = '%'.$tel.'%';
}
if($email) {
	$where .= ' AND EMAIL LIKE ? ';
	$where_values[] = '%'.$email.'%';
}
if($instagram_id) {
	$where .= ' AND INSTAGRAM_ID LIKE ? ';
	$where_values[] = '%'.$instagram_id.'%';
}
if($date_from) {
	$where .= ' AND INPUT_DATE >= ? ';
	$where_values[] = $date_from.' 00:00:00';
}
if($date_to) {
	$where .= ' AND INPUT_DATE <= ? ';
	$where_values[] = $date_to.' 23:59:59';
}
$json_result = array(
	'total' => $db->count($tables,$where,$where_values),
	'page' => $page
);
$where_values[] = ($page-1)*$pagenum;
$where_values[] = $pagenum;
$db->query('
	SELECT 
			*
		FROM '.$tables.' 
	WHERE 
		'.$where.' 
	ORDER BY 
		IDX DESC 
	 LIMIT ?,?
',$where_values);
foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'no'=>intval($data['IDX']),
		'reg_date'=>$data['INPUT_DATE'],
		'name'=>$data['NAME'],
		'tel'=>$data['TEL'],
		'email'=>$data['EMAIL'],
		'instagram_id'=>$data['INSTAGRAM_ID'],
		'store'=>$data['STORE']
	);
}
?>