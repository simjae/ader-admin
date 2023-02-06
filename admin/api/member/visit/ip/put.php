<?php
/*
 +=============================================================================
 | 
 | IP 차단 설정 API
 | -----------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.07.07
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

/** 변수 정리 **/
$country = $_POST['country'];
$action_type = $_POST['action_type'];
$member_idx = $_POST['member_idx'];

$member_table = '';
if($country != null){
	switch($country){
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
		$ip_ban_flg = "";
		$ip_ban_sql = "";

		if ($action_type == "ip_ban") {
			$ip_ban_flg = "TRUE";
			$ip_ban_sql = "INSERT INTO dev.IP_BAN (IP) SELECT IP FROM ".$tables." WHERE IDX IN (".$member_idx.");";
		} else {
			$ip_ban_flg = "FALSE";
			$ip_ban_sql = "DELETE FROM dev.IP_BAN WHERE IP = (SELECT IP FROM ".$tables." WHERE IDX = ".$member_idx.")";
		}
		$where .= " AND IP = (SELECT * FROM (SELECT IP FROM ".$tables." WHERE IDX = ".$member_idx.") AS TEMP) ";
		//수정항목
		$sql = "UPDATE
					".$tables."
				SET
					IP_BAN_FLG = ".$ip_ban_flg."
				WHERE
					".$where;
		$db->query($sql);
		$db->query($ip_ban_sql);
		$db->commit();
	}
	catch(mysqli_sql_exception $exception){
		echo $exception->getMessage();
		$json_result['code'] = 301;
		$db->rollback();
		$msg = "IP차단 처리에 실패했습니다.";
	}
}
else{
	$json_result['code'] = 300;
	$json_result['msg'] = 'IP차단에 실패했습니다.';
}
?>