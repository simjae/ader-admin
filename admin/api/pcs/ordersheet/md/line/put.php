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
$sel_idx        = $_POST['sel_idx'];
$line_name      = $_POST['line_name'];
$line_type      = $_POST['line_type'];
$line_memo     = $_POST['line_memo'];

$line_cnt = $db->count('dev.LINE_INFO', ' LINE_NAME = "'.$line_name.'" AND IDX != '.$sel_idx.' ');
if($line_cnt == 0){
    $sql = 	'
        UPDATE
            dev.LINE_INFO
        SET
            LINE_NAME   = "'.$line_name.'",
            MEMO  = "'.$line_memo.'"
        WHERE 
            IDX = '.$sel_idx.'
    ';
    $db->query($sql);
}
else{
    $json_result['code'] = 300;
    $json_result['msg'] = '이미 동일 이름의 라인이 있습니다.';
    return $json_result;
}


?>