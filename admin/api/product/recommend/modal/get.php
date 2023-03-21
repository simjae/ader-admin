<?php
/*
 +=============================================================================
 | 
 | 회원 목록
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.07.24
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$product_idx			= $_POST['product_idx'];

$select_recommend_product_sql = "
	SELECT
		PR.IDX					AS PRODUCT_IDX,
		PR.PRODUCT_TYPE			AS PRODUCT_TYPE,
		CASE
			WHEN
				(SELECT COUNT(*) FROM PRODUCT_IMG WHERE PRODUCT_IDX = PR.IDX) > 0
					THEN
						(
							SELECT
								REPLACE(S_PI.IMG_LOCATION,'/var/www/admin/www','')
							FROM
								PRODUCT_IMG S_PI
							WHERE
								S_PI.PRODUCT_IDX = PR.IDX AND
								S_PI.IMG_TYPE = 'P' AND
								S_PI.IMG_SIZE = 'S'
							LIMIT
								0,1
						)
				ELSE
					'/images/default_product_img.jpg'
		END						AS IMG_LOCATION,
		PR.PRODUCT_CODE			AS PRODUCT_CODE,
		PR.PRODUCT_NAME			AS PRODUCT_NAME
	FROM
		SHOP_PRODUCT PR
	WHERE
		IDX = ".$product_idx."
";

$db->query($select_recommend_product_sql);

foreach($db->fetch() as $recommend_data) {
	$json_result['data'][] = array(
		'product_idx'				=>$recommend_data['PRODUCT_IDX'],
		'img_location'				=>$recommend_data['IMG_LOCATION'],
		'product_code'				=>$recommend_data['PRODUCT_CODE'],
		'product_name'				=>$recommend_data['PRODUCT_NAME']
	);
}

?>