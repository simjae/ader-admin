<?php
/*
 +=============================================================================
 | 
 | 스토리 관리 화면 - 스토리 개별 조회
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

$story_idx	= $_POST['story_idx'];

if ($story_idx != null) {
	$select_posting_story_sql = "
		SELECT
			PS.IDX					AS STORY_IDX,
			PS.COUNTRY				AS COUNTRY,
			PS.STORY_TYPE			AS STORY_TYPE,
			PS.PAGE_IDX				AS PAGE_IDX,
			REPLACE(
				PS.IMG_LOCATION,
				'/var/www/admin/www',
				''
			)						AS IMG_LOCATION,
			PS.STORY_TITLE			AS STORY_TITLE,
			PS.STORY_SUB_TITLE		AS STORY_SUB_TITLE,
			PS.STORY_MEMO			AS STORY_MEMO
		FROM
			TMP_POSTING_STORY PS
		WHERE
			PS.IDX = ".$story_idx."
	";
	
	$db->query($select_posting_story_sql);
	
	foreach($db->fetch() as $story_data) {
		$story_type = $story_data['STORY_TYPE'];
		$page_idx = $story_data['PAGE_IDX'];
		
		$collection_info = array();
		$page_info = array();
		
		if (!empty($story_type) && !empty($page_idx)) {
			if ($story_type != "COLC") {
				$select_page_posting_sql = "
					SELECT
						PP.POSTING_TYPE			AS POSTING_TYPE,
						PP.PAGE_TITLE			AS PAGE_TITLE,
						IFNULL(
							PP.PAGE_MEMO,
							'-'
						)						AS PAGE_MEMO,
						CONCAT(
							PP.PAGE_URL,
							PP.IDX
						)						AS PAGE_URL,
						PP.PAGE_VIEW			AS PAGE_VIEW,
						PP.DISPLAY_FLG			AS DISPLAY_FLG,
						DATE_FORMAT(
							PP.DISPLAY_START_DATE, '%Y-%m-%d %H:%i'
						)						AS DISPLAY_START_DATE,
						DATE_FORMAT(
							PP.DISPLAY_END_DATE, '%Y-%m-%d %H:%i'
						)						AS DISPLAY_END_DATE,
						PP.CREATE_DATE			AS CREATE_DATE,
						PP.CREATER				AS CREATER,
						PP.UPDATE_DATE			AS UPDATE_DATE,
						PP.UPDATER				AS UPDATER
					FROM
						PAGE_POSTING PP
					WHERE
						PP.IDX = ".$page_idx."
				";
				
				$db->query($select_page_posting_sql);
				
				foreach($db->fetch() as $page_data) {
					$posting_type = $page_data['POSTING_TYPE'];
					
					$txt_posting_type = "";
					switch ($posting_type) {
						case "RNWY" :
							$txt_posting_type = "런웨이";
							break;
						
						case "EDTL" :
							$txt_posting_type = "에디토리얼";
							break;
					}
					
					$display_status = "";
					$display_date = "";
					
					$display_flg = $page_data['DISPLAY_FLG'];
					$display_start_date = $page_data['DISPLAY_START_DATE'];
					$display_end_date = $page_data['DISPLAY_END_DATE'];
					
					if ($display_flg == false) {
						$display_status = "진열안함";
					} else if ($display_flg == true) {
						if ($display_end_date == '9999-12-31 23:59') {
							$display_status = "상시진열";
						} else {
							if (strtotime($display_start_date) >= $now) {
								$display_status = "진열대기";
							} else if (strtotime($display_end_date) < $now) {
								$display_status = "진열종료";
							} else if (strtotime($display_start_date) <= $now && strtotime($display_end_date) >= $now) {
								$display_status = "진열중";
							}
						}
					}
					
					$page_info = array(
						'posting_type'			=>$page_data['POSTING_TYPE'],
						'txt_posting_type'		=>$txt_posting_type,
						'page_name'				=>$page_data['PAGE_NAME'],
						'page_memo'				=>$page_data['PAGE_MEMO'],
						'page_title'			=>$page_data['PAGE_TITLE'],
						'page_url'				=>$page_data['PAGE_URL'],
						'page_view'				=>$page_data['PAGE_VIEW'],
						'display_status'		=>$display_status,
						'display_start_date'	=>$display_start_date,
						'display_end_date'		=>$display_end_date,
						'create_date'			=>$page_data['CREATE_DATE'],
						'creater'				=>$page_data['CREATER'],
						'update_date'			=>$page_data['UPDATE_DATE'],
						'updater'				=>$page_data['UPDATER'],
					);
				}
			} else {
				$select_collection_project_sql = "
					SELECT
						CP.PROJECT_NAME			AS PROJECT_NAME,
						CP.PROJECT_DESC			AS PROJECT_DESC,
						CP.PROJECT_TITLE		AS PROJECT_TITLE,
						CONCAT(
							'/posting/lookbook?country=',
							CP.COUNTRY,
							'&project_idx=',
							CP.IDX
						)						AS PROJECT_URL,
						CP.CREATE_DATE			AS CREATE_DATE,
						CP.CREATER				AS CREATER,
						CP.UPDATE_DATE			AS UPDATE_DATE,
						CP.UPDATER				AS UPDATER
					FROM
						COLLECTION_PROJECT CP
					WHERE
						CP.IDX = ".$page_idx."
				";
				
				$db->query($select_collection_project_sql);
				
				foreach($db->fetch() as $collection_data) {
					$collection_info = array(
						'project_name'		=>$collection_data['PROJECT_NAME'],
						'project_desc'		=>$collection_data['PROJECT_DESC'],
						'project_title'		=>$collection_data['PROJECT_TITLE'],
						'project_url'		=>$collection_data['PROJECT_URL'],
						'create_date'		=>$collection_data['CREATE_DATE'],
						'creater'			=>$collection_data['CREATER'],
						'update_date'		=>$collection_data['UPDATE_DATE'],
						'updater'			=>$collection_data['UPDATER']
					);
				}
			}
		}
		
		$json_result['data'][] = array(
			'story_idx'					=>$story_data['STORY_IDX'],
			'story_type'				=>$story_data['STORY_TYPE'],
			'page_idx'					=>$story_data['PAGE_IDX'],
			'img_location'				=>$story_data['IMG_LOCATION'],
			'country'					=>$story_data['COUNTRY'],
			'story_title'				=>$story_data['STORY_TITLE'],
			'story_sub_title'			=>$story_data['STORY_SUB_TITLE'],
			'story_memo'				=>$story_data['STORY_MEMO'],
			'active_flg'				=>$story_data['ACTIVE_FLG'],
			
			'page_info'					=>$page_info,
			'collection_info'			=>$collection_info
		);
	}
}
?>