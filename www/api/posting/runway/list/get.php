<?php
/*
 +=============================================================================
 | 
 | 에디토리얼 페이지 목록 가져오기
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.01.31
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$country = null;
if (isset($_SESSION['COUNTRY'])) {
	$country = $_SESSION['COUNTRY'];
} else if (isset($_POST['country'])) {
	$country = $_POST['country'];
}

$size_type = null;
if (isset($_POST['size_type'])) {
	$size_type = $_POST['size_type'];
}

if ($size_type != null) {
	$select_runway_page_sql = "
		SELECT
			PP.IDX				AS PAGE_IDX,
			PP.PAGE_TITLE		AS PAGE_TITLE
		FROM
			dev.PAGE_POSTING PP
		WHERE
			PP.COUNTRY = '".$country."' AND
			PP.POSTING_TYPE = 'RNWY' AND
			NOW() BETWEEN PP.DISPLAY_START_DATE AND PP.DISPLAY_END_DATE AND
			PP.DISPLAY_FLG = TRUE AND
			PP.DEL_FLG = FALSE
		ORDER BY
			PP.IDX DESC
	";
	
	$db->query($select_runway_page_sql);
	
	foreach($db->fetch() as $page_data) {
		$page_idx = $page_data['PAGE_IDX'];
		
		$contents_cnt = $db->count("dev.RUNWAY_THUMB","PAGE_IDX = ".$page_idx." AND DEL_FLG = FALSE");
		
		if (!empty($page_idx) && $contents_cnt > 0) {
			$contents_location = null;
			
			$select_runway_contents_sql = "
				SELECT
					REPLACE(
						EC.CONTENTS_LOCATION,
						'/var/www/admin/www',
						''
					)			AS CONTENTS_LOCATION
				FROM
					dev.RUNWAY_THUMB ET
					LEFT JOIN dev.RUNWAY_CONTENTS EC ON
					ET.IDX = EC.THUMB_IDX
				WHERE
					ET.PAGE_IDX = ".$page_idx." AND
					ET.SIZE_TYPE = '".$size_type."' AND
					ET.DISPLAY_NUM = 1 AND
					ET.DEL_FLG = FALSE
			";
			
			$db->query($select_runway_contents_sql);
			
			foreach($db->fetch() as $contents_data) {
				$contents_location = $contents_data['CONTENTS_LOCATION'];
			}
		} else {
			continue;
		}
		
		$json_result['data'][] = array(
			'page_idx'				=>$page_data['PAGE_IDX'],
			'page_title'			=>$page_data['PAGE_TITLE'],
			'contents_location'		=>$contents_location,
            'size_type'				=>$size_type
		);
	}
}

?>