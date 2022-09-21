<?php
/*
 +=============================================================================
 | 
 | 알림메세지 저장 API
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.09.07
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$alarm_condition		= $_POST['alarm_condition'];

$alarm_message			= $_POST['alarm_message'];
$country		        = $_POST['country'];


if($alarm_condition != null && $alarm_message != null){
    
    if (is_array($alarm_condition) && is_array($alarm_message)) {
        for ($i=0; $i<count($alarm_condition); $i++) {
            if($alarm_message[$i] != null ){
                $sql = "
                    UPDATE 
                        dev.ALARM_INFO
                    SET
                        ALARM_MESSAGE = '".addslashes($alarm_message[$i])."'
                    WHERE
                        ALARM_CONDITION = '".$alarm_condition[$i]."'
                ";
                if($country != null){
                    $sql .= " AND COUNTRY = '".$country."' ";
                }
                $db->query($sql);
            }
        }
    }
    else{
        $sql = "
            UPDATE 
                dev.ALARM_INFO
            SET
                ALARM_MESSAGE = '".addslashes($alarm_message)."'
            WHERE
                ALARM_CONDITION = '".$alarm_condition."'
        ";
        if($country != null){
            $sql .= " AND COUNTRY = '".$country."' ";
        }
        $db->query($sql);
    }
}
?>