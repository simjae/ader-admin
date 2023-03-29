<?php
/*
 +=============================================================================
 | 
 | 해외통관정보 취득
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.02.24
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$category_code      = $_POST['category_code'];
$category_name      = $_POST['category_name'];
$hs_code            = $_POST['hs_code'];
$use_product_flg    = $_POST['use_product_flg']; 

$sort_type 			= $_POST['sort_type'];				//정렬 타입
$sort_value 		= $_POST['sort_value'];				//정렬 값

$rows               = $_POST['rows'];
$page               = $_POST['page'];

$where = " 1=1 ";

if($category_code != null){
    $where .= " AND CATEGORY_CODE LIKE '%".$category_code."%' ";
}

if($category_name != null){
    $where .= " AND CATEGORY_NAME LIKE '%".$category_name."%' ";
}

if($hs_code != null){
    $where .= " AND HS_CODE LIKE '%".$hs_code."%' ";
}

if($use_product_flg == "FALSE"){
    $where .= " AND (SELECT COUNT(0) FROM SHOP_PRODUCT WHERE CLEARANCE_IDX = CLN.IDX) = 0 ";
}
else if($use_product_flg == "TRUE"){
    $where .= " AND (SELECT COUNT(0) FROM SHOP_PRODUCT WHERE CLEARANCE_IDX = CLN.IDX) > 1 ";
}

/** 정렬 조건 **/
$order = '';
if ($sort_value != null && $sort_type != null) {
	$order = " ".$sort_value." ".$sort_type." ";
} else {
	$order = " IDX DESC";
}

$limit_start = (intval($page)-1)*$rows;
$json_result = array(
	'total' => $db->count('CUSTOM_CLEARANCE CLN ',$where),
	'total_cnt' => $db->count('CUSTOM_CLEARANCE CLN ',' 1=1 '),
	'page' => $page
);
$get_clearance_sql = "
    SELECT
        IDX,
        CATEGORY_CODE,
        CATEGORY_NAME,
        CATEGORY_IDX,
        HS_CODE,
        (SELECT COUNT(0) FROM SHOP_PRODUCT WHERE CLEARANCE_IDX = CLN.IDX) AS USE_PRODUCT_CNT
    FROM
        CUSTOM_CLEARANCE  CLN
    WHERE
        ".$where."
    ORDER BY
        ".$order."
    LIMIT
         ".$limit_start.",".$rows."
";
$db->query($get_clearance_sql);

foreach($db->fetch() as $data){
    $arr = array();
    $result_arr = get_category_list($data['CATEGORY_IDX'], $db, $arr);
    $arr_count = count($result_arr);
    $category_list_arr = array();
    
    for($i = 0; $i < $arr_count; $i++){
        array_push($category_list_arr,array_pop($result_arr));
    }
    
    $json_result['data'][] = array(
        'clearance_idx'         => $data['IDX'],
        'category_code'         => $data['CATEGORY_CODE'],
        'category_name'         => $data['CATEGORY_NAME'],
        'category_idx'          => $data['CATEGORY_IDX'],
        'product_category_list' => implode(' > ', $category_list_arr),
        'hs_code'               => $data['HS_CODE'],
        'use_product_cnt'       => $data['USE_PRODUCT_CNT']
    );
}


function get_category_list($idx, $db, $arr) {
    if($idx != null){
        $sql = "
            SELECT
                TITLE,
                FATHER_NO
            FROM
                MD_CATEGORY
            WHERE
                IDX = ".$idx."
        ";
        $db->query($sql);

        foreach($db->fetch() as $data) {
            $father_no = intval($data['FATHER_NO']);
            array_push($arr, $data['TITLE']);
            if($father_no > 0){
                $arr = get_category_list($data['FATHER_NO'], $db, $arr);
            }
        }
        return $arr;
    }
	else{
        return $arr;
    }
}
?>