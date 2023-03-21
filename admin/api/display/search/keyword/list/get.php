<?php
/*
 +=============================================================================
 | 
 | 추천 검색어 리스트 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.11.28
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$country	= $_POST['country'];

if ($country != null) {
	$select_recommend_keyword_sql = "
		SELECT
			RK.IDX				AS KEYWORD_IDX,
			RK.DISPLAY_NUM		AS DISPLAY_NUM,
			RK.KEYWORD_TXT		AS KEYWORD_TXT,
			IFNULL(
				RK.MENU_SORT,
				''
			)					AS MENU_SORT,
			RK.MENU_IDX			AS MENU_IDX
		FROM
			TMP_RECOMMEND_KEYWORD RK
		WHERE
			COUNTRY = '".$country."'
		ORDER BY
			DISPLAY_NUM ASC
	";
	
	$db->query($select_recommend_keyword_sql);
	
	$keyword_info = array();
	foreach($db->fetch() as $keyword_data) {
		$menu_sort = $keyword_data['MENU_SORT'];
		$menu_idx = $keyword_data['MENU_IDX'];
		
		$menu_param = "&menu_sort=".$keyword_data['MENU_SORT']."&menu_idx=".$keyword_data['MENU_IDX'];
		
		$link_info = array();
		if (!empty($menu_sort) && $menu_idx > 0) {
			$menu_table = "";
			switch ($menu_sort) {
				case "L" :
					$menu_table = "MENU_LRG";
					break;
				
				case "M" :
					$menu_table = "MENU_MDL";
					break;
				
				case "S" :
					$menu_table = "MENU_SML";
					break;
			}
			
			$select_menu_info_sql = "
				SELECT
					MI.MENU_TITLE		AS MENU_TITLE,
					MI.MENU_LOCATION	AS MENU_LOCATION,
					
					MI.LINK_TYPE		AS LINK_TYPE,
					MI.LINK_URL			AS LINK_URL
				FROM
					".$menu_table." MI
				WHERE
					MI.IDX = ".$menu_idx." AND
					MI.COUNTRY = '".$country."'
			";
			
			$db->query($select_menu_info_sql);
			
			foreach($db->fetch() as $menu_data) {
				$link_type = $menu_data['LINK_TYPE'];
				$link_url = $menu_data['LINK_URL'];
				
				$menu_link = "";
				if ($link_type != "EC") {
					$menu_link = $menu_data['LINK_URL'].$menu_param;
				} else {
					$menu_link = "http://".$menu_data['LINK_URL'];
				}
				
				$link_info = array(
					'menu_title'		=>$menu_data['MENU_TITLE'],
					'menu_location'		=>$menu_data['MENU_LOCATION'],
					'menu_link'			=>$menu_link
				);				
			}
		}
		
		if (empty($link_info) || $link_info == null) {
			$menu_type = "";
			$menu_title = "메뉴 미선택";
			$menu_location = "";
			$menu_link = "";
		} else {
			$menu_title = $link_info['menu_title'];
			$menu_location = $link_info['menu_location'];
			$menu_link = $link_info['menu_link'];
		}
		
		
		$keyword_info[] = array(
			'keyword_idx'	=>$keyword_data['KEYWORD_IDX'],
			'display_num'	=>$keyword_data['DISPLAY_NUM'],
			'keyword_txt'	=>$keyword_data['KEYWORD_TXT'],
			'menu_sort'		=>$keyword_data['MENU_SORT'],
			'menu_idx'		=>$keyword_data['MENU_IDX'],
			
			'menu_title'	=>$menu_title,
			'menu_location'	=>$menu_location,
			'menu_link'		=>$menu_link
		);
	}
	
	$json_result['data'] = $keyword_info;
}
?>