<?php
/*
 +=============================================================================
 | 
 | 배너 관리 페이지 - 베너 삭제
 | -----------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2023.01.04
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$banner_type		= $_POST['banner_type'];
$banner_idx			= $_POST['banner_idx'];

if ($banner_type != null && $banner_idx != null) {
	$banner_cnt = 0;
	if ($banner_type == "HED") {
		$valid_table = "dev.PAGE_PRODUCT";
	} else {
		$valid_table = "dev.PRODUCT_GRID";
	}
	
	for ($i=0; $i<count($banner_idx); $i++) {
		$cnt = $db->count($valid_table,"BANNER_IDX = ".$banner_idx[$i]." AND DEL_FLG = FALSE");
		
		if ($cnt > 0) {
			$banner_cnt++;
		}
	}
	
	if ($banner_cnt == 0) {
		$banner_table = "";
		switch ($banner_type) {
			case "HED" :
				$banner_table = "dev.BANNER_HEAD";
				break;
			
			case "IMG" :
				$banner_table = "dev.BANNER_IMG";
				break;
			
			case "VID" :
				$banner_table = "dev.BANNER_VID";
				break;
		}
		
		$delete_banner_sql = "
			UPDATE
				".$banner_table."
			SET
				DEL_FLG = TRUE,
				UPDATE_DATE = NOW(),
				UPDATER = 'Admin'
			WHERE
				IDX IN (".implode(",",$banner_idx).")
		";
		
		$db->query($delete_banner_sql);
	} else {
		$json_result['code'] = 401;
		$json_result['msg'] = "현재 진열중인 배너는 삭제할 수 없습니다.";
	}
}
?>