<?php
/*
 +=============================================================================
 | 
 | 룩북 관리 화면 - 프로젝트 개별 조회
 | -----------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2023.01.26
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$project_idx		= $_POST['project_idx'];

if ($project_idx != null) {
	$select_collection_project_sql = "
		SELECT
			PJ.IDX				AS PROJECT_IDX,
			PJ.PROJECT_NAME		AS PROJECT_NAME,
			PJ.PROJECT_DESC		AS PROJECT_DESC,
			PJ.PROJECT_TITLE	AS PROJECT_TITLE,
			PJ.THUMB_LOCATION	AS THUMB_LOCATION,
			REPLACE(
				PJ.THUMB_LOCATION,
				'/var/www/admin/www',
				''
			)					AS IMG_LOCATION
		FROM
			COLLECTION_PROJECT PJ
		WHERE
			PJ.IDX = ".$project_idx." AND
			PJ.DEL_FLG = FALSE
	";
	
	$db->query($select_collection_project_sql);
	
	foreach($db->fetch() as $project_data) {
		$project_idx = $project_data['PROJECT_IDX'];
		
		$product_info = array();
		if (!empty($project_idx)) {
			$select_collection_product_sql = "
				SELECT
					CP.IDX				AS C_PRODUCT_IDX,
					CP.DISPLAY_NUM		AS DISPLAY_NUM,
					CP.RELEVANT_FLG		AS RELEVANT_FLG
				FROM
					COLLECTION_PRODUCT CP
				WHERE
					CP.PROJECT_IDX = ".$project_idx."
				ORDER BY
					CP.DISPLAY_NUM ASC
			";
			
			$db->query($select_collection_product_sql);
			
			foreach($db->fetch() as $product_data) {
				$c_product_idx = $product_data['C_PRODUCT_IDX'];
				
				$img_info = array();
				if (!empty($c_product_idx)) {
					$select_collection_img_sql = "
						SELECT
							CI.IMG_SIZE		AS IMG_SIZE,
							REPLACE(
								CI.IMG_LOCATION,
								'/var/www/admin/www',
								''
							)				AS IMG_LOCATION
						FROM
							COLLECTION_IMG CI
						WHERE
							CI.C_PRODUCT_IDX = ".$c_product_idx."
						ORDER BY
							CI.IDX ASC
					";
					
					$db->query($select_collection_img_sql);
					foreach($db->fetch() as $img_data) {
						$img_info[$img_data['IMG_SIZE']] = array(
							'img_location'		=>$img_data['IMG_LOCATION']
						);
					}
					
					$product_info[] = array(
						'c_product_idx'		=>$c_product_idx,
						'display_num'		=>$product_data['DISPLAY_NUM'],
						'img_location_l'	=>$img_info['L']['img_location'],
						'img_location_m'	=>$img_info['M']['img_location'],
						'img_location_s'	=>$img_info['S']['img_location'],
						'relevant_flg'		=>$product_data['RELEVANT_FLG']
					);
				}
			}
		}
		
		$json_result['data'][] = array(
			'project_idx'		=>$project_data['PROJECT_IDX'],
			'display_num'		=>$project_data['DISPLAY_NUM'],
			'project_name'		=>$project_data['PROJECT_NAME'],
			'project_desc'		=>$project_data['PROJECT_DESC'],
			'project_title'		=>$project_data['PROJECT_TITLE'],
			'thumb_location'	=>$project_data['THUMB_LOCATION'],
			'img_location'		=>$project_data['IMG_LOCATION'],
			
			'product_info'		=>$product_info,
		);
	}
}

?>