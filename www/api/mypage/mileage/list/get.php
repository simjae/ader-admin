<?php
/*
 +=============================================================================
 | 
 | 마이페이지 마일리지 리스트 정보 취득
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.01.09
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$country = null;
if (isset($_SESSION['COUNTRY'])) {
	$country = $_SESSION['COUNTRY'];
}

$member_idx = 0;
if(isset($_SESSION['MEMBER_IDX'])){
	$member_idx = $_SESSION['MEMBER_IDX'];
}

$list_type = NULL;
if(isset($_POST['list_type'])){
	$list_type = $_POST['list_type'];
}

if ($country == null || $member_idx == 0) {
	$json_result['code'] = 401;
	$json_result['msg'] = '로그인 정보가 없습니다';
	
	return $json_result;
}

$rows = NULL;
if(isset($_POST['rows'])){
	$rows = $_POST['rows'];
}

$page = NULL;
if(isset($_POST['page'])){
	$page = $_POST['page'];
}

if ($member_idx > 0 && $country != NULL && $list_type != NULL) {
	$where = "";
	$where_cnt = "";
	
	switch($list_type){
		case 'save':
			$where .= " WHERE MI.MILEAGE_USABLE_INC > 0";
			$where_cnt = "MI.MILEAGE_USABLE_INC > 0";
			break;
			
		case 'use':
			$where .= " WHERE MI.MILEAGE_USABLE_DEC > 0";
			$where_cnt = "MI.MILEAGE_USABLE_DEC > 0";
			break;
	}

	$json_result = array(
		'total' => $db->count("(
									SELECT 
										*
									FROM
										MILEAGE_INFO
									WHERE
										MEMBER_IDX = ".$member_idx." AND
										COUNTRY = '".$country."'
								) MI
								LEFT JOIN MILEAGE_CODE MC ON
								MI.MILEAGE_CODE = MC.MILEAGE_CODE
								LEFT JOIN ORDER_INFO OI ON
								MI.ORDER_CODE = OI.ORDER_CODE",$where_cnt),
		'page' => $page
	);

	$limit_start = (intval($page)-1)*$rows;

	$select_mileage_sql = "
		SELECT
			DATE_FORMAT(
				MI.UPDATE_DATE,
				'%Y.%m.%d'
			)						AS UPDATE_DATE,
			IFNULL(
				MI.ORDER_CODE,''
			)						AS ORDER_CODE,
			IFNULL(
				OI.PRICE_TOTAL,''
			)						AS PRICE_TOTAL,
			MC.MILEAGE_TYPE			AS MILEAGE_TYPE,
			MI.MILEAGE_USABLE_INC	AS MILEAGE_USABLE_INC,
			MI.MILEAGE_USABLE_DEC	AS MILEAGE_USABLE_DEC
		FROM
			(
				SELECT 
					*
				FROM
					MILEAGE_INFO
				WHERE
					COUNTRY = '".$country."' AND
					MEMBER_IDX = ".$member_idx."
			) MI
			LEFT JOIN MILEAGE_CODE MC ON
			MI.MILEAGE_CODE = MC.MILEAGE_CODE
			LEFT JOIN ORDER_INFO OI ON
			MI.ORDER_CODE = OI.ORDER_CODE
		".$where."
		ORDER BY
			MI.IDX DESC
		LIMIT ".$limit_start.",".$rows;

	$db->query($select_mileage_sql);

	foreach($db->fetch() as $data){
		$json_result['data'][] = array(
			'update_date'			=> $data['UPDATE_DATE'],
			'order_code'			=> $data['ORDER_CODE'],
			'price_total'			=> $data['PRICE_TOTAL'],
			'mileage_type'			=> $data['MILEAGE_TYPE'],
			'mileage_usable_inc'	=> $data['MILEAGE_USABLE_INC'],
			'mileage_usable_dec'	=> $data['MILEAGE_USABLE_DEC']
		);
	}
}
else{
	$json_result['code'] = 301;
	$json_result['msg'] = "마일정보 내역을 불러오지 못했습니다";
	exit;
}
?>