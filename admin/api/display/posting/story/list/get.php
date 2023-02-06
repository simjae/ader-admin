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
	$sql = "SELECT
				PS.IDX				AS STORY_IDX,
				PS.STORY_COLUMN		AS STORY_COLUMN,
				PS.DISPLAY_NUM		AS DISPLAY_NUM,
				IFNULL(
					REPLACE(
						PS.IMG_LOCATION,
						'/var/www/admin/www',''
					),
					'/images/default_thumbnail_img.jpg'
				)					AS IMG_LOCATION,
				PS.STORY_TITLE		AS STORY_TITLE,
				PS.STORY_SUB_TITLE	AS STORY_SUB_TITLE,
				PS.ACTIVE_FLG		AS ACTIVE_FLG
			FROM
				dev.TMP_POSTING_STORY PS
			WHERE
				PS.COUNTRY = '".$country."' AND
				PS.DEL_FLG = FALSE
			ORDER BY
				PS.DISPLAY_NUM ASC";
	
	$db->query($sql);
	
	$column_01_new = array();
	$column_02_prj = array();
	$column_03_lkb = array();
	$column_04_edt = array();
	
	foreach($db->fetch() as $data) {
		$story_column = $data['STORY_COLUMN'];
		
		switch ($story_column) {
			case 1 :
				$column_01_new[] = array(
					'story_idx'			=>$data['STORY_IDX'],
					'story_column'		=>$data['STORY_COLUMN'],
					'display_num'		=>$data['DISPLAY_NUM'],
					'img_location'		=>$data['IMG_LOCATION'],
					'story_title'		=>$data['STORY_TITLE'],
					'story_sub_title'	=>$data['STORY_SUB_TITLE'],
					'active_flg'		=>$data['ACTIVE_FLG']
				);
				break;
			
			case 2 :
				$column_02_prj[] = array(
					'story_idx'			=>$data['STORY_IDX'],
					'story_column'		=>$data['STORY_COLUMN'],
					'display_num'		=>$data['DISPLAY_NUM'],
					'img_location'		=>$data['IMG_LOCATION'],
					'story_title'		=>$data['STORY_TITLE'],
					'story_sub_title'	=>$data['STORY_SUB_TITLE'],
					'active_flg'		=>$data['ACTIVE_FLG']
				);
				break;
			
			case 3 :
				$column_03_lkb[] = array(
					'story_idx'			=>$data['STORY_IDX'],
					'story_column'		=>$data['STORY_COLUMN'],
					'display_num'		=>$data['DISPLAY_NUM'],
					'img_location'		=>$data['IMG_LOCATION'],
					'story_title'		=>$data['STORY_TITLE'],
					'story_sub_title'	=>$data['STORY_SUB_TITLE'],
					'active_flg'		=>$data['ACTIVE_FLG']
				);
				break;
			
			case 4 :
				$column_04_edt[] = array(
					'story_idx'			=>$data['STORY_IDX'],
					'story_column'		=>$data['STORY_COLUMN'],
					'display_num'		=>$data['DISPLAY_NUM'],
					'img_location'		=>$data['IMG_LOCATION'],
					'story_title'		=>$data['STORY_TITLE'],
					'story_sub_title'	=>$data['STORY_SUB_TITLE'],
					'active_flg'		=>$data['ACTIVE_FLG']
				);
				break;
		}
	}
	
	$json_result['data'][] = array(
		'column_01_new' =>$column_01_new,
		'column_02_prj' =>$column_02_prj,
		'column_03_lkb' =>$column_03_lkb,
		'column_04_edt' =>$column_04_edt
	);
}
?>