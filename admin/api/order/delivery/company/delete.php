<?php
/*
 +=============================================================================
 | 
 | 배송업체 삭제
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.03.12
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

include_once("/var/www/admin/api/common/common.php");

$session_id		= sessionCheck();
$sel_idx = $_POST['sel_idx'];

$db->begin_transaction();
try {
	$where = "1=1";
	$sel_list_str = implode(',',$sel_idx);
	if ($sel_idx != null) {
		$where .= " AND IDX IN (".$sel_list_str.")";
	}

	//수정항목
	$db->query("
		UPDATE 
			DELIVERY_COMPANY 
		SET 
			DEL_FLG = TRUE,
			UPDATE_DATE = NOW(),
            UPDATER = '".$session_id."'
		WHERE 
			".$where."
	");

	$db->commit();
}
catch(mysqli_sql_exception $exception){
	echo $exception->getMessage();
	$json_result['code'] = 301;
	$db->rollback();
	$msg = "배송업체 삭제 처리에 실패했습니다.";
}

?>