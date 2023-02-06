<?php
/*
 +=============================================================================
 | 
 | 전시정보 조회 - 게시물 스토리 모달_선택한 게시물 정보 조회
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

$page_idx	= $_POST['page_idx'];

if ($page_idx != null) {
	$sql = "SELECT
				PP.IDX					AS PAGE_IDX,
				PP.COUNTRY				AS COUNTRY,
				PP.POSTING_TYPE			AS POSTING_TYPE,
				PP.PAGE_TITLE			AS PAGE_TITLE,
				PP.PAGE_URL				AS PAGE_URL,
				PP.PAGE_MEMO			AS PAGE_MEMO,
				PP.DISPLAY_FLG			AS DISPLAY_FLG,
				DATE_FORMAT(
					PP.DISPLAY_START_DATE, '%Y-%m-%d %H:%i'
				)						AS DISPLAY_START_DATE,
				DATE_FORMAT(
					PP.DISPLAY_END_DATE, '%Y-%m-%d %H:%i'
				)						AS DISPLAY_END_DATE,
				PP.PAGE_VIEW			AS PAGE_VIEW,
				PP.CREATE_DATE			AS CREATE_DATE,
				PP.CREATER				AS CRATER,
				PP.UPDATE_DATE			AS UPDATE_DATE,
				PP.UPDATER				AS UPDATER
			FROM
				dev.PAGE_POSTING PP
			WHERE
				PP.IDX = ".$page_idx;

	$db->query($sql);

	foreach($db->fetch() as $data) {
		$now = strtotime(date('Y-m-d H:i:s'));
		
		$display_status = "";
		
		$display_flg = $data['DISPLAY_FLG'];
		$display_start_date = $data['DISPLAY_START_DATE'];
		$display_end_date = $data['DISPLAY_END_DATE'];
		
		if ($display_flg == 0) {
			$display_status == "진열안함";
		} else if ($display_flg == 1) {
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
			'page_idx'				=>$data['PAGE_IDX'],
			'country'				=>$data['COUNTRY'],
			'posting_type'			=>$data['POSTING_TYPE'],
			'page_title'			=>$data['PAGE_TITLE'],
			'page_url'				=>$data['PAGE_URL'],
			'page_memo'				=>$data['PAGE_MEMO'],
			'display_status'		=>$display_status,
			'display_start_date'	=>$data['DISPLAY_START_DATE'],
			'display_end_date'		=>$data['DISPLAY_END_DATE'],
			'page_view'				=>$data['PAGE_VIEW'],
			'create_date'			=>$data['CREATE_DATE'],
			'creater'				=>$data['CREATER'],
			'update_adte'			=>$data['UPDATE_DATE'],
			'updater'				=>$data['UPDATER']
		);
	}
}
?>