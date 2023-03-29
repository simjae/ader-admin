<?php
/*
 +=============================================================================
 | 
 | 마이페이지 마일리지 현황정보 취득
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.01.11
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
if (isset($_SESSION['MEMBER_IDX'])) {
	$member_idx = $_SESSION['MEMBER_IDX'];
}

if ($country == null || $member_idx == 0) {
    $json_result['code'] = 401;
    $json_result['msg'] = '로그인 정보가 없습니다';
	
	return $json_result;
}

if($member_idx > 0 && $country != NULL){
	$select_mileage_sql = "
		SELECT 
			IFNULL(
				(
					SELECT 
						MILEAGE_BALANCE 
					FROM 
						MILEAGE_INFO 
					WHERE 
						COUNTRY = '".$country."' AND
						MEMBER_IDX = ".$member_idx."
					ORDER BY 
						IDX DESC 
					LIMIT 0,1
				),0
			)			AS MILEAGE_BALANCE,
			IFNULL(
				SUM(PRICE_MILEAGE_POINT),0
			)			AS REFUND_SCHEDULED,
			IFNULL(
				SUM(MILEAGE_USABLE_DEC),0
			)			AS USED_MILEAGE
		FROM
			MILEAGE_INFO MI
			LEFT JOIN ORDER_INFO OI ON
			MI.ORDER_CODE = OI.ORDER_CODE AND
			OI.ORDER_STATUS = 'ORF'
		WHERE
			MI.COUNTRY = '".$country."' AND
			MI.MEMBER_IDX = ".$member_idx."
	";

	$db->query($select_mileage_sql);

	foreach($db->fetch() as $data){
		$json_result['data'] = array(
			'mileage_balance'		=> $data['MILEAGE_BALANCE'],
			'refund_scheduled'		=> $data['REFUND_SCHEDULED'],
			'used_mileage'			=> $data['USED_MILEAGE'],
		);
	}
}

?>