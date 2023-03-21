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

$size_guide_idx			= $_POST['size_guide_idx'];

if ($size_guide_idx != null) {
	$select_size_guide_sql = "
		SELECT
			SG.CATEGORY_TYPE	AS CATEGORY_TYPE,
			SG.IMG_FILE_NAME	AS IMG_FILE_NAME,
            SG.SIZE_TITLE_1		AS SIZE_TITLE_1,
            SG.SIZE_TITLE_2		AS SIZE_TITLE_2,
            SG.SIZE_TITLE_3		AS SIZE_TITLE_3,
            SG.SIZE_TITLE_4		AS SIZE_TITLE_4,
            SG.SIZE_TITLE_5		AS SIZE_TITLE_5,
            SG.SIZE_TITLE_6		AS SIZE_TITLE_6,
            SG.SIZE_DESC_1		AS SIZE_DESC_1,
            SG.SIZE_DESC_2		AS SIZE_DESC_2,
            SG.SIZE_DESC_3		AS SIZE_DESC_3,
            SG.SIZE_DESC_4		AS SIZE_DESC_4,
            SG.SIZE_DESC_5		AS SIZE_DESC_5,
            SG.SIZE_DESC_6		AS SIZE_DESC_6
		FROM
			SIZE_GUIDE SG
		WHERE
			IDX = ".$size_guide_idx."
	";
	
	$db->query($select_size_guide_sql);
	
	foreach($db->fetch() as $size_data) {
		$json_result['data'][] = array(
			'category_type'		=>$size_data['CATEGORY_TYPE'],
			'img_file_name'		=>$size_data['IMG_FILE_NAME'],
			'size_title_1'		=>$size_data['SIZE_TITLE_1'],
			'size_title_2'		=>$size_data['SIZE_TITLE_2'],
			'size_title_3'		=>$size_data['SIZE_TITLE_3'],
			'size_title_4'		=>$size_data['SIZE_TITLE_4'],
			'size_title_5'	    =>$size_data['SIZE_TITLE_5'],
			'size_title_6'		=>$size_data['SIZE_TITLE_6'],
			'size_desc_1'	    =>$size_data['SIZE_DESC_1'],
			'size_desc_2'		=>$size_data['SIZE_DESC_2'],
			'size_desc_3'		=>$size_data['SIZE_DESC_3'],
			'size_desc_4'		=>$size_data['SIZE_DESC_4'],
			'size_desc_5'		=>$size_data['SIZE_DESC_5'],
			'size_desc_6'		=>$size_data['SIZE_DESC_6']	
		);
	}
}

?>