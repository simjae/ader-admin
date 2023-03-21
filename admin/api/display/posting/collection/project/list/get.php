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

$country		= $_POST['country'];

if ($country != null) {
	$select_collection_project_sql = "
		SELECT
			PJ.IDX				AS PROJECT_IDX,
			PJ.DISPLAY_NUM		AS DISPLAY_NUM,
			PJ.PROJECT_NAME		AS PROJECT_NAME,
			PJ.PROJECT_DESC		AS PROJECT_DESC,
			PJ.PROJECT_TITLE	AS PROJECT_TITLE,
			PJ.THUMB_LOCATION	AS THUMB_LOCATION,
			REPLACE(
				PJ.THUMB_LOCATION,
				'/var/www/admin/www',
				''
			)					AS IMG_LOCATION
		FROM
			COLLECTION_PROJECT PJ
		WHERE
			PJ.COUNTRY = '".$country."' AND
			PJ.DEL_FLG = FALSE
		ORDER BY
			PJ.DISPLAY_NUM ASC
	";
	
	$db->query($select_collection_project_sql);
	
	foreach($db->fetch() as $project_data) {
		$json_result['data'][] = array(
			'project_idx'		=>$project_data['PROJECT_IDX'],
			'display_num'		=>$project_data['DISPLAY_NUM'],
			'project_name'		=>$project_data['PROJECT_NAME'],
			'project_desc'		=>$project_data['PROJECT_DESC'],
			'project_title'		=>$project_data['PROJECT_TITLE'],
			'thumb_location'	=>$project_data['THUMB_LOCATION'],
			'img_location'		=>$project_data['IMG_LOCATION']
		);
	}
}

?>