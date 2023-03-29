<?php
/*
 +=============================================================================
 | 
 | 스탠바이 관리 화면 - 스탠바이 삭제
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
$standby_idx	= $_POST['standby_idx'];

if ($country != null && $standby_idx != null) {
	$entry_cnt = $db->count("ENTRY_STANDBY","STANDBY_IDX IN (".implode(',',$standby_idx).")");
	
	if ($entry_cnt > 0) {
		$json_result['code'] = 401;
		$json_result['msg'] = "현재 참가중인 스탠바이 정보는 삭제할 수 없습니다.";
	} else {
		$delete_standby_sql = "
			UPDATE
				PAGE_STANDBY
			SET
				DEL_FLG = TRUE,
				UPDATE_DATE = NOW(),
				UPDATER = '".$session_id."'
			WHERE
				IDX IN (".implode(',',$standby_idx).")
		";
		
		$db->query($delete_standby_sql);
		
		$db_result = $db->affectedRows();
		
		if (!empty($db_result)) {
			$select_standby_sql = "
				SELECT
					PS.IDX		AS STANDBY_IDX
				FROM
					PAGE_STANDBY PS
				WHERE
					PS.COUNTRY = '".$country."' AND
					PS.DEL_FLG = FALSE
				ORDER BY
					PS.DISPLAY_NUM ASC
			";
			
			$db->query($select_standby_sql);
			
			$display_num = 1;
			foreach($db->fetch() as $standby_data) {
				$tmp_idx = $standby_data['STANDBY_IDX'];
				
				if (!empty($tmp_idx)) {
					$update_standby_sql = "
						UPDATE
							dev.PAGE_STANDBY
						SET
							DISPLAY_NUM = ".$display_num."
						WHERE
							IDX = ".$tmp_idx." AND
							COUNTRY = '".$country."' AND
							DEL_FLG = FALSE
					";
					
					$db->query($update_standby_sql);
					
					$display_num++;
				}
			}
		}
	}
}

?>