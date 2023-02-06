<?php
/*
 +=============================================================================
 | 
 | 운영자 관리 화면 - 운영자 삭제
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.07.19
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$admin_idx = 0;
if (isset($_POST['admin_idx'])) {
	$admin_idx = $_POST['admin_idx'];
}

if ($admin_idx > 0) {
	$update_admin_sql = "
		UPDATE
			dev.ADMIN
		SET
			DEL_FLG = TRUE
		WHERE
			IDX = ".$admin_idx."
	";
	
	$db->query($update_admin_sql);
} else {
	$json_result['result'] = false;
	$json_result['code'] = 300;
	$json_result['msg'] = "삭제하려는 관리자를 선택해주세요.";
}
?>