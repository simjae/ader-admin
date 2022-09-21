<?php
/*
 +=============================================================================
 | 
 | 로그 등록
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.07.18
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$log_type           = $_POST['log_type'];
$log_contents       = $_POST['log_contents'];
$target_cnt         = $_POST['target_cnt'];
$creater            = '김철수';
$creater_ip         = '127.0.0.7';
$creater_level      = '메인 관리자';

$where_values = array();
$where_ist = '';
$where_ist_values = array();

if($target_cnt != null && $target_cnt > 0){
    $log_contents .= ': ('.$target_cnt.')건';
}
$values = array(
    'LOG_TYPE'      => $log_type,
    'LOG_CONTENTS'  => $log_contents,
    'CREATER'       => $creater,
    'CREATER_IP'    => $creater_ip,
    'CREATER_LEVEL' => $creater_level           
);
$db->insert(
        'dev.ADMINISTRATOR_LOG',
        $values,
        $where_ist,
        $where_ist_values
);
$code = 200;
?>