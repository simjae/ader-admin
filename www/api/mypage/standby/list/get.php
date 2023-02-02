<?php
/*
 +=============================================================================
 | 
 | 마이페이지_스탠바이 - 스탠바이 리스트 조회
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

$status_code = null;
if (isset($_POST['status_code'])) {
	$status_code = $_POST['status_code'];
}

if ($country == null || $member_idx == 0) {
	$json_result['code'] = 401;
	$json_result['msg'] = "로그인 정보가 없습니다";
	
	return $json_result;
}

if($country != null && $member_idx > 0){
	$select_standby_sql = "
		SELECT
			PS.IDX					AS STANDBY_IDX,
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
				LIMIT
					0,1
			)						AS IMG_LOCATION,
			PR.PRODUCT_NAME			AS PRODUCT_NAME,
			OM.COLOR				AS COLOR,
			OM.COLOR_RGB			AS COLOR_RGB,
			DATE_FORMAT(
				PS.ENTRY_START_DATE,'%Y.%m.%d %H:%i'
			)						AS ENTRY_START_DATE,
			DATE_FORMAT(
				PS.ENTRY_END_DATE,'%Y.%m.%d %H:%i'
			)						AS ENTRY_END_DATE,
			CASE
				WHEN
					PS.ENTRY_START_DATE > NOW()
					THEN 
						'Comming soon'
				WHEN
					PS.ENTRY_END_DATE < NOW()
					THEN
						'종료'
				ELSE
					'진행 중'
			END						AS ENTRY_STATUS
		FROM
			dev.PAGE_STANDBY PS
			LEFT JOIN dev.SHOP_PRODUCT PR ON
			PS.PRODUCT_IDX = PR.IDX
			LEFT JOIN dev.ORDERSHEET_MST OM ON
			PR.ORDERSHEET_IDX = OM.IDX
		WHERE
			PS.COUNTRY = '".$country."' AND
			PS.DISPLAY_FLG = TRUE AND
			PS.DEL_FLG = FALSE
		ORDER BY
			PS.IDX DESC
	";
	
	$db->query($select_standby_sql);
	
	foreach($db->fetch() as $standby_data) {
		$now = strtotime(date('Y-m-d H:i:s'));
		
		$entry_status = "";
		$entry_start_date = $standby_data['ENTRY_START_DATE'];
		$entry_end_date = $standby_data['ENTRY_END_DATE'];
		
		if (strtotime($entry_start_date) >= $now) {
			$entry_status = "Coming soon";
		} else if (strtotime($entry_end_date) < $now) {
			$entry_status = "종료";
		} else if (strtotime($entry_start_date) <= $now && strtotime($entry_end_date) >= $now) {
			$entry_status = "진행 중";
		}
		
		$json_result['data'][] = array(
			'standby_idx'			=>$standby_data['STANDBY_IDX'],
			'img_location'			=>$standby_data['IMG_LOCATION'],
			'product_name'			=>$standby_data['PRODUCT_NAME'],
			'color'					=>$standby_data['COLOR'],
			'color_rgb'				=>$standby_data['COLOR_RGB'],
			'entry_status'			=>$standby_data['ENTRY_STATUS'],
			'entry_start_date'		=>$standby_data['ENTRY_START_DATE'],
			'entry_end_date'		=>$standby_data['ENTRY_END_DATE']
		);
	}
}

?>