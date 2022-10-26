<?php
/*
 +=============================================================================
 | 
 | 박스 정보 리스트
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.10.19
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$sort_type 			= $_POST['sort_type'];				//정렬 타입
$sort_value 		= $_POST['sort_value'];				//정렬 값

$rows = $_POST['rows'];
$page = $_POST['page'];

$limit_start = (intval($page)-1)*$rows;
$json_result = array(
	'total' => $db->count('dev.BOX_INFO'),
	'total_cnt' => $db->count('dev.BOX_INFO'),
	'page' => $page
);

$sql = 	'SELECT
			BI.IDX                                          AS BOX_IDX,
            BI.BOX_NAME                                     AS BOX_NAME,
            BI.BOX_WIDTH                                    AS BOX_WIDTH,
            BI.BOX_LENGTH                                   AS BOX_LENGTH,
            BI.BOX_HEIGHT                                   AS BOX_HEIGHT,
            BI.BOX_VOLUME                                   AS BOX_VOLUME,
            (SELECT     
                COUNT(0)        
            FROM
                dev.ORDERSHEET_MST
            WHERE
                BOX_IDX = BI.IDX)                           AS USE_PRODUCT_CNT
		FROM 
			dev.BOX_INFO    AS BI
        ORDER BY 
            BI.IDX DESC
		';
if ($rows != null) {
	$sql .= " LIMIT ".$limit_start.",".$rows;
}


$db->query($sql);
foreach($db->fetch() as $data) {
    $json_result['data'][] = array(
        'num'							=>$total_cnt--,
        'box_idx'		                =>intval($data['BOX_IDX']),
        'box_name'				        =>$data['BOX_NAME'],
        'box_width'			            =>$data['BOX_WIDTH'],
        'box_length'			        =>$data['BOX_LENGTH'],
        'box_height'			        =>$data['BOX_HEIGHT'],
        'box_volume'			        =>$data['BOX_VOLUME'],
        'use_product_cnt'			    =>$data['USE_PRODUCT_CNT']
    );
}
?>