<?php
/*
 +=============================================================================
 | 
 | 장바구니 - 상품 리스트 조회
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

$member_idx		= $_SESSION[SS_HEAD.'MEMBER_IDX'];
$country		= $_POST['country'];

if ($member_idx != null && $country != null) {
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
				BI.IDX						AS BASKET_IDX,
				BI.PRODUCT_IDX				AS PRODUCT_IDX,
				(
					SELECT
						REPLACE(S_PI.IMG_LOCATION,'/var/www/admin/www','')
					FROM
						dev.PRODUCT_IMG S_PI
					WHERE
						S_PI.PRODUCT_IDX = WL.PRODUCT_IDX AND
						S_PI.IMG_TYPE = 'PRODUCT' AND
						S_PI.IMG_SIZE = 'SML'
					ORDER BY
						S_PI.IDX ASC
					LIMIT
						0,1
				)							AS PRODUCT_IMG,
				BI.PRODUCT_NAME				AS PRODUCT_NAME,
				OM.COLOR					AS COLOR,
				OM.COLOR_RGB				AS COLOR_RGB,
				BI.OPTION_IDX				AS OPTION_IDX,
				BI.OPTION_NAME				AS OPTION_NAME,
				PR.SALES_PRICE_".$country."	AS SALES_PRICE,
				PR.SOLD_OUT_QTY				AS SOLD_OUT_QTY,
				BI.PRODUCT_QTY				AS PRODUCT_QTY,
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
				dev.BASKET_INFO BI
				LEFT JOIN dev.SHOP_PRODUCT PR ON
				BI.PRODUCT_IDX = PR.IDX
				LEFT JOIN dev.ORDERSHEET_MST OM ON
				PR.ORDERSHEET_IDX = OM.IDX
			WHERE
				BI.MEMBER_IDX = ".$member_idx."
			ORDER BY
				BI.IDX DESC";
	
	$db->query($sql);
	
	$basket_st_info = array();	//재고 있음 | 품절 임박 상품 정보
	$basket_so_info = array();	//재고 없음 상품 정보
	
	foreach($db->fetch() as $data) {
		$sold_out_qty = $data['SOLD_OUT_QTY'];
		$stock_qty = intval($data['STOCK_QTY']) - intval($order_stock_result[$option_stock_data['BARCODE']]);
		$stock_standby = $data['STOCK_STAND_BY'];
		
		$stock_status = "";
		
		if ($stock_qty > 0) {
			if ($stock_qty > $sold_out_qty) {
				if ($stock_qty >= $product_qty) {
					$stock_status = "STIN";	//재고 있음 (Stock in)
				} else {
					$stock_status = "STSH";	//재고 부족 (Stock shortage)
				}
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
		
		if ($stock_status == "STIN" || $stock_status == "STCL") {
			//[재고 있음] 장바구니 상품 데이터
			$basket_st_info = array(
				'basket_idx'		=>$data['BASKET_IDX'],
				'product_idx'		=>$data['PRODUCT_IDX'],
				'product_img'		=>$data['PRODUCT_IMG'],
				'product_name'		=>$data['PRODUCT_NAME'],
				'color'				=>$data['COLOR'],
				'color_rgb'			=>$data['COLOR_RGB'],
				'option_idx'		=>$data['OPTION_IDX'],
				'option_name'		=>$data['OPTION_NAME'],
				'product_qty'		=>$data['PRODUCT_QTY'],
				'sales_price'		=>$data['SALES_PRICE'],
				'sales_price_total'	=>intval($data['PRODUCT_QTY']) * intval($data['SALES_PRICE']),
				'stock_status'		=>$data['STOCK_STATUS']
			);
		} else if ($stock_status == "STSC" || $stock_status == "STSO") {
			//[재고 없음] 장바구니 상품 데이터
			$basket_so_info = array(
				'basket_idx'		=>$data['BASKET_IDX'],
				'product_idx'		=>$data['PRODUCT_IDX'],
				'product_img'		=>$data['PRODUCT_IMG'],
				'product_name'		=>$data['PRODUCT_NAME'],
				'color'				=>$data['COLOR'],
				'color_rgb'			=>$data['COLOR_RGB'],
				'option_idx'		=>$data['OPTION_IDX'],
				'option_name'		=>$data['OPTION_NAME'],
				'stock_status'		=>$data['STOCK_STATUS']
			);
		}
	}
	
	$json_result['data'][] = array(
		'basket_st_info'	=>$basket_st_info,
		'basket_so_info'	=>$basket_so_info
	);
}
?>