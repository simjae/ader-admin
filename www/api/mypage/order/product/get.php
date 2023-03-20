<?php
/*
 +=============================================================================
 | 
 | 마이페이지_주문조회화면
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2023.01.30
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

$order_idx = 0;
if (isset($_POST['order_idx'])) {
	$order_idx = $_POST['order_idx'];
}

$order_product_idx = 0;
if (isset($_POST['order_product_idx'])) {
	$order_product_idx = $_POST['order_product_idx'];
}

$where = " OI.MEMBER_IDX = ".$member_idx." ";

if ($member_idx > 0 && $order_idx > 0 && $order_product_idx > 0) {
	$select_order_product_sql = "
		SELECT
			OP.IDX				AS ORDER_PRODUCT_IDX,
			OP.ORDER_STATUS		AS ORDER_STATUS,
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
				ORDER BY
					S_PI.IDX ASC
				LIMIT
					0,1
			)					AS IMG_LOCATION,
			OP.PRODUCT_NAME		AS PRODUCT_NAME,
			OM.COLOR			AS COLOR,
			OM.COLOR_RGB		AS COLOR_RGB,
			OP.OPTION_NAME		AS OPTION_NAME,
			OP.PRODUCT_QTY		AS PRODUCT_QTY,
			OP.PRODUCT_PRICE	AS PRODUCT_PRICE
		FROM
			dev.ORDER_PRODUCT OP
			LEFT JOIN dev.SHOP_PRODUCT PR ON
			OP.PRODUCT_IDX = PR.IDX
			LEFT JOIN dev.ORDERSHEET_MST OM ON
			PR.ORDERSHEET_IDX = OM.IDX
		WHERE
			OP.IDX = ".$order_product_idx." AND
			OP.ORDER_IDX = ".$order_idx."
		ORDER BY
			OP.IDX ASC
	";
	
	$db->query($select_order_product_sql);
	
	foreach($db->fetch() as $order_product_data) {
		$json_result['data'][] = array(
			'order_product_idx'		=>$order_product_data['ORDER_PRODUCT_IDX'],
			'order_status'			=>$order_product_data['ORDER_STATUS'],
			'img_location'			=>$order_product_data['IMG_LOCATION'],
			'product_name'			=>$order_product_data['PRODUCT_NAME'],
			'color'					=>$order_product_data['COLOR'],
			'color_rgb'				=>$order_product_data['COLOR_RGB'],
			'option_name'			=>$order_product_data['OPTION_NAME'],
			'product_qty'			=>$order_product_data['PRODUCT_QTY'],
			'product_price'			=>number_format($order_product_data['PRODUCT_PRICE'])
		);
	}
} else {
	$json_result['code'] = 301;
	$json_result['msg'] = "로그인 정보가 없습니다. 로그인 후 다시 시도해주세요.";
}

?>