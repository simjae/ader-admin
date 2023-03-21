<?php
/*
 +=============================================================================
 | 
 | 오더시트 상태변경
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

$session_id				= sessionCheck();
$ordersheet_idx_list	= $_POST['ordersheet_idx_list'];
$action_type 			= $_POST['action_type'];

$db->begin_transaction();

try {
	$err_cnt = 0;
	
	for ($i=0; $i<count($ordersheet_idx_list); $i++){
		$ordersheet_idx = $ordersheet_idx_list[$i];
		$option_cnt = $db->count("ORDERSHEET_OPTION","ORDERSHEET_IDX = ".$ordersheet_idx);
		
		if ($option_cnt == 0) {
			$err_cnt++;
		}
	}
	
	if ($err_cnt > 0) {
		$json_result['code'] = 402;
		$json_result['msg'] = "옵션이 등록되지 않은 오더시트는 진행완료 상태로 변경할 수 없습니다.";
		return $json_result;
	}
	
	$update_flg = null;
	if($action_type == 'update_flg_true'){
		$update_flg = 'TRUE';
	}
	else if($action_type == 'update_flg_false'){
		$update_flg = 'FALSE';
	}

	$update_ordersheet_sql = "
		UPDATE
			ORDERSHEET_MST
		SET
			UPDATE_FLG = ".$update_flg.",
			UPDATE_DATE = NOW(),
			UPDATER = '".$session_id."'
		WHERE 
			IDX IN (".implode(",", $ordersheet_idx_list).")";

	$update_row_cnt = 0;

	$db->query($update_ordersheet_sql);

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
				'U'					AS ACTION_TYPE,
				OM.PRODUCT_CODE		AS PRODUCT_CODE,
				OM.PRODUCT_NAME		AS PRODUCT_NAME,
				CASE 
					WHEN
						UPDATE_FLG = TRUE 
						THEN
							CONCAT(
								'[',OM.PRODUCT_CODE,'] ',
								IFNULL(
									OM.PRODUCT_NAME,''
								),
								'의 오더시트 상태가 [작성 완료]로 변경되었습니다.'
							)
					WHEN
						UPDATE_FLG = FALSE
						THEN
							CONCAT(
								'[',OM.PRODUCT_CODE,'] ',
								IFNULL(
									OM.PRODUCT_NAME,''
								),
								'의 오더시트 상태가 [작성 중]으로 변경되었습니다.'
							) 
				END					AS HISTORY_MSG,
				NOW(),
				'".$session_id."'
			FROM
				ORDERSHEET_MST OM
			WHERE
				IDX IN (".implode(',', $ordersheet_idx_list).")
		";
		
		$db->query($insert_history_sql);
	}
	
	$db->commit();
} catch(mysqli_sql_exception $exception){
	$json_result['code'] = 300;
	$json_result['exception_msg'] = $exception;
	$db->rollback();
}

?>