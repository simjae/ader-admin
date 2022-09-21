<?php
/*
 +=============================================================================
 | 
 | 블루마크 삭제처리
 | -----------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.08.10
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

/** 변수 정리 **/
$select_idx				= $_POST['select_idx'];
$action_type			= $_POST['action_type'];

$table = " dev.BLUEMARK_INFO ";

$idx_list="";
if ($select_idx != null) {
	if(is_array($select_idx) == true){
		$idx_list = implode(',',$select_idx);
		$where .= " WHERE IDX IN (".$idx_list.")";
	}
	else{
		$where .= " WHERE IDX = ".$select_idx;
	}	
}

$sql = "";
if ($action_type != null) {
	switch ($action_type) {
		case "delete" :
			$sql = "UPDATE
						".$table."
					SET
						DEL_FLG = TRUE
					".$where;
			break;
	}
	$db->query($sql);
}
?>