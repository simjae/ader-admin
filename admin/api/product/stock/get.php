<?php
/*
 +=============================================================================
 | 
 | 회원 목록
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.07.27
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$product_idx	= $_POST['product_idx'];
$option_idx		= $_POST['option_idx'];

if ($product_idx != null || $option_idx != null) {
	$where = "";
	if ($product_idx != null) {
		$where .= " PS.PRODUCT_IDX = ".$product_idx;
	} else if ($option_idx != null){
		$where .= " PS.OPTION_IDX = ".$option_idx;
	}
	
	$sql = "SELECT
				PS.PRODUCT_CODE		AS PRODUCT_CODE,
				PS.PRODUCT_NAME		AS PRODUCT_NAME,
				PS.OPTION_IDX		AS OPTION_IDX,
				PS.BARCODE			AS BARCODE,
				PS.OPTION_NAME		AS OPTION_NAME,
				SUM(PS.STOCK_QTY)	AS STOCK_QTY,
				(
					SELECT
						IFNULL(
							SUM(S_OP.PRODUCT_QTY),0
						)
					FROM
						dev.ORDER_PRODUCT S_OP
					WHERE
						S_OP.PRODUCT_IDX = PS.PRODUCT_IDX AND
						S_OP.OPTION_IDX = PS.OPTION_IDX AND
						S_OP.ORDER_STATUS IN ('PCP','PPR','DPR','DPG','DCP')
				)					AS ORDER_QTY,
				PS.STOCK_SAFE_QTY	AS STOCK_SAFE_QTY
			FROM
				dev.PRODUCT_STOCK PS
			WHERE
				".$where."
			GROUP BY
				PS.OPTION_IDX
			ORDER BY
				PS.OPTION_IDX";
}

$db->query($sql);
foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'product_code'			=>$data['PRODUCT_CODE'],
		'product_name'			=>$data['PRODUCT_NAME'],
		'option_idx'			=>$data['OPTION_IDX'],
		'barcode'				=>$data['BARCODE'],
		'option_name'			=>$data['OPTION_NAME'],
		'stock_qty'				=>intval($data['STOCK_QTY']),
		'stock_safe_qty'		=>intval($data['STOCK_SAFE_QTY']),
		'order_qty'				=>intval($data['ORDER_QTY']),
	);
}
?>