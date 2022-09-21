<?php
/*
 +=============================================================================
 | 
 | 운영자 상태 변경
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.07.12
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
	$idx_arr        = $_POST['adminMemberListIdx'];
    $action_name    = $_POST['action_name'];
    $action_type    = $_POST['action_type'];
    $where_values   = array();
    
    if($idx_arr != null && count($idx_arr) != 0){
        foreach($idx_arr as $val){
            $idx_list .= $val.',';
        }
    }
    $where = ' IDX IN ('.substr($idx_list, 0, -1).')';
    $set   = " STATUS = '".$action_name."' ";

    $sql = " UPDATE
                dev.ADMINISTRATOR
             SET
                ".$set."
             WHERE
                ".$where."
            ";
    
    if ($action_type == "status_set") {
        $db->query($sql);
    }
?>