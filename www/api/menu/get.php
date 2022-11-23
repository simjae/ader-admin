<?php
/*
 +=============================================================================
 | 
 | 공통 - 메뉴 정보 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.11.03
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$lrg_num = 0;
$mdl_num = 0;
$sml_num = 0;
$dtl_num = 0;

$menu_lrg_sql = "SELECT
					ML.IDX				AS MENU_IDX,
					ML.MENU_TITLE		AS MENU_TITLE,
					ML.MENU_TYPE		AS MENU_TYPE,
					ML.MENU_LINK		AS MENU_LINK
				FROM
					dev.MENU_LRG ML
				WHERE
					ML.DEL_FLG = FALSE";
	
$db->query($menu_lrg_sql);

$menu_lrg = array();
foreach($db->fetch() as $lrg_data) {	
	$menu_lrg_idx = $lrg_data['MENU_IDX'];
	
	if ($menu_lrg_idx != null) {
		$menu_sld_sql ="SELECT
							ME.IDX				AS SLIDE_IDX,
							ME.SLIDE_TYPE		AS SLIDE_TYPE,
							ME.CONTENTS_IDX		AS CONTENTS_IDX,
							ME.POSTING_TYPE		AS POSTING_TYPE
						FROM
							dev.MENU_SLIDE ME
						WHERE
							ME.MENU_IDX = ".$menu_lrg_idx;
		
		$db->query($menu_sld_sql);
		
		$menu_slide = array();
		foreach($db->fetch() as $sld_data) {
			$slide_idx = $sld_data['SLIDE_IDX'];
			
			if ($slide_idx != null) {
				$slide_type = $sld_data['SLIDE_TYPE'];
				$contents_idx = $sld_data['CONTENTS_IDX'];
				$posting_type = $sld_data['POSTING_TYPE'];
				
				$url = "";
				
				$slide_sql = "";
				if ($slide_type == "PR") {
					$url = "/product/detail?product_idx=";
					
					$slide_product_sql="SELECT
											PR.IDX				AS SLIDE_IDX,
											PR.PRODUCT_NAME		AS SLIDE_NAME,
											(
												SELECT
													REPLACE(S_PI.IMG_LOCATION,'/var/www/admin/www','')
												FROM
													dev.PRODUCT_IMG S_PI
												WHERE
													S_PI.PRODUCT_IDX = ".$contents_idx." AND
													S_PI.IMG_TYPE = 'P' AND
													S_PI.IMG_SIZE = 'S'
												ORDER BY
													S_PI.IDX ASC
												LIMIT
													0,1
											)					AS SLIDE_IMG
										FROM
											dev.SHOP_PRODUCT PR
										WHERE
											PR.IDX = ".$contents_idx;
					
					$slide_sql .= $slide_product_sql;
				} else if ($slide_type == "PO") {
					$path = "";
					$img_table = "";
					switch ($posting_type) {
						case "CL":
							$path = "collaboration";
							$img_table = "COLLABORATION";
							break;
						
						case "CT":
							$path = "collection";
							$img_table = "COLLECTION";
							break;
						
						case "EX":
							$path = "exhibition";
							$img_table = "EXHIBITION";
							break;
						
						case "ED":
							$path = "editorial";
							$img_table = "EDITORIAL";
							break;
						
						case "LB":
							$path = "lookbook";
							$img_table = "LOOKBOOK";
							break;
					}
					
					$url = "/posting/".$path."?page_idx=";
					
					$slide_posting_sql="SELECT
											PP.IDX			AS SLIDE_IDX,
											PP.PAGE_TITLE	AS SLIDE_NAME,
											(
												SELECT
													S_PI.IMG_LOCATION
												FROM
													dev.POSTING_IMG_".$img_table." S_PI
												WHERE
													S_PI.".$img_table."_IDX = PP.IDX AND
													S_PI.IMG_TYPE = 'M' AND
													S_PI.IMG_SIZE = 'S'
												ORDER BY
													S_PI.IDX ASC
												LIMIT
													0,1
											)				AS SLIDE_IMG
										FROM
											dev.PAGE_POSTING PP
										WHERE
											PP.POSTING_TYPE = '".$posting_type."' AND
											PP.IDX = ".$contents_idx;
					
					$slide_sql .= $slide_posting_sql;
				}
				
				$db->query($slide_sql);
				
				foreach($db->fetch() as $slide_data) {
					$menu_slide[] = array(
						'slide_url'			=>$url.$slide_data['SLIDE_IDX'],
						'slide_name'		=>$slide_data['SLIDE_NAME'],
						'slide_img'			=>$slide_data['SLIDE_IMG']
					);
				}
			}
		}
		
		$mdl_cnt = $db->count("dev.MENU_MDL MM","MM.MENU_LRG_IDX = ".$menu_lrg_idx." AND MM.DEL_FLG = FALSE");
		
		if ($mdl_cnt > 0) {
			$menu_mdl_sql ="SELECT
								MM.IDX			AS MENU_IDX,
								MM.MENU_TITLE	AS MENU_TITLE,
								MM.MENU_TYPE	AS MENU_TYPE,
								MM.MENU_LINK	AS MENU_LINK
							FROM
								dev.MENU_MDL MM
							WHERE
								MM.MENU_LRG_IDX = ".$menu_lrg_idx." AND
								MM.DEL_FLG = FALSE";
			
			$db->query($menu_mdl_sql);
			
			$menu_mdl = array();
			foreach($db->fetch() as $mdl_data) {
				$menu_mdl_idx = $mdl_data['MENU_IDX'];
				$menu_mdl_type = $mdl_data['MENU_TYPE'];
				
				if ($menu_mdl_idx != null) {
					$menu_sml = array();
					if ($menu_mdl_type != "PO") {
						$sml_cnt = $db->count("dev.MENU_SML MS","MS.MENU_MDL_IDX = ".$menu_mdl_idx." AND MS.DEL_FLG = FALSE");
						
						if ($sml_cnt > 0) {
							$menu_sml_sql ="SELECT
												MS.IDX			AS MENU_IDX,
												MS.MENU_TITLE	AS MENU_TITLE,
												MS.MENU_LINK	AS MENU_LINK
											FROM
												dev.MENU_SML MS
											WHERE
												MS.MENU_MDL_IDX = ".$menu_mdl_idx." AND
												MS.DEL_FLG = FALSE";
							
							$db->query($menu_sml_sql);
							
							foreach($db->fetch() as $sml_data) {
								$menu_sml_idx = $sml_data['MENU_IDX'];
								
								if ($menu_sml_idx != null) {
									$menu_sml[] = array(
										'menu_title'	=>$sml_data['MENU_TITLE'],
										'menu_link'		=>$sml_data['MENU_LINK'],
									);
								}
							}
						}
					}
					
					$menu_mdl[] = array(
						'menu_title'	=>$mdl_data['MENU_TITLE'],
						'menu_type'		=>$mdl_data['MENU_TYPE'],
						'menu_link'		=>$mdl_data['MENU_LINK'],
						'menu_sml'		=>$menu_sml
					);
				}
			}
			
			$menu_lrg = array(
				'menu_title'	=>$lrg_data['MENU_TITLE'],
				'menu_type'		=>$lrg_data['MENU_TYPE'],
				'menu_link'		=>$lrg_data['MENU_LINK'],
				'menu_slide'	=>$menu_slide,
				'menu_mdl'		=>$menu_mdl
			);
		}
	}
	
	$json_result['data'][] = array(
		'menu_lrg'		=>$menu_lrg
	);
}
?>