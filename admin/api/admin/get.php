<?php
/*
 +=============================================================================
 | 
 | 관리자 목록
 | ---------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2015.09.07
 | 최종 수정일	: 2017.07.15
 | 버전		: 1.0
 | 설명		: (2017.07.15) json 형식으로 수정
 | 
 +=============================================================================
*/
$db->query('
	SELECT 
			A.*,B.TITLE 
		FROM '.$_TABLE['ADMIN'].' AS A
		LEFT JOIN '.$_TABLE['ADMIN_PERMIT'].' AS B ON A.PERMITION_NO = B.IDX 
	ORDER BY 
		A.ID DESC
');
$json_result['total'] = $db->rows();
foreach($db->fetch() as $data) {
	$permition = '슈퍼 관리자';
	if($data['TITLE'] != '') $permition = $data['TITLE'];

	$json_result['data'][] = array(
		'name'=>$data['NAME'],
		'id'=>$data['ID'],
		'nick'=>$data['NICK'],
		'tel'=>$data['TEL'],
		'mobile'=>$data['MOBILE'],
		'fax'=>$data['FAX'],
		'email'=>$data['EMAIL'],
		'profile_image'=>$data['IMG'],
		'address'=>array($data['ZIPCODE'],$data['ADDRESS'],$data['ADDRESS_EXT']),
		'permition'=>$permition,
		'join_date'=>$data['JOIN_DATE']
	);
}
?>