<?php
/*
 +=============================================================================
 | 
 | 위시 리스트 - 찜한 상품 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.10.13
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$member_idx		= $_SESSION[SS_HEAD.'MEMBER_IDX'];

if ($member_idx != null) {
	$sql = "SELECT
				WL.PRODUCT_IDX	AS PRODUCT_IDX,
				(
					SELECT
						REPLACE(S_PI.IMG_LOCATION,'/var/www/admin/www','')
					FROM
						dev.PRODUCT_IMG S_PI
					WHERE
						S_PI.PRODUCT_IMG = WL.PRODUCT_IDX
						S_PI.IMG_SIZE = 'SML' AND
						S_PI.IMG_TYPE = 'PRODUCT'
					ORDER BY
						S_PI.IDX ASC
					LIMIT
						0,1
				)				AS PRODUCT_IMG
				WL.PRODUCT_NAME	AS PRODUCT_NAME
			FROM
				dev.WHISH_LIST WL
				LEFT JOIN dev.SHOP_PRODUCT PR ON
				WL.PRODUCT_IDX = PR.IDX
			WHERE
				MEMBER_IDX = ".$member_idx." AND
				DEL_FLG = FALSE
			ORDER BY
				IDX DESC";

	$db->query($sql);

	foreach($db->fetch() as $data) {
		$json_result['data'][] = array(
			'product_idx'		=>$data['PRODUCT_IDX'],
			'product_img'		=>$data['PRODUCT_IMG'],
			'product_name'		=>$data['PRODUCT_NAME']
		);
	}
}
?>