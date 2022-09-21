<?php
/*
 +=============================================================================
 | 
 | 로그 기록 상세
 | -----------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2015.08.21
 | 최종 수정일	: 2020-06-10
 | 버전			: 1.0
 | 설명			: (2015.08.21) 최초작성
 |                (2016.06.15) 상세 검색 기능 추가
 |                (2016.12.30) 이전 달 기록 조회 가능토록 쿼리 수정
 |                (2016.07.19) json 형식으로 변경
 |                (2020-06-10) 구문 변경, 클래스 객체 사용
 | 
 +=============================================================================
*/
$where = '1=1';
if($sid) {
	$where .= ' AND ID=?';
	$where_values[] = $sid;
}
if($sip) {
	$where .= ' AND IPV4 = ? ';
	$where_values[] = $sip;
}
if($sdevice) {
	$where .= ' AND DEVICE = ? ';
	$where_values[] = $sdevice;
}
if($sos) {
	$where .= ' AND OS LIKE ? ';
	$where_values[] = '%'.$sos.'%';
}
if($sbrowser) {
	$where .= ' AND BROWSER LIKE ? ';
	$where_values[] = '%'.$sbrowser.'%';
}
if($skeyword) {
	$where .= ' AND FROMURL LIKE ? ';
	$where_values[] = '%'.$skeyword.'%';
}
if($sfrom) {
	$where .= ' AND ACCESS_DATE >= ? ';
	$where_values[] = $sfrom.' 00:00:00';
}
if($sto) {
	$where .= ' AND ACCESS_DATE <= ? ';
	$where_values[] = $sto.' 23:59:59';
}
if($sfrom) {
	$sfrom_ym = substr(str_replace('-','',$sfrom),0,6);
	$sto_ym = substr(str_replace('-','',$sfrom),0,6);
}
if($sto) {
	if(!$sfrom) $sfrom_ym = substr(str_replace('-','',$sto),0,6);
	$sto_ym = substr(str_replace('-','',$sto),0,6);
}

$total = 0;
if($sfrom || $sto) {
	for($i=intval($sfrom_ym);$i<=intval($sto_ym);$i++) {
		$dbtable = substr($_TABLE['LOG'],0,strlen($_TABLE['LOG'])-6).$i;
		$query[] = '(
			SELECT 
					ACCESS_DATE,ID,IPV4,OS,BROWSER,FROMURL 
				FROM '.$dbtable.' 
			WHERE '.$where.' 
			ORDER BY 
				IDX DESC
		)';
		$total += $db->count($dbtable,$where,$where_values);
	}
}
else {
	$query[] = 'SELECT * FROM '.$_TABLE['LOG'].' WHERE '.$where.' ORDER BY IDX DESC';
	$total = $db->count($_TABLE['LOG'],$where,$where_values);
}
$query = implode(' UNION ',$query).' LIMIT ?,? ';
$json_result = array(
	'total' => $total,
	'page' => $page
);
$where_values[] = ($page-1)*$pagenum;
$where_values[] = $pagenum;
$db->query($query,$where_values);
foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'no'=>$data['IDX'],
		'regdate'=>$data['ACCESS_DATE'],
		'id'=>$data['ID'],
		'ip'=>$data['IPV4'],
		'os'=>$data['OS'],
		'device'=>$data['DEVICE'],
		'browser'=>$data['BROWSER'],
		'referer'=>$data['FROMURL']
	);
}
?>