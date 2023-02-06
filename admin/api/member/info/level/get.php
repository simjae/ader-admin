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

/** 변수 정리 **/
$tables = '
	dev.MEMBER_LEVEL AS ML
';

/** DB 처리 **/

$json_result = array(
	'total' => $db->count($tables,$where),
	'page' => intval($page)
);

	//검색항목
$sql = "SELECT
			ML.IDX,
			ML.TITLE,
			ML.MILEAGE_PER,
			ML.DEL_FLG,
			ML.CREATE_DATE,
			ML.CREATER,
			ML.UPDATE_DATE,
			ML.UPDATER,
			(SELECT COUNT(*) FROM dev.MEMBER_KR WHERE LEVEL_IDX = ML.IDX AND MEMBER_STATUS = 'NML') AS KR_COUNT,
			(SELECT COUNT(*) FROM dev.MEMBER_EN WHERE LEVEL_IDX = ML.IDX AND MEMBER_STATUS = 'NML') AS EN_COUNT,
			(SELECT COUNT(*) FROM dev.MEMBER_CN WHERE LEVEL_IDX = ML.IDX AND MEMBER_STATUS = 'NML') AS CN_COUNT
		FROM
			".$tables;

$db->query($sql);

foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'idx'=>$data['IDX'],
		'title'=>$data['TITLE'],
		'mileage_per'=>$data['MILEAGE_PER'],
		'del_flg'=>$data['DEL_FLG'],
		'create_date'=>$data['CREATE_DATE'],
		'creater'=>$data['CREATER'],
		'update_date'=>$data['UPDATE_DATE'],
		'updater'=>$data['UPDATER'],
		'kr_count'=>$data['KR_COUNT'],
		'en_count'=>$data['EN_COUNT'],
		'cn_count'=>$data['CN_COUNT'],
		/*
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
		*/
	);
}
?>