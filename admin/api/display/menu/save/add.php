<?php
/*
 +=============================================================================
 | 
 | 메뉴 관리 - 현재 편집중인 메뉴 정보 저장
 | -----------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2023.01.02
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$country		= $_POST['country'];

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
	$db->query("DELETE FROM dev.MENU_LRG WHERE COUNTRY = '".$country."'");
	$db->query("DELETE FROM dev.MENU_MDL WHERE COUNTRY = '".$country."'");
	$db->query("DELETE FROM dev.MENU_SML WHERE COUNTRY = '".$country."'");

	$db->query("DELETE FROM dev.MENU_SLIDE WHERE COUNTRY = '".$country."'");
	$db->query("DELETE FROM dev.MENU_UPPER_FILTER WHERE COUNTRY = '".$country."'");
	$db->query("DELETE FROM dev.MENU_LOWER_FILTER WHERE COUNTRY = '".$country."'");	
	
	$select_tmp_lrg_sql = "
		SELECT
			TM.IDX		AS TMP_MENU_LRG_IDX
		FROM
			dev.TMP_MENU_LRG TM
		WHERE
			TM.COUNTRY = '".$country."' AND
			TM.DEL_FLG = FALSE
		ORDER BY
			TM.IDX ASC
	";

	$db->query($select_tmp_lrg_sql);

	foreach($db->fetch() as $lrg_data) {
		$tmp_menu_lrg_idx = $lrg_data['TMP_MENU_LRG_IDX'];
		
		if (!empty($tmp_menu_lrg_idx)) {
			$insert_lrg_sql = "
				INSERT INTO
					dev.MENU_LRG
				(
					COUNTRY,
					MENU_TITLE,
					MENU_TYPE,
					PAGE_IDX,
					CREATER,
					UPDATER
				)
				SELECT
					TM.COUNTRY,
					TM.MENU_TITLE,
					TM.MENU_TYPE,
					TM.PAGE_IDX,
					TM.CREATER,
					TM.UPDATER
				FROM
					dev.TMP_MENU_LRG TM
				WHERE
					TM.IDX = ".$tmp_menu_lrg_idx." AND
					TM.COUNTRY = '".$country."' AND
					TM.DEL_FLG = FALSE
			";
			
			$db->query($insert_lrg_sql);
			
			$menu_lrg_idx = $db->last_id();
			
			if (!empty($menu_lrg_idx)) {
				updateRecommendKeyword($db,$country,'L',$tmp_menu_lrg_idx,$menu_lrg_idx);
				updateMenuObj($db,$country,'L',$tmp_menu_lrg_idx,$menu_lrg_idx);
				
				$select_tmp_mdl_sql = "
					SELECT
						TM.IDX				AS TMP_MENU_MDL_IDX
					FROM
						dev.TMP_MENU_MDL TM
					WHERE
						TM.COUNTRY = '".$country."' AND
						TM.MENU_LRG_IDX = ".$tmp_menu_lrg_idx." AND
						TM.DEL_FLG = FALSE
					ORDER BY
						TM.IDX ASC
				";
				
				$db->query($select_tmp_mdl_sql);
				
				foreach($db->fetch() as $mdl_data) {
					$tmp_menu_mdl_idx = $mdl_data['TMP_MENU_MDL_IDX'];
					
					if (!empty($tmp_menu_mdl_idx)) {
						$insert_mdl_sql = "
							INSERT INTO
								dev.MENU_MDL
							(
								COUNTRY,
								MENU_LRG_IDX,
								MENU_TITLE,
								MENU_TYPE,
								PAGE_IDX,
								CREATER,
								UPDATER
							)
							SELECT
								TM.COUNTRY,
								".$menu_lrg_idx.",
								TM.MENU_TITLE,
								TM.MENU_TYPE,
								TM.PAGE_IDX,
								TM.CREATER,
								TM.UPDATER
							FROM
								dev.TMP_MENU_MDL TM
							WHERE
								TM.IDX = ".$tmp_menu_mdl_idx." AND
								TM.COUNTRY = '".$country."' AND
								TM.DEL_FLG = FALSE
							ORDER BY
								TM.IDX ASC
						";
						
						$db->query($insert_mdl_sql);
						
						$menu_mdl_idx = $db->last_id();
						
						if (!empty($menu_mdl_idx)) {
							updateRecommendKeyword($db,$country,'M',$tmp_menu_mdl_idx,$menu_mdl_idx);
							updateMenuObj($db,$country,'M',$tmp_menu_mdl_idx,$menu_mdl_idx);
							
							$select_tmp_sml_sql = "
								SELECT
									TM.IDX		AS TMP_MENU_SML_IDX
								FROM
									dev.TMP_MENU_SML TM
								WHERE
									TM.MENU_MDL_IDX = ".$tmp_menu_mdl_idx." AND
									TM.COUNTRY = '".$country."' AND
									TM.DEL_FLG = FALSE
								ORDER BY
									TM.IDX ASC
							";
							
							$db->query($select_tmp_sml_sql);
							
							foreach($db->fetch() as $sml_data) {
								$tmp_menu_sml_idx = $sml_data['TMP_MENU_SML_IDX'];
								
								if (!empty($tmp_menu_sml_idx)) {
									$insert_sml_sql = "
										INSERT INTO
											dev.MENU_SML
										(
											COUNTRY,
											MENU_MDL_IDX,
											MENU_TITLE,
											MENU_TYPE,
											PAGE_IDX,
											CREATER,
											UPDATER
										)
										SELECT
											TM.COUNTRY,
											".$menu_mdl_idx.",
											TM.MENU_TITLE,
											TM.MENU_TYPE,
											TM.PAGE_IDX,
											TM.CREATER,
											TM.UPDATER
										FROM
											dev.TMP_MENU_SML TM
										WHERE
											TM.IDX = ".$tmp_menu_sml_idx." AND
											TM.COUNTRY = '".$country."' AND
											TM.DEL_FLG = FALSE
										ORDER BY
											TM.IDX ASC
									";
									
									$db->query($insert_sml_sql);
									
									$menu_sml_idx = $db->last_id();
									
									if (!empty($menu_sml_idx)) {
										updateRecommendKeyword($db,$country,'S',$tmp_menu_sml_idx,$menu_sml_idx);
										updateMenuObj($db,$country,'S',$tmp_menu_sml_idx,$menu_sml_idx);
									}
								}
							}
						}
					}
				}
			}
		}
		
		$db->commit();
	}
} catch(mysqli_sql_exception $exception){
	$db->rollback();
	$json_result['code'] = 301;
	$msg = "선택한 국가의 스토리 저장에 실패했습니다. 저장하려는 국가의 스토리를 확인해주세요.";
}

function updateRecommendKeyword($db,$country,$menu_sort,$tmp_menu_idx,$menu_idx) {
	$cnt = $db->count("dev.RECOMMEND_KEYWORD","COUNTRY = '".$country."' AND MENU_SORT = '".$menu_sort."' AND MENU_IDX = ".$tmp_menu_idx);
	
	if ($cnt > 0) {
		$updadte_keyword_sql = "
			UPDATE
				dev.RECOMMEND_KEYWORD
			SET
				MENU_SORT = '".$menu_sort."',
				MENU_IDX = ".$menu_idx."
			WHERE
				COUNTRY = '".$country."' AND
				MENU_SORT = '".$menu_sort."' AND
				MENU_IDX = ".$tmp_menu_idx."
		";
		
		$db->query($updadte_keyword_sql);
	}
}

function updateMenuObj($db,$country,$menu_sort,$tmp_menu_idx,$menu_idx) {
	$obj_type_arr = ['SL','UP','LW'];
	
	for ($i=0; $i<count($obj_type_arr); $i++) {
		$obj_type = $obj_type_arr[$i];
		
		$obj_table = "";
		switch ($obj_type) {
			case "SL" :
				$obj_table = "MENU_SLIDE";
				break;
			
			case "UP" :
				$obj_table = "MENU_UPPER_FILTER";
				break;
			
			case "LW" :
				$obj_table = "MENU_LOWER_FILTER";
				break;
		}
		
		$cnt = $db->count("dev.TMP_".$obj_table,"COUNTRY = '".$country."'  AND MENU_IDX = ".$tmp_menu_idx);
		
		if ($cnt > 0) {
			$img_location_sql = array();
			if ($obj_type != "LW") {
				$img_location_sql[0] = " IMG_LOCATION, ";
				$img_location_sql[1] = "TM.IMG_LOCATION		AS IMG_LOCATION,";
			}
			
			$insert_obj_sql = "
				INSERT INTO
					dev.".$obj_table."
				(
					COUNTRY,
					MENU_SORT,
					MENU_IDX,
					LINK_TYPE,
					OBJ_TITLE,
					".$img_location_sql[0]."
					DISPLAY_NUM,
					PAGE_IDX
				)
				SELECT
					TM.COUNTRY					AS COUNTRY,
					'".$menu_sort."'			AS MENU_SORT,
					".$menu_idx."				AS MENU_IDX,
					TM.LINK_TYPE				AS LINK_TYPE,
					TM.OBJ_TITLE				AS OBJ_TITLE,
					".$img_location_sql[1]."
					TM.DISPLAY_NUM				AS DISPLAY_NUM,
					TM.PAGE_IDX					AS PAGE_IDX
				FROM
					dev.TMP_".$obj_table." TM
				WHERE
					TM.COUNTRY = '".$country."' AND
					TM.MENU_SORT = '".$menu_sort."' AND
					TM.MENU_IDX = ".$tmp_menu_idx."
					
			";
			
			$db->query($insert_obj_sql);
		}
	}
}
?>