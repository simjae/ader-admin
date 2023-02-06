<?php
/*
 +=============================================================================
 | 
 | 게시판 글목록 일괄선택 후 엑션 API
 | -----------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.08.05
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
/** 변수 정리 **/
$board_idx      = $_POST['board_idx'];
$action_type    = $_POST['action_type'];
$tab_num        = $_POST['tab_num'];
$subtab_num     = $_POST['subtab_num'];

$db->begin_transaction();
try {
    $where = " 1=1 ";
    if($tab_num != null && $subtab_num != null){
        if($tab_num == '02'){
            switch($subtab_num){
                case '01':
                    $table = " dev.BOARD_REVIEW ";
                    break;
                case '02':
                    $table = " dev.BOARD_REVIEW_REPLY ";
                    break;
                case '03':
                    $table = " dev.BOARD_REPORT ";
                    break;
            }
        }
        else{
            $table = " dev.PAGE_BOARD ";
        }
    }
    
    $idx_list="";
    if ($board_idx != null) {
        $idx_list = implode(',',$board_idx);
        $where .= " AND IDX IN (".$idx_list.")";
    }
    
    switch($action_type){
        case 'mlieage_set':
            $flg_set = "MILEAGE_FLG = TRUE";
            break;
        case 'delete':
            $flg_set = "DEL_FLG = TRUE";
            break;
        case 'fix_set':
            $flg_set = "FIX_FLG = TRUE";
            break;
        case 'fix_non':
            $flg_set = "FIX_FLG = FALSE";
            break;
        case 'hidden':
            if($subtab_num == '01'){
                $flg_set = "EXPOSURE_FLG = TRUE";
            }
            else if($subtab_num == '02'){
                $flg_set = "DISPLAY_FLG = TRUE";
            }
            else if($subtab_num == '03'){
                $flg_set = "PROCESSING_FLG = TRUE";
            }
            break;
        case 'non_hidden':
            if($subtab_num == '01'){
                $flg_set = "EXPOSURE_FLG = FALSE";
            }
            else if($subtab_num == '02'){
                $flg_set = "DISPLAY_FLG = FALSE";
            }
            else if($subtab_num == '03'){
                $flg_set = "PROCESSING_FLG = TRUE";
            }
            break;
    }
    
    $set = "
            ".$flg_set.",
            UPDATE_DATE = NOW(),
            UPDATER = 'Admin'
    ";
    $sql = "
        UPDATE 
            ".$table."
        SET
            ".$set."
        WHERE
            ".$where."
    ";
    $db->query($sql);
    
    if($tab_num == '02'){
        if($action_type == 'mlieage_set'){
            foreach($board_idx as $idx){
                $mileage_sql = "
                    INSERT INTO dev.MILEAGE_INFO(
                        ID,
                        MILEAGE_CODE,
                        MILEAGE_UNUSABLE,
                        MILEAGE_USABLE_INC,
                        MILEAGE_USABLE_DEC,
                        MILEAGE_BALANCE,
                        MANAGER,
                        ORDERNUM,
                        MILEAGE_USABLE_DATE_INFO,
                        MILEAGE_USABLE_DATE,
                        CREATE_DATE,
                        CREATER,
                        UPDATER,
                        UPDATE_DATE
                    )
                    SELECT
                        BR.MEMBER_ID,
                        'R',
                        0,
                        BR.MILEAGE,
                        0,
                        BR.MILEAGE
                        +
                        IFNULL((SELECT     
                                    MI.MILEAGE_BALANCE 
                                FROM 
                                    dev.MILEAGE_INFO    MI
                                WHERE
                                    MI.MEMBER_IDX = BR.MEMBER_IDX
                                ORDER BY 
                                    IDX DESC
                                LIMIT 1) 
                            ,0
                        ),
                        'Admin',
                        BR.ORDER_CODE,
                        NULL,
                        NULL,
                        NOW(),
                        'Admin',
                        NOW(),
                        'Admin'
                    FROM
                        dev.BOARD_REVIEW        BR
                    WHERE
                        ".$where."
                    AND
                        BR.MILEAGE_FLG = FALSE
                    AND
                        BR.DEL_FLG = FALSE
                "; 
                $db->query($mileage_sql);
            }
        }
        else if($subtab_num == '03'){
            if($action_type != null){
                switch($action_type){
                    case 'non_hidden':
                        $flg_str = 'false';
                        $status_code = 'UHB';
                        break;
                    case 'hidden':
                        $flg_str = 'true';
                        $status_code = 'HBD';
                        break;
                }
            }
            $report_idx_arr = array();
            $origin_sql = "
                    SELECT 
                        REPORT_DIVISION,
                        REPORT_IDX
                    FROM 
                        dev.BOARD_REPORT
                    WHERE 
                        ".$where."
            ";
            $db->query($origin_sql);
            
            foreach($db->fetch() as $data){
                if($data['REPORT_DIVISION'] == 'BOARD'){
                    $origin_table   = " dev.BOARD_REVIEW ";
                    $origin_set     = " EXPOSURE_FLG    = ".$flg_str.", 
                                        STATUS          = '".$status_code."' ";

                    $processing_sql = "
                        UPDATE  
                            dev.BOARD_REPORT
                        SET
                            PROCESSING_FLG = TRUE
                        WHERE
                            REPORT_IDX = ".$data['REPORT_IDX']."
                    ";
                    $db->query($processing_sql);
                }
                else if($data['REPORT_DIVISION'] == 'REPLY'){
                    $origin_table   = " dev.BOARD_REVIEW_REPLY ";
                    $origin_set     = "DISPLAY_FLG      = ".$flg_str." ";
                }
    
                $origin_put_sql = "
                    UPDATE 
                        ".$origin_table."
                    SET 
                        ".$origin_set."
                    WHERE
                        IDX = ".$data['REPORT_IDX']."
                ";
                $db->query($origin_put_sql);
            }
        }
    }

    $db->commit();
} catch(mysqli_sql_exception $exception){
    echo $exception->getMessage();
    $json_result['code'] = 301;
    $db->rollback();
    $msg = "등록작업에 실패했습니다.";
}


?>