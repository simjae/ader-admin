<?php
/*
 +=============================================================================
 | 
 | 마이페이지 정보 취득
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.01.09
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
if(isset($_SESSION['MEMBER_IDX'])){
	$member_idx = $_SESSION['MEMBER_IDX'];
}

$list_type = null;
if (isset($_POST['list_type'])) {
	$list_type = $_POST['list_type'];
}

$rows = NULL;
if(isset($_POST['rows'])){
	$rows = $_POST['rows'];
}

$page = NULL;
if(isset($_POST['page'])){
	$page = $_POST['page'];
}

if($member_idx == 0){
    $json_result['code'] = 401;
    $json_result['msg'] = '비로그인 상태입니다.';
	
	return $json_result;
}

if($country != null && $member_idx > 0 && $list_type != null){
	$where = "
			WHERE
				REO.MEMBER_IDX = ".$member_idx."
	";
	$where_cnt = "
				REO.MEMBER_IDX = ".$member_idx."
	";
	
	switch ($list_type) {
		case 'apply':
			$where .= ' AND (REO.DEL_FLG = FALSE AND REO.REORDER_STATUS = FALSE) ';
			$where_cnt .= ' AND (REO.DEL_FLG = FALSE AND REO.REORDER_STATUS = FALSE) ';
			break;
		case 'alarm':
			$where .= ' AND (REO.DEL_FLG = FALSE AND REO.REORDER_STATUS = TRUE) ';
			$where_cnt .= ' AND (REO.DEL_FLG = FALSE AND REO.REORDER_STATUS = TRUE) ';
			break;
		case 'cancel':
			$where .= ' AND (REO.DEL_FLG = TRUE) ';
			$where_cnt .= ' AND (REO.DEL_FLG = TRUE) ';	
			break;
	}
	$json_result = array(
		'total' => $db->count("	PRODUCT_REORDER REO
								LEFT OUTER JOIN  SHOP_PRODUCT PR ON
								REO.PRODUCT_IDX = PR.IDX
								LEFT JOIN ORDERSHEET_MST OM ON
								PR.ORDERSHEET_IDX = OM.IDX",$where_cnt),
		'page' => $page
	);

	$limit = '';
	if($rows != NULL && $page != NULL){
		$limit_start = (intval($page)-1)*$rows;
		$limit = "LIMIT ".$limit_start.",".$rows;
	}
	
	$select_reorder_sql = "
		SELECT
			REO.IDX							AS REORDER_IDX,
			REO.PRODUCT_NAME				AS PRODUCT_NAME,
			OM.COLOR						AS COLOR,
			OM.COLOR_RGB					AS COLOR_RGB,
			REO.OPTION_NAME					AS OPTION_NAME,
			PR.SALES_PRICE_".$country."		AS SALES_PRICE,
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
			)   							AS IMG_LOCATION,
			DATE_FORMAT(
				REO.UPDATE_DATE,
				'%Y.%m.%d'
			)								AS UPDATE_DATE
		FROM
			PRODUCT_REORDER REO
			LEFT OUTER JOIN  SHOP_PRODUCT PR ON
			REO.PRODUCT_IDX = PR.IDX
			LEFT JOIN ORDERSHEET_MST OM ON
			PR.ORDERSHEET_IDX = OM.IDX
		".$where."
		ORDER BY
			REO.IDX DESC
		".$limit;

	$db->query($select_reorder_sql);

	foreach($db->fetch() as $data){
		$json_result['data'][] = array(
			'reorder_idx'           =>$data['REORDER_IDX'],
			'product_name'          =>$data['PRODUCT_NAME'],
			'color'             	=>$data['COLOR'],
			'color_rgb'             =>$data['COLOR_RGB'],
			'option_name'           =>$data['OPTION_NAME'],
			'sales_price_kr'        =>$data['SALES_PRICE'],
			'img_location'          =>$data['IMG_LOCATION'],
			'update_date'           =>$data['UPDATE_DATE']
		);
	}
}

?>