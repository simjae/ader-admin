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
$event_info_idx     = $_POST['event_info_idx'];
$sel_event_info_idx = $_POST['sel_event_info_idx'];
$action_type        = $_POST['action_type'];

$where = " 1=1 ";
$idx_list="";
if ($event_info_idx != null) {
	$idx_list = implode(',',$event_info_idx);
	$where .= " AND IDX IN (".$idx_list.")";
}
else if ($sel_event_info_idx != null) {
	$where .= " AND IDX = ".$sel_event_info_idx."";
}

if ($action_type != null) {
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
?>