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

$session_id				= sessionCheck();
$country_from			= $_POST['country_from'];
$country_to				= $_POST['country_to'];

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if ($country_from != null && $country_to != null) {
	try {
		$db->query("DELETE FROM TMP_MENU_LRG WHERE COUNTRY = '".$country_to."'");
		$db->query("DELETE FROM TMP_MENU_MDL WHERE COUNTRY = '".$country_to."'");
		$db->query("DELETE FROM TMP_MENU_SML WHERE COUNTRY = '".$country_to."'");
		
		$db->query("DELETE FROM TMP_MENU_SLIDE WHERE COUNTRY = '".$country_to."'");
		$db->query("DELETE FROM TMP_MENU_UPPER_FILTER WHERE COUNTRY = '".$country_to."'");
		$db->query("DELETE FROM TMP_MENU_LOWER_FILTER WHERE COUNTRY = '".$country_to."'");
		
		$db->query("DELETE FROM TMP_RECOMMEND_KEYWORD WHERE COUNTRY = '".$country_to."'");
		
		$select_tmp_menu_lrg_sql = "
			SELECT
				ML.IDX		AS MENU_IDX
			FROM
				TMP_MENU_LRG ML
			WHERE
				ML.COUNTRY = '".$country_from."' AND
				ML.DEL_FLG = FALSE
		";
		
		$db->query($select_tmp_menu_lrg_sql);
		
		$tmp_menu_lrg_idx = array();
		foreach($db->fetch() as $tmp_menu_lrg_data) {
			array_push($tmp_menu_lrg_idx,$tmp_menu_lrg_data['MENU_IDX']);
		}
		
		for ($i=0; $i<count($tmp_menu_lrg_idx); $i++) {
			$copy_menu_lrg_sql = "
				INSERT INTO
					TMP_MENU_LRG
				(
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
					'".$country_to."'	AS COUNTRY,
					ML.MENU_TITLE		AS MENU_TITLE,
					ML.MENU_LOCATION	AS MENU_LOCATION,
					
					ML.LINK_TYPE		AS LINK_TYPE,
					ML.LINK_IDX			AS LINK_IDX,
					ML.LINK_URL			AS LINK_URL,
					
					'".$session_id."'				AS CREATER,
					'".$session_id."'				AS UPDATER
				FROM
					TMP_MENU_LRG ML
				WHERE
					ML.IDX = ".$tmp_menu_lrg_idx[$i]."
			";
			
			$db->query($copy_menu_lrg_sql);
			
			$menu_lrg_idx = $db->last_id();
			
			if (!empty($menu_lrg_idx)) {
				$menu_slide_cnt = $db->count("TMP_MENU_SLIDE","MENU_IDX = ".$tmp_menu_lrg_idx[$i]);
				
				if ($menu_slide_cnt > 0) {
					$copy_menu_slide_sql = "
						INSERT INTO
							TMP_MENU_SLIDE
						(
							COUNTRY,
							MENU_SORT,
							MENU_IDX,
							OBJ_TITLE,
							IMG_LOCATION,
							DISPLAY_NUM,
							
							LINK_TYPE,
							LINK_IDX,
							LINK_URL
						)
						SELECT
							'".$country_to."'	AS COUNTRY,
							MS.MENU_SORT		AS MENU_SORT,
							".$menu_lrg_idx."	AS MENU_IDX,
							MS.OBJ_TITLE		AS OBJ_TITLE,
							MS.IMG_LOCATION		AS IMG_LOCATION,
							MS.DISPLAY_NUM		AS DISPLAY_NUM,
							
							MS.LINK_TYPE		AS LINK_TYPE,
							MS.LINK_IDX			AS LINK_IDX,
							MS.LINK_URL			AS LINK_URL
						FROM
							TMP_MENU_SLIDE MS
						WHERE
							MS.MENU_IDX = ".$tmp_menu_lrg_idx[$i]."
					";
					
					$db->query($copy_menu_slide_sql);
				}
				
				copyMenuObj($db,'UP','L',$tmp_menu_lrg_idx[$i],$menu_lrg_idx,$country_from,$country_to);
				copyMenuObj($db,'LW','L',$tmp_menu_lrg_idx[$i],$menu_lrg_idx,$country_from,$country_to);
				
				$menu_mdl_cnt = $db->count("TMP_MENU_MDL","MENU_LRG_IDX = ".$tmp_menu_lrg_idx[$i]." AND DEL_FLG = FALSE ");
				if ($menu_mdl_cnt > 0) {
					$select_tmp_menu_mdl_sql = "
						SELECT
							MM.IDX		AS MENU_IDX
						FROM
							TMP_MENU_MDL MM
						WHERE
							MM.COUNTRY = '".$country_from."' AND
							MM.MENU_LRG_IDX = ".$tmp_menu_lrg_idx[$i]." AND
							MM.DEL_FLG = FALSE
					";
					
					$db->query($select_tmp_menu_mdl_sql);
					
					$tmp_menu_mdl_idx = array();
					foreach($db->fetch() as $tmp_menu_mdl_data) {
						array_push($tmp_menu_mdl_idx,$tmp_menu_mdl_data['MENU_IDX']);
					}
					
					for($j=0; $j<count($tmp_menu_mdl_idx); $j++) {
						$copy_menu_mdl_sql = "
							INSERT INTO
								TMP_MENU_MDL
							(
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
								'".$country_to."'	AS COUNTRY,
								".$menu_lrg_idx."	AS MENU_LRG_IDX,
								MM.MENU_TITLE		AS MENU_TITLE,
								MM.MENU_LOCATION	AS MENU_LOCATION,
								
								MM.LINK_TYPE		AS LINK_TYPE,
								MM.LINK_IDX			AS LINK_IDX,
								MM.LINK_URL			AS LINK_URL,
								
								'".$session_id."'	AS CREATER,
								'".$session_id."'	AS UPDATER
							FROM
								TMP_MENU_MDL MM
							WHERE
								MM.IDX = ".$tmp_menu_mdl_idx[$j]."
						";
						
						$db->query($copy_menu_mdl_sql);
						
						$menu_mdl_idx = $db->last_id();
						
						if (!empty($menu_mdl_idx)) {
							copyMenuObj($db,'UP','M',$tmp_menu_mdl_idx[$j],$menu_mdl_idx,$country_from,$country_to);
							copyMenuObj($db,'LW','M',$tmp_menu_mdl_idx[$j],$menu_mdl_idx,$country_from,$country_to);
							
							$menu_sml_cnt = $db->count("TMP_MENU_SML","MENU_MDL_IDX = ".$tmp_menu_mdl_idx[$j]." AND DEL_FLG = FALSE ");
							
							if ($menu_sml_cnt > 0) {
								$select_tmp_menu_sml_sql = "
									SELECT
										MS.IDX		AS MENU_IDX
									FROM
										TMP_MENU_SML MS
									WHERE
										MS.COUNTRY = '".$country_from."' AND
										MS.MENU_MDL_IDX = ".$tmp_menu_mdl_idx[$j]." AND
										MS.DEL_FLG = FALSE
								";
								
								$db->query($select_tmp_menu_sml_sql);
								
								$tmp_menu_sml_idx = array();
								foreach($db->fetch() as $tmp_menu_sml_data) {
									array_push($tmp_menu_sml_idx,$tmp_menu_sml_data['MENU_IDX']);
								}
								
								for ($k=0; $k<count($tmp_menu_sml_idx); $k++) {
									$copy_menu_sml_sql = "
										INSERT INTO
											TMP_MENU_SML
										(
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
											'".$country_to."'	AS COUNTRY,
											".$menu_mdl_idx."	AS MENU_MDL_IDX,
											MS.MENU_TITLE		AS MENU_TITLE,
											MS.MENU_LOCATION	AS MENU_LOCATION,
											
											MS.LINK_TYPE		AS LINK_TYPE,
											MS.LINK_IDX			AS LINK_IDX,
											MS.LINK_URL			AS LINK_URL,
											
											'".$session_id."'	AS CREATER,
											'".$session_id."'	AS UPDATER
										FROM
											TMP_MENU_SML MS
										WHERE
											MS.IDX = ".$tmp_menu_sml_idx[$k]."
									";
									
									$db->query($copy_menu_sml_sql);
									
									$menu_sml_idx = $db->last_id();
									
									if (!empty($menu_sml_idx)) {
										copyMenuObj($db,'UP','S',$tmp_menu_sml_idx[$k],$menu_sml_idx,$country_from,$country_to);
										copyMenuObj($db,'LW','S',$tmp_menu_sml_idx[$k],$menu_sml_idx,$country_from,$country_to);
									}
								}
							}
						}
					}
				}
			}
		}
		
		$db->commit();
	} catch(mysqli_sql_exception $exception){
		$db->rollback();
		print_r($exception);
		
		$json_result['code'] = 301;
		$json_result['msg'] = "선택한 국가의 메뉴 복사에 실패했습니다. 복사하려는 메뉴를 확인해주세요.";
	}
}

function copyMenuObj($db,$obj_type,$menu_sort,$tmp_menu_idx,$menu_idx,$country_from,$country_to) {
	$obj_table = "";
	$select_img_location = array();
	switch ($obj_type) {
		case "UP" :
			$obj_table = "TMP_MENU_UPPER_FILTER";
			$select_img_location[0] = " IMG_LOCATION, ";
			$select_img_location[1] = " MO.IMG_LOCATION	AS IMG_LOCATION, ";
			break;
		
		case "LW" :
			$obj_table = "TMP_MENU_LOWER_FILTER";
			break;
	}
	
	$menu_obj_cnt = $db->count($obj_table,"MENU_SORT = '".$menu_sort."' AND MENU_IDX = ".$tmp_menu_idx);
	
	if ($menu_obj_cnt > 0) {
		$copy_menu_obj_sql = "
			INSERT INTO
				".$obj_table."
			(
				COUNTRY,
				MENU_SORT,
				MENU_IDX,
				OBJ_TITLE,
				".$select_img_location[0]."
				DISPLAY_NUM,
				
				LINK_TYPE,
				LINK_IDX,
				LINK_URL
			)
			SELECT
				'".$country_to."'	AS COUNTRY,
				'".$menu_sort."'	AS MENU_SORT,
				".$menu_idx."		AS MENU_IDX,
				MO.OBJ_TITLE		AS OBJ_TITLE,
				".$select_img_location[1]."
				MO.DISPLAY_NUM		AS DISPLAY_NUM,
				
				MO.LINK_TYPE		AS LINK_TYPE,
				MO.LINK_IDX			AS LINK_IDX,
				MO.LINK_URL			AS LINK_URL
			FROM
				".$obj_table." MO
			WHERE
				MO.MENU_IDX = ".$tmp_menu_idx." AND
				MO.COUNTRY = '".$country_from."' AND
				MO.MENU_SORT = '".$menu_sort."'
		";
		
		$db->query($copy_menu_obj_sql);
	}
}
?>