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

$idx_list="";
if ($select_idx != null) {
	if(is_array($select_idx) == true){
		$idx_list = implode(',',$select_idx);
		$where .= " WHERE BI.IDX IN (".$idx_list.")";
	}
	else{
		$where .= " WHERE BI.IDX = ".$select_idx;
	}	
}

$sql = "";
if ($action_type != null) {
	switch ($action_type) {
		case "DELETE" :
			$sql = "UPDATE
						dev.BLUEMARK_INFO BI
					SET
						BI.DEL_FLG = TRUE,
						BI.UPDATER = 'Admin',
						BI.UPDATE_DATE = NOW()
					".$where;
			break;
	}
	$db->query($sql);
}
?>