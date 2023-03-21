<?php
/*
 +=============================================================================
 | 
 | 마이페이지_스탠바이 - 응모한 스탠바이 리스트 정보 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2023.01.15
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$country = null;
if (isset($_SESSION['COUNTRY'])) {
	$country = $_SESSION['COUNTRY'];
}

$member_idx = 0;
if (isset($_SESSION['MEMBER_IDX'])) {
	$member_idx = $_SESSION['MEMBER_IDX'];
}

if ($country == null || $member_idx == 0) {
	$json_result['code'] = 401;
	$json_result['msg'] = "로그인 정보가 없습니다";
	
	return $json_result;
}

if($country != null && $member_idx > 0){
	$select_entry_sql = "
		SELECT
			ES.IDX					AS ENTRY_IDX,
			ES.STANDBY_IDX			AS STANDBY_IDX,
			(
				SELECT
					REPLACE(
						IMG_LOCATION,
						'/var/www/admin/www',
						''
					)
				FROM
					PRODUCT_IMG S_PI
				WHERE
					S_PI.IMG_TYPE = 'P' AND
					S_PI.IMG_SIZE = 'S'
				ORDER BY
					IDX ASC
				LIMIT
					0,1
			)						AS IMG_LOCATION,
			PS.PRODUCT_NAME			AS PRODUCT_NAME,
			PS.SALES_PRICE			AS SALES_PRICE,
			OM.COLOR				AS COLOR,
			OM.COLOR_RGB			AS COLOR_RGB,
			OO.OPTION_NAME			AS OPTION_NAME,
			DATE_FORMAT(
				PS.ENTRY_START_DATE,'%Y.%m.%d %H:%i'
			)						AS ENTRY_START_DATE,
			DATE_FORMAT(
				PS.ENTRY_END_DATE,'%Y.%m.%d %H:%i'
			)						AS ENTRY_END_DATE,
			DATE_FORMAT(
				PS.PURCHASE_START_DATE,'%Y.%m.%d %H:%i'
			)						AS PURCHASE_START_DATE,
			DATE_FORMAT(
				PS.PURCHASE_END_DATE,'%Y.%m.%d %H:%i'
			)						AS PURCHASE_END_DATE,
			DATE_FORMAT(
				ES.CREATE_DATE,'%Y.%m.%d %H:%i'
			)						AS APPLY_DATE,
			PS.DISPLAY_FLG			AS DISPLAY_FLG,
			ES.PURCHASE_FLG			AS PURCHASE_FLG,

			CASE
				WHEN
					PS.PURCHASE_END_DATE < NOW()
					THEN 
						'스탠바이 종료'
				WHEN
					PS.PURCHASE_END_DATE > NOW() AND
					PS.PURCHASE_START_DATE > NOW()
					THEN
						'구매대기'
				WHEN
					PS.PURCHASE_END_DATE > NOW() AND
					PS.PURCHASE_START_DATE < NOW() AND
					ES.PURCHASE_FLG = TRUE
					THEN
						'구매완료'
				WHEN
					PS.PURCHASE_END_DATE > NOW() AND
					PS.PURCHASE_START_DATE < NOW() AND
					ES.PURCHASE_FLG = FALSE
					THEN '구매하기' 
				ELSE NULL
			END						AS PURCHASE_STATUS
		FROM
			PAGE_STANDBY PS
			LEFT JOIN ENTRY_STANDBY ES ON
			PS.IDX = ES.STANDBY_IDX
			LEFT JOIN SHOP_PRODUCT PR ON
			ES.PRODUCT_IDX = PR.IDX
			LEFT JOIN ORDERSHEET_MST OM ON
			PR.ORDERSHEET_IDX = OM.IDX
			LEFT JOIN ORDERSHEET_OPTION OO ON
			ES.OPTION_IDX = OO.IDX
		WHERE
			ES.COUNTRY = '".$country."' AND
			ES.MEMBER_IDX = ".$member_idx."
	";
	
	$db->query($select_entry_sql);
	
	foreach($db->fetch() as $entry_data) {
		$json_result['data'][] = array(
			'entry_idx'				=>$entry_data['ENTRY_IDX'],
			'standby_idx'			=>$entry_data['STANDBY_IDX'],
			'img_location'			=>$entry_data['IMG_LOCATION'],
			'product_name'			=>$entry_data['PRODUCT_NAME'],
			'sales_price'			=>$entry_data['SALES_PRICE'],
			'color'					=>$entry_data['COLOR'],
			'color_rgb'				=>$entry_data['COLOR_RGB'],
			'option_name'			=>$entry_data['OPTION_NAME'],
			'display_flg'			=>$entry_data['DISPLAY_FLG'],
			'entry_start_date'		=>$entry_data['ENTRY_START_DATE'],
			'entry_end_date'		=>$entry_data['ENTRY_END_DATE'],
			'purchase_start_date'	=>$entry_data['PURCHASE_START_DATE'],
			'purchase_end_date'		=>$entry_data['PURCHASE_END_DATE'],
			'apply_date'			=>$entry_data['APPLY_DATE'],
			'purchase_status'		=>$entry_data['PURCHASE_STATUS']
		);
	}
}

?>