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

$table = '';

if($box_type != null){
    switch($box_type){
        case 'LOAD':
            $table = " dev.LOAD_BOX_INFO ";
            break;
        case 'DELIVER':
            $table = " dev.DELIVER_BOX_INFO ";
            break;
    }
    $sql = 	'
            DELETE FROM
                '.$table.'
            WHERE
                IDX = '.$sel_idx.'
    ';
    
    $db->query($sql);
}
?>