<?php	
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	
	$order_id = null;
	if (isset($_GET['orderId'])) {
		$order_id = $_GET['orderId'];
	}

	$payment_key = null;
	if (isset($_GET['paymentKey'])) {
		$payment_key = $_GET['paymentKey'];
	}

	$amount = null;
	if (isset($_GET['amount'])) {
		$amount = $_GET['amount'];
	}

	$curl = curl_init();

	curl_setopt_array($curl, [
		CURLOPT_URL => "https://api.tosspayments.com/v1/payments/confirm",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => "
			{
				\"orderId\":\"".$order_id."\",
				\"paymentKey\":\"".$payment_key."\",
				\"amount\":".$amount."
				
			}
		",
		CURLOPT_HTTPHEADER => [
			"Authorization: Basic dGVzdF9za19ONU9XUmFwZEE4ZFkyMTc1N2piM28xekVxWktMOg==",
			"Content-Type: application/json"
		],
	]);

	$response = curl_exec($curl);
	$err = curl_error($curl);
	
	if (!$err) {
		$result = json_decode($response);
		
		$pg_mid = null;
		if (isset($result->mId)) {
			$pg_mid = $result->mId;
		}
		
		if ($pg_mid != null) {
			$pg_payment = null;
			if (isset($result->method)) {
				$pg_payment = $result->method;
			}

			$pg_payment_key = null;
			if (isset($result->paymentKey)) {
				$pg_payment_key = $result->paymentKey;
			}

			$pg_status = null;
			if (isset($result->status)) {
				$pg_status = $result->status;
			}

			$pg_date = null;
			if (isset($result->approvedAt)) {
				$pg_date = $result->approvedAt;
			}
			
			$pg_price = null;
			if (isset($result->totalAmount)) {
				$pg_price = $result->totalAmount;
			}
			
			$pg_currency = null;
			if (isset($result->currency)) {
				$pg_currency = $result->currency;
			}

			$pg_receipt_url = null;
			if (isset($result->receipt)) {
				$receipt = $result->receipt;
				if ($receipt != null) {
					$pg_receipt_url = $receipt->url;
				}
			}
			
			try {
				if ($order_id != null && $pg_mid != null) {
					$insert_order_info_sql = "
						INSERT INTO
							dev.ORDER_INFO
						(
							COUNTRY,
							ORDER_CODE,
							ORDER_TITLE,
							ORDER_STATUS,
							ORDER_DATE,
							MEMBER_IDX,
							MEMBER_LEVEL,
							MEMBER_ID,
							MEMBER_NAME,
							MEMBER_MOBILE,
							MEMBER_EMAIL,
							PRICE_PRODUCT,
							PRICE_MILEAGE_POINT,
							PRICE_CHARGE_POINT,
							PRICE_DISCOUNT,
							PRICE_TOTAL,
							
							PG_MID,
							PG_PAYMENT,
							PG_PAYMENT_KEY,
							PG_STATUS,
							PG_DATE,
							PG_PRICE,
							PG_CURRENCY,
							PG_RECEIPT_URL,
							
							TO_PLACE,
							TO_NAME,
							TO_MOBILE,
							TO_ZIPCODE,
							TO_LOT_ADDR,
							TO_ROAD_ADDR,
							TO_DETAIL_ADDR,
							ORDER_MEMO,
							CREATE_DATE,
							CREATER,
							UPDATE_DATE,
							UPDATER
						)
						SELECT
							TI.COUNTRY					AS COUNTRY,
							TI.ORDER_CODE				AS ORDER_CODE,
							TI.ORDER_TITLE				AS ORDER_TITLE,
							TI.ORDER_STATUS				AS ORDER_STATUS,
							TI.ORDER_DATE				AS ORDER_DATE,
							TI.MEMBER_IDX				AS MEMBER_IDX,
							TI.MEMBER_LEVEL				AS MEMBER_LEVEL,
							TI.MEMBER_ID				AS MEMBER_ID,
							TI.MEMBER_NAME				AS MEMBER_NAME,
							TI.MEMBER_MOBILE			AS MEMBER_MOBILE,
							TI.MEMBER_EMAIL				AS MEMBER_EMAIL,
							TI.PRICE_PRODUCT			AS PRICE_PRODUCT,
							TI.PRICE_MILEAGE_POINT		AS PRICE_MILEAGE_POINT,
							TI.PRICE_CHARGE_POINT		AS PRICE_CHARGE_POINT,
							TI.PRICE_DISCOUNT			AS PRICE_DISCOUNT,
							TI.PRICE_TOTAL				AS PRICE_TOTAL,

							'".$pg_mid."'				AS PG_MID,
							'".$pg_payment."'			AS PG_PAYMENT,
							'".$pg_payment_key."'		AS PG_PAYMENT_KEY,
							'".$pg_status."'			AS PG_STATUS,
							'".$pg_date."'				AS PG_DATE,
							'".$pg_price."'				AS PG_PRICE,
							'".$pg_currency."'			AS PG_CURRENCY,
							'".$pg_receipt_url."'		AS PG_RECEIPT_URL,

							TI.TO_PLACE					AS TO_PLCAE,
							TI.TO_NAME					AS TO_NAME,
							TI.TO_MOBILE				AS TO_MOBILE,
							TI.TO_ZIPCODE				AS TO_ZIPCODE,
							TI.TO_LOT_ADDR				AS TO_LOT_ADDR,
							TI.TO_ROAD_ADDR				AS TO_ROAD_ADDR,
							TI.TO_DETAIL_ADDR			AS TO_DETAIL_ADDR,
							TI.ORDER_MEMO				AS ORDER_MEMO,
							TI.CREATE_DATE				AS CREATE_DATE,
							TI.CREATER					AS CREATER,
							TI.UPDATE_DATE				AS UPDATE_DATE,
							TI.UPDATER					AS UPDATER
						FROM
							dev.TMP_ORDER_INFO TI
						WHERE
							TI.ORDER_CODE = '".$order_id."'
					";
					
					$db->query($insert_order_info_sql);
					
					$order_idx = $db->last_id();
					
					if (!empty($order_idx)) {
						$insert_order_product_sql = "
							INSERT INTO
								dev.ORDER_PRODUCT
							(
								ORDER_IDX,
								ORDER_CODE,
								ORDER_PRODUCT_CODE,
								ORDER_STATUS,
								PRODUCT_IDX,
								PRODUCT_TYPE,
								REORDER_CNT,
								PREORDER_FLG,
								PRODUCT_CODE,
								PRODUCT_NAME,
								PRODUCT_PRICE,
								OPTION_IDX,
								BARCODE,
								OPTION_NAME,
								PRODUCT_QTY,
								CREATE_DATE,
								CREATER,
								UPDATE_DATE,
								UPDATER
							)
							SELECT
								".$order_idx."			AS ORDER_IDX,
								TP.ORDER_CODE			AS ORDER_CODE,
								TP.ORDER_PRODUCT_CODE	AS ORDER_PRODUCT_CODE,
								TP.ORDER_STATUS			AS ORDER_STATUS,
								TP.PRODUCT_IDX			AS PRODUCT_IDX,
								TP.PRODUCT_TYPE			AS PRODUCT_TYPE,
								TP.REORDER_CNT			AS REORDER_CNT,
								TP.PREORDER_FLG			AS PREORDER_FLG,
								TP.PRODUCT_CODE			AS PRODUCT_CODE,
								TP.PRODUCT_NAME			AS PRODUCT_NAME,
								TP.PRODUCT_PRICE		AS PRODUCT_PRICE,
								TP.OPTION_IDX			AS OPTION_IDX,
								TP.BARCODE				AS BARCODE,
								TP.OPTION_NAME			AS OPTION_NAME,
								TP.PRODUCT_QTY			AS PRODUCT_QTY,
								TP.CREATE_DATE			AS CREATE_DATE,
								TP.CREATER				AS CREATER,
								TP.UPDATE_DATE			AS UPDATE_DATE,
								TP.UPDATER				AS UPDATER	
							FROM
								dev.TMP_ORDER_PRODUCT TP
							WHERE
								TP.ORDER_CODE = '".$order_id."'
							ORDER BY
								TP.IDX DESC
						";
						
						$db->query($insert_order_product_sql);
					}
					
					$db->query("DELETE FROM dev.TMP_ORDER_PRODUCT WHERE ORDER_CODE = '".$order_id."'");
					$db->query("DELETE FROM dev.TMP_ORDER_INFO WHERE ORDER_CODE = '".$order_id."'");
					
					$db->commit();
					
					echo "
						<script>
							location.href='/order/complete?order_idx=".$order_idx."';
						</script>
					";
				}
			} catch(mysqli_sql_exception $exception){
				$db->rollback();
				print_r($exception);
				
				$json_result['code'] = 301;
				$json_result['msg'] = "주문정보 등록처리중 오류가 발생했습니다.";
			}
		} else {
			$message = null;
			if (isset($result->message)) {
				$message = $result->message;
			}
			
			try {
				if ($order_id != null) {
					$tmp_product_cnt = $db->count("dev.TMP_ORDER_PRODUCT","ORDER_CODE = '".$order_id."'");
					
					$update_tmp_order_basket_sql = "
						UPDATE
							dev.BASKET_INFO
						SET
							DEL_FLG = FALSE
						WHERE
							IDX IN (
								SELECT
									*
								FROM
									(
										SELECT
											BI.IDX
										FROM
											dev.BASKET_INFO BI
										WHERE
											BI.MEMBER_IDX = 1 AND
											BI.PRODUCT_IDX IN (
												SELECT
													TP.PRODUCT_IDX
												FROM
													dev.TMP_ORDER_PRODUCT TP
												WHERE
													TP.ORDER_CODE = '".$order_id."' AND
													TP.PRODUCT_CODE NOT LIKE 'VOUXXX%'
											)
										ORDER BY
											BI.IDX DESC
										LIMIT
											0,".$tmp_product_cnt."
									) AS TMP
							)
					";
					
					$db->query($update_tmp_order_basket_sql);
					
					$voucher_cnt = $db->count("dev.TMP_ORDER_PRODUCT","ORDER_CODE = '".$order_id."' AND PRODUCT_CODE LIKE 'VOUXXX%'");
					
					if ($voucher_cnt > 0) {
						$update_voucher_sql = "
							UPDATE
								dev.VOUCHER_ISSUE
							SET
								USED_FLG = FALSE,
								UPDATE_DATE = NOW(),
								UPDATER = '".$member_id."'
							WHERE
								IDX = (
									SELECT
										TP.PRODUCT_IDX
									FROM
										dev.TMP_ORDER_PRODUCT TP
									WHERE
										TP.ORDER_CODE = '".$order_id."' AND
										TP.PRODUCT_CODE LIKE 'VOUXXX%'
								)
						";
						
						$db->query($update_voucher_sql);
					}
					
					$db->query("DELETE FROM dev.TMP_ORDER_PRODUCT WHERE ORDER_CODE = '".$order_id."'");
					$db->query("DELETE FROM dev.TMP_ORDER_INFO WHERE ORDER_CODE = '".$order_id."'");
					
					$db->commit();
					
					echo "
						<script>
							alert('".$message."');
							location.href='/main';
						</script>
					";
				}
			} catch(mysqli_sql_exception $exception){
				$db->rollback();
				print_r($exception);
				
				$json_result['code'] = 301;
				$json_result['msg'] = "주문정보 등록처리중 오류가 발생했습니다.";
			}
		}
	}
	
	curl_close($curl);
?>