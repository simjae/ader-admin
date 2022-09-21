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

/** 변수 정리 **/
$action_type = $_POST['action_type'];
$member_idx = $_POST['member_idx'];
$ip_ban_flg = "";

$ip_ban_sql = "";
if ($action_type != null) {
	if ($action_type == "ip_ban") {
		$ip_ban_flg = "TRUE";
		$ip_ban_sql = "INSERT INTO dev.IP_BAN (IP) SELECT IP FROM dev.MEMBER WHERE IDX IN (".$member_idx.");";
	} else {
		$ip_ban_flg = "FALSE";
		$ip_ban_sql = "DELETE FROM dev.IP_BAN WHERE IP = (SELECT IP FROM dev.MEMBER WHERE IDX = ".$member_idx.")";
	}
}

$where = " 1=1 ";
if ($member_idx != null) {
	$where .= " AND IP = (SELECT * FROM (SELECT IP FROM dev.MEMBER WHERE IDX = ".$member_idx.") AS TEMP) ";
}

$tables = $_TABLE['MEMBER'];

/** DB 처리 **/

$json_result = array(
	'total' => $db->count($tables,$where),
	'page' => intval($page)
);

	//수정항목
$sql = "UPDATE
			".$tables."
		SET
			IP_BAN_FLG = ".$ip_ban_flg."
		WHERE
			".$where;
$db->query($sql);
$db->query($ip_ban_sql);
?>