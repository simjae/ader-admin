<?php
/*
 +=============================================================================
 | 
 | 공통 - 상품 별 색상 및 사이즈 재고 조회
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

$product_idx	= $_POST['product_idx'];

if ($product_idx != null) {
	$color_sql="SELECT
					OM.IDX			AS ORDERSHEET_IDX,
					PR.IDX			AS PRODUCT_IDX,
					OM.COLOR		AS COLOR,
					OM.COLOR_RGB	AS COLOR_RGB
					PR.SOLD_OUT_QTY	AS SOLD_OUT_QTY
				FROM
					dev.ORDERSHEET_MST OM
					LEFT JOIN dev.SHOP_PRODUCT PR ON
					OM.IDX = PR.ORDERSHEET_IDX
				WHERE
					STYLE_CODE = (
						SELECT
							S_OM.STYLE_CODE
						FROM
							dev.SHOP_PRODUCT S_PR
							LEFT JOIN dev.ORDERSHEET_MST S_OM ON
							S_PR.ORDERSHEET_IDX = S_OM.IDX
						WHERE
							PR.IDX = ".$product_idx."
					)
				";
	
	$db->query($color_sql);
	
	foreach($db->fetch() as $data) {
		$ordersheet_idx = $data['ORDERSHEET_IDX'];
		$sold_out_qty = $data['SOLD_OUT_QTY'];
		
		if (!empty($ordersheet_idx)) {
			//일반 상품 주문 상태	: 결제완료(PCP)	| 상품준비(PPR) 								| 배송준비(DPR) | 배송중(DPG) | 배송완료(DCP)
			//프리오더 상품 주문 상태	: 결제완료(PCP)	| 프리오더 상품 준비(POP) | 프리오더 상품 생산(POD)	| 배송준비(DPR) | 배송중(DPG) | 배송완료(DCP)
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
			
			$option_sql = "SELECT
									OO.IDX			AS OPTION_IDX,
									OO.BARCODE		AS BARCODE,
									OO.OPTION_NAME	AS OPTION_NAME,
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
									dev.ORDERSHEET_OPTION OO
								WHERE
									OO.ORDERSHEET_IDX = ".$ordersheet_idx;
			
			$db->query($option_sql);
			
			$option_info = array();
			foreach($db->fetch() as $option_stock_data) {
				$stock_qty = intval($option_stock_data['STOCK_QTY']) - intval($order_stock_result[$option_stock_data['BARCODE']]);
				$stock_standby = $option_stock_data['STOCK_STAND_BY'];
				
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
				
				$option_info['data'][] = array(
					'option_idx'		=>$option_stock_data['OPTION_IDX'],
					'option_name'		=>$option_stock_data['OPTION_NAME'],
					'stock_status'		=>$stock_status
				);
			}
		}
		
		$json_result['data'][] = array(
			'product_idx'		=>$data['PRODUCT_IDX'],
			'color'				=>$data['COLOR'],
			'color_rgb'			=>$data['COLOR_RGB'],
			'option_info'		=>$option_info
		);
	}
}
?>