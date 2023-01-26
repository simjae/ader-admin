<?php
/*
 +=============================================================================
 | 
 | 마이페이지 블루마크 - 블루마크 인증
 | -------
 |
 | 최초 작성	: 윤재은
 | 최초 작성일	: 2023.01.09
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$member_idx = 0;
if (isset($_SESSION['MEMBER_IDX'])) {
	$member_idx = $_SESSION['MEMBER_IDX'];
}

$bluemark_idx = 0;
if (isset($_POST['bluemark_idx'])) {
	$bluemark_idx = $_POST['bluemark_idx'];
}

$country	= $_POST['country'];

if ($member_idx == 0) {
	$json_result['code'] = 401;
	$json_result['msg'] = "로그인 후 다시 시도해 주세요.";
	exit;
}

if ($bluemark_idx == 0) {
	$json_result['code'] = 401;
	$json_result['msg'] = "부정확한 인증내역이 선택되었습니다. 인증내역을 다시 선택해주세요.";
	exit;
}

if ($member_idx > 0 && $bluemark_idx > 0) {
	$select_bluemark_sql = "
		SELECT
			BI.IDX				AS BLUEMARK_IDX,
			PR.PRODUCT_NAME		AS PRODUCT_NAME,
			OM.COLOR			AS COLOR,
			REPLACE(
				BI.MEMBER_ID,
				SUBSTR(BI.MEMBER_ID,5,LENGTH(MEMBER_ID)),
				'*******'
			)					AS MEMBER_ID,
			DATE_FORMAT(
				BI.UPDATE_DATE,
				'%Y.%m.%d'
			)					AS UPDATE_DATE,
			UPPER(
				BI.SERIAL_CODE
			)					AS SERIAL_CODE
		FROM
			dev.BLUEMARK_INFO BI
			LEFT JOIN dev.SHOP_PRODUCT PR ON
			BI.PRODUCT_IDX = PR.IDX
			LEFT JOIN dev.ORDERSHEET_MST OM ON
			PR.ORDERSHEET_IDX = OM.IDX
		WHERE
			BI.DEL_FLG = FALSE AND
			BI.IDX = ".$bluemark_idx." AND
			BI.MEMBER_IDX = ".$member_idx."
	";
	
	$db->query($select_bluemark_sql);
	
	foreach($db->fetch() as $bluemark_data) {
		$json_result['data'][] = array(
			'bluemark_idx'	=>$bluemark_data['BLUEMARK_IDX'],
			'product_name'	=>$bluemark_data['PRODUCT_NAME'],
			'color'			=>$bluemark_data['COLOR'],
			'member_id'		=>$bluemark_data['MEMBER_ID'],
			'update_date'	=>$bluemark_data['UPDATE_DATE'],
			'serial_code'	=>$bluemark_data['SERIAL_CODE']
		);
	}
}
?>