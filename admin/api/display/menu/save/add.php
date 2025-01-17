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

include_once("/var/www/admin/api/common/common.php");

$country			= $_POST['country'];
$session_id			= sessionCheck();

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
	$db->query("DELETE FROM MENU_LRG WHERE COUNTRY = '".$country."'");
	$db->query("DELETE FROM MENU_MDL WHERE COUNTRY = '".$country."'");
	$db->query("DELETE FROM MENU_SML WHERE COUNTRY = '".$country."'");

	$db->query("DELETE FROM MENU_SLIDE WHERE COUNTRY = '".$country."'");
	$db->query("DELETE FROM MENU_UPPER_FILTER WHERE COUNTRY = '".$country."'");
	$db->query("DELETE FROM MENU_LOWER_FILTER WHERE COUNTRY = '".$country."'");	
	
	$select_tmp_lrg_sql = "
		SELECT
			TM.IDX		AS TMP_MENU_LRG_IDX
		FROM
			TMP_MENU_LRG TM
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
					MENU_LRG
				(
					IDX,
					COUNTRY,
					MENU_TITLE,
					MENU_LOCATION,
					
					LINK_TYPE,
					LINK_IDX,
					LINK_URL,
					
					CREATER,
					UPDATER
				)
				SELECT
					TM.IDX,
					TM.COUNTRY,
					TM.MENU_TITLE,
					TM.MENU_LOCATION,
					
					TM.LINK_TYPE,
					TM.LINK_IDX,
					TM.LINK_URL,
					
					'".$session_id."',
					'".$session_id."'
				FROM
					TMP_MENU_LRG TM
				WHERE
					TM.IDX = ".$tmp_menu_lrg_idx."
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
						TMP_MENU_MDL TM
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
								MENU_MDL
							(
								IDX,
								COUNTRY,
								MENU_LRG_IDX,
								MENU_TITLE,
								MENU_LOCATION,
								
								LINK_TYPE,
								LINK_IDX,
								LINK_URL,
								
								CREATER,
								UPDATER
							)
							SELECT
								TM.IDX,
								TM.COUNTRY,
								".$menu_lrg_idx.",
								TM.MENU_TITLE,
								TM.MENU_LOCATION,
								
								TM.LINK_TYPE,
								TM.LINK_IDX,
								TM.LINK_URL,
								
								'".$session_id."',
								'".$session_id."'
							FROM
								TMP_MENU_MDL TM
							WHERE
								TM.IDX = ".$tmp_menu_mdl_idx."
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
									TMP_MENU_SML TM
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
											MENU_SML
										(
											IDX,
											COUNTRY,
											MENU_MDL_IDX,
											MENU_TITLE,
											MENU_LOCATION,
											
											LINK_TYPE,
											LINK_IDX,
											LINK_URL,
											
											CREATER,
											UPDATER
										)
										SELECT
											TM.IDX,
											TM.COUNTRY,
											".$menu_mdl_idx.",
											TM.MENU_TITLE,
											TM.MENU_LOCATION,
											TM.LINK_TYPE,
											TM.LINK_IDX,
											TM.LINK_URL,
											'".$session_id."',
											'".$session_id."'
										FROM
											TMP_MENU_SML TM
										WHERE
											TM.IDX = ".$tmp_menu_sml_idx."
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
	print_r($exception);
	
	$json_result['code'] = 301;
	$msg = "선택한 국가의 스토리 저장에 실패했습니다. 저장하려는 국가의 스토리를 확인해주세요.";
}

function updateRecommendKeyword($db,$country,$menu_sort,$tmp_menu_idx,$menu_idx) {
	$cnt = $db->count("RECOMMEND_KEYWORD","COUNTRY = '".$country."' AND MENU_SORT = '".$menu_sort."' AND MENU_IDX = ".$tmp_menu_idx);
	
	if ($cnt > 0) {
		$updadte_keyword_sql = "
			UPDATE
				RECOMMEND_KEYWORD
			SET
				MENU_SORT = '".$menu_sort."',
				MENU_IDX = ".$menu_idx."
			WHERE
				COUNTRY = '".$country."' AND
				MENU_SORT = '".$menu_sort."' AND
				MENU_IDX = ".$tmp_menu_idx."
		";
		
		$db->query($updadte_keyword_sql);
		
		$updadte_tmp_keyword_sql = "
			UPDATE
				TMP_RECOMMEND_KEYWORD
			SET
				MENU_SORT = '".$menu_sort."',
				MENU_IDX = ".$menu_idx."
			WHERE
				COUNTRY = '".$country."' AND
				MENU_SORT = '".$menu_sort."' AND
				MENU_IDX = ".$tmp_menu_idx."
		";
		
		$db->query($updadte_tmp_keyword_sql);
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
		
		$cnt = $db->count("TMP_".$obj_table,"COUNTRY = '".$country."'  AND MENU_IDX = ".$tmp_menu_idx);
		
		if ($cnt > 0) {
			$img_location_sql = array();
			if ($obj_type != "LW") {
				$img_location_sql[0] = " IMG_LOCATION, ";
				$img_location_sql[1] = "TM.IMG_LOCATION		AS IMG_LOCATION,";
			}
			
			$insert_obj_sql = "
				INSERT INTO
					".$obj_table."
				(
					COUNTRY,
					MENU_SORT,
					MENU_IDX,
					
					OBJ_TITLE,
					".$img_location_sql[0]."
					DISPLAY_NUM,
					
					LINK_TYPE,
					LINK_IDX,
					LINK_URL
				)
				SELECT
					TM.COUNTRY					AS COUNTRY,
					'".$menu_sort."'			AS MENU_SORT,
					".$menu_idx."				AS MENU_IDX,
					TM.OBJ_TITLE				AS OBJ_TITLE,
					".$img_location_sql[1]."
					TM.DISPLAY_NUM				AS DISPLAY_NUM,
					
					TM.LINK_TYPE				AS LINK_TYPE,
					TM.LINK_IDX					AS LINK_IDX,
					TM.LINK_URL					AS LINK_URL
				FROM
					TMP_".$obj_table." TM
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