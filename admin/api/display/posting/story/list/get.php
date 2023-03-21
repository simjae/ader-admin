<?php
/*
 +=============================================================================
 | 
 | 스토리 관리 화면 - 스토리 리스트 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.12.05
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$country	= $_POST['country'];

if ($country != null) {
	$select_posting_story_sql = "
		SELECT
			PS.IDX				AS STORY_IDX,
			PS.STORY_TYPE		AS STORY_TYPE,
			PS.DISPLAY_NUM		AS DISPLAY_NUM,
			IFNULL(
				REPLACE(
					PS.IMG_LOCATION,
					'/var/www/admin/www',''
				),
				'/images/default_thumbnail_img.jpg'
			)					AS IMG_LOCATION,
			PS.STORY_TITLE		AS STORY_TITLE,
			PS.STORY_SUB_TITLE	AS STORY_SUB_TITLE
		FROM
			TMP_POSTING_STORY PS
		WHERE
			PS.COUNTRY = '".$country."' AND
			PS.DEL_FLG = FALSE
		ORDER BY
			PS.DISPLAY_NUM ASC
	";
	
	$db->query($select_posting_story_sql);
	
	$column_NEW = array();
	$column_COLC = array();
	$column_RNWY = array();
	$column_EDTL = array();
	
	foreach($db->fetch() as $story_data) {
		$story_type = $story_data['STORY_TYPE'];
		
		switch ($story_type) {
			case "NEW" :
				$column_NEW[] = array(
					'story_idx'			=>$story_data['STORY_IDX'],
					'story_type'		=>$story_data['STORY_TYPE'],
					'display_num'		=>$story_data['DISPLAY_NUM'],
					'img_location'		=>$story_data['IMG_LOCATION'],
					'story_title'		=>$story_data['STORY_TITLE'],
					'story_sub_title'	=>$story_data['STORY_SUB_TITLE']
				);
				break;
			
			case "COLC" :
				$column_COLC[] = array(
					'story_idx'			=>$story_data['STORY_IDX'],
					'story_type'		=>$story_data['STORY_TYPE'],
					'display_num'		=>$story_data['DISPLAY_NUM'],
					'img_location'		=>$story_data['IMG_LOCATION'],
					'story_title'		=>$story_data['STORY_TITLE'],
					'story_sub_title'	=>$story_data['STORY_SUB_TITLE']
				);
				break;
			
			case "RNWY" :
				$column_RNWY[] = array(
					'story_idx'			=>$story_data['STORY_IDX'],
					'story_type'		=>$story_data['STORY_TYPE'],
					'display_num'		=>$story_data['DISPLAY_NUM'],
					'img_location'		=>$story_data['IMG_LOCATION'],
					'story_title'		=>$story_data['STORY_TITLE'],
					'story_sub_title'	=>$story_data['STORY_SUB_TITLE']
				);
				break;
			
			case "EDTL" :
				$column_EDTL[] = array(
					'story_idx'			=>$story_data['STORY_IDX'],
					'story_type'		=>$story_data['STORY_TYPE'],
					'display_num'		=>$story_data['DISPLAY_NUM'],
					'img_location'		=>$story_data['IMG_LOCATION'],
					'story_title'		=>$story_data['STORY_TITLE'],
					'story_sub_title'	=>$story_data['STORY_SUB_TITLE']
				);
				break;
		}
	}
	
	$json_result['data'][] = array(
		'column_NEW' =>$column_NEW,
		'column_COLC' =>$column_COLC,
		'column_RNWY' =>$column_RNWY,
		'column_EDTL' =>$column_EDTL
	);
}
?>