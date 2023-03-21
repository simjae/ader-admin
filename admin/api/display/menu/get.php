<?php
/*
 +=============================================================================
 | 
 | 메뉴 관리 - 메뉴 개별 정보 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.12.21
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$country	= $_POST['country'];
$menu_sort	= $_POST['menu_sort'];
$menu_idx	= $_POST['menu_idx'];

$menu_table = "";

$menu_lrg_idx_sql = "";
$menu_mdl_idx_sql = "";

switch ($menu_sort) {
	case "L" :
		$menu_table = "TMP_MENU_LRG MI";
		break;
	
	case "M" :
		$menu_table = "TMP_MENU_MDL MI";
		$menu_lrg_idx_sql = " MI.MENU_LRG_IDX	AS MENU_LRG_IDX, ";
		break;
	
	case "S" :
		$menu_table = "TMP_MENU_SML MI";
		$menu_mdl_idx_sql = " MI.MENU_MDL_IDX	AS MENU_MDL_IDX, ";
		break;
}

$select_menu_sql = "
	SELECT
		MI.IDX					AS MENU_IDX,
		'".$menu_sort."'		AS MENU_SORT,
		".$menu_lrg_idx_sql."
		".$menu_mdl_idx_sql."
		MI.MENU_TITLE			AS MENU_TITLE,
		MI.LINK_TYPE			AS LINK_TYPE, 
		MI.LINK_URL				AS LINK_URL, 
		MI.LINK_IDX				AS LINK_IDX
	FROM
		".$menu_table."
	WHERE
		MI.COUNTRY = '".$country."' AND
		MI.IDX = ".$menu_idx."
";

$db->query($select_menu_sql);

foreach($db->fetch() as $menu_data) {
	$link_type = $menu_data['LINK_TYPE'];
	$link_idx = $menu_data['LINK_IDX'];
	
	$link_info = null;
	if (!empty($link_type) && !empty($link_idx) && $link_idx > 0) {
		$link_info = getLinkInfo($db,$link_type,$link_idx);
	}
	
	$menu_slide = array();
	if ($menu_sort == "L") {
		$select_slide_sql = "
			SELECT
				ME.IDX				AS OBJ_IDX,
				ME.OBJ_TITLE		AS OBJ_TITLE,
				ME.IMG_LOCATION		AS IMG_LOCATION,
				ME.DISPLAY_NUM		AS DISPLAY_NUM
			FROM
				TMP_MENU_SLIDE ME
			WHERE
				ME.COUNTRY = '".$country."' AND
				ME.MENU_IDX = ".$menu_idx."
			ORDER BY
				ME.DISPLAY_NUM ASC
		";
		
		$db->query($select_slide_sql);
		
		foreach($db->fetch() as $slide_data) {
			$menu_slide[] = array(
				'obj_idx'		=>$slide_data['OBJ_IDX'],
				'obj_title'		=>$slide_data['OBJ_TITLE'],
				'img_location'	=>$slide_data['IMG_LOCATION'],
				'display_num'	=>$slide_data['DISPLAY_NUM']
			);
		}
	}
	
	$up_filter = array();
	$up_filter_sql = "
		SELECT
			MU.IDX				AS OBJ_IDX,
			MU.OBJ_TITLE		AS OBJ_TITLE,
			MU.IMG_LOCATION		AS IMG_LOCATION,
			MU.DISPLAY_NUM		AS DISPLAY_NUM
		FROM
			TMP_MENU_UPPER_FILTER MU
		WHERE
			MU.COUNTRY = '".$country."' AND
			MU.MENU_SORT = '".$menu_sort."' AND
			MU.MENU_IDX = ".$menu_idx."
		ORDER BY
			DISPLAY_NUM ASC
	";
	
	$db->query($up_filter_sql);
	
	foreach($db->fetch() as $up_filter_data) {
		$up_filter[] = array(
			'obj_idx'		=>$up_filter_data['OBJ_IDX'],
			'obj_title'		=>$up_filter_data['OBJ_TITLE'],
			'img_location'	=>$up_filter_data['IMG_LOCATION'],
			'display_num'	=>$up_filter_data['DISPLAY_NUM']
		);
	}
	
	$lw_filter = array();
	$lw_filter_sql = "
		SELECT
			ML.IDX				AS OBJ_IDX,
			ML.OBJ_TITLE		AS OBJ_TITLE,
			ML.DISPLAY_NUM		AS DISPLAY_NUM
		FROM
			TMP_MENU_LOWER_FILTER ML
		WHERE
			ML.COUNTRY = '".$country."' AND
			ML.MENU_SORT = '".$menu_sort."' AND
			ML.MENU_IDX = ".$menu_idx."
		ORDER BY
			ML.DISPLAY_NUM
	";
	
	$db->query($lw_filter_sql);
	
	foreach($db->fetch() as $lw_filter_data) {
		$lw_filter[] = array(
			'obj_idx'		=>$lw_filter_data['OBJ_IDX'],
			'obj_title'		=>$lw_filter_data['OBJ_TITLE'],
			'display_num'	=>$lw_filter_data['DISPLAY_NUM']
		);
	}
	
	$json_result['data'][] = array(
		'menu_idx'				=>$menu_data['MENU_IDX'],
		'menu_sort'				=>$menu_data['MENU_SORT'],
		'menu_lrg_idx'			=>$menu_data['MENU_LRG_IDX'],
		'menu_mdl_idx'			=>$menu_data['MENU_MDL_IDX'],
		'menu_title'			=>$menu_data['MENU_TITLE'],
		'link_type'				=>$menu_data['LINK_TYPE'],
		'link_url'				=>$menu_data['LINK_URL'],
		'link_idx'				=>$menu_data['LINK_IDX'],
		
		'link_info'				=>$link_info,
		
		'menu_slide'			=>$menu_slide,
		'up_filter'				=>$up_filter,
		'lw_filter'				=>$lw_filter
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