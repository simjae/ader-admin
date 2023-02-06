<?php
/*
 +=============================================================================
 | 
 | 상품 진열 페이지_상품 라이브러리 검색 모달 - 선택 한 상품 라이브러리 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2023.01.09
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$product_idx	= $_POST['product_idx'];

if ($product_idx != null) {
	$sql = "
		SELECT
			PR.IDX				AS PRODUCT_IDX,
			PR.PRODUCT_CODE		AS PRODUCT_CODE,
			(
				SELECT
					REPLACE(
						S_PI.IMG_LOCATION,
						'/var/www/admin/www',
						''
					)
				FROM
					dev.PRODUCT_IMG S_PI
				WHERE
					S_PI.PRODUCT_IDX = PR.IDX AND
					S_PI.IMG_TYPE = 'P' AND
					S_PI.IMG_SIZE = 'S'
				ORDER BY
					IDX ASC
				LIMIT
					0,1
			)					AS IMG_LOCATION
		FROM
			dev.SHOP_PRODUCT PR
		WHERE
			PR.IDX IN (".implode(',',$product_idx).")
		ORDER BY
			PR.IDX DESC
	";
	
	$db->query($sql);
	
	foreach($db->fetch() as $data) {
		$json_result['data'][] = array(
			'product_idx'	=>$data['PRODUCT_IDX'],
			'product_code'	=>$data['PRODUCT_CODE'],
			'img_location'	=>$data['IMG_LOCATION']
		);
	}
}
?>