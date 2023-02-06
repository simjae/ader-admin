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
$subcategory_idx    = $_POST['subcategory_idx'];
$question           = $_POST['question'];
$answer             = $_POST['answer'];
$answer	            = str_replace("<p>&nbsp;</p>","",$answer);

$max_seq_sql = "
        SELECT
            MAX(SEQ)    AS MAX_SEQ
        FROM
            dev.FAQ
        WHERE 
            CATEGORY_NO = ".$subcategory_idx."
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
        INSERT dev.FAQ(
            SEQ,
            CATEGORY_NO,
            SUBCATEGORY,
            QUESTION,
            ANSWER,
            STATUS,
            REG_DATE
        )
        VALUES(
            ".$max_seq.",
            ".$subcategory_idx.",
            (SELECT 
                TITLE
            FROM 
                dev.FAQ_CATEGORY
            WHERE
                IDX = ".$subcategory_idx."),
            '".$question."',
            '".$answer."',
            'Y',
            NOW()
        ) 
";
$db->query($sql);

?>