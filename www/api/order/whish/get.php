<?php
/*
 +=============================================================================
 | 
 | 위시 리스트 - 찜한 상품 조회
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

$member_idx = 0;
if (isset($_SESSION['MEMBER_IDX'])) {
	$member_idx = $_SESSION['MEMBER_IDX'];
}

if ($member_idx == 0) {
	$json_result['code'] = 401;
	$json_result['msg'] = "로그인 후 다시 시도해 주세요.";
	exit;
} else {
	$sql = "SELECT
				WL.PRODUCT_IDX	AS PRODUCT_IDX,
				(
					SELECT
						REPLACE(S_PI.IMG_LOCATION,'/var/www/admin/www','')
					FROM
						dev.PRODUCT_IMG S_PI
					WHERE
						S_PI.PRODUCT_IDX = WL.PRODUCT_IDX
						S_PI.IMG_SIZE = 'S' AND
						S_PI.IMG_TYPE = 'P' AND
					ORDER BY
						S_PI.IDX ASC
					LIMIT
						0,1
				)				AS PRODUCT_IMG,
				WL.PRODUCT_NAME	AS PRODUCT_NAME,
				PR.SOLD_OUT_QTY	AS SOLD_OUT_QTY,
				(
					SELECT
						IFNULL(SUM(S_PS.STOCK_QTY),0)
					FROM
						dev.PRODUCT_STOCK S_PS
					WHERE
						S_PS.PRODUCT_IDX = WL.PRODUCT_IDX AND
						STOCK_DATE <= NOW()
				)				AS STOCK_QTY,
				(
					SELECT
						IFNULL(SUM(S_OP.PRODUCT_QTY),0)
					FROM
						dev.ORDER_INFO S_OI
						LEFT JOIN dev.ORDER_PRODUCT S_OP ON
						S_OI.IDX = S_OP.ORDER_INFO_IDX
					WHERE
						S_OI.ORDER_STATUS IN ('DPG','DCP') AND
						S_OP.PRODUCT_IDX = WL.PRODUCT_IDX
				)				AS ORDER_QTY
			FROM
				dev.WHISH_LIST WL
				LEFT JOIN dev.SHOP_PRODUCT PR ON
				WL.PRODUCT_IDX = PR.IDX
			WHERE
				WL.MEMBER_IDX = ".$member_idx." AND
				WL.DEL_FLG = FALSE
			ORDER BY
				WL.IDX DESC";

	$db->query($sql);

	foreach($db->fetch() as $data) {
		$sold_out_qty = $data['SOLD_OUT_QTY'];
		$product_qty = intval($data['STOCK_QTY']) - intval($data['ORDER_QTY']);
		
		$stock_status = "";
		
		if ($product_qty > $sold_out_qty) {
			$stock_status = "STIN";	//재고 있음 (Stock in)
		} else {
			$stock_status = "STCL";	//품절 임박 (Stock sold out close)
		}
		
		$json_result['data'][] = array(
			'product_idx'		=>$data['PRODUCT_IDX'],
			'product_img'		=>$data['PRODUCT_IMG'],
			'product_name'		=>$data['PRODUCT_NAME'],
			'stock_status'		=>$stock_status
		);
	}
}
?>