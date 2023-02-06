<?php
/*
 +=============================================================================
 | 
 | 룩북 관리 화면 - 프로젝트 리스트 조회
 | -----------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2023.01.26
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$country			= $_POST['country'];

if ($country != null) {
	$select_collection_sql = "
		SELECT
			PC.IDX				AS COLLECTION_IDX,
			PC.DISPLAY_NUM		AS DISPLAY_NUM,
			PC.PROJECT_NAME		AS PROJECT_NAME,
			PC.PROJECT_DESC		AS PROJECT_DESC,
			PC.PROJECT_TITLE	AS PROJECT_TITLE,
			PC.THUMB_LOCATION	AS THUMB_LOCATION,
			REPLACE(
				PC.THUMB_LOCATION,
				'/var/www/admin/www',
				''
			)					AS IMG_LOCATION
		FROM
			dev.POSTING_COLLECTION PC
		WHERE
			PC.COUNTRY = '".$country."' AND
			PC.DEL_FLG = FALSE
		ORDER BY
			DISPLAY_NUM ASC
	";
	
	$db->query($select_collection_sql);
	
	foreach($db->fetch() as $collection_data) {
		$json_result['data'][] = array(
			'collection_idx'	=>$collection_data['COLLECTION_IDX'],
			'display_num'		=>$collection_data['DISPLAY_NUM'],
			'project_name'		=>$collection_data['PROJECT_NAME'],
			'project_desc'		=>$collection_data['PROJECT_DESC'],
			'project_title'		=>$collection_data['PROJECT_TITLE'],
			'thumb_location'	=>$collection_data['THUMB_LOCATION'],
			'img_location'		=>$collection_data['IMG_LOCATION']
		);
	}
}

?>