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

$member_idx		= $_SESSION[SS_HEAD.'MEMBER_IDX'];
$member_id		= $_SESSION[SS_HEAD.'MEMBER_ID'];

$basket_idx		= $_POST['basket_idx'];
$product_idx	= $_POST['product_idx'];
$option_idx		= $_POST['option_idx'];
$product_qty	= $_POST['product_qty'];
$stock_status	= $_POST['stock_status'];

if ($member_idx != null && $basket_idx != null && $stock_status != null) {
	if ($stock_status == "STIN" || $stock_status == "STSH" || $stock_status == "STCL") {
		//"STIN" : 재고 있음 (Stock in)
		//"STSH" : 재고 부족 (Stock shortage)
		//"STCL" : 품절 임박 (Stock sold out close)
		$update_sql="UPDATE
					dev.BASKET_INFO BI,
					(
						SELECT
							IDX					AS OPTION_IDX,
							BARCODE				AS BARCODE,
							OPTION_NAME			AS OPTION_NAME
						FROM
							dev.ORDERSHEET_OPTION
						WHERE
							IDX =".$option_idx."
					) OO
				SET
					BI.OPTION_IDX = OO.OPTION_IDX,
					BI.BARCODE = OO.BARCODE,
					BI.OPTION_NAME = OO.OPTION_NAME,
					BI.PRODUCT_QTY = ".$product_qty."
				WHERE
					BI.IDX = ".$basket_idx." AND
					BI.MEMBER_IDX = ".$member_idx." AND
					BI.PRODUCT_IDX = ".$product_idx." AND
					BI.OPTION_IDX = ".$option_idx;
	
		$db->query($update_sql);
	} else if ($stock_status == "STSC" || $stock_status == "STSO") {
		//"STSC" : 재고 없음(재고 증가 예정 (Stock in schedule))
		//"STSO" : 재고 없음(증가 예정 재고 없음 (Stock sold out))
		
		$delete_sql="DELETE FROM
						dev.BASKET_INFO
					WHERE
						IDX = ".$basket_idx;
		
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
						".$member_idx.",
						'".$member_id."',
						PR.IDX			AS PRODUCT_IDX,
						PR.PRODUCT_CODE	AS PRODUCT_CODE,
						PR.PRODUCT_NAME	AS PRODUCT_NAME,
						OO.IDX			AS OPTION_IDX,	
						OO.BARCODE		AS BARCODE,
						OO.OPTION_NAME	AS OPTION_NAME,
						".$product_qty.",
						'".$member_id."',
						'".$member_id."'
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