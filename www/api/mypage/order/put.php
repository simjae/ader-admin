<?php
/*
 +=============================================================================
 | 
 | 마이페이지_주문조회화면 - 주문 상태 변경 (주문취소)
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

if ($member_idx > 0 && $order_idx > 0 && $order_product_idx > 0) {
	$order_cnt = $db->count("dev.ORDER_PRODUCT","IDX = ".$order_product_idx." AND ORDER_IDX = ".$order_idx);
	
	if ($order_cnt > 0) {
		//주문상태변경 - 주문취소
		if ($order_status == "OCC") {
			$select_order_sql = "
				SELECT
					OI.PG_PAYMENT_KEY		AS PG_PAYMENT_KEY,
					OP.PRODUCT_PRICE		AS PRODUCT_PRICE
				FROM
					dev.ORDER_INFO OI
					LEFT JOIN dev.ORDER_PRODUCT OP ON
					OI.IDX = OP.ORDER_IDX
				WHERE
					OI.IDX = ".$order_idx." AND
					OI.MEMBER_IDX = ".$member_idx." AND
					OP.IDX = ".$order_product_idx."
			";
			
			$db->query($select_order_sql);
			
			$order_info = array();
			
			foreach($db->fetch() as $order_data) {
				$order_info = array(
					'pg_payment_key'		=>$order_data['PG_PAYMENT_KEY'],
					'product_price'			=>$order_data['PRODUCT_PRICE']
				);
			}
			
			if (count($order_info) > 0) {
				$curl = curl_init();

				curl_setopt_array($curl, [
					CURLOPT_URL => "https://api.tosspayments.com/v1/payments/".$order_info['pg_payment_key']."/cancel",
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => "",
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 30,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => "POST",
					CURLOPT_POSTFIELDS => "{\"cancelReason\":\"주문취소\",\"cancelAmount\":".$order_info['product_price']."}",
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
								dev.ORDER_PRODUCT
							SET
								ORDER_STATUS = '".$order_status."',
								PG_CANCEL_DATE = '".$pg_cancel_date."',
								UPDATE_DATE = NOW(),
								UPDATER = '".$member_id."'
							WHERE
								IDX = ".$order_product_idx."
						";
						
						$db->query($update_order_product_sql);
						
						$db_result = $db->affectedRows();
						
						if ($db_result > 0) {
							//주문정보 상태 변경
							$order_cnt = $db->count("dev.ORDER_PRODUCT","ORDER_IDX = ".$order_idx);
							$order_cancel_cnt = $db->count("dev.ORDER_PRODUCT","ORDER_IDX = ".$order_idx." AND ORDER_STATUS = 'OCC'");
							
							if ($order_cnt == $order_cancel_cnt) {
								$update_order_info_sql = "
									UPDATE
										dev.ORDER_INFO
									SET
										ORDER_STATUS = '".$order_status."',
										CANCEL_DATE = '".$pg_cancel_date."',
										PG_STATUS = '".$pg_status."',
										UPDATE_DATE = NOW(),
										UPDATER = '".$member_id."'
									WHERE
										IDX = ".$order_idx." AND
										MEMBER_IDX = ".$member_idx."
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
		} else if ($order_status == "OEX" || $order_status == "ORF") {
			//주문상태변경 - 교환/환불 접수
			$update_status_date = "";
			if ($order_status == "OEX") {
				$update_status_date = " EXCHANGE_DATE = NOW(), ";
			} else if ($order_status == "ORF") {
				$update_status_date = " REFUND_DATE = NOW(), ";
			}
			
			$update_order_product_sql = "
				UPDATE
					dev.ORDER_PRODUCT
				SET
					ORDER_STATUS = '".$order_status."',
					".$update_status_date."
					UPDATE_DATE = NOW(),
					UPDATER = '".$member_id."'
				WHERE
					IDX = ".$order_product_idx."
			";
			
			$db->query($update_order_product_sql);
			
			$db_result = $db->affectedRows();
			
			if ($db_result > 0) {
				putOrderInfoStatus($db,$order_idx,$order_status,$member_id);
			}
		}
	} else {
		$json_result['code'] = 301;
		$json_result['msg'] = "선택한 주문정보가 존재하지 않습니다.";
		
		return $json_result;
	}
} else {
	$json_result['code'] = 302;
	$json_result['msg'] = "부적절한 주문 정보가 선택되었습니다. 취소/환불 하려는 주문을 다시 선택해주세요.";
	
	return $json_result;
}

function putOrderInfoStatus($db,$order_idx,$order_status,$member_id) {
	$order_cnt = $db->count("dev.ORDER_PRODUCT","ORDER_IDX = ".$order_idx);
	$order_status_cnt = $db->count("dev.ORDER_PRODUCT","ORDER_IDX = ".$order_idx." AND ORDER_STATUS = '".$order_status."'");
	
	if ($order_cnt == $order_status_cnt) {
		$update_status_date = "";
		if ($order_status == "OEX") {
			$update_status_date = " EXCHANGE_DATE = NOW(), ";
		} else if ($order_status == "ORF") {
			$update_status_date = " REFUND_DATE = NOW(), ";
		}
		
		$update_order_info_sql = "
			UPDATE
				dev.ORDER_INFO
			SET
				ORDER_STATUS = '".$order_status."',
				".$update_status_date."
				UPDATE_DATE = NOW(),
				UPDATER = '".$member_id."'
			WHERE
				IDX = ".$order_idx."
				
		";
		
		$db->query($update_order_info_sql);
	}
}

?>