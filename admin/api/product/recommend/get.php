<?php

/*
 +=============================================================================
 | 
 | 추천상품 등롯/수정 모달 - 추천상품 페이지 개별정보 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.12.13
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$page_idx		= $_POST['page_idx'];
$product_code	= $_POST['product_code'];

if($page_idx != null){
	$sql = "SELECT
				RE.IDX				AS PAGE_IDX,
				RE.PAGE_TITLE		AS PAGE_TITLE,
				RE.PAGE_MEMO		AS PAGE_MEMO,
				RE.RECOMMEND_IDX	AS RECOMMEND_IDX,
				RE.ACTIVE_FLG		AS ACTIVE_FLG
			FROM
				dev.PAGE_RECOMMEND RE
			WHERE
				RE.IDX = ".$page_idx;
	
	$db->query($sql);
	
	foreach($db->fetch() as $data) {
		$page_idx = $data['PAGE_IDX'];
		$recommend_idx = $data['RECOMMEND_IDX'];
		
		$product_info = array();
		if (!empty($page_idx)) {
			$product_sql = "
				SELECT
					PR.IDX				AS PRODUCT_IDX,
					PR.PRODUCT_NAME		AS PRODUCT_NAME,
					PR.PRODUCT_CODE		AS PRODUCT_CODE,
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
					END					AS IMG_LOCATION
				FROM
					dev.RECOMMEND_PRODUCT RE
					LEFT JOIN dev.SHOP_PRODUCT PR ON
					RE.PRODUCT_IDX = PR.IDX
				WHERE
					RE.PAGE_IDX = ".$page_idx."
					
			";
			
			$db->query($product_sql);
			
			foreach($db->fetch() as $product_data) {
				$product_info[] = array(
					'product_idx'	=>$product_data['PRODUCT_IDX'],
					'product_name'	=>$product_data['PRODUCT_NAME'],
					'product_code'	=>$product_data['PRODUCT_CODE'],
					'img_location'	=>$product_data['IMG_LOCATION']
				);
			}
		}
		
		$json_result['data'][] = array(
			'page_idx'		=>$page_idx,
			'page_title'	=>$data['PAGE_TITLE'],
			'page_memo'		=>$data['PAGE_MEMO'],
			'recommend_idx'	=>$data['RECOMMEND_IDX'],
			'active_flg'	=>$data['ACTIVE_FLG'],
			'product_info'	=>$product_info
		);
	}
}

if ($product_code != null) {
	$cnt = $db->count("dev.SHOP_PRODUCT","PRODUCT_CODE = '".$product_code."'");
	
	if ($cnt > 0) {
		$sql = "
			SELECT
				PR.IDX				AS PRODUCT_IDX,
				PR.PRODUCT_NAME		AS PRODUCT_NAME,
				PR.PRODUCT_CODE		AS PRODUCT_CODE,
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
				END					AS IMG_LOCATION
			FROM
				dev.SHOP_PRODUCT PR
			WHERE
				PR.PRODUCT_CODE = '".$product_code."'
		";
		
		$db->query($sql);
		
		foreach($db->fetch() as $product_data) {
			$json_result['data'][] = array(
				'product_idx'	=>$product_data['PRODUCT_IDX'],
				'product_name'	=>$product_data['PRODUCT_NAME'],
				'product_code'	=>$product_data['PRODUCT_CODE'],
				'img_location'	=>$product_data['IMG_LOCATION']
			);
		}
	} else {
		$json_result['code'] = 301;
		$json_result['msg'] = '추가하려는 상품의 정보가 존재하지 않습니다.';
	}
}
?>