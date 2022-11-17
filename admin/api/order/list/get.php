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

$tab_status			= $_POST['tab_status'];			//주문상태
$country			= $_POST['country'];			//쇼핑몰 국가
$order_status		= $_POST['order_status'];		//검색방식 - 상태
	
$keyword_type		= $_POST['keyword_type'];		//주문정보 검색 타입
$keyword_param		= $_POST['keyword_param'];		//주문정보 - 검색어 파라미터
	
$date_type			= $_POST['date_type'];			//기간
$date_param			= $_POST['date_param'];			//기간 - 파라미터
$date_from			= $_POST['date_from'];			//기간 시작일
$date_to			= $_POST['date_to'];			//기간 종료일
	
$product_type		= $_POST['product_type'];		//주문상품 검색 타입
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

$rows = $_POST['rows'];
$page = $_POST['page'];

//검색 유형 - 디폴트
$where = '1=1';

$where .= " AND (OP.PRODUCT_CODE NOT LIKE 'BOU%') ";

if ($tab_status != null || $order_status != null) {
	if ($order_status != null && $order_status[0] != "ALL") {
		for ($i=0; $i<count($order_status); $i++) {
			$order_status[$i] = "'".$order_status[$i]."'";
		}
		$where .= " AND (OI.ORDER_STATUS IN (".implode(',',$order_status)."))";
	} else {
		switch ($tab_status) {
			case "ORD_ALL" :
				$where .= " AND (OI.ORDER_STATUS IN ('PCP','PPR','POP','POD','DPR','DPG','DCP'))";
				break;
			
			case "MNG_ALL" :
				$where .= " AND (OI.ORDER_STATUS IN ('OCC','OEX','OEP','ORF','ORP'))";
				break;
			
			case "OC" :
				$where .= " AND (OI.ORDER_STATUS IN ('OCC'))";
				break;
			
			case "OE" :
				$where .= " AND (OI.ORDER_STATUS IN ('OEX','OEP'))";
				break;
			
			case "OR" :
				$where .= " AND (OI.ORDER_STATUS IN ('ORF','ORP'))";
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
if ($keyword_type != null && $keyword_param != null) {	
	$tmp_where = "";
	for ($i=0; $i<count($keyword_type); $i++) {
		$param_where = "";
		if (strlen($tmp_where) > 0) {
			$tmp_where .= " AND ";
		}
		switch ($keyword_type[$i]) {
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
				$param_where .= " (REPLACE(OI.MEMBER_TEL,'-','') LIKE '%".$keyword_param[$i]."%') ";
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
			case "yesterday" :
				$where .= ' AND (OI.'.$date_type.' >= (CURDATE() - INTERVAL 1 DAY)) ';
				break;
			case "3d" :
				$where .= ' AND (OI.'.$date_type.' >= (CURDATE() - INTERVAL 3 DAY)) ';
				break;
			case "1w" :
				$where .= ' AND (OI.'.$date_type.' >= (CURDATE() - INTERVAL 7 DAY)) ';
				break;
			case "1m" :
				$where .= ' AND (OI.'.$date_type.' >= (CURDATE() - INTERVAL 1 MONTH)) ';
				break;
			case "3m" :
				$where .= ' AND (OI.'.$date_type.' >= (CURDATE() - INTERVAL 3 MONTH)) ';
				break;
			case "1y" :
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
if ($product_type != null && $product_param != null) {
	$tmp_where = "";
	for ($i=0; $i<count($product_type); $i++) {
		$param_where = "";
		if (strlen($tmp_where) > 0) {
			$tmp_where .= " AND ";
		}
		switch ($product_type[$i]) {
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
	$where .= " AND (OI.MEMBER_STATUS = '".$member_status."') ";
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
	$tmp_where="(
					SELECT
						SUM(S_OP.PRODUCT_QTY)
					FROM
						dev.ORDER_PRODUCT S_OP
					WHERE
						S_OP.ORDER_IDX = OI.IDX
				) ";
	
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
	$where ="  AND (";
	$tmp_where='(
					SELECT
						COUNT(S_OP.IDX)
					FROM
						dev.ORDER_PRODUCT S_OP
					WHERE
						S_OP.ORDER_IDX = OI.IDX AND
						S_OP.PRODUCT_CODE LIKE "'.$discount_type.'%"
				) > 0 IS TRUE';
	$where .= $tmp_where;
	$where .= ") ";
}

/** 정렬 조건 **/
$order = '';
if ($sort_value != null && $sort_type != null) {
	$order = ' OI.'.$sort_value." ".$sort_type." ";
} else {
	$order = ' OI.IDX DESC';
}

$limit_start = (intval($page)-1)*$rows;

$json_result = array(
	'total' => $db->count("
						dev.ORDER_INFO OI
						LEFT JOIN dev.ORDER_PRODUCT OP ON
						OI.IDX = OP.ORDER_IDX
						LEFT JOIN dev.SHOP_PRODUCT PR ON
						OP.PRODUCT_IDX = PR.IDX
						LEFT JOIN dev.DELIVERY_COMPANY DC ON
						OI.DELIVERY_IDX = DC.IDX
						LEFT JOIN dev.MEMBER_LEVEL ML ON
						OI.MEMBER_LEVEL = ML.IDX",
						$where
					),
	'total_cnt' => $db->count(
						"dev.ORDER_INFO OI
						LEFT JOIN dev.ORDER_PRODUCT OP ON
						OI.IDX = OP.ORDER_IDX",
						$where_cnt
					),
	'page' => $page
);

$sql = "SELECT
			OI.IDX					AS ORDER_IDX,
			OI.COUNTRY				AS COUNTRY,
			OI.ORDER_STATUS			AS OI_STATUS,
			OI.ORDER_DATE			AS ORDER_DATE,
			IFNULL(
				OI.CANCEL_DATE,'-'
			)						AS OI_CANCEL_DATE,
			IFNULL(
				OI.EXCHANGE_DATE,'-'
			)						AS OI_EXCHANGE_DATE,
			IFNULL(
				OI.REFUND_DATE,'-'
			)						AS OI_REFUND_DATE,
			OI.ORDER_CODE			AS ORDER_CODE,
			
			OI.MEMBER_IDX			AS MEMBER_IDX,
			ML.TITLE				AS MEMBER_LEVEL,
			OI.MEMBER_ID			AS MEMBER_ID,
			OI.MEMBER_NAME			AS MEMBER_NAME,
			
			OI.PRICE_PRODUCT		AS PRICE_PRODUCT,
			OI.PRICE_MILEAGE_POINT	AS PRICE_MILEAGE_POINT,
			OI.PRICE_CHARGE_POINT	AS PRICE_CHARGE_POINT,
			OI.PRICE_DISCOUNT		AS PRICE_DISCOUNT,
			OI.PRICE_DELIVERY		AS PRICE_DELIVERY,
			OI.PRICE_TOTAL			AS PRICE_TOTAL,
			OI.PG_PAYMENT			AS PG_PAYMENT,
			OI.PG_PRICE				AS PG_PRICE,
			
			OP.ORDER_STATUS			AS OP_STATUS,
			IFNULL(
				OP.CANCEL_DATE,'-'
			)						AS OP_CANCEL_DATE,
			IFNULL(
				OP.EXCHANGE_DATE,'-'
			)						AS OP_EXCHANGE_DATE,
			IFNULL(
				OP.REFUND_DATE,'-'
			)						AS OP_REFUND_DATE,
			OP.PRODUCT_IDX			AS PRODUCT_IDX,
			OP.PRODUCT_TYPE			AS PRODUCT_TYPE,
			OP.PRODUCT_CODE			AS PRODUCT_CODE,
			OP.PRODUCT_NAME			AS PRODUCT_NAME,
			OP.OPTION_IDX			AS OPTION_IDX,
			OP.OPTION_NAME			AS OPTION_NAME,
			OP.BARCODE				AS BARCODE,
			OP.PRODUCT_QTY			AS PRODUCT_QTY,
			OP.PRODUCT_PRICE		AS PRODUCT_PRICE,
			OP.REVIEW_TYPE			AS REVIEW_TYPE,
			
			OI.DELIVERY_TYPE		AS DELIVERY_TYPE,
			IFNULL(
				OI.DELIVERY_DATE,'-'
			)						AS DELIVERY_DATE,
			IFNULL(
				OI.DELIVERY_STATUS,'-'
			)						AS DELIVERY_STATUS,
			IFNULL(
				OI.DELIVERY_START_DATE,'-'
			)						AS DELIVERY_START_DATE,
			IFNULL(
				OI.DELIVERY_END_DATE,'-'
			)						AS DELIVERY_END_DATE,
			IFNULL(
				DC.COMPANY_NAME,'-'
			)						AS COMPANY_NAME,
			IFNULL(
				OI.DELIVERY_NUM,'-'
			)						AS DELIVERY_NUM,			
			
			IFNULL(
				OI.ORDER_MEMO,'-'
			)						AS ORDER_MEMO,
			OI.CREATE_DATE			AS CREATE_DATE,
			OI.UPDATE_DATE			AS UPDATE_DATE
		FROM
			dev.ORDER_INFO OI
			LEFT JOIN dev.ORDER_PRODUCT OP ON
			OI.IDX = OP.ORDER_IDX
			LEFT JOIN dev.SHOP_PRODUCT PR ON
			OP.PRODUCT_IDX = PR.IDX
			LEFT JOIN dev.DELIVERY_COMPANY DC ON
			OI.DELIVERY_IDX = DC.IDX
			LEFT JOIN dev.MEMBER_LEVEL ML ON
			OI.MEMBER_LEVEL = ML.IDX
		WHERE
			".$where."
		ORDER BY 
			".$order;

if ($rows != null && $select_idx_flg == null) {
	$sql .= " LIMIT ".$limit_start.",".$rows;
}

$db->query($sql);
foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'num'						=>$total_cnt--,
		'order_idx'					=>$data['ORDER_IDX'],
		'country'					=>$data['COUNTRY'],
		'oi_status'					=>$data['OI_STATUS'],
		'order_date'				=>$data['ORDER_DATE'],
		'oi_cancel_date'			=>$data['OI_CANCEL_DATE'],
		'oi_exchange_date'			=>$data['OI_EXCHANGE_DATE'],
		'oi_refund_date'			=>$data['OI_REFUND_DATE'],
		'order_code'				=>$data['ORDER_CODE'],
		
		'member_idx'				=>$data['MEMBER_IDX'],
		'member_level'				=>$data['MEMBER_LEVEL'],
		'member_id'					=>$data['MEMBER_ID'],
		'member_name'				=>$data['MEMBER_NAME'],

		'price_product'				=>$data['PRICE_PRODUCT'],
		'price_mileage_point'		=>$data['PRICE_MILEAGE_POINT'],
		'price_charge_point'		=>$data['PRICE_CHARGE_POINT'],
		'price_discount'			=>$data['PRICE_DISCOUNT'],
		'price_delivery'			=>$data['PRICE_DELIVERY'],
		'price_total'				=>$data['PRICE_TOTAL'],
		'pg_payment'				=>$data['PG_PAYMENT'],
		'pg_price'					=>$data['PG_PRICE'],
		
		'op_status'					=>$data['OP_STATUS'],
		'op_cancel_date'			=>$data['OP_CANCEL_DATE'],
		'op_exchange_date'			=>$data['OP_EXCHANGE_DATE'],
		'op_refund_date'			=>$data['OP_REFUND_DATE'],
		'product_idx'				=>$data['PRODUCT_IDX'],
		'product_type'				=>$data['PRODUCT_TYPE'],
		'product_code'				=>$data['PRODUCT_CODE'],
		'product_name'				=>$data['PRODUCT_NAME'],
		'option_idx'				=>$data['OPTION_IDX'],
		'option_name'				=>$data['OPTION_NAME'],
		'barcode'					=>$data['BARCODE'],
		'product_qty'				=>$data['PRODUCT_QTY'],
		'product_price'				=>$data['PRODUCT_PRICE'],
		'review_type'				=>$data['REVIEW_TYPE'],
		
		'delivery_type'				=>$data['DELIVERY_TYPE'],
		'delivery_date'				=>$data['DELIVERY_DATE'],
		'delivery_status'			=>$data['DELIVERY_STATUS'],
		'delivery_start_date'		=>$data['DELIVERY_START_DATE'],
		'delivery_end_date'			=>$data['DELIVERY_END_DATE'],
		'company_name'				=>$data['COMPANY_NAME'],
		'delivery_num'				=>$data['DELIVERY_NUM'],
		
		'order_memo'				=>$data['ORDER_MEMO'],
		'create_date'				=>$data['CREATE_DATE'],
		'update_date'				=>$data['UPDATE_DATE']
	);
}
?>