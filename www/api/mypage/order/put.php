<?php
/*
 +=============================================================================
 | 
 | 마이페이지_주문조회화면 - 주문 상태 변경
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

$country = null;
if (isset($_SESSION['COUNTRY'])) {
	$country = $_SESSION['COUNTRY'];
}

$member_idx = 0;
if (isset($_SESSION['MEMBER_IDX'])) {
	$member_idx = $_SESSION['MEMBER_IDX'];
}

$member_id = null;
if (isset($_SESSION['MEMBER_ID'])) {
	$member_id = $_SESSION['MEMBER_ID'];
}

$order_idx = 0;
if (isset($_POST['order_idx'])) {
	$order_idx = $_POST['order_idx'];
}

$order_product_idx = 0;
if (isset($_POST['order_product_idx'])) {
	$order_product_idx = $_POST['order_product_idx'];
}

$order_status = null;
if (isset($_POST['order_status'])) {
	$order_status = $_POST['order_status'];
}

if ($member_idx > 0 && $order_idx > 0) {
	//주문상태변경 - 결제완료 => 주문취소
	if ($order_idx > 0 && $order_product_idx > 0 && ($order_status == "PCP" || $order_status == "POP")) {
		$order_status_sql = "
			AND (
				ORDER_STATUS = 'PCP' OR
				(PREORDER_FLG = TRUE AND ORDER_STATUS = 'POP')
			)
		";
		
		$pcp_cnt = $db->count("dev.ORDER_PRODUCT","IDX = ".$order_product_idx." ".$order_status_sql);
		
		if ($pcp_cnt > 0) {
			$update_order_product_sql = "
				UPDATE
					dev.ORDER_PRODUCT
				SET
					ORDER_STATUS = 'OCC',
					CANCEL_DATE = NOW(),
					UPDATE_DATE = NOW(),
					UPDATER = '".$member_id."'
				WHERE
					IDX = ".$order_product_idx." AND
					ORDER_STATUS = 'PCP'
			";
			
			$db->query($update_order_product_sql);
			
			$order_cnt = $db->count("dev.ORDER_PRODUCT","ORDER_IDX = ".$order_idx." AND (ORDER_STATUS = 'PCP' OR (PREORDER_FLG = TRUE AND ORDER_STATUS = 'POP'))");
			
			if ($order_cnt == 0) {
				$update_order_info_sql = "
					UPDATE
						dev.ORDER_INFO
					SET
						ORDER_STATUS = 'OCC',
						CANCEL_DATE = NOW(),
						UPDATE_DATE = NOW(),
						UPDATER = '".$member_id."'
					WHERE
						IDX = ".$order_idx." AND
						MEMBER_IDX = ".$member_idx."
				";
				
				$db->query($update_order_info_sql);
			}
		} else {
			$json_result['code'] = 301;
			$json_result['msg'] = "선택한 주문정보가 존재하지 않습니다.";
			
			return $json_result;
		}
	}
} else {
	$json_result['code'] = 302;
	$json_result['msg'] = "선택된 주문 정보가 존재하지없습니다. 다시 선택해주세요.";
	
	return $json_result;
}

?>