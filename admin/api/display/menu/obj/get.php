<?php
/*
 +=============================================================================
 | 
 | 메뉴 관리 - 메뉴 obj 정보 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.12.22
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$country	= $_POST['country'];
$obj_type	= $_POST['obj_type'];
$obj_idx	= $_POST['obj_idx'];

$obj_table = "";
$type_sql = "";
$title_sql = "";
$img_sql = "";

switch ($obj_type) {
	case "SL" :
		$obj_table = " dev.TMP_MENU_SLIDE MO ";
		
		break;
	
	case "UP" :
		$obj_table = " dev.TMP_MENU_UPPER_FILTER MO ";
		break;
	
	case "LW" :
		$obj_table = " dev.TMP_MENU_LOWER_FILTER MO ";
		break;
}

if ($obj_type == "SL" || $obj_type == "UP") {
	$img_sql = " MO.IMG_LOCATION	AS IMG_LOCATION, ";
}

$menu_obj_sql = "
	SELECT
		MO.IDX				AS OBJ_IDX,
		MO.LINK_TYPE		AS LINK_TYPE,
		MO.OBJ_TITLE		AS OBJ_TITLE,
		".$img_sql."
		MO.PAGE_IDX			AS PAGE_IDX
	FROM
		".$obj_table."
	WHERE
		MO.IDX = ".$obj_idx;

$db->query($menu_obj_sql);

foreach($db->fetch() as $obj_data) {
	$page_idx = $obj_data['PAGE_IDX'];
	
	$page_info = array();
	if (!empty($page_idx) && $page_idx > 0) {
		$link_type = $obj_data['LINK_TYPE'];
		
		$obj_page_sql = "";
		if ($link_type == "PR") {
			$obj_page_sql = "
				SELECT
					NULL					AS POSTING_TYPE,
					PPR.PAGE_TITLE			AS PAGE_TITLE,
					PPR.PAGE_MEMO			AS PAGE_MEMO,
					PPR.PAGE_URL				AS PAGE_URL,
					PPR.DISPLAY_FLG			AS DISPLAY_FLG,
					DATE_FORMAT(
						PPR.DISPLAY_START_DATE, '%Y-%m-%d %H:%i'
					)						AS DISPLAY_START_DATE,
					DATE_FORMAT(
						PPR.DISPLAY_END_DATE, '%Y-%m-%d %H:%i'
					)						AS DISPLAY_END_DATE,
					PPR.PAGE_VIEW			AS PAGE_VIEW,
					PPR.CREATE_DATE			AS CREATE_DATE,
					PPR.CREATER				AS CREATER,
					PPR.UPDATE_DATE			AS UPDATE_DATE,
					PPR.UPDATER				AS UPDATER
				FROM
					dev.PAGE_PRODUCT PPR
				WHERE
					PPR.IDX = ".$page_idx."
			";
		} else if ($link_type == "PO") {
			$obj_page_sql = "
				SELECT
					PPO.POSTING_TYPE			AS POSTING_TYPE,
					PPO.PAGE_TITLE			AS PAGE_TITLE,
					PPO.PAGE_MEMO			AS PAGE_MEMO,
					PPO.PAGE_URL				AS PAGE_URL,
					PPO.DISPLAY_FLG			AS DISPLAY_FLG,
					DATE_FORMAT(
						PPO.DISPLAY_START_DATE, '%Y-%m-%d %H:%i'
					)						AS DISPLAY_START_DATE,
					DATE_FORMAT(
						PPO.DISPLAY_END_DATE, '%Y-%m-%d %H:%i'
					)						AS DISPLAY_END_DATE,
					PPO.PAGE_VIEW			AS PAGE_VIEW,
					PPO.CREATE_DATE			AS CREATE_DATE,
					PPO.CREATER				AS CREATER,
					PPO.UPDATE_DATE			AS UPDATE_DATE,
					PPO.UPDATER				AS UPDATER
				FROM
					dev.PAGE_POSTING PPO
				WHERE
					PPO.IDX = ".$page_idx."
			";
		}
		
		$db->query($obj_page_sql);
		
		foreach($db->fetch() as $page_data) {
			$posting_type = "";
			if (!empty($page_data['POSTING_TYPE'])) {
				switch ($page_data['POSTING_TYPE']) {
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
			} else {
				$posting_type = "상품";
			}
			
			$now = strtotime(date('Y-m-d H:i:s'));
			
			$display_status = "";
			
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
			
			$page_info[] = array(
				'posting_type'			=>$posting_type,
				'page_title'			=>$page_data['PAGE_TITLE'],
				'page_memo'				=>$page_data['PAGE_MEMO'],
				'page_url'				=>$page_data['PAGE_URL'],
				'display_status'		=>$display_status,
				'display_start_date'	=>$display_start_date,
				'display_end_date'		=>$display_end_date,
				'page_view'				=>$page_data['PAGE_VIEW'],
				'create_date'			=>$page_data['CREATE_DATE'],
				'creater'				=>$page_data['CREATER'],
				'update_date'			=>$page_data['UPDATE_DATE'],
				'updater'				=>$page_data['UPDATER']
			);
		}
	}
	
	$json_result['data'][] = array(
		'obj_idx'		=>$obj_data['OBJ_IDX'],
		'link_type'		=>$link_type,
		'obj_title'		=>$obj_data['OBJ_TITLE'],
		'img_location'	=>$obj_data['IMG_LOCATION'],
		'page_idx'		=>$obj_data['PAGE_IDX'],
		'page_info'		=>$page_info
	);
}
?>