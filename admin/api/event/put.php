<?php
/*
 +=============================================================================
 | 
 | 이벤트 삭제 버튼 엑션 API
 | -----------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.08.23
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

/** 변수 정리 **/
$event_info_idx         = $_POST['event_info_idx'];
$sel_event_info_idx     = $_POST['sel_event_info_idx'];
$action_type            = $_POST['action_type'];

$event_idx              = $_POST['event_idx'];
$event_title            = $_POST['event_title'];
$event_always			= $_POST['event_always'];
$sdate             		= $_POST['sdate'];
$edate           		= $_POST['edate'];
$display_flg            = $_POST['display_flg'];
$status                 = $_POST['status'];
$winner_cnt             = $_POST['winner_cnt'];
$random_flg             = $_POST['random_flg'];
$apply_product_cnt      = $_POST['apply_product_cnt'];
$alarm_flg              = $_POST['alarm_flg'];
$excel_print_flg        = $_POST['excel_print_flg'];



if ($action_type != null) {
    $where = " 1=1 ";
    $idx_list="";
    if ($event_info_idx != null) {
        $idx_list = implode(',',$event_info_idx);
        $where .= " AND IDX IN (".$idx_list.")";
    }
    else if ($sel_event_info_idx != null) {
        $where .= " AND IDX = ".$sel_event_info_idx."";
    }
    switch($action_type){
        case 'event_info_delete':
            $sql = "
                UPDATE dev.EVENT_INFO
                SET
                    DEL_FLG = TRUE,
                    LINPUT_DATE = NOW()
                WHERE
                    ".$where."
            ";
            break;
    }
    $db->query($sql);
}
else if($event_idx  != null){
    $event_start_date = "";
    $event_end_date = "";
    
    if ($event_always == "true") {
        $sdate = "NOW()";
        $edate = "'9999-12-31 23:59'";
    } else {
        $sdate = 'STR_TO_DATE("'.$sdate.'","%Y-%m-%d %H:%i")';
        $edate = 'STR_TO_DATE("'.$edate.'","%Y-%m-%d %H:%i")';
    }
    
    $winner_cnt_str = 'NULL';
    if($winner_cnt != null){
        $winner_cnt_str = $winner_cnt;
    }
    $sql = "
        UPDATE dev.EVENT_INFO 
        SET
            EVENT_TITLE = '".$event_title."',
            SDATE = ".$sdate.",
            EDATE = ".$edate.",
            DISPLAY_FLG = ".$display_flg.",
            STATUS = '".$status."',
            WINNER_CNT = ".$winner_cnt_str.",
            RANDOM_FLG = ".$random_flg.",
            APPLY_PRODUCT_CNT = ".$apply_product_cnt.",
            ALARM_FLG = ".$alarm_flg.",
            EXCEL_PRINT_FLG = ".$excel_print_flg.",
            LINPUT_DATE = NOW()
        WHERE
            IDX = ".$event_idx."
        ";
    
    $db->query($sql);
    
}
?>