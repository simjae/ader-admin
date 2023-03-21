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

$product_idx		= $_POST['product_idx'];

if ($product_idx != null) {
	$product_cnt = $db->count("SHOP_PRODUCT","IDX = ".$product_idx);
	
	if ($product_cnt > 0) {
		$select_recommend_product_sql = "
			SELECT
				PR.IDX				AS PRODUCT_IDX,
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
				SHOP_PRODUCT PR
			WHERE
				PR.IDX = ".$product_idx."
		";
		
		$db->query($select_recommend_product_sql);
		
		foreach($db->fetch() as $recommend_data) {
			$json_result['data'][] = array(
				'product_idx'		=>$recommend_data['PRODUCT_IDX'],
				'product_code'		=>$recommend_data['PRODUCT_CODE'],
				'product_name'		=>$recommend_data['PRODUCT_NAME'],
				'img_location'		=>$recommend_data['IMG_LOCATION']
			);
		}
	} else {
		$json_result['code'] = 301;
		$json_result['msg'] = "추가하려는 상품 정보가 존재하지 않습니다. 상품을 확인 후 다시 시도해주세요.";
	}
} else {
	$json_result['code'] = 301;
	$json_result['msg'] = "추천상품에 추가하려는 상품을 선택해주세요.";
}

?>