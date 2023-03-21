<?php
/*
 +=============================================================================
 | 
 | 회원 목록
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.07.18
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$currency_idx = $_POST['currency_idx'];
$country = $_POST['country'];
$currency = $_POST['currency'];

$set_sql = "";
if ($country != null) {
	$set_sql .= " COUNTRY = '".$country."', ";
}

if ($currency != null) {
	$set_sql .= " CURRENCY = '".$currency."', ";
}

$sql = "UPDATE
			PRODUCT_CURRENCY
		SET
			".$set_sql."
			UPDATE_DATE = NOW()"
$sql = "WHERE
			IDX = ".$currency_idx;
$db->query($sql);
?>