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
	$sql = "SELECT
				PS.IDX					AS STORY_IDX,
				PS.IMG_LOCATION			AS IMG_LOCATION,
				PS.STORY_TITLE			AS STORY_TITLE,
				PS.STORY_MEMO			AS STORY_MEMO,
				PS.ACTIVE_FLG			AS ACTIVE_FLG,
				
				PS.PAGE_IDX				AS PAGE_IDX,
				PP.POSTING_TYPE			AS POSTING_TYPE,
				PP.PAGE_TITLE			AS PAGE_TITLE,
				PP.PAGE_MEMO			AS PAGE_MEMO,
				PP.PAGE_URL				AS PAGE_URL,
				PP.PAGE_VIEW			AS PAGE_VIEW,
				PP.DISPLAY_FLG			AS DISPLAY_FLG,
				DATE_FORMAT(
					PP.DISPLAY_START_DATE, '%Y-%m-%d %H:%i'
				)						AS DISPLAY_START_DATE,
				DATE_FORMAT(
					PP.DISPLAY_END_DATE, '%Y-%m-%d %H:%i'
				)						AS DISPLAY_START_DATE,
				PP.CREATE_DATE			AS CREATE_DATE,
				PP.CREATER				AS CREATER,
				PP.UPDATE_DATE			AS UPDATE_DATE,
				PP.UPDATER				AS UPDATER
			FROM
				dev.TMP_POSTING_STORY PS
				LEFT JOIN dev.PAGE_POSTING PP ON
				PS.PAGE_IDX = PP.IDX
			WHERE
				PS.IDX = ".$story_idx;
	
	$db->query($sql);
	
	foreach($db->fetch() as $data) {
		$posting_type = "";
		switch ($data['POSTING_TYPE']) {
			case "COLA" :
				$posting_type = "콜라보레이션";
				break;
			
			case "COLC" :
				$posting_type = "콜렉션";
				break;
			
			case "EDTL" :
				$posting_type = "에디토리얼";
				break;
			
			case "EXHB" :
				$posting_type = "기획전";
				break;
			
			case "LKBK" :
				$posting_type = "룩북";
				break;
		}
		
		$now = strtotime(date('Y-m-d H:i:s'));
		
		$display_status = "";
		$display_flg = $data['DISPLAY_FLG'];
		$display_start_date = $data['DISPLAY_START_DATE'];
		$display_end_date = $data['DISPLAY_END_DATE'];
		
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
		
		$json_result['data'][] = array(
			'story_idx'				=>$data['STORY_IDX'],
			'img_location'			=>$data['IMG_LOCATION'],
			'country'				=>$data['COUNTRY'],
			'story_title'			=>$data['STORY_TITLE'],
			'story_memo'			=>$data['STORY_MEMO'],
			'active_flg'			=>$data['ACTIVE_FLG'],
			
			'page_idx'				=>$data['PAGE_IDX'],
			'posting_type'			=>$posting_type,
			'page_title'			=>$data['PAGE_TITLE'],
			'page_memo'				=>$data['PAGE_MEMO'],
			'page_url'				=>$data['PAGE_URL'],
			'page_view'				=>$data['PAGE_VIEW'],
			'display_status'		=>$display_status,
			'display_start_date'	=>$data['DISPLAY_START_DATE'],
			'display_end_date'		=>$data['DISPLAY_END_DATE'],
			'create_date'			=>$data['create_date'],
			'creater'				=>$data['creater'],
			'update_date'			=>$data['update_date'],
			'updater'				=>$data['updater']
		);
	}
}
?>