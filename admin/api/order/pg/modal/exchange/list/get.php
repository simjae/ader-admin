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
			OP.IDX						AS ORDER_PRODUCT_IDX,
			PR.IDX						AS PRODUCT_IDX,
			PR.PRODUCT_TYPE				AS PRODUCT_TYPE,
			PR.PRODUCT_CODE				AS PRODUCT_CODE,
			PR.PRODUCT_NAME				AS PRODUCT_NAME,
			OO.OPTION_NAME				AS OPTION_NAME,
			OO.BARCODE					AS BARCODE,
			(
				SELECT
					REPLACE(S_PI.IMG_LOCATION,'/var/www/admin/www','')
				FROM
					PRODUCT_IMG S_PI
				WHERE
					S_PI.PRODUCT_IDX = PR.IDX AND
					S_PI.IMG_TYPE = 'P' AND
					S_PI.IMG_SIZE = 'S'
				ORDER BY
					S_PI.IDX ASC
				LIMIT
					0,1
			)							AS IMG_LOCATION,
			OP.PRODUCT_QTY				AS PRODUCT_QTY,
			OP.PRODUCT_PRICE			AS PRODUCT_PRICE,
			(
				SELECT
					IFNULL(SUM(S_PS.STOCK_QTY),0)
				FROM
					PRODUCT_STOCK S_PS
				WHERE
					S_PS.PRODUCT_IDX = PR.IDX AND
					S_PS.OPTION_IDX = OO.IDX AND
					S_PS.STOCK_DATE <= NOW()
			)												AS STOCK_QTY,
			(
				SELECT
					IFNULL(SUM(S_OP.PRODUCT_QTY),0)
				FROM
					ORDER_PRODUCT S_OP
				WHERE
					S_OP.ORDER_STATUS IN ('PCP','PPR','DPR','DPG','DCP') AND
					S_OP.PRODUCT_IDX = PR.IDX AND
					S_OP.OPTION_IDX = OO.IDX
			)												AS ORDER_QTY
		FROM
			SHOP_PRODUCT PR
			LEFT JOIN ORDERSHEET_OPTION OO ON
			PR.ORDERSHEET_IDX = OO.ORDERSHEET_IDX
			LEFT JOIN TMP_ORDER_PRODUCT OP ON
			PR.IDX = OP.PRODUCT_IDX AND
			OO.IDX = OP.OPTION_IDX
		WHERE
			OP.ORDER_CODE = '".$order_code."' AND
			OP.ORDER_STATUS = 'PWT'
	";

	$db->query($select_order_product_sql);
	
	foreach($db->fetch() as $data) {
		$tmp_order_product_info[] = array(
			'order_product_idx'		=>$data['ORDER_PRODUCT_IDX'],
			'product_idx'			=>$data['PRODUCT_IDX'],
			'product_type'			=>$data['PRODUCT_TYPE'],
			'product_code'			=>$data['PRODUCT_CODE'],
			'product_name'			=>$data['PRODUCT_NAME'],
			'option_name'			=>$data['OPTION_NAME'],
			'barcode'				=>$data['BARCODE'],
			'img_location'			=>$data['IMG_LOCATION'],
			'order_product_qty'		=>$data['PRODUCT_QTY'],
			'product_price'			=>number_format($data['PRODUCT_PRICE']),
			'stock_qty'				=>$data['STOCK_QTY'],
			'order_qty'				=>$data['ORDER_QTY'],
			'product_qty'			=>intval($data['STOCK_QTY'] - $data['ORDER_QTY'])
		);
	}
	
	$json_result['data'] = $tmp_order_product_info;
}

?>