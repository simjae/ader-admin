<?php
/*
 +=============================================================================
 | 
 | 룩북 관리 화면 - 전체 카테고리별 상품 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2023.01.26
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$md_category_node	= $_POST['md_category_node'];
$md_category_depth  = $_POST['md_category_depth'];

$page_idx			= $_POST['page_idx'];

//검색 유형 - 상품구분
if ($page_idx != null) {
	$select_product_sql = "
		SELECT
			PR.IDX						AS PRODUCT_IDX,
			PR.PRODUCT_CODE				AS PRODUCT_CODE,
			CASE
				WHEN
					(
						SELECT
							COUNT(S_PI.IDX)
						FROM
							PRODUCT_IMG S_PI
						WHERE
							S_PI.PRODUCT_IDX = PR.IDX AND
							S_PI.IMG_TYPE = 'P' AND
							S_PI.IMG_SIZE = 'S'
					) > 0
					THEN
						(
							SELECT
								REPLACE(S_PI.IMG_LOCATION,'/var/www/admin/www','')
							FROM
								PRODUCT_IMG S_PI
							WHERE
								S_PI.PRODUCT_IDX = PR.IDX AND
								S_PI.DEL_FLG = FALSE AND
								S_PI.IMG_SIZE = 'S' AND
								S_PI.IMG_TYPE = 'P'
							ORDER BY
								S_PI.IDX ASC
							LIMIT
								0,1
						)
				ELSE
					'/images/default_product_img.jpg'
			END							AS IMG_LOCATION,
			PR.PRODUCT_NAME				AS PRODUCT_NAME,
			PR.PRICE_KR					AS PRICE_KR,
			PR.PRICE_EN					AS PRICE_EN,
			PR.PRICE_CN					AS PRICE_CN,
			PR.DISCOUNT_KR				AS DISCOUNT_KR,
			PR.DISCOUNT_EN				AS DISCOUNT_EN,
			PR.DISCOUNT_CN				AS DISCOUNT_CN,
			PR.SALES_PRICE_KR			AS SALES_PRICE_KR,
			PR.SALES_PRICE_EN			AS SALES_PRICE_EN,
			PR.SALES_PRICE_CN			AS SALES_PRICE_CN,
			PR.CREATER					AS CREATER,
			PR.CREATE_DATE				AS CREATE_DATE,
			PR.UPDATER					AS UPDATER,
			PR.UPDATE_DATE				AS UPDATE_DATE
		FROM
			SHOP_PRODUCT PR
		WHERE
			PR.PRODUCT_TYPE = 'B' AND
			PR.MD_CATEGORY_".$md_category_depth." = ".$md_category_node." AND
			PR.SALE_FLG = TRUE AND
			PR.INDP_FLG = FALSE AND
			PR.DEL_FLG = FALSE
	";
	
	$db->query($select_product_sql);

	foreach($db->fetch() as $product_data) {
		$product_idx = $product_data['PRODUCT_IDX'];
		$product_cnt = $db->count("EDITORIAL_PRODUCT","PAGE_IDX = ".$page_idx." AND PRODUCT_IDX = ".$product_idx);
		
		$action_type = "";
		if ($product_cnt > 0) {
			$action_type = "DEL";
		} else {
			$action_type = "ADD";
		}
		
		$json_result['data'][] = array(
			'product_idx'		=>$product_data['PRODUCT_IDX'],
			'style_code'		=>$product_data['STYLE_CODE'],
			'product_code'		=>$product_data['PRODUCT_CODE'],
			'img_location'		=>$product_data['IMG_LOCATION'],
			'product_name'		=>$product_data['PRODUCT_NAME'],
			'price_kr'			=>$product_data['PRICE_KR'],
			'price_en'			=>$product_data['PRICE_EN'],
			'price_cn'			=>$product_data['PRICE_CN'],
			'discount_kr'		=>$product_data['DISCOUNT_KR'],
			'discount_en'		=>$product_data['DISCOUNT_EN'],
			'discount_cn'		=>$product_data['DISCOUNT_CN'],
			'sales_price_kr'	=>$product_data['SALES_PRICE_KR'],
			'sales_price_en'	=>$product_data['SALES_PRICE_EN'],
			'sales_price_cn'	=>$product_data['SALES_PRICE_CN'],
			'update_date'		=>$product_data['UPDATE_DATE'],
			
			'action_type'		=>$action_type
		);
	}
}

?>