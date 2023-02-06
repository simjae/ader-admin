<?php
/*
 +=============================================================================
 | 
 | 배너 관리 페이지 - 베너 개별 조회
 | -----------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2023.01.04
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$banner_type	= $_POST['banner_type'];
$banner_idx		= $_POST['banner_idx'];

if ($banner_type != null && $banner_idx != null) {
	$banner_table = "";
	$clip_table = "";
	
	$head_clip_sql = "";
	
	switch ($banner_type) {
		case "HED" :
			$banner_table = "dev.BANNER_HEAD";
			$head_clip_sql = "
				,BI.LOCATION_START	AS LOCATION_START,
				BI.LOCATION_END		AS LOCATION_END
			";
			break;
		
		case "IMG" :
			$banner_table = "dev.BANNER_IMG";
			$clip_table = "dev.BANNER_IMG_CLIP";
			break;
		
		case "VID" :
			$banner_table = "dev.BANNER_VID";
			$clip_table = "dev.BANNER_VID_CLIP";
			break;
	}
	
	$select_banner_sql = "
		SELECT
			BI.IDX					AS BANNER_IDX,
			BI.BANNER_TITLE			AS BANNER_TITLE,
			BI.BANNER_MEMO			AS BANNER_MEMO,
			REPLACE(
				BI.BANNER_THUMBNAIL,
				'/var/www/admin/www',
				''
			)						AS BANNER_THUMBNAIL,
			REPLACE(
				BI.BANNER_LOCATION,
				'/var/www/admin/www',
				''
			)						AS BANNER_LOCATION
			".$head_clip_sql."
		FROM
			".$banner_table." BI
		WHERE
			BI.IDX = ".$banner_idx."
	";
	
	$db->query($select_banner_sql);
	
	foreach($db->fetch() as $banner_data) {
		$banner_idx = $banner_data['BANNER_IDX'];
		
		$clip_info = array();
		if (!empty($banner_idx) && strlen($clip_table) > 0) {
			$select_clip_sql = "
				SELECT
					BC.IDX				AS CLIP_IDX,
					BC.CLIP_TYPE		AS CLIP_TYPE,
					BC.LOCATION_START	AS LOCATION_START,
					BC.LOCATION_END		AS LOCATION_END
				FROM
					".$clip_table." BC
				WHERE
					BC.BANNER_IDX = ".$banner_idx."
			";
			
			$db->query($select_clip_sql);
			
			foreach($db->fetch() as $clip_data) {
				$clip_info[] = array(
					'clip_idx'			=>$clip_data['CLIP_IDX'],
					'clip_type'			=>$clip_data['CLIP_TYPE'],
					'location_start'	=>$clip_data['LOCATION_START'],
					'location_end'		=>$clip_data['LOCATION_END']
				);
			}
		}
		
		$json_result['data'][] = array(
			'banner_idx'		=>$banner_idx,
			'banner_title'		=>$banner_data['BANNER_TITLE'],
			'banner_memo'		=>$banner_data['BANNER_MEMO'],
			'banner_thumbnail'	=>$banner_data['BANNER_THUMBNAIL'],
			'banner_location'	=>$banner_data['BANNER_LOCATION'],
			'location_start'	=>$banner_data['LOCATION_START'],
			'location_end'		=>$banner_data['LOCATION_END'],
			'clip_info'			=>$clip_info
		);
	}
}
?>