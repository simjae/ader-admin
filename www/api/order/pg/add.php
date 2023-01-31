<?php
/*
 +=============================================================================
 | 
 | 결제정보 입력화면 - 결제 상품 및 주문자 정보 등록
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.12.12
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$member_idx = 0;
if (isset($_SESSION['MEMBER_IDX'])) {
	$member_idx = $_SESSION['MEMBER_IDX'];
}

$country = null;
if (isset($_SESSION['COUNTRY'])) {
	$country = $_SESSION['COUNTRY'];
}

$member_id = null;
if (isset($_SESSION['MEMBER_ID'])) {
	$member_id = $_SESSION['MEMBER_ID'];
}

$level_idx = 0;
if (isset($_SESSION['LEVEL_IDX'])) {
	$level_idx = $_SESSION['LEVEL_IDX'];
}

$member_name = null;
if (isset($_SESSION['MEMBER_NAME'])) {
	$member_name = $_SESSION['MEMBER_NAME'];
}

$tel_mobile = null;
if (isset($_SESSION['TEL_MOBILE'])) {
	$tel_mobile = $_SESSION['TEL_MOBILE'];
}

$member_email = null;
if (isset($_SESSION['MEMBER_EMAIL'])) {
	$member_email = $_SESSION['MEMBER_EMAIL'];
}

$basket_idx = null;
if (isset($_POST['basket_idx'])) {
	$basket_idx = explode(",",$_POST['basket_idx']);
}

$to_place = null;
if (isset($_POST['to_place'])) {
	$to_place = $_POST['to_place'];
}

$to_name = null;
if (isset($_POST['to_name'])) {
	$to_name = $_POST['to_name'];
}

$to_mobile = null;
if (isset($_POST['to_mobile'])) {
	$to_mobile = $_POST['to_mobile'];
}

$to_zipcode = null;
if (isset($_POST['to_zipcode'])) {
	$to_zipcode = $_POST['to_zipcode'];
}

$to_lot_addr = null;
if (isset($_POST['to_lot_addr'])) {
	$to_lot_addr = $_POST['to_lot_addr'];
}

$to_road_addr = null;
if (isset($_POST['to_road_addr'])) {
	$to_road_addr = $_POST['to_road_addr'];
}

$to_detail_addr = null;
if (isset($_POST['to_detail_addr'])) {
	$to_detail_addr = $_POST['to_detail_addr'];
}

$order_memo = null;
if (isset($_POST['order_memo'])) {
	$order_memo = $_POST['order_memo'];
}

$voucher_idx = 0;
if (isset($_POST['voucher_idx'])) {
	$voucher_idx = $_POST['voucher_idx'];
}

$price_mileage_point = 0;
if (isset($_POST['price_mileage_point'])) {
	$price_mileage_point = $_POST['price_mileage_point'];
}

$price_charge_point = 0;
if (isset($_POST['price_charge_point'])) {
	$price_charge_point = $_POST['price_charge_point'];
}

if ($member_idx == 0 || $country == null) {
	$json_result['code'] = 401;
	$json_result['msg'] = "로그인 후 다시 시도해 주세요.";
	exit;
}

//쇼핑백 선택 상품 예외처리
if ($basket_idx != null) {
	$basket_cnt = $db->count("dev.BASKET_INFO","IDX IN (".implode(",",$basket_idx).") AND MEMBER_IDX = ".$member_idx);
	if (count($basket_idx) != $basket_cnt) {
		$json_result['code'] = 402;
		$json_result['msg'] = "결제하려는 상품이 존재하지 않습니다. 쇼핑백에서 결제하려는 상품 정보를 확인해주세요.";
		
		return $json_result;
	}
}

//보유 바우처 예외처리
$price_discount = 0;
if ($voucher_idx > 0) {
	$voucher_cnt = $db->count("dev.VOUCHER_ISSUE","IDX = ".$voucher_idx." AND MEMBER_IDX = ".$member_idx);
	
	if ($voucher_cnt == 0) {
		$json_result['code'] = 402;
		$json_result['msg'] = "선택한 바우처 정보가 존재하지 않습니다. 선택하려는 바우처 정보를 확인해주세요.";
		
		return $json_result;
	}
	
	$select_voucher_sql = "
		SELECT
			VM.SALE_PRICE		AS SALE_PRICE
		FROM
			dev.VOUCHER_ISSUE VI
			LEFT JOIN dev.VOUCHER_MST VM ON
			VI.VOUCHER_IDX = VM.IDX
		WHERE
			VI.IDX = ".$voucher_idx." AND
			VI.MEMBER_IDX = ".$member_idx.";
	";
	
	$db->query($select_voucher_sql);
	
	foreach($db->fetch() as $voucher_data) {
		$price_discount = $voucher_data['SALE_PRICE'];
	}
}

$price_total = 0;
$order_code = "230129154838";

if ($price_mileage_point > 0 || $price_charge_point > 0) {
	$select_point_sql = "
		SELECT
			(
				SELECT 
					S_MI.MILEAGE_BALANCE
				FROM 
					dev.MILEAGE_INFO S_MI
				WHERE 
					S_MI.MEMBER_IDX = MB.IDX
				ORDER BY 
					S_MI.IDX DESC 
				LIMIT
					0,1
			)					AS MEMBER_MILEAGE
		FROM
			dev.MEMBER_".$country." MB
		WHERE
			MB.IDX = ".$member_idx."
	";

	$db->query($select_point_sql);

	$member_mileage = 0;
	foreach ($db->fetch() as $point_data) {
		$member_mileage = $member_data['MEMBER_MILEAGE'];
		//$member_charge = $member_data['MEMBER_CHARGE'];
	}

	//보유 적립 포인트 예외처리
	if ($price_mileage_point > $member_mileage) {
		$json_result['code'] = 402;
		$json_result['msg'] = "보유하고 있는 적립 포인트 이상의 금액은 사용할 수 없습니다.";
		
		return $json_result;
	}
	
	/*보유 충전 포인트 예외처리
	if ($price_charge_point > 0 && $member_charge) {
		$json_result['code'] = 402;
		$json_result['msg'] = "보유하고 있는 충전 포인트 이상의 금액은 사용할 수 없습니다.";
		return $json_rsult;
	}*/
}

$product_sql = "
	SELECT
		PR.IDX							AS PRODUCT_IDX,
		PR.PRODUCT_CODE					AS PRODUCT_CODE,
		PR.PRODUCT_TYPE					AS PRODUCT_TYPE,
		OM.PREORDER_FLG					AS PREORDER_FLG,
		PR.PRODUCT_NAME					AS PRODUCT_NAME,
		OO.IDX							AS OPTION_IDX,
		OO.BARCODE						AS BARCODE,
		OO.OPTION_NAME					AS OPTION_NAME,
		BI.PRODUCT_QTY					AS PRODUCT_QTY,
		PR.SALES_PRICE_".$country."		AS SALES_PRICE
	FROM
		dev.BASKET_INFO BI
		LEFT JOIN dev.SHOP_PRODUCT PR ON
		BI.PRODUCT_IDX = PR.IDX
		LEFT JOIN dev.ORDERSHEET_MST OM ON
		PR.ORDERSHEET_IDX = OM.IDX
		LEFT JOIN dev.ORDERSHEET_OPTION OO ON
		BI.OPTION_IDX = OO.IDX
	WHERE
		BI.IDX IN (".implode(",",$basket_idx).")
	ORDER BY
		BI.IDX DESC
";

$db->query($product_sql);

$product_info = array();
$price_product = 0;
foreach($db->fetch() as $product_data) {
	$product_qty = $product_data['PRODUCT_QTY'];
	$sales_price = $product_data['SALES_PRICE'];
	
	$product_info[] = array(
		'product_idx'	=>$product_data['PRODUCT_IDX'],
		'product_code'	=>$product_data['PRODUCT_CODE'],
		'product_type'	=>$product_data['PRODUCT_TYPE'],
		'preorder_flg'	=>$product_data['PREORDER_FLG'],
		'product_name'	=>$product_data['PRODUCT_NAME'],
		'option_idx'	=>$product_data['OPTION_IDX'],
		'barcode'		=>$product_data['BARCODE'],
		'option_name'	=>$product_data['OPTION_NAME'],
		'product_qty'	=>$product_qty,
		'sales_price'	=>$sales_price
	);
	
	$price_product += intval($product_qty * $sales_price);
}

$price_total = intval($price_product - $price_mileage_point - $price_charge_point - $price_discount);

try {
	$order_info_insert_sql = "
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
			PG_PAYMENT,
			PG_STATUS,
			PG_DATE,
			PG_CODE,
			PG_MSG,
			PG_PRICE,
			PG_CURRENCY,
			PG_TID,
			PG_UID,
			PG_RECEIPT_URL,
			VBANK_NAME,
			VBANK_CODE,
			VBANK_ACCOUNT,
			VBANK_NUM,
			VBANK_EXPIRE_DATE,
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
		) VALUES (
			'".$country."',
			'".$order_code."',
			'테스트용 주문 데이터',
			'PCP',
			NOW(),
			".$member_idx.",
			".$level_idx.",
			'".$member_id."',
			'".$member_name."',
			'".$tel_mobile."',
			'".$member_email."',
			".$price_product.",
			".$price_mileage_point.",
			".$price_charge_point.",
			".$price_discount.",
			".$price_total.",
			'PG_PAYMENT',
			'PG_STATUS',
			'PG_DATE',
			'PG_CODE',
			'PG_MSG',
			'PG_PRICE',
			'PG_CURRENCY',
			'PG_TID',
			'PG_UID',
			'PG_RECEIPT_URL',
			'VBANK_NAME',
			'VBANK_CODE',
			'VBANK_ACCOUNT',
			'VBANK_NUM',
			NOW(),
			'".$to_place."',
			'".$to_name."',
			'".$to_mobile."',
			'".$to_zipcode."',
			'".$to_lot_addr."',
			'".$to_road_addr."',
			'".$to_detail_addr."',
			'".$order_memo."',
			NOW(),
			'".$member_id."',
			NOW(),
			'".$member_id."'
		)
	";
		
	$db->query($order_info_insert_sql);
		
	$order_idx = $db->last_id();

	if (!empty($order_idx)) {
		for ($i=0; $i<count($product_info); $i++) {
			$order_product_insert_sql = "
				INSERT INTO
					dev.ORDER_PRODUCT
				(
					ORDER_IDX,
					ORDER_CODE,
					ORDER_PRODUCT_CODE,
					ORDER_STATUS,
					PRODUCT_IDX,
					PRODUCT_TYPE,
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
				) VALUES (
					".$order_idx.",
					'".$order_code."',
					'".$order_code."_".intval($i+1)."',
					'PCP',
					".$product_info[$i]['product_idx'].",
					'".$product_info[$i]['product_type']."',
					".$product_info[$i]['preorder_flg'].",
					'".$product_info[$i]['product_code']."',
					'".$product_info[$i]['product_name']."',
					".intval($product_info[$i]['product_qty'] * $product_info[$i]['sales_price']).",
					".$product_info[$i]['option_idx'].",
					'".$product_info[$i]['barcode']."',
					'".$product_info[$i]['option_name']."',
					".$product_info[$i]['product_qty'].",
					NOW(),
					'".$member_id."',
					NOW(),
					'".$member_id."'
				)
			";
			
			$db->query($order_product_insert_sql);
		}
	}
	
	$delete_basket_sql = "
		UPDATE
			dev.BASKET_INFO
		SET
			DEL_FLG = TRUE,
			UPDATE_DATE = NOW(),
			UPDATER = '".$member_id."'
		WHERE
			IDX IN (".implode(",",$basket_idx).")
	";
	
	$db->query($delete_basket_sql);
	
	$delete_voucher_sql = "
		UPDATE
			dev.VOUCHER_ISSUE
		SET
			USED_FLG = TRUE,
			UPDATE_DATE = NOW(),
			UPDATER = '".$member_id."'
		WHERE
			IDX = ".$voucher_idx."
	";
	
	$db->query($delete_voucher_sql);
	
	$db->commit();
	
	$json_result['data'] = $order_idx;
} catch(mysqli_sql_exception $exception){
	print_r($exception);
	$db->rollback();
	
	$json_result['code'] = 301;
	$json_result['msg'] = "메인 배너 등록에 실패했습니다.";
}
?>