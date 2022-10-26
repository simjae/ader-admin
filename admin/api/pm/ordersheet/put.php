<?php
/*
 +=============================================================================
 | 
 | 오더시트 상태변경
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
            ORDERSHEET_UPDATE_FLG = !ORDERSHEET_UPDATE_FLG
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
                'U',
                OM.PRODUCT_CODE,
                OM.PRODUCT_NAME,
                CASE 
                    WHEN ORDERSHEET_UPDATE_FLG = TRUE 
                    THEN CONCAT('[',OM.PRODUCT_CODE,'] ',IFNULL(OM.PRODUCT_NAME,''),'의 오더시트 상태가 [작성 완료]로 변경되었습니다.')
                    WHEN ORDERSHEET_UPDATE_FLG = FALSE
                    THEN CONCAT('[',OM.PRODUCT_CODE,'] ',IFNULL(OM.PRODUCT_NAME,''),'의 오더시트 상태가 [작성 중]으로 변경되었습니다.') 
                END     AS HISTORY_MSG,
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