<?php
/*
 +=============================================================================
 | 
 | 상품 진열 페이지_상품 라이브러리 검색 모달 - 상품 라이브러리 검색
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.08.15
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$order_code			= $_POST['order_code'];

if ($order_code != null) {
	$select_order_product_sql = "
		SELECT
			SUM(OP.PRODUCT_PRICE)	AS PRODUCT_PRICE
		FROM
			ORDER_PRODUCT OP
		WHERE
			OP.ORDER_CODE = '".$order_code."' AND
			OP.ORDER_STATUS = 'OEX'
	";
	
	$db->query($select_order_product_sql);
	
	$price_oex = 0;
	foreach($db->fetch() as $product_data) {
		$price_oex = $product_data['PRODUCT_PRICE'];
	}
	
	$select_tmp_order_product_sql = "
		SELECT
			SUM(OP.PRODUCT_PRICE)	AS PRODUCT_PRICE
		FROM
			TMP_ORDER_PRODUCT OP
		WHERE
			OP.ORDER_CODE = '".$order_code."' AND
			OP.ORDER_STATUS = 'PWT'
	";
	
	$db->query($select_tmp_order_product_sql);
	
	$price_pwt = 0;
	foreach($db->fetch() as $tmp_product_data) {
		$price_pwt = $tmp_product_data['PRODUCT_PRICE'];
	}
	
	$price_type = "";
	$price_calc = 0;
	
	if ($price_oex > $price_pwt) {
		$price_type = "+";
		$price_calc = $price_oex - $price_pwt;
	} else if ($price_oex < $price_pwt) {
		$price_type = "-";
		$price_calc = $price_pwt - $price_oex;
	}
	
	$json_result['data'] = array(
		'price_type'		=>$price_type,
		
		'price_oex'			=>number_format($price_oex),
		'price_pwt'			=>number_format($price_pwt),
		'price_calc'		=>number_format($price_calc)
	);
}

?>