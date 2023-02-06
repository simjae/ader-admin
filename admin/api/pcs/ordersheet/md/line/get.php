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

$sel_line_idx    	                        = $_POST['sel_line_idx'];			    //박스 idx

if($sel_line_idx != null){
    $where = ' WHERE IDX = '.$sel_line_idx;
}
$sql = 	'SELECT
            IDX                                         AS LINE_IDX,
            LINE_NAME                                   AS LINE_NAME,
            LINE_TYPE                                   AS LINE_TYPE,
            MEMO                                        AS LINE_MEMO
        FROM 
            dev.LINE_INFO
            '.$where;

$db->query($sql);
foreach($db->fetch() as $data) {
    $json_result['data'][] = array(
        'line_idx'		                =>intval($data['LINE_IDX']),
        'line_name'				        =>$data['LINE_NAME'],
        'line_type'			            =>$data['LINE_TYPE'],
        'line_memo'			        =>$data['LINE_MEMO'] 
    );
}
?>