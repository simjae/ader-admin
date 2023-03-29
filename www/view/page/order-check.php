<?php	
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	
	$member_idx = null;
	if (isset($_SESSION['MEMBER_IDX'])) {
		$member_idx = $_SESSION['MEMBER_IDX'];
	}
	
	$member_id = null;
	if (isset($_SESSION['MEMBER_ID'])) {
		$member_id = $_SESSION['MEMBER_ID'];
	}
	
	$country = null;
	if (isset($_SESSION['COUNTRY'])) {
		$country = $_SESSION['COUNTRY'];
	}

	$order_code = null;
	if (isset($_GET['orderId'])) {
		$order_code = $_GET['orderId'];
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
				\"orderId\":\"".$order_code."\",
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
		$new_order_arr = array();

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

			$vat = null;
			if (isset($result->vat)) {
				$vat = $result->vat;
			}

			$suppliedAmount = null;
			if (isset($result->suppliedAmount)) {
				$suppliedAmount = $result->suppliedAmount;
			}
			
			$order_status = null;
			
			$pg_date = "NULL";
			
			$vbank_account = "NULL";
			$vbank_type = "NULL";
			$vbank_number = "NULL";
			$vbank_name = "NULL";
			$vbank_due_date = "NULL";
			$vbank_status = "NULL";
			$vbank_secret_key = "NULL";
						
			$payment_card = $result->card;
			$payment_vbank = $result->virtualAccount;
			$payment_easypay = $result->easyPay;
			
			if ($payment_card != null || $payment_easypay != null) {
				if (isset($result->approvedAt)) {
					$pg_date = $result->approvedAt;
				}
				
				$order_status = "PCP";
			} else if ($payment_vbank != null) {
				if (isset($payment_vbank->requestedAt)) {
					$pg_date = $payment_vbank->requestedAt;
				}
				
				if (isset($payment_vbank->accountNumber)) {
					$vbank_account = "'".$payment_vbank->accountNumber."'";
				}
				
				if (isset($payment_vbank->accountType)) {
					$vbank_type = "'".$payment_vbank->accountType."'";
				}
				
				if (isset($payment_vbank->bankCode)) {
					$vbank_number = "'".$payment_vbank->bankCode."'";
					$vbank_name = getBankName($payment_vbank->bankCode);
				}
				
				if (isset($payment_vbank->dueDate)) {
					$vbank_due_date = "'".$payment_vbank->dueDate."'";
				}
				
				if (isset($payment_vbank->settlementStatus)) {
					$vbank_status = "'".$payment_vbank->settlementStatus."'";
				}
				
				if (isset($payment_vbank->secret)) {
					$vbank_secret_key = "'".$payment_vbank->secret."'";
				}
				
				$order_status = "PWT";
			}

			$new_order_arr['order_code'] = $order_code;
			$new_order_arr['suppliedAmount'] = $suppliedAmount;
			$new_order_arr['pg_currency'] = $pg_currency;
			$new_order_arr['vat'] = $vat;
			
			try {
				if ($order_code != null && $pg_mid != null) {
					$insert_order_info_sql = "
						INSERT INTO
							ORDER_INFO
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
							
							VBANK_ACCOUNT,
							VBANK_TYPE,
							VBANK_NUMBER,
							VBANK_NAME,
							VBANK_DUE_DATE,
							VBANK_SECRET_KEY,
							
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
							'".$order_status."'			AS ORDER_STATUS,
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
							
							".$vbank_account."			AS VBANK_ACCOUNT,
							".$vbank_type."				AS VBANK_TYPE,
							".$vbank_number."			AS VBANK_NUMBER,
							'".$vbank_name."'			AS VBANK_NAME,
							".$vbank_due_date."			AS VBANK_DUE_DATE,
							".$vbank_secret_key."		AS VBANK_SECRET_KEY,
							
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
							TMP_ORDER_INFO TI
						WHERE
							TI.ORDER_CODE = '".$order_code."'
					";
					
					$db->query($insert_order_info_sql);
					
					$order_idx = $db->last_id();
					
					if (!empty($order_idx)) {
						$insert_order_product_sql = "
							INSERT INTO
								ORDER_PRODUCT
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
								'PCP'					AS ORDER_STATUS,
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
								TMP_ORDER_PRODUCT TP
							WHERE
								TP.ORDER_CODE = '".$order_code."'
							ORDER BY
								TP.IDX DESC
						";
						
						$db->query($insert_order_product_sql);
					}
					
					deleteBasketInfo($db,$order_code,$member_id);
					deleteVoucherInfo($db,$order_code,$member_idx,$member_id);
					putMileageInfo($db,$order_idx);
					
					$db->query("DELETE FROM TMP_ORDER_PRODUCT WHERE ORDER_CODE = '".$order_code."'");
					$db->query("DELETE FROM TMP_ORDER_INFO WHERE ORDER_CODE = '".$order_code."'");

					$new_order_product_sql = "
						SELECT
							PR.PRODUCT_CODE					AS PRODUCT_CODE,
							PR.PRODUCT_NAME					AS PRODUCT_NAME,
							OP.OPTION_NAME					AS OPTION_NAME,
							PR.SALES_PRICE_".$country."		AS SALES_PRICE,
							OM.BRAND						AS BRAND,
							OP.PRODUCT_QTY					AS PRODUCT_QTY
						FROM
							ORDER_PRODUCT OP
							LEFT JOIN SHOP_PRODUCT PR ON
							OP.PRODUCT_IDX = PR.IDX
							LEFT JOIN ORDERSHEET_MST OM ON
							PR.ORDERSHEET_IDX = OM.IDX
						WHERE
							OP.ORDER_IDX = ".$order_idx." AND
							OP.PRODUCT_CODE NOT LIKE 'VOUXXX%'
					";
					$db->query($new_order_product_sql);
					$new_order_product_arr = array();
					$strProductDiv = '';
					foreach($db->fetch() as $new_order_product){
						$strProductDiv .= "
						products.push(
							{
								'item_id': '".$new_order_product['PRODUCT_CODE']."',
								'item_name': '".$new_order_product['PRODUCT_NAME']."',
								'item_variant': '".$new_order_product['OPTION_NAME']."',
								'price': ".$new_order_product['SALES_PRICE'].",
								'item_quantity': ".$new_order_product['PRODUCT_QTY'].",
								'item_brand': '".$new_order_product['BRAND']."',
								'item_category': ''
							} 
						);
						";
					}

					$mapping_cnt = $db->count("ORDER_MAPPING","TMP_ORDER_CODE = '".$order_code."'");
					if ($mapping_cnt > 0) {
						$select_order_mapping_sql = "
							SELECT
								OM.ORDER_CODE		AS ORDER_CODE
							FROM
								ORDER_MAPPING OM
							WHERE
								OM.TMP_ORDER_CODE = '".$order_code."'
						";
						
						$db->query($select_order_mapping_sql);
						
						$oex_order_code = "";
						foreach($db->fetch() as $mapping_data) {
							$oex_order_code = $mapping_data['ORDER_CODE'];
						}
						
						if (strlen($oex_order_code) > 0) {
							$select_exchange_order_sql = "
								SELECT
									OI.PG_PAYMENT_KEY		AS PG_PAYMENT_KEY,
									OP.PRODUCT_PRICE		AS PRODUCT_PRICE
								FROM
									ORDER_INFO OI
									LEFT JOIN ORDER_PRODUCT OP ON
									OI.IDX = OP.ORDER_IDX
								WHERE
									OI.ORDER_CODE = '".$oex_order_code."' AND
									OP.ORDER_STATUS = 'OEX'
							";
							
							$db->query($select_exchange_order_sql);
							
							$exchange_info = array();
							foreach($db->fetch() as $order_data) {
								$exchange_info = array(
									'pg_payment_key'		=>$order_data['PG_PAYMENT_KEY'],
									'product_price'			=>$order_data['PRODUCT_PRICE']
								);
							}
							
							if (count($exchange_info) > 0) {
								$curl = curl_init();

								curl_setopt_array($curl, [
									CURLOPT_URL => "https://api.tosspayments.com/v1/payments/".$exchange_info['pg_payment_key']."/cancel",
									CURLOPT_RETURNTRANSFER => true,
									CURLOPT_ENCODING => "",
									CURLOPT_MAXREDIRS => 10,
									CURLOPT_TIMEOUT => 30,
									CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
									CURLOPT_CUSTOMREQUEST => "POST",
									CURLOPT_POSTFIELDS => "{\"cancelReason\":\"주문취소\",\"cancelAmount\":".$exchange_info['product_price']."}",
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
												ORDER_STATUS = 'OEP',
												PG_CANCEL_DATE = '".$pg_cancel_date."',
												UPDATE_DATE = NOW(),
												UPDATER = '".$member_id."'
											WHERE
												ORDER_CODE = '".$oex_order_code."' AND
												ORDER_STATUS = 'OEX'
										";
										
										$db->query($update_order_product_sql);
										
										$db_result = $db->affectedRows();
										
										if ($db_result > 0) {
											//주문정보 상태 변경
											$order_cnt = $db->count("ORDER_PRODUCT","ORDER_CODE = '".$oex_order_code."'");
											$order_cancel_cnt = $db->count("ORDER_PRODUCT","ORDER_CODE = '".$oex_order_code."' AND ORDER_STATUS = 'OEP'");
											
											if ($order_cnt == $order_cancel_cnt) {
												$update_order_info_sql = "
													UPDATE
														ORDER_INFO
													SET
														ORDER_STATUS = 'OEP',
														CANCEL_DATE = '".$pg_cancel_date."',
														PG_STATUS = '".$pg_status."',
														UPDATE_DATE = NOW(),
														UPDATER = '".$member_id."'
													WHERE
														ORDER_CODE = '".$oex_order_code."'
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
					}

					$db->commit();
					
					echo "
						<script>
							var products = [];
							var order_id = '".$new_order_arr['order_code']."';
							var revenue = ".$new_order_arr['suppliedAmount'].";
							var shipping = 0;
							var tax = ".$new_order_arr['vat'].";

							//주문상품 반복문 시작.
							".$strProductDiv."
							
							dataLayer.push({
								'event' : 'purchase',
								'ecommerce': {
									'purchase': {
										'items': products,
										'transaction_id': order_id,
										'value': revenue,
										'shipping': shipping,
										'tax': tax,
										'currency': '".$new_order_arr['pg_currency']."'
									}
								}
							});
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
					$tmp_product_cnt = $db->count("TMP_ORDER_PRODUCT","ORDER_CODE = '".$order_id."'");
					
					$update_tmp_order_basket_sql = "
						UPDATE
							BASKET_INFO
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
											BASKET_INFO BI
										WHERE
											BI.MEMBER_IDX = 1 AND
											BI.PRODUCT_IDX IN (
												SELECT
													TP.PRODUCT_IDX
												FROM
													TMP_ORDER_PRODUCT TP
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
					
					$voucher_cnt = $db->count("TMP_ORDER_PRODUCT","ORDER_CODE = '".$order_id."' AND PRODUCT_CODE LIKE 'VOUXXX%'");
					
					if ($voucher_cnt > 0) {
						$update_voucher_sql = "
							UPDATE
								VOUCHER_ISSUE
							SET
								USED_FLG = FALSE,
								UPDATE_DATE = NOW(),
								UPDATER = '".$member_id."'
							WHERE
								IDX = (
									SELECT
										TP.PRODUCT_IDX
									FROM
										TMP_ORDER_PRODUCT TP
									WHERE
										TP.ORDER_CODE = '".$order_id."' AND
										TP.PRODUCT_CODE LIKE 'VOUXXX%'
								)
						";
						
						$db->query($update_voucher_sql);
					}
					
					$db->query("DELETE FROM TMP_ORDER_PRODUCT WHERE ORDER_CODE = '".$order_id."'");
					$db->query("DELETE FROM TMP_ORDER_INFO WHERE ORDER_CODE = '".$order_id."'");
					
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

	function getBankName($vbank_number) {
		$vbank_name = "";
		
		switch ($vbank_number) {
			case "39" :
				$vbank_name = "경남은행";
				break;
			
			case "34" :
				$vbank_name = "광주은행";
				break;
			
			case "S8" :
				$vbank_name = "교보증권";
				break;
			
			case "12" :
				$vbank_name = "단위농협(지역농축협)";
				break;
			
			case "SE" :
				$vbank_name = "대신증권";
				break;
			
			case "SK" :
				$vbank_name = "메리츠증권";
				break;
			
			case "S5" :
				$vbank_name = "미래에셋증권";
				break;
			
			case "SM" :
				$vbank_name = "부국증권";
				break;
			
			case "32" :
				$vbank_name = "부산은행";
				break;
			
			case "S3" :
				$vbank_name = "삼성증권";
				break;
			
			case "45" :
				$vbank_name = "새마을금고";
				break;
			
			case "64" :
				$vbank_name = "산림조합";
				break;
			
			case "SN" :
				$vbank_name = "신영증권";
				break;
			
			case "S2" :
				$vbank_name = "신한금융투자";
				break;
			
			case "88" :
				$vbank_name = "신한은행";
				break;
			
			case "48" :
				$vbank_name = "신협";
				break;
			
			case "27" :
				$vbank_name = "씨티은행";
				break;
			
			case "20" :
				$vbank_name = "우리은행";
				break;
			
			case "71" :
				$vbank_name = "우체국예금보험";
				break;
			
			case "S0" :
				$vbank_name = "유안타증권";
				break;
			
			case "SJ" :
				$vbank_name = "유진투자증권";
				break;
			
			case "50" :
				$vbank_name = "저축은행중앙회";
				break;
			
			case "37" :
				$vbank_name = "전북은행";
				break;
			
			case "35" :
				$vbank_name = "제주은행";
				break;
			
			case "90" :
				$vbank_name = "카카오뱅크";
				break;
			
			case "SQ" :
				$vbank_name = "카카오페이증권";
				break;
			
			case "89" :
				$vbank_name = "케이뱅크";
				break;
			
			case "92" :
				$vbank_name = "토스뱅크";
				break;
			
			case "ST" :
				$vbank_name = "토스증권";
				break;
			
			case "SR" :
				$vbank_name = "펀드온라인코리아(한국포스증권)";
				break;
			
			case "SH" :
				$vbank_name = "하나금융투자";
				break;
			
			case "81" :
				$vbank_name = "하나은행";
				break;
			
			case "S9" :
				$vbank_name = "하이투자증권";
				break;
			
			case "S6" :
				$vbank_name = "한국투자증권";
				break;
			
			case "SG" :
				$vbank_name = "한화투자증권";
				break;
			
			case "SA" :
				$vbank_name = "현대차증권";
				break;
			
			case "54" :
				$vbank_name = "홍콩상하이은행";
				break;
			
			case "SI" :
				$vbank_name = "DB금융투자";
				break;
			
			case "31" :
				$vbank_name = "DGB대구은행";
				break;
			
			case "03" :
				$vbank_name = "IBK기업은행";
				break;
			
			case "06" :
				$vbank_name = "KB국민은행";
				break;
			
			case "S4" :
				$vbank_name = "KB증권";
				break;
			
			case "02" :
				$vbank_name = "KDB산업은행";
				break;
			
			case "SP" :
				$vbank_name = "KTB투자증권(다올투자증권)";
				break;
			
			case "SO" :
				$vbank_name = "LIG투자증권";
				break;
			
			case "11" :
				$vbank_name = "NH농협은행";
				break;
			
			case "SL" :
				$vbank_name = "NH투자증권";
				break;
			
			case "23" :
				$vbank_name = "SC제일은행";
				break;
			
			case "07" :
				$vbank_name = "Sh수협은행";
				break;
			
			case "SD" :
				$vbank_name = "SK증권";
				break;
		}
		
		return $vbank_name;
	}
	
	function putMileageInfo($db,$order_idx) {
		$select_order_point_sql = "
			SELECT
				OI.COUNTRY					AS COUNTRY,
				OI.ORDER_CODE				AS ORDER_CODE,
				OI.MEMBER_IDX				AS MEMBER_IDX,
				OI.MEMBER_ID				AS MEMBER_ID,
				OI.MEMBER_LEVEL				AS MEMBER_LEVEL,
				
				OI.PRICE_MILEAGE_POINT		AS PRICE_MILEAGE_POINT,
				OI.PRICE_CHARGE_POINT		AS PRICE_CHARGE_POINT
			FROM
				ORDER_INFO OI
			WHERE
				OI.IDX = ".$order_idx."
		";
		
		$db->query($select_order_point_sql);
		
		$order_info = array();
		foreach($db->fetch() as $order_data) {
			$order_info = array(
				'country'		=>$order_data['COUNTRY'],
				'order_code'	=>$order_data['ORDER_CODE'],
				'member_idx'	=>$order_data['MEMBER_IDX'],
				'member_id'		=>$order_data['MEMBER_ID'],
				
				'mileage'		=>intval($order_data['PRICE_MILEAGE_POINT']),
				'charge'		=>intval($order_data['PRICE_CHARGE_POINT'])
			);
		}
		
		$select_order_product_sql = "
			SELECT
				OP.ORDER_PRODUCT_CODE	AS ORDER_PRODUCT_CODE,
				OP.PRODUCT_PRICE		AS PRODUCT_PRICE,
				PR.MILEAGE_FLG			AS MILEAGE_FLG,
				
				PM.MILEAGE_PER			AS PRODUCT_MILEAGE,
				IFNULL(
					ML.MILEAGE_PER,0
				)						AS MEMBER_MILEAGE
			FROM
				ORDER_PRODUCT OP
				LEFT JOIN ORDER_INFO OI ON
				OP.ORDER_IDX = OI.IDX
				LEFT JOIN MEMBER_LEVEL ML ON
				OI.MEMBER_LEVEL = ML.IDX
				LEFT JOIN SHOP_PRODUCT PR ON
				OP.PRODUCT_IDX = PR.IDX
				LEFT JOIN PRODUCT_MILEAGE PM ON
				OP.PRODUCT_IDX = PM.PRODUCT_IDX AND
				OI.MEMBER_LEVEL = PM.LEVEL_IDX
			WHERE
				OP.ORDER_IDX = ".$order_idx." AND
				OP.PRODUCT_CODE NOT LIKE 'VOUXXX%'
		";
		
		$db->query($select_order_product_sql);
		
		$product_info = array();
		foreach($db->fetch() as $product_data) {
			$product_info[] = array(
				'order_product_code'	=>$product_data['ORDER_PRODUCT_CODE'],
				'product_price'			=>$product_data['PRODUCT_PRICE'],
				'mileage_flg'			=>$product_data['MILEAGE_FLG'],
				
				'product_mileage'		=>$product_data['PRODUCT_MILEAGE'],
				'member_mileage'		=>$product_data['MEMBER_MILEAGE']
			);
		}
		
		//적립포인트 사용 처리
		if ($order_info['mileage'] > 0) {
			$insert_mileage_dec_sql = "
				INSERT INTO
					MILEAGE_INFO
				(
					COUNTRY,
					MEMBER_IDX,
					ID,
					MILEAGE_CODE,
					MILEAGE_UNUSABLE,
					MILEAGE_USABLE_INC,
					MILEAGE_USABLE_DEC,
					MILEAGE_BALANCE,
					ORDER_CODE,
					ORDER_PRODUCT_CODE,
					MILEAGE_USABLE_DATE_INFO,
					MILEAGE_USABLE_DATE,
					CREATER,
					UPDATER
				)
				SELECT
					'".$order_info['country']."'		AS COUNTRY,
					".$order_info['member_idx']."		AS MEMBER_IDX,
					'".$order_info['member_id']."'		AS ID,
					'PDC'								AS MILEAGE_CODE,
					0									AS MILEAGE_UNUSABLE,
					0									AS MILEAGE_USABLE_INC,
					".$order_info['mileage']."			AS MILEAGE_USABLE_DEC,
					(
						IFNULL(
							(
								SELECT
									S_MI.MILEAGE_BALANCE - ".$order_info['mileage']."
								FROM
									MILEAGE_INFO S_MI
								WHERE
									S_MI.MEMBER_IDX = ".$order_info['member_idx']."
								ORDER BY
									S_MI.IDX DESC
								LIMIT	0,1
							),0
						)
					)									AS MILEAGE_BALANCE,
					'".$order_info['order_code']."'		AS ORDER_CODE,
					NULL								AS ORDER_PRODUCT_CODE,
					NULL								AS MILEAGE_USABLE_DATE_INFO,
					NULL								AS MILEAGE_USABLE_DATE,
					'".$order_info['member_id']."'		AS CREATER,
					'".$order_info['member_id']."'		AS UPDATER
				FROM
					DUAL
			";
			
			$db->query($insert_mileage_dec_sql);
		}
		
		//적립포인트 추가 처리
		if (count($product_info) > 0) {
			for ($i=0; $i<count($product_info); $i++) {
				$mileage_flg = $product_info[$i]['mileage_flg'];
				
				if ($mileage_flg == true) {
					$product_price = $product_info[$i]['product_price'];
					$product_mileage = $product_info[$i]['product_mileage'];
					$member_mileage = $product_info[$i]['member_mileage'];
					
					$mileage_per = 0;
					if (!empty($product_mileage)) {
						$mileage_per = $product_mileage;
					} else {
						$mileage_per = $member_mileage;
					}
					
					$mileage_unusable = $product_price * ($mileage_per / 100);
					
					
					$insert_mileage_inc_sql = "
						INSERT INTO
							MILEAGE_INFO
						(
							COUNTRY,
							MEMBER_IDX,
							ID,
							MILEAGE_CODE,
							MILEAGE_UNUSABLE,
							MILEAGE_USABLE_INC,
							MILEAGE_USABLE_DEC,
							MILEAGE_BALANCE,
							ORDER_CODE,
							ORDER_PRODUCT_CODE,
							MILEAGE_USABLE_DATE_INFO,
							MILEAGE_USABLE_DATE,
							CREATER,
							UPDATER
						)
						SELECT
							'".$order_info['country']."'					AS COUNTRY,
							".$order_info['member_idx']."					AS MEMBER_IDX,
							'".$order_info['member_id']."'					AS ID,
							'PIN'											AS MILEAGE_CODE,
							".$mileage_unusable."							AS MILEAGE_UNUSABLE,
							0												AS MILEAGE_USABLE_INC,
							0												AS MILEAGE_USABLE_DEC,
							(
								IFNULL(
									(
										SELECT
											S_MI.MILEAGE_BALANCE
										FROM
											MILEAGE_INFO S_MI
										WHERE
											S_MI.MEMBER_IDX = ".$order_info['member_idx']."
										ORDER BY
											S_MI.IDX DESC
										LIMIT	0,1
									),0
								)
							)												AS MILEAGE_BALANCE,
							'".$order_info['order_code']."'					AS ORDER_CODE,
							'".$product_info[$i]['order_product_code']."'	AS ORDER_PRODUCT_CODE,
							'7d'											AS MILEAGE_USABLE_DATE_INFO,
							DATE_ADD(NOW(), INTERVAL 7 DAY)					AS MILEAGE_USABLE_DATE,
							'".$order_info['member_id']."'					AS CREATER,
							'".$order_info['member_id']."'					AS UPDATER
						FROM
							DUAL
					";
					
					$db->query($insert_mileage_inc_sql);
				}
			}
		}
	}
	
	function deleteBasketInfo($db,$order_code,$member_id) {
		$select_tmp_order_info_sql = "
			SELECT
				TI.BASKET_IDX		AS BASKET_IDX
			FROM
				TMP_ORDER_INFO TI
			WHERE
				TI.ORDER_CODE = '".$order_code."'
		";
		
		$db->query($select_tmp_order_info_sql);
		
		$basket_idx = 0;
		foreach($db->fetch() as $tmp_order_data) {
			$basket_idx = $tmp_order_data['BASKET_IDX'];
		}
		
		if (strlen($basket_idx > 0)) {
			$delete_basket_sql = "
				UPDATE
					BASKET_INFO
				SET
					DEL_FLG = TRUE,
					UPDATE_DATE = NOW(),
					UPDATER = '".$member_id."'
				WHERE
					IDX IN (".$basket_idx.")
			";
			
			$db->query($delete_basket_sql);
		}
	}
	
	function deleteVoucherInfo($db,$order_code,$member_idx,$member_id) {
		$voucher_cnt = $db->count("TMP_ORDER_PRODUCT","ORDER_CODE = '".$order_code."' AND PRODUCT_CODE LIKE 'VOUXXX%'");
		
		if ($voucher_cnt > 0) {
			$delete_voucher_sql = "
				UPDATE
					VOUCHER_ISSUE
				SET
					USED_FLG = TRUE,
					UPDATE_DATE = NOW(),
					UPDATER = '".$member_id."'
				WHERE
					VOUCHER_IDX = (
						SELECT
							TP.PRODUCT_IDX
						FROM
							TMP_ORDER_PRODUCT TP
						WHERE
							TP.ORDER_CODE = '".$order_code."' AND
							TP.PRODUCT_CODE LIKE 'VOUXXX%'
					) AND
					MEMBER_IDX = ".$member_idx."
			";
			
			print_r($delete_voucher_sql);
			
			$db->query($delete_voucher_sql);
		}
	}
?>