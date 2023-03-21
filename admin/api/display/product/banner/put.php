<?php
/*
 +=============================================================================
 | 
 | 배너 관리 페이지 - 베너 수정
 | -----------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2023.01.03
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

include_once("/var/www/admin/api/common/common.php");

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$session_id		= sessionCheck();
$banner_type	= $_POST['banner_type'];
$banner_idx		= $_POST['banner_idx'];
$banner_title	= $_POST['banner_title'];
$banner_memo	= $_POST['banner_memo'];
$location_start	= $_POST['location_start'];
$location_end	= $_POST['location_end'];

$clip_info		= json_decode($_POST['clip_info']);

if ($banner_type != null && $banner_idx != null) {
	$banner_table = "";
	$clip_table = "";

	$head_clip_sql = "";

	switch ($banner_type) {
		case "HED" :
			$banner_table = "BANNER_HEAD";
			if ($location_start != null && $location_end != null) {
				$head_clip_sql = "
					LOCATION_START = ".$location_start.",
					LOCATION_END = ".$location_end.",
				";
			}
			break;
		
		case "IMG" :
			$banner_table = "BANNER_IMG";
			$clip_table = "BANNER_IMG_CLIP";
			break;
		
		case "VID" :
			$banner_table = "BANNER_VID";
			$clip_table = "BANNER_VID_CLIP";
			break;
	}
	
	try{
		$update_banner_sql = "
			UPDATE
				".$banner_table."
			SET
				BANNER_TITLE = '".$banner_title."',
				BANNER_MEMO = '".$banner_memo."',
				".$head_clip_sql."
				UPDATE_DATE = NOW(),
				UPDATER = '".$session_id."'
			WHERE
				IDX = ".$banner_idx."
		";
		
		$db->query($update_banner_sql);
		
		$db_result = $db->affectedRows();
		
		if ($db_result > 0) {
			if ($banner_type != "HED" && $clip_info != null) {
				$db->query("DELETE FROM ".$clip_table." WHERE BANNER_IDX = ".$banner_idx);
				
				if ($clip_info != null) {
					for ($i=0; $i<count($clip_info); $i++) {
						$insert_clip_sql = "
							INSERT INTO
								".$clip_table."
							(
								BANNER_IDX,
								CLIP_TYPE,
								LOCATION_START,
								LOCATION_END
							) VALUES (
								".$banner_idx.",
								'".$clip_info[$i][0]."',
								".$clip_info[$i][1].",
								".$clip_info[$i][2]."
							)
						";
						
						$db->query($insert_clip_sql);
					}
				}
			}
		}
		
		$db->commit();
	} catch(mysqli_sql_exception $exception) {
		$db->rollback();
		
		print_r($exception);
		$json_result['code'] = 401;
		$msg = "배너 수정작업에 실패했습니다.";
	}
}
?>