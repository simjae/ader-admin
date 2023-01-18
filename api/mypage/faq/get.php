<?php
/*
 +=============================================================================
 | 
 | FAQ 카테고리 취득 api
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.01.09
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$country = NULL;
if(isset($_POST['country'])){
    $country = $_POST['country'];
}

$category_no = NULL;
if(isset($_POST['category_no'])){
    $category_no = $_POST['category_no'];
}

$keyword = NULL;
if(isset($_POST['keyword'])){
    $keyword = $_POST['keyword'];
}

if($country != null && ($category_no != null || $keyword != null)){
    $where = '';
    if($category_no != NULL){
        $where .= '(FC.IDX = '.$category_no.' OR FC.FATHER_NO = '.$category_no.')';
    }
    else if($keyword != NULL){
        $where .= '(FAQ.QUESTION LIKE "%'.$keyword.'%" OR FC.TITLE LIKE "%'.$keyword.'%" OR FAQ.ANSWER LIKE "%'.$keyword.'%")';
    }
    $sql = "
            SELECT 
                FAQ.IDX,
                FAQ.SEQ,
                FAQ.CATEGORY_NO,
                FAQ.SUBCATEGORY,
                FAQ.QUESTION,
                FAQ.ANSWER,
                FC.TITLE
            FROM 
                dev.FAQ  FAQ	LEFT JOIN
                dev.FAQ_CATEGORY FC
            ON
                FAQ.CATEGORY_NO = FC.IDX
            AND
                ".$where."
            WHERE
                FAQ.STATUS = 'Y'
            AND
                FC.IDX IS NOT NULL
            ORDER BY
                FAQ.CATEGORY_NO, FAQ.SEQ, FAQ.IDX;
    ";
    
    $db->query($sql);
    
    foreach($db->fetch() as $data){
        $json_result['data'][] = array(
            'idx'               => $data['IDX'],
            'seq'               => $data['SEQ'],
            'category_no'       => $data['CATEGORY_NO'],
            'subcategory'       => $data['SUBCATEGORY'],
            'question'          => $data['QUESTION'],
            'answer'            => $data['ANSWER'],
            'title'            => $data['TITLE']
        );
    }
}
else{
    $json_result['code'] = 300;
    $json_result['msg'] = 'FAQ 목록을 불러오는데 실패했습니다.';
}

?>