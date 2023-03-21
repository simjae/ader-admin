<?php
/*
 +=============================================================================
 | 
 | 샘플 정보 등록 - 샘플 정보 등록
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
include_once("/var/www/admin/api/common/common.php");

$session_id			= sessionCheck();
$ordersheet_idx		= $_POST['ordersheet_idx'];
$manufacturer		= $_POST['manufacturer'];
$due_date			= $_POST['due_date'];
$product_qty		= $_POST['product_qty'];
$memo		= $_POST['memo'];

if ($ordersheet_idx != null) {
	$sql = "INSERT INTO
				SAMPLE_INFO
			(
				ORDERSHEET_IDX,
				STYLE_CODE,
				COLOR_CODE,
				PRODUCT_CODE,
				PRODUCT_NAME,
				COLOR,
				MANUFACTURER,
				DUE_DATE,
				PRODUCT_QTY,
				MEMO,
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
				'".$manufacturer."',
				'".$due_date."',
				".$product_qty.",
				'".$memo."',
				'".$session_id."',
				'".$session_id."'
			FROM
				ORDERSHEET_MST
			WHERE
				IDX = ".$ordersheet_idx;
	
	$db->query($sql);
}
?>