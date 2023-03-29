<?php
/*
 +=============================================================================
 | 
 | 메뉴 관리 - 전체 메뉴 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.12.20
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$country	 = $_POST['country'];

$select_menu_lrg_sql = "
	SELECT
		ML.IDX			AS MENU_LRG_IDX,
		ML.MENU_TITLE	AS MENU_TITLE,
		ML.LINK_TYPE	AS LINK_TYPE
	FROM
		TMP_MENU_LRG ML
	WHERE
		ML.COUNTRY = '".$country."' AND
		ML.DEL_FLG = FALSE
";

$db->query($select_menu_lrg_sql);

$menu_lrg = array();
foreach($db->fetch() as $menu_lrg_data) {
	$menu_lrg_idx = $menu_lrg_data['MENU_LRG_IDX'];
	
	$menu_mdl = array();
	if (!empty($menu_lrg_idx)) {
		$select_menu_mdl_sql = "
			SELECT
				MM.IDX			AS MENU_MDL_IDX,
				MM.MENU_TITLE	AS MENU_TITLE,
				MM.LINK_TYPE	AS LINK_TYPE
				
			FROM
				TMP_MENU_MDL MM
			WHERE
				MM.MENU_LRG_IDX = ".$menu_lrg_idx." AND
				MM.COUNTRY = '".$country."' AND
				MM.DEL_FLG = FALSE
		";
		
		$db->query($select_menu_mdl_sql);
		
		foreach($db->fetch() as $menu_mdl_data) {
			$menu_mdl_idx = $menu_mdl_data['MENU_MDL_IDX'];
			$menu_mdl_type = $menu_mdl_data['LINK_TYPE'];
			
			$menu_sml = array();
			if (!empty($menu_mdl_idx)) {
				$select_menu_sml_sql = "
					SELECT
						MS.IDX			AS MENU_SML_IDX,
						MS.MENU_TITLE	AS MENU_TITLE
					FROM
						TMP_MENU_SML MS
					WHERE
						MS.MENU_MDL_IDX = ".$menu_mdl_idx." AND
						MS.COUNTRY = '".$country."' AND
						MS.DEL_FLG = FALSE
				";
				
				$db->query($select_menu_sml_sql);
				
				foreach($db->fetch() as $menu_sml_data) {
					$menu_sml[] = array(
						'menu_sml_idx'	=>$menu_sml_data['MENU_SML_IDX'],
						'menu_title'	=>$menu_sml_data['MENU_TITLE']
					);
				}
			}
			
			$menu_mdl[] = array(
				'menu_mdl_idx'	=>$menu_mdl_idx,
				'menu_title'	=>$menu_mdl_data['MENU_TITLE'],
				'menu_type'		=>$menu_mdl_type,
				
				'menu_sml'		=>$menu_sml
			);
			
		}
	}
	
	$menu_lrg[] = array(
		'menu_lrg_idx'	=>$menu_lrg_data['MENU_LRG_IDX'],
		'menu_title'	=>$menu_lrg_data['MENU_TITLE'],
		'menu_type'		=>$menu_lrg_data['MENU_TYPE'],
		
		'menu_mdl'		=>$menu_mdl
	);
}

$json_result['data'][] = array(
	'menu_lrg'	=>$menu_lrg
);
?>