<?php
/*
 +=============================================================================
 | 
 | 홀세일 등록 - 홀세일 정보 등록
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

$ordersheet_idx		= $_POST['ordersheet_idx'];
$country			= $_POST['country'];
$buyer				= $_POST['buyer'];
$due_date			= $_POST['due_date'];
$product_qty		= $_POST['product_qty'];

if ($ordersheet_idx != null) {
	$sql = "INSERT INTO
				dev.WHOLESALE_INFO
			(
				ORDERSHEET_IDX,
				STYLE_CODE,
				COLOR_CODE,
				PRODUCT_CODE,
				PRODUCT_NAME,
				COLOR,
				COUNTRY,
				BUYER,
				DUE_DATE,
				PRODUCT_QTY,
				CREATER,
				UPDATER
			)
			SELECT
				IDX,
				STYLE_CODE,
				COLOR_CODE,
				PRODUCT_CODE,
				PRODUCT_NAME,
				COLOR,
				'".$country."',
				'".$buyer."',
				'".$due_date."',
				".$product_qty.",
				'Admin',
				'Admin'
			FROM
				dev.ORDERSHEET_MST
			WHERE
				IDX = ".$ordersheet_idx;
	
	$db->query($sql);
}
?>