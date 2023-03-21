<?php
/*
 +=============================================================================
 | 
 | 회원등급 추가 API
 | ----------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.03.09
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
include_once("/var/www/admin/api/common/common.php");

/** 변수 정리 **/
$session_id			= sessionCheck();
$level_title		= $_POST['title'];
$mileage_per		= $_POST['mileage_per'];

$exist_cnt = $db->count('MEMBER_LEVEL', "TITLE = '".$level_title."' ");
if($exist_cnt == 0){
    $insert_level_sql = "
        INSERT INTO MEMBER_LEVEL
        (
            TITLE,
            MILEAGE_PER,
            CREATER,
            UPDATER
        )
        VALUES
        (
            '".$level_title."',
            ".$mileage_per.",
            '".sessionCheck()."',
            '".sessionCheck()."'
        )
    ";
    $db->query($insert_level_sql);
}
else{
    $json_result['code'] = 301;
    $json_result['msg'] = '이미 동일명의 회원등급이 존재합니다.';
}

?>