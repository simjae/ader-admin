<?php
/*
 +=============================================================================
 | 
 | 부자재 put
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
$sel_idx                    = $_POST['sel_idx'];
$sub_material_type          = $_POST['sub_material_type'];
$sub_material_name          = $_POST['sub_material_name'];
$sub_material_memo          = $_POST['sub_material_memo'];

$line_cnt = $db->count('dev.SUB_MATERIAL_INFO', '   SUB_MATERIAL_NAME = "'.$sub_material_name.'" AND IDX != '.$sel_idx.' ');
if($line_cnt == 0){
    $sql = 	'
        UPDATE
            dev.SUB_MATERIAL_INFO
        SET
            SUB_MATERIAL_NAME   = "'.$sub_material_name.'",
            MEMO  = "'.$sub_material_memo.'"
        WHERE 
            IDX = '.$sel_idx.'
    ';
    $db->query($sql);
}
else{
    $json_result['code'] = 300;
    $json_result['msg'] = '이미 동일 이름의 부자재가 있습니다.';
    return $json_result;
}


?>