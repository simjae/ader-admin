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

$country = null;
if (isset($_SESSION['COUNTRY'])) {
	$country = $_SESSION['COUNTRY'];
} else if (isset($_POST['country'])) {
	$country = $_POST['country'];
}

$product_idx = null;
if (isset($_POST['product_idx'])) {
	$product_idx = $_POST['product_idx'];
}

$size_type = null;
if (isset($_POST['screen_size'])) {
	$size_type = $_POST['size_type'];
}

if ($country != null && $product_idx > 0) {
	$ext_file_name = "";
	if ($size_type == "M") {
		$ext_file_name = "_mo";
	}
	
	$select_size_guide_sql = "
		SELECT
			SG.IMG_FILE_NAME	AS IMG_FILE_NAME,
			
			OM.MODEL			AS MODEL,
			OM.MODEL_WEAR		AS MODEL_WEAR,
			
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
			LEFT JOIN ORDERSHEET_MST OM ON
			SG.CATEGORY_TYPE = OM.SIZE_GUIDE_CATEGORY
		WHERE
			SG.COUNTRY = '".$country."' AND
			OM.IDX = (
				SELECT
					PR.ORDERSHEET_IDX
				FROM
					SHOP_PRODUCT PR
				WHERE
					PR.IDX = ".$product_idx."
			)
	";
	
	$db->query($select_size_guide_sql);
	
	$size_info = array();
	foreach ($db->fetch() as $size_data) {
		$size_info = array(
			'img_file_name'	=>$size_data['IMG_FILE_NAME'],
			
			'model'			=>$size_data['MODEL'],
			'model_wear'	=>$size_data['MODEL_WEAR'],
			
			'size_title_1'	=>$size_data['SIZE_TITLE_1'],
			'size_title_2'	=>$size_data['SIZE_TITLE_2'],
			'size_title_3'	=>$size_data['SIZE_TITLE_3'],
			'size_title_4'	=>$size_data['SIZE_TITLE_4'],
			'size_title_5'	=>$size_data['SIZE_TITLE_5'],
			'size_title_6'	=>$size_data['SIZE_TITLE_6'],
			
			'size_desc_1'	=>$size_data['SIZE_DESC_1'],
			'size_desc_2'	=>$size_data['SIZE_DESC_2'],
			'size_desc_3'	=>$size_data['SIZE_DESC_3'],
			'size_desc_4'	=>$size_data['SIZE_DESC_4'],
			'size_desc_5'	=>$size_data['SIZE_DESC_5'],
			'size_desc_6'	=>$size_data['SIZE_DESC_6']
		);
	}
	
	$select_option_size_sql = "
		SELECT
			OO.OPTION_NAME			AS OPTION_NAME,
			OO.OPTION_SIZE_1		AS OPTION_SIZE_1,
			OO.OPTION_SIZE_2		AS OPTION_SIZE_2,
			OO.OPTION_SIZE_3		AS OPTION_SIZE_3,
			OO.OPTION_SIZE_4		AS OPTION_SIZE_4,
			OO.OPTION_SIZE_5		AS OPTION_SIZE_5,
			OO.OPTION_SIZE_6		AS OPTION_SIZE_6
		FROM
			ORDERSHEET_OPTION OO
			LEFT JOIN SHOP_PRODUCT PR ON
			OO.ORDERSHEET_IDX = PR.ORDERSHEET_IDX
		WHERE
			PR.IDX = ".$product_idx."
		ORDER BY
			OO.IDX
	";
	
	$db->query($select_option_size_sql);
	
	$option_info = array();
	foreach($db->fetch() as $option_data) {
		$option_info[] = array(
			'option_name'		=>$option_data['OPTION_NAME'],
			'option_size_1'		=>$option_data['OPTION_SIZE_1'],
			'option_size_2'		=>$option_data['OPTION_SIZE_2'],
			'option_size_3'		=>$option_data['OPTION_SIZE_3'],
			'option_size_4'		=>$option_data['OPTION_SIZE_4'],
			'option_size_5'		=>$option_data['OPTION_SIZE_5'],
			'option_size_6'		=>$option_data['OPTION_SIZE_6']
		);
	}
	
	$size_guide_info = array();
	if (count($size_info) > 0 && count($option_info) > 0) {
		$dimensions = array();
		for ($i=0; $i<count($option_info); $i++) {
			$option_size = array();
			for ($j=1; $j<=6; $j++) {
				if ($option_info[$i]['option_size_'.$j] != null) {
					$option_size[] = array(
						'title'		=>$size_info['size_title_'.$j],
						'desc'		=>$size_info['size_desc_'.$j],
						'value'		=>$option_info[$i]['option_size_'.$j]
					);
				}
			}
			
			$dimensions[$option_info[$i]['option_name']] = $option_size;
		}
		
		$size_guide_info = array(
			'img_file_name'		=>'/images/size/'.$size_data['IMG_FILE_NAME'].$ext_file_name.".svg",
			'model'				=>$size_info['model'],
			'model_wear'		=>$size_info['model_wear'],
			'dimensions'		=>$dimensions
		);
	}
	
	$json_result['data'] = $size_guide_info;
}

?>