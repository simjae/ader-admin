<?php
/*
 +=============================================================================
 | 
 | 마이페이지 블루마크 - 블루마크 내역 조회
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

if ($member_idx == 0) {
	$json_result['code'] = 401;
	$json_result['msg'] = "로그인 후 다시 시도해 주세요.";
	exit;
}

$country		= $_POST['country'];

$rows = NULL;
if(isset($_POST['rows'])){
	$rows = $_POST['rows'];
}

$page = NULL;
if(isset($_POST['page'])){
	$page = $_POST['page'];
}

if ($member_idx != 0 && $country != null) {
	$where = "
			WHERE
				BI.DEL_FLG = FALSE AND
				BI.MEMBER_IDX = ".$member_idx."
	";
	$where_cnt = "
				BI.DEL_FLG = FALSE AND
				BI.MEMBER_IDX = ".$member_idx."
	";
	
	$json_result = array(
		'total' => $db->count("	BLUEMARK_INFO BI
								LEFT JOIN SHOP_PRODUCT PR ON
								PR.IDX = BI.PRODUCT_IDX
								LEFT JOIN ORDERSHEET_MST OM ON
								OM.IDX = PR.ORDERSHEET_IDX
								LEFT JOIN ORDERSHEET_OPTION OO ON
								BI.OPTION_IDX = OO.IDX",$where_cnt),
		'page' => $page
	);

	$limit_start = (intval($page)-1)*$rows;
	
	$select_bluemark_sql = "
		SELECT 
			BI.IDX						AS BLUEMARK_IDX,
			(
			SELECT
				REPLACE 
					(
					S_PI.IMG_LOCATION,'/var/www/admin/www',''
					) AS IMG_LOCATION
				FROM
					PRODUCT_IMG S_PI
				WHERE 
					S_PI.PRODUCT_IDX = BI.PRODUCT_IDX AND 
					IMG_TYPE = 'P' AND 
					IMG_SIZE = 'S'
				LIMIT 
					0,1
			)							AS IMG_LOCATION,
			PR.PRODUCT_NAME				AS PRODUCT_NAME,
			PR.SALES_PRICE_".$country."	AS SALES_PRICE,
			OM.COLOR					AS COLOR,
			OM.COLOR_RGB				AS COLOR_RGB,
			OO.OPTION_NAME				AS OPTION_NAME,
			DATE_FORMAT(BI.UPDATE_DATE, '%Y.%m.%d')				AS UPDATE_DATE
		FROM
			BLUEMARK_INFO BI
			LEFT JOIN SHOP_PRODUCT PR ON
			PR.IDX = BI.PRODUCT_IDX
			LEFT JOIN ORDERSHEET_MST OM ON
			OM.IDX = PR.ORDERSHEET_IDX
			LEFT JOIN ORDERSHEET_OPTION OO ON
			BI.OPTION_IDX = OO.IDX
		".$where."
		ORDER BY
			BI.UPDATE_DATE DESC
		LIMIT ".$limit_start.",".$rows;
	
	$db->query($select_bluemark_sql);

	foreach($db->fetch() as $data) {
		$json_result['data'][] = array(
			'bluemark_idx'	=>$data['BLUEMARK_IDX'],
			'img_location'  =>$data['IMG_LOCATION'],
			'product_name'	=>$data['PRODUCT_NAME'],
			'sales_price'	=>number_format($data['SALES_PRICE']),
			'color'			=>$data['COLOR'],
			'color_rgb'			=>$data['COLOR_RGB'],
			'option_name'	=>$data['OPTION_NAME'],
			'update_date'	=>$data['UPDATE_DATE']
		);
	}
}
?>