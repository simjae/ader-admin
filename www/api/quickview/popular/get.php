<?php
/*
 +=============================================================================
 | 
 | 퀵뷰 - 실시간 인기제품
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.10.17
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$country = null;
if (isset($_SESSION['COUNTRY'])) {
	$country = $_SESSION['COUNTRY'];
} else if (isset($_POST['country'])) {
	$country = $_POST['country'];
}

if ($country != null) {
	$select_popular_sql = "
		SELECT
			PR.IDX				AS PRODUCT_IDX,
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
			)					AS IMG_LOCATION,
			PR.PRODUCT_NAME		AS PRODUCT_NAME
		FROM
			POPULAR_PRODUCT PP
			LEFT JOIN SHOP_PRODUCT PR ON
			PP.PRODUCT_IDX = PR.IDX
		WHERE
			PP.COUNTRY = '".$country."'
		ORDER BY
			PP.DISPLAY_NUM ASC
	";
	
	$db->query($select_popular_sql);
	
	foreach($db->fetch() as $popular_data) {
		$json_result['data'][] = array(
			'product_link'		=>"/product/detail?product_idx=".$popular_data['PRODUCT_IDX'],
			'img_location'		=>$popular_data['IMG_LOCATION'],
			'product_name'		=>$popular_data['PRODUCT_NAME']
		);
	}
}

?>