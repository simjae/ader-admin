<?php
/*
 +=============================================================================
 | 
 | 회원 목록
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.07.27
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$stock_idx			= $_POST['stock_idx'];
$action_type		= $_POST['action_type'];

$stock_qty			= $_POST['stock_qty'];
$stock_safe_qty		= $_POST['stock_safe_qty'];
$total_sales_cnt	= $_POST['total_sales_cnt'];

//검색 유형 - 디폴트
if ($stock_idx != null) {
	$sql = "";
	
	switch ($action_type) {
		case "update" :
			$sql = "UPDATE
						dev.PRODUCT_STOCK
					SET
						STOCK_QTY = ".$stock_qty.",
						STOCK_SAFE_QTY = ".$stock_safe_qty."
					WHERE
						IDX = ".$stock_idx;
			
			break;
		
		case "delete" :
			$sql = "DELETE FROM dev.PRODUCT_STOCK WHERE IDX = ".$stock_idx;
			break;
	}

	$db->query($sql);
}
?>