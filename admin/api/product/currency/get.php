<?php
/*
 +=============================================================================
 | 
 | 회원 목록
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.07.18
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
//검색 유형 - 디폴트
$sql = 	"SELECT
			IDX,
			COUNTRY,
			CURRENCY
		FROM
			PRODUCT_CURRENCY";

$db->query($sql);
foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'no'				=>intval($data['IDX']),
		'country'			=>$data['COUNTRY'],
		'currency'			=>$data['CURRENCY']
	);
}
?>