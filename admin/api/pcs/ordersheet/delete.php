<?php
/*
 +=============================================================================
 | 
 | 오더시트 삭제
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.10.12
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

include_once("/var/www/admin/api/common/common.php");

$session_id					= sessionCheck();
$ordersheet_idx_list		= $_POST['ordersheet_idx_list'];

$db->begin_transaction();
try {
	$delete_ordersheet_sql = "
		UPDATE
			ORDERSHEET_MST
		SET
			DEL_FLG = TRUE,
			UPDATE_DATE = NOW(),
			UPDATER = '".$session_id."'
		WHERE 
			IDX IN (".implode(",", $ordersheet_idx_list).") AND
			(
				SELECT 
					COUNT(0) 
				FROM 
					SHOP_PRODUCT 
				WHERE 
					DEL_FLG = FALSE 
				AND 
					ORDERSHEET_IDX IN (".implode(",", $ordersheet_idx_list).")
			) = 0 AND
			UPDATE_FLG = FALSE
	";

	$update_row_cnt = 0;

	$db->query($delete_ordersheet_sql);

	$update_row_cnt = $db->mysqli_affected_rows();

	if($update_row_cnt == count($ordersheet_idx_list)){
		$insert_history_sql = "
			INSERT INTO
				ORDERSHEET_HISTORY
			(	
				ORDERSHEET_IDX,
				ORDERSHEET_AUTH,
				ACTION_TYPE,
				PRODUCT_CODE,
				PRODUCT_NAME,
				HISTORY_MSG,
				CREATE_DATE,
				CREATER
			)
			SELECT
				OM.IDX				AS ORDERSHEET_IDX,
				'MD'				AS ORDERSHEET_AUTH,
				'D'					AS ACTION_TYPE,
				OM.PRODUCT_CODE		AS PRODUCT_CODE,
				OM.PRODUCT_NAME		AS PRODUCT_NAME,
				CONCAT(
					'[',OM.PRODUCT_CODE,'] ',
					IFNULL(
						OM.PRODUCT_NAME,''
					),
					'의 오더시트가 삭제되었습니다.'
				)					AS HISTORY_MSG,
				NOW()				AS CREATE_DATE,
				'".$session_id."'	AS CREATER
			FROM
				ORDERSHEET_MST OM
			WHERE
				IDX IN (".implode(',', $ordersheet_idx_list).")
		";
		
		$db->query($insert_history_sql);
		
		$db->commit();
	} else{
		$json_result['code'] = 300;
		$json_result['msg'] = '독립몰 상품 & 작성완료 오더시트는 삭제할 수 없습니다.';
	}
} 
catch(mysqli_sql_exception $exception){
	$json_result['code'] = 300;
	$json_result['exception_msg'] = $exception;
	$db->rollback();
}

?>