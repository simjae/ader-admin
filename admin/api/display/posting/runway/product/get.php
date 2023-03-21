<?php
/*
 +=============================================================================
 | 
 | 에디토리얼 정보 화면 - 에디토리얼 상품 조회
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

$page_idx			= $_POST['page_idx'];

if ($page_idx != null) {
	$select_runway_product_sql = "
		SELECT
			EP.IDX				AS E_PRODUCT_IDX,
			EP.DISPLAY_NUM		AS DISPLAY_NUM,
			EP.PRODUCT_IDX		AS PRODUCT_IDX,
			PR.PRODUCT_CODE		AS PRODUCT_CODE,
			PR.PRODUCT_NAME		AS PRODUCT_NAME,
			(
				SELECT
					REPLACE(
						S_PI.IMG_LOCATION,
						'/var/www/admin/www',
						''
					)
				FROM
					PRODUCT_IMG S_PI
				WHERE
					S_PI.PRODUCT_IDX = PR.IDX AND
					S_PI.IMG_TYPE = 'P' AND
					S_PI.IMG_SIZE = 'S'
				ORDER BY
					S_PI.IDX ASC
				LIMIT
					0,1
			)					AS IMG_LOCATION
		FROM
			RUNWAY_PRODUCT EP
			LEFT JOIN SHOP_PRODUCT PR ON
			EP.PRODUCT_IDX = PR.IDX
		WHERE
			EP.PAGE_IDX = ".$page_idx."
		ORDER BY
			EP.DISPLAY_NUM ASC
	";
	
	$db->query($select_runway_product_sql);
	
	foreach($db->fetch() as $product_data) {
		$json_result['data'][] = array(
			'e_product_idx'		=>$product_data['E_PRODUCT_IDX'],
			'display_num'		=>$product_data['DISPLAY_NUM'],
			'product_idx'		=>$product_data['PRODUCT_IDX'],
			'product_code'		=>$product_data['PRODUCT_CODE'],
			'product_name'		=>$product_data['PRODUCT_NAME'],
			'img_location'		=>$product_data['IMG_LOCATION']
		);
	}
}

?>