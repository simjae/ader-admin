<?php
/*
 +=============================================================================
 | 
 | 상품 리스트 - 상품 사이즈 정보 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.02.17
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$option_idx = 0;
if (isset($_POST['option_idx'])) {
	$option_idx = $_POST['option_idx'];
}

$size_type = null;
if (isset($_POST['screen_size'])) {
	$size_type = $_POST['size_type'];
}

if ($option_idx > 0) {
	$ext_file_name = "";
	if ($size_type == "M") {
		$ext_file_name = "_mo";
	}
	
	$select_size_guide_sql = "
		SELECT
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
			SG.SIZE_DESC_6		AS SIZE_DESC_6,
			
			OO.OPTION_SIZE_1	AS OPTION_SIZE_1,
			OO.OPTION_SIZE_2	AS OPTION_SIZE_2,
			OO.OPTION_SIZE_3	AS OPTION_SIZE_3,
			OO.OPTION_SIZE_4	AS OPTION_SIZE_4,
			OO.OPTION_SIZE_5	AS OPTION_SIZE_5,
			OO.OPTION_SIZE_6	AS OPTION_SIZE_6
		FROM
			dev.ORDERSHEET_OPTION OO
			LEFT JOIN dev.ORDERSHEET_MST OM ON
			OO.ORDERSHEET_IDX = OM.IDX
			LEFT JOIN dev.SIZE_GUIDE SG ON
			OM.SIZE_GUIDE_IDX = SG.IDX
		WHERE
			OO.IDX = ".$option_idx."
	";
	
	$db->query($select_size_guide_sql);
	
	foreach($db->fetch() as $size_data) {
		$size_title = array();
		$size_desc = array();
		$option_size = array();
		
		
		if ($size_data['SIZE_TITLE_1']) {
			array_push($size_title,$size_data['SIZE_TITLE_1']);
		}

		if ($size_data['SIZE_TITLE_2']) {
			array_push($size_title,$size_data['SIZE_TITLE_2']);
		}
		
		if ($size_data['SIZE_TITLE_3']) {
			array_push($size_title,$size_data['SIZE_TITLE_3']);
		}
		
		if ($size_data['SIZE_TITLE_4']) {
			array_push($size_title,$size_data['SIZE_TITLE_4']);
		}
		
		if ($size_data['SIZE_TITLE_5']) {
			array_push($size_title,$size_data['SIZE_TITLE_5']);
		}
		
		if ($size_data['SIZE_TITLE_6']) {
			array_push($size_title,$size_data['SIZE_TITLE_6']);
		}
		
		if ($size_data['SIZE_DESC_1']) {
			array_push($size_desc,$size_data['SIZE_DESC_1']);
		}
		
		if ($size_data['SIZE_DESC_2']) {
			array_push($size_desc,$size_data['SIZE_DESC_2']);
		}
		
		if ($size_data['SIZE_DESC_3']) {
			array_push($size_desc,$size_data['SIZE_DESC_3']);
		}
		
		if ($size_data['SIZE_DESC_4']) {
			array_push($size_desc,$size_data['SIZE_DESC_4']);
		}
		
		if ($size_data['SIZE_DESC_5']) {
			array_push($size_desc,$size_data['SIZE_DESC_5']);
		}
		
		if ($size_data['SIZE_DESC_6']) {
			array_push($size_desc,$size_data['SIZE_DESC_6']);
		}

		if ($size_data['OPTION_SIZE_1']) {
			array_push($option_size,$size_data['OPTION_SIZE_1']);
		}
		if ($size_data['OPTION_SIZE_2']) {
			array_push($option_size,$size_data['OPTION_SIZE_2']);
		}
		if ($size_data['OPTION_SIZE_3']) {
			array_push($option_size,$size_data['OPTION_SIZE_3']);
		}
		if ($size_data['OPTION_SIZE_4']) {
			array_push($option_size,$size_data['OPTION_SIZE_4']);
		}
		if ($size_data['OPTION_SIZE_5']) {
			array_push($option_size,$size_data['OPTION_SIZE_5']);
		}
		if ($size_data['OPTION_SIZE_6']) {
			array_push($option_size,$size_data['OPTION_SIZE_6']);
		}
		
		$json_result['data'] = array(
			'img_file_name'		=>"/images/size/".$size_data['IMG_FILE_NAME'].$ext_file_name.".svg",
			'size_title'		=>$size_title,
			'size_desc'			=>$size_desc,
			'option_size'		=>$option_size
		);
	}
}

?>