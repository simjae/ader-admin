<?php
/*
 +=============================================================================
 | 
 | 라인타입 삭제
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.02.24
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$sel_idx		= $_POST['sel_idx'];

if($sel_idx != null){
	$custom_clearance_cnt = $db->count(
		'ORDERSHEET_MST',
		'
			LINE_IDX IN (
				SELECT
					IDX
				FROM
					LINE_INFO
				WHERE
					LINE_TYPE_IDX = '.$sel_idx.'
			)
		'
	);
	
	if($custom_clearance_cnt == 0){
		$delete_sql = "
			DELETE FROM LINE_TYPE
			WHERE  IDX = ".$sel_idx."
		";
		$db->query($delete_sql);
	}
	else{
		$code = 301;
		$msg = '이미 해당타입 라인을 사용하는 상품이 존재합니다.';
	}
}

else{
	$code = 301;
	$msg = '선택한 라인타입정보가 올바르지 않습니다. 다시 선택해주세요';
}

?>