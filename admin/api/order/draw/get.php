<?php
/*
 +=============================================================================
 | 
 | 드로우 관리 화면 - 드로우 개별 조회
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

$draw_idx			= $_POST['draw_idx'];

if ($country != null && $draw_idx != null) {
	$select_draw_sql = "
		SELECT
			PD.IDX					AS DRAW_IDX,
			PD.COUNTRY				AS COUNTRY,
			PD.MEMBER_LEVEL			AS MEMBER_LEVEL,
			PD.PRODUCT_IDX			AS PRODUCT_IDX,
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
			PD.SALES_PRICE			AS SALES_PRICE,
			PD.DISPLAY_FLG			AS DISPLAY_FLG,
			PD.ENTRY_START_DATE		AS ENTRY_START_DATE,
			PD.ENTRY_END_DATE		AS ENTRY_END_DATE,
			PD.ANNOUNCE_DATE		AS ANNOUNCE_DATE,
			PD.PURCHASE_START_DATE	AS PURCHASE_START_DATE,
			PD.PURCHASE_END_DATE	AS PURCHASE_END_DATE
		FROM
			PAGE_DRAW PD
			LEFT JOIN SHOP_PRODUCT PR ON
			PD.PRODUCT_IDX = PR.IDX
		WHERE
			PD.IDX = ".$draw_idx."
	";
}

$db->query($select_draw_sql);

foreach($db->fetch() as $draw_data) {
	$draw_idx = $draw_data['DRAW_IDX'];
	
	$qty_info = array();
	if (!empty($draw_idx)) {
		$select_qty_sql = "
			SELECT
				QD.IDX					AS QTY_IDX,
				QD.OPTION_IDX			AS OPTION_IDX,
				QD.OPTION_NAME			AS OPTION_NAME,
				QD.BARCODE				AS BARCODE,
				QD.PRODUCT_QTY			AS PRODUCT_QTY
			FROM
				QTY_DRAW QD
			WHERE
				QD.DRAW_IDX = ".$draw_idx."
		";
		
		$db->query($select_qty_sql);
		
		foreach($db->fetch() as $qty_data) {
			$qty_info[] = array(
				'qty_idx'			=>$qty_data['QTY_IDX'],
				'option_idx'		=>$qty_data['OPTION_IDX'],
				'option_name'		=>$qty_data['OPTION_NAME'],
				'barcode'			=>$qty_data['BARCODE'],
				'product_qty'		=>$qty_data['PRODUCT_QTY']
			);
		}
	}
	
	$json_result['data'][] = array(
		'draw_idx'				=>$draw_data['DRAW_IDX'],
		'country'				=>$draw_data['COUNTRY'],
		'member_level'			=>$draw_data['MEMBER_LEVEL'],
		'product_idx'			=>$draw_data['PRODUCT_IDX'],
		'img_location'			=>$draw_data['IMG_LOCATION'],
		'product_code'			=>$draw_data['PRODUCT_CODE'],
		'product_name'			=>$draw_data['PRODUCT_NAME'],
		'sales_price'			=>$draw_data['SALES_PRICE'],
		'display_flg'			=>$draw_data['DISPLAY_FLG'],
		'entry_start_date'		=>$draw_data['ENTRY_START_DATE'],
		'entry_end_date'		=>$draw_data['ENTRY_END_DATE'],
		'announce_date'			=>$draw_data['ANNOUNCE_DATE'],
		'purchase_start_date'	=>$draw_data['PURCHASE_START_DATE'],
		'purchase_end_date'		=>$draw_data['PURCHASE_END_DATE'],
		
		'qty_info'				=>$qty_info
	);
}
?>