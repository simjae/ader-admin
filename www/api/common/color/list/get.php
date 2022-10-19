<?php
/*
 +=============================================================================
 | 
 | 공통 - 한 상품에 대해 동일한 스타일 코드를 가진 상품의 색상 및 재고상태 취득
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

$product_idx	= $_POST['product_idx'];

if ($product_idx != null) {
	$sql = "SELECT
				PR.IDX			AS PRODUCT_IDX,
				OM.COLOR_RGB	AS COLOR_RGB
			FROM
				dev.SHOP_PRODUCT PR
				LEFT JOIN dev.ORDERSHEET_MST OM ON
				PR.ORDERSHEET_IDX = OM.IDX
			WHERE
				OM.STYLE_CODE = (
					SELECT
						S_PR.STYLE_CODE
					FROM
						dev.SHOP_PRODUCT S_PR
					WHERE
						S_PR.IDX = ".$product_idx."
				)";
	
	$db->query($sql);
	
	foreach($db->fetch() as $data) {
		$product_idx = $data['PRODUCT_IDX'];
		
		$sql = "SELECT
					(
						SELECT
							SUM(STOCK_QTY)
						FROM
							dev.PRODUCT_STOCK S_PS
						WHERE
							S_PS.PRODUCT_IDX = PR.IDX AND
							S_PS.STOCK_DATE <= NOW()
					)	AS STOCK_QTY,
					(
						SELECT
							SUM(OP.PRODUCT_QTY)
						FROM
							dev.ORDER_INFO OI
							LEFT JOIN dev.ORDER_PRODUCT OP ON
							OI.IDX = OP.ORDER_INFO_IDX
						WHERE
							OI.ORDER_STATUS IN ('DPG','DCP') AND
							OP.PRODUCT_IDX = PR.IDX
					)	AS ORDER_QTY
				FROM
					dev.SHOP_PRODUCT PR
				WHERE
					PR.IDX = ".$product_idx;
		
		$db->query($sql);
		
		$stock_status = "";
		foreach($db->fetch() as $stock_data) {
			$product_qty = intval($stock_data['STOCK_QTY']) - intval($stock_data['ORDER_QTY']);
			
			if ($product_qty > 0) {
				$stock_status = "STIN";	//재고 있음 (Stock in)
			} else {
				$stock_status = "STSO";	//재고 없음(사선)		→ 증가 예정 재고 없음 (Stock sold out)
			}
		}
		
		$json_result['data'][] = array(
			'product_idx'		=>$data['PRODUCT_IDX'],
			'color_rgb'			=>$data['COLOR_RGB'],
			'stock_status'		=>$stock_status
		);
	}
}
?>