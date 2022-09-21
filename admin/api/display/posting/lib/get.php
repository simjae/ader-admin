<?php
/*
 +=============================================================================
 | 
 | 전시관리 게시물 조회 API
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.08.30
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

/** 변수 정리 **/
$page_idx			= $_POST['page_idx'];
$tab_num			= $_POST['tab_num'];

$country			= $_POST['country'];

$rows 				= $_POST['rows'];
$page 				= $_POST['page'];

/** 검색 조건 **/
$where = ' DEL_FLG = FALSE AND PERSONAL_ORDER_FLG = FALSE AND SALE_FLG = TRUE ';
$where_cnt = $where;

$tables = " dev.SHOP_PRODUCT ";

/** DB 처리 **/
$limit_start = (intval($page)-1)*$rows;
$total_cnt = $db->count($tables,$where_cnt);
$json_result = array(
	'total' => $db->count($tables,$where),
	'total_cnt' => $total_cnt,
	'page' => $page
);

if ($search_type != null && $search_keyword != null) {
	switch ($search_type) {
		case "product_code" :
			$where .= ' AND (PRODUCT.PRODUCT_CODE LIKE "%'.$search_keyword.'%") ';
			break;
		
		case "product_name" :
			$where .= ' AND (PRODUCT.PRODUCT_NAME LIKE "%'.$search_keyword.'%") ';
			break;
	}
}

$sql = "SELECT
			PRODUCT.IDX,
			PRODUCT.PRODUCT_TYPE,
			PRODUCT.PRODUCT_CODE,
			PRODUCT.PRODUCT_NAME,
			(
				SELECT
					REPLACE(
						IMG.IMG_LOCATION,'/var/www/admin/www',''
					)
				FROM
					dev.PRODUCT_IMG IMG
				WHERE
					IMG.DEL_FLG = FALSE AND
					IMG.IMG_TYPE = 'product' AND
					IMG.IMG_SIZE = 'mdl' AND
					IMG.PRODUCT_IDX = PRODUCT.IDX
			) AS IMG_LOCATION,
			PRODUCT.UPDATE_DATE
		FROM
			dev.SHOP_PRODUCT PRODUCT
		WHERE
			".$where."
			AND ((SELECT COUNT(IDX) FROM dev.PRODUCT_IMG WHERE DEL_FLG = FALSE AND PRODUCT_IDX = PRODUCT.IDX) > 0)
		ORDER BY
			IDX DESC";

if ($rows != null && $select_idx_flg == null) {
	$sql .= " LIMIT ".$limit_start.",".$rows;
}

$db->query($sql);
foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'no'				=>intval($total_cnt--),
		'idx'               =>intval($data['IDX']),
		'product_type'      =>$data['PRODUCT_TYPE'],
		'product_code'      =>$data['PRODUCT_CODE'],
		'product_name'      =>$data['PRODUCT_NAME'],
		'img_location'      =>$data['IMG_LOCATION'],
		'update_date'    	=>$data['UPDATE_DATE']
	);
}
?>