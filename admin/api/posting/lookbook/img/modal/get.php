<?php
/*
 +=============================================================================
 | 
 | 전시정보 등록 - 룩북 모달_룩북 이미지별 관련 상품 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.12.05
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$img_idx		= $_POST['img_idx'];

if ($img_idx != null) {
	$sql = "SELECT
				LP.IDX		AS L_PRODUCT_IDX,
				(
					SELECT
						REPLACE(S_PI.IMG_LOCATION,'/var/www/admin/www/')
					FROM
						dev.PRODUCT_IMG S_PI
					WHERE
						S_PI.PRODUCT_IDX = PR.IDX AND
						S_PI.IMG_TYPE = 'P' AND
						S_PI.IMG_SIZE = 'M'
					ORDER BY
						S_PI.IDX ASC
					LIMIT
						0,1
				)			AS IMG_LOCATION,
				CONCAT(
					'/product/detail?product_idx=',PR.IDX
				)			AS PRODUCT_LINK,
				LP.SOLD_OUT_FLG,
				(
					SELECT
						COUNT(IDX)
					FROM
						dev.PRODUCT_GRID S_PG
					WHERE
						S_PG.PRODUCT_IDX = PR.IDX
				)			AS DISPLAY_CNT
			FROM
				dev.LOOKBOOK_PRODUCT LP
				LEFT JOIN dev.SHOP_PRODUCT PR ON
				LP.PRODUCT_IDX = PR.IDX
			WHERE
				LP.IMG_IDX = ".$img_idx;
	
	$db->query($sql);
	
	foreach($db->fetch() as $data) {
		$display_status = false;
		$display_cnt = intval($data['DISPLAY_CNT']);
		if ($display_cnt > 0) {
			$display_status = true;
		}
		
		$json_result['data'][] = array(
			'l_product_idx'			=>$data['L_PRODUCT_IDX'],
			'img_location'			=>$data['IMG_LOCATION'],
			'product_link'			=>$data['PRODUCT_LINK'],
			'display_status'		=>$data['DISPLAY_STATUS']
		);
	}
}
?>