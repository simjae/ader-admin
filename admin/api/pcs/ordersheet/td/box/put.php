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
$box_type       = $_POST['box_type'];
$sel_idx        = $_POST['sel_idx'];
$box_name       = $_POST['box_name'];
$box_width      = $_POST['box_width'];
$box_length     = $_POST['box_length'];
$box_height     = $_POST['box_height'];
$box_volume     = $_POST['box_volume'];

$table = '';
$box_str = '';

if($box_type != null){
    switch($box_type){
        case 'LOAD':
            $table = " dev.LOAD_BOX_INFO ";
            $box_str = '적재박스';
            break;
        case 'DELIVER':
            $table = " dev.DELIVER_BOX_INFO ";
            $box_str = '출고박스';
            break;
    }
    $box_cnt = $db->count($table, ' BOX_NAME = "'.$box_name.'" AND IDX != '.$sel_idx.' ');
    if($box_cnt == 0){
        $sql = 	'
            UPDATE
                '.$table.'
            SET
                BOX_NAME = "'.$box_name.'",
                BOX_WIDTH = '.$box_width.',
                BOX_LENGTH = '.$box_length.',
                BOX_HEIGHT = '.$box_height.',
                BOX_VOLUME = '.$box_volume.'
            WHERE 
                IDX = '.$sel_idx.'
        ';
    
        $update_row_cnt = 0;
    
        $db->query($sql);
    }
    else{
        $json_result['code'] = 300;
        $json_result['msg'] = '이미 동일 이름의 '.$box_str.'가 있습니다.';
        return $json_result;
    }
}



?>