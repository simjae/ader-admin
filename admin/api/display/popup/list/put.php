<?php
/*
 +=============================================================================
 | 
 | 팝업 리스트 버튼 엑션 API
 | -----------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.08.12
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

include_once("/var/www/admin/api/common/common.php");

$session_id		= sessionCheck();

/** 변수 정리 **/
$popup_idx      = $_POST['popup_idx'];
$action_type    = $_POST['action_type'];

$where = " 1=1 ";
$idx_list="";
if ($popup_idx != null) {
	$idx_list = implode(',',$popup_idx);
	$where .= " AND IDX IN (".$idx_list.")";
}

if ($action_type != null) {
	$update_popup_sql = "";
    switch($action_type){
        case 'popup_delete':
            $update_popup_sql = "
                UPDATE
					dev.DISPLAY_POPUP
                SET
                    DEL_FLG = TRUE,
                    UPDATE_DATE = NOW(),
                    UPDATER = '".$session_id."'
                WHERE
                    ".$where."
            ";
            break;
        
		case 'display_set':
            $update_popup_sql = "
                UPDATE
					dev.DISPLAY_POPUP
                SET
                    DISPLAY_FLG = TRUE,
                    UPDATE_DATE = NOW(),
                    UPDATER = '".$$session_id."'
                WHERE
                    ".$where."
            ";
            break;
        
		case 'non_display_set':
            $update_popup_sql = "
                UPDATE
					dev.DISPLAY_POPUP
                SET
                    DISPLAY_FLG = FALSE,
                    UPDATE_DATE = NOW(),
                    UPDATER = '".$session_id."'
                WHERE
                    ".$where."
            ";
            break;
    }
	
    $db->query($update_popup_sql);
}
?>