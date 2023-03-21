<?php
/*
 +=============================================================================
 | 
 | 랜딩페이지 관리 - 메인 배너 정보 개별 조회
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

$img_idx		= $_POST['img_idx'];

if ($img_idx != null) {
	$select_img_sql = "
		SELECT
			MI.IDX				AS IMG_IDX,
			MI.DISPLAY_NUM		AS DISPLAY_NUM,
			REPLACE(
				MI.IMG_LOCATION,
				'/var/www/admin/www',
				''
			)					AS IMG_LOCATION,
			MI.TITLE			AS TITLE,
			MI.BTN_NAME			AS BTN_NAME,
			MI.BTN_URL			AS BTN_URL,
			MI.BTN_DISPLAY_FLG	AS BTN_DISPLAY_FLG
		FROM
			TMP_MAIN_IMG MI
		WHERE
			MI.IDX = ".$img_idx." AND
			MI.DEL_FLG = FALSE
	";

	$db->query($select_img_sql);
	
	foreach($db->fetch() as $img_data){
		$json_result['data'][] = array(
			'img_idx'			=>$img_data['IMG_IDX'],
			'display_num'		=>$img_data['DISPLAY_NUM'],
			'img_location'		=>$img_data['IMG_LOCATION'],
			'title'				=>$img_data['TITLE'],
			'btn_name'			=>$img_data['BTN_NAME'],
			'btn_url'			=>$img_data['BTN_URL'],
			'btn_display_flg'	=>$img_data['BTN_DISPLAY_FLG']
		);
	}
}
?>