<?php
/*
 +=============================================================================
 | 
 | 회원등급 목록
 | ----------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2017.06.20
 | 최종 수정일	: 2022.07.05
 | 버전		: 1.1
 | 설명		: 
 | 
 +=============================================================================
*/

/** 변수 정리 **/
$tables = '
	'.$_TABLE['MEMBER_LV'].' AS A
';

/** DB 처리 **/

$json_result = array(
	'total' => $db->count($tables,$where),
	'page' => intval($page)
);

	//검색항목
$sql = "SELECT
			A.LV,
			A.TITLE,
			A.SALE_TYPE,
			A.R_PURCHASE_PRICE,
			A.R_PURCHASE_RESERVE,
			A.R_MOBILE_PRICE,
			A.R_MOBILE_RESERVE,
			A.D_PURCHASE_PRICE,
			A.D_PURCHASE_DISCOUNT,
			A.D_MOBILE_PRICE,
			A.D_MOBILE_DISCOUNT,
			(SELECT COUNT(*) FROM dev.MEMBER WHERE LEVEL = A.TITLE AND STATUS = '정상') AS COUNT
		FROM
			".$tables;

$db->query($sql);

foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'lv'=>$data['LV'],
		'title'=>$data['TITLE'],
		'sale_type'=>$data['SALE_TYPE'],
		'r_purchase_price'=>$data['R_PURCHASE_PRICE'],
		'r_purchase_reserve'=>$data['R_PURCHASE_RESERVE'],
		'r_mobile_price'=>$data['R_MOBILE_PRICE'],
		'r_mobile_reserve'=>$data['R_MOBILE_RESERVE'],
		'd_purchase_price'=>$data['D_PURCHASE_PRICE'],
		'd_purchase_discount'=>$data['D_PURCHASE_DISCOUNT'],
		'd_mobile_price'=>$data['D_MOBILE_PRICE'],
		'd_mobile_discount'=>$data['D_MOBILE_DISCOUNT'],
		'count'=>$data['COUNT']
	);
}
?>