<?php
/*
 +=============================================================================
 | 
 | 오더시트 삭제
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.10.12
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$box_idx		= $_POST['box_idx'];

if ($box_idx != null) {
	$box_cnt = $db->count("ORDERSHEET_MST","LOAD_BOX_IDX = ".$box_idx);
	
	if ($box_cnt > 0) {
		$json_result['code'] = 301;
		$json_result['msg'] = "오더시트 정보에 등록되어있는 적재박스는 삭제할 수 없습니다.";
	} else {
		$delete_box_info_sql = "
			DELETE FROM
				BOX_INFO
			WHERE
				IDX = ".$box_idx."
		";
		
		$db->query($delete_box_info_sql);
	}
}
?>