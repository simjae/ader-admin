<?php
/*
 +=============================================================================
 | 
 | 콜라보레이션 관리 페이지 - 콜라보레이션 정보 수정
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.12.05
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

include_once("/var/www/admin/api/common/common.php");

$admin_idx = 0;
if (isset($_SESSION['ADMIN_IDX'])) {
	$admin_idx = $_SESSION['ADMIN_IDX'];
}

$session_id				= sessionCheck();
$collaboration_idx		= $_POST['collaboration_idx'];
$bookmark_flg			= $_POST['bookmark_flg'];
$posting_status			= $_POST['posting_status'];
$product_list_flg		= $_POST['product_list_flg'];
$product_link_flg		= $_POST['product_link_flg'];

$phs_column_name		= $_POST['phs_column_name'];
$lgc_column_name		= $_POST['lgc_column_name'];
$column_value			= $_POST['column_value'];

$collabo_product_idx	= $_POST['collabo_product_idx'];

if ($display_num_flg != null && $action_type != null && $recent_idx != null && $recent_num != null) {
	$prev_sql = "";
	$sql = "";
	
	switch ($action_type) {
		case "up" :
			$prev_sql = "
				UPDATE
					dev.POSTING_COLLABORATION
				SET
					DISPLAY_NUM = ".$recent_num."
				WHERE
					DISPLAY_NUM = ".intval($recent_num - 1)."
			";
			
			$sql = "
				UPDATE
					dev.POSTING_COLLABORATION
				SET
					DISPLAY_NUM = ".intval($recent_num - 1)."
				WHERE
					IDX = ".$recent_idx."
			";
			
			break;
		
		case "down" :
			$prev_sql = "
				UPDATE
					dev.POSTING_COLLABORATION
				SET
					DISPLAY_NUM = ".$recent_num."
				WHERE
					DISPLAY_NUM = ".intval($recent_num + 1)."
			";
			
			$sql = "
				UPDATE
					dev.POSTING_COLLABORATION
				SET
					DISPLAY_NUM = ".intval($recent_num + 1)."
				WHERE
					IDX = ".$recent_idx."
			";
			
			break;
	}
	
	if (strlen($prev_sql) > 0) {
		$db->query($prev_sql);
	}
	
	if (strlen($sql) > 0) {
		$db->query($sql);
	}
}

if ($collaboration_idx != null && $collaboration_idx > 0) {
	$db->begin_transaction();

	try {
		$update_collaboration_sql = "
			UPDATE
				dev.POSTING_COLLABORATION
			SET
				POSTING_STATUS = ".$posting_status.",
				PRODUCT_LIST_FLG = ".$product_list_flg.",
				PRODUCT_LINK_FLG = ".$product_link_flg.",
				UPDATE_DATE = NOW(),
				UPDATER = '".$session_id."'
			WHERE
				IDX = ".$collaboration_idx."
		";
		
		$db->query($update_collaboration_sql);
		
		if ($bookmark_flg == "false") {
			$db->query("DELETE FROM dev.COLLABORATION_BOOKMARK WHERE ADMIN_IDX = ".$admin_idx." AND COLLABORATION_IDX = ".$collaboration_idx);
		} else if ($bookmark_flg == "true") {
			$db->query("INSERT INTO dev.COLLABORATION_BOOKMARK (ADMIN_IDX,COLLABORATION_IDX) VALUES (".$admin_idx.",".$collaboration_idx.")");
		}
		
		$db->query("DELETE FROM dev.COLLABORATION_COLUMN WHERE COLLABORATION_IDX = ".$collaboration_idx);
		
		for ($i=0; $i<count($phs_column_name); $i++) {
			$insert_column_sql = "
				INSERT INTO
					dev.COLLABORATION_COLUMN
				(
					COLLABORATION_IDX,
					PHS_COLUMN_NAME,
					LGC_COLUMN_NAME,
					COLUMN_VALUE
				) VALUES (
					".$collaboration_idx.",
					'".$phs_column_name[$i]."',
					'".$lgc_column_name[$i]."',
					'".$column_value[$i]."'
				)
			";
			
			$db->query($insert_column_sql);
		}
		
		for ($j=0; $j<count($collabo_product_idx); $j++) {
			$display_flg_name = "display_flg_".$collabo_product_idx[$j];
			
			$update_product_sql = "
				UPDATE
					dev.COLLABORATION_PRODUCT
				SET
					DISPLAY_FLG = ".$_POST[$display_flg_name]."
				WHERE
					IDX = ".$collabo_product_idx[$j]."
			";
			
			$db->query($update_product_sql);
		}
		
		$db->commit();
		
		$json_result['code'] = 200;
	} catch(mysqli_sql_exception $exception){
		$db->rollback();
		
		$json_result['code'] = 301;
		$json_result['msg'] = "메인 배너 등록에 실패했습니다.";
	}
}

?>