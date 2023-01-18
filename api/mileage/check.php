<?php
/*
+=============================================================================
| 
| 최대 마일리지 체크 API
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

$input_mileage = (int)$_POST['input_mileage'];

$mileage_balance = 0;
$sql =
        "SELECT 
            IFNULL(MILEAGE_BALANCE, 0 ) AS MILEAGE_BALANCE 
        FROM
            dev.MILEAGE_INFO  	MI	RIGHT JOIN
            (SELECT
                COUNTRY,
                MEMBER_IDX,
                MAX(IDX)	AS MAX_IDX
            FROM
                dev.MILEAGE_INFO
            GROUP BY 
                MEMBER_IDX,
                COUNTRY)		RESENT_INFO
        ON
            MI.IDX = RESENT_INFO.MAX_IDX
        AND MI.COUNTRY = RESENT_INFO.COUNTRY
        WHERE
            RESENT_INFO.COUNTRY = '" . $_SESSION['COUNTRY']."'
        AND
            RESENT_INFO.MEMBER_IDX = ".$_SESSION['MEMBER_IDX']." ";

$db->query($sql);
foreach ($db->fetch() as $data) {
    $mileage_balance = $data['MILEAGE_BALANCE'];
}
if($input_mileage > $mileage_balance){
    $input_mileage = $mileage_balance;
}

$json_result['data'] = $input_mileage;

?>