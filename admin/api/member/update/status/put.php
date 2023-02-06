<?php
/*
 +=============================================================================
 | 
 | 회원상태 갱신
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
$list_country = $_POST['list_country'];
$action_type = $_POST['action_type'];
$select_idx = $_POST['select_idx'];

$member_table = '';
if($list_country != null){
	switch($list_country){
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

		$set= '';
		if ($action_type != null) {
			switch ($action_type) {
				case "member_trust" :
					$set .= " SUSPICION_FLG = FALSE ";
					break;
				
				case "member_suspicion" :
					$set .= " SUSPICION_FLG = TRUE ";
					break;
				
				case "member_default" :
					$set .= " MEMBER_STATUS = 'NML' ";
					break;
				
				case "member_faulty" :
					$set .= " MEMBER_STATUS = 'BMB' ";
					break;
				
				case "member_drop" :
					$set .= " DROP_DATE = NOW(), ";
					$set .= " MEMBER_STATUS = 'DRP', ";
					$set .= " DROP_TYPE = 'FDP' ";
					break;
			}
		}
		//수정항목
		$sql = "UPDATE
					".$tables."
				SET
					".$set."
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