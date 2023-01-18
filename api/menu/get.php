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

if (!isset($_POST['country'])) {
	$country = $_POST['country'];
}
$country = "KR";

$lrg_num = 0;
$mdl_num = 0;
$sml_num = 0;
$dtl_num = 0;

$menu_lrg_sql = "
	SELECT
		ML.IDX				AS MENU_IDX,
		ML.MENU_TITLE		AS MENU_TITLE,
		ML.MENU_TYPE		AS MENU_TYPE,
		CASE
			WHEN
				ML.MENU_TYPE = 'PR'
				THEN
					(
						SELECT
							CONCAT(
								S_PPR.PAGE_URL,
								'&menu_sort=L&menu_idx=',
								ML.IDX
							)
						FROM
							dev.PAGE_PRODUCT S_PPR
						WHERE
							S_PPR.IDX = ML.PAGE_IDX
					)
			WHEN
				ML.MENU_TYPE = 'PO'
				THEN
					(
						SELECT
							S_PPO.PAGE_URL
						FROM
							dev.PAGE_POSTING S_PPO
						WHERE
							S_PPO.IDX = ML.PAGE_IDX
					)
		END					AS MENU_LINK
	FROM
		dev.MENU_LRG ML
	WHERE
		ML.COUNTRY = '".$country."' AND
		ML.DEL_FLG = FALSE
";
	
$db->query($menu_lrg_sql);

$menu_lrg = array();
foreach($db->fetch() as $lrg_data) {	
	$menu_lrg_idx = $lrg_data['MENU_IDX'];
	
	if (!empty($menu_lrg_idx)) {
		$menu_slide_sql ="
			SELECT
				CASE
					WHEN
						ME.LINK_TYPE = 'PR'
						THEN
							(
								SELECT
									CONCAT(
										S_PPR.PAGE_URL,
										'&menu_sort=L&menu_idx=',
										ME.IDX
									)
								FROM
									dev.PAGE_PRODUCT S_PPR
								WHERE
									S_PPR.IDX = ME.PAGE_IDX
							)
					WHEN
						ME.LINK_TYPE = 'PO'
						THEN
							(
								SELECT
									S_PPO.PAGE_URL
								FROM
									dev.PAGE_POSTING S_PPO
								WHERE
									S_PPO.IDX = ME.PAGE_IDX
							)
				END					AS SLIDE_URL,
				ME.OBJ_TITLE		AS OBJ_TITLE,
				ME.IMG_LOCATION		AS IMG_LOCATION
			FROM
				dev.MENU_SLIDE ME
			WHERE
				ME.MENU_IDX = ".$menu_lrg_idx." AND
				ME.COUNTRY = '".$country."'
			ORDER BY
				ME.IDX ASC
		";
		
		$db->query($menu_slide_sql);
		
		$menu_slide = array();
		foreach($db->fetch() as $slide_data) {
			$menu_slide[] = array(
				'slide_url'			=>$slide_data['SLIDE_URL'],
				'slide_name'		=>$slide_data['OBJ_TITLE'],
				'slide_img'			=>$slide_data['IMG_LOCATION']
			);
		}
		
		$mdl_cnt = $db->count("dev.MENU_MDL MM","MM.MENU_LRG_IDX = ".$menu_lrg_idx." AND MM.DEL_FLG = FALSE");
		
		if ($mdl_cnt > 0) {
			$menu_mdl_sql ="
				SELECT
					MM.IDX			AS MENU_IDX,
					MM.MENU_TITLE	AS MENU_TITLE,
					MM.MENU_TYPE	AS MENU_TYPE,
					CASE
						WHEN
							MM.MENU_TYPE = 'PR'
							THEN
								(
									SELECT
										CONCAT(
											S_PPR.PAGE_URL,
											'&menu_sort=M&menu_idx=',
											MM.IDX
										)
									FROM
										dev.PAGE_PRODUCT S_PPR
									WHERE
										S_PPR.IDX = MM.PAGE_IDX
								)
						
						WHEN
							MM.MENU_TYPE = 'PO'
							THEN
								(
									SELECT
										S_PPO.PAGE_URL
									FROM
										dev.PAGE_POSTING S_PPO
									WHERE
										S_PPO.IDX = MM.PAGE_IDX
								)
					END				AS MENU_LINK
				FROM
					dev.MENU_MDL MM
				WHERE
					MM.MENU_LRG_IDX = ".$menu_lrg_idx." AND
					MM.COUNTRY = '".$country."' AND
					MM.DEL_FLG = FALSE
			";
			
			$db->query($menu_mdl_sql);
			
			$menu_mdl = array();
			foreach($db->fetch() as $mdl_data) {
				$menu_mdl_idx = $mdl_data['MENU_IDX'];
				$menu_mdl_type = $mdl_data['MENU_TYPE'];
				
				if (!empty($menu_mdl_idx)) {
					$menu_sml = array();
					if ($menu_mdl_type != "PO") {
						$sml_cnt = $db->count("dev.MENU_SML MS","MS.MENU_MDL_IDX = ".$menu_mdl_idx." AND MS.DEL_FLG = FALSE");
						
						if ($sml_cnt > 0) {
							$menu_sml_sql ="
								SELECT
									MS.MENU_TITLE	AS MENU_TITLE,
									(
										SELECT
											CONCAT(
												S_PPR.PAGE_URL,
												'&menu_sort=S&menu_idx=',
												MS.IDX
											)
										FROM
											dev.PAGE_PRODUCT S_PPR
										WHERE
											S_PPR.IDX = MS.PAGE_IDX
									)				AS MENU_LINK
								FROM
									dev.MENU_SML MS
								WHERE
									MS.MENU_MDL_IDX = ".$menu_mdl_idx." AND
									MS.COUNTRY = '".$country."' AND
									MS.DEL_FLG = FALSE
							";
							
							$db->query($menu_sml_sql);
							
							foreach($db->fetch() as $sml_data) {
								$menu_sml[] = array(
									'menu_title'	=>$sml_data['MENU_TITLE'],
									'menu_link'		=>$sml_data['MENU_LINK'],
								);
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