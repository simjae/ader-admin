<?php
/*
 +=============================================================================
 | 
 | 마이페이지_프리오더 - 응모한 프리오더 리스트 정보 조회
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
			EP.IDX					AS ENTRY_IDX,
			EP.PREORDER_IDX			AS PREORDER_IDX,
			(
				SELECT
					REPLACE(
						IMG_LOCATION,
						'/var/www/admin/www',
						''
					)
				FROM
					dev.PRODUCT_IMG S_PI
				WHERE
					S_PI.IMG_TYPE = 'P' AND
					S_PI.IMG_SIZE = 'S'
				ORDER BY
					IDX ASC
				LIMIT
					0,1
			)						AS IMG_LOCATION,
			PP.PRODUCT_NAME			AS PRODUCT_NAME,
			OM.COLOR				AS COLOR,
			OM.COLOR_RGB			AS COLOR_RGB,
			OO.OPTION_NAME			AS OPTION_NAME,
			EP.PRODUCT_QTY			AS PRODUCT_QTY,
			PP.SALES_PRICE			AS SALES_PRICE,
			OI.IDX					AS ORDER_IDX,
			OI.ORDER_CODE			AS ORDER_CODE,
			OI.ORDER_DATE			AS ORDER_DATE,
			OI.ORDER_STATUS			AS ORDER_STATUS,
			DC.COMPANY_NAME			AS COMPANY_NAME,
			DC.COMPANY_TEL			AS COMPANY_TEL
		FROM
			dev.PAGE_PREORDER PP
			LEFT JOIN dev.ENTRY_PREORDER EP ON
			PP.IDX = EP.PREORDER_IDX
			LEFT JOIN dev.SHOP_PRODUCT PR ON
			EP.PRODUCT_IDX = PR.IDX
			LEFT JOIN dev.ORDERSHEET_MST OM ON
			PR.ORDERSHEET_IDX = OM.IDX
			LEFT JOIN dev.ORDERSHEET_OPTION OO ON
			EP.OPTION_IDX = OO.IDX
			LEFT JOIN dev.ORDER_INFO OI ON
			EP.ORDER_IDX = OI.IDX
			LEFT JOIN dev.DELIVERY_COMPANY DC ON
			OI.DELIVERY_IDX = DC.IDX
		WHERE
			EP.COUNTRY = '".$country."' AND
			EP.MEMBER_IDX = ".$member_idx."
	";
	
	$db->query($select_entry_sql);
	
	foreach($db->fetch() as $entry_data) {
		$order_status = $entry_data['ORDER_STATUS'];
		
		$preorder_status = "";
		if ($order_status == "POD" || $order_status == "DPR") {
			$order_status == "배송준비";
		} else {
			switch ($order_status) {
				case "PCP" :
					$preorder_status = "결제완료";
					break;
				
				case "POP" :
					$preorder_status = "프리오더 준비";
					break;
				
				case "DPG" :
					$preorder_status = "배송중";
					break;
					
				case "DCP" :
					$preorder_status = "배송완료";
					break;
			}
		}
		
		$json_result['data'][] = array(
			'entry_idx'				=>$entry_data['ENTRY_IDX'],
			'preorder_idx'			=>$entry_data['PREORDER_IDX'],
			'img_location'			=>$entry_data['IMG_LOCATION'],
			'product_name'			=>$entry_data['PRODUCT_NAME'],
			'color'					=>$entry_data['COLOR'],
			'color_rgb'				=>$entry_data['COLOR_RGB'],
			'option_name'			=>$entry_data['OPTION_NAME'],
			'product_qty'			=>$entry_data['PRODUCT_QTY'],
			'sales_price'			=>$entry_data['SALES_PRICE'],
			'order_idx'				=>$entry_data['ORDER_IDX'],
			'order_code'			=>$entry_data['ORDER_CODE'],
			'order_date'			=>$entry_data['ORDER_DATE'],
			'order_status'			=>$entry_data['ORDER_STATUS'],
			'company_name'			=>$entry_data['COMPANY_NAME'],
			'company_tel'			=>$entry_data['COMPANY_TEL'],
			'preorder_status'		=>$preorder_status
		);
	}
}

?>