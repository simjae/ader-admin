<?php
/*
 +=============================================================================
 | 
 | 실시간 인기 제품 리스트 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.11.28
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$product_idx	= $_POST['product_idx'];

if($product_idx != null){
	$select_product_sql = "
		SELECT
			PR.IDX				AS PRODUCT_IDX,
			PR.ORDERSHEET_IDX	AS ORDERSHEET_IDX,
			PR.STYLE_CODE		AS STYLE_CODE,
			PR.COLOR_CODE		AS COLOR_CODE,
			PR.PRODUCT_CODE		AS PRODUCT_CODE,
			PR.PRODUCT_TYPE		AS PRODUCT_TYPE,
			PR.PRODUCT_NAME		AS PRODUCT_NAME,
			CASE
				WHEN
					(SELECT COUNT(*) FROM PRODUCT_IMG WHERE PRODUCT_IDX = PR.IDX) > 0
					THEN
						(
							SELECT
								REPLACE(S_PI.IMG_LOCATION,'/var/www/admin/www','')
							FROM
								PRODUCT_IMG S_PI
							WHERE
								S_PI.PRODUCT_IDX = PR.IDX AND
								S_PI.IMG_TYPE = 'P' AND
								S_PI.IMG_SIZE = 'S'
							LIMIT
								0,1
						)
				ELSE
					'/images/default_product_img.jpg'
			END					AS IMG_LOCATION,
			PR.PRICE_KR			AS PRICE_KR,
			PR.DISCOUNT_KR		AS DISCOUNT_KR,
			PR.SALES_PRICE_KR	AS SALES_PRICE_KR,
			PR.PRICE_EN			AS PRICE_EN,
			PR.DISCOUNT_EN		AS DISCOUNT_EN,
			PR.SALES_PRICE_EN	AS SALES_PRICE_EN,
			PR.PRICE_CN			AS PRICE_CN,
			PR.DISCOUNT_CN		AS DISCOUNT_CN,
			PR.SALES_PRICE_CN	AS SALES_PRICE_CN,
			(
				SELECT
					IFNULL(SUM(S_PS.STOCK_QTY),0)
				FROM
					PRODUCT_STOCK S_PS
				WHERE
					S_PS.PRODUCT_IDX = PR.IDX AND
					S_PS.STOCK_DATE <= NOW()
			)	AS STOCK_QTY,
			(
				SELECT
					IFNULL(SUM(S_PS.STOCK_SAFE_QTY),0)
				FROM
					PRODUCT_STOCK S_PS
				WHERE
					S_PS.PRODUCT_IDX = PR.IDX AND
					S_PS.STOCK_DATE <= NOW()
			)	AS SAFE_QTY,
			(
				SELECT
					IFNULL(SUM(S_OP.PRODUCT_QTY),0)
				FROM
					ORDER_PRODUCT S_OP
				WHERE
					S_OP.ORDER_STATUS IN ('PCP','PPR','DPR','DPG','DCP') AND
					S_OP.PRODUCT_IDX = PR.IDX
			)	AS ORDER_QTY,
			PR.UPDATE_DATE		AS UPDATE_DATE
		FROM
			SHOP_PRODUCT PR
		WHERE
			PR.IDX = ".$product_idx."
	";

	$db->query($select_product_sql);
	
	foreach($db->fetch() as $data) {
		$ordersheet_idx = $data['ORDERSHEET_IDX'];
		$product_idx = $data['PRODUCT_IDX'];
		
		$product_stock = getProductStock($db,$product_idx);
		
		$option_info = array();
		if(!empty($ordersheet_idx)){
			$select_ordersheet_option_sql = "
				SELECT 
					IDX,
					OPTION_NAME 
				FROM 
					ORDERSHEET_OPTION 
				WHERE 
					ORDERSHEET_IDX = ".$data['ORDERSHEET_IDX']."
			";
			
			$db->query($select_ordersheet_option_sql);
			
			foreach($db->fetch() as $option_data) {
				$option_info = array(
					'option_idx' => $option_data['IDX'], 
					'option_name' => $option_data['OPTION_NAME']
				);
			}
		}
		
		$json_result['data'][] = array(
			'product_idx'		=>$data['PRODUCT_IDX'],
			'style_code'		=>$data['STYLE_CODE'],
			'color_code'		=>$data['COLOR_CODE'],
			'product_code'		=>$data['PRODUCT_CODE'],
			'product_type'		=>$data['PRODUCT_TYPE'],
			'product_name'		=>$data['PRODUCT_NAME'],
			'img_location'		=>$data['IMG_LOCATION'],
			'price_kr'			=>$data['PRICE_KR'],
			'discount_kr'		=>$data['DISCOUNT_KR'],
			'sales_price_kr'	=>$data['SALES_PRICE_KR'],
			'price_en'			=>$data['PRICE_EN'],
			'discount_en'		=>$data['DISCOUNT_EN'],
			'sales_price_en'	=>$data['SALES_PRICE_EN'],
			'price_cn'			=>$data['PRICE_CN'],
			'discount_cn'		=>$data['DISCOUNT_CN'],
			'sales_price_cn'	=>$data['SALES_PRICE_CN'],
			'stock_qty'			=>$data['STOCK_QTY'],
			'order_qty'			=>$data['ORDER_QTY'],
			'safe_qty'			=>$data['SAFE_QTY'],
			'update_date'		=>$data['UPDATE_DATE'],
			
			'option_info'		=>$option_info,
			'product_stock'		=>$product_stock,
		);
	}
}


function getProductStock($db,$product_idx){
	$select_product_stock_sql = "
		SELECT
			OO.IDX				AS OPTION_IDX,
			OO.OPTION_NAME		AS OPTION_NAME,
			OO.BARCODE			AS BARCODE,
			(
				SELECT
					IFNULL(SUM(S_PS.STOCK_QTY),0)
				FROM
					PRODUCT_STOCK S_PS
				WHERE
					S_PS.PRODUCT_IDX = PR.IDX AND
					S_PS.OPTION_IDX = OO.IDX AND
					S_PS.STOCK_DATE <= NOW()
			)					AS STOCK_QTY,
			(
				SELECT
					IFNULL(SUM(S_PS.STOCK_SAFE_QTY),0)
				FROM
					PRODUCT_STOCK S_PS
				WHERE
					S_PS.PRODUCT_IDX = PR.IDX AND
					S_PS.OPTION_IDX = OO.IDX AND
					S_PS.STOCK_DATE <= NOW()
			)					AS SAFE_QTY,
			(
				SELECT
					IFNULL(SUM(S_OP.PRODUCT_QTY),0)
				FROM
					ORDER_PRODUCT S_OP
				WHERE
					S_OP.ORDER_STATUS IN ('PCP','PPR','DPR','DPG','DCP') AND
					S_OP.PRODUCT_IDX = PR.IDX AND
					S_OP.OPTION_IDX = OO.IDX
			)					AS ORDER_QTY
		FROM
			SHOP_PRODUCT PR
			LEFT JOIN ORDERSHEET_OPTION OO ON
			PR.ORDERSHEET_IDX = OO.ORDERSHEET_IDX
		WHERE
			PR.IDX = ".$product_idx."
		ORDER BY
			OO.IDX
	";
	
	$db->query($select_product_stock_sql);
	
	$stock_info = array();
	foreach($db->fetch() as $stock_data) {
		$product_qty = intval($stock_data['STOCK_QTY']) - intval($stock_data['ORDER_QTY']);
		
		$stock_info[] = array(
			'option_idx'		=>$stock_data['OPTION_IDX'],
			'option_name'		=>$stock_data['OPTION_NAME'],
			'barcode'			=>$stock_data['BARCODE'],
			'stock_qty'			=>$stock_data['STOCK_QTY'],
			'safe_qty'			=>$stock_data['SAFE_QTY'],
			'order_qty'			=>$stock_data['ORDER_QTY'],
			'product_qty'		=>$product_qty
		);
	}
	
	return $stock_info;
}

?>