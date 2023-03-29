<?php
/*
 +=============================================================================
 | 
 | 프리오더 관리 화면 - 프리오더 삭제
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
$preorder_idx	= $_POST['preorder_idx'];

if ($country != null && $preorder_idx != null) {
	$entry_cnt = $db->count("ENTRY_PREORDER","PREORDER_IDX IN (".implode(',',$preorder_idx).")");
	
	if ($entry_cnt > 0) {
		$json_result['code'] = 401;
		$json_result['msg'] = "현재 참가중인 프리오더 정보는 삭제할 수 없습니다.";
	} else {
		$delete_preorder_sql = "
			UPDATE
				PAGE_PREORDER
			SET
				DEL_FLG = TRUE,
				UPDATE_DATE = NOW(),
				UPDATER = '".$session_id."'
			WHERE
				IDX IN (".implode(',',$preorder_idx).")
		";
		
		$db->query($delete_preorder_sql);
		
		$db_result = $db->affectedRows();
		
		if (!empty($db_result)) {
			$select_preorder_sql = "
				SELECT
					PP.IDX		AS PREORDER_IDX
				FROM
					PAGE_PREORDER PP
				WHERE
					PP.COUNTRY = '".$country."' AND
					PP.DEL_FLG = FALSE
				ORDER BY
					PP.DISPLAY_NUM ASC
			";
			
			$db->query($select_preorder_sql);
			
			$display_num = 1;
			
			foreach($db->fetch() as $preorder_data) {
				$tmp_idx = $preorder_data['PREORDER_IDX'];
				
				if (!empty($tmp_idx)) {
					$update_preorder_sql = "
						UPDATE
							PAGE_PREORDER
						SET
							DISPLAY_NUM = ".$display_num."
						WHERE
							IDX = ".$tmp_idx." AND
							COUNTRY = '".$country."'
					";
					
					$db->query($update_preorder_sql);
					
					$display_num++;
				}
			}
		}
	}
}

?>