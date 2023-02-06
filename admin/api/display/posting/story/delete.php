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

$country		= $_POST['country'];
$story_column	= $_POST['story_column'];
$story_idx		= $_POST['story_idx'];

if ($story_column != null && $story_idx != null) {
	$delete_story_sql = "
		UPDATE
			dev.TMP_POSTING_STORY
		SET
			DEL_FLG = TRUE
		WHERE
			STORY_COLUMN = ".$story_column." AND
			IDX = ".$story_idx."
	";
	
	$db->query($delete_story_sql);
	
	$db_result = $db->affectedRows();
	
	if ($db_result > 0) {
		$select_story_sql = "
			SELECT
				PS.IDX			AS STORY_IDX
			FROM
				dev.TMP_POSTING_STORY PS
			WHERE
				PS.COUNTRY = '".$country."' AND
				PS.STORY_COLUMN = ".$story_column."
			ORDER BY
				PS.DISPLAY_NUM ASC
		";
		
		$db->query($select_story_sql);
		
		$display_num = 1;
		foreach($db->fetch() as $data) {
			$story_idx = $data['STORY_IDX'];
			
			$update_story_sql = "
				UPDATE
					dev.TMP_POSTING_STORY
				SET
					DISPLAY_NUM = ".$display_num."
				WHERE
					IDX = ".$story_idx." AND
					STORY_COLUMN = ".$story_column." AND
					COUNTRY = '".$country."'
			";
			
			$db->query($update_story_sql);
			
			$display_num++;
		}
	}
}

?>