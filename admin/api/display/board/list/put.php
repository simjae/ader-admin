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

/** 변수 정리 **/
$board_idx      = $_POST['board_idx'];
$action_type    = $_POST['action_type'];
$tab_num        = $_POST['tab_num'];
$subtab_num     = $_POST['subtab_num'];

if($tab_num != null && $subtab_num != null){
    if($tab_num == '02'){
        switch($subtab_num){
            case '01':
                $table = " dev.DISPLAY_BOARD_REVIEW ";
                break;
            case '02':
                $table = " dev.DISPLAY_BOARD_REVIEW_REPLY ";
                break;
            case '03':
                $table = " dev.DISPLAY_BOARD_REPORT ";
                break;
        }
    }
    else{
        $table = " dev.DISPLAY_BOARD ";
    }
}


$where = " 1=1 ";
$idx_list="";
if ($board_idx != null) {
	$idx_list = implode(',',$board_idx);
	$where .= " AND IDX IN (".$idx_list.")";
}

if($tab_num == '02' && $subtab_num == '03'){
    if($action_type != null){
        switch($action_type){
            case 'non_hidden':
                $flg_str = 'true';
                $status_code = '0003';
                break;
            case 'hidden':
                $flg_str = 'false';
                $status_code = '0002';
                break;
        }
    }
    $report_idx_arr = array();
    $origin_sql = "
            SELECT 
                REPORT_DIVISION,
                REPORT_IDX
            FROM 
                dev.DISPLAY_BOARD_REPORT
            WHERE 
                ".$where."
    ";
    $db->query($origin_sql);
    
    foreach($db->fetch() as $data){
        if($data['REPORT_DIVISION'] != null && $data['REPORT_IDX'] != null){
            if($data['REPORT_DIVISION'] == 'BOARD'){
                $origin_table = " dev.DISPLAY_BOARD_REVIEW ";
                $origin_set = " EXPOSURE_FLG = ".$flg_str.", 
                                STATUS = '".$status_code."' ";
            }
            else if($data['REPORT_DIVISION'] == 'REPLY'){
                $origin_table = " dev.DISPLAY_BOARD_REVIEW_REPLY ";
                $origin_set = "DISPLAY_FLG = ".$flg_str." ";
            }
            $origin_put_sql = "
                UPDATE 
                    ".$origin_table."
                SET 
                    ".$origin_set."
                WHERE
                    IDX = ".$data['REPORT_IDX']."
            ";
            if(!isset($db2)){
                $db2 = new db();
            }
            $db2->query($origin_put_sql);
            array_push($report_idx_arr, $data['REPORT_IDX']);
        }
    }
    if ($report_idx_arr != null) {
        $report_idx_list = implode(',',$report_idx_arr);
        $set = " PROCESSING_FLG = 1, 
                 UPDATE_DATE = NOW(),
                 UPDATER = 'Admin'";
    }
    $sql = "UPDATE
                dev.DISPLAY_BOARD_REPORT
            SET
                ".$set."
            WHERE   
                ".$where."
            ";
}
else{
    if($action_type != null){
        if($action_type != 'mlieage_set'){
            switch($action_type){
                case 'delete':
                    $flg_set = "DEL_FLG = 1";
                    break;
                case 'fix_set':
                    $flg_set = "FIX_FLG = 1";
                    break;
                case 'fix_non':
                    $flg_set = "FIX_FLG = 0";
                    break;
                case 'hidden':
                    if($subtab_num != '01'){
                        $flg_set = "DISPLAY_FLG = 0";
                    }
                    else{
                        $flg_set = "EXPOSURE_FLG = 0";
                    }
                    break;
                case 'non_hidden':
                    if($subtab_num != '01'){
                        $flg_set = "DISPLAY_FLG = 1";
                    }
                    else{
                        $flg_set = "EXPOSURE_FLG = 1";
                    }
                    break;
            }
            if($flg_set != null){
                $set = "
                    ".$flg_set.",
                    UPDATE_DATE = NOW(),
                    UPDATER = 'Admin'
                ";
            }
            $sql = "
                UPDATE 
                    ".$table."
                SET
                    ".$set."
                WHERE
                    ".$where."
            ";
        }
        else if($action_type == 'mlieage_set'){
            foreach($board_idx as $idx){
                $mileage_balance = 0;
                $get_balance_sql = "
                    SELECT
                        MILEAGE_BALANCE
                    FROM
                        dev.MILEAGE_INFO
                    WHERE
                        IDX = 
                        (
                            SELECT
                                MAX(IDX) AS MAX_IDX
                            FROM
                                dev.MILEAGE_INFO
                            WHERE
                                ID = (
                                    SELECT
                                        CREATER
                                    FROM
                                        dev.DISPLAY_BOARD_REVIEW
                                    WHERE
                                        IDX = ".$idx."
                                    AND
                                        MILEAGE_FLG = FALSE
                                )
                        )
                ";
                $db->query($get_balance_sql);
                foreach($db->fetch() as $result){
                    $mileage_balance = $result['MILEAGE_BALANCE'];
                }
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
                        CREATER,
                        'R',
                        0,
                        MILEAGE,
                        0,
                        MILEAGE+".$mileage_balance.",
                        '',
                        ORDERNUM,
                        NULL,
                        NULL,
                        NOW(),
                        'Admin',
                        NOW(),
                        'Admin'
                    FROM
                        dev.DISPLAY_BOARD_REVIEW
                    WHERE
                        IDX = ".$idx."
                    AND
                        MILEAGE_FLG = FALSE
                    AND
                        DEL_FLG = FALSE
                "; 
                $db->query($mileage_sql);
            }
            $where .= 'AND DEL_FLG = FALSE';
            $sql = "
                UPDATE 
                    ".$table."
                SET
                    mileage_flg = 1
                WHERE
                    ".$where."
            ";
            $db->query($sql);
        }
    }
}

$db->query($sql);
?>