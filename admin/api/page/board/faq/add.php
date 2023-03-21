<?php
/*
 +=============================================================================
 | 
 | FAQ 등록
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
$subcategory_idx    = $_POST['subcategory_idx'];
$question           = $_POST['question'];
$answer             = $_POST['answer'];
$answer	            = str_replace("<p>&nbsp;</p>","",$answer);

$sql = "
        INSERT FAQ(
            SEQ,
            CATEGORY_NO,
            SUBCATEGORY,
            QUESTION,
            ANSWER,
            STATUS,
            REG_DATE
        )
        SELECT
            IFNULL(MAX(FAQ.SEQ) + 1, 1),
            FC.IDX,
            FC.TITLE,
            '".$question."',
            '".$answer."',
            'Y',
            NOW()
        FROM
            FAQ_CATEGORY FC LEFT JOIN
            FAQ  FAQ 
        ON
            FAQ.CATEGORY_NO = FC.IDX
        WHERE
            FC.IDX = ".$subcategory_idx."
";
$db->query($sql);

?>