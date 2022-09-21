<?php
/*
 +=============================================================================
 | 
 | 관리자 권한 목록
 | -------------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2015.09.07
 | 최종 수정일	: 2017.07.15
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$total = db_count($_TABLE['ADMIN_PERMIT']);	// 전체
$num = 0;
if(DBMS == 'MYSQL' || DBMS == 'MYSQLi') {
	$query  = 'SELECT * FROM '.$_TABLE['ADMIN_PERMIT'];
	$query .= ' ORDER BY IDX DESC';
}
$sql = db_query($query);
$json_result['total'] = $total+1;
$json_result['data'][$num++] = array(
	'no'=>0,
	'title'=>'슈퍼관리자 (모든 권한)'
);
if($total > 0) {
	while($data = db_array($sql)) {
		$no = $data['IDX'];
		$title = $data['TITLE'];

		$json_result['data'][$num++] = array(
			'no'=>$no,
			'title'=>$title
		);
	}
}
?>