<?php
/*
 +=============================================================================
 | 
 | 박스 정보 리스트
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.10.19
 | 최종 수정일	: 2022.11.04
 | 버전		: 1.1
 | 설명		: 
 | 
 +=============================================================================
*/
$box_type 		    = $_POST['box_type'];				//박스 타입

$box_name 		    = $_POST['box_name'];				//박스 명
$min_width 		    = $_POST['min_width'];				//최소 너비
$max_width 		    = $_POST['max_width'];				//최대 너비
$min_length 		= $_POST['min_length'];				//최소 길이
$max_length 		= $_POST['max_length'];				//최대 길이
$min_height 		= $_POST['min_height'];				//최소 높이
$max_height		    = $_POST['max_height'];				//최대 높이
$min_volume 		= $_POST['min_volume'];				//최소 부피
$max_volume 		= $_POST['max_volume'];				//최대 부피
$use_product_flg    = $_POST['use_product_flg'];		//사용 상품 갯수 플래그

$sort_type 			= $_POST['sort_type'];				//정렬 타입
$sort_value 		= $_POST['sort_value'];				//정렬 값

$rows = $_POST['rows'];
$page = $_POST['page'];

$table = "";
$where = '1=1';
$having = '';
$col_name = "";

if($box_type != null){
    
    switch($box_type){
        case 'LOAD':
            $table = " dev.LOAD_BOX_INFO ";
            $col_name = "LOAD_BOX_IDX";
            break;
        case 'DELIVER':
            $table = " dev.DELIVER_BOX_INFO ";
            $col_name = "DELIVER_BOX_IDX";
            break;
    }

    if($box_name != null){
        $where .= ' AND (BI.BOX_NAME LIKE "%'.$box_name.'%") ';
    }
    
    if($min_width != null){
        $where .= ' AND (BI.BOX_WIDTH >= '.$min_width.') ';
    }
    if($max_width != null){
        $where .= ' AND (BI.BOX_WIDTH <= '.$max_width.') ';
    }
    if($min_length != null){
        $where .= ' AND (BI.BOX_LENGTH >= '.$min_length.') ';
    }
    if($max_length != null){
        $where .= ' AND (BI.BOX_LENGTH <= '.$max_length.') ';
    }
    if($min_height != null){
        $where .= ' AND (BI.BOX_HEIGHT >= '.$min_height.') ';
    }
    if($max_height != null){
        $where .= ' AND (BI.BOX_HEIGHT <= '.$max_height.') ';
    }
    if($min_volume != null){
        $where .= ' AND (BI.BOX_VOLUME >= '.$min_volume.') ';
    }
    if($max_volume != null){
        $where .= ' AND (BI.BOX_VOLUME <= '.$max_volume.') ';
    }

    if($use_product_flg != null && $use_product_flg != 'ALL'){
        if($use_product_flg == 'TRUE'){
            $having .= ' HAVING COUNT(OM.IDX) > 0 ';
        }
        else if($use_product_flg == 'FALSE'){
            $having .= ' HAVING COUNT(OM.IDX) = 0 ';
        }
    }

    /** 정렬 조건 **/
    $order = '';
    if ($sort_value != null && $sort_type != null) {
        $order = ' BI.'.$sort_value." ".$sort_type." ";
    } else {
        $order = ' BI.IDX DESC';
    }

    $limit_start = (intval($page)-1)*$rows;
    $json_result = array(
        'total' => $db->count($table),
        'total_cnt' => $db->count($table),
        'page' => $page
    );

    $sql = '
            SELECT
                BI.IDX                                             AS BOX_IDX,
                BI.BOX_NAME                                     AS BOX_NAME,
                BI.BOX_WIDTH                                    AS BOX_WIDTH,
                BI.BOX_LENGTH                                   AS BOX_LENGTH,
                BI.BOX_HEIGHT                                   AS BOX_HEIGHT,
                BI.BOX_VOLUME                                   AS BOX_VOLUME,
                COUNT(OM.IDX)									AS USE_PRODUCT_CNT
            FROM 
                '.$table.'    	    AS BI LEFT JOIN
                dev.ORDERSHEET_MST	AS OM 
            ON
                BI.IDX = OM.'.$col_name.'
            WHERE
                '.$where.'
            GROUP BY 
                BI.IDX
            '.$having.'
            ORDER BY 
                '.$order;

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
}


?>