<?php
/*
 +=============================================================================
 | 
 | 마이페이지 정보 취득
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

$country    = $_POST['country'];

$member_idx = 0;
if (isset($_SESSION['MEMBER_IDX'])) {
	$member_idx = $_SESSION['MEMBER_IDX'];
}

if($member_idx > 0 && isset($country)){
    $member_sql = "
        SELECT
            MEMBER.IDX,
            MEMBER.MEMBER_NAME,
            MEMBER.MEMBER_ID,
            (SELECT 
                MILEAGE_BALANCE 
            FROM 
                dev.MILEAGE_INFO
            WHERE 
                MEMBER_IDX = MEMBER.IDX
            ORDER BY 
                IDX DESC 
            LIMIT
                1 ) AS MILEAGE_BALANCE_TOTAL,
            (SELECT
                COUNT(0)
            FROM 
                dev.VOUCHER_ISSUE
            WHERE
                MEMBER_IDX = MEMBER.IDX 
            AND
                DEL_FLG = FALSE
            AND
                VOUCHER_ADD_DATE IS NOT NULL
            AND
                USED_FLG = FALSE
            AND
                USABLE_END_DATE > NOW()) AS VOUCHER_CNT
        FROM
            MEMBER_".$country." MEMBER
        WHERE
            IDX = ".$member_idx."
    ";

    $db->query($member_sql);

    foreach($db->fetch() as $data){
        $json_result['data'][] = array(
            'member_idx'        => $data['IDX'],
            'member_id'         => $data['MEMBER_ID'],
            'member_name'       => $data['MEMBER_NAME'],
            'mileage_balance_total'   => $data['MILEAGE_BALANCE_TOTAL'],
            'voucher_cnt'       => $data['VOUCHER_CNT']
        );
    }
}
else{
    $json_result['code'] = 302;
    $json_result['msg'] = '로그인 정보가 없습니다.';
}

?>