<?php
/*
 +=============================================================================
 | 
 | 회원 탈퇴 API
 | -----------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2015.9.7
 | 최종 수정일	: 2022.07.06
 | 버전		: 1.1
 | 설명		: 
 | 
 +=============================================================================
*/
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
/** 변수 정리 **/
$drop_country = $_POST['drop_country'];
$select_idx = $_POST['select_idx'];

$member_table = '';
if($drop_country != null){
	switch($drop_country){
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
					DROP_DATE = NOW(),
					MEMBER_STATUS = 'DRP',
					DROP_TYPE = 'NDP'
				WHERE
					".$where;

		$db->query($sql);
		$db->commit();
	}
	catch(mysqli_sql_exception $exception){
		echo $exception->getMessage();
		$json_result['code'] = 301;
		$db->rollback();
		$msg = "회원탈퇴 처리에 실패했습니다.";
	}
}
else{
	$json_result['code'] = 301;
	$msg = "회원탈퇴 처리에 실패했습니다.";
}
?>