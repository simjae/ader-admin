<?php
/*
 +=============================================================================
 | 
 | 발급 바우처 삭제처리 API
 | ----------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.12.26
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		:
 | 
 +=============================================================================
*/

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
/** 변수 정리 **/
$sel_idx = $_POST['sel_idx'];

$db->begin_transaction();
try {
	$where = "1=1";
	$sel_list_str = implode(',',$sel_idx);
	if ($sel_idx != null) {
		$where .= " AND IDX IN (".$sel_list_str.")";
	}

    $where .= " AND USED_FLG = FALSE";

	//수정항목
	$db->query("
		UPDATE 
			dev.VOUCHER_ISSUE 
		SET 
			DEL_FLG = TRUE,
			UPDATE_DATE = NOW()
		WHERE 
			".$where."
	");

	$db->commit();
}
catch(mysqli_sql_exception $exception){
	echo $exception->getMessage();
	$json_result['code'] = 301;
	$db->rollback();
	$msg = "발급 바우처 삭제 처리에 실패했습니다.";
}

?>