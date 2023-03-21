<?php
/*
 +=============================================================================
 | 
 | 메모 등록
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.08.07
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

include_once("/var/www/admin/api/common/common.php");

$session_id			= sessionCheck();
$memo_type			= $_POST['memo_type'];
$type_country = "NULL";
if (isset($_POST['type_country'])) {
	$type_country = "'".$_POST['type_country']."'";
}
$type_idx			= $_POST['type_idx'];
$admin_idx			= $_SESSION['ADMIN_IDX'];
$memo				= $_POST['memo'];

if ($memo_type != null && $memo != null) {
	$insert_memo_log_sql = "
		INSERT INTO
			MEMO_LOG
		(
			MEMO_TYPE
			TYPE_COUNTRY
			TYPE_IDX
			ADMIN_IDX
			MEMO
			CREATER
		) VALUES (
			'".$memo_type."',
			".$type_country.",
			".$type_idx.",
			".$admin_idx.",
			'".$memo."',
			'".$session_id."'
		)
	";
	
	$db->query($insert_memo_log_sql);
}

?>