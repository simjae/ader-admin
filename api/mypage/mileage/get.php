<?php
/*
 +=============================================================================
 | 
 | 마이페이지 마일리지 현황정보 취득
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.01.11
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
else{
    $member_idx = $_SESSION['MEMBER_IDX'];

    $country = NULL;
    if(isset($_POST['country'])){
        $country = $_POST['country'];
    }

    if($member_idx != NULL && $country != NULL){
        $sql = "
            SELECT 
                IFNULL((SELECT 
                    MILEAGE_BALANCE 
                FROM 
                    MILEAGE_INFO 
                WHERE 
                    MEMBER_IDX = ".$member_idx."
                ORDER BY 
                    IDX DESC 
                LIMIT 1),0)	                        AS MILEAGE_BALANCE,
                IFNULL(SUM(PRICE_MILEAGE_POINT),0) 	AS REFUND_SCHEDULED,
                IFNULL(SUM(MILEAGE_USABLE_DEC),0)				AS USED_MILEAGE
            FROM
                dev .MILEAGE_INFO   MI
            LEFT JOIN
                dev.ORDER_INFO      OI
            ON
            MI.ORDERNUM = OI.ORDER_CODE
            AND
                OI.ORDER_STATUS = 'ORF'
            WHERE
                MI.COUNTRY = '".$country."'
            AND
                MI.MEMBER_IDX = ".$member_idx."
        ";

        $db->query($sql);

        foreach($db->fetch() as $data){
            $json_result['data'] = array(
                'mileage_balance' => $data['MILEAGE_BALANCE'],
                'refund_scheduled' => $data['REFUND_SCHEDULED'],
                'used_mileage' => $data['USED_MILEAGE'],
            );
        }
    }
    else{
        $json_result['code'] = 301;
        $json_result['msg'] = 'api가 정상적으로 실행되지 못했습니다.';
    }
}



?>