<?php
/*
 +=============================================================================
 | 
 | 스토리 관리 화면 - 스토리 삭제
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

$country			= $_POST['country'];
$story_type			= $_POST['story_type'];
$story_idx			= $_POST['story_idx'];

if ($story_type != null && $story_idx != null) {
	$delete_posting_story_sql = "
		UPDATE
			TMP_POSTING_STORY
		SET
			DEL_FLG = TRUE
		WHERE
			IDX = ".$story_idx." AND
			STORY_TYPE = '".$story_type."'
	";
	
	$db->query($delete_posting_story_sql);
	
	$db_result = $db->affectedRows();
	
	if ($db_result > 0) {
		$select_posting_story_sql = "
			SELECT
				PS.IDX			AS STORY_IDX
			FROM
				TMP_POSTING_STORY PS
			WHERE
				PS.COUNTRY = '".$country."' AND
				PS.STORY_TYPE = '".$story_type."'
			ORDER BY
				PS.DISPLAY_NUM ASC
		";
		
		$db->query($select_posting_story_sql);
		
		$display_num = 1;
		foreach($db->fetch() as $story_data) {
			$tmp_idx = $story_data['STORY_IDX'];
			
			if (!empty($tmp_idx)) {
				$update_posting_story_sql = "
					UPDATE
						TMP_POSTING_STORY
					SET
						DISPLAY_NUM = ".$display_num."
					WHERE
						IDX = ".$tmp_idx."
				";
				
				$db->query($update_posting_story_sql);
				
				$display_num++;
			}
		}
	}
}

?>