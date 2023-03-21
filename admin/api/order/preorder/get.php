<?php
/*
 +=============================================================================
 | 
 | 프리오더 관리 화면 - 프리오더 개별 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.01.15
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$country			= $_POST['country'];

$preorder_idx		= $_POST['preorder_idx'];

if ($country != null && $preorder_idx != null) {
	$select_preorder_sql = "
		SELECT
			PP.IDX					AS PREORDER_IDX,
			PP.COUNTRY				AS COUNTRY,
			PP.MEMBER_LEVEL			AS MEMBER_LEVEL,
			PP.PRODUCT_IDX			AS PRODUCT_IDX,
			CASE
				WHEN
					(
						SELECT
							COUNT(S_PI.IDX)
						FROM
							PRODUCT_IMG S_PI
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
						)
				ELSE
					'/images/default_product_img.jpg'
			END						AS IMG_LOCATION,
			PR.PRODUCT_CODE			AS PRODUCT_CODE,
			PR.PRODUCT_NAME			AS PRODUCT_NAME,
			PP.SALES_PRICE			AS SALES_PRICE,
			PP.DISPLAY_FLG			AS DISPLAY_FLG,
			PP.ENTRY_START_DATE		AS ENTRY_START_DATE,
			PP.ENTRY_END_DATE		AS ENTRY_END_DATE
		FROM
			PAGE_PREORDER PP
			LEFT JOIN SHOP_PRODUCT PR ON
			PP.PRODUCT_IDX = PR.IDX
		WHERE
			PP.IDX = ".$preorder_idx."
	";
}

$db->query($select_preorder_sql);

foreach($db->fetch() as $preorder_data) {
	$preorder_idx = $preorder_data['PREORDER_IDX'];
	
	$qty_info = array();
	if (!empty($preorder_idx)) {
		$select_qty_sql = "
			SELECT
				QP.IDX					AS QTY_IDX,
				QP.OPTION_IDX			AS OPTION_IDX,
				QP.OPTION_NAME			AS OPTION_NAME,
				QP.BARCODE				AS BARCODE,
				QP.PRODUCT_QTY			AS PRODUCT_QTY,
				QP.PRODUCT_QTY_LIMIT	AS PRODUCT_QTY_LIMIT
			FROM
				QTY_PREORDER QP
			WHERE
				QP.PREORDER_IDX = ".$preorder_idx."
		";
		
		$db->query($select_qty_sql);
		
		foreach($db->fetch() as $qty_data) {
			$qty_info[] = array(
				'qty_idx'			=>$qty_data['QTY_IDX'],
				'option_idx'		=>$qty_data['OPTION_IDX'],
				'option_name'		=>$qty_data['OPTION_NAME'],
				'barcode'			=>$qty_data['BARCODE'],
				'product_qty'		=>$qty_data['PRODUCT_QTY'],
				'product_qty_limit'	=>$qty_data['PRODUCT_QTY_LIMIT']
			);
		}
	}
	
	$json_result['data'][] = array(
		'preorder_idx'			=>$preorder_data['PREORDER_IDX'],
		'country'				=>$preorder_data['COUNTRY'],
		'member_level'			=>$preorder_data['MEMBER_LEVEL'],
		'product_idx'			=>$preorder_data['PRODUCT_IDX'],
		'img_location'			=>$preorder_data['IMG_LOCATION'],
		'product_code'			=>$preorder_data['PRODUCT_CODE'],
		'product_name'			=>$preorder_data['PRODUCT_NAME'],
		'sales_price'			=>$preorder_data['SALES_PRICE'],
		'display_flg'			=>$preorder_data['DISPLAY_FLG'],
		'entry_start_date'		=>$preorder_data['ENTRY_START_DATE'],
		'entry_end_date'		=>$preorder_data['ENTRY_END_DATE'],
		
		'qty_info'				=>$qty_info
	);
}
?>