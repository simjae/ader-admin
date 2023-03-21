<?php

/*
 +=============================================================================
 | 
 | 바우처 상품등록
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.02.20
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

include_once("/var/www/admin/api/common/common.php");

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$session_id				= sessionCheck();

$voucher_product_list	= NULL;
$voucher_product_list	= $_POST['voucher_product_list'];

$voucher_idx			= NULL;
$voucher_idx			= $_POST['voucher_idx'];

if($voucher_product_list != NULL && $voucher_idx != NULL){
	$db->begin_transaction();
	
	try {
		$init_voucher_product_sql = "
			DELETE FROM
				VOUCHER_PRODUCT
			WHERE
				voucher_idx = ".$voucher_idx."
		";
		$db->query($init_voucher_product_sql);

		$regist_voucher_product_sql = "
			INSERT INTO
				VOUCHER_PRODUCT
			( 
				VOUCHER_IDX,
				PRODUCT_IDX,
				CREATER,
				UPDATER
			)
			SELECT
				".$voucher_idx.",
				IDX,
				'".$session_id."',
				'".$session_id."'
			FROM
				SHOP_PRODUCT
			WHERE
				IDX IN (".$voucher_product_list.")
		";
		$db->query($regist_voucher_product_sql);
		$voucher_product_idx = $db->last_id();

		if (!empty($voucher_product_idx)) {
			$update_voucher_sql = "
				UPDATE
					VOUCHER_MST
				SET
					UPDATE_DATE = NOW(),
					UPDATER = '".$session_id."';
			";
			
			$db->query($update_voucher_sql);
		}

		$db->commit();
	} 
	catch(mysqli_sql_exception $exception){
		$json_result['code'] = 301;
		$db->rollback();
		$json_result['msg'] = '바우처 상품등록에 실패했습니다.';
		return $json_result;
	}
} 