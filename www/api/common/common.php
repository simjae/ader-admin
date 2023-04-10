<?php
/*
 +=============================================================================
 | 
 | 공통함수 - 상품 색상/사이즈 정보 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.10.25
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

/*
function checkProduct($db,$product_idx,$country,$member_idx) {
	$product_result = false;
	
	$product_cnt = $db->count(
		"SHOP_PRODUCT PR",
		"PR.IDX = ".$product_idx." AND (PR.LIMIT_MEMBER = 0 OR PR.LIMIT_MEMBER REGEXP (SELECT LEVEL_IDX FROM MEMBER_".$country." S_MB WHERE S_MB.IDX = ".$member_idx."))"
	);
	
	if ($product_cnt > 0) {
		$product_result = true;
	}
	
	return $product_result;
}
*/

function checkProductStockQty($db,$product_idx,$option_idx) {
	$stock_result = false;
	
	$select_stock_sql = "
		SELECT
			(
				SELECT
					IFNULL(SUM(STOCK_QTY),0)
				FROM
					PRODUCT_STOCK S_PS
				WHERE
					S_PS.PRODUCT_IDX = PR.IDX AND
					S_PS.OPTION_IDX = ".$option_idx." AND
					S_PS.STOCK_DATE <= NOW()
			)	AS STOCK_QTY,
			(
				SELECT
					IFNULL(SUM(S_OP.PRODUCT_QTY),0)
				FROM
					ORDER_PRODUCT S_OP
				WHERE
					S_OP.PRODUCT_IDX = PR.IDX AND
					S_OP.OPTION_IDX = ".$option_idx." AND
					S_OP.ORDER_STATUS IN ('PCP','PPR','DPR','DPG','DCP')
			)	AS ORDER_QTY
		FROM
			SHOP_PRODUCT PR
		WHERE
			PR.IDX = ".$product_idx."
	";
	
	$db->query($select_stock_sql);
	
	$product_qty = 0;
	foreach($db->fetch() as $stock_data) {
		$stock_qty = $stock_data['STOCK_QTY'];
		$order_qty = $stock_data['ORDER_QTY'];
		
		$product_qty = (intval($stock_qty) - intval($order_qty));
	}
	
	if ($product_qty > 0) {
		$stock_result = true;
	}
	
	return $stock_result;
}

function getProductColor($db,$product_idx) {
	if ($product_idx != null) {
		$sql = "SELECT
					PR.IDX			AS PRODUCT_IDX,
					OM.COLOR		AS COLOR,
					PR.COLOR_RGB	AS COLOR_RGB,
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
							IFNULL(SUM(OP.PRODUCT_QTY),0)
						FROM
							ORDER_PRODUCT OP
						WHERE
							OP.PRODUCT_IDX = PR.IDX AND
							OP.ORDER_STATUS IN ('PCP','PPR','DPR','DPG','DCP')
					)	AS ORDER_QTY
				FROM
					SHOP_PRODUCT PR
					LEFT JOIN ORDERSHEET_MST OM ON
					PR.ORDERSHEET_IDX = OM.IDX
				WHERE
					PR.SALE_FLG = TRUE AND
					PR.STYLE_CODE = (
						SELECT
							S_PR.STYLE_CODE
						FROM
							SHOP_PRODUCT S_PR
						WHERE
							S_PR.IDX = ".$product_idx."
					)";
	
		$db->query($sql);
		
		$product_color = array();
		foreach($db->fetch() as $data) {
			$stock_status = "";
			$product_qty = intval($data['STOCK_QTY']) - intval($data['ORDER_QTY']);
			
			$reorder_flg = false;
			if ($product_qty > 0) {
				$stock_status = "STIN";	//재고 있음 (Stock in)
			} else {
				$stock_status = "STSO";	//재고 없음(사선)		→ 증가 예정 재고 없음 (Stock sold out)
				
				$member_idx = 0;
				if (isset($_SESSION['MEMBER_IDX'])) {
					$member_idx = $_SESSION['MEMBER_IDX'];
				}
				
				if ($member_idx > 0) {
					$reorder_cnt = $db->count("PRODUCT_REORDER","MEMBER_IDX = ".$member_idx." AND PRODUCT_IDX = ".$product_idx);
					
					if ($reorder_cnt > 0) {
						$reorder_flg = true;
					}
				}
			}
			
			$product_color[] = array(
				'product_idx'		=>$data['PRODUCT_IDX'],
				'color'				=>$data['COLOR'],
				'color_rgb'			=>$data['COLOR_RGB'],
				'stock_status'		=>$stock_status,
				'reorder_flg'		=>$reorder_flg
			);
		}
		
		return $product_color;
	}
}

function getProductSize($db,$product_idx) {
	if ($product_idx > 0) {
		//일반 상품 주문 상태		: 결제완료(PCP)	| 상품준비(PPR) 							| 배송준비(DPR) | 배송중(DPG) | 배송완료(DCP)
		//프리오더 상품 주문 상태	: 결제완료(PCP)	| 프리오더 준비(POP) | 프리오더 상품 생산(POD)	| 배송준비(DPR) | 배송중(DPG) | 배송완료(DCP)
		//현재 주문 상품 중 배송중/배송완료 상태의 주문 상품 수량 취득
		
		$select_product_sql = "
			SELECT
				PR.IDX				AS PRODUCT_IDX,
				PR.SOLD_OUT_QTY		AS SOLD_OUT_QTY,
				OM.COLOR			AS COLOR,
				OO.IDX				AS OPTION_IDX,
				OO.OPTION_NAME		AS OPTION_NAME,
				(
					SELECT
						COUNT(IDX)
					FROM
						PRODUCT_STOCK S_PS_1
					WHERE
						S_PS_1.OPTION_IDX = OO.IDX AND
						S_PS_1.STOCK_DATE > NOW()
				) AS STOCK_STANDBY,
				(
					SELECT
						IFNULL(SUM(STOCK_QTY),0)
					FROM
						PRODUCT_STOCK S_PS_2
					WHERE
						S_PS_2.OPTION_IDX = OO.IDX AND
						S_PS_2.STOCK_DATE <= NOW()
				) AS STOCK_QTY,
				(
					SELECT
						IFNULL(SUM(S_OP.PRODUCT_QTY),0)
					FROM
						ORDER_PRODUCT S_OP
					WHERE
						S_OP.OPTION_IDX = OO.IDX AND
						S_OP.ORDER_STATUS IN ('PCP','PPR','POP','POD','DPR','DPG','DCP')
				) AS ORDER_QTY
			FROM
				SHOP_PRODUCT PR
				LEFT JOIN ORDERSHEET_MST OM ON
				PR.ORDERSHEET_IDX = OM.IDX
				LEFT JOIN ORDERSHEET_OPTION OO ON
				OM.IDX = OO.ORDERSHEET_IDX
			WHERE
				PR.IDX = ".$product_idx." AND
				PR.SALE_FLG = TRUE
		";
		
		$db->query($select_product_sql);
		
		$product_size = array();
		
		foreach($db->fetch() as $data) {
			$sold_out_qty = $data['SOLD_OUT_QTY'];
			$stock_standby = $data['STOCK_STANDBY'];
			$product_qty = intval($data['STOCK_QTY']) - intval($data['ORDER_QTY']);
			
			$str_size_len = strlen($data['OPTION_NAME']);
			if ($str_size_len == 2) {
				$size_type = "N";
			} else if ($str_size_len == 3) {
				$size_type = "O";
			} else {
				$size_type = "S";
			}
			
			$stock_status = "";
			
			if ($product_qty > 0) {
				if ($product_qty >= $sold_out_qty) {
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
			
			$product_size[] = array(
				'product_idx'		=>$data['PRODUCT_IDX'],
				'color'				=>$data['COLOR'],
				'option_idx'		=>$data['OPTION_IDX'],
				'option_name'		=>$data['OPTION_NAME'],
				'size_type'			=>$size_type,
				'stock_status'		=>$stock_status
			);
		}
		
		return $product_size;
	}
}
?>