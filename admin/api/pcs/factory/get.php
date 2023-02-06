<?php
/*
 +=============================================================================
 | 
 | 공장별 수주 리스트 - 공장별 수주 정보 조회(합계)
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

$product_code = $_POST['product_code'];
$manufacturer = $_POST['manufacturer'];
$sub_where = '';
$where = '';
$group = '';

if ($product_code != null || $manufacturer != null) {
	if($product_code != null){
		$where .= "FI.PRODUCT_CODE = '".$product_code."' ";
		$group .= "FI.MANUFACTURER";
	}
	else if($manufacturer != null){
		$where .= "FI.MANUFACTURER = '".$manufacturer."'";
		$group .= "FI.PRODUCT_CODE";
	}
	
	$sql = "SELECT
				FI.PRODUCT_CODE		AS PRODUCT_CODE,
				FI.PRODUCT_NAME		AS PRODUCT_NAME,
				FI.MANUFACTURER		AS MANUFACTURER,
				(
					SELECT
						CONCAT(
							IFNULL(DATE_FORMAT(MIN(S_FI.DUE_DATE), '%Y-%m-%d'),''),
							' ~ ',
							IFNULL(DATE_FORMAT(MAX(S_FI.DUE_DATE), '%Y-%m-%d'),'')
						)
					FROM
						dev.FACTORY_INFO S_FI
					WHERE
						S_FI.PRODUCT_CODE = FI.PRODUCT_CODE AND
						S_FI.MANUFACTURER = FI.MANUFACTURER AND
						S_FI.DEL_FLG = FALSE
				)					AS DUE_DATE_TEXT,
				SUM(FI.PRODUCT_QTY)	AS PRODUCT_SUM_QTY
			FROM
				dev.FACTORY_INFO FI
			WHERE
				FI.DEL_FLG = FALSE
			AND
				".$where."
			GROUP BY
				".$group;
	
	$db->query($sql);
	
	foreach($db->fetch() as $data) {
		$json_result['data'][] = array(
			'product_code'		=>$data['PRODUCT_CODE'],
			'product_name'		=>$data['PRODUCT_NAME'],
			'manufacturer'		=>$data['MANUFACTURER'],
			'due_date_text'		=>$data['DUE_DATE_TEXT'],
			'product_sum_qty'	=>$data['PRODUCT_SUM_QTY']
		);
	}
}
?>