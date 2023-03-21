<?php
/*
 +=============================================================================
 | 
 | 게시물 관리 페이지 - 게시물 페이지 삭제
 | -----------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.07.31
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

include_once("/var/www/admin/api/common/common.php");

$session_id			= sessionCheck();
$posting_type		= $_POST['posting_type'];
$page_idx			= $_POST['page_idx'];

if ($page_idx != null) {
	$delete_page_sql = "
		UPDATE
			PAGE_POSTING
		SET
			DEL_FLG = TRUE,
			UPDATE_DATE = NOW(),
			UPDATER = '".$session_id."'
		WHERE
			IDX IN (".implode(",",$page_idx).")
	";
	
	$db->query($delete_page_sql);
	
	$db_result = $db->affectedRows();
	
	if ($db_result > 0 && $posting_type == "COLA") {
		$update_collaboration_sql = "
			UPDATE
				POSTING_COLLABORATION
			SET
				DEL_FLG = TRUE,
				UPDATE_DATE = NOW(),
				UPDATER = '".$session_id."'
			WHERE
				PAGE_IDX IN (".implode(",",$page_idx).")
		";
	}
}

?>