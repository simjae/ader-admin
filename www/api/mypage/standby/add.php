<?php
/*
 +=============================================================================
 | 
 | 마이페이지_스탠바이 - 스탠바이 응모
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

$member_name = null;
if (isset($_SESSION['MEMBER_NAME'])) {
	$member_name = $_SESSION['MEMBER_NAME'];	
}

$standby_idx = 0;
if (isset($_POST['standby_idx'])) {
	$standby_idx = $_POST['standby_idx'];
}

$option_idx = 0;
if (isset($_POST['option_idx'])) {
	$option_idx = $_POST['option_idx'];
}

if ($country == null || $member_idx == 0 || $member_name == null) {
	$json_result['code'] = 401;
	$json_result['msg'] = "로그인 정보가 없습니다";
	return $json_result;
}

if ($country != null && $member_idx > 0 && $standby_idx > 0 && $option_idx > 0) {
	$standby_cnt = $db->count("PAGE_STANDBY","IDX = ".$standby_idx." AND COUNTRY = '".$country."' AND DISPLAY_STATUS = TRUE AND ENTRY_START_DATE >= NOW() AND ENTRY_END_DATE < NOW()");
	if ($standby_cnt == 0) {
		$json_result['code'] = 302;
		$json_result['msg'] = '해당 스탠바이는 현재 진행중이지 않습니다.';
		return $json_result;
	}
	
	$entry_cnt = $db->count("ENTRY_STANDBY","COUNTRY = '".$country."' AND STANDBY_IDX = ".$standby_idx." AND MEMBER_IDX = ".$member_idx);
	if ($entry_cnt > 0) {
		$json_result['code'] = 302;
		$json_result['msg'] = '동일한 스탠바이를 중복신청할 수 없습니다.';
		return $json_result;
	}
	
	$insert_entry_sql = "
		INSERT INTO
			ENTRY_STANDBY
		(
			COUNTRY,
			STANDBY_IDX,
			MEMBER_IDX,
			MEMBER_NAME,
			PRODUCT_IDX,
			OPTION_IDX,
			CREATER,
			UPDATER
		)
		SELECT
			'".$country."'		AS COUNTRY,
			".$standby_idx."	AS STANDBY_IDX,
			".$member_idx."		AS MEMBER_IDX,
			'".$member_NAME."	AS MEMBER_NAME,
			PS.PRODUCT_IDX		AS PRODUCT_IDX,
			".$option_idx."		AS OPTION_IDX,
			OO.OPTION_NAME		AS OPTION_NAME,
			OO.BARCODE			AS OO.BARCODE,
			'".$member_id."'	AS CREATER,
			'".$member_id."'	AS UPDATER
		FROM
			PAGE_STANDBY PS
			LEFT JOIN SHOP_PRODUCT PR ON
			PS.PRODUCT_IDX = PR.IDX
			LEFT JOIN ORDERSHEET_OPTION OO ON
			PR.ORDERSHEET_IDX = OO.ORDERSHEET_IDX
		WHERE
			PS.IDX = ".$standby_idx." AND
			PS.COUNTRY = '".$country."'
	";
	
	$db->query($insert_entry_sql);
}

?>