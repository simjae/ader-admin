<?php
/*
 +=============================================================================
 | 
 | 해외통관정보 삭제
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.02.24
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$sel_idx          = $_POST['sel_idx'];

if($sel_idx != null){
    $custom_clearance_cnt = $db->count('SHOP_PRODUCT', ' CLEARANCE_IDX = '.$sel_idx.' ');

    if($custom_clearance_cnt == 0){
        $delete_query = "
            DELETE FROM CUSTOM_CLEARANCE
            WHERE IDX = ".$sel_idx."
        ";

        $db->query($delete_query);
    }
    else{
        $code = 301;
        $msg = '선택한 해외통관정보를 사용중인 상품이 있습니다.';    
    }
}
else{
    $code = 301;
    $msg = '선택한 해외통관정보가 올바르지 않습니다. 다시 선택해주세요';
}

?>