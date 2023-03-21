<?php
/*
 +=============================================================================
 | 
 | 홀세일 등록 - 홀세일 검색창 자동완성 API
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.11.02
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$product_code			= $_POST['product_code'];
$product_name		    = $_POST['product_name'];

$sort_type 			    = $_POST['sort_type'];				//정렬 타입
$sort_value 		    = $_POST['sort_value'];				//정렬 값
$rows                   = $_POST['rows'];
$page                   = $_POST['page'];

$where = "1=1";
$where .= " AND DEL_FLG = FALSE ";
$where_cnt = $where;

if($product_code != null){
    $where .= " AND PRODUCT_CODE LIKE '%".$product_code."%' ";
}
if($product_name != null){
    $where .= " AND PRODUCT_NAME LIKE '%".$product_name."%' ";
}

/** 정렬 조건 **/
$order = '';
if ($sort_value != null && $sort_type != null) {
    $order = ' '.$sort_value." ".$sort_type." ";
} else {
    $order = ' IDX DESC';
}

$limit_start = (intval($page)-1)*$rows;
$total = $db->count("ORDERSHEET_MST",$where);
$total_cnt = $db->count("ORDERSHEET_MST",$where_cnt);

$json_result = array(
    'total' => $total,
    'total_cnt' => $total_cnt,
    'page' => $page
);

$sql = "
    SELECT
        IDX,
        STYLE_CODE,
        COLOR_CODE,
        PRODUCT_CODE,
        PRODUCT_NAME,
        COLOR
    FROM
        ORDERSHEET_MST
    WHERE
        ".$where."
    ORDER BY
        ".$order;

if ($rows != null) {
    $sql .= " LIMIT ".$limit_start.",".$rows;
}

$db->query($sql);

foreach($db->fetch() as $data){
    $json_result['data'][] = array(
        'idx'               => $data['IDX'],
        'style_code'        => $data['STYLE_CODE'],
        'color_code'        => $data['COLOR_CODE'],
        'product_code'      => $data['PRODUCT_CODE'],
        'product_name'      => $data['PRODUCT_NAME'],
        'color'             => $data['COLOR']
    );
}
?>