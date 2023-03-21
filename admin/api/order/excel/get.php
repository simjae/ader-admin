<?php
/*
 +=============================================================================
 | 
 | 주문 목록 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.11.08
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$excel_type			= $_POST['excel_type'];

$tab_status			= $_POST['tab_status'];			//주문상태
$country			= $_POST['country'];			//쇼핑몰 국가
$order_status		= $_POST['order_status'];		//검색방식 - 상태
	
$search_keyword		= $_POST['search_keyword'];		//주문정보 검색 타입
$keyword_param		= $_POST['keyword_param'];		//주문정보 - 검색어 파라미터
	
$date_type			= $_POST['date_type'];			//기간
$date_param			= $_POST['date_param'];			//기간 - 파라미터
$date_from			= $_POST['date_from'];			//기간 시작일
$date_to			= $_POST['date_to'];			//기간 종료일
	
$search_product		= $_POST['search_product'];		//주문상품 검색 타입
$product_param		= $_POST['product_param'];		//주문상품 - 검색어 파라미터
	
$price_type			= $_POST['price_type'];			//금액 조건
$price_min			= $_POST['price_min'];			//금액 조건 - 금액 최소값
$price_max			= $_POST['price_max'];			//금액 조건 - 금액 최대값
	
$delivery_company	= $_POST['delivery_company'];	//배송업체
$delivery_type		= $_POST['delivery_type'];		//배송구분 - 국내/해외
$member_level		= $_POST['member_level'];		//멤버 레벨
$member_status		= $_POST['member_status'];		//멤버 상태
$qty_min			= $_POST['qty_min'];			//주문 상품 수 최소값
$qty_max			= $_POST['qty_max'];			//주문 상품 수 최대값
$pg_payment			= $_POST['pg_payment'];			//결제수단
$discount_type		= $_POST['dicsount_type'];		//할인수단

$sort_value			= $_POST['sort_value'];	
$sort_type			= $_POST['sort_type'];	

//검색 유형 - 디폴트
$where = '1=1';

if ($tab_status != null || $order_status != null) {
	if ($order_status != null && $order_status != "ALL") {
		$where .= " AND (OI.ORDER_STATUS = '".$order_status."')";
	} else {
		switch ($tab_status) {
			case "ORD_ALL" :
				$where .= " AND (OI.ORDER_STATUS IN ('PCP','PPR','POP','POD','DPR','DPG','DCP'))";
				break;
			
			case "MNG_ALL" :
				$where .= " AND (OI.ORDER_STATUS IN ('OCC','OEX','OEP','ORF','ORP'))";
				break;
			
			case "OC" :
				$cancel_type = NULL;
				$cancel_type = $_POST['cancel_type'];
				if($cancel_type != NULL && $cancel_type != 'ALL'){
					if($cancel_type == 'OIC'){
						$where .= " AND (OI.ORDER_STATUS LIKE '%OC%' )";
					}
					else if($cancel_type == 'OPC'){
						$where .= " AND (OP.ORDER_STATUS LIKE '%OC%' AND
									     OI.ORDER_STATUS NOT LIKE '%OC%') ";
					}
				}
				else{
					$where .= " AND (OP.ORDER_STATUS LIKE '%OC%' ) ";
				}
				break;
			
			case "OE" :
				$exchange_type = NULL;
				$exchange_type = $_POST['exchange_type'];
				if($exchange_type != NULL && $exchange_type != 'ALL'){
					if($exchange_type == 'OIE'){
						$where .= " AND (OI.ORDER_STATUS LIKE '%OE%' )";
					}
					else if($exchange_type == 'OPE'){
						$where .= " AND (OP.ORDER_STATUS LIKE '%OE%' AND
									     OI.ORDER_STATUS NOT LIKE '%OE%') ";
					}
				}
				else{
					$where .= " AND (OP.ORDER_STATUS LIKE '%OE%' ) ";
				}
				break;
			
			case "OR" :
				$refund_type = NULL;
				$refund_type = $_POST['refund_type'];
				if($refund_type != NULL && $refund_type != 'ALL'){
					if($refund_type == 'OIR'){
						$where .= " AND (OI.ORDER_STATUS LIKE '%OR%' )";
					}
					else if($refund_type == 'OPR'){
						$where .= " AND (OP.ORDER_STATUS LIKE '%OR%' AND
									     OI.ORDER_STATUS NOT LIKE '%OR%') ";
					}
				}
				else{
					$where .= " AND (OP.ORDER_STATUS LIKE '%OR%' ) ";
				}
				break;
			
			default :
				$where .= " AND (OI.ORDER_STATUS = '".$tab_status."' )";
				break;
		}
	}
}

$where_cnt = $where;

//국가
if ($country != null) {
	$where .= " AND (OI.COUNTRY = '".$country."') ";
}

//주문정보 검색
if ($search_keyword != null && $keyword_param != null) {	
	$tmp_where = "";
	for ($i=0; $i<count($search_keyword); $i++) {
		if($search_keyword[$i] != null && $search_keyword != 'ALL'){
			$param_where = "";
			switch ($search_keyword[$i]) {
				//주문정보 검색 - 주문 번호
				case "order_code" :
					$param_where .= ' (OI.ORDER_CODE LIKE "%'.$keyword_param[$i].'%") ';
					break;
				
				//주문정보 검색 - 운송장 번호
				case "delivery_num" :
					$param_where .= ' (OI.DELIVERY_NUM LIKE "%'.$keyword_param[$i].'%") ';
					break;
				
				//주문정보 검색 - 멤버 이름
				case "member_name" :
					$param_where .= ' (OI.MEMBER_NAME LIKE "%'.$keyword_param[$i].'%") ';
					break;
				
				//주문정보 검색 - 멤버 아이디
				case "member_id" :
					$param_where .= ' (OI.MEMBER_ID LIKE "%'.$keyword_param[$i].'%") ';
					break;
				
				//주문정보 검색 - 멤버 휴대폰 번호
				case "member_tel" :
					$param_where .= " (REPLACE(OI.MEMBER_MOBILE,'-','') LIKE '%".$keyword_param[$i]."%') ";
					break;
				
				//주문정보 검색 - 멤버 이메일
				case "member_email" :
					$param_where .= ' (OI.MEMBER_EMAIL LIKE "%'.$keyword_param[$i].'%") ';
					break;
				
				//주문정보 검색 - 배송지
				case "to_place" :
					$param_where .= ' (OI.TO_PLACE LIKE "%'.$keyword_param[$i].'%") ';
					break;
	
				//주문정보 검색 - 수령자 이름
				case "to_name" :
					$param_where .= ' (OI.TO_NAME LIKE "%'.$keyword_param[$i].'%") ';
					break;
	
				//주문정보 검색 - 수령자 휴대폰 번호
				case "to_mobile" :
					$param_where .= " (REPLACE(OI.TO_MOBILE,'-','') LIKE '%".$keyword_param[$i]."%') ";
					break;
	
				//주문정보 검색 - 주문 메모
				case "order_memo" :
					$param_where .= ' (OI.ORDER_MEMO LIKE "%'.$keyword_param[$i].'%") ';
					break;
			}
		}
		if (strlen($param_where) > 0 && strlen($tmp_where) > 0) {
			$tmp_where .= " AND ";
		}
		
		$tmp_where .= $param_where;
	}
	
	if (strlen($tmp_where) > 0) {
		$where .= " AND (";
		
		$where .= $tmp_where;
		
		$where .= " ) ";
	}
}

//기간 검색 - 주문일, 취소 요청일, 환불 요청일, 배송 시작일, 배송 종료일
if ($date_type != null && $date_type != "ALL" && ($date_param != null || $date_from != null || $date_to != null)) {
	if ($date_param != null) {
		switch ($date_param) {
			case "today" :
				$where .= ' AND (OI.'.$date_type.' = CURDATE()) ';
				break;
			case "01d" :
				$where .= ' AND (OI.'.$date_type.' >= (CURDATE() - INTERVAL 1 DAY)) ';
				break;
			case "03d" :
				$where .= ' AND (OI.'.$date_type.' >= (CURDATE() - INTERVAL 3 DAY)) ';
				break;
			case "07d" :
				$where .= ' AND (OI.'.$date_type.' >= (CURDATE() - INTERVAL 7 DAY)) ';
				break;
			case "15d" :
				$where .= ' AND (OI.'.$date_type.' >= (CURDATE() - INTERVAL 15 DAY)) ';
				break;
			case "01m" :
				$where .= ' AND (OI.'.$date_type.' >= (CURDATE() - INTERVAL 1 MONTH)) ';
				break;
			case "03m" :
				$where .= ' AND (OI.'.$date_type.' >= (CURDATE() - INTERVAL 3 MONTH)) ';
				break;
			case "01y" :
				$where .= ' AND (OI.'.$date_type.' >= (CURDATE() - INTERVAL 1 YEAR)) ';
				break;
		}
	} else if ($date_from != null || $date_to != null) {
		if ($date_start != null && $date_to == null) {
			$where .= " AND (OI.".$date_type." >= '".$date_from."') ";
		} else if ($date_from == null && $date_to != null) {
			$where .= " AND (OI.".$date_type." <= '".$date_to."') ";
		} else if ($date_from != null && $date_to != null) {
			$where .= " AND (OI.".$date_type." BETWEEN '".$date_from."' AND '".$date_to."') ";
		}
	}
}

//주문상품 검색 - 상품 코드, 상품 이름, 상품 태그, 상품 제조사, 상품 공급사
if ($search_product != null && $product_param != null) {
	$tmp_where = "";
	for ($i=0; $i<count($search_product); $i++) {
		if($search_product[$i] != null && $product_param != 'ALL'){
			$param_where = "";

			switch ($search_product[$i]) {
				//주문상품 검색 - 상품 코드
				case "code" :
					$param_where .= ' (PR.PRODUCT_CODE LIKE "%'.$product_param[$i].'%") ';
					break;
				
				//주문상품 검색 - 상품 이름
				case "name" :
					$param_where .= ' (PR.PRODUCT_NAME LIKE "%'.$product_param[$i].'%") ';
					break;
				
				//주문상품 검색 - 상품 태그
				case "tag" :
					$param_where .= ' (PR.PRODUCT_TAG LIKE "%'.$product_param[$i].'%") ';
					break;
				
				//주문상품 검색 - 상품 제조사
				case "manufacturer" :
					$param_where .= ' (OM.MANUFACTURER LIKE "%'.$product_param[$i].'%") ';
					break;
				
				//주문상품 검색 - 상품 공급사
				case "supplier" :
					$param_where .= ' (OM.SUPPLIER LIKE "%'.$product_param[$i].'%") ';
					break;
			}
		}
		if (strlen($param_where) > 0 && strlen($tmp_where) > 0) {
			$tmp_where .= " AND ";
		}
		
		$tmp_where .= $param_where;
	}
	
	if (strlen($tmp_where) > 0) {
		$where .= " AND (";
	
		$where .= $tmp_where;
			
		$where .= " ) ";
	}
}

//배송업체
if ($delivery_company != null && $delivery_company != "ALL") {
	$where .= " AND (OI.DELIVERY_IDX = ".$delivery_company.") ";
}

//배송구분
if ($delivery_type != null && $delivery_type != "ALL") {
	$where .= " AND (OI.DELIVERY_TYPE = '".$delivery_type."') ";
}

//멤버 레벨
if ($member_level != null && $member_level != "ALL") {
	$where .= " AND (OI.MEMBER_LEVEL = ".$member_level.") ";
}

//멤버 상태
if ($member_status != null) {
	$where .= " AND (OI.MEMBER_STATUS = '".implode(',',$member_status)."') ";
}

//금액 조건 - 상품 금액, 할인 금액, 실제 결제 금액
if (($price_type != null && $price_type != "ALL") && ($price_min != null || $price_max != null)) {
	if (intval($price_min) > 0 && intval($price_max) == 0) {
		$where .= " AND (OI.".$price_type." >= ".$price_min.") ";
	} else if (intval($price_min) == 0 && intval($price_max) > 0) {
		$where .= " AND (OI.".$price_type." <= ".$price_max.") ";
	} else if (intval($price_min) > 0 && intval($price_max) > 0) {
		$where .= " AND (OI.".$price_type." BETWEEN ".$price_min." AND ".$price_max.") ";
	}
}

//주문 상품 수량
if (($qty_min != null && intval($qty_min) > 0) || ($qty_max != null && intval($qty_max) > 0)) {
	$tmp_where = "
		(
			SELECT
				SUM(S_OP.PRODUCT_QTY)
			FROM
				ORDER_PRODUCT S_OP
			WHERE
				S_OP.ORDER_IDX = OI.IDX
		)
	";
	
	if (intval($qty_min) > 0 && intval($qty_max) == 0) {
		$tmp_where .= " >= ".$qty_min." ";
	} else if (intval($qty_min) == 0 && intval($qty_max) > 0) {
		$tmp_where .= " <= ".$qty_max." ";
	} else if (intval($qty_min) > 0 && intval($qty_max) > 0) {
		$tmp_where .= " BETWEEN ".$qty_min." AND ".$qty_max." ";
	}
	
	$tmp_where .= " IS TRUE ";
	
	$where .=" AND (";
	
	$where .= $tmp_where;
	
	$where .= ") ";
}

//결제수단
if ($pg_payment != null && $pg_payment != "ALL") {
	$where .= " AND (OI.PG_PAYMENT = '".$pg_payment."') ";
}

//할인수단
if ($discount_type != null) {
	$where ="  AND ( ";
	$tmp_where = "
		(
			SELECT
				COUNT(S_OP.IDX)
			FROM
				ORDER_PRODUCT S_OP
			WHERE
				S_OP.ORDER_IDX = OI.IDX AND
				S_OP.PRODUCT_CODE LIKE '".$discount_type."%'
		) > 0 IS TRUE
	";
	
	$where .= $tmp_where;
	$where .= " ) ";
}

/** 정렬 조건 **/
$order = '';
if ($sort_value != null && $sort_type != null) {
	$alias = "";
	if($sort_value == 'PRODUCT_NAME' || $sort_value == 'SALES_PRICE_KR' || $sort_value == 'SALES_PRICE_EN' || $sort_value == 'SALES_PRICE_CN'){
		$alias = 'PR';
	}
	else{
		$alias = 'OI';
	}
	$order = ' '.$alias.'.'.$sort_value." ".$sort_type." ";
} else {
	$order = ' OI.IDX DESC';
}

$select_order_excel_sql = "";
if ($excel_type == "DF") {
	$select_order_excel_sql = "
		SELECT
			OI.COUNTRY					AS COUNTRY,
			OI.ORDER_CODE				AS ORDER_CODE,
			OP.ORDER_PRODUCT_CODE		AS ORDER_PRODUCT_CODE,
			IFNULL(
				OI.ORDER_DATE,
				''
			)							AS ORDER_DATE,
			
			OP.PRODUCT_CODE				AS PRODUCT_CODE,
			OP.PRODUCT_NAME				AS PRODUCT_NAME,
			OP.OPTION_NAME				AS OPTION_NAME,
			OP.BARCODE					AS BARCODE,
			OP.PRODUCT_QTY				AS PRODUCT_QTY,
			PR.SALES_PRICE_KR			AS SALES_PRICE_KR,
			PR.SALES_PRICE_EN			AS SALES_PRICE_EN,
			PR.SALES_PRICE_CN			AS SALES_PRICE_CN,
			OP.PRODUCT_PRICE			AS PRODUCT_PRICE,
			
			OI.PRICE_PRODUCT			AS PRICE_PRODUCT,
			OI.PRICE_MILEAGE_POINT		AS PRICE_MILEAGE_POINT,
			OI.PRICE_CHARGE_POINT		AS PRICE_CHARGE_POINT,
			OI.PRICE_DISCOUNT			AS PRICE_DISCOUNT,
			OI.PRICE_DELIVERY			AS PRICE_DELIVERY,
			OI.PRICE_TOTAL				AS PRICE_TOTAL,
			
			OI.TO_NAME					AS TO_NAME,
			OI.TO_MOBILE				AS TO_MOBILE,
			OI.TO_ZIPCODE				AS TO_ZIPCODE,
			OI.TO_LOT_ADDR				AS TO_LOT_ADDR,
			OI.TO_ROAD_ADDR				AS TO_ROAD_ADDR,
			OI.TO_DETAIL_ADDR			AS TO_DETAIL_ADDR,
			OI.PG_STATUS				AS PG_STATUS,
			OI.PG_PAYMENT				AS PG_PAYMENT
		FROM
			ORDER_INFO OI
			LEFT JOIN ORDER_PRODUCT OP ON
			OI.IDX = OP.ORDER_IDX
			LEFT JOIN SHOP_PRODUCT PR ON
			OP.PRODUCT_IDX = PR.IDX
		WHERE
			".$where."
		ORDER BY 
			".$order."
	";
} else if ($excel_type == "SL") {
	$select_order_excel_sql = "
		SELECT
			OI.COUNTRY					AS COUNTRY,
			OI.ORDER_STATUS				AS ORDER_INFO_STATUS,
			OI.ORDER_CODE				AS ORDER_CODE,
			OP.ORDER_PRODUCT_CODE		AS ORDER_PRODUCT_CODE,
			IFNULL(
				OI.ORDER_DATE,
				''
			)							AS ORDER_DATE,
			IFNULL(
				OI.CANCEL_DATE,
				''
			)							AS CANCEL_DATE,
			IFNULL(
				OI.EXCHANGE_DATE,
				''
			)							AS EXCHANGE_DATE,
			IFNULL(
				OI.REFUND_DATE,
				''
			)							AS REFUND_DATE,
			
			OP.ORDER_STATUS				AS ORDER_PRODUCT_STATUS,
			OP.PRODUCT_IDX				AS PRODUCT_IDX,
			OP.PRODUCT_CODE				AS PRODUCT_CODE,
			OP.PRODUCT_NAME				AS PRODUCT_NAME,
			OP.OPTION_NAME				AS OPTION_NAME,
			OP.BARCODE					AS BARCODE,
			OP.PRODUCT_QTY				AS PRODUCT_QTY,
			PR.SALES_PRICE_KR			AS SALES_PRICE_KR,
			PR.SALES_PRICE_EN			AS SALES_PRICE_EN,
			PR.SALES_PRICE_CN			AS SALES_PRICE_CN,
			OP.PRODUCT_PRICE			AS PRODUCT_PRICE,
			
			OI.MEMBER_IDX				AS MEMBER_IDX,
			OI.PRICE_PRODUCT			AS PRICE_PRODUCT,
			OI.PRICE_MILEAGE_POINT		AS PRICE_MILEAGE_POINT,
			OI.PRICE_CHARGE_POINT		AS PRICE_CHARGE_POINT,
			OI.PRICE_DISCOUNT			AS PRICE_DISCOUNT,
			OI.PRICE_DELIVERY			AS PRICE_DELIVERY,
			(
				SELECT
					IFNULL(
						SUM(S_OP.PRODUCT_PRICE),0
					)
				FROM
					ORDER_PRODUCT S_OP
				WHERE
					S_OP.ORDER_IDX = OI.IDX AND
					S_OP.ORDER_STATUS = 'ORP'
			)							AS PRICE_REFUND,
			OI.PRICE_TOTAL				AS PRICE_TOTAL,
			OI.PG_PRICE					AS PG_PRICE,
			OI.TO_NAME					AS TO_NAME,
			OI.TO_MOBILE				AS TO_MOBILE,
			OI.TO_ZIPCODE				AS TO_ZIPCODE,
			OI.TO_LOT_ADDR				AS TO_LOT_ADDR,
			OI.TO_ROAD_ADDR				AS TO_ROAD_ADDR,
			OI.TO_DETAIL_ADDR			AS TO_DETAIL_ADDR,
			OI.PG_STATUS				AS PG_STATUS,
			OI.PG_PAYMENT				AS PG_PAYMENT
		FROM
			ORDER_INFO OI
			LEFT JOIN ORDER_PRODUCT OP ON
			OI.IDX = OP.ORDER_IDX
			LEFT JOIN SHOP_PRODUCT PR ON
			OP.PRODUCT_IDX = PR.IDX
		WHERE
			".$where."
		ORDER BY
			".$order."
	";
}

$db->query($select_order_excel_sql);

foreach($db->fetch() as $excel_data) {
	$select_currency_sql = "
		SELECT
			PC.COUNTRY		AS COUNTRY,
			PC.CURRENCY	AS CURRENCY
		FROM
			PRODUCT_CURRENCY PC
	";
	
	$db->query($select_currency_sql);
	
	$currency_info = array();
	foreach($db->fetch() as $currency_data) {
		$currency_info[$currency_data['COUNTRY']] = $currency_data['CURRENCY'];
	}
	
	$member_idx = $excel_data['MEMBER_IDX'];
	
	$member_info = array();
	if (!empty($excel_data['COUNTRY']) && !empty($member_idx)) {
		$select_member_sql = "
			SELECT
				MI.MEMBER_ID		AS MEMBER_ID,
				MI.MEMBER_NAME		AS MEMBER_NAME,
				MI.MEMBER_BIRTH		AS MEMBER_BIRTH
			FROM
				MEMBER_".$excel_data['COUNTRY']." MI
			WHERE
				MI.IDX = ".$member_idx."
		";
		
		$db->query($select_member_sql);
		
		foreach($db->fetch() as $member_data) {
			$member_info = array(
				'member_id'			=>$member_data['MEMBER_ID'],
				'member_name'		=>$member_data['MEMBER_NAME'],
				'member_birth'		=>$member_data['MEMBER_BIRTH']
			);
		}
	}
	
	$country = "";
	switch ($excel_data['COUNTRY']) {
		case "KR" :
			$country = "한국몰";
			break;
		
		case "EN" :
			$country = "영문몰";
			break;
		
		case "CN" :
			$country = "중문몰";
			break;
	}
	
	$product_qty = $excel_data['PRODUCT_QTY'];
	$sales_price_kr = $excel_data['SALES_PRICE_KR'];
	
	$product_price_kr = 0;
	$price_product_kr = 0;
	$price_refund_kr = 0;
	$price_total_kr = 0;
	$pg_price_kr = 0;
	
	if ($excel_data['COUNTRY'] != "KR") {
		$product_price_kr = intval($excel_data['PRODUCT_PRICE'] / $currency_info[$excel_data['COUNTRY']]);
		$pg_price_kr = intval($excel_data['PG_PRICE'] / $currency_info[$excel_data['COUNTRY']]);
		$price_product_kr = intval($excel_data['PRICE_PRODUCT'] / $currency_info[$excel_data['COUNTRY']]);
		$price_refund_kr = intval($excel_data['PRICE_REFUND'] / $currency_info[$excel_data['COUNTRY']]);
		$price_total_kr = intval($excel_data['PRICE_TOTAL'] / $currency_info[$excel_data['COUNTRY']]);
	} else {
		$product_price_kr = $excel_data['PRODUCT_PRICE'];
		$pg_price_kr = $excel_data['PG_PRICE'];
		$price_product_kr = $excel_data['PRICE_PRODUCT'];
		$price_refund_kr = $excel_data['PRICE_REFUND'];
		$price_total_kr = $excel_data['PRICE_TOTAL'];
	}
	
	$json_result['data'][] = array(
		'country'					=>$country,								//국가
		'order_info_status'			=>setTxtParam($excel_data['ORDER_INFO_STATUS']),		//주문 상태(주문)
		'order_code'				=>$excel_data['ORDER_CODE'],			//주문 코드
		'order_product_code'		=>$excel_data['ORDER_PRODUCT_CODE'],	//주문 상품 코드
		'order_date'				=>$excel_data['ORDER_DATE'],			//주문일
		'cancel_date'				=>$excel_data['CANCEL_DATE'],			//취소일
		'exchange_date'				=>$excel_data['EXCHANGE_DATE'],			//교환일
		'refund_date'				=>$excel_data['REFUND_DATE'],			//반품일
		
		'order_product_status'		=>setTxtParam($excel_data['ORDER_PRODUCT_STATUS']),		//주문 상태(주문)
		'product_code'				=>$excel_data['PRODUCT_CODE'],			//상품 코드
		'product_name'				=>$excel_data['PRODUCT_NAME'],			//상품 이름
		'option_name'				=>$excel_data['OPTION_NAME'],			//옵션 이름
		'barcode'					=>$excel_data['BARCODE'],				//바코드
		'product_qty'				=>$excel_data['PRODUCT_QTY'],			//주문 수량
		'sales_price_kr'			=>$excel_data['SALES_PRICE_KR'],		//판매가(한국몰)
		'sales_price_en'			=>$excel_data['SALES_PRICE_EN'],		//판매가(영문몰)
		'sales_price_cn'			=>$excel_data['SALES_PRICE_CN'],		//판매가(중문몰)
		'product_price'				=>$excel_data['PRODUCT_PRICE'],			//상품 구매금액
		'product_price_kr'			=>$product_price_kr,					//상품 구매금액(KRW)
		
		'member_id'					=>$member_info['member_id'],			//주문자 ID
		'member_name'				=>$member_info['member_name'],			//주문자 이름
		'member_birth'				=>$member_info['member_birth'],			//주문자 생년월일
		
		'pg_price'					=>$excel_data['PG_PRICE'],				//총 결제금액
		'pg_price_kr'				=>$pg_price_kr,							//총 결제금액(KRW)
		'price_product'				=>$excel_data['PRICE_PRODUCT'],			//총 상품 금액
		'price_product_kr'			=>$price_product_kr,					//총 상품 금액(KRW)
		'price_mileage_point'		=>$excel_data['PRICE_MILEAGE_POINT'],	//적립금 사용 금액
		'price_charge_point'		=>$excel_data['PRICE_CHARGE_POINT'],	//충전 포인트 사용 금액
		'price_discount'			=>$excel_data['PRICE_DISCOUNT'],		//바우처 할인금액
		'price_delivery'			=>$excel_data['PRICE_DELIVERY'],		//배송비
		'price_refund'				=>$excel_data['PRICE_REFUND'],			//총 환불금액
		'price_refund_kr'			=>$price_refund_kr,						//총 환불금액(KRW)
		'price_total'				=>$excel_data['PRICE_TOTAL'],			//총 주문금액
		'price_total_kr'			=>$price_total_kr,						//총 주문금액(KRW)
		
		'to_name'					=>$excel_data['TO_NAME'],				//수령 이름
		'to_mobile'					=>$excel_data['TO_MOBILE'],				//수령 전화번호
		'to_zipcode'				=>$excel_data['TO_ZIPCODE'],			//수령 우편번호
		'to_lot_addr'				=>$excel_data['TO_LOT_ADDR'],			//수령 지번 주소
		'to_road_addr'				=>$excel_data['TO_ROAD_ADDR'],			//수령 도로명 주소
		'to_detail_addr'			=>$excel_data['TO_DETAIL_ADDR'],		//수량 상세주소
		
		'pg_status'					=>$excel_data['PG_STATUS'],				//결제 상태
		'pg_payment'				=>$excel_data['PG_PAYMENT']				//결제 수단
	);
}

function setTxtParam($param) {
	$txt_param = "";
	
	switch ($param) {
		//주문상태
		case "PCP" :
			$txt_param = "결제완료";
			break;
		
		case "PPR" :
			$txt_param = "상품준비";
			break;
		
		case "POP" :
			$txt_param = "프리오더 준비";
			break;
		
		case "POD" :
			$txt_param = "프리오더 상품 생산";
			break;
		
		case "DPR" :
			$txt_param = "배송준비";
			break;
		
		case "DPG" :
			$txt_param = "배송중";
			break;
			
		case "DCP" :
			$txt_param = "배송완료";
			break;
		
		case "OCC" :
			$txt_param = "주문취소";
			break;
		
		case "OEX" :
			$txt_param = "주문교환";
			break;
		
		case "OEP" :
			$txt_param = "교환완료";
			break;
		
		case "ORF" :
			$txt_param = "주문환불";
			break;
		
		case "ORP" :
			$txt_param = "환불완료";
			break;
		
		//배송유형
		case "KR" :
			$txt_param = "국내배송";
			break;
		
		case "FR" :
			$txt_param = "해외배송";
			break;
		
		//배송상태
		case "MRD" :
			$txt_param = "멤버 재배송";
			break;
		
		case "ARD" :
			$txt_param = "아더 재배송";
			break;
	}
	
	return $txt_param;
}

?>