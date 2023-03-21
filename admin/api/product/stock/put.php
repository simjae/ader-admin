<?php
/*
 +=============================================================================
 | 
 | 회원 목록
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.07.31
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$action_type = $_POST['action_type'];
$stock_idx = $_POST['stock_idx'];
$stock_qty = $_POST['stock_qty'];
$safe_qty = $_POST['safe_qty'];
$total_sales_cnt = $_POST['total_sales_cnt'];

//재고시트 json string 디코딩
$stock_sheet = $_POST['stock_sheet'];
$sheet_data = json_decode($stock_sheet, true);

$stock_qty_arr = array();
if ($stock_qty != null) {
	$stock_qty_arr[0] = " STOCK_QUANTITY = ";
	$stock_qty_arr[1] = $stock_qty.",";
}

$safe_qty_arr = array();
if ($safe_qty != null) {
	$safe_qty_arr[0] = " STOCK_SAFE_QUANTITY = ";
	$safe_qty_arr[1] = $safe_qty.",";
}

$total_sales_cnt_arr = array();
if ($total_sales_cnt != null) {
	$total_sales_cnt_arr[0] = " TOTAL_SALES_CNT = ";
	$total_sales_cnt_arr[1] = $total_sales_cnt.",";
}

$sql = "";
if ($action_type != null && $stock_idx != null) {
	if ($action_type == "update") {
		$sql = "UPDATE
					PRODUCT_STOCK
				SET
					".$stock_qty_arr[0].$stock_qty_arr[1]."
					".$safe_qty_arr[0].$safe_qty_arr[1]."
					".$total_sales_cnt_arr[0].$total_sales_cnt_arr[1]."
					UPDATE_DATE = NOW(),
					UPDATER = 'Admin'
				WHERE
					IDX=".$stock_idx;
	} else if ($action_type == "delete") {
		if ($stock_idx != null) {
			$sql = "DELETE FROM PRODUCT_STOCK WHERE IDX = ".$stock_idx;
		}
	}
	$db->query($sql);
}

if($sheet_data != null){
	$success_cnt = 0;
	foreach($sheet_data as $val){
		if($val[0] != null && $val[1] != null && $val[2] != null && $val[3] != null){
			$where = "	PRODUCT_CODE = ? 
					AND PRODUCT_NAME = ? 
					AND OPTION_CODE  = ? 
					AND OPTION_NAME  = ? ";
			$where_value = array($val[0],$val[1],$val[2],$val[3]);
			if($db->count('PRODUCT_STOCK',$where,$where_value) > 0){
				$sql = "
						INSERT INTO PRODUCT_STOCK(	
							PRODUCT_CODE,
							PRODUCT_NAME,
							OPTION_CODE,
							OPTION_NAME,
							STOCK_QUANTITY,
							STOCK_SAFE_QUANTITY,
							TOTAL_SALES_CNT,
							STOCK_DATE
						)
						VALUES(
							'".$val[0]."',
							'".$val[1]."',
							'".$val[2]."',
							'".$val[3]."',
							".($val[4]!=null?$val[4]:0).",
							".($val[5]!=null?$val[5]:0).",
							".($val[6]!=null?$val[6]:0).",
							".$val[7]."
						)
				";
				$db->query($sql);
				$success_cnt++;
			}
		}
	}
	if($success_cnt == 0){
		$code = 500;
		$msg = "재고추가 작업을 수행하지 못했습니다.";
	}
	$json_result['success_cnt'] = $success_cnt;
}
?>