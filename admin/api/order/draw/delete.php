<?php
/*
 +=============================================================================
 | 
 | 드로우 관리 화면 - 드로우 삭제
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.01.15
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

include_once("/var/www/admin/api/common/common.php");

$session_id		= sessionCheck();
$country		= $_POST['country'];
$draw_idx		= $_POST['draw_idx'];

if ($country != null && $draw_idx != null) {
	$entry_cnt = $db->count("ENTRY_DRAW","DRAW_IDX IN (".implode(',',$draw_idx).")");
	
	if ($entry_cnt > 0) {
		$json_result['code'] = 401;
		$json_result['msg'] = "현재 참가중인 드로우 정보는 삭제할 수 없습니다.";
	} else {
		$delete_draw_sql = "
			UPDATE
				PAGE_DRAW
			SET
				DEL_FLG = TRUE,
				UPDATE_DATE = NOW(),
				UPDATER = '".$session_id."'
			WHERE
				IDX IN (".implode(',',$draw_idx).")
		";
		
		$db->query($delete_draw_sql);
		
		$db_result = $db->affectedRows();
		
		$display_num = 1;
		if ($db_result > 0) {
			$select_draw_sql = "
				SELECT
					PD.IDX		AS DRAW_IDX
				FROM
					PAGE_DRAW PD
				WHERE
					PD.COUNTRY = '".$country."' AND
					PD.DEL_FLG = FALSE
				ORDER BY
					PD.DISPLAY_NUM ASC
			";
			
			$db->query($select_draw_sql);
			
			foreach($db->fetch() as $draw_data) {
				$tmp_idx = $draw_data['DRAW_IDX'];
				
				if (!empty($tmp_idx)) {
					$update_draw_sql = "
						UPDATE
							PAGE_DRAW
						SET
							DISPLAY_NUM = ".$display_num."
						WHERE
							IDX = ".$tmp_idx."
					";
					
					$db->query($update_draw_sql);
					
					$display_num++;
				}
			}
			
		}
	}
}

?>