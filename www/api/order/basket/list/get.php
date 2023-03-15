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

include_once("/var/www/www/api/common/common.php");

$member_idx = 0;
if (isset($_SESSION['MEMBER_IDX'])) {
	$member_idx = $_SESSION['MEMBER_IDX'];
}

$country = null;
if (isset($_SESSION['COUNTRY'])) {
	$country = $_SESSION['COUNTRY'];
}

if ($member_idx == 0 || $country == null) {
	$json_result['code'] = 401;
	$json_result['msg'] = "로그인 후 다시 시도해 주세요.";
	exit;
}

if ($member_idx > 0 && $country != null) {
	$select_basket_sql = "
		SELECT
			BI.IDX						AS BASKET_IDX,
			BI.PRODUCT_IDX				AS PRODUCT_IDX,
			(
				SELECT
					REPLACE(S_PI.IMG_LOCATION,'/var/www/admin/www','')
				FROM
					dev.PRODUCT_IMG S_PI
				WHERE
					S_PI.PRODUCT_IDX = BI.PRODUCT_IDX AND
					S_PI.IMG_TYPE = 'P' AND
					S_PI.IMG_SIZE = 'S'
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
			PR.PRICE_".$country."		AS PRICE,
			PR.DISCOUNT_".$country."	AS DISCOUNT,
			PR.SALES_PRICE_".$country."	AS SALES_PRICE,
			PR.SOLD_OUT_QTY				AS SOLD_OUT_QTY,
			PR.REFUND_FLG				AS REFUND_FLG,
			PR.REFUND_MSG_FLG			AS REFUND_MSG_FLG,
			PR.SOLD_OUT_FLG				AS SOLD_OUT_FLG,
			(
				SELECT
					IFNULL(SUM(STOCK_QTY),0)
				FROM
					dev.PRODUCT_STOCK S_PS
				WHERE
					S_PS.PRODUCT_IDX = BI.PRODUCT_IDX AND
					S_PS.OPTION_IDX = BI.OPTION_IDX AND
					S_PS.STOCK_DATE <= NOW()
					
			)							AS STOCK_QTY,
			(
				SELECT
					IFNULL(SUM(S_OP.PRODUCT_QTY),0)
				FROM
					dev.ORDER_PRODUCT S_OP
				WHERE
					S_OP.PRODUCT_IDX = BI.PRODUCT_IDX AND
					S_OP.OPTION_IDX = BI.OPTION_IDX AND
					S_OP.ORDER_STATUS IN ('PCP','PPR','DPR','DPG','DCP')
			)							AS ORDER_QTY,
			BI.PRODUCT_QTY				AS BASKET_QTY,
			BI.REORDER_FLG				AS REORDER_FLG
		FROM
			dev.BASKET_INFO BI
			LEFT JOIN dev.SHOP_PRODUCT PR ON
			BI.PRODUCT_IDX = PR.IDX
			LEFT JOIN dev.ORDERSHEET_MST OM ON
			PR.ORDERSHEET_IDX = OM.IDX
		WHERE
			BI.MEMBER_IDX = ".$member_idx." AND
			BI.DEL_FLG = FALSE
		ORDER BY
			BI.IDX DESC
	";
	
	$db->query($select_basket_sql);
	
	$basket_st_info = array();	//재고 있음 | 품절 임박 상품 정보
	$basket_so_info = array();	//재고 없음 상품 정보
	
	foreach($db->fetch() as $data) {
		$product_idx = $data['PRODUCT_IDX'];
		
		if ($product_idx != null) {
			$sold_out_qty = $data['SOLD_OUT_QTY'];
			$product_qty = intval($data['STOCK_QTY']) - intval($data['ORDER_QTY']);
			$basket_qty = $data['BASKET_QTY'];
			
			$stock_status = "";
			
			if ($product_qty > 0) {
				if ($basket_qty >= $product_qty) {
					$stock_status = "STSH";	//재고 부족 (Stock shortage)
				} else {
					if ($product_qty >= $sold_out_qty) {
						$stock_status = "STIN";	//재고 있음 (Stock in)
					} else {
						$stock_status = "STCL";	//품절 임박 (Stock sold out close)
					}
				}
			} else {
				$stock_status = "STSO";	//재고 없음(사선)		→ 증가 예정 재고 없음 (Stock sold out)
			}
			
			if ($stock_status == "STSH" || $stock_status == "STIN" || $stock_status == "STCL") {
				//[재고 있음] 장바구니 상품 데이터
				$basket_st_info[] = array(
					'basket_idx'		=>$data['BASKET_IDX'],
					'product_idx'		=>$data['PRODUCT_IDX'],
					'product_img'		=>$data['PRODUCT_IMG'],
					'product_name'		=>$data['PRODUCT_NAME'],
					'color'				=>$data['COLOR'],
					'color_rgb'			=>$data['COLOR_RGB'],
					'option_idx'		=>$data['OPTION_IDX'],
					'option_name'		=>$data['OPTION_NAME'],
					'price'				=>$data['PRICE'],
					'discount'			=>$data['DISCOUNT'],
					'sales_price'		=>$data['SALES_PRICE'],
					'product_qty'		=>$product_qty,
					'basket_qty'		=>$data['BASKET_QTY'],
					'stock_status'		=>$stock_status,
					'reorder_flg'		=>$data['REORDER_FLG'],
					'refund_flg'		=>$data['REFUND_FLG'],
					'refund_msg_flg'	=>$data['REFUND_MSG_FLG'],
					'sold_out_flg'		=>$data['SOLD_OUT_FLG']
				);
			} else if ($stock_status == "STSO") {
				$product_color = getProductColor($db,$product_idx);
				
				$product_size = getProductSize($db,$product_idx);
				
				//[재고 없음] 장바구니 상품 데이터
				$basket_so_info[] = array(
					'basket_idx'		=>$data['BASKET_IDX'],
					'product_idx'		=>$data['PRODUCT_IDX'],
					'product_img'		=>$data['PRODUCT_IMG'],
					'product_name'		=>$data['PRODUCT_NAME'],
					'color'				=>$data['COLOR'],
					'color_rgb'			=>$data['COLOR_RGB'],
					'option_idx'		=>$data['OPTION_IDX'],
					'option_name'		=>$data['OPTION_NAME'],
					'price'				=>$data['PRICE'],
					'discount'			=>$data['DISCOUNT'],
					'sales_price'		=>$data['SALES_PRICE'],
					'product_qty'		=>$product_qty,
					'basket_qty'		=>$data['BASKET_QTY'],
					'stock_status'		=>$stock_status,
					'product_color'		=>$product_color,
					'product_size'		=>$product_size,
					'reorder_flg'		=>$data['REORDER_FLG'],
					'refund_flg'		=>$data['REFUND_FLG'],
					'refund_msg_flg'	=>$data['REFUND_MSG_FLG'],
					'sold_out_flg'		=>$data['SOLD_OUT_FLG']
				);
			}
		}
	}
	
	$json_result['data'] = array(
		'basket_st_info'	=>$basket_st_info,
		'basket_so_info'	=>$basket_so_info
	);
}
?>