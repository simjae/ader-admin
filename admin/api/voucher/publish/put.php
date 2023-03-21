<?php
/*
 +=============================================================================
 | 
 | 바우처 정보 수정 
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.12.28
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
include_once("/var/www/admin/api/common/common.php");
$session_id		= sessionCheck();

$voucher_idx	        = $_POST['voucher_idx'];
$issue_start_date	    = $_POST['issue_start_date'];
$issue_end_date	        = $_POST['issue_end_date'];
$voucher_date_type	    = $_POST['voucher_date_type'];
$voucher_date_param	    = $_POST['voucher_date_param'];
$voucher_start_date	    = $_POST['voucher_start_date'];
$voucher_end_date	    = $_POST['voucher_end_date'];
$sale_type	            = $_POST['sale_type'];
$sale_price	            = $_POST['sale_price'];
$min_price	            = $_POST['min_price'];
$description	        = $_POST['description'];
$member_level_flg	    = $_POST['member_level_flg'];
$member_level	        = $_POST['member_level'];


if ($voucher_idx != null) {

	$db->begin_transaction();
	try {
		$set = "";
		
		if ($issue_start_date != null) {
			$set .= " ISSUE_START_DATE = STR_TO_DATE('".$issue_start_date."','%Y-%m-%d %H:%i'), ";
		}
		
		if ($issue_end_date != null) {
			$set .= " ISSUE_END_DATE = STR_TO_DATE('".$issue_end_date."','%Y-%m-%d %H:%i'), ";
		}
		
		if ($voucher_date_type != null) {
			$set .= " VOUCHER_DATE_TYPE = '".$voucher_date_type."', ";
		}
		
		if ($voucher_date_param != null) {
			$set .= " VOUCHER_DATE_PARAM = ".$voucher_date_param.", ";
		}

		if ($voucher_start_date != null) {
			$set .= " VOUCHER_START_DATE = STR_TO_DATE('".$voucher_start_date."','%Y-%m-%d %H:%i'), ";
		}
		
		if ($voucher_end_date != null) {
			$set .= " VOUCHER_END_DATE = STR_TO_DATE('".$voucher_end_date."','%Y-%m-%d %H:%i'), ";
		}
		
		if ($sale_type != null) {
			$set .= " SALE_TYPE = '".$sale_type."', ";
		}
		
		if ($sale_price != null) {
			$set .= " SALE_PRICE = ".$sale_price.", ";
		}

		if ($min_price != null) {
			$set .= " MIN_PRICE = ".$min_price.", ";
		}
		
		if ($description != null) {
			$set .= " DESCRIPTION = '".$description."', ";
		}
		
		if ($member_level_flg != null) {
			if($member_level_flg == 'ALL'){
				$set .= " MEMBER_LEVEL = '".$member_level_flg."', ";

			}
			else if($member_level_flg == 'DML'){
				$set .= " MEMBER_LEVEL = '".implode(",",$member_level)."', ";
			}
		}

		$except_product_flg = NULL;
		$except_product_flg = $_POST['except_product_flg'];
		if($except_product_flg != NULL){
			$set .= " EXCEPT_PRODUCT_FLG = ".$except_product_flg.", ";
		}

		$sql = "UPDATE
					VOUCHER_MST
				SET
					".$set."
					UPDATER = 'Admin',
					UPDATE_DATE = NOW()
				WHERE
					IDX = ".$voucher_idx;
		
		$db->query($sql);

		$product_idx_list = NULL;
		$product_idx_list = $_POST['product_idx_list'];
		if($product_idx_list != NULL){
			$init_voucher_product_sql = "
				DELETE FROM VOUCHER_PRODUCT
				WHERE	
					VOUCHER_IDX = ".$voucher_idx."	
			";
			$db->query($init_voucher_product_sql);

			$insert_voucher_product_sql = "
				INSERT INTO VOUCHER_PRODUCT
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
					IDX IN (".implode(',',$product_idx_list).")
			";
			$db->query($insert_voucher_product_sql);
		}
		$db->commit();
	}
	catch(mysqli_sql_exception $exception){
		echo $exception->getMessage();
		$json_result['code'] = 301;
		$db->rollback();
		$msg = "바우처 편집 처리에 실패했습니다.";
	}	
	
}
?>