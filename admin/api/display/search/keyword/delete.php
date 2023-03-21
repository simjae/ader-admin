<?php
/*
 +=============================================================================
 | 
 | 추천 검색어 삭제
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.11.28
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$country			= $_POST['country'];
$keyword_idx		= $_POST['keyword_idx'];

if ($keyword_idx != null) {
	$delete_recommend_keyword_sql = "
		DELETE FROM
			TMP_RECOMMEND_KEYWORD
		WHERE
			IDX IN (".implode(",",$keyword_idx).")
	";
	
	$db->query($delete_recommend_keyword_sql);
	
	$db_result = $db->affectedRows();
	
	if ($db_result > 0) {
		$select_recommend_keyword_sql = "
			SELECT
				RK.IDX			AS KEYWORD_IDX
			FROM
				TMP_RECOMMEND_KEYWORD RK
			WHERE
				RK.COUNTRY = '".$country."'
			ORDER BY
				RK.DISPLAY_NUM ASC
		";
		
		$db->query($select_recommend_keyword_sql);
		
		$display_num = 1;
		foreach($db->fetch() as $keyword_data) {
			$tmp_idx = $keyword_data['KEYWORD_IDX'];
			
			if (!empty($tmp_idx)) {
				$update_recommend_keyword_sql = "
					UPDATE
						TMP_RECOMMEND_KEYWORD
					SET
						DISPLAY_NUM = ".$display_num."
					WHERE
						IDX = ".$tmp_idx."
				";
				
				$db->query($update_recommend_keyword_sql);
				
				$display_num++;
			}
		}
	}
}

?>