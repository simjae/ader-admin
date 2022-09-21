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
$board_idx     = $_POST['board_idx'];
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
                $table = " dev.DISPLAY_BOARD_REVIEW ";
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

if ($action_type != null) {
    switch($action_type){
        case 'delete':
            $sql = "
                UPDATE ".$table."
                SET
                    DEL_FLG = 1,
                    UPDATE_DATE = NOW(),
                    UPDATER = 'Admin'
                WHERE
                    ".$where."
            ";
            break;
        case 'fix_set':
            $sql = "
                UPDATE ".$table."
                SET
                    FIX_FLG = 1,
                    UPDATE_DATE = NOW(),
                    UPDATER = 'Admin'
                WHERE
                    ".$where."
            ";
            break;
        case 'fix_non':
            $sql = "
                UPDATE ".$table."
                SET
                    FIX_FLG = 0,
                    UPDATE_DATE = NOW(),
                    UPDATER = 'Admin'
                WHERE
                    ".$where."
            ";
            break;
        case 'non_hidden':
            if($tab_num == '02' && $subtab_num != '01'){
                switch($subtab_num){
                    case '02':
                        $set = " DISPLAY_FLG = 1,
                                 UPDATE_DATE = NOW(),
                                 UPDATER = 'Admin' ";
                        break;
                    case '03':
                        $set = " EXPOSURE_FLG = 1 
                                 UPDATE_DATE = NOW(),
                                 UPDATER = 'Admin'";
                        $where = "
                            IDX IN (SELECT 
                                        REVIEW_IDX 
                                    FROM 
                                        dev.DISPLAY_BOARD_REVIEW 
                                    WHERE 
                                        IDX IN (".$idx_list.")
                        ";
                        break;
                }
                $sql = "
                    UPDATE ".$table."
                    SET
                        ".$set."
                    WHERE
                        ".$where."
                ";
            }
            else{
                $sql = "
                    UPDATE ".$table."
                    SET
                        EXPOSURE_FLG = 1,
                        UPDATE_DATE = NOW(),
                        UPDATER = 'Admin'   
                    WHERE
                        ".$where."
                ";
            }
            break;
        case 'hidden':
            if($tab_num == '02' && $subtab_num != '01'){
                switch($subtab_num){
                    case '02':
                        $set = " DISPLAY_FLG = 0,
                                 UPDATE_DATE = NOW(),
                                 UPDATER = 'Admin' ";
                        break;
                    case '03':
                        $set = " EXPOSURE_FLG = 0
                                 UPDATE_DATE = NOW(),
                                 UPDATER = 'Admin' ";
                        $where = "
                            IDX IN (SELECT 
                                        REVIEW_IDX 
                                    FROM 
                                        dev.DISPLAY_BOARD_REVIEW 
                                    WHERE 
                                        IDX IN (".$idx_list.")
                        ";
                        break;
                }
                $sql = "
                    UPDATE ".$table."
                    SET
                        ".$set."
                    WHERE
                        ".$where."
                ";
            }
            else{
                $sql = "
                    UPDATE ".$table."
                    SET
                        EXPOSURE_FLG = 0,
                        UPDATE_DATE = NOW(),
                        UPDATER = 'Admin'
                    WHERE
                        ".$where."
                ";
            }
            break;
    }
    $db->query($sql);
}
?>