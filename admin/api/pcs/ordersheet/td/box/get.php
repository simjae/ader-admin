<?php
/*
 +=============================================================================
 | 
 | 박스 정보 목록
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.10.18
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$sel_box_idx    	                        = $_POST['sel_box_idx'];			    //박스 idx
$box_type                                   = $_POST['box_type'];

if($box_type == 'load' || $box_type == 'deliver'){
    $where = '';
    $table = '';
    if($sel_box_idx != null){
        $where = ' WHERE IDX = '.$sel_box_idx;
    }
    
    switch($box_type){
        case 'load':
            $table .= ' dev.LOAD_BOX_INFO ';
            break;
        case 'deliver':
            $table .= ' dev.DELIVER_BOX_INFO ';
            break;
    }
    $sql = 	'SELECT
                IDX                                         AS BOX_IDX,
                BOX_NAME                                    AS BOX_NAME,
                BOX_WIDTH                                   AS BOX_WIDTH,
                BOX_LENGTH                                  AS BOX_LENGTH,
                BOX_HEIGHT                                  AS BOX_HEIGHT,
                BOX_VOLUME                                  AS BOX_VOLUME
            FROM 
                '.$table.'
                '.$where;
    
    $db->query($sql);
    foreach($db->fetch() as $data) {
        $json_result['data'][] = array(
            'box_idx'		                =>intval($data['BOX_IDX']),
            'box_name'				        =>$data['BOX_NAME'],
            'box_width'			            =>$data['BOX_WIDTH'],
            'box_length'			        =>$data['BOX_LENGTH'],
            'box_height'			        =>$data['BOX_HEIGHT'],
            'box_volume'			        =>$data['BOX_VOLUME']
        );
    }
}
else if($box_type == 'all'){
    $db->query("SELECT IDX,BOX_NAME FROM dev.LOAD_BOX_INFO");

    foreach($db->fetch() as $data) {
        $json_result['load_box_data'][] = array(
            'box_idx'		                =>intval($data['IDX']),
            'box_name'				        =>$data['BOX_NAME']
        );
    }

    $db->query("SELECT IDX,BOX_NAME FROM dev.DELIVER_BOX_INFO");
    
    foreach($db->fetch() as $data) {
        $json_result['deliver_box_data'][] = array(
            'box_idx'		                =>intval($data['IDX']),
            'box_name'				        =>$data['BOX_NAME']
        );
    }
}


?>