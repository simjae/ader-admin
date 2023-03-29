<?php
/*
 +=============================================================================
 | 
 | 라인 정보 목록
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.10.18
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$sel_line_idx								= $_POST['sel_line_idx'];				//박스 idx

if($sel_line_idx != null){
	$where = ' WHERE LI.IDX = '.$sel_line_idx;
}

$sql = '
	SELECT
		LI.IDX				AS LINE_IDX,
		LI.LINE_NAME		AS LINE_NAME,
		LT.TYPE_NAME		AS LINE_TYPE,
		LI.MEMO				AS LINE_MEMO
	FROM 
		LINE_INFO LI
		LEFT JOIN LINE_TYPE LT ON
		LI.LINE_TYPE_IDX = LT.IDX
		'.$where;

$db->query($sql);
foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'line_idx'						=>intval($data['LINE_IDX']),
		'line_name'						=>$data['LINE_NAME'],
		'line_type'						=>$data['LINE_TYPE'],
		'line_memo'					=>$data['LINE_MEMO'] 
	);
}
?>