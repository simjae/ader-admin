<?php
/*
 +=============================================================================
 | 
 | 에디토리얼 관리 화면 - 에디토리얼 썸네일 삭제
 | -----------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.08.03
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

include_once("/var/www/admin/api/common/common.php");

$session_id				= sessionCheck();
$display_num			= $_POST['display_num'];
$page_idx				= $_POST['page_idx'];
$thumb_idx				= $_POST['thumb_idx'];
$contents_idx			= $_POST['contents_idx'];

if ($page_idx != null && $thumb_idx != null) {
	
	$db->begin_transaction();
	
	try {
		$delete_contents_sql = "
			UPDATE
				dev.EDITORIAL_CONTENTS
			SET
				DEL_FLG = TRUE,
				UPDATE_DATE = NOW(),
				UPDATER = '".$session_id."'
			WHERE
				THUMB_IDX IN (
								SELECT
									IDX
								FROM
									dev.EDITORIAL_THUMB
								WHERE
									PAGE_IDX = ".$page_idx."
								AND
									DEL_FLG = FALSE
								AND
									DISPLAY_NUM = ".$display_num."
							)
		";
		$db->query($delete_contents_sql);
		$db_result = $db->affectedRows();

		if($db_result > 0){
			$delete_thumb_sql = "
				UPDATE
					dev.EDITORIAL_THUMB
				SET
					DEL_FLG = TRUE,
					UPDATE_DATE = NOW(),
					UPDATER = '".$session_id."'
				WHERE
					PAGE_IDX = ".$page_idx." AND
					DISPLAY_NUM = ".$display_num."
			";
			$db->query($delete_thumb_sql);

			$update_other_thumb_sql = "
				UPDATE 
					dev.EDITORIAL_THUMB
				SET	
					DISPLAY_NUM = DISPLAY_NUM - 1
				WHERE
					PAGE_IDX = ".$page_idx."
				AND
					DEL_FLG = FALSE
				AND
					DISPLAY_NUM > ".$display_num."
			";
			$db->query($update_other_thumb_sql);

			$max_display_sql = "
				SELECT
					MAX(DISPLAY_NUM) AS MAX
				FROM
					dev.EDITORIAL_THUMB
				WHERE
					PAGE_IDX = ".$page_idx."
				AND
					DEL_FLG = FALSE
			";
			$db->query($max_display_sql);
			foreach($db->fetch() as $max_data){
				$json_result['data']['max_display_num'] = $max_data['MAX'];
			}

			$db->commit();
			
			$json_result['code'] = 200;
			$json_result['msg'] = "선택한 에디토리얼 썸네일이 삭제되었습니다.";
		}
	} catch(mysqli_sql_exception $exception){
		$db->rollback();
		
		$json_result['code'] = 301;
		$json_result['msg'] = "에디토리얼 썸네일 삭제처리에 실패했습니다.";
	}
}

/*
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

include_once("/var/www/admin/api/common/common.php");

$session_id				= sessionCheck();
$display_num			= $_POST['display_num'];
$page_idx				= $_POST['page_idx'];
$thumb_idx				= $_POST['thumb_idx'];
$contents_idx			= $_POST['contents_idx'];

if ($page_idx != null && $thumb_idx != null) {
	
	$db->begin_transaction();
	
	try {
		$delete_thumb_sql = "
			UPDATE
				dev.EDITORIAL_THUMB
			SET
				DEL_FLG = TRUE,
				UPDATE_DATE = NOW(),
				UPDATER = '".$session_id."'
			WHERE
				IDX = ".$thumb_idx." AND
				PAGE_IDX = ".$page_idx."
		";
		
		$db->query($delete_thumb_sql);
		
		$db_result = $db->affectedRows();
		
		if ($db_result > 0) {
			$update_other_thumb_sql = "
				UPDATE 
					dev.EDITORIAL_THUMB
				SET	
					DISPLAY_NUM = DISPLAY_NUM - 1
				WHERE
					PAGE_IDX = ".$page_idx."
				AND
					DEL_FLG = FALSE
				AND
					DISPLAY_NUM > ".$display_num."
			";
			$db->query($update_other_thumb_sql);
			
			$select_thumb_sql = "
				SELECT
					IDX			AS THUMB_IDX
				FROM
					dev.EDITORIAL_THUMB
				WHERE
					IDX != ".$thumb_idx." AND
					PAGE_IDX = ".$page_idx." AND
					DEL_FLG = FALSE
				ORDER BY
					DISPLAY_NUM ASC
			";
			
			$db->query($select_thumb_sql);
			
			$display_num = 1;
			foreach($db->fetch() as $thumb_data) {
				$tmp_idx = $thumb_data['THUMB_IDX'];
				
				if (!empty($tmp_idx)) {
					$update_thumb_sql = "
						UPDATE
							dev.EDITORIAL_THUMB
						SET
							DISPLAY_NUM = ".$display_num."
						WHERE
							IDX = ".$tmp_idx."
					";
					
					$db->query($update_thumb_sql);
					
					$display_num++;
				}
			}
			
			$update_contents_sql = "
				UPDATE
					dev.EDITORIAL_CONTENTS
				SET
					DEL_FLG = TRUE,
					UPDATE_DATE = NOW(),
					UPDATER = '".$session_id."'
				WHERE
					THUMB_IDX = ".$thumb_idx."
			";
			
			$db->query($update_contents_sql);
		}
		
		$db->commit();
		
		$json_result['code'] = 200;
		$json_result['msg'] = "선택한 에디토리얼 썸네일이 삭제되었습니다.";
	} catch(mysqli_sql_exception $exception){
		$db->rollback();
		
		$json_result['code'] = 301;
		$json_result['msg'] = "에디토리얼 썸네일 삭제처리에 실패했습니다.";
	}
}
*/
?>



