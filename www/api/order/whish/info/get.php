<?php
/*
 +=============================================================================
 | 
 | 찜한 상품 리스트 - 상품 옵션 및 수량정보 취득
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.10.14
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$product_idx	= $_POST['product_idx'];

if ($product_idx != null) {
	//일반 상품 주문 상태	: 결제완료(PCP)	| 상품준비(PPR) 							| 배송준비(DPR) | 배송중(DPG) | 배송완료(DCP)
	//프리오더 상품 주문 상태	: 결제완료(PCP)	| 프리오더 준비(POP) | 프리오더 상품 생산(POD)	| 배송준비(DPR) | 배송중(DPG) | 배송완료(DCP)
	//현재 주문 상품 중 배송중/배송완료 상태의 주문 상품 수량 취득
	$order_stock_sql = "SELECT
							OP.BARCODE			AS BARCODE,
							SUM(OP.PRODUCT_QTY) AS STOCK_QTY
						FROM
							dev.ORDER_PRODUCT OP
							LEFT JOIN dev.ORDER_INFO OI ON
							OP.ORDER_INFO_IDX = OI.IDX
						WHERE
							OP.PRODUCT_IDX = ".$product_idx." AND
							OI.ORDER_STATUS IN ('DPG','DCP')
						GROUP BY
							OP.BARCODE";
	
	$db->query($order_stock_sql);
	
	$order_stock_result = array();
	foreach($db->fetch() as $order_stock_data) {
		$barcode = $order_stock_data['BARCODE'];
		
		$order_stock_result[$barcode] = $order_stock_data['STOCK_QTY'];
	}
	
	$sql = "SELECT
				OO.IDX			AS OPTION_IDX,
				OO.OPTION_NAME	AS OPTION_NAME,
				PR.SOLD_OUT_QTY	AS SOLD_OUT_QTY,
				(
					SELECT
						SUM(STOCK_QTY)
					FROM
						dev.PRODUCT_STOCK S_PS_1
					WHERE
						S_PS_1.OPTION_IDX = OO.IDX AND
						S_PS_1.STOCK_DATE <= NOW()
				) AS STOCK_QTY,
				(
					SELECT
						COUNT(IDX)
					FROM
						dev.PRODUCT_STOCK S_PS_2
					WHERE
						S_PS_2.OPTION_IDX = OO.IDX AND
						S_PS_2.STOCK_DATE > NOW()
				) AS STOCK_STANDBY
			FROM
				dev.SHOP_PRODUCT PR
				LEFT JOIN dev.ORDERSHEET_OPTION OO ON
				PR.ORDERSHEET_IDX = OO.ORDERSHEET_IDX
			WHERE
				";
	
	$db->query($sql);
	
	foreach($db->fetch() as $data) {
		$sold_out_qty = $data['SOLD_OUT_QTY'];
		$stock_qty = intval($data['STOCK_QTY']) - intval($order_stock_result[$option_stock_data['BARCODE']]);
		$stock_standby = $data['STOCK_STAND_BY'];
		
		$stock_status = "";
		
		if ($stock_qty > 0) {
			if ($stock_qty > $sold_out_qty) {
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
			'stock_status'		=>$data['STOCK_STATUS']
		);
	}
}
?>