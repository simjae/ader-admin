<?php
/*
 +=============================================================================
 | 
 | 단일 회원정보 취득
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.12.28
 | 최종 수정일	:
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

/** 변수 정리 **/
$country        = $_POST['country'];
$member_idx     = $_POST['member_idx'];

$tables = '';

$member_table = '';
if($country != null){
	switch($country){
		case 'KR':
			$member_table .= 'MEMBER_KR AS MEMBER';
			break;
		case 'EN':
			$member_table .= 'MEMBER_EN AS MEMBER';
			break;
		case 'CN':
			$member_table .= 'MEMBER_CN AS MEMBER';
			break;
	}
	$tables .= $member_table;
}
/** 검색 조건 **/
$where = '  MEMBER.IDX = '.$member_idx.' ';

$sql = "SELECT
			MEMBER.IDX,
            MEMBER.COUNTRY,
			MEMBER.MEMBER_ID,
			(SELECT TITLE FROM MEMBER_LEVEL WHERE IDX = MEMBER.LEVEL_IDX) AS LEVEL,
			MEMBER.MEMBER_NAME,
			ROUND((TO_DAYS(NOW()) - (TO_DAYS(MEMBER.MEMBER_BIRTH))) / 365) AS AGE,
			MEMBER.MEMBER_GENDER,
			MEMBER.LOT_ADDR,
			MEMBER.ROAD_ADDR,
			MEMBER.DETAIL_ADDR,
			MEMBER.TEL_MOBILE
		FROM
			".$tables."
		WHERE
			".$where;

$db->query($sql);
foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'no'=>intval($data['IDX']),
        'country'=>$data['COUNTRY'],
		'member_id'=>$data['MEMBER_ID'],
		'level'=>$data['LEVEL'],
		'member_name'=>$data['MEMBER_NAME'],
		'age'=>$data['AGE'],
		'member_gender'=>$data['MEMBER_GENDER'],
		'lot_addr'=>$data['LOT_ADDR'],
		'road_addr'=>$data['ROAD_ADDR'],
		'detail_addr'=>$data['DETAIL_ADDR'],
		'tel_mobile'=>$data['TEL_MOBILE']
	);
}
?>