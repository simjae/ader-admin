<?php
/*
 +=============================================================================
 | 
 | 전시관리 게시물 조회 API
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.08.22
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$tmp_flg				= $_POST['tmp_flg'];
$table_type 			= $_POST['table_type'];
$menu_idx 				= $_POST['menu_idx'];

$tbl_menu = array();
if ($tmp_flg == "true") {
	$tbl_menu[0] = "dev.TMP_MENU_LRG";
	$tbl_menu[1] = "dev.TMP_MENU_MDL";
	$tbl_menu[2] = "dev.TMP_MENU_SML";
} else {
	$tbl_menu[0] = "dev.MENU_LRG";
	$tbl_menu[1] = "dev.MENU_MDL";
	$tbl_menu[2] = "dev.MENU_SML";
}

$table = "";
if ($table_type != null) {
	switch ($table_type) {
		case "LRG" :
			$table = $tbl_menu[0];
			break;
		case "MDL" :
			$table = $tbl_menu[1];
			break;
		case "SML" :
			$table = $tbl_menu[2];
			break;
	}
}

if ($table_type != null && $menu_idx != null) {
	$select = " IDX,
				MENU_".$table_type."_TITLE,
				MENU_".$table_type."_URL
			";
	if ($table_type != "SML") {
		$select .= " ,MENU_".$table_type."_TYPE ";
	}

	$sql  = "SELECT
				".$select."
			FROM
				".$table."
			WHERE
				IDX =".$menu_idx;
	
	$db->query($sql);
	foreach($db->fetch() as $menu_data) {
		$json_result['data'][] = array(
			'menu_idx'		=>$menu_data['IDX'],
			'menu_title'	=>$menu_data['MENU_'.$table_type.'_TITLE'],
			'menu_url'		=>$menu_data['MENU_'.$table_type.'_URL'],
			'menu_type'		=>$menu_data['MENU_'.$table_type.'_TYPE']
		);
	}
} else {
	$lrg_sql = "SELECT
					IDX,
					MENU_LRG_TITLE,
					MENU_LRG_TYPE,
					MENU_LRG_URL
				FROM
					".$tbl_menu[0]."
				WHERE
					DEL_FLG = FALSE";

	$db->query($lrg_sql);

	foreach($db->fetch() as $lrg_data) {
		if ($lrg_data['IDX'] != null) {
			$lrg_idx = intval($lrg_data['IDX']);
			
			$mdl_sql = "SELECT
							IDX,
							MENU_MDL_TITLE,
							MENU_MDL_TYPE,
							MENU_MDL_URL
						FROM
							".$tbl_menu[1]."
						WHERE
							MENU_LRG_IDX = ".$lrg_idx."
							AND DEL_FLG = FALSE";
			
			$db->query($mdl_sql);
			
			$menu_mdl_data = array();
			foreach($db->fetch() as $mdl_data) {
				if ($mdl_data['IDX'] != null) {
					$mdl_idx = intval($mdl_data['IDX']);
					
					$sml_sql = "SELECT
									IDX,
									MENU_SML_TITLE,
									MENU_SML_URL
								FROM
									".$tbl_menu[2]."
								WHERE
									MENU_LRG_IDX = ".$lrg_idx."
									AND MENU_MDL_IDX = ".$mdl_idx."
									AND DEL_FLG = FALSE";
					
					$db->query($sml_sql);
					
					$menu_sml_data = array();
					foreach($db->fetch() as $sml_data) {
						$menu_sml_data['data'][] = array(
							'menu_sml_idx'		=>$sml_data['IDX'],
							'menu_sml_title'	=>$sml_data['MENU_SML_TITLE'],
							'menu_sml_url'		=>$sml_data['MENU_SML_URL']
						);
					}

					$menu_mdl_data['data'][] = array(
						'menu_mdl_idx'		=>$mdl_idx,
						'menu_mdl_title'	=>$mdl_data['MENU_MDL_TITLE'],
						'menu_mdl_type'		=>$mdl_data['MENU_MDL_TYPE'],
						'menu_mdl_url'		=>$mdl_data['MENU_MDL_URL'],
						'menu_sml_data'		=>$menu_sml_data
					);
				}
			}

			$json_result['data'][] = array(
				'menu_lrg_idx'		=>$lrg_idx,
				'menu_lrg_title'	=>$lrg_data['MENU_LRG_TITLE'],
				'menu_lrg_type'		=>$lrg_data['MENU_LRG_TYPE'],
				'menu_lrg_url'		=>$lrg_data['MENU_LRG_URL'],
				'menu_mdl_data'		=>$menu_mdl_data
			);
		}
	}
}
?>