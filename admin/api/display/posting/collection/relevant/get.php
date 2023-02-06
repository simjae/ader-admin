<?php
/*
 +=============================================================================
 | 
 | 룩북 관리 화면 - 프로젝트 이미지 관련상품 조회
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

$contry				= $_POST['country'];
$collection_idx		= $_POST['collection_idx'];
$c_product_idx		= $_POST['c_product_idx'];

if ($country != null && $collection_idx != null && $c_product_idx != null) {
	$select_relevant_sql = "
		SELECT
			CR.IDX				AS RELEVANT_IDX,
			CR.DISPLAY_NUM		AS DISPLAY_NUM,
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
					dev.PRODUCT_IMG S_PI
				WHERE
					S_PI.PRODUCT_IDX = PR.IDX AND
					S_PI.IMG_TYPE = 'P' AND
					S_PI.IMG_SIZE = 'S'
				ORDER BY
					S_PI.IDX ASC
				LIMIT
					0,1
			)					AS IMG_LOCATION,
			CR.SOLD_OUT_FLG		AS SOLD_OUT_FLG,
			CR.DISPLAY_FLG		AS DISPLAY_FLG
		FROM
			dev.COLLECTION_RELEVANT_PRODUCT CR
			LEFT JOIN dev.SHOP_PRODUCT PR ON
			CR.PRODUCT_IDX = PR.IDX
		WHERE
			CR.COUNTRY = '".$country."' AND
			CR.COLLECTION_IDX = ".$collection_idx." AND
			CR.C_PRODUCT_IDX = ".$c_product_idx."
		ORDER BY
			CR.DISPLAY_NUM ASC
	";
	
	$db->query($select_relevant_sql);
	
	foreach($db->fetch() as $product_data) {
		$json_result['data'][] = array(
			'relevant_idx'		=>$product_data['RELEVANT_IDX'],
			'display_num'		=>$product_data['DISPLAY_NUM'],
			'product_code'		=>$product_data['PRODUCT_CODE'],
			'product_name'		=>$product_data['PRODUCT_NAME'],
			'img_location'		=>$product_data['IMG_LOCATION'],
			'sold_out_flg'		=>$product_data['SOLD_OUT_FLG'],
			'display_flg'		=>$product_data['DISPLAY_FLG']
		);
	}
}

?>