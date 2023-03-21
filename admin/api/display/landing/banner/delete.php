<?php
/*
 +=============================================================================
 | 
 | 랜딩페이지 관리 - 메인_배너 삭제
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2023.01.13
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

include_once("/var/www/admin/api/common/common.php");

$session_id		= sessionCheck();
$banner_idx		= $_POST['banner_idx'];
$country		= $_POST['country'];

if ($banner_idx != null && $country != null) {
	$delete_banner_sql = "
		UPDATE
			TMP_MAIN_BANNER
		SET
			DEL_FLG = TRUE,
			UPDATE_DATE = NOW(),
			UPDATER = '".$session_id."'
		WHERE
			IDX = ".$banner_idx."
	";
	
	$db->query($delete_banner_sql);
	
	$db_result = $db->affectedRows();
	
	if ($db_result > 0) {
		$select_banner_sql = "
			SELECT
				MB.IDX		AS BANNER_IDX
			FROM
				TMP_MAIN_BANNER MB
			WHERE
				MB.COUNTRY = '".$country."' AND
				MB.DEL_FLG = FALSE
			ORDER BY
				MB.DISPLAY_NUM ASC
		";
		
		$db->query($select_banner_sql);
		
		$display_num = 1;
		foreach($db->fetch() as $banner_data) {
			$tmp_idx = $banner_data['BANNER_IDX'];
			
			if (!empty($tmp_idx)) {
				$update_banner_sql = "
					UPDATE
						TMP_MAIN_BANNER
					SET
						DISPLAY_NUM = ".$display_num."
					WHERE
						IDX = ".$tmp_idx."
				";
				
				$db->query($update_banner_sql);
				
				$display_num++;
			}
		}
	}
}
?>