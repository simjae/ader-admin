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

$member_idx = 0;
if (isset($_SESSION['MEMBER_IDX'])) {
	$member_idx = $_SESSION['MEMBER_IDX'];
}

$member_id = null;
if (isset($_SESSION['MEMBER_ID'])) {
	$member_id = $_SESSION['MEMBER_ID'];
}

$basket_idx		= $_POST['basket_idx'];
$product_idx	= $_POST['product_idx'];
$option_idx		= $_POST['option_idx'];
$basket_qty		= $_POST['basket_qty'];
$stock_status	= $_POST['stock_status'];

if ($member_idx == 0 || $member_id == null) {
	$json_result['code'] = 401;
	$json_result['msg'] = "로그인 후 다시 시도해 주세요.";
	return $json_result;
}

if ($basket_idx != null && $product_idx != null && $stock_status != null) {
	if ($stock_status == "STIN") {
		$stock_sql = "SELECT
						(
							SELECT
								IFNULL(SUM(STOCK_QTY),0)
							FROM
								dev.PRODUCT_STOCK S_PS
							WHERE
								S_PS.PRODUCT_IDX = BI.PRODUCT_IDX AND
								S_PS.OPTION_IDX = BI.OPTION_IDX AND
								S_PS.STOCK_DATE <= NOW()
						)	AS STOCK_QTY,
						(
							SELECT
								IFNULL(SUM(OP.PRODUCT_QTY),0)
							FROM
								dev.ORDER_PRODUCT OP
							WHERE
								OP.PRODUCT_IDX = BI.PRODUCT_IDX AND
								OP.OPTION_IDX = BI.OPTION_IDX AND
								OP.ORDER_STATUS IN ('PCP','PPR','DPR','DPG','DCP')
						)	AS ORDER_QTY
					FROM
						dev.BASKET_INFO BI
					WHERE
						BI.IDX = ".$basket_idx;
		
		$db->query($stock_sql);
		
		$product_qty = 0;
		foreach($db->fetch() as $data) {
			$product_qty = intval($data['STOCK_QTY']) - intval($data['ORDER_QTY']);
		}
		
		if ($product_qty > 0 && $product_qty >= $basket_qty) {
			$update_sql="UPDATE
							dev.BASKET_INFO BI
						SET
							BI.PRODUCT_QTY = ".$basket_qty.",
							BI.UPDATER = '".$member_id."',
							BI.UPDATE_DATE = NOW()
						WHERE
							BI.IDX = ".$basket_idx." AND
							BI.MEMBER_IDX = ".$member_idx." AND
							BI.PRODUCT_IDX = ".$product_idx;
			
			$db->query($update_sql);
		} else {
			$json_result['code'] = 403;
			$json_result['msg'] = "재고 수량보다 많은 양을 선택할 수 없습니다.";
		}
	} else if ($stock_status == "STSO") {
		$delete_sql="DELETE FROM
						dev.BASKET_INFO BI
					WHERE
						BI.IDX = ".$basket_idx;
		
		$db->query($delete_sql);
		
		$insert_sql="INSERT INTO
						dev.BASKET_INFO
					(
						MEMBER_IDX,
						MEMBER_ID,
						PRODUCT_IDX,
						PRODUCT_CODE,
						PRODUCT_NAME,
						OPTION_IDX,
						BARCODE,
						OPTION_NAME,
						PRODUCT_QTY,
						CREATER,
						UPDATER
					)
					SELECT
						".$member_idx."		AS MEMBER_IDX,
						'".$member_id."'	AS MEMBER_ID,
						PR.IDX				AS PRODUCT_IDX,
						PR.PRODUCT_CODE		AS PRODUCT_CODE,
						PR.PRODUCT_NAME		AS PRODUCT_NAME,
						OO.IDX				AS OPTION_IDX,	
						OO.BARCODE			AS BARCODE,
						OO.OPTION_NAME		AS OPTION_NAME,
						".$product_qty."	AS PRODUCT_QTY,
						'".$member_id."'	AS CREATER,
						'".$member_id."'	AS UPDATER
					FROM
						dev.SHOP_PRODUCT PR
						LEFT JOIN dev.ORDERSHEET_OPTION OO ON
						PR.ORDERSHEET_IDX = OO.ORDERSHEET_IDX AND
						OO.IDX = ".$option_idx."
					WHERE
						PR.IDX = ".$product_idx;
		
		$db->query($insert_sql);
	}
}
?>