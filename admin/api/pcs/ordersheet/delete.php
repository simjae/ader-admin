<?php
/*
 +=============================================================================
 | 
 | 오더시트 삭제
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.10.12
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$ordersheet_idx_list     = $_POST['ordersheet_idx_list'];

$db->begin_transaction();
try {
    $sql = 	'
        UPDATE
            dev.ORDERSHEET_MST
        SET
            DEL_FLG = TRUE
        WHERE 
            IDX IN ('.implode(",", $ordersheet_idx_list).')
        ';

    $update_row_cnt = 0;

    $db->query($sql);

    $update_row_cnt = $db->mysqli_affected_rows();

    if($update_row_cnt == count($ordersheet_idx_list)){
        $history_sql = "
            INSERT INTO dev.ORDERSHEET_HISTORY
            (	
                ORDERSHEET_IDX,
                ORDERSHEET_AUTH,
                ACTION_TYPE,
                PRODUCT_CODE,
                PRODUCT_NAME,
                HISTORY_MSG,
                CREATE_DATE,
                CREATER
            )
            SELECT
                OM.IDX,
                'MD',
                'D',
                OM.PRODUCT_CODE,
                OM.PRODUCT_NAME,
                CONCAT('[',OM.PRODUCT_CODE,'] ',IFNULL(OM.PRODUCT_NAME,''),'의 오더시트가 삭제되었습니다.') AS HISTORY_MSG,
                NOW(),
                'Admin'
            FROM
                dev.ORDERSHEET_MST OM
            WHERE
                IDX IN (".implode(',', $ordersheet_idx_list).")
        ";
        $db->query($history_sql);
    }
    $db->commit();
} 
catch(mysqli_sql_exception $exception){
    $json_result['code'] = 300;
    $json_result['exception_msg'] = $exception;
    $db->rollback();
}

?>