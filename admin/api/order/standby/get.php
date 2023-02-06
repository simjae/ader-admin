<?php
/*
 +=============================================================================
 | 
 | 스탠바이 관리 화면 - 스탠바이 개별 조회
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

$standby_idx		= $_POST['standby_idx'];

if ($country != null && $standby_idx != null) {
	$select_standby_sql = "
		SELECT
			PS.IDX					AS STANDBY_IDX,
			PS.COUNTRY				AS COUNTRY,
			PS.MEMBER_LEVEL			AS MEMBER_LEVEL,
			PS.PRODUCT_IDX			AS PRODUCT_IDX,
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
			END						AS IMG_LOCATION,
			PR.PRODUCT_CODE			AS PRODUCT_CODE,
			PR.PRODUCT_NAME			AS PRODUCT_NAME,
			PS.SALES_PRICE			AS SALES_PRICE,
			PS.DISPLAY_FLG			AS DISPLAY_FLG,
			PS.ENTRY_START_DATE		AS ENTRY_START_DATE,
			PS.ENTRY_END_DATE		AS ENTRY_END_DATE,
			PS.PURCHASE_START_DATE	AS PURCHASE_START_DATE,
			PS.PURCHASE_END_DATE	AS PURCHASE_END_DATE,
			(SELECT COLOR FROM ORDERSHEET_MST WHERE IDX = PR.ORDERSHEET_IDX) AS COLOR
		FROM
			dev.PAGE_STANDBY PS
			LEFT JOIN dev.SHOP_PRODUCT PR ON
			PS.PRODUCT_IDX = PR.IDX
		WHERE
			PS.IDX = ".$standby_idx."
	";
}

$db->query($select_standby_sql);

foreach($db->fetch() as $standby_data) {
	$standby_idx = $standby_data['STANDBY_IDX'];
	
	$qty_info = array();
	if (!empty($standby_idx)) {
		$select_qty_sql = "
			SELECT
				QS.IDX					AS QTY_IDX,
				QS.OPTION_IDX			AS OPTION_IDX,
				QS.OPTION_NAME			AS OPTION_NAME,
				QS.BARCODE				AS BARCODE,
				QS.PRODUCT_QTY			AS PRODUCT_QTY
			FROM
				dev.QTY_STANDBY QS
			WHERE
				QS.STANDBY_IDX = ".$standby_idx."
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
		'standby_idx'			=>$standby_data['STANDBY_IDX'],
		'country'				=>$standby_data['COUNTRY'],
		'member_level'			=>$standby_data['MEMBER_LEVEL'],
		'product_idx'			=>$standby_data['PRODUCT_IDX'],
		'img_location'			=>$standby_data['IMG_LOCATION'],
		'product_code'			=>$standby_data['PRODUCT_CODE'],
		'product_name'			=>$standby_data['PRODUCT_NAME'],
		'sales_price'			=>$standby_data['SALES_PRICE'],
		'display_flg'			=>$standby_data['DISPLAY_FLG'],
		'entry_start_date'		=>$standby_data['ENTRY_START_DATE'],
		'entry_end_date'		=>$standby_data['ENTRY_END_DATE'],
		'purchase_start_date'	=>$standby_data['PURCHASE_START_DATE'],
		'purchase_end_date'		=>$standby_data['PURCHASE_END_DATE'],
		'color'					=>$standby_data['COLOR'],
		'qty_info'				=>$qty_info
	);
}
?>