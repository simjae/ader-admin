<?php
/*
 +=============================================================================
 | 
 | 드로우 관리 화면 - 드로우 당첨 처리
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.01.18
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

include_once("/var/www/admin/api/common/common.php");

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$session_id		= sessionCheck();
$draw_idx		= $_POST['draw_idx'];

if ($draw_idx != null) {
	try {
		$draw_cnt = $db->count("PAGE_DRAW","IDX = ".$draw_idx." AND DISPLAY_FLG = TRUE AND ANNOUNCE_DATE < NOW() AND DEL_FLG = FALSE AND PURCHASE_END_DATE < NOW()");
		if ($draw_cnt == 0) {
			$json_result['code'] = 301;
			$json_result['msg'] = "선택된 드로우는 현재 당첨처리가 불가능합니다. 드로우 당첨일을 확인해주세요.";
		}
		
		$entry_cnt = $db->count("ENTRY_DRAW","DRAW_IDX = ".$draw_idx);
		if ($entry_cnt == 0) {
			$json_result['code'] = 301;
			$json_result['msg'] = "응모 인원이 없는 드로우는 당첨처리할 수 없습니다.";
		}
		
		$prize_cnt = $db->count("ENTRY_DRAW","DRAW_IDX = ".$draw_idx." AND PRIZE_FLG = TRUE");
		if ($prize_cnt > 0) {
			$json_result['code'] = 301;
			$json_result['msg'] = "선택된 드로우는 이미 당첨 처리가 완료된 드로우 입니다.";
		}
		
		$select_qty_sql = "
			SELECT
				OPTION_IDX		AS OPTION_IDX,
				PRODUCT_QTY		AS PRODUCT_QTY
			FROM
				QTY_DRAW QD
			WHERE
				QD.DRAW_IDX = ".$draw_idx."
		";
		
		$db->query($select_qty_sql);
		
		foreach($db->fetch() as $qty_data) {
			$option_idx = $qty_data['OPTION_IDX'];
			$product_qty = intval($qty_data['PRODUCT_QTY']);
			
			$member_info = array();
			
			if (!empty($option_idx) && $product_qty > 0) {
				$select_entry_sql = "
					SELECT
						ED.MEMBER_IDX	AS MEMBER_IDX
					FROM
						ENTRY_DRAW ED
					WHERE
						ED.DRAW_IDX = ".$draw_idx." AND
						ED.OPTION_IDX = ".$option_idx."
					ORDER BY
						ED.MEMBER_IDX ASC
				";
				
				$db->query($select_entry_sql);
				
				$member_idx = array();
				foreach($db->fetch() as $entry_data) {
					array_push($member_idx,$entry_data['MEMBER_IDX']);
				}
				
				if (count($member_idx) > 0) {
					if ($product_qty >= count($member_idx)) {
						$member_info = $member_idx;
					} else {
						while(count($member_info) < $product_qty) {
							$prize_member = rand(1,(count($member_idx) - 1));
							
							if (!in_array($prize_member,$member_info)) {
								array_push($member_info,$prize_member);
							}
							
							if (count($member_info) == $product_qty) {
								break;
							}
						}
					}
					
					if ($product_qty >= count($member_info)) {
						$prize_cnt = 0;
						for ($i=0; $i<count($member_info); $i++) {
							$update_prize_sql = "
								UPDATE
									ENTRY_DRAW
								SET
									PRIZE_FLG = TRUE,
									UPDATE_DATE = NOW(),
									UPDATER = '".$session_id."'
								WHERE
									DRAW_IDX = ".$draw_idx." AND
									MEMBER_IDX = ".$member_info[$i]." AND
									OPTION_IDX = ".$option_idx."
							";
							
							$db->query($update_prize_sql);
							
							$db_result = $db->affectedRows();
							
							if ($db_result > 0) {
								$prize_cnt++;
							}
						}
						
						
						if (count($member_info) != $prize_cnt) {
							$db->rollback();
							
							$json_result['code'] = 301;
							$json_result['msg'] = "드로우 당첨 처리에 실패했습니다. 당첨 정보를 갱신하려는 드로우를 다시 확인해주세요.";
						}
					
						$db->commit();
					}
				}
			}
		}	
	} catch(mysqli_sql_exception $exception){
		$db->rollback();
		
		$json_result['code'] = 301;
		$json_result['msg'] = "드로우 당첨정보 갱신처리에 실패했습니다.";
	}
	
} else {
	$json_result['code'] = 301;
	$json_result['msg'] = "당첨 정보를 갱신하려는 드로우를 선택해주세요.";
}

?>