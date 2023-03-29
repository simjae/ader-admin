<?php
/*
 +=============================================================================
 | 
 | 라인 추가
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
$line_name          = $_POST['line_name'];
$line_type_idx          = $_POST['line_type_idx'];
$line_memo          = $_POST['line_memo'];

$line_cnt = $db->count('LINE_INFO', ' LINE_NAME = "'.$line_name.'" ');

if($line_cnt == 0){
    $sql = 	'
        INSERT INTO LINE_INFO
        (
            LINE_NAME,
            LINE_TYPE_IDX,
            MEMO
        )
        VALUE
        (
            "'.$line_name.'",
            "'.$line_type_idx.'",
            "'.$line_memo.'"
        )
    ';
    $db->query($sql);
    $json_result['code'] = 200;
}
else{
    $json_result['code'] = 300;
    $json_result['msg'] = '이미 동일 이름의 라인이 있습니다.';
    return $json_result;
}
?>