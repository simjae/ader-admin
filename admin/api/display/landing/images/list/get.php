<?php
/*
 +=============================================================================
 | 
 | 랜딩페이지 관리 - 메인 이미지 리스트 조회
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

$country		= $_POST['country'];

if ($country != null) {
	$select_img_sql = "
		SELECT
			MI.IDX			AS IMG_IDX,
			MI.DISPLAY_NUM	AS DISPLAY_NUM,
			REPLACE(
				MI.IMG_LOCATION,
				'/var/www/admin/www',
				''
			)				AS IMG_LOCATION
		FROM
			dev.MAIN_IMG MI
		WHERE
			MI.COUNTRY = '".$country."' AND
			MI.DEL_FLG = FALSE
		ORDER BY
			MI.DISPLAY_NUM ASC
	";

	$db->query($select_img_sql);

	foreach($db->fetch() as $banner_data){
		$json_result['data'][] = array(
			'img_idx'		=>$banner_data['IMG_IDX'],
			'display_num'	=>$banner_data['DISPLAY_NUM'],
			'img_location'	=>$banner_data['IMG_LOCATION']
		);
	}
}

?>