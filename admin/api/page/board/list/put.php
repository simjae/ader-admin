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

include_once("/var/www/admin/api/common/common.php");

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
/** 변수 정리 **/
$session_id		= sessionCheck();
$country        = $_POST['country'];
$board_idx      = $_POST['board_idx'];
$action_type    = $_POST['action_type'];
$tab_status     = $_POST['tab_status'];

$db->begin_transaction();
try {
    $where = " 1=1 ";
 
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
    }
    
    $set = "
            ".$flg_set.",
            UPDATE_DATE = NOW(),
            UPDATER = '".$session_id."'
    ";
    $sql = "
        UPDATE 
            PAGE_BOARD
        SET
            ".$set."
        WHERE
            ".$where."
    ";
    $db->query($sql);

    if($tab_status == 'NTC' && $action_type == 'delete'){
        $new_display_num = 1;
        $display_new_sql = "
            SELECT
                BOARD.IDX
            FROM
            	PAGE_BOARD BOARD
            WHERE
                BOARD_TYPE = '".$tab_status."' AND
                COUNTRY = '".$country."' AND
                DEL_FLG = FALSE
        ";
        $db->query($display_new_sql);
        foreach($db->fetch() as $new_display_info){
            $db->query('UPDATE PAGE_BOARD SET DISPLAY_NUM = '.$new_display_num.' WHERE IDX = '.$new_display_info['IDX'].' ');
            $new_display_num++;
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