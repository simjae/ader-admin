<?php
/*
 +=============================================================================
 | 
 | 생일바우처 정보취득 API
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.01.13
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

/** 변수 정리 **/
$country                = $_POST['country'];

if($country != null){
    $sql = "
        SELECT 
            IDX,
            DATE_AGO_PARAM,
            DATE_LATER_PARAM
        FROM
            VOUCHER_MST
        WHERE
            COUNTRY = '".$country."'
        AND
            VOUCHER_TYPE = 'BR'
    ";

    $db->query($sql);

    foreach($db->fetch() as $data){
        $json_result['data'] = array(
            'voucher_idx' => $data['IDX'],
            'date_ago_param' => $data['DATE_AGO_PARAM'],
            'date_later_param' => $data['DATE_LATER_PARAM']
        );
    }
}
else{
    $json_result['code'] = 301;
    $json_result['msg'] = '생일 바우처 API가 실행되지 못했습니다.';
}


?>