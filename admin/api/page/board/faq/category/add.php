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
$category_idx       = $_POST['category_idx'];
$subcategory        = $_POST['subcategory'];


if($category_idx != null && $subcategory != null){
    $regist_sql = "
        INSERT INTO FAQ_CATEGORY
        (
            SEQ,
            FATHER_NO,
            LANG,
            TITLE,
            STATUS,
            REG_DATE
        )
        SELECT
            IFNULL(MAX(SEQ), 1),
            ".$category_idx.",
            (SELECT LANG FROM FAQ_CATEGORY WHERE IDX = ".$category_idx."),
            '".$subcategory."',
            'Y',
            NOW()
        FROM
            FAQ_CATEGORY
        WHERE
            FATHER_NO = ".$category_idx."
    ";
    $db->query($regist_sql);
}
?>