<?php
/*
 +=============================================================================
 | 
 | 런웨이 관리 화면 - 런웨이 썸네일/컨텐츠 정보 조회
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
$size_type			= $_POST['size_type'];

if ($page_idx != null) {
	$select_page_posting_sql = "
		SELECT
			PP.IDX					AS PAGE_IDX,
			PP.COUNTRY				AS COUNTRY,
			PP.PAGE_TITLE			AS PAGE_TITLE,
			PP.PAGE_URL				AS PAGE_URL,
			PP.PAGE_MEMO			AS PAGE_MEMO
		FROM
			PAGE_POSTING PP
		WHERE
			PP.IDX = ".$page_idx."
	";
	
	$db->query($select_page_posting_sql);
	
	$page_info = array();
	foreach($db->fetch() as $page_data) {
		$country = "";
		switch ($page_data['COUNTRY']) {
			case "KR" :
				$country = "한국몰";
				break;
			
			case "EN" :
				$country = "영문몰";
				break;
			
			case "CN" :
				$country = "중문몰";
				break;
		}
		$page_info = array(
			'country'		=>$country,
			'page_title'	=>$page_data['PAGE_TITLE'],
			'page_url'		=>$page_data['PAGE_URL'].$page_data['PAGE_IDX'],
			'page_memo'		=>$page_data['PAGE_MEMO']
		);
	}
	
	$json_result['page_info'] = $page_info;
	
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
			RT.IDX = RC.THUMB_IDX
		WHERE
			RT.PAGE_IDX = ".$page_idx." AND
			RT.DEL_FLG = FALSE AND
			RT.SIZE_TYPE = '".$size_type."' AND
			RC.DEL_FLG = FALSE
		ORDER BY
			RT.DISPLAY_NUM ASC
	";
	
	$db->query($select_runway_sql);
	
	foreach($db->fetch() as $runway_data) {
		$json_result['data'][] = array(
			'thumb_idx'				=>$runway_data['THUMB_IDX'],
			'display_num'			=>$runway_data['DISPLAY_NUM'],
			'thumb_type'			=>$runway_data['THUMB_TYPE'],
			'size_type'				=>$runway_data['SIZE_TYPE'],
			'thumb_location'		=>$runway_data['THUMB_LOCATION'],
			'thumb_url'				=>$runway_data['THUMB_URL'],
			
			'contents_idx'			=>$runway_data['CONTENTS_IDX'],
			'contents_type'			=>$runway_data['CONTENTS_TYPE'],
			'size_type'				=>$runway_data['SIZE_TYPE'],
			'contents_location'		=>$runway_data['CONTENTS_LOCATION'],
			'contents_url'			=>$runway_data['CONTENTS_URL']
		);
	}
} else {
	$json_result['code'] = 301;
	$json_rsult['mst'] = "존재하지 않는 런웨이 진열 페이지 입니다.";
}

?>