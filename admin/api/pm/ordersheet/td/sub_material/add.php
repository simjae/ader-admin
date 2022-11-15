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
$sub_material_name          = $_POST['sub_material_name'];
$sub_material_code          = $_POST['sub_material_code'];
$sub_material_type          = $_POST['sub_material_type'];
$sub_material_memo          = $_POST['sub_material_memo'];

$line_cnt = $db->count('dev.SUB_MATERIAL_INFO', ' SUB_MATERIAL_NAME = "'.$sub_material_name.'" ');

if($line_cnt == 0){
    $sql = 	'
        INSERT INTO dev.SUB_MATERIAL_INFO
        (
            SUB_MATERIAL_NAME,
            SUB_MATERIAL_CODE,
            SUB_MATERIAL_TYPE,
            MEMO
        )
        VALUE
        (
            "'.$sub_material_name.'",
            "'.$sub_material_code.'",
            "'.$sub_material_type.'",
            "'.$sub_material_memo.'"
        )
    ';
    $db->query($sql);
    $json_result['code'] = 200;
}
else{
    $json_result['code'] = 300;
    $json_result['msg'] = '이미 동일 이름의 부자재가 있습니다.';
    return $json_result;
}
?>