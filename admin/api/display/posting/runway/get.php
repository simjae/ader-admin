<?php
/*
 +=============================================================================
 | 
 | 에디토리얼 관리 화면 - 에디토리얼 썸네일/컨텐츠 정보 개별 조회
 | -----------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2023.01.27
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$thumb_idx			= $_POST['thumb_idx'];
$page_idx			= $_POST['page_idx'];
$display_num		= $_POST['display_num'];
$size_type			= $_POST['size_type'];

if ($page_idx != null && $display_num != null && $size_type != null) {
	$select_runway_sql = "
		SELECT
			RT.IDX					AS THUMB_IDX,
			RT.DISPLAY_NUM			AS DISPLAY_NUM,
			RT.THUMB_TYPE			AS THUMB_TYPE,
			RT.SIZE_TYPE			AS SIZE_TYPE,
			REPLACE(
				RT.THUMB_LOCATION,
				'/var/www/admin/www',
				''
			)						AS THUMB_LOCATION,
			RT.THUMB_URL			AS THUMB_URL,
			
			RC.IDX					AS CONTENTS_IDX,
			RC.CONTENTS_TYPE		AS CONTENTS_TYPE,
			RC.SIZE_TYPE			AS SIZE_TYPE,
			REPLACE(
				RC.CONTENTS_LOCATION,
				'/var/www/admin/www',
				''
			)						AS CONTENTS_LOCATION,
			RC.CONTENTS_URL			AS CONTENTS_URL
		FROM
			RUNWAY_THUMB RT
			LEFT JOIN RUNWAY_CONTENTS RC ON
			RT.IDX = RC.THUMB_IDX AND
			RT.SIZE_TYPE = RC.SIZE_TYPE
		WHERE
			RT.PAGE_IDX = ".$page_idx."	AND
			RT.DISPLAY_NUM = ".$display_num." AND
			RT.DEL_FLG = FALSE AND
			RT.SIZE_TYPE = '".$size_type."' 
		ORDER BY
			RT.DISPLAY_NUM ASC
	";
	
	$db->query($select_runway_sql);
	
	foreach($db->fetch() as $runway_data) {
		$json_result['data'][] = array(
			'thumb_idx' 		=> $runway_data['THUMB_IDX'],
			'display_num' 		=> $runway_data['DISPLAY_NUM'],
			'thumb_type' 		=> $runway_data['THUMB_TYPE'],
			'size_type' 		=> $runway_data['SIZE_TYPE'],
			'thumb_location'	=> $runway_data['THUMB_LOCATION'],
			'thumb_url' 		=> $runway_data['THUMB_URL'],

			'contents_idx' 		=> $runway_data['CONTENTS_IDX'],
			'contents_type' 	=> $runway_data['CONTENTS_TYPE'],
			'contents_location' => $runway_data['CONTENTS_LOCATION'],
			'contents_url' 		=> $runway_data['CONTENTS_URL']
		);
	}
}

?>