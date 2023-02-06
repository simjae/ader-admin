<?php
/*
 +=============================================================================
 | 
 | 회원등급 삭제처리 API
 | ----------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.07.06
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		:
 | 
 +=============================================================================
*/

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
/** 변수 정리 **/
$sel_level_idx = $_POST['sel_level_idx'];

$db->begin_transaction();
try {
	$tables = "dev.MEMBER_LEVEL";

	$where = "";
	$sel_level_list_str = implode(',',$sel_level_idx);
	if ($sel_level_idx != null) {
		$where .= " AND IDX IN (".$sel_level_list_str.")";
	}

	//수정항목
	$db->query("
		UPDATE 
			dev.MEMBER_KR 
		SET 
			LEVEL_IDX = 1 
		WHERE 
			LEVEL_IDX IN (".$sel_level_list_str.")
	");
	$db->query("
		UPDATE 
			dev.MEMBER_EN 
		SET 
			LEVEL_IDX = 1 
		WHERE 
			LEVEL_IDX IN (".$sel_level_list_str.")
	");
	$db->query("
		UPDATE 
			dev.MEMBER_CN 
		SET 
			LEVEL_IDX = 1 
		WHERE 
			LEVEL_IDX IN (".$sel_level_list_str.")
	");

	$sql = "DELETE FROM
				".$tables."
			WHERE
				".$where;

	$db->query($sql);
	$db->commit();
}
catch(mysqli_sql_exception $exception){
	echo $exception->getMessage();
	$json_result['code'] = 301;
	$db->rollback();
	$msg = "회원등급 초기화 처리에 실패했습니다.";
}

?>