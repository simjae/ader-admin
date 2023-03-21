<?php
/*
 +=============================================================================
 | 
 | 상품 진열 페이지_상품 라이브러리 검색 모달 - 선택 한 배너 라이브러리 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2023.01.09
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$banner_type	= $_POST['banner_type'];
$param_idx		= $_POST['banner_idx'];

if ($banner_type != null && $banner_idx != null) {
	$banner_table = "";
	$banner_location_sql = "";
	switch ($banner_type) {
		case "IMG" :
			$banner_table = "BANNER_IMG BI";
			$banner_location_sql = "
				REPLACE(
					BI.BANNER_LOCATION,
					'/var/www/admin/www',
					''
				)			AS BANNER_LOCATION
			";
			break;
		
		case "VID" :
			$banner_table = "BANNER_VID BI";
			$banner_location_sql = "
				REPLACE(
					BI.BANNER_PREVIEW,
					'/var/www/admin/www',
					''
				)			AS BANNER_LOCATION
			";
			break;
	}
	
	$select_banner_sql = "
		SELECT
			BI.IDX					AS BANNER_IDX,
			REPLACE(
				BI.BANNER_THUMBNAIL,
				'/var/www/admin/www',
				''
			)						AS BANNER_THUMBNAIL,
			".$banner_location_sql."
		FROM
			".$banner_table."
		WHERE
			BI.DEL_FLG = FALSE AND
			BI.IDX IN (".implode(",",$param_idx).")
	";
	
	$db->query($select_banner_sql);
	
	foreach($db->fetch() as $banner_data) {
		$json_result['data'][] = array(
			'banner_idx'		=>$banner_data['BANNER_IDX'],
			'banner_thumbnail'	=>$banner_data['BANNER_THUMBNAIL'],
			'banner_location'	=>$banner_data['BANNER_LOCATION']
		);
	}
}
?>