<?php
/*
 +=============================================================================
 | 
 | 전시관리-게시물관리 페이지 등록
 | -----------
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

$tbl_menu = array();
if ($tmp_flg == "true") {
	$tbl_menu[0] = "dev.TMP_MENU_LRG";
	$tbl_menu[1] = "dev.TMP_MENU_MDL";
	$tbl_menu[2] = "dev.TMP_MENU_SML";
} else {
	$tbl_menu[0] = "dev.MENU_LRG";
	$tbl_menu[1] = "dev.MENU_MDL";
	$tbl_menu[2] = "dev.MENU_SML";
	
	//임시저장이 아닌 경우 논리 삭제
	$update_menu_lrg_sql = "UPDATE dev.MENU_LRG SET DEL_FLG = TRUE";
	$db->query($update_menu_lrg_sql);

	$update_menu_mdl_sql = "UPDATE dev.MENU_MDL SET DEL_FLG = TRUE";
	$db->query($update_menu_mdl_sql);
	
	$update_menu_sml_sql = "UPDATE dev.MENU_SML SET DEL_FLG = TRUE";
	$db->query($update_menu_sml_sql);
}

//tmp 테이블 물리 삭제
$delete_tmp_menu_lrg_sql = "DELETE FROM dev.TMP_MENU_LRG";
$db->query($delete_tmp_menu_lrg_sql);

$delete_tmp_menu_mdl_sql = "DELETE FROM dev.TMP_MENU_MDL";
$db->query($delete_tmp_menu_mdl_sql);

$delete_tmp_menu_sml_sql = "DELETE FROM dev.TMP_MENU_SML";
$db->query($delete_tmp_menu_sml_sql);

$json_param = $_POST['json_param'];
if ($json_param != null) {
	$json_arr = json_decode($json_param,true);
	
	foreach($json_arr AS $lrg_row) {
		$menu_lrg_data = json_decode($menu_lrg_row);
		
		if ($menu_lrg_data != null) {
			$lrg_sql = "INSERT INTO
					".$tbl_menu[0]."
				(
					MENU_LRG_TITLE,
					MENU_LRG_TYPE,
					MENU_LRG_URL,
					CREATE_DATE,
					CREATER,
					UPDATE_DATE,
					UPDATER
				)
				VALUES
				(
					'".$menu_lrg_data->lrg_title."',
					'".$menu_lrg_data->lrg_type."',
					'".$menu_lrg_data->lrg_url."',
					NOW(),
					'Admin',
					NOW(),
					'Admin'
				)";
			$db->query($lrg_sql);
			
			$menu_lrg_idx = $db->last_id();
			$menu_mdl_data = $menu_lrg_data->menu_mdl_data;
			
			if ($menu_lrg_idx != null && $menu_mdl_data != null) {
				foreach($menu_mdl_data AS $menu_mdl_row) {
					$mdl_sql = "INSERT INTO
								".$tbl_menu[1]."
							(
								MENU_LRG_IDX,
								MENU_MDL_TITLE,
								MENU_MDL_TYPE,
								MENU_MDL_URL,
								CREATE_DATE,
								CREATER,
								UPDATE_DATE,
								UPDATER
							)
							VALUES
							(
								".$menu_lrg_idx.",
								'".$menu_mdl_row->menu_mdl_title."',
								'".$menu_mdl_row->menu_mdl_type."',
								'".$menu_mdl_row->menu_mdl_url."',
								NOW(),
								'Admin',
								NOW(),
								'Admin'
							)";
					$db->query($mdl_sql);
					
					$menu_mdl_idx = $db->last_id();
					$menu_sml_data = $menu_mdl_data->menu_sml_data;
					
					if ($menu_mdl_idx != null && $menu_sml_data != null) {
						foreach($menu_sml_data AS $menu_sml_row) {
							$sml_sql = "INSERT INTO
											".$tbl_menu[2]."
										(
											MENU_LRG_IDX,
											MENU_MDL_IDX,
											MENU_SML_TITLE,
											MENU_SML_URL,
											CREATE_DATE,
											CREATER,
											UPDATE_DATE,
											UPDATER
										)
										VALUES
										(
											".$menu_lrg_idx.",
											".$menu_mdl_idx.",
											'".$menu_sml_row->menu_sml_title."',
											'".$menu_sml_row->menu_sml_url."',
											NOW(),
											'Admin',
											NOW(),
											'Admin'
										)";
							$db->query($sml_sql);
						}
					}
				}
			}
		}
	}
}
?>