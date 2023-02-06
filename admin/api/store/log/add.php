<?php
/*
 +=============================================================================
 | 
 | 로그 등록
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.07.18
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$log_type           = $_POST['log_type'];
$log_contents       = $_POST['log_contents'];
$target_cnt         = $_POST['target_cnt'];

$admin_id = null;
if (isset($_SESSION['ADMIN_ID'])) {
	$admin_id = $_SESSION['ADMIN_ID'];
}

$admin_ip = null;
if (isset($_SESSION['ADMIN_IP'])) {
	$admin_ip = $_SESSION['ADMIN_IP'];
}

$admin_permition = null;
if (isset($_SESSION['ADMIN_PERMITION'])) {
	$admin_permition = $_SESSION['ADMIN_PERMITION'];
}

if ($admin_id != null && $admin_permition != null) {
	$insert_log_sql = "
		INSERT INTO
			dev.ADMIN_LOG
		(
			LOG_TYPE,
			LOG_CONTENTS,
			CREATER,
			CREATER_LEVEL,
			CREATER_IP
		) VALUES (
			'".$log_type."',
			'".$log_contents." : (".$target_cnt.")건',
			'".$admin_id."',
			'".$admin_permition."',
			'".$admin_ip."'
		)
	";
	
	$db->query($insert_log_sql);
}
?>