<?php
/*
 +=============================================================================
 | 
 | 카테고리별 해외통관 리스트
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.03.5
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$no = $_POST['no'];
$clearance_idx = $_POST['clearance_idx'];

$where = "1=1";


if($no != null){
    $get_idx_sql = "
        SELECT
            IDX
        FROM 
            CUSTOM_CLEARANCE
        WHERE
            CATEGORY_IDX = ".$no.";
    ";
    $db->query($get_idx_sql);

    $clearance_idx_arr = array();
    foreach($db->fetch() as $idx_data){
        $clearance_idx_arr[] = $idx_data['IDX'];
    }

    if(count($clearance_idx_arr) > 0){
        $where .= " AND IDX IN (".implode(',',$clearance_idx_arr).") ";
    }

    $get_sql = "
        SELECT
            IDX,
            CATEGORY_CODE,
            CATEGORY_NAME,
            CATEGORY_IDX,
            HS_CODE
        FROM
            CUSTOM_CLEARANCE
        WHERE
            ".$where."
    ";

    $db->query($get_sql);

    foreach($db->fetch() as $data){
        $json_result['data'][] = array(
            'idx'           => $data['IDX'],
            'category_code' => $data['CATEGORY_CODE'],
            'category_name' => $data['CATEGORY_NAME'],
            'category_idx'  => $data['CATEGORY_IDX'],
            'hs_code'       => $data['HS_CODE']
        );
    }
}
else if($clearance_idx != null){
    $set_hs_code_sql = "
        SELECT
            HS_CODE
        FROM
            CUSTOM_CLEARANCE
        WHERE
            IDX = ".$clearance_idx."
    ";

    $db->query($set_hs_code_sql);

    foreach($db->fetch() as $data){
        $json_result['data'] = $data['HS_CODE'];
    }
}
else{
    $json_result['code'] = 301 ;
    $json_result['msg'] = '비정상적인 접근입니다.';
    return $json_result;
}
?>