<?php
/*
 +=============================================================================
 | 
 | 공통
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.10.13
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

//동일 상품의 색상 정보 취득
function getProductColor($product_idx) {
	$sql = "SELECT
				PR.IDX			AS PRODUCT_IDX,
				OM.COLOR		AS COLOR,
				OM.COLOR_RGB	AS COLOR_RGB
			FROM
				dev.SHOP_PRODUCT PR
				LEFT JOIN dev.ORDERSHEET_MST OM ON
				PR.ORDERSHEET_IDX = OM.IDX
			WHERE
				OM.STYLE_CODE IN (
					SELECT
						STYLE_CODE
					FROM
						dev.SHOP_PRODUCT S_PR
						LEFT JOIN dev.ORDERSHEET_MST S_OM ON
						S_PR.ORDERSHEET_IDX = S_OM.IDX
					WHERE
						S_PR.IDX = ".$product_idx."
				)
			ORDER BY
				OM.COLOR ASC";
	
	$json_result = array();
	foreach($db->fetch() as $data) {
		$data['data'][] = array(
			'product_idx'	=>$data['PRODUCT_IDX'],
			'color_rgb'		=>$data['COLOR_RGB']
		);
	}
	
	return $json_result;
}

//상품의 옵션별 재고 정보 취득
function getProductStock($product_idx) {
	$product_sql="SELECT
					OO.IDX			AS OPTION_IDX,
					PR.SOLD_OUT_QTY	AS SOLD_OUT_QTY
				FROM
					dev.SHOP_PRODUCT PR
					LEFT JOIN dev.ORDERSHEET_OPTION OO on
					PR.ORDERSHEET_IDX = OO.ORDERSHEET_IDX
				WHERE
					PR.IDX = ".$product_idx."
				ORDER BY
					OO.IDX";
	
	$db->query($product_sql);
	
	$json_result = array();
	foreach($db->fetch() as $product_data) {
		$option_idx = $product_data['OPTION_IDX'];
		$sold_out_qty = $product_data['SOLD_OUT_QTY'];
	
		$option_sql  = "SELECT
							OO.IDX			AS OPTION_IDX,
							OO.OPTION_NAME	AS OPTION_NAME,
							(
								SELECT
									COUNT(IDX)
								FROM
									dev.PRODUCT_STOCK S_PS_1
								WHERE
									S_PS_1.OPTION_IDX = OO.IDX AND
									S_PS_1.STOCK_DATE > NOW()
							)				AS STOCK_STANDBY,
							(
								SELECT
									SUM(STOCK_QTY)
								FROM
									dev.PRODUCT_STOCK S_PS_2
								WHERE
									S_PS_2.OPTION_IDX = ".$option_idx." AND
									S_PS_2.STOCK_DATE <= NOW()
							)				AS STOCK_QTY,
							(
								SELECT
									SUM(OP.PRODUCT_QTY) AS STOCK_QTY
								FROM
									dev.ORDER_INFO OI
									LEFT JOIN dev.ORDER_PRODUCT OP ON
									OI.IDX = OP.ORDER_INFO_IDX
								WHERE
									OI.ORDER_STATUS IN ('DPG','DCP') AND
									OP.OPTION_IDX = ".$option_idx."
							)				AS ORDER_QTY
						FROM
							dev.ORDERSHEET_OPTION OO
						WHERE
							OO.IDX = ".$option_idx;
	
		$db->query($option_sql);
		
		foreach($db->fetch() as $option_data) {
			$product_qty = intval($option_data['STOCK_QTY']) - intval($option_data['ORDER_QTY']);
			$stock_standby = $option_data['STOCK_STAND_BY'];
			
			$stock_status = "";
			
			if ($product_qty > 0) {
				if ($product_qty > $sold_out_qty) {
					$stock_status = "STIN";	//재고 있음 (Stock in)
				} else {
					$stock_status = "STCL";	//품절 임박 (Stock sold out close)
				}
			} else {
				if ($stock_standby > 0) {
					$stock_status = "STSC";	//재고 없음(그레이아웃)	→ 재고 증가 예정 (Stock in schedule)
				} else {
					$stock_status = "STSO";	//재고 없음(사선)		→ 증가 예정 재고 없음 (Stock sold out)
				}
			}
			
			$json_result['data'][] = array(
				'option_idx'		=>$data['OPTION_IDX'],
				'option_name'		=>$data['OPTION_NAME'],
				'stock_status'		=>$stock_status
			);
		}
	}
	
	return $json_result;
}
?>