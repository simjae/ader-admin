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

$country = $_POST['country'];

if ($country != null) {
	$sql = "SELECT
				PP.IDX				AS POPULAR_IDX,
				PP.DISPLAY_NUM		AS DISPLAY_NUM,
				PR.IDX				AS PRODUCT_IDX,
				PR.STYLE_CODE		AS STYLE_CODE,
				PR.COLOR_CODE		AS COLOR_CODE,
				PR.PRODUCT_CODE		AS PRODUCT_CODE,
				PR.PRODUCT_TYPE		AS PRODUCT_TYPE,
				PR.PRODUCT_NAME		AS PRODUCT_NAME,
				(
					SELECT
						REPLACE(S_PI.IMG_LOCATION,'/var/www/admin/www','')
					FROM
						dev.PRODUCT_IMG S_PI
					WHERE
						S_PI.PRODUCT_IDX = PR.IDX AND
						S_PI.IMG_TYPE = 'P' AND
						S_PI.IMG_SIZE = 'S'
					ORDER BY
						IDX ASC
					LIMIT
						0,1
				) AS IMG_LOCATION,
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
						dev.PRODUCT_STOCK S_PS
					WHERE
						S_PS.PRODUCT_IDX = PR.IDX AND
						S_PS.STOCK_DATE <= NOW()
				)	AS STOCK_QTY,
				(
					SELECT
						IFNULL(SUM(S_PS.STOCK_SAFE_QTY),0)
					FROM
						dev.PRODUCT_STOCK S_PS
					WHERE
						S_PS.PRODUCT_IDX = PR.IDX AND
						S_PS.STOCK_DATE <= NOW()
				)	AS SAFE_QTY,
				(
					SELECT
						IFNULL(SUM(S_OP.PRODUCT_QTY),0)
					FROM
						dev.ORDER_PRODUCT S_OP
					WHERE
						S_OP.ORDER_STATUS IN ('PCP','PPR','DPR','DPG','DCP') AND
						S_OP.PRODUCT_IDX = PR.IDX
				)	AS ORDER_QTY,
				PR.UPDATE_DATE		AS UPDATE_DATE
			FROM
				POPULAR_PRODUCT PP
				LEFT JOIN dev.SHOP_PRODUCT PR ON
				PP.PRODUCT_IDX = PR.IDX
			WHERE
				PP.COUNTRY = '".$country."'
			ORDER BY
				PP.DISPLAY_NUM ASC";

	$cnt = $db->count("dev.POPULAR_PRODUCT");
	$db->query($sql);
	foreach($db->fetch() as $data) {
		$json_result['data'][] = array(
			'popular_idx'		=>$data['POPULAR_IDX'],
			'display_num'		=>$data['DISPLAY_NUM'],
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
			'update_date'		=>$data['UPDATE_DATE']
		);
	}
}
?>