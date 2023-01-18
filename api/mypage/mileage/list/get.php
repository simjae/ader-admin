<?php
/*
 +=============================================================================
 | 
 | 마이페이지 마일리지 리스트 정보 취득
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.01.09
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$member_idx = NULL;
if(!isset($_SESSION['MEMBER_IDX'])){
    $json_result['code'] = 304;
    $json_result['msg'] = '비로그인 상태입니다.';
} 
else {
    $member_idx = $_SESSION['MEMBER_IDX'];
    $list_type = NULL;
    if(isset($_POST['list_type'])){
        $list_type = $_POST['list_type'];
    }

    $country = NULL;
    if(isset($_POST['country'])){
        $country = $_POST['country'];
    }

    if ($member_idx != NULL && $country != NULL && $list_type != NULL) {
        $where = "";
        switch($list_type){
            case 'total':
                break;
            case 'save':
                $where .= " WHERE MI.MILEAGE_USABLE_INC > 0";
                break;
            case 'use':
                $where .= " WHERE MI.MILEAGE_USABLE_DEC > 0";
                break;
        }
        
        $sql = "
            SELECT
                DATE_FORMAT(MI.UPDATE_DATE, '%Y.%m.%d') AS UPDATE_DATE,
                IFNULL(MI.ORDERNUM,'') AS ORDERNUM,
                ifnull(OI.PRICE_TOTAL,'') AS PRICE_TOTAL,
                MC.MILEAGE_TYPE,
                MI.MILEAGE_USABLE_INC,
                MI.MILEAGE_USABLE_DEC
            FROM
                (
                    SELECT 
                        *
                    FROM
                        dev.MILEAGE_INFO
                    WHERE
                        MEMBER_IDX = ".$member_idx."
                )                   MI
            LEFT JOIN
                dev.MILEAGE_CODE    MC
            ON
                MI.MILEAGE_CODE = MC.MILEAGE_CODE
            LEFT JOIN
                dev.ORDER_INFO      OI
            ON
                MI.ORDERNUM = OI.ORDER_CODE
            ".$where."
            ORDER BY
                MI.IDX DESC
        ";

        $db->query($sql);

        foreach($db->fetch() as $data){
            $json_result['data'][] = array(
                'update_date'           => $data['UPDATE_DATE'],
                'ordernum'              => $data['ORDERNUM'],
                'mileage_type'          => $data['MILEAGE_TYPE'],
                'price_total'           => $data['PRICE_TOTAL'],
                'mileage_usable_inc'    => $data['MILEAGE_USABLE_INC'],
                'mileage_usable_dec'    => $data['MILEAGE_USABLE_DEC']
            );
        }
    }
    else{
        $json_result['code'] = 301;
        $json_result['msg'] = 'api가 정상적으로 실행되지 못했습니다.';
    }
}


?>