<?php
/*
 +=============================================================================
 | 
 | 찜한 상품 리스트 - 상품 정보 수정
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
if (isset($_POST['country'])) {
	$country = $_POST['country'];
}

$member_idx = 1;
//$member_idx = 0;
if (isset($_SESSION['MEMBER_IDX'])) {
	$member_idx = $_SESSION['MEMBER_IDX'];
}

$member_id = 'adertest4';
//$member_id = null;
if (isset($_SESSION['MEMBER_ID'])) {
	$member_id = $_SESSION['MEMBER_ID'];
}

$basket_idx = null;
if (isset($_POST['basket_idx'])) {
	$basket_idx	= $_POST['basket_idx'];
}

$product_idx = null;
if (isset($_POST['product_idx'])) {
	$product_idx = $_POST['product_idx'];
}

if ($member_idx == 0 || $member_id == null) {
	$json_result['code'] = 401;
	$json_result['msg'] = "로그인 후 다시 시도해 주세요.";
	return $json_result;
}

if ($country == "" || $country == null) {
	$json_result['code'] = 401;
	$json_result['msg'] = "부적절한 방법으로 접근하셨습니다. 사이트 내의 링크를 확인해주세요.";
	return $json_result;
}

if ($basket_idx != null) {
	$select_product_sql = "
		SELECT
			PR.IDX			AS PRODUCT_IDX,
			OM.COLOR		AS COLOR,
			OM.COLOR_RGB	AS COLOR_RGB
		FROM
			dev.ORDERSHEET_MST OM
			LEFT JOIN dev.SHOP_PRODUCT PR ON
			OM.IDX = PR.ORDERSHEET_IDX
		WHERE
			OM.STYLE_CODE = (
				SELECT
					S_PR.STYLE_CODE
				FROM
					dev.SHOP_PRODUCT S_PR
				WHERE
					S_PR.IDX IN (
						SELECT
							S_BI.PRODUCT_IDX
						FROM
							dev.BASKET_INFO S_BI
						WHERE
							S_BI.IDX = ".$basket_idx." AND
							S_BI.MEMBER_IDX = ".$member_idx."
					)
			) AND
			(
				PR.LIMIT_MEMBER = 0 OR
				PR.LIMIT_MEMBER REGEXP (
					SELECT
						LEVEL_IDX
					FROM
						dev.MEMBER_".$country." S_MB
					WHERE
						IDX = ".$member_idx."
				)
			) AND
			PR.SALE_FLG = TRUE AND
			PR.DEL_FLG = FALSE
	";
	
	$db->query($select_product_sql);
	
	$option_info = array();
	foreach($db->fetch() as $product_data) {
		$product_idx = $product_data['PRODUCT_IDX'];
		
		if (!empty($product_idx)) {
			$option_info = getOptionInfo($db,$product_idx);
		}
		
		$json_result['data'][] = array(
			'product_idx'	=>$product_data['PRODUCT_IDX'],
			'color'			=>$product_data['COLOR'],
			'color_rgb'		=>$product_data['COLOR_RGB'],
			'option_info'	=>$option_info
		);
	}
}

if ($product_idx != null) {
	$option_info = array();
	$option_info = getOptionInfo($db,$option_idx);
	
	$json_result['data'][] = array(
		'option_info'	=>$option_info
	);
}

function getOptionInfo($db,$product_idx) {
	$option_info = array();
	
	$select_option_sql = "
		SELECT
			OO.IDX			AS OPTION_IDX,
			OO.OPTION_NAME	AS OPTION_NAME
		FROM
			dev.ORDERSHEET_OPTION OO
			LEFT JOIN dev.SHOP_PRODUCT PR ON
			OO.ORDERSHEET_IDX = PR.ORDERSHEET_IDX
		WHERE
			PR.IDX = ".$product_idx."
	";
	
	$db->query($select_option_sql);
			
	foreach($db->fetch() as $option_data) {
		$option_info[] = array(
			'option_idx'	=>$option_data['OPTION_IDX'],
			'option_name'	=>$option_data['OPTION_NAME']
		);
	}
	
	return $option_info;
}
?>