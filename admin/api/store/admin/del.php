<?php
/*
 +=============================================================================
 | 
 | Admin 논리적 삭제
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.07.19
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$no = $_REQUEST['no'];
$where = 'IDX=?';

$sql = '
        UPDATE 
            dev.ADMINISTRATOR
        SET
            DEL_FLG = TRUE
        WHERE
            IDX = '.$no.'    
    ';
$db->query($sql);
if($db != null){
    $json_result['result'] = true;
}
else{
    $json_result['result'] = false;
}
?>