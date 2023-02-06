<?php
/*
 +=============================================================================
 | 
 | 전시정보 조회 - 게시물 리스트_개별 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.12.06
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$list_idx		= $_POST['list_idx'];

if ($list_idx != null) {
	$sql = "SELECT
				PL.IDX					AS LIST_IDX,
				PL.COUNTRY				AS COUNTRY,
				PL.LIST_TITLE			AS LIST_TITLE,
				PL.LIST_MEMO			AS LIST_MEMO,
				PL.LIST_IMG_LOCATION	AS LIST_IMG_LOCATION,
				PL.DISPLAY_FLG		AS LIST_DISPLAY_FLG,
				DATE_FORMAT(
					PL.DISPLAY_START_DATE, '%Y-%m-%d'
				)						AS LIST_FROM_DATE,
				DATE_FORMAT(
					PL.DISPLAY_START_DATE, '%H'
				)						AS LIST_FROM_H,
				DATE_FORMAT(
					PL.DISPLAY_START_DATE, '%i'
				)						AS LIST_FROM_M,
				DATE_FORMAT(
					PL.DISPLAY_END_DATE, '%Y-%m-%d'
				)						AS LIST_TO_DATE,
				DATE_FORMAT(
					PL.DISPLAY_END_DATE, '%H'
				)						AS LIST_TO_H,
				DATE_FORMAT(
					PL.DISPLAY_END_DATE, '%i'
				)						AS LIST_TO_M,
				
				PP.IDX					AS PAGE_IDX,
				PP.COUNTRY				AS POSTING_COUNTRY,
				PP.POSTING_TYPE			AS POSTING_TYPE,
				PP.PAGE_TITLE			AS PAGE_TITLE,
				PP.PAGE_URL				AS PAGE_URL,
				PP.PAGE_MEMO			AS PAGE_MEMO,
				PP.DISPLAY_FLG			AS POSTING_DISPLAY_FLG,
				DATE_FORMAT(
					PP.DISPLAY_START_DATE, '%Y-%m-%d %H:%i'
				)						AS POSTING_START_DATE,
				DATE_FORMAT(
					PP.DISPLAY_END_DATE, '%Y-%m-%d %H:%i'
				)						AS POSTING_END_DATE,
				PP.PAGE_VIEW			AS PAGE_VIEW,
				PP.CREATE_DATE			AS CREATE_DATE,
				PP.CREATER				AS CREATER,
				PP.UPDATE_DATE			AS UPDATE_DATE,
				PP.UPDATER				AS UPDATER
			FROM
				dev.POSTING_LIST PL
				LEFT JOIN dev.PAGE_POSTING PP ON
				PL.PAGE_IDX = PP.IDX
			WHERE
				PL.IDX = ".$list_idx;
	
	$db->query($sql);
	
	foreach($db->fetch() as $data) {
		$posting_country = "";
		switch ($data['POSTING_COUNTRY']) {
			case "KR" :
				$posting_country = "한국몰";
				break;
			
			case "EN" :
				$posting_country = "영문몰";
				break;
			
			case "CN" :
				$posting_country = "중문몰";
				break;
		}
		
		$posting_type_str = "";
		$posting_type = $data['POSTING_TYPE'];
		switch ($posting_type) {
			case "COLA" :
				$posting_type_str = "콜라보레이션";
				break;
			
			case "COLC" :
				$posting_type_str = "컬렉션";
				break;
			
			case "EDTL" :
				$posting_type_str = "에디토리얼";
				break;

			case "EXHB" :
				$posting_type_str = "기획전";
				break;

			case "LKBK" :
				$posting_type_str = "룩북";
				break;
		}
		
		$now = strtotime(date('Y-m-d H:i:s'));
		
		$display_status = "";
		
		$display_flg = $data['POSTING_DISPLAY_FLG'];
		$display_start_date = $data['POSTING_START_DATE'];
		$display_end_date = $data['POSTING_END_DATE'];
		
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
			'list_idx'					=>$data['LIST_IDX'],
			'country'					=>$data['COUNTRY'],
			'list_title'				=>$data['LIST_TITLE'],
			'list_memo'					=>$data['LIST_MEMO'],
			'list_img_location'			=>$data['LIST_IMG_LOCATION'],
			'list_display_flg'			=>$data['LIST_DISPLAY_FLG'],
			'list_from_date'			=>$data['LIST_FROM_DATE'],
			'list_from_h'				=>$data['LIST_FROM_H'],
			'list_from_m'				=>$data['LIST_FROM_M'],
			'list_to_date'				=>$data['LIST_TO_DATE'],
			'list_to_h'					=>$data['LIST_TO_H'],
			'list_to_m'					=>$data['LIST_TO_M'],
			
			'page_idx'					=>$data['PAGE_IDX'],
			'posting_country'			=>$posting_country,
			'posting_type'				=>$posting_type_str,
			'page_title'				=>$data['PAGE_TITLE'],
			'page_url'					=>$data['PAGE_URL'],
			'page_memo'					=>$data['PAGE_MEMO'],
			'posting_display_status'	=>$display_status,
			'posting_start_date'		=>$display_start_date,
			'posting_end_date'			=>$display_end_date,
			'page_view'					=>$data['PAGE_VIEW'],
			'create_date'				=>$data['CREATE_DATE'],
			'creater'					=>$data['CREATER'],
			'update_date'				=>$data['UPDATE_DATE'],
			'updater'					=>$data['UPDATER']
		);
	}
}
?>