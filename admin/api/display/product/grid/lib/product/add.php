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
	$sql = "
		SELECT
			PR.IDX				AS PRODUCT_IDX,
			PR.PRODUCT_CODE		AS PRODUCT_CODE,
			PR.PRODUCT_NAME				AS PRODUCT_NAME,
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
					S_PI.IMG_TYPE = 'P' AND
					S_PI.IMG_SIZE = 'S'
				ORDER BY
					IDX ASC
				LIMIT
					0,1
			)							AS IMG_LOCATION,
			IFNULL(
				PR.SALES_PRICE_KR,0
			)							AS SALES_PRICE_KR,
			IFNULL(
				PR.SALES_PRICE_EN,0
			)							AS SALES_PRICE_EN,
			IFNULL(
				PR.SALES_PRICE_CN,0
			)							AS SALES_PRICE_CN,
			PR.CREATE_DATE				AS CREATE_DATE,
			PR.UPDATE_DATE				AS UPDATE_DATE,
			(
				SELECT
					IFNULL(
						SUM(S_OP.PRODUCT_QTY),0
					)
				FROM
					ORDER_PRODUCT S_OP
				WHERE
					S_OP.ORDER_STATUS NOT IN (
						'OCC','OEX','OEP','ORF','ORP'
					) AND
					S_OP.PRODUCT_IDX = PR.IDX
			)							AS ORDER_CNT,
			(
				SELECT
					IFNULL(
						COUNT(S_WL.IDX),0
					)
				FROM
					WHISH_LIST S_WL
				WHERE
					S_WL.PRODUCT_IDX = PR.IDX AND
					S_WL.DEL_FLG = FALSE
			)							AS WHISH_CNT,
			(
				SELECT
					IFNULL(SUM(STOCK_QTY),0)
				FROM
					PRODUCT_STOCK S_PS
				WHERE
					S_PS.PRODUCT_IDX = PR.IDX AND
					S_PS.STOCK_DATE <= NOW()
			)	AS STOCK_QTY,
			(
				SELECT
					IFNULL(SUM(S_OP.PRODUCT_QTY),0)
				FROM
					ORDER_PRODUCT S_OP
				WHERE
					S_OP.PRODUCT_IDX = PR.IDX AND
					S_OP.ORDER_STATUS IN ('PCP','PPR','DPR','DPG','DCP')
			)	AS ORDER_QTY
		FROM
			SHOP_PRODUCT PR
		WHERE
			PR.IDX IN (".implode(',',$product_idx).")
		ORDER BY
			PR.IDX DESC
	";
	
	$db->query($sql);
	
	foreach($db->fetch() as $data) {
		$json_result['data'][] = array(
			'product_idx'		=>$data['PRODUCT_IDX'],
			'product_code'		=>$data['PRODUCT_CODE'],
			'product_name'		=>$data['PRODUCT_NAME'],
			'sales_price_kr'	=>$data['SALES_PRICE_KR'],
			'sales_price_en'	=>$data['SALES_PRICE_EN'],
			'sales_price_cn'	=>$data['SALES_PRICE_CN'],
			'order_cnt'			=>$data['ORDER_CNT'],
			'whish_cnt'			=>$data['WHISH_CNT'],
			'create_date'		=>$data['CREATE_DATE'],
			'update_date'		=>$data['UPDATE_DATE'],
			'product_qty'		=>intval($data['STOCK_QTY']) - intval($data['ORDER_QTY']),
			'img_location'		=>$data['IMG_LOCATION']
		);
	}
}
?>