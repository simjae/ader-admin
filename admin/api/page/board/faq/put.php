<?php
/*
 +=============================================================================
 | 
 | FAQ 수정
 | -----------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.03.02
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

/** 변수 정리 **/
$faq_seq_flg        = $_POST['faq_seq_flg'];
$faq_idx_arr        = $_POST['faq_idx_list'];
$faq_idx            = $_POST['faq_idx'];
$question           = $_POST['question'];
$answer             = $_POST['answer'];

if($faq_seq_flg != null && $faq_seq_flg == true){
    if(is_array($faq_idx_arr)){
        $seq = 1;
        foreach($faq_idx as $faq_idx){
            $update_sql = "
                UPDATE FAQ
                SET
                    SEQ = ".$seq++."
                WHERE
                    IDX = ".$faq_idx."
            ";

            $db->query($update_sql);
        }
    }
}
else if($faq_idx != null){
    $update_sql = "
        UPDATE
            FAQ
        SET
            QUESTION = '".$question."',
            ANSWER = '".$answer."'
        WHERE
            IDX = ".$faq_idx."
    ";
    $db->query($update_sql);
}
?>