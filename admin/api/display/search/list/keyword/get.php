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
	$sort_sql = "
		SELECT
			RK.IDX			AS KEYWORD_IDX,
			RK.MENU_SORT	AS MENU_SORT
		FROM
			RECOMMEND_KEYWORD RK
		WHERE
			RK.COUNTRY = '".$country."'
	";

	$db->query($sort_sql);

	$keyword_info = array();
	foreach($db->fetch() as $keyword_data) {
		$keyword_idx = $keyword_data['KEYWORD_IDX'];
		$menu_sort = $keyword_data['MENU_SORT'];
		
		$menu_link_sql = "";
		$menu_table = "";
		switch ($menu_sort) {
			case "L" :
				$menu_table = " dev.MENU_LRG ";
				break;
			
			case "M" :
				$menu_table = " dev.MENU_MDL ";
				break;
			
			case "S" :
				$menu_table = " dev.MENU_SML ";
				break;
		}
		
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
		
		$sql = "
				SELECT
					RK.IDX			AS KEYWORD_IDX,
					RK.DISPLAY_NUM	AS DISPLAY_NUM,
					RK.KEYWORD_TXT	AS KEYWORD_TXT,
					MI.MENU_TYPE	AS MENU_TYPE,
					MI.MENU_TITLE	AS MENU_TITLE,
					".$menu_link_sql."
				FROM
					dev.RECOMMEND_KEYWORD RK
					LEFT JOIN ".$menu_table."MI ON
					RK.MENU_IDX = MI.IDX
				WHERE
					RK.IDX = ".$keyword_idx."
		";
		
		$db->query($sql);
		foreach($db->fetch() as $data) {
			$keyword_info[] = array(
				'keyword_idx'	=>$data['KEYWORD_IDX'],
				'display_num'	=>$data['DISPLAY_NUM'],
				'keyword_txt'	=>$data['KEYWORD_TXT'],
				'menu_type'		=>$data['MENU_TYPE'],
				'menu_title'	=>$data['MENU_TITLE'],
				'menu_link'		=>$data['MENU_LINK']
			);
		}
	}

	if ($keyword_info != null) {
		foreach((array) $keyword_info as $key => $value) {
			$sort[$key] = $value['display_num'];
		}
		array_multisort($sort, SORT_ASC, $keyword_info);

		$json_result['data'] = $keyword_info;
	}
}
?>