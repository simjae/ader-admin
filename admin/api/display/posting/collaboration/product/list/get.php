<?php
/*
 +=============================================================================
 | 
 | 콜라보레이션 관리 페이지 - 콜라보레이션 상품 리스트 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2023.01.28
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$country			= $_POST['country'];
$collaboration_idx	= $_POST['collaboration_idx'];

if ($collaboration_idx != null) {
	$select_product_sql = "
		SELECT
			CP.IDX						AS COLLABO_PRODUCT_IDX,
			CP.DISPLAY_NUM				AS DISPLAY_NUM,
			PR.PRODUCT_CODE				AS PRODUCT_CODE,
			PR.PRODUCT_NAME				AS PRODUCT_NAME,
			PR.SALES_PRICE_".$country."	AS SALES_PRICE,
			OM.COLOR					AS COLOR,
			OM.COLOR_RGB				AS COLOR_RGB,
			IFNULL(
				PR.MATERIAL_".$country.",
				'-'
			)							AS MATERIAL,
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
					IMG_TYPE = 'P' AND
					IMG_SIZE = 'S'
				ORDER BY
					IDX ASC
				LIMIT
					0,1
			)							AS IMG_LOCATION,
			CP.DISPLAY_FLG				AS DISPLAY_FLG
		FROM
			COLLABORATION_PRODUCT CP
			LEFT JOIN SHOP_PRODUCT PR ON
			CP.PRODUCT_IDX = PR.IDX
			LEFT JOIN ORDERSHEET_MST OM ON
			PR.ORDERSHEET_IDX = OM.IDX
		WHERE
			CP.COLLABORATION_IDX = ".$collaboration_idx."
		ORDER BY
			CP.DISPLAY_NUM ASC
	";
	
	$db->query($select_product_sql);
	
	foreach($db->fetch() as $product_data) {
		$json_result['data'][] = array(
			'collabo_product_idx'	=>$product_data['COLLABO_PRODUCT_IDX'],
			'display_num'			=>$product_data['DISPLAY_NUM'],
			'product_code'			=>$product_data['PRODUCT_CODE'],
			'product_name'			=>$product_data['PRODUCT_NAME'],
			'sales_price'			=>number_format($product_data['SALES_PRICE']),
			'color'					=>$product_data['COLOR'],
			'color_rgb'				=>$product_data['COLOR_RGB'],
			'material'				=>$product_data['MATERIAL'],
			'img_location'			=>$product_data['IMG_LOCATION'],
			'display_flg'			=>$product_data['DISPLAY_FLG']
		);
	}
}

?>