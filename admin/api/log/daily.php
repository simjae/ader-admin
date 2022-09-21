<?php
/*
 +=============================================================================
 | 
 | 로그 기록 상세
 | --------------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2015. 8.21
 | 최종 수정일	: 2020-06-10
 | 버전			: 1.0
 | 설명			: (2015.8.21) 최초작성
 |                (2016.6.15) 상세 검색 기능 추가
 |                (2016.12.30) 이전 달 기록 조회 가능토록 쿼리 수정
 |                (2020-06-10) 구문 변경, 클래스 객체 사용
 |
 | 
 +=============================================================================
*/
$tables = $_TABLE['COUNTER'];
$where = '1=1';
if($sfrom) {
	$where .= ' AND LOG_DATE >= ?';
	$where_values[] = $sfrom;
}
if($sto) {
	$where .= ' AND LOG_DATE <= ? ';
	$where_values[] = $sto;
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
		'regdate'=>$data['LOG_DATE'],
		'counter'=>array(
			'total'=>intval($data['TOTAL']),
			'today'=>intval($data['TODAY'])
		),
		'view'=>array(
			'total'=>intval($data['VIEW_TOTAL']),
			'today'=>intval($data['VIEW_TODAY'])
		)
	);
}
?>