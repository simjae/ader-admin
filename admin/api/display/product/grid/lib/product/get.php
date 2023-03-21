<?php
/*
 +=============================================================================
 | 
 | 상품 진열 페이지_상품 라이브러리 검색 모달 - 선택 한 상품 라이브러리 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2023.01.09
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$product_idx	= $_POST['product_idx'];

if ($product_idx != null) {
	$select_product_lib_sql = "
		SELECT
			PR.IDX		AS PRODUCT_IDX,
			PR.PRODUCT_TYPE		AS PRODUCT_TYPE,
			PR.PRODUCT_CODE		AS PRODUCT_CODE,
			PR.PRODUCT_NAME		AS PRODUCT_NAME,
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
			)					AS IMG_LOCATION,
			PR.PRICE_KR			AS PRICE_KR,
			PR.PRICE_EN			AS PRICE_EN,
			PR.PRICE_CN			AS PRICE_CN,
			PR.DISCOUNT_KR		AS DISCOUNT_KR,
			PR.DISCOUNT_EN		AS DISCOUNT_EN,
			PR.DISCOUNT_CN		AS DISCOUNT_CN,
			PR.SALES_PRICE_KR	AS SALES_PRICE_KR,
			PR.SALES_PRICE_EN	AS SALES_PRICE_EN,
			PR.SALES_PRICE_CN	AS SALES_PRICE_CN,
			
			(
				SELECT
					IFNULL(SUM(S_PS.STOCK_QTY),0)
				FROM
					PRODUCT_STOCK S_PS
				WHERE
					S_PS.PRODUCT_IDX = PR.IDX AND
					S_PS.OPTION_IDX = OO.IDX AND
					S_PS.STOCK_DATE <= NOW()
			)							AS STOCK_QTY,
			(
				SELECT
					IFNULL(SUM(S_OP.PRODUCT_QTY),0)
				FROM
					ORDER_PRODUCT S_OP
				WHERE
					S_OP.ORDER_STATUS IN ('PCP','PPR','DPR','DPG','DCP') AND
					S_OP.PRODUCT_IDX = PR.IDX AND
					S_OP.OPTION_IDX = OO.IDX
			)							AS ORDER_QTY
		FROM
			SHOP_PRODUCT PR
			LEFT JOIN ORDERSHEET_OPTION OO ON
			PR.ORDERSHEET_IDX = OO.ORDERSHEET_IDX
		WHERE
			PR.IDX = ".$product_idx."
	";
	
	$db->query($select_product_lib_sql);
	
	foreach($db->fetch() as $data) {
		$json_result['data'] = array(
			'product_idx'			=>$data['PRODUCT_IDX'],
			'product_type'			=>$data['PRODUCT_TYPE'],
			'product_code'			=>$data['PRODUCT_CODE'],
			'product_name'			=>$data['PRODUCT_NAME'],
			'img_location'			=>$data['IMG_LOCATION'],
			
			'price_kr'				=>number_format($data['PRICE_KR']),
			'price_en'				=>number_format($data['PRICE_EN']),
			'price_cn'				=>number_format($data['PRICE_CN']),
			'discount_kr'			=>number_format($data['DISCOUNT_KR']),
			'discount_en'			=>number_format($data['DISCOUNT_EN']),
			'discount_cn'			=>number_format($data['DISCOUNT_CN']),
			'sales_price_kr'		=>number_format($data['SALES_PRICE_KR']),
			'sales_price_en'		=>number_format($data['SALES_PRICE_EN']),
			'sales_price_cn'		=>number_format($data['SALES_PRICE_CN']),
			
			'stock_qty'				=>$data['STOCK_QTY'],
			'order_qty'				=>$data['ORDER_QTY'],
			'product_qty'			=>intval($data['STOCK_QTY'] - $data['ORDER_QTY'])
		);
	}
}
?>