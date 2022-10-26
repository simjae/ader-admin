<?php
/*
 +=============================================================================
 | 
 | 박스 추가
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
$box_name       = $_POST['box_name'];
$box_width      = $_POST['box_width'];
$box_length     = $_POST['box_length'];
$box_height     = $_POST['box_height'];
$box_volume     = $_POST['box_volume'];

$box_cnt = $db->count('dev.BOX_INFO', ' BOX_NAME = "'.$box_name.'" ');
if($box_cnt == 0){
    $sql = 	'
        INSERT INTO dev.BOX_INFO
        (
            BOX_NAME,
            BOX_WIDTH,
            BOX_LENGTH,
            BOX_HEIGHT,
            BOX_VOLUME
        )
        VALUE
        (
            "'.$box_name.'",
            '.$box_width.',
            '.$box_length.',
            '.$box_height.', 
            '.$box_volume.'
        )
    ';
    $db->query($sql);
    $json_result['code'] = 200;
}
else{
    $json_result['code'] = 300;
    $json_result['msg'] = '이미 동일 이름의 상자가 있습니다.';
}

?>