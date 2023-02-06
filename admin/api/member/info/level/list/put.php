<?php
/*
 +=============================================================================
 | 
 | 회원등급 리스트 갱신 API
 | ----------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.07.05
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
/** 변수 정리 **/
$level_country = $_POST['level_country'];
$select_idx = $_POST['select_idx'];

$member_table = '';
if($level_country != null){
	switch($level_country){
		case 'KR':
			$member_table = 'dev.MEMBER_KR';
			break;
		case 'EN':
			$member_table = 'dev.MEMBER_EN';
			break;
		case 'CN':
			$member_table = 'dev.MEMBER_CN';
			break;
	}
}

if(strlen($member_table) > 0){

	$db->begin_transaction();
	try {
		$tables = $member_table;
	
		$where = "";
		$idx_list = "";
		if ($select_idx != null) {
			$idx_list = implode(',',$select_idx);
			$where .= " IDX IN (".$idx_list.")";
		}

		//수정항목
		$sql = "UPDATE
			".$tables."
		SET
			LEVEL_IDX = 1
		WHERE
			".$where;

		$db->query($sql);
		$db->commit();
	}
	catch(mysqli_sql_exception $exception){
		echo $exception->getMessage();
		$json_result['code'] = 301;
		$db->rollback();
		$msg = "회원등급해제 처리에 실패했습니다.";
	}
}
else{
	$json_result['code'] = 301;
	$msg = "회원등급해제 처리에 실패했습니다.";
}

?>