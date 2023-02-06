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

$country	= $_POST['country'];
$menu_sort	= $_POST['menu_sort'];
$menu_idx	= $_POST['menu_idx'];

if ($menu_sort != null && $menu_idx != null) {
	$menu_table = "";
	switch ($menu_sort) {
		case "L" :
			$menu_table = " dev.MENU_LRG MI ";
			break;
		
		case "M" :
			$menu_table = " dev.MENU_MDL MI ";
			break;
		
		case "S" :
			$menu_table = " dev.MENU_SML MI ";
			break;
	}
	
	$menu_link_sql = "";
	if ($menu_sort == "L" || $menu_sort == "M") {
		$menu_link_sql = "
			CASE
				WHEN
					MI.MENU_TYPE = 'PR'
					THEN
						(
							SELECT
								CONCAT(
									S_PPR.PAGE_URL,
									'menu_sort=".$menu_sort."&menu_idx=',
									MI.IDX
								)
							FROM
								dev.PAGE_PRODUCT S_PPR
							WHERE
								S_PPR.IDX = MI.PAGE_IDX
						)
				WHEN
					MI.MENU_TYPE = 'PO'
					THEN
						(
							SELECT
								CONCAT(
									S_PPO.PAGE_URL,
									'menu_sort=".$menu_sort."&menu_idx=',
									MI.IDX
								)
							FROM
								dev.PAGE_POSTING S_PPO
							WHERE
								S_PPO.IDX = MI.PAGE_IDX
						)
			END					AS MENU_LINK
		";
	} else if ($menu_sort == "S") {
		$menu_link_sql = "
			(
				SELECT
					CONCAT(
						S_PPR.PAGE_URL,
						'&menu_sort=".$menu_sort."&meu_idx=',
						MI.IDX
					)
				FROM
					dev.PAGE_PRODUCT S_PPR
				WHERE
					S_PPR.IDX = MI.PAGE_IDX
			)					AS MENU_LINK
		";
	}

	$select_menu_sql = "
		SELECT
			MI.IDX			AS MENU_IDX,
			MI.MENU_TYPE	AS MENU_TYPE,
			MI.MENU_TITLE	AS MENU_TITLE,
			".$menu_link_sql."
		FROM
			".$menu_table."
		WHERE
			MI.COUNTRY = '".$country."' AND
			MI.IDX = ".$menu_idx."
	";

	$db->query($select_menu_sql);

	foreach($db->fetch() as $data) {
		$json_result['data'][] = array(
			'menu_idx'		=>$data['MENU_IDX'],
			'menu_sort'		=>$menu_sort,
			'menu_type'		=>$data['MENU_TYPE'],
			'menu_title'	=>$data['MENU_TITLE'],
			'menu_link'		=>$data['MENU_LINK']
		);
	}
}
?>