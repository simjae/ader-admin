<?php
/*
 +=============================================================================
 | 
 | 상품 복구/삭제 API
 | -----------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.07.12
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

/** 변수 정리 **/
$select_idx = $_POST['select_idx'];
$action_type = $_POST['action_type'];

$set = "";
$delete_sql = "";
if ($action_type != null) {
	if ($action_type == "product_restore") {
		$set .= " UPDATE_DATE = NOW(), ";
		$set .= " DEL_FLG = FALSE ";
	} 
	else if ($action_type == "product_delete") {
		$delete_sql .= "DELETE FROM dev.SHOP_PRODUCT WHERE ";
	}
	else if ($action_type == "order_status_set") {
		$set .= " UPDATE_DATE = NOW(), ";
		$set .= " PERSONAL_ORDER_FLG = TRUE ";
	}
}

$where = " 1=1 ";
$idx_list="";
if ($select_idx != null) {
	$idx_list = implode(',',$select_idx);
	$where .= " AND IDX IN (".$idx_list.")";
}

$tables = $_TABLE['SHOP_PRODUCT'];

/** DB 처리 **/

//수정항목
$sql = "UPDATE
			".$tables."
		SET
			".$set."
		WHERE
			".$where;
if ($action_type == "product_restore") {
	$db->query($sql);
}

if ($action_type == "product_delete") {
	$db->query($delete_sql.$where);
}

if ($action_type == "order_status_set") {
	$db->query($sql);
}
?>