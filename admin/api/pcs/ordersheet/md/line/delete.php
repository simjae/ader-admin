<?php
/*
 +=============================================================================
 | 
 | 라인 삭제
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.10.12
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$sel_idx        = $_POST['sel_idx'];

$product_cnt = null;
$product_cnt = $db->count('ORDERSHEET_MST', "LINE_IDX = ".$sel_idx );

if($product_cnt == 0){
    $sql = 	'
        DELETE FROM
            LINE_INFO
        WHERE
            IDX = '.$sel_idx.'
    ';

    $db->query($sql);
}
else if($product_cnt > 1){
    $code = 300;
    $msg = '이미 사용중인 상품이 있는 라인은 삭제할 수 없습니다.';
}

?>