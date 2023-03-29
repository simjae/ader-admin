<?php
/*
 +=============================================================================
 | 
 | WKLA 추가
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.11.11
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$wkla_name          = $_POST['wkla_name'];
$wkla_memo          = $_POST['wkla_memo'];

$line_cnt = $db->count('WKLA_INFO', ' WKLA_NAME = "'.$wkla_name.'" ');

if($line_cnt == 0){
    $sql = 	'
        INSERT INTO
			WKLA_INFO
        (
            WKLA_NAME,
            MEMO
        ) VALUE (
            "'.$wkla_name.'",
            "'.$wkla_memo.'"
        )
    ';
    $db->query($sql);
    $json_result['code'] = 200;
}
else{
    $json_result['code'] = 300;
    $json_result['msg'] = '이미 동일 이름의 WKLA가 있습니다.';
    return $json_result;
}
?>