<?php
/*
 +=============================================================================
 | 
 | 상품 사이즈별 치수정보
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.09.21
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$size_category = $_POST['size_category'];

$where = "1=1";

if ($size_category != null) {
	$where .= ' AND CATEGORY_NAME =  "'.$size_category.'" ';
} 
//검색 유형 - 디폴트
$sql = 	"SELECT
            IDX,
			CATEGORY_NAME,
            SIZE_TITLE_1,
            SIZE_TITLE_2,
            SIZE_TITLE_3,
            SIZE_TITLE_4,
            SIZE_TITLE_5,
            SIZE_TITLE_6,
            SIZE_DESC_1,
            SIZE_DESC_2,
            SIZE_DESC_3,
            SIZE_DESC_4,
            SIZE_DESC_5,
            SIZE_DESC_6
		FROM
			dev.SIZE_DESCRIPTION
		WHERE
			".$where;

$db->query($sql);
foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'idx'				=>intval($data['IDX']),
        'category_name'		=>$data['CATEGORY_NAME'],
		'size_title_1'		=>$data['SIZE_TITLE_1'],
		'size_title_2'		=>$data['SIZE_TITLE_2'],
		'size_title_3'		=>$data['SIZE_TITLE_3'],
		'size_title_4'		=>$data['SIZE_TITLE_4'],
		'size_title_5'	    =>$data['SIZE_TITLE_5'],
		'size_title_6'		=>$data['SIZE_TITLE_6'],
		'size_desc_1'	    =>$data['SIZE_DESC_1'],
		'size_desc_2'		=>$data['SIZE_DESC_2'],
        'size_desc_3'		=>$data['SIZE_DESC_3'],
		'size_desc_4'		=>$data['SIZE_DESC_4'],
		'size_desc_5'		=>$data['SIZE_DESC_5'],
		'size_desc_6'		=>$data['SIZE_DESC_6']	
	);
}
?>