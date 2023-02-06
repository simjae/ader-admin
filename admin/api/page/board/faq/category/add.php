<?php
/*
 +=============================================================================
 | 
 | 게시판 글목록 일괄선택 후 엑션 API
 | -----------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.08.05
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

/** 변수 정리 **/
$category_flg       = $_POST['category_flg'];
$title              = $_POST['title'];
$category_idx       = $_POST['category_idx'];
$subcategory        = $_POST['subcategory'];

if($category_flg == 'true'){
    $max_seq_sql = "
            SELECT
                MAX(SEQ)    AS MAX_SEQ
            FROM
                dev.FAQ_CATEGORY
            WHERE 
                FATHER_NO = 0
    ";
    $db->query($max_seq_sql);
    foreach($db->fetch() as $data){
        $max_seq = $data['MAX_SEQ'];
    }
    if($max_seq != null){
        $max_seq++;
    }
    else{
        $max_seq = 1;
    }
    $sql = "
            INSERT dev.FAQ_CATEGORY(
                SEQ,
                FATHER_NO,
                LANG,
                TITLE,
                STATUS,
                REG_DATE
            )
            VALUES(
                ".$max_seq.",
                0,
                'KR',
                '".$title."',
                'Y',
                NOW()
            ) 
    ";
    $db->query($sql);
}
else if($category_flg == 'false'){
    $max_seq_sql = "
            SELECT
                MAX(SEQ)    AS MAX_SEQ
            FROM
                dev.FAQ_CATEGORY
            WHERE 
                FATHER_NO = ".$category_idx."
    ";
    $db->query($max_seq_sql);
    foreach($db->fetch() as $data){
        $max_seq = $data['MAX_SEQ'];
    }
    if($max_seq != null){
        $max_seq++;
    }
    else{
        $max_seq = 1;
    }
    $sql = "
            INSERT dev.FAQ_CATEGORY(
                SEQ,
                FATHER_NO,
                LANG,
                TITLE,
                STATUS,
                REG_DATE
            )
            VALUES(
                ".$max_seq.",
                ".$category_idx.",
                'KR',
                '".$subcategory."',
                'Y',
                NOW()
            ) 
    ";
    $db->query($sql);
}
?>