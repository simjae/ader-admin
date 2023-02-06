<?php
/*
 +=============================================================================
 | 
 | 에디토리얼 관리 화면 - 에디토리얼 썸네일/컨텐츠 정보 조회
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

$page_idx			= $_POST['page_idx'];
$size_type			= $_POST['editorial_type'];

$editorial_table = array();
$editorial_table[0] = " dev.EDITORIAL_THUMB ";
$editorial_table[1] = " dev.EDITORIAL_CONTENTS ";

if ($page_idx != null) {
	$editorial_info_sql = "
		SELECT
			COUNTRY,
			PAGE_TITLE,
			PAGE_URL,
			PAGE_MEMO
		FROM
			dev.PAGE_POSTING
		WHERE
			IDX = ".$page_idx;
			
	$db->query($editorial_info_sql);
	foreach($db->fetch() as $info_data){
		$json_result['data']['info'][] = array(
			'country' 		=> $info_data['COUNTRY'],
			'page_title' 	=> $info_data['PAGE_TITLE'],
			'page_url' 		=> $info_data['PAGE_URL'],
			'page_memo' 	=> $info_data['PAGE_MEMO']
		);
	}

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
			".$editorial_table[0]." ET LEFT JOIN
			".$editorial_table[1]." EC ON
			ET.IDX = EC.THUMB_IDX AND
			ET.SIZE_TYPE = EC.SIZE_TYPE
		WHERE
			ET.PAGE_IDX = ".$page_idx." AND
			ET.DEL_FLG = FALSE AND
			ET.SIZE_TYPE = '".$size_type."' AND
			EC.DEL_FLG = FALSE
		ORDER BY
			ET.DISPLAY_NUM ASC
	";

	$db->query($select_editorial_sql);
	
	foreach($db->fetch() as $editorial_data) {
		$json_result['data']['list'][] = array(
			'thumb_idx' 		=> $editorial_data['THUMB_IDX'],
			'display_num' 		=> $editorial_data['DISPLAY_NUM'],
			'thumb_type' 		=> $editorial_data['THUMB_TYPE'],
			'size_type' 		=> $editorial_data['SIZE_TYPE'],
			'thumb_location' 	=> $editorial_data['THUMB_LOCATION'],
			'thumb_url' 		=> $editorial_data['THUMB_URL'],

			'contents_idx' 		=> $editorial_data['CONTENTS_IDX'],
			'contents_type' 	=> $editorial_data['CONTENTS_TYPE'],
			'contents_location' => $editorial_data['CONTENTS_LOCATION'],
			'contents_url' 		=> $editorial_data['CONTENTS_URL']
		);
	}
}

?>