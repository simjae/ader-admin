<?php
/*
 +=============================================================================
 | 
 | 7-2. 취소/교환/반훔/환불 - 주문 상태 변경 (환불완료)
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2023.01.30
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$order_code			= $_POST['order_code'];

if ($order_code != null) {
	$mapping_cnt = $db->count("ORDER_MAPPING","ORDER_CODE = '".$order_code."'");
	if ($mapping_cnt > 0) {
		$select_order_mapping_sql = "
			SELECT
				TMP_ORDER_CODE
			FROM
				ORDER_MAPPING OM
			WHERE
				ORDER_CODE = '".$order_code."'
		";
		
		$db->query($select_order_mapping_sql);
		
		$tmp_order_code = "";
		foreach($db->fetch() as $mapping_data) {
			$tmp_order_code = $mapping_data['TMP_ORDER_CODE'];
		}
		
		$json_result['data'] = "http://116.124.128.246/order/indp?order_code=".$tmp_order_code;
	} else {
		$json_result['code'] = 301;
		$json_result['msg'] = "주문교환 정보가 존재하지 않습니다. 주문대상 상품 추가 후 다시 시도해주세요.";
	}
} else {
		$json_result['code'] = 302;
		$json_result['msg'] = "선택한 주문정보가 존재하지 않습니다. 주문정보 확인 후 다시 시도해주세요.";
	}

?>