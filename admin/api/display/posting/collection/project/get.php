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

$country			= $_POST['country'];
$collection_idx		= $_POST['collection_idx'];

if ($country != null && $collection_idx != null) {
	$select_collection_sql = "
		SELECT
			PC.IDX				AS COLLECTION_IDX,
			PC.PROJECT_NAME		AS PROJECT_NAME,
			PC.PROJECT_DESC		AS PROJECT_DESC,
			PC.PROJECT_TITLE	AS PROJECT_TITLE,
			PC.THUMB_LOCATION	AS THUMB_LOCATION,
			REPLACE(
				PC.THUMB_LOCATION,
				'/var/www/admin/www',
				''
			)					AS IMG_LOCATION
		FROM
			dev.POSTING_COLLECTION PC
		WHERE
			PC.IDX = ".$collection_idx." AND
			PC.COUNTRY = '".$country."' AND
			PC.DEL_FLG = FALSE
	";
	
	$db->query($select_collection_sql);
	
	foreach($db->fetch() as $collection_data) {
		$collection_idx = $collection_data['COLLECTION_IDX'];
		
		$img_inco = array();
		if (!empty($collection_idx)) {
			/*
			$select_img_sql = "
				SELECT
					CP.IDX				AS C_PRODUCT_IDX,
					CP.DISPLAY_NUM		AS DISPLAY_NUM,
					(
						SELECT
							REPLACE(
								S_CI.IMG_LOCATION,
								'/var/www/admin/www',
								''
							)
						FROM
							dev.COLLECTION_PRODUCT_IMG S_CI
						WHERE
							S_CI.COLLECTION_IDX = ".$collection_idx." AND
                            S_CI.DISPLAY_NUM = CP.DISPLAY_NUM
					)					AS IMG_LOCATION,
					CP.RELEVANT_FLG		AS RELEVANT_FLG
				FROM
					dev.COLLECTION_PRODUCT CP
				WHERE
					CP.COLLECTION_IDX = ".$collection_idx."
				ORDER BY
					CP.DISPLAY_NUM ASC;
			";
			*/
			$select_img_sql = "
				SELECT
					CP.IDX				AS C_PRODUCT_IDX,
					CP.DISPLAY_NUM		AS DISPLAY_NUM,
					(
						SELECT
							REPLACE(
								S_CI.IMG_LOCATION,
								'/var/www/admin/www',
								''
							)
						FROM
							dev.COLLECTION_IMG S_CI
						WHERE
							S_CI.C_PRODUCT_IDX = CP.IDX AND
							IMG_SIZE = 'S' AND
							DEL_FLG = FALSE
					)					AS IMG_LOCATION,
					CP.RELEVANT_FLG		AS RELEVANT_FLG
				FROM
					dev.COLLECTION_PRODUCT CP
				WHERE
					CP.COLLECTION_IDX = ".$collection_idx."
				ORDER BY
					CP.DISPLAY_NUM ASC
			";
			
		}
		
		$db->query($select_img_sql);
		
		foreach($db->fetch() as $product_data) {
			$product_info[] = array(
				'c_product_idx'		=>$product_data['C_PRODUCT_IDX'],
				'display_num'		=>$product_data['DISPLAY_NUM'],
				'img_location'		=>$product_data['IMG_LOCATION'],
				'relevant_flg'		=>$product_data['RELEVANT_FLG']
			);
		}
		
		$json_result['data'][] = array(
			'collection_idx'	=>$collection_data['COLLECTION_IDX'],
			'display_num'		=>$collection_data['DISPLAY_NUM'],
			'project_name'		=>$collection_data['PROJECT_NAME'],
			'project_desc'		=>$collection_data['PROJECT_DESC'],
			'project_title'		=>$collection_data['PROJECT_TITLE'],
			'product_info'		=>$product_info,
			'thumb_location'	=>$collection_data['THUMB_LOCATION'],
			'img_location'		=>$collection_data['IMG_LOCATION'],
			
			'img_info'			=>$img_info
		);
	}
}

?>