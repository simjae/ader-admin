<?php
/*
 +=============================================================================
 | 
 | 라인타입 취득
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.02.24
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$type_name		  = $_POST['type_name'];
$use_product_flg	= $_POST['use_product_flg']; 

$sort_type 			= $_POST['sort_type'];				//정렬 타입
$sort_value 		= $_POST['sort_value'];				//정렬 값

$rows			   = $_POST['rows'];
$page			   = $_POST['page'];

$where = " 1=1 ";

if($type_name != null){
	$where .= " AND TYPE_NAME LIKE '%".$type_name."%' ";
}

if($use_product_flg == "FALSE"){
	$where .= "
		AND (
			SELECT
				COUNT(0)
			FROM
				ORDERSHEET_MST
			WHERE
				LINE_IDX IN (
					SELECT
						IDX
					FROM
						LINE_INFO
					WHERE
						LINE_TYPE_IDX = LT.IDX
				)
		) = 0
	";
}
else if($use_product_flg == "TRUE"){
	$where .= "
		AND (
			SELECT
				COUNT(0)
			FROM
				ORDERSHEET_MST
			WHERE
				LINE_IDX IN (
					SELECT
						IDX
					FROM
						LINE_INFO
					WHERE
						LINE_TYPE_IDX = LT.IDX
				)
		) > 0
	";
}

/** 정렬 조건 **/
$order = '';
if ($sort_value != null && $sort_type != null) {
	$order = " ".$sort_value." ".$sort_type." ";
} else {
	$order = " IDX DESC";
}

$limit_start = (intval($page)-1)*$rows;
$json_result = array(
	'total' => $db->count('LINE_TYPE LT ',$where),
	'total_cnt' => $db->count('LINE_TYPE LT ',' 1=1 '),
	'page' => $page
);
$get_clearance_sql = "
	SELECT
		IDX,
		TYPE_NAME,
		(SELECT
			COUNT(0)
		FROM
			ORDERSHEET_MST
		WHERE
			LINE_IDX IN (SELECT
							IDX
						FROM
							LINE_INFO
						WHERE
							LINE_TYPE_IDX = LT.IDX)) AS USE_PRODUCT_CNT
	FROM
		LINE_TYPE LT
	WHERE
		".$where."
	ORDER BY
		".$order."
	LIMIT
		 ".$limit_start.",".$rows."
";
$db->query($get_clearance_sql);

foreach($db->fetch() as $data){
	$json_result['data'][] = array(
		'line_type_idx'		 => $data['IDX'],
		'type_name'			 => $data['TYPE_NAME'],
		'use_product_cnt'	   => $data['USE_PRODUCT_CNT']
	);
}
?>