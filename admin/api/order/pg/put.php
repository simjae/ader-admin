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

include_once("/var/www/admin/api/common/common.php");

$session_id				= sessionCheck();
$order_idx				= $_POST['order_idx'];

if ($order_idx != null) {
	$order_cnt = $db->count("ORDER_PRODUCT","ORDER_IDX IN (".implode(",",$order_idx).") AND ORDER_STATUS = 'ORF'");
	
	if ($order_cnt > 0) {
		$select_order_sql = "
			SELECT
				OI.IDX					AS ORDER_IDX,
				OP.IDX					AS ORDER_PRODUCT_IDX,
				OI.PG_PAYMENT_KEY		AS PG_PAYMENT_KEY,
				OP.PRODUCT_PRICE		AS PRODUCT_PRICE
			FROM
				ORDER_INFO OI
				LEFT JOIN ORDER_PRODUCT OP ON
				OI.IDX = OP.ORDER_IDX
			WHERE
				OI.IDX IN (".implode(",",$order_idx).") AND
				OP.ORDER_STATUS = 'ORF'
		";
		
		$db->query($select_order_sql);
		
		$order_info = array();
		
		foreach($db->fetch() as $order_data) {
			$order_info[] = array(
				'order_idx'				=>$order_data['ORDER_IDX'],
				'order_product_idx'		=>$order_data['ORDER_PRODUCT_IDX'],
				'pg_payment_key'		=>$order_data['PG_PAYMENT_KEY'],
				'product_price'			=>$order_data['PRODUCT_PRICE']
			);
		}
		
		if (count($order_info) > 0) {
			for ($i=0; $i<count($order_info); $i++) {
				$curl = curl_init();
				
				curl_setopt_array($curl, [
					CURLOPT_URL => "https://api.tosspayments.com/v1/payments/".$order_info[$i]['pg_payment_key']."/cancel",
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => "",
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 30,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => "POST",
					CURLOPT_POSTFIELDS => "{\"cancelReason\":\"주문취소\",\"cancelAmount\":".$order_info[$i]['product_price']."}",
					CURLOPT_HTTPHEADER => [
						"Authorization: Basic dGVzdF9za19ONU9XUmFwZEE4ZFkyMTc1N2piM28xekVxWktMOg==",
						"Content-Type: application/json"
					],
				]);

				$response = curl_exec($curl);
				$err = curl_error($curl);
				
				curl_close($curl);
				
				if (!$err) {
					$result = json_decode($response);
					
					$pg_payment_key = null;
					if (isset($result->paymentKey)) {
						$pg_payment_key = $result->paymentKey;
					}
					
					if ($pg_payment_key != null) {
						$pg_status = null;
						if (isset($result->status)) {
							$pg_status = $result->status;
						}
						
						$pg_cancel_date = null;
						if (isset($result->approvedAt)) {
							$pg_cancel_date = $result->approvedAt;
						}
						
						$message = null;
						if (isset($result->message)) {
							$message = $result->message;
						}
						
						$update_order_product_sql = "
							UPDATE
								ORDER_PRODUCT
							SET
								ORDER_STATUS = 'ORP',
								PG_CANCEL_DATE = '".$pg_cancel_date."',
								UPDATE_DATE = NOW(),
								UPDATER = '".$session_id."'
							WHERE
								IDX = ".$order_info[$i]['order_product_idx']."
						";
						
						$db->query($update_order_product_sql);
						
						$db_result = $db->affectedRows();
						
						if ($db_result > 0) {
							//주문정보 상태 변경
							$order_cnt = $db->count("ORDER_PRODUCT","ORDER_IDX = ".$order_info[$i]['order_idx']);
							$order_refund_cnt = $db->count("ORDER_PRODUCT","ORDER_IDX = ".$order_info[$i]['order_idx']." AND ORDER_STATUS != 'ORP'");
							
							if ($order_cnt == $order_cancel_cnt) {
								$update_order_info_sql = "
									UPDATE
										ORDER_INFO
									SET
										ORDER_STATUS = 'ORP',
										REFUND_DATE = '".$pg_cancel_date."',
										PG_STATUS = '".$pg_status."',
										UPDATE_DATE = NOW(),
										UPDATER = '".$member_id."'
									WHERE
										IDX = ".$order_info[$i]['order_idx']."
								";
								
								$db->query($update_order_info_sql);
							}
						}
					} else {
						$json_result['code'] = 301;
						$json_result['msg'] = $message;
						
						return $json_result;
					}
				}
			}
		}
	} else {
		$json_result['code'] = 301;
		$json_result['msg'] = "선택한 주문정보중 환불완료 처리가 가능한 주문정보가 존재하지 않습니다.";
		
		return $json_result;
	}
} else {
	$json_result['code'] = 302;
	$json_result['msg'] = "부적절한 주문 정보가 선택되었습니다. 환불완료 하려는 주문을 다시 선택해주세요.";
	
	return $json_result;
}

?>