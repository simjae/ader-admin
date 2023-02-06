<?php
/*
 +=============================================================================
 | 
 | 추천상품 모달 검색 - 개별 상품 선택
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.11.30
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$product_idx		= $_POST['product_idx'];

if ($product_idx != null) {
	$sql = "SELECT
				PR.IDX				AS PRODUCT_IDX,
				PR.PRODUCT_CODE		AS PRODUCT_CODE,
				PR.PRODUCT_NAME		AS PRODUCT_NAME,
				CASE
						WHEN
							(
								SELECT
									COUNT(S_PI.IDX)
								FROM
									dev.PRODUCT_IMG S_PI
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
										dev.PRODUCT_IMG S_PI
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
					END				AS IMG_LOCATION
			FROM
				dev.SHOP_PRODUCT PR
			WHERE
				PR.IDX = ".$product_idx;
}

$db->query($sql);
foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'product_idx'		=>$data['PRODUCT_IDX'],
		'product_code'		=>$data['PRODUCT_CODE'],
		'product_name'		=>$data['PRODUCT_NAME']
	);
}
?>