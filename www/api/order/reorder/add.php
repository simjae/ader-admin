<?php
/*
 +=============================================================================
 | 
 | 쇼핑백 화면 - 리오더 상품 추가
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

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$country = null;
if (isset($_SESSION['COUNTRY'])) {
	$country = $_SESSION['COUNTRY'];
}

$member_idx = 0;
if (isset($_SESSION['MEMBER_IDX'])) {
	$member_idx = $_SESSION['MEMBER_IDX'];
}

$member_id = null;
if (isset($_SESSION['MEMBER_IDX'])) {
	$member_id = $_SESSION['MEMBER_ID'];
}

$add_type = $_POST['add_type'];

$basket_idx = 0;
if (isset($_POST['basket_idx'])) {
	$basket_idx = $_POST['basket_idx'];
}

$product_idx = 0;
if (isset($_POST['product_idx'])) {
	$product_idx = $_POST['product_idx'];
}

$option_idx = 0;
if (isset($_POST['option_idx'])) {
	$option_idx = $_POST['option_idx'];
}

if ($member_idx == 0 || $country == null) {
	$json_result['code'] = 401;
	$json_result['msg'] = "로그인 후 다시 시도해 주세요.";
	return $json_result;
}

if ($add_type == "basket") {
	if ($basket_idx != null && $product_idx != null && $option_idx != null) {
		$db->begin_transaction();
		
		try {
			$insert_reorder_sql = "
				INSERT INTO
					dev.PRODUCT_REORDER
				(
					COUNTRY,
					MEMBER_IDX,
					MEMBER_ID,
					PRODUCT_IDX,
					PRODUCT_CODE,
					PRODUCT_NAME,
					OPTION_IDX,
					BARCODE,
					OPTION_NAME,
					CREATER,
					UPDATER
				)
				SELECT
					'".$country."'		AS COUNTRY,
					".$member_idx."		AS MEMBER_IDX,
					'".$member_id."'	AS MEMBER_ID,
					PR.IDX				AS PRODUCT_IDX,
					PR.PRODUCT_CODE		AS PRODUCT_CODE,
					PR.PRODUCT_NAME		AS PRODUCT_NAME,
					OO.IDX				AS OPTION_IDX,
					OO.BARCODE			AS BARCODE,
					OO.OPTION_NAME		AS OPTION_NAME,
					'".$member_id."'	AS CREATER,
					'".$member_id."'	AS UPDATER
				FROM
					dev.SHOP_PRODUCT PR
					LEFT JOIN dev.ORDERSHEET_OPTION OO ON
					PR.ORDERSHEET_IDX = OO.ORDERSHEET_IDX
				WHERE
					PR.IDX = ".$product_idx." AND
					OO.IDX = ".$option_idx."
			";
			
			$db->query($insert_reorder_sql);
			
			$reorder_idx = $db->last_id();
			
			if (!empty($reorder_idx)) {
				$update_basket_sql = "
					UPDATE
						dev.BASKET_INFO
					SET
						REORDER_FLG = TRUE,
						UPDATE_DATE = NOW(),
						UPDATER = '".$member_id."'
					WHERE
						IDX = ".$basket_idx." AND
						MEMBER_IDX = ".$member_idx."
				";
				
				$db->query($update_basket_sql);
				
				$db->commit();
				
				$json_result['code'] = 200;
				return $json_result;
			}
		} catch(mysqli_sql_exception $exception){
			$db->rollback();
			
			$json_result['code'] = 301;
			$json_result['msg'] = '리오더 상품등록에 실패했습니다.';
			$json_result['exception_msg'] = $exception;
			return $json_result;
		}
	}
}
?>