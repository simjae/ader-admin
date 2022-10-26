<?php
/*
 +=============================================================================
 | 
 | 샘플 정보 리스트 - 상품별 샘플 정보 조회(합계)
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
		$where .= "SI.PRODUCT_CODE = '".$product_code."' ";
		$group .= "SI.MANUFACTURER";
	}
	else if($manufacturer != null){
		$where .= "SI.MANUFACTURER = '".$manufacturer."'";
		$group .= "SI.PRODUCT_CODE";
	}

	$sql = "SELECT
				SI.PRODUCT_CODE		AS PRODUCT_CODE,
				SI.PRODUCT_NAME		AS PRODUCT_NAME,
				SI.MANUFACTURER		AS MANUFACTURER,
				(
					SELECT
						CONCAT(
							IFNULL(DATE_FORMAT(MIN(S_SI.DUE_DATE), '%Y-%m-%d'),''),
							' ~ ',
							IFNULL(DATE_FORMAT(MAX(S_SI.DUE_DATE), '%Y-%m-%d'),'')
						)
					FROM
						dev.SAMPLE_INFO S_SI
					WHERE
						S_SI.PRODUCT_CODE = SI.PRODUCT_CODE AND
						S_SI.MANUFACTURER = SI.MANUFACTURER AND
						S_SI.DEL_FLG = FALSE
				)					AS DUE_DATE_TEXT,
				SUM(SI.PRODUCT_QTY)	AS PRODUCT_SUM_QTY
			FROM
				dev.SAMPLE_INFO SI
			WHERE
				SI.DEL_FLG = FALSE
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