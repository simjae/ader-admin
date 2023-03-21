<?php
/*
 +=============================================================================
 | 
 | 관리자 : 관리자계정 리스트
 | ----------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.07.18
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$admin_idx 				= $_POST['admin_idx'];
$permition_idx			= $_POST['permition_idx'];

if ($admin_idx != null) {
	$admin_idx = explode(",",$admin_idx);
}

if (count($admin_idx) > 0 && count($permition_idx) > 0) {
	for ($i=0; $i<count($admin_idx); $i++) {
		for ($j=0; $j<count($permition_idx); $j++) {
			$insert_permition_mapping_sql = "
				INSERT INTO
					PERMITION_MAPPING
				(
					ADMIN_IDX,
					PERMITION_IDX
				) VALUES (
					".$admin_idx[$i].",
					".$permition_idx[$j]."
				)
			";
			
			$db->query($insert_permition_mapping_sql);
		}
	}
}

?>