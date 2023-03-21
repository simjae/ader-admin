<?php
/*
 +=============================================================================
 | 
 | 랜딩페이지 관리 - 메인_배너 개별 조회
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

$banner_idx		= $_POST['banner_idx'];

if ($banner_idx != null) {
	$select_banner_sql = "
		SELECT
			MB.IDX					AS BANNER_IDX,
			MB.DISPLAY_NUM			AS DISPLAY_NUM,
			REPLACE(
				MB.IMG_LOCATION,
				'/var/www/admin/www',
				''
			)						AS IMG_LOCATION,
			MB.TITLE				AS TITLE,
			MB.SUB_TITLE			AS SUB_TITLE,
			MB.BACKGROUND_COLOR		AS BACKGROUND_COLOR,
			MB.BTN1_NAME			AS BTN1_NAME,
			MB.BTN1_URL				AS BTN1_URL,
			MB.BTN1_DISPLAY_FLG		AS BTN1_DISPLAY_FLG,
			MB.BTN2_NAME			AS BTN2_NAME,
			MB.BTN2_URL				AS BTN2_URL,
			MB.BTN2_DISPLAY_FLG		AS BTN2_DISPLAY_FLG
		FROM
			TMP_MAIN_BANNER MB
		WHERE
			MB.IDX = ".$banner_idx." AND
			MB.DEL_FLG = FALSE
	";

	$db->query($select_banner_sql);
	
	foreach($db->fetch() as $banner_data){
		$json_result['data'][] = array(
			'banner_idx'		=>$banner_data['BANNER_IDX'],
			'display_num'		=>$banner_data['DISPLAY_NUM'],
			'img_location'		=>$banner_data['IMG_LOCATION'],
			'title'				=>$banner_data['TITLE'],
			'sub_title'			=>$banner_data['SUB_TITLE'],
			'background_color'	=>$banner_data['BACKGROUND_COLOR'],
			'btn1_name'			=>$banner_data['BTN1_NAME'],
			'btn1_url'			=>$banner_data['BTN1_URL'],
			'btn1_display_flg'	=>$banner_data['BTN1_DISPLAY_FLG'],
			'btn2_name'			=>$banner_data['BTN2_NAME'],
			'btn2_url'			=>$banner_data['BTN2_URL'],
			'btn2_display_flg'	=>$banner_data['BTN2_DISPLAY_FLG']
		);
	}
}
?>