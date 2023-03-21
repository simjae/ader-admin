<?php
/*
 +=============================================================================
 | 
 | 이벤트 참가자 로우데이터 수정
 | -----------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.03.05
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

/** 변수 정리 **/
$event_idx = $_POST['event_idx'];
$raw_data = $_POST['raw_data'];
$raw_data = str_replace("'",'"',$raw_data);
$update_sql = "
    UPDATE dev.EVENT
    SET
        RAW_DATA = '".str_replace("<p>&nbsp;</p>","",$raw_data)."',
        LINPUT_DATE = NOW()
    WHERE
        IDX = ".$event_idx."
";
$db->query($update_sql);

?>