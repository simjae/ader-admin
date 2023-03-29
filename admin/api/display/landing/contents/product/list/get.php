<?php
/*
 +=============================================================================
 | 
 | 회원 목록
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2023.01.20
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$country			= $_POST['country'];

$select_contents_product_sql = "
	SELECT
		CP.IDX						AS C_PRODUCT_IDX,
		CP.DISPLAY_NUM				AS DISPLAY_NUM,
		
		PR.PRODUCT_CODE				AS PRODUCT_CODE,
		PR.PRODUCT_NAME				AS PRODUCT_NAME,
		IFNULL(
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
			),'/images/default_product_img.jpg'
		)							AS IMG_LOCATION,
		DATE_FORMAT(
			PR.UPDATE_DATE,
			'%Y-%m-%d %H:%i'
		)							AS UPDATE_DATE
	FROM
		TMP_CONTENTS_PRODUCT CP
		LEFT JOIN SHOP_PRODUCT PR ON
		CP.PRODUCT_IDX = PR.IDX
	WHERE
		CP.COUNTRY = '".$country."'
	ORDER BY
		CP.DISPLAY_NUM ASC
";

$db->query($select_contents_product_sql);

foreach($db->fetch() as $product_data) {
	$json_result['data'][] = array(
		'c_product_idx'		=>$product_data['C_PRODUCT_IDX'],
		'display_num'		=>$product_data['DISPLAY_NUM'],
		
		'product_code'		=>$product_data['PRODUCT_CODE'],
		'product_name'		=>$product_data['PRODUCT_NAME'],
		'img_location'		=>$product_data['IMG_LOCATION'],
		
		'update_date'		=>$product_data['UPDATE_DATE'],
	);
}
?>

