<?php
/*
 +=============================================================================
 | 
 | 회원등급 목록
 | ----------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2017.06.20
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$query  = 'SELECT * FROM '.$_TABLE['MEMBER_LV'].' ORDER BY LV ASC';
$sql = db_query($query);
$total = db_count($_TABLE['MEMBER_LV']);
$num = 0;
$json_result['total'] = $total;
while($data = db_array($sql)) {
	$is_admin = ($data['IS_ADMIN']=='Y')?true:false;
	$use_yn = ($data['USE_YN']=='Y')?true:false;
	$display_yn = ($data['DISPLAY_YN']=='Y')?true:false;

	$member = db_count($_TABLE['MEMBER'],'LV='.$data['LV']);

	$json_result['data'][$num++] = array(
		'lv'=>intval($data['LV']),
		'title'=>$data['TITLE'],
		'permition'=>$data['PERMITION'],
		'is_admin'=>$is_admin,
		'use_yn'=>$use_yn,
		'display_yn'=>$display_yn,
		'member'=>$member,
		'sali'=>intval($data['SALE'])
	);
}
?>