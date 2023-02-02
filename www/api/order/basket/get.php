<?php
/*
 +=============================================================================
 | 
 | 찜한 상품 리스트 - 상품 정보 수정
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.10.17
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

include_once("/var/www/www/api/common/common.php");

$country = null;
if (isset($_SESSION['COUNTRY'])) {
	$country = $_SESSION['COUNTRY'];
}

$member_idx = 0;
if (isset($_SESSION['MEMBER_IDX'])) {
	$member_idx = $_SESSION['MEMBER_IDX'];
}

$member_id = null;
if (isset($_SESSION['MEMBER_ID'])) {
	$member_id = $_SESSION['MEMBER_ID'];
}

$basket_idx = 0;
if (isset($_POST['basket_idx'])) {
	$basket_idx	= $_POST['basket_idx'];
}

$product_idx = 0;
if (isset($_POST['product_idx'])) {
	$product_idx = $_POST['product_idx'];
}

if ($member_idx == 0 || $country == null) {
	$json_result['code'] = 401;
	$json_result['msg'] = "로그인 후 다시 시도해 주세요.";
	return $json_result;
}

if ($basket_idx > 0) {
	$select_product_sql = "
		SELECT
			PR.IDX			AS PRODUCT_IDX,
			OM.COLOR		AS COLOR,
			OM.COLOR_RGB	AS COLOR_RGB,
			(
				SELECT
					IFNULL(SUM(STOCK_QTY),0)
				FROM
					dev.PRODUCT_STOCK S_PS
				WHERE
					S_PS.PRODUCT_IDX = PR.IDX AND
					S_PS.STOCK_DATE <= NOW()
			)	AS STOCK_QTY,
			(
				SELECT
					IFNULL(SUM(OP.PRODUCT_QTY),0)
				FROM
					dev.ORDER_PRODUCT OP
				WHERE
					OP.PRODUCT_IDX = PR.IDX AND
					OP.ORDER_STATUS IN ('PCP','PPR','DPR','DPG','DCP')
			)	AS ORDER_QTY
		FROM
			dev.ORDERSHEET_MST OM
			LEFT JOIN dev.SHOP_PRODUCT PR ON
			OM.IDX = PR.ORDERSHEET_IDX
		WHERE
			OM.STYLE_CODE = (
				SELECT
					S_PR.STYLE_CODE
				FROM
					dev.SHOP_PRODUCT S_PR
				WHERE
					S_PR.IDX IN (
						SELECT
							S_BI.PRODUCT_IDX
						FROM
							dev.BASKET_INFO S_BI
						WHERE
							S_BI.IDX = ".$basket_idx." AND
							S_BI.MEMBER_IDX = ".$member_idx."
					)
			) AND
			(
				PR.LIMIT_MEMBER = 0 OR
				PR.LIMIT_MEMBER REGEXP (
					SELECT
						LEVEL_IDX
					FROM
						dev.MEMBER_".$country." S_MB
					WHERE
						IDX = ".$member_idx."
				)
			) AND
			PR.SALE_FLG = TRUE AND
			PR.DEL_FLG = FALSE
	";
	
	$db->query($select_product_sql);
	
	$product_size = array();
	foreach($db->fetch() as $product_data) {
		$product_idx = $product_data['PRODUCT_IDX'];
		
		$stock_status = "";
		$product_qty = intval($product_data['STOCK_QTY']) - intval($product_data['ORDER_QTY']);
		
		if ($product_qty > 0) {
			$stock_status = "STIN";	//재고 있음 (Stock in)
		} else {
			$stock_status = "STSO";	//재고 없음(사선)		→ 증가 예정 재고 없음 (Stock sold out)
		}
		
		$product_size = array();
		if (!empty($product_idx)) {
			$product_size = getProductSize($db,$product_idx);
		}
		
		$json_result['data'][] = array(
			'product_idx'	=>$product_data['PRODUCT_IDX'],
			'color'			=>$product_data['COLOR'],
			'color_rgb'		=>$product_data['COLOR_RGB'],
			'product_size'	=>$product_size
		);
	}
}

if ($product_idx > 0) {
	$product_size = array();
	$product_size = getProductSize($db,$product_idx);
	
	$json_result['data'] = array(
		'product_size'	=>$product_size
	);
}
?>