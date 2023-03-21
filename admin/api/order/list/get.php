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

$rows				= $_POST['rows'];
$page				= $_POST['page'];

$sort_value			= $_POST['sort_value'];	
$sort_type			= $_POST['sort_type'];	

$select_product_flg	= $_POST['select_product_flg'];
$select_column		= $_POST['select_column'];

//검색 유형 - 디폴트
$where = '1=1';

$where .= " AND (OP.PRODUCT_CODE NOT LIKE 'VOUXXX%') ";

if ($tab_status != null || $order_status != null) {
	if ($order_status != null && $order_status != "ALL") {
		$where .= " AND (OI.ORDER_STATUS = '".$order_status."')";
	} else {
		switch ($tab_status) {
			case "ORD_ALL" :
				$where .= " AND (OI.ORDER_STATUS IN ('PCP','PPR','POP','POD','DPR','DPG','DCP'))";
				break;
			
			case "MNG_ALL" :
				$where .= " AND (OP.ORDER_STATUS IN ('OCC','OEX','OEP','ORF','ORP'))";
				break;
			
			case "OC" :
				$cancel_type = NULL;
				$cancel_type = $_POST['cancel_type'];
				
				if($cancel_type != "ALL" && $cancel_type != NULL){
					if ($cancel_type == 'OIC') {
						$where .= " AND (OI.ORDER_STATUS LIKE '%OC%') ";
					} else if($cancel_type == 'OPC'){
						$where .= "
							AND (
								OP.ORDER_STATUS LIKE '%OC%' AND
								OI.ORDER_STATUS NOT LIKE '%OC%'
							)
						";
					}
				} else {
					$where .= " AND (OP.ORDER_STATUS LIKE '%OC%' ) ";
				}
				break;
			
			case "OE" :
				$exchange_type = NULL;
				$exchange_type = $_POST['exchange_type'];
				
				if ($exchange_type != "ALL" && $exchange_type != NULL) {
					if ($exchange_type == 'OIE') {
						$where .= " AND (OI.ORDER_STATUS LIKE '%OE%') ";
					}
					else if ($exchange_type == 'OPE') {
						$where .= "
							AND (
								OP.ORDER_STATUS LIKE '%OE%' AND
								OI.ORDER_STATUS NOT LIKE '%OE%'
							)
						";
					}
				} else {
					$where .= " AND (OP.ORDER_STATUS LIKE '%OE%' ) ";
				}
				break;
			
			case "OR" :
				$refund_type = NULL;
				$refund_type = $_POST['refund_type'];
				
				if ($refund_type != "ALL" && $refund_type != NULL){
					if ($refund_type == 'OIR') {
						$where .= " AND (OI.ORDER_STATUS LIKE '%OR%') ";
					} else if ($refund_type == 'OPR') {
						$where .= "
							AND (
								OP.ORDER_STATUS LIKE '%OR%' AND
								OI.ORDER_STATUS NOT LIKE '%OR%'
							)
						";
					}
				} else{
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

/** 정렬 조건 **/
$order = '';
if ($sort_value != null && $sort_type != null) {
	$alias = "";
	if($sort_value == 'PRODUCT_NAME' || $sort_value == 'SALES_PRICE_KR' || $sort_value == 'SALES_PRICE_EN' || $sort_value == 'SALES_PRICE_CN'){
		$alias = 'PR';
	} else {
		$alias = 'OI';
	}
	
	$order = ' '.$alias.'.'.$sort_value." ".$sort_type." ";
} else {
	$order = ' OI.IDX DESC';
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

$select_order_idx_sql = "
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
";

if ($rows != null) {
	$select_order_idx_sql .= " LIMIT ".$limit_start.",".$rows;
}

$db->query($select_order_idx_sql);

$order_idx_arr = array();
foreach($db->fetch() as $idx_data) {
	$order_idx_arr[] = $idx_data['ORDER_IDX'];
}

$result_where = "";

$extra_sql = "";
if (strlen($select_column) > 0 && $select_column != null) {
	$column_arr = explode(",",$select_column);
	$extra_sql = setExtraSql($db,$column_arr);
}

if(count($order_idx_arr) > 0){
	$select_order_info_sql = "
		SELECT
			OI.IDX					AS ORDER_IDX,
			OI.COUNTRY				AS COUNTRY,
			OI.ORDER_STATUS			AS ORDER_STATUS,
			DATE_FORMAT(
				OI.ORDER_DATE,
				'%Y-%m-%d %H:%i'
			)						AS ORDER_DATE,
			OI.ORDER_CODE			AS ORDER_CODE,
			
			OI.MEMBER_IDX			AS MEMBER_IDX,
			OI.MEMBER_ID			AS MEMBER_ID,
			OI.MEMBER_NAME			AS MEMBER_NAME,
			ML.TITLE				AS MEMBER_LEVEL,
			
			OI.PRICE_PRODUCT		AS PRICE_PRODUCT,
			OI.PRICE_MILEAGE_POINT	AS PRICE_MILEAGE_POINT,
			OI.PRICE_CHARGE_POINT	AS PRICE_CHARGE_POINT,
			OI.PRICE_DISCOUNT		AS PRICE_DISCOUNT,
			OI.PRICE_DELIVERY		AS PRICE_DELIVERY,
			OI.PRICE_TOTAL			AS PRICE_TOTAL,
			".$extra_sql."
			OI.CREATE_DATE,
			OI.CREATER,
			OI.UPDATE_DATE,
			OI.UPDATER
		FROM
			ORDER_INFO OI
			LEFT JOIN DELIVERY_COMPANY DC ON
			OI.DELIVERY_IDX = DC.IDX
			LEFT JOIN MEMBER_LEVEL ML ON
			OI.MEMBER_LEVEL = ML.IDX
		WHERE
			OI.IDX IN (".implode(',',$order_idx_arr).")
		ORDER BY
			".$order."
	";
	
	$db->query($select_order_info_sql);
	
	foreach($db->fetch() as $order_data){
		$order_idx = $order_data['ORDER_IDX'];
		
		$order_product_info = array();
		if (!empty($order_idx) && $select_product_flg != "false") {
			$select_order_product_sql = "
				SELECT
					OP.ORDER_STATUS			AS ORDER_STATUS,
					IFNULL(
						DATE_FORMAT(
							OP.CANCEL_DATE,
							'%Y-%m-%d %H:%i'
						),'-'
					)						AS CANCEL_DATE,
					IFNULL(
						DATE_FORMAT(
							OP.EXCHANGE_DATE,
							'%Y-%m-%d %H:%i'
						),'-'
					)						AS EXCHANGE_DATE,
					IFNULL(
						DATE_FORMAT(
							OP.REFUND_DATE,
							'%Y-%m-%d %H:%i'
						),'-'
					)						AS REFUND_DATE,
					
					OP.PRODUCT_TYPE			AS PRODUCT_TYPE,
					(
						SELECT
							REPLACE(
								S_PI.IMG_LOCATION,
								'/var/www/admin/www',
								''
							)
						FROM
							PRODUCT_IMG S_PI
						WHERE
							S_PI.PRODUCT_IDX = OP.PRODUCT_IDX AND
							S_PI.IMG_TYPE = 'P' AND
							S_PI.IMG_SIZE = 'S'
						ORDER BY
							S_PI.IDX ASC
						LIMIT
							0,1
					)						AS IMG_LOCATION,
					OP.PRODUCT_CODE			AS PRODUCT_CODE,
					OP.PRODUCT_NAME			AS PRODUCT_NAME,
					PR.UPDATE_DATE			AS UPDATE_DATE,
					OP.OPTION_IDX			AS OPTION_IDX,
					OP.OPTION_NAME			AS OPTION_NAME,
					OP.BARCODE				AS BARCODE,
					OP.PRODUCT_QTY			AS PRODUCT_QTY,
					OP.PRODUCT_PRICE		AS PRODUCT_PRICE,
					OP.REVIEW_TYPE			AS REVIEW_TYPE
				FROM
					ORDER_PRODUCT OP 
					LEFT JOIN SHOP_PRODUCT PR ON
					OP.PRODUCT_IDX = PR.IDX
				WHERE
					OP.ORDER_IDX = ".$order_idx."
			";

			$db->query($select_order_product_sql);
			
			foreach($db->fetch() as $product_data){
				$order_product_info[] = array(
					'order_status'			=>$product_data['ORDER_STATUS'],
					'txt_order_status'		=>setTxtParam($product_data['ORDER_STATUS']),
					'cancel_date'			=>setTxtParam($product_data['CANCEL_DATE']),
					'exchange_date'			=>setTxtParam($product_data['EXCHANGE_DATE']),
					'refund_date'			=>setTxtParam($product_data['REFUND_DATE']),
					
					'product_type'			=>setTxtParam($product_data['PRODUCT_TYPE']),
					'img_location'			=>$product_data['IMG_LOCATION'],
					'product_code'			=>$product_data['PRODUCT_CODE'],
					'product_name'			=>$product_data['PRODUCT_NAME'],
					'update_date'			=>$product_data['UPDATE_DATE'],
					'option_name'			=>$product_data['OPTION_NAME'],
					'barcode'				=>$product_data['BARCODE'],
					'product_qty'			=>$product_data['PRODUCT_QTY'],
					'product_price'			=>number_format($product_data['PRODUCT_PRICE']),
					'review_type'			=>$product_data['REVIEW_TYPE']
				);
			}
		}
		
		$txt_country = "";
		switch ($order_data['COUNTRY']) {
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
		
		$order_exchange_cnt = $db->count("ORDER_PRODUCT","ORDER_IDX = ".$order_idx." AND ORDER_STATUS = 'OEX'");
		$order_refund_cnt = $db->count("ORDER_PRODUCT","ORDER_IDX = ".$order_idx." AND ORDER_STATUS = 'ORF'");
		
		$mapping_cnt = $db->count("ORDER_MAPPING","ORDER_CODE = '".$order_data['ORDER_CODE']."'");
		
		$json_result['data'][] = array(
			'order_idx'					=>$order_data['ORDER_IDX'],
			'country'					=>$order_data['COUNTRY'],
			'txt_country'				=>$txt_country,
			'order_status'				=>$order_data['ORDER_STATUS'],
			'txt_order_status'			=>setTxtParam($order_data['ORDER_STATUS']),
			'order_date'				=>setTxtDateParam($order_data['ORDER_DATE']),
			'cancel_date'				=>setTxtDateParam($order_data['CANCEL_DATE']),
			'exchange_date'				=>setTxtDateParam($order_data['EXCHANGE_DATE']),
			'refund_date'				=>setTxtDateParam($order_data['REFUND_DATE']),
			'order_code'				=>$order_data['ORDER_CODE'],
			
			'pg_mid'					=>$order_data['PG_MID'],
			'pg_payment'				=>$order_data['PG_PAYMENT'],
			'pg_payment_key'			=>$order_data['PG_PAYMENT_KEY'],
			'pg_status'					=>$order_data['PG_STATUS'],
			'pg_date'					=>$order_data['PG_DATE'],
			'pg_price'					=>$order_data['PG_PRICE'],
			'pg_currency'				=>$order_data['PG_CURRENCY'],
			'pg_receipt_url'			=>$order_data['PG_RECEIPT_URL'],
			
			'price_product'				=>number_format($order_data['PRICE_PRODUCT']),
			'price_mileage_point'		=>number_format($order_data['PRICE_MILEAGE_POINT']),
			'price_charge_point'		=>number_format($order_data['PRICE_CHARGE_POINT']),
			'price_discount'			=>number_format($order_data['PRICE_DISCOUNT']),
			'price_delivery'			=>number_format($order_data['PRICE_DELIVERY']),
			'price_total'				=>number_format($order_data['PRICE_TOTAL']),
			
			'member_idx'				=>$order_data['MEMBER_IDX'],
			'member_id'					=>$order_data['MEMBER_ID'],
			'member_name'				=>$order_data['MEMBER_NAME'],
			'member_level'				=>$order_data['MEMBER_LEVEL'],
			
			'delivery_num'				=>$order_data['DELIVERY_NUM'],
			'delivery_type'				=>setTxtParam($order_data['DELIVERY_TYPE']),
			'delivery_date'				=>$order_data['DELIVERY_DATE'],
			'delivery_status'			=>setTxtParam($order_data['DELIVERY_STATUS']),
			'delivery_start_date'		=>$order_data['DELIVERY_START_DATE'],
			'delivery_end_date'			=>$order_data['DELIVERY_END_DATE'],
			'company_name'				=>$order_data['COMPANY_NAME'],
			'order_exchange_cnt'		=>$order_exchange_cnt,
			'order_refund_cnt'			=>$order_refund_cnt,
			
			'order_memo'				=>$order_data['ORDER_MEMO'],
			'mapping_cnt'				=>$mapping_cnt,
			
			'order_product_info'		=>$order_product_info
		);
	}
}

function setTxtDateParam($param) {
	$tmp_arr = explode(" ",$param);
	$txt_param = $tmp_arr[0]."<br/>".$tmp_arr[1];
	
	return $txt_param;
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

function setExtraSql($db,$column_arr) {
	$extra_sql = "";
	
	for ($i=0; $i<count($column_arr); $i++) {
		switch ($column_arr[$i]) {
			case "cancel_date" :
				$extra_sql .= "
					IFNULL(
						DATE_FORMAT(
							OI.CANCEL_DATE,
							'%Y-%m-%d %H:%i'
						),
						'-'
					)												AS CANCEL_DATE,
				";
				break;
			
			case "exchange_date" :
				$extra_sql .= "
					IFNULL(
						DATE_FORMAT(
							OI.EXCHANGE_DATE,
							'%Y-%m-%d %H:%i'
						),
						'-'
					)												AS EXCHANGE_DATE,
				";
				break;
			
			case "refund_date" :
				$extra_sql .= "
					IFNULL(
						DATE_FORMAT(
							OI.REFUND_DATE,
							'%Y-%m-%d %H:%i'
						),
						'-'
					)												AS REFUND_DATE,
				";
				break;
			
			case "pg_date" :
				$extra_sql .= " PG_DATE								AS PG_DATE, ";
				break;
			
			case "pg_payment" :
				$extra_sql .= " PG_PAYMENT							AS PG_PAYMENT, ";
				break;
			
			case "pg_status" :
				$extra_sql .= " PG_STATUS							AS PG_STATUS, ";
				break;
			
			case "pg_currency" :
				$extra_sql .= " PG_CURRENCY							AS PG_CURRENCY, ";
				break;
			
			case "pg_price" :
				$extra_sql .= " PG_PRICE							AS PG_PRICE, ";
				break;
			
			case "pg_mid" :
				$extra_sql .= " PG_MID								AS PG_MID, ";
				break;
			
			case "pg_payment_key" :
				$extra_sql .= " PG_PAYMENT_KEY						AS PG_PAYMENT_KEY, ";
				break;
			
			case "pg_receipt_url" :
				$extra_sql .= " PG_RECEIPT_URL						AS PG_RECEIPT_URL, ";
				break;
			
			case "delivery_num" :
				$extra_sql .= " IFNULL(OI.DELIVERY_NUM,'-')			AS DELIVERY_NUM, ";
				break;
			
			case "delivery_type" :
				$extra_sql .= " IFNULL(OI.DELIVERY_TYPE,'-')		AS DELIVERY_TYPE, ";
				break;
			
			case "delivery_date" :
				$extra_sql .= " IFNULL(OI.DELIVERY_DATE,'-')		AS DELIVERY_DATE, ";
				break;
			
			case "delivery_status" :
				$extra_sql .= " IFNULL(OI.DELIVERY_STATUS,'-')		AS DELIVERY_STATUS, ";
				break;
			
			case "delivery_start_date" :
				$extra_sql .= " IFNULL(OI.DELIVERY_START_DATE,'-')	AS DELIVERY_START_DATE, ";
				break;
			
			case "delivery_end_date" :
				$extra_sql .= " IFNULL(OI.DELIVERY_END_DATE,'-')		AS DELIVERY_END_DATE, ";
				break;
			
			case "company_name" :
				$extra_sql .= " IFNULL(DC.COMPANY_NAME,'-')			AS COMPANY_NAME, ";
				break;
			
			case "order_memo" :
				$extra_sql .= " IFNULL(OI.ORDER_MEMO,'-')		AS ORDER_MEMO, ";
				break;
		}
	}
	
	return $extra_sql;
}
?>