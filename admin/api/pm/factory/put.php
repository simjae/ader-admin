<?php
/*
 +=============================================================================
 | 
 | 공장별 수주 수정 - 공장별 수주 정보 변경
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.10.18
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$factory_idx	= $_POST['factory_idx'];
$manufacturer	= $_POST['manufacturer'];
$due_date		= $_POST['due_date'];
$product_qty	= $_POST['product_qty'];
$memo			= $_POST['memo'];

if ($factory_idx != null) {
	$set = "";
	
	if ($manufacturer != null) {
		$set .= " MANUFACTURER = '".$manufacturer."', ";
	}
	
	if ($due_date != null) {
		$set .= " DUE_DATE = '".$due_date."', ";
	}
	
	if ($product_qty != null) {
		$set .= " PRODUCT_QTY = ".$product_qty.", ";
	}
	
	if ($memo == null) {
		$memo = '';
	}
	$set .= " MEMO = '".$memo."', ";

	$sql = "UPDATE
				dev.FACTORY_INFO
			SET
				".$set."
				UPDATER = 'Admin',
				UPDATE_DATE = NOW()
			WHERE
				IDX = ".$factory_idx;
	
	$db->query($sql);
}
?>