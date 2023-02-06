<?php
/*
 +=============================================================================
 | 
 | 룩북 관리 화면 - 프로젝트 삭제
 | -----------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2023.01.26
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

include_once("/var/www/admin/api/common/common.php");

$session_id			= sessionCheck();
$country			= $_POST['country'];
$collection_idx		= $_POST['collection_idx'];

if ($collection_idx != null) {
	$db->begin_transaction();

	try {
		$delete_collection_sql = "
			UPDATE
				dev.POSTING_COLLECTION
			SET
				DEL_FLG = TRUE,
				UPDATE_DATE = NOW(),
				UPDATER = '".$session_id."'
			WHERE
				IDX = ".$collection_idx."
		";
		
		$db->query($delete_collection_sql);
		
		$db_result = $db->affectedRows();
		
		if ($db_result > 0) {
			$select_collection_sql = "
				SELECT
					PC.IDX			AS COLLECTION_IDX
				FROM
					dev.POSTING_COLLECTION PC
				WHERE
					IDX != ".$collection_idx." AND
					COUNTRY = '".$country."' AND
					DEL_FLG = FALSE
				ORDER BY
					DISPLAY_NUM ASC
			";
			
			$db->query($select_collection_sql);
			
			$display_num = 1;
			foreach($db->fetch() as $collection_data) {
				$tmp_idx = $collection_data['COLLECTION_IDX'];
				
				if (!empty($tmp_idx)) {
					$update_collection_sql = "
						UPDATE
							dev.POSTING_COLLECTION
						SET
							DISPLAY_NUM = ".$display_num."
						WHERE
							IDX = ".$tmp_idx." AND
							COUNTRY = '".$country."'
					";
					
					$db->query($update_collection_sql);
					
					$display_num++;
				}
			}
		}
		
		$db->commit();
		$json_result['code'] = 200;
		$json_result['msg'] = "선택한 프로젝트가 삭제되었습니다.";
	} catch(mysqli_sql_exception $exception){
		$db->rollback();
		
		$json_result['code'] = 301;
		$json_result['msg'] = "메인 배너 등록에 실패했습니다.";
	}
}

?>