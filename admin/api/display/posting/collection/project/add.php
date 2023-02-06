<?php
/*
 +=============================================================================
 | 
 | 룩북 관리 화면 - 프로젝트 추가
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

$project_name		= $_POST['project_name']; 
$project_desc		= $_POST['project_desc'];
$project_title		= $_POST['project_title'];
$thumb_location		= $_POST['thumb_location'];

if ($country != null) {
	$db->begin_transaction();
	
	try {
		$insert_collection_sql = "
			INSERT INTO
				dev.POSTING_COLLECTION
			(
				COUNTRY,
				PROJECT_NAME,
				PROJECT_DESC,
				PROJECT_TITLE,
				THUMB_LOCATION,
				CREATER,
				UPDATER
			) VALUES (
				'".$country."',
				'".$project_name."',
				'".$project_desc."',
				'".$project_title."',
				'".$thumb_location."',
				'".$session_id."',
				'".$session_id."'
			)
		";
		
		$db->query($insert_collection_sql);
		
		$collection_idx = $db->last_id();
		
		if (!empty($collection_idx)) {
			$select_collection_sql = "
				SELECT
					PC.IDX		AS COLLECTION_IDX
				FROM
					dev.POSTING_COLLECTION PC
				WHERE
					IDX != ".$collection_idx." AND
					COUNTRY = '".$country."' AND
					DEL_FLG = FALSE
				ORDER BY
					PC.DISPLAY_NUM ASC
			";
			$db->query($select_collection_sql);
			
			$display_num = 2;
			foreach($db->fetch() as $collection_data) {
				$tmp_idx = $collection_data['COLLECTION_IDX'];
				
				if (!empty($collection_idx)) {
					$update_collection_sql = "
						UPDATE
							dev.POSTING_COLLECTION
						SET
							DISPLAY_NUM = ".$display_num."
						WHERE
							IDX = ".$tmp_idx." AND
							COUNTRY = '".$country."' AND
							DEL_FLG = FALSE
					";
					
					$db->query($update_collection_sql);
					
					$display_num++;
				}
			}
		}
		
		$db->commit();
		$json_result['code'] = 200;
		$json_result['msg'] = "신규 프로젝트가 등록되었습니다.";
	} catch(mysqli_sql_exception $exception){
		$db->rollback();
		
		$json_result['code'] = 301;
		$json_result['msg'] = "메인 배너 등록에 실패했습니다.";
	}
}

?>