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

$member_idx = 0;
if (isset($_SESSION['MEMBER_IDX'])) {
	$member_idx = $_SESSION['MEMBER_IDX'];
}

$country = null;
if (isset($_SESSION['COUNTRY'])) {
	$country = $_SESSION['COUNTRY'];
} else if (isset($_POST['country'])){
	$country = $_POST['country'];
}

$member_id = null;
if (isset($_SESSION['MEMBER_ID'])) {
	$member_id = $_SESSION['MEMBER_ID'];
}

$member_name = null;
if (isset($_SESSION['MEMBER_NAME'])) {
	$member_name = $_SESSION['MEMBER_NAME'];
}

$login_flg = false;
$member_info = array();

if ($member_idx > 0) {
	$login_flg = true;
	
	$whish_cnt = $db->count("dev.WHISH_LIST","MEMBER_IDX = ".$member_idx." AND DEL_FLG = FALSE");
	$basket_cnt = $db->count("dev.BASKET_INFO","MEMBER_IDX = ".$member_idx." AND DEL_FLG = FALSE ");
	
	$select_member_sql = "
		SELECT
			MB.MEMBER_ID		AS MEMBER_ID,
			MB.MEMBER_NAME		AS MEMBER_NAME,
			(
				SELECT 
					S_MI.MILEAGE_BALANCE
				FROM 
					dev.MILEAGE_INFO S_MI
				WHERE 
					S_MI.MEMBER_IDX = MB.IDX
				ORDER BY 
					S_MI.IDX DESC 
				LIMIT
					0,1
			)					AS MEMBER_MILEAGE,
			(
				SELECT
					COUNT(S_VI.IDX)
				FROM 
					dev.VOUCHER_ISSUE S_VI
				WHERE
					S_VI.MEMBER_IDX = MB.IDX AND
					S_VI.DEL_FLG = FALSE AND
					S_VI.VOUCHER_ADD_DATE IS NOT NULL AND
					S_VI.USED_FLG = FALSE AND
					S_VI.USABLE_END_DATE > NOW()
			)					AS MEMBER_VOUCHER
		FROM
			MEMBER_".$country." MB
		WHERE
			MB.IDX = ".$member_idx."
	";
	
	$db->query($select_member_sql);
	
	foreach($db->fetch() as $member_data) {
		$member_info = array(
			'member_id'			=>$member_data['MEMBER_ID'],
			'member_name'		=>$member_data['MEMBER_NAME'],
			'member_mileage'	=>number_format($member_data['MEMBER_MILEAGE']),
			'member_voucher'	=>$member_data['MEMBER_VOUCHER'],
			'whish_cnt'			=>$whish_cnt,
			'basket_cnt'		=>$basket_cnt
		);
	}
	
	$json_result['member_info'] = $member_info;
}

$lrg_num = 0;
$mdl_num = 0;
$sml_num = 0;
$dtl_num = 0;

$menu_lrg = array();
$posting_story = array();

if ($country != null) {
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
									S_PPR.IDX,
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
								CONCAT(
									S_PPO.PAGE_URL,
									S_PPO.IDX
								)
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
											S_PPR.IDX,
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
										CONCAT(
											S_PPO.PAGE_URL,
											S_PPO.IDX
										)
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
												S_PPR.IDX,
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
											CONCAT(
												S_PPO.PAGE_URL,
												S_PPO.IDX
											)
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
													S_PPR.IDX,
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
				
				$menu_lrg[] = array(
					'menu_title'	=>$lrg_data['MENU_TITLE'],
					'menu_type'		=>$lrg_data['MENU_TYPE'],
					'menu_link'		=>$lrg_data['MENU_LINK'],
					'menu_slide'	=>$menu_slide,
					'menu_mdl'		=>$menu_mdl
				);
			}
		}
	}
	
	$select_posting_story_sql = "
		SELECT
			PS.STORY_TYPE		AS STORY_TYPE,
			REPLACE(
				PS.IMG_LOCATION,
				'/var/www/admin/www',
				''
			)					AS IMG_LOCATION,
			PS.STORY_TITLE		AS STORY_TITLE,
			PS.STORY_SUB_TITLE	AS STORY_SUB_TITLE,
			IFNULL(
				CONCAT(
					PP.PAGE_URL,PP.IDX
				),
				''
			)					AS PAGE_URL
		FROM
			dev.POSTING_STORY PS
			LEFT JOIN dev.PAGE_POSTING PP ON
			PS.PAGE_IDX = PP.IDX
		WHERE
			PS.COUNTRY = '".$country."' AND
			PS.DEL_FLG = FALSE
		ORDER BY
			PS.STORY_TYPE,
			PS.DISPLAY_NUM
			ASC
	";
	
	$db->query($select_posting_story_sql);
	
	$column_NEW = array();
	$column_COLC = array();
	$column_RNWY = array();
	$column_EDTL = array();
	
	foreach($db->fetch() as $story_data) {
		$story_type = $story_data['STORY_TYPE'];
		
		switch ($story_type) {
			case "NEW" :
				$column_NEW[] = array(
					'story_type'		=>$story_data['STORY_TYPE'],
					'img_location'		=>$story_data['IMG_LOCATION'],
					'story_title'		=>$story_data['STORY_TITLE'],
					'story_sub_title'	=>$story_data['STORY_SUB_TITLE'],
					'page_url'			=>$story_data['PAGE_URL']
				);
				
				break;
			
			case "COLC" :
				$column_COLC[] = array(
					'story_type'		=>$story_data['STORY_TYPE'],
					'img_location'		=>$story_data['IMG_LOCATION'],
					'story_title'		=>$story_data['STORY_TITLE'],
					'story_sub_title'	=>$story_data['STORY_SUB_TITLE'],
					'page_url'			=>$story_data['PAGE_URL']
				);
				
				break;
			
			case "RNWY" :
				$column_RNWY[] = array(
					'story_type'		=>$story_data['STORY_TYPE'],
					'img_location'		=>$story_data['IMG_LOCATION'],
					'story_title'		=>$story_data['STORY_TITLE'],
					'story_sub_title'	=>$story_data['STORY_SUB_TITLE'],
					'page_url'			=>$story_data['PAGE_URL']
				);
				
				break;
			
			case "EDTL" :
				$column_EDTL[] = array(
					'story_type'		=>$story_data['STORY_TYPE'],
					'img_location'		=>$story_data['IMG_LOCATION'],
					'story_title'		=>$story_data['STORY_TITLE'],
					'story_sub_title'	=>$story_data['STORY_SUB_TITLE'],
					'page_url'			=>$story_data['PAGE_URL']
				);
				
				break;
		}
	}
	
	$posting_story = array(
		'column_NEW'		=>$column_NEW,
		'column_COLC'		=>$column_COLC,
		'column_RNWY'		=>$column_RNWY,
		'column_EDTL'		=>$column_EDTL
	);
}

$json_result['data'] = array(
	'menu_info'			=>$menu_lrg,
	'posting_story'		=>$posting_story
);

?>