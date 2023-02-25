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

$size_type = null;
if (isset($_POST['size_type'])) {
	$size_type = $_POST['size_type'];
}

if ($size_type != null) {
	$select_editorial_sql = "
        SELECT
            PP.IDX			        AS PAGE_IDX,
            PP.PAGE_TITLE	        AS PAGE_TITLE,
            ET.SIZE_TYPE            AS SIZE_TYPE,
            REPLACE(
				EC.CONTENTS_LOCATION,
				'/var/www/admin/www',
				''
			)						AS CONTENTS_LOCATION
        FROM
            (
				SELECT
					IDX,
					PAGE_TITLE
				FROM
					dev.PAGE_POSTING
				WHERE
					POSTING_TYPE = 'EDTL' AND
					NOW() BETWEEN DISPLAY_START_DATE AND DISPLAY_END_DATE AND
					DISPLAY_FLG = TRUE AND
					DEL_FLG = FALSE
            ) PP
        LEFT JOIN
            (
				SELECT
					IDX,
					PAGE_IDX,
					SIZE_TYPE,
					THUMB_LOCATION
				FROM
					dev.EDITORIAL_THUMB
				WHERE
					DEL_FLG = FALSE
				AND
					DISPLAY_NUM = 1
			) ET ON
		PP.IDX = ET.PAGE_IDX
        LEFT JOIN dev.EDITORIAL_CONTENTS EC ON
		ET.IDX = EC.THUMB_IDX
        WHERE
			ET.SIZE_TYPE = '".$size_type."'
		ORDER BY
			PP.IDX DESC
	";
	
	$db->query($select_editorial_sql);
	
	foreach($db->fetch() as $editorial_data) {
		
		$json_result['data'][] = array(
			'page_idx'		=>$editorial_data['PAGE_IDX'],
			'page_title'		=>$editorial_data['PAGE_TITLE'],
			'contents_location'		=>$editorial_data['CONTENTS_LOCATION'],
            'size_type'             =>$editorial_data['SIZE_TYPE']
		);
	}
}

?>