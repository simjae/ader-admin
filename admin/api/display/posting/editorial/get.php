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
	$select_editorial_sql = "
		SELECT
			ET.IDX					AS THUMB_IDX,
			ET.DISPLAY_NUM			AS DISPLAY_NUM,
			ET.THUMB_TYPE			AS THUMB_TYPE,
			ET.SIZE_TYPE			AS SIZE_TYPE,
			REPLACE(
				ET.THUMB_LOCATION,
				'/var/www/admin/www',
				''
			)						AS THUMB_LOCATION,
			ET.THUMB_URL			AS THUMB_URL,
			
			EC.IDX					AS CONTENTS_IDX,
			EC.CONTENTS_TYPE		AS CONTENTS_TYPE,
			EC.SIZE_TYPE			AS SIZE_TYPE,
			REPLACE(
				EC.CONTENTS_LOCATION,
				'/var/www/admin/www',
				''
			)						AS CONTENTS_LOCATION,
			EC.CONTENTS_URL			AS CONTENTS_URL
		FROM
			dev.EDITORIAL_THUMB ET	LEFT JOIN
			dev.EDITORIAL_CONTENTS EC ON
			ET.IDX = EC.THUMB_IDX AND
			ET.SIZE_TYPE = EC.SIZE_TYPE
		WHERE
			ET.PAGE_IDX = ".$page_idx."	AND
			ET.DISPLAY_NUM = ".$display_num." AND
			ET.DEL_FLG = FALSE AND
			ET.SIZE_TYPE = '".$size_type."' 
		ORDER BY
			ET.DISPLAY_NUM ASC
	";
	$db->query($select_editorial_sql);
	
	foreach($db->fetch() as $editorial_data) {
		$json_result['data'][] = array(
			'thumb_idx' 		=> $editorial_data['THUMB_IDX'],
			'display_num' 		=> $editorial_data['DISPLAY_NUM'],
			'thumb_type' 		=> $editorial_data['THUMB_TYPE'],
			'size_type' 		=> $editorial_data['SIZE_TYPE'],
			'thumb_location'	=> $editorial_data['THUMB_LOCATION'],
			'thumb_url' 		=> $editorial_data['THUMB_URL'],

			'contents_idx' 		=> $editorial_data['CONTENTS_IDX'],
			'contents_type' 	=> $editorial_data['CONTENTS_TYPE'],
			'contents_location' => $editorial_data['CONTENTS_LOCATION'],
			'contents_url' 		=> $editorial_data['CONTENTS_URL']
		);
	}
}

?>