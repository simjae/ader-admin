<?php
/*
 +=============================================================================
 | 
 | 통합모달 - 주문정보 조회
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

$country			= $_POST['country'];
$member_idx			= $_POST['member_idx'];

$order_status		= $_POST['order_status'];
$search_keyword		= $_POST['search_keyword'];
$keyword_param		= $_POST['keyword_param'];

$date_type			= $_POST['date_type'];
$date_param			= $_POST['date_param'];
$date_from			= $_POST['date_from'];
$date_to			= $_POST['date_to'];

$search_product		= $_POST['search_product'];
$product_param		= $_POST['product_param'];

$delivery_company	= $_POST['delivery_company'];
$delivery_type		= $_POST['delivery_type'];

$member_level		= $_POST['member_level'];
$member_status		= $_POST['member_status'];

$price_type			= $_POST['price_type'];
$price_min			= $_POST['price_min'];
$price_max			= $_POST['price_max'];

$qty_min			= $_POST['qty_min'];
$qty_max			= $_POST['qty_max'];

$pg_payment			= $_POST['pg_payment'];
$discount_type		= $_POST['discount_type'];

$sort_value			= $_POST['sort_value'];
$sort_type			= $_POST['sort_type'];

$page				= $_POST['page'];
$rows				= $_POST['rows'];

if ($country != null && $member_idx != null) {
	$where = " OI.COUNTRY = '".$country."' AND OI.MEMBER_IDX = ".$member_idx;

	if ($order_status != null && $order_status != "ALL") {
		$where .= " AND (OI.ORDER_STATUS LIKE '".$order_status."%')";
	}

	$where_cnt = $where;

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
	if ($date_type != null && $date_type != "ALL" && ($date_from != null || $date_to != null)) {
		if ($date_from != null || $date_to != null) {
			if ($date_from != null && $date_to == null) {
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
		$tmp_where="
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
		
		$where .=" AND ( ";
		
		$where .= $tmp_where;
		
		$where .= " ) ";
	}

	//결제수단
	if ($pg_payment != null && $pg_payment != "ALL") {
		$where .= " AND (OI.PG_PAYMENT = '".$pg_payment."') ";
	}

	//할인수단
	if ($discount_type != null) {
		$where ="  AND (";
		$tmp_where="
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

	$limit_start = (intval($page)-1)*$rows;

	$json_result = array(
		'total' => $db->count("
			(
				SELECT
					DISTINCT OI.IDX					AS ORDER_IDX
				FROM
					ORDER_INFO OI
					LEFT JOIN ORDER_PRODUCT OP ON
					OI.IDX = OP.ORDER_IDX
					LEFT JOIN SHOP_PRODUCT PR ON
					OP.PRODUCT_IDX = PR.IDX
					LEFT JOIN DELIVERY_COMPANY DC ON
					OI.DELIVERY_IDX = DC.IDX
					LEFT JOIN MEMBER_LEVEL ML ON
					OI.MEMBER_LEVEL = ML.IDX
				WHERE
					".$where."
			) TMP",
			" 1=1 "
		),
		'total_cnt' => $db->count("
			(
				SELECT
					DISTINCT OI.IDX					AS ORDER_IDX
				FROM
					ORDER_INFO OI
					LEFT JOIN ORDER_PRODUCT OP ON
					OI.IDX = OP.ORDER_IDX
					LEFT JOIN SHOP_PRODUCT PR ON
					OP.PRODUCT_IDX = PR.IDX
					LEFT JOIN DELIVERY_COMPANY DC ON
					OI.DELIVERY_IDX = DC.IDX
					LEFT JOIN MEMBER_LEVEL ML ON
					OI.MEMBER_LEVEL = ML.IDX
				WHERE
					".$where_cnt."
			) TMP",
			" 1=1 "
		),
		'page' => $page
	);
	
	/** 정렬 조건 **/
	$order = '';
	if ($sort_value != null && $sort_type != null) {
		$order = " ".$sort_value." ".$sort_type." ";
	} else {
		$order = ' OI.IDX DESC';
	}
	
	$select_order_idx_sql = "
		SELECT
			OI.IDX		AS ORDER_IDX
		FROM
			ORDER_INFO OI
			LEFT JOIN MEMBER_LEVEL ML ON
			OI.MEMBER_LEVEL = ML.IDX
		WHERE
			".$where."
		ORDER BY
			".$order."
	";
	
	$limit_start = (intval($page)-1)*$rows;	
	if ($rows != null) {
		$select_order_idx_sql .= " LIMIT ".$limit_start.",".$rows;
	}
	
	$db->query($select_order_idx_sql);
	
	$order_idx = array();
	foreach($db->fetch() as $idx_data) {
		$order_idx[] = $idx_data['ORDER_IDX'];
	}
	
	if (count($order_idx) > 0) {
		$select_order_info_sql = "
			SELECT
				OI.COUNTRY					AS COUNTRY,
				OI.ORDER_CODE				AS ORDER_CODE,
				OI.ORDER_TITLE				AS ORDER_TITLE,
				OI.ORDER_STATUS				AS ORDER_STATUS,
				IFNULL(
					DATE_FORMAT(
						OI.ORDER_DATE,
						'%Y-%m-%d %H:%i'
					),'-'
				)							AS ORDER_DATE,
				IFNULL(
					DATE_FORMAT(
						OI.CANCEL_DATE,
						'%Y-%m-%d %H:%i'
					),'-'
				)							AS CANCEL_DATE,
				IFNULL(
					DATE_FORMAT(
						OI.EXCHANGE_DATE,
						'%Y-%m-%d %H:%i'
					),'-'
				)							AS EXCHANGE_DATE,
				IFNULL(
					DATE_FORMAT(
						OI.REFUND_DATE,
						'%Y-%m-%d %H:%i'
					),'-'
				)							AS REFUND_DATE,
				
				ML.TITLE					AS MEMBER_LEVEL,
				OI.MEMBER_ID				AS MEMBER_ID,
				OI.MEMBER_NAME				AS MEMBER_NAME,
				OI.MEMBER_MOBILE			AS MEMBER_MOBILE,
				OI.MEMBER_EMAIL				AS MEMBER_EMAIL,
				
				OI.PG_PRICE					AS PG_PRICE,
				OI.PG_PAYMENT				AS PG_PAYMENT,
				
				OI.PRICE_PRODUCT			AS PRICE_PRODUCT,
				OI.PRICE_MILEAGE_POINT		AS PRICE_MILEAGE_POINT,
				OI.PRICE_CHARGE_POINT		AS PRICE_CHARGE_POINT,
				OI.PRICE_DISCOUNT			AS PRICE_DISCOUNT,
				OI.PRICE_DELIVERY			AS PRICE_DELIVERY,
				OI.PRICE_TOTAL				AS PRICE_TOTAL
			FROM
				ORDER_INFO OI
				LEFT JOIN MEMBER_LEVEL ML ON
				OI.MEMBER_LEVEL = ML.IDX
			WHERE
				OI.IDX IN (".implode(",",$order_idx).")
		";
		
		$db->query($select_order_info_sql);
		
		foreach($db->fetch() as $order_data) {
			$txt_country = "";
			switch($order_data['COUNTRY']) {
				case "KR" :
					$txt_country = "한국몰";
					break;
				
				case "EN" :
					$txt_country = "영문몰";
					break;
				
				case "CN" :
					$txt_country = "중문몰";
					break;
			}
			
			$json_result['data'][] = array(
				'country'				=>$txt_country,
				'order_code'			=>$order_data['ORDER_CODE'],
				'order_title'			=>$order_data['ORDER_TITLE'],
				'order_status'			=>setTxtParam($order_data['ORDER_STATUS']),
				'order_date'			=>$order_data['ORDER_DATE'],
				
				'pg_price'				=>number_format($order_data['PG_PRICE']),
				'pg_payment'			=>$order_data['PG_PAYMENT'],
				
				'price_product'			=>number_format($order_data['PRICE_PRODUCT']),
				'price_mileage_point'	=>number_format($order_data['PRICE_MILEAGE_POINT']),
				'price_charge_point'	=>number_format($order_data['PRICE_CHARGE_POINT']),
				'price_discount'		=>number_format($order_data['PRICE_DISCOUNT']),
				'price_delivery'		=>number_format($order_data['PRICE_DELIVERY']),
				'price_total'			=>number_format($order_data['PRICE_TOTAL'])
			);
		}
	}
}

function setTxtParam($param) {
	$txt_param = "";
	
	switch ($param) {
		//상품 타입
		case "B" :
			$txt_param = "일반상품";
			break;
		
		case "S" :
			$txt_param = "세트상품";
			break;
		
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