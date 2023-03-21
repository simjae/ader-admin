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
			$member_table = 'MEMBER_KR';
			break;
		case 'EN':
			$member_table = 'MEMBER_EN';
			break;
		case 'CN':
			$member_table = 'MEMBER_CN';
			break;
	}
}

if(strlen($member_table) > 0){
	$db->begin_transaction();
	try {
		$tables = $member_table;
	
		$ip_ban_flg = "";
		$ip_ban_sql = "";

		if ($action_type == "BAN") {
			$ip_ban_flg = "TRUE";
			$update_ip_ban_sql = "INSERT INTO IP_BAN (IP) SELECT IP FROM ".$tables." WHERE IDX IN (".$member_idx.");";
		} else if ($action_type = "UBN") {
			$ip_ban_flg = "FALSE";
			$update_ip_ban_sql = "DELETE FROM IP_BAN WHERE IP = (SELECT IP FROM ".$tables." WHERE IDX = ".$member_idx.")";
		}
		
		//수정항목
		$update_ip_ban_flg_sql = "
			UPDATE
				".$tables."
			SET
				IP_BAN_FLG = ".$ip_ban_flg."
			WHERE
				IDX = ".$member_idx."
		";
		
		$db->query($update_ip_ban_flg_sql);
		$db->query($update_ip_ban_sql);
		
		$db->commit();
	} catch(mysqli_sql_exception $exception){
		$db->rollback();
		print_r($exception);
		
		$json_result['code'] = 301;
		$json_result['msg'] = "IP차단 처리에 실패했습니다.";
	}
} else {
	$json_result['code'] = 300;
	$json_result['msg'] = 'IP차단에 처리에 실패했습니다.';
}
?>