<?php
/*
 +=============================================================================
 | 
 | 홀세일 정보 리스트 - 상품별 샘플 정보 조회(합계)
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.10.18
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$product_code 	= $_POST['product_code'];
$country 		= $_POST['country'];
$buyer 			= $_POST['buyer'];
$sub_where = '';
$where = '';
$group = '';

if ($product_code != null || $country != null || $buyer != null) {
	if($product_code != null){
		$where .= "WI.PRODUCT_CODE = '".$product_code."' ";
		$group .= "WI.BUYER, WI.COUNTRY";
	}
	else if($buyer != null){
		$where .= "WI.BUYER = '".$buyer."'";
		$group .= "WI.PRODUCT_CODE, WI.COUNTRY";
	}
	else if($country != null){
		$where .= "WI.COUNTRY = '".$country."'";
		$group .= "WI.PRODUCT_CODE, WI.BUYER";
	}

	$sql = "SELECT
				WI.PRODUCT_CODE		AS PRODUCT_CODE,
				WI.PRODUCT_NAME		AS PRODUCT_NAME,
				WI.COUNTRY			AS COUNTRY,
				WI.BUYER			AS BUYER,
				(
					SELECT
						CONCAT(
							IFNULL(DATE_FORMAT(MIN(S_WI.DUE_DATE), '%Y-%m-%d'),''),
							' ~ ',
							IFNULL(DATE_FORMAT(MAX(S_WI.DUE_DATE), '%Y-%m-%d'),'')
						)
					FROM
						dev.WHOLESALE_INFO S_WI
					WHERE
						S_WI.PRODUCT_CODE = WI.PRODUCT_CODE	AND
						S_WI.BUYER   = WI.BUYER	AND
						S_WI.COUNTRY = WI.COUNTRY AND
						S_WI.DEL_FLG = FALSE
				)					AS DUE_DATE_TEXT,
				SUM(WI.PRODUCT_QTY)	AS PRODUCT_SUM_QTY
			FROM
				dev.WHOLESALE_INFO WI
			WHERE
				WI.DEL_FLG = FALSE
			AND
				".$where."
			GROUP BY
				".$group;
	$db->query($sql);
	
	foreach($db->fetch() as $data) {
		$json_result['data'][] = array(
			'product_code'		=>$data['PRODUCT_CODE'],
			'product_name'		=>$data['PRODUCT_NAME'],
			'country'			=>$data['COUNTRY'],
			'buyer'				=>$data['BUYER'],
			'due_date_text'		=>$data['DUE_DATE_TEXT'],
			'product_sum_qty'	=>$data['PRODUCT_SUM_QTY']
		);
	}
}
?>