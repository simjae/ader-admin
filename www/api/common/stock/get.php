<?php
/*
 +=============================================================================
 | 
 | [액션]컬러칩 클릭 - 해당 색상 상품의 옵션 및 재고상태 표시
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
	//일반 상품 주문 상태	: 결제완료(PCP)	| 상품준비(PPR) 							| 배송준비(DPR) | 배송중(DPG) | 배송완료(DCP)
	//프리오더 상품 주문 상태	: 결제완료(PCP)	| 프리오더 준비(POP) | 프리오더 상품 생산(POD)	| 배송준비(DPR) | 배송중(DPG) | 배송완료(DCP)
	//현재 주문 상품 중 배송중/배송완료 상태의 주문 상품 수량 취득
	
	$sql = "SELECT
				PR.IDX				AS PRODUCT_IDX,
				OO.IDX				AS OPTION_IDX,
				OO.OPTION_NAME		AS OPTION_NAME,
				(
					SELECT
						COUNT(IDX)
					FROM
						dev.PRODUCT_STOCK S_PS_1
					WHERE
						S_PS_1.OPTION_IDX = OO.IDX AND
						S_PS_1.STOCK_DATE > NOW()
				) AS STOCK_STANDBY,
				(
					SELECT
						SUM(STOCK_QTY)
					FROM
						dev.PRODUCT_STOCK S_PS_2
					WHERE
						S_PS_2.OPTION_IDX = OO.IDX AND
						S_PS_2.STOCK_DATE <= NOW()
				) AS STOCK_QTY,
				(
					SELECT
						SUM(S_OP.PRODUCT_QTY)
					FROM
						dev.ORDER_INFO S_OI
						LEFT JOIN dev.ORDER_PRODUCT S_OP ON
						S_OI.IDX = S_OP.ORDER_INFO_IDX
					WHERE
						S_OP.OPTION_IDX = OO.IDX AND
						OI.ORDER_STATUS IN ('DPG','DCP')
				) AS ORDER_QTY
			FROM
				dev.SHOP_PRODUCT PR
				LEFT JOIN dev.ORDERSHEET_MST OM ON
				PR.ORDERSHEET_IDX = OM.IDX
				LEFT JOIN dev.ORDERSHEET_OPTION OO ON
				OM.IDX = OO.ORDERSHEET_IDX
			WHERE
				PR.IDX = ".$product_idx;
	
	$db->query($sql);
	
	foreach($db->fetch() as $data) {
		$sold_out_qty = $data['SOLD_OUT_QTY'];
		$stock_standby = $data['STOCK_STAND_BY'];
		$product_qty = intval($data['STOCK_QTY']) - intval($data['ORDER_QTY']);
		
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
			'product_idx'		=>$data['PRODUCT_IDX'],
			'option_idx'		=>$data['OPTION_IDX'],
			'option_name'		=>$data['OPTION_NAME'],
			'stock_status'		=>$stock_status
		);
	}
}
?>