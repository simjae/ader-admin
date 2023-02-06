<?php
/*
 +=============================================================================
 | 
 | 랜딩페이지 관리 - 메인 배너 정보 리스트 조회
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

$country	= $_POST['country'];

if ($country != null) {
	$select_banner_sql = "
		SELECT
			MB.IDX				AS BANNER_IDX,
			MB.DISPLAY_NUM		AS DISPLAY_NUM,
			REPLACE(
				MB.IMG_LOCATION,
				'/var/www/admin/www',
				''
			)					AS IMG_LOCATION
		FROM
			dev.MAIN_BANNER MB
		WHERE
			COUNTRY = '".$country."' AND
			MB.DEL_FLG = FALSE
		ORDER BY
			DISPLAY_NUM ASC
	";

	$db->query($select_banner_sql);

	foreach($db->fetch() as $banner_data){
		$json_result['data'][] = array(
			'banner_idx'	=>$banner_data['BANNER_IDX'],
			'display_num'	=>$banner_data['DISPLAY_NUM'],
			'img_location'	=>$banner_data['IMG_LOCATION']
		);
	}
}

?>