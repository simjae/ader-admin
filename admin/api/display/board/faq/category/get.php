<?php
/*
 +=============================================================================
 | 
 | FAQ 상세 카테고리 조회 API
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.07.25
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

/** 변수 정리 **/
$category_idx		= $_POST['category_idx'];				//IDX

$where = ' 1=1 ';


$sql = "
        SELECT 
            IDX,
            SEQ,
            FATHER_NO,
            LANG,
            TITLE
        FROM 
            dev.FAQ_CATEGORY
        WHERE 
            FATHER_NO = ".$category_idx."
        AND 
            STATUS = 'Y'
        ORDER BY 
            SEQ ASC;
";
$db->query($sql);
foreach($db->fetch() as $data){
    $json_result['data'][] = array(
        'idx'           => $data['IDX'],
        'seq'           => $data['SEQ'],
        'father_no'     => $data['FATHER_NO'],
        'lang'          => $data['LANG'],
        'title'         => $data['TITLE']
    );
}
?>