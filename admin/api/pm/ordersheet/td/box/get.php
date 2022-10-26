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

$box_idx    	                        = $_POST['box_idx'];			    //박스 idx

$where = '';

if($box_idx != null){
    $where = ' WHERE IDX = '.$box_idx  .' ';
}

$sql = 	'SELECT
			IDX                                         AS BOX_IDX,
            BOX_NAME                                    AS BOX_NAME,
            BOX_WIDTH                                   AS BOX_WIDTH,
            BOX_LENGTH                                  AS BOX_LENGTH,
            BOX_HEIGHT                                  AS BOX_HEIGHT,
            BOX_VOLUME                                  AS BOX_VOLUME
		FROM 
			dev.BOX_INFO
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
?>