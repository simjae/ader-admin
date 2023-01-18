<?php
/*
 +=============================================================================
 | 
 | 리오더 정보 변경
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.01.10
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 |            
 | 
 +=============================================================================
*/
$member_idx = NULL;
if(!isset($_SESSION['MEMBER_IDX'])){
    $json_result['code'] = 304;
    $json_result['msg'] = '비로그인 상태입니다.';
} 
else {
    $member_idx = $_SESSION['MEMBER_IDX'];
    $country = null;
    if (isset($_POST['country'])) {
        $country = $_POST['country'];
    }

    $no = null;
    if (isset($_POST['no'])) {
        $no = $_POST['no'];
    }

    $action_type = null;
    if (isset($_POST['action_type'])) {
        $action_type = $_POST['action_type'];
    }

    if ($country != null && $no != null && $action_type != null) {
        $set = '';
        if($action_type == 'cancel'){
            $set .= ' DEL_FLG = TRUE, '; 
        }
        else if($action_type == 're_apply'){
            $set .= ' DEL_FLG = FALSE, ';
        }
        $sql = " UPDATE 
                    dev.PRODUCT_REORDER
                SET
                    ".$set."
                    UPDATE_DATE = NOW(),
                    UPDATER = '".$member_id."'
                WHERE
                    IDX = ".$no."";

        $db->query($sql);
    }
}



?>