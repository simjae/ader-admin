<?php
/*
 +=============================================================================
 | 
 | 로그 기록 상세
 | --------------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2015. 8.21
 | 최종 수정일	: 2022.06.22
 | 버전			: 1.0
 | 설명			: (2015.8.21) 최초작성
 |                (2016.6.15) 상세 검색 기능 추가
 |                (2016.12.30) 이전 달 기록 조회 가능토록 쿼리 수정
 |                (2022.06.22) 레거시 코드 최신화
 | 
 +=============================================================================
*/
$where = '1=1';
if($sfrom) {
	$where .= ' AND LOG_DATE >= ? ';
	$where_values[] = $sfrom;
}
if($sto) {
	$where .= ' AND LOG_DATE <= ? ';
	$where_valuesp[] = $sto;
}
$db->query('
	SELECT 
		SUBSTR(LOG_DATE,1,7) AS DATE,SUM(TODAY) AS MONTHLY,SUM(VIEW_TODAY) AS VIEW_MONTHLY  
		FROM '.$_TABLE['COUNTER'].'
	WHERE 
		'.$where .'
	GROUP BY 
		DATE 
	ORDER BY 
		IDX DESC
',$where_values);
$db2 = new db();
foreach($db->fetch() as $data) {
	$regdate = $data['DATE'];
	$stotal = $data['TOTAL'];
	$monthly = intval($data['MONTHLY']);
	$view_total = $data['VIEW_TOTAL'];
	$view_monthly = intval($data['VIEW_MONTHLY']);

	$counter = $db2->get($_TABLE['COUNTER'],'LOG_DATE LIKE ? ORDER BY IDX DESC LIMIT 1',array($regdate.'-%'))[0];
	$total = intval($counter['TOTAL']);
	$view_total = intval($counter['VIEW_TOTAL']);

	$json_result['data'][] = array(
		'regdate'=>$regdate,
		'counter'=>array(
			'total'=>$total,
			'month'=>$monthly
		),
		'view'=>array(
			'total'=>$view_total,
			'month'=>$view_monthly
		)
	);
}
$json_result['total'] = sizeof($json_result['data']);
?>