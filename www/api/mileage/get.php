<?php
/*
 +=============================================================================
 | 
 | 회원별 마일리지 정보 취득 API
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.01.02
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 |            
 | 
 +=============================================================================
*/

$country = null;
if (isset($_SESSION['COUNTRY'])) {
	$country = $_SESSION['COUNTRY'];
}

$member_idx = 0;
if (isset($_SESSION['MEMBER_IDX'])) {
	$member_idx = $_SESSION['MEMBER_IDX'];
}

if($country == null || $member_idx == null || $member_idx <= 0){
    $result = false;
    $code	= 401;
    $msg = '로그인 후 다시 시도해주세요';
}
else{
    $mileage_balance = 0;
    $sql =
        "SELECT 
                IFNULL(MILEAGE_BALANCE, 0 ) AS MILEAGE_BALANCE 
            FROM
                MILEAGE_INFO  	MI	RIGHT JOIN
                (SELECT
                    COUNTRY,
                    MEMBER_IDX,
                    MAX(IDX)	AS MAX_IDX
                FROM
                    MILEAGE_INFO
                GROUP BY 
                    MEMBER_IDX,
                    COUNTRY)		RESENT_INFO
            ON
                MI.IDX = RESENT_INFO.MAX_IDX
            AND MI.COUNTRY = RESENT_INFO.COUNTRY
            WHERE
                RESENT_INFO.COUNTRY = '" .$country. "'
            AND
                RESENT_INFO.MEMBER_IDX = ".$member_idx." ";

    $db->query($sql);
    foreach ($db->fetch() as $data) {
        $mileage_balance = $data['MILEAGE_BALANCE'];
    }

    $json_result['data'] = $mileage_balance;
}

?>