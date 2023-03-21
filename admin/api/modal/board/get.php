<?php
/*
 +=============================================================================
 | 
 | 통합모달 - 쇼핑백 상품정보
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

$country				= $_POST['country'];
$member_idx				= $_POST['member_idx'];

if ($country != null && $member_idx != null) {
	$select_basket_info_sql = "
		SELECT
			PR.IDX						AS PRODUCT_IDX,
			PR.PRODUCT_TYPE				AS PRODUCT_TYPE,
			PR.STYLE_CODE				AS STYLE_CODE,
			PR.COLOR_CODE				AS COLOR_CODE,
			PR.PRODUCT_CODE				AS PRODUCT_CODE,
			PR.PRODUCT_NAME				AS PRODUCT_NAME,
			PR.PRICE_".$country."		AS PRICE_KR,
			PR.DISCOUNT_".$country."	AS DISCOUNT_KR,
			PR.SALES_PRICE_".$country."	AS SALES_PRICE_KR,
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
					S_PI.PRODUCT_IDX = PR.IDX AND
					S_PI.DEL_FLG = FALSE AND
					S_PI.IMG_SIZE = 'S' AND
					S_PI.IMG_TYPE = 'P'
				ORDER BY
					S_PI.IDX ASC
				LIMIT
					0,1
			)							AS IMG_LOCATION,
			(
				SELECT
					IFNULL(SUM(S_PS.STOCK_QTY),0)
				FROM
					PRODUCT_STOCK S_PS
				WHERE
					S_PS.PRODUCT_IDX = PR.IDX AND
					S_PS.STOCK_DATE <= NOW()
			)							AS STOCK_QTY,
			(
				SELECT
					IFNULL(SUM(S_PS.STOCK_SAFE_QTY),0)
				FROM
					PRODUCT_STOCK S_PS
				WHERE
					S_PS.PRODUCT_IDX = PR.IDX AND
					S_PS.STOCK_DATE <= NOW()
			)							AS SAFE_QTY,
			(
				SELECT
					IFNULL(SUM(S_OP.PRODUCT_QTY),0)
				FROM
					ORDER_PRODUCT S_OP
				WHERE
					S_OP.ORDER_STATUS IN ('PCP','PPR','DPR','DPG','DCP') AND
					S_OP.PRODUCT_IDX = PR.IDX
			)							AS ORDER_QTY,
			
		FROM
			BASKET_INFO BI
			LEFT JOIN SHOP_PRODUCT PR ON
			BI.PRODUCT_IDX = PR.IDX
		WHERE
			BI.COUNTRY = '".$country."' AND
			BI.MEMBER_IDX = ".$member_idx." AND
			BI.DEL_FLG = FALSE
	";
	
	$db->query($select_basket_info_sql);
	
	foreach($db->fetch() as $basket_data) {
		$json_result['data'][] = array(
			'product_idx'		=>$basket_data['PRODUCT_IDX'],
			'product_type'		=>$basket_data['PRODUCT_TYPE'],
			'style_code'		=>$basket_data['STYLE_CODE'],
			'color_code'		=>$basket_data['COLOR_CODE'],
			'product_code'		=>$basket_data['PRODUCT_CODE'],
			'product_name'		=>$basket_data['PRODUCT_NAME'],
			'price'				=>$basket_data['PRICE'],
			'discount'			=>$basket_data['DISCOUNT'],
			'sales_price'		=>$basket_data['SALES_PRICE'],
			'img_location'		=>$basket_data['IMG_LOCATION'],
			'stock_qty'			=>$basket_data['STOCK_QTY'],
			'safe_qty'			=>$basket_data['SAFE_QTY'],
			'order_qty'			=>$basket_data['ORDER_QTY'],
			'product_qty'		=>intval($basket_data['STOCK_QTY'] - $basket_data['ORDER_QTY'])
		);
	}
}

?>