<?php
/*
 +=============================================================================
 | 
 | 랜딩페이지 관리 - 메인_컨텐츠 개별 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2023.01.13
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$select_contents_sql = "
	SELECT
		MC.IDX					AS CONTENTS_IDX,
		MC.IMG_LOCATION			AS IMG_LOCATION,
		MC.TITLE				AS TITLE,
		MC.SUB_TITLE			AS SUB_TITLE,
		MC.BACKGROUND_COLOR		AS BACKGROUND_COLOR,
		MC.BTN1_NAME			AS BTN1_NAME,
		MC.BTN1_URL				AS BTN1_URL,
		MC.BTN1_DISPLAY_FLG		AS BTN1_DISPLAY_FLG,
		MC.BTN2_NAME			AS BTN2_NAME,
		MC.BTN2_URL				AS BTN2_URL,
		MC.BTN2_DISPLAY_FLG		AS BTN2_DISPLAY_FLG
	FROM
		dev.MAIN_CONTENTS MC
	WHERE
		MC.COUNTRY = '".$country."' AND
		MC.DEL_FLG = FALSE
";

$db->query($select_contents_sql);

foreach($db->fetch() as $contents_data){
	$contents_idx = $contents_data['CONTENTS_IDX'];
	
	$product_info = array();
	if (!empty($contents_idx)) {
		$select_product_sql = "
			SELECT
				CP.PRODUCT_IDX		AS PRODUCT_IDX,
				(
					SELECT
						S_PI.IMG_LOCATION
					FROM
						dev.PRODUCT_IMG S_PI
					WHERE
						S_PI.PRODUCT_IDX = PR.IDX AND
						S_PI.IMG_TYPE = 'P' AND
						S_PI.IMG_SIZE = 'S'
					ORDER BY
						S_PI.IDX ASC
					LIMIT
						0,1
				)					AS IMG_LOCATION,
				PR.PRODUCT_NAME		AS PRODUCT_NAME
			FROM
				dev.CONTENTS_PRODUCT CP
				LEFT JOIN dev.SHOP_PRODUCT PR ON
				CP.PRODUCT_IDX = PR.IDX
			WHERE
				CP.COUNTRY = '".$country."'
			ORDER BY
				CP.DISPLAY_NUM ASC
		";
		
		$db->query($select_product_sql);
		
		foreach($db->fetch() as $product_data) {
			$product_info[] = array(
				'product_idx'	=>$product_data['PRODUCT_IDX'],
				'img_location'	=>$product_data['IMG_LOCATION'],
				'product_name'	=>$product_data['PRODUCT_NAME']
			);
		}
	}
	
	$json_result['data'][] = array(
		'contents_idx'		=>$contents_data['CONTENTS_IDX'],
		'img_location'		=>$contents_data['IMG_LOCATION'],
		'title'				=>$contents_data['TITLE'],
		'sub_title'			=>$contents_data['SUB_TITLE'],
		'background_color'	=>$contents_data['BACKGROUND_COLOR'],
		'btn1_name'			=>$contents_data['BTN1_NAME'],
		'btn1_url'			=>$contents_data['BTN1_URL'],
		'btn1_display_flg'	=>$contents_data['BTN1_DISPLAY_FLG'],
		'btn2_name'			=>$contents_data['BTN2_NAME'],
		'btn2_url'			=>$contents_data['BTN2_URL'],
		'btn2_display_flg'	=>$contents_data['BTN2_DISPLAY_FLG'],
		
		'product_info'		=>$product_info
	);
}
?>