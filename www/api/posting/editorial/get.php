<?php
/*
 +=============================================================================
 | 
 | 에디토리얼 이미지 가져오기
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

$page_idx = 0;
if (isset($_POST['page_idx'])) {
	$page_idx = $_POST['page_idx'];
}

$size_type = null;
if (isset($_POST['size_type'])) {
	$size_type = $_POST['size_type'];
}

if ($page_idx > 0 && $size_type != null) {
	$select_thumb_sql = "
		SELECT
			ET.IDX				AS THUMB_IDX,
			ET.THUMB_TYPE		AS THUMB_TYPE,
			REPLACE(
				ET.THUMB_LOCATION,
				'/var/www/admin/www/',
				''
			)				AS IMG_LOCATION
		FROM
			dev.EDITORIAL_THUMB ET
		WHERE
			ET.PAGE_IDX = ".$page_idx." AND
			ET.SIZE_TYPE = '".$size_type."' AND
            ET.DEL_FLG = FALSE
		ORDER BY
			ET.DISPLAY_NUM ASC
	";
	
	$db->query($select_thumb_sql);
	
	$thumb_info = array();
	foreach($db->fetch() as $thumb_data) {
		$thumb_idx = $thumb_data['THUMB_IDX'];
		
		$contents_info = array();
		if (!empty($thumb_idx)) {
			$select_contents_sql = "
				SELECT
					EC.IDX				AS CONTENTS_IDX,
					EC.CONTENTS_TYPE	AS CONTENTS_TYPE,
					REPLACE(
						EC.CONTENTS_LOCATION,
						'/var/www/admin/www/',
						''
					)					AS CONTENTS_URL
				FROM
					dev.EDITORIAL_CONTENTS EC
				WHERE
					EC.THUMB_IDX = ".$thumb_idx." AND
					SIZE_TYPE = '".$size_type."'
			";
			
			$db->query($select_contents_sql);
			
			foreach($db->fetch() as $contents_data) {
				$contents_info[] = array(
					'contents_idx'		=>$contents_data['CONTENTS_IDX'],
					'contents_type'		=>$contents_data['CONTENTS_TYPE'],
					'contents_url'		=>$contents_data['CONTENTS_URL'],
				);
			}
		}
		
		$thumb_info[] = array(
			'editorial_idx'		=>$thumb_idx,
			'thumb_type'		=>$thumb_data['THUMB_TYPE'],
			'img_location'		=>$thumb_data['IMG_LOCATION'],
			
			'contents_info'		=>$contents_info
		);

		$json_result['data'] = $thumb_info;
	}
}

?>