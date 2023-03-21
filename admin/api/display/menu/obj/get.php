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
		$obj_table = " TMP_MENU_SLIDE MO ";
		
		break;
	
	case "UP" :
		$obj_table = " TMP_MENU_UPPER_FILTER MO ";
		break;
	
	case "LW" :
		$obj_table = " TMP_MENU_LOWER_FILTER MO ";
		break;
}

if ($obj_type == "SL" || $obj_type == "UP") {
	$img_sql = " MO.IMG_LOCATION	AS IMG_LOCATION, ";
}

$menu_obj_sql = "
	SELECT
		MO.IDX				AS OBJ_IDX,
		MO.OBJ_TITLE		AS OBJ_TITLE,
		".$img_sql."
		
		MO.LINK_TYPE		AS LINK_TYPE,
		MO.LINK_IDX			AS LINK_IDX,
		MO.LINK_URL			AS LINK_URL
	FROM
		".$obj_table."
	WHERE
		MO.IDX = ".$obj_idx;

$db->query($menu_obj_sql);

foreach($db->fetch() as $obj_data) {
	$link_type = $obj_data['LINK_TYPE'];
	$link_idx = $obj_data['LINK_IDX'];
	
	$link_info = null;
	if (!empty($link_type) && !empty($link_idx) && $link_idx > 0) {
		$link_info = getLinkInfo($db,$link_type,$link_idx);
	}
	
	$json_result['data'] = array(
		'obj_idx'		=>$obj_data['OBJ_IDX'],
		'link_type'		=>$link_type,
		'obj_title'		=>$obj_data['OBJ_TITLE'],
		'img_location'	=>$obj_data['IMG_LOCATION'],
		'link_type'		=>$obj_data['LINK_TYPE'],
		'link_url'		=>$obj_data['LINK_URL'],
		'link_idx'		=>$obj_data['LINK_IDX'],
		
		'link_info'		=>$link_info
	);
}

function getLinkInfo($db,$link_type,$link_idx) {
	$link_info = array();
	
	$link_table = "";
	$select_posting_type = "";
	
	switch ($link_type) {
		case "PR" :
			$link_table = " PAGE_PRODUCT ";
			$select_posting_type = " '상품'				AS POSTING_TYPE, ";
			break;
		
		case "PO" :
			$link_table = " PAGE_POSTING ";
			$select_posting_type = " PP.POSTING_TYPE	AS POSTING_TYPE, ";
			break;
		
		case "ML" :
			$link_table = " MENU_LRG ";
			break;
		
		case "MM" :
			$link_table = " MENU_MDL ";
			break;
		
		case "MS" :
			$link_table = " MENU_SML ";
			break;
	}
	
	if ($link_type == "PR" || $link_type == "PO") {
		$select_link_sql = "
			SELECT
				PP.IDX					AS PAGE_IDX,
				".$select_posting_type."
				PP.PAGE_TITLE			AS PAGE_TITLE,
				PP.PAGE_MEMO			AS PAGE_MEMO,
				PP.PAGE_URL				AS PAGE_URL,
				
				PP.DISPLAY_FLG			AS DISPLAY_FLG,
				DATE_FORMAT(
					PP.DISPLAY_START_DATE, '%Y-%m-%d %H:%i'
				)						AS DISPLAY_START_DATE,
				DATE_FORMAT(
					PP.DISPLAY_END_DATE, '%Y-%m-%d %H:%i'
				)						AS DISPLAY_END_DATE,
				
				PP.PAGE_VIEW			AS PAGE_VIEW,
				
				PP.CREATE_DATE			AS CREATE_DATE,
				PP.CREATER				AS CREATER,
				PP.UPDATE_DATE			AS UPDATE_DATE,
				PP.UPDATER				AS UPDATER
			FROM
				".$link_table." PP
			WHERE
				PP.IDX = ".$link_idx."
		";
		
		$db->query($select_link_sql);
		
		foreach($db->fetch() as $link_data) {
			$posting_type = $link_data['POSTING_TYPE'];
			switch ($posting_type) {
				case "COLA" :
					$posting_type = "콜라보레이션";
					break;
				
				case "COLC" :
					$posting_type = "콜렉션";
					break;
				
				case "EDTL" :
					$posting_type = "에디토리얼";
					break;
				
				case "RNWY" :
					$posting_type = "런웨이";
					break;
			}
			
			$now = strtotime(date('Y-m-d H:i:s'));
			
			$display_status = "";
			
			$display_flg = $link_data['DISPLAY_FLG'];
			$display_start_date = $link_data['DISPLAY_START_DATE'];
			$display_end_date = $link_data['DISPLAY_END_DATE'];
			
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
			
			$link_info = array(
				'link_type'				=>$link_type,
				
				'posting_type'			=>$posting_type,
				'page_title'			=>$link_data['PAGE_TITLE'],
				'page_memo'				=>$link_data['PAGE_MEMO'],
				'page_url'				=>$link_data['PAGE_URL'].$link_data['PAGE_IDX'],
				
				'display_status'		=>$display_status,
				'display_start_date'	=>$link_data['DISPLAY_START_DATE'],
				'display_end_date'		=>$link_data['DISPLAY_END_DATE'],
				
				'page_view'				=>$link_data['PAGE_VIEW'],
				
				'menu_titla'			=>$link_data['MENU_TITLE'],
				'menu_location'			=>$link_data['MENU_LOCATION'],
				'menu_url'				=>$link_data['MENU_URL'],
				
				'create_date'			=>$link_data['CREATE_DATE'],
				'creater'				=>$link_data['CREATER'],
				'update_date'			=>$link_data['UPDATE_DATE'],
				'updater'				=>$link_data['UPDATER']
			);
		}
	} else if ($link_type == "ML" || $link_type == "MM" || $link_type == "MS") {
		$select_link_sql = "
			SELECT
				MENU_TITLE				AS MENU_TITLE,
				MENU_LOCATION			AS MENU_LOCATION,
				MENU_URL				AS MENU_URL
			FROM
				".$link_table."
			WHERE
				IDX = ".$link_idx."
		";
		
		$db->query($select_link_sql);
		
		foreach($db->fetch() as $link_data) {
			$link_info = array(
				'link_type'			=>"MN",
				
				'posting_type'		=>"메뉴",
				'menu_title'		=>$link_data['MENU_TITLE'],
				'menu_location'		=>$link_data['MENU_LOCATION']
			);
		}
	}
	
	return $link_info;
}
?>