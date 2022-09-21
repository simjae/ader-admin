<?php
/*
 +=============================================================================
 | 
 | 이벤트 참가자 삭제 버튼 엑션 API
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
$sel_event_idx = $_POST['sel_event_idx'];

$where = " 1=1 ";

if ($sel_event_idx != null) {
	$where .= " AND IDX = ".$sel_event_idx." ";
}

$sql = "
    UPDATE dev.EVENT
    SET
        DEL_FLG = TRUE,
        LINPUT_DATE = NOW()
    WHERE
        ".$where."
";
$db->query($sql);

?>