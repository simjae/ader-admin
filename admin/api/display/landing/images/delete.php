<?php
/*
 +=============================================================================
 | 
 | 랜딩페이지 관리 - 메인 이미지 삭제
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
$img_idx		= $_POST['img_idx'];
$country		= $_POST['country'];

if ($img_idx != null && $country != null) {
	$delete_img_sql = "
		UPDATE
			TMP_MAIN_IMG
		SET
			DEL_FLG = TRUE,
			UPDATE_DATE = NOW(),
			UPDATER = '".$session_id."'
		WHERE
			IDX = ".$img_idx."
	";
	
	$db->query($delete_img_sql);
	
	$db_result = $db->affectedRows();
	
	if ($db_result > 0) {
		$select_img_sql = "
			SELECT
				MI.IDX		AS IMG_IDX
			FROM
				TMP_MAIN_IMG MI
			WHERE
				MI.COUNTRY = '".$country."' AND
				MI.DEL_FLG = FALSE
			ORDER BY
				MI.DISPLAY_NUM ASC
		";
		
		$db->query($select_img_sql);
		
		$display_num = 1;
		foreach($db->fetch() as $img_data) {
			$tmp_idx = $img_data['IMG_IDX'];
			
			if (!empty($tmp_idx)) {
				$update_img_sql = "
					UPDATE
						TMP_MAIN_IMG
					SET
						DISPLAY_NUM = ".$display_num."
					WHERE
						IDX = ".$tmp_idx."
				";
				
				$db->query($update_img_sql);
				
				$display_num++;
			}
		}
	}
}
?>