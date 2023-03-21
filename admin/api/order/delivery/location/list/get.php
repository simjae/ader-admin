<?php
/*
 +=============================================================================
 | 
 | 배송업체 명 조회
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.03.12
 | 최종 수정일	: 
 | 버전		: 1.1
 | 설명		: 
 | 
 +=============================================================================
*/

$country			= $_POST['country'];            //국가

$area_name		    = $_POST['area_name'];		    //지역명
$zipcode		    = $_POST['zipcode'];		    //우편번호

$rows = $_POST['rows'];
$page = $_POST['page'];

$sort_type          = $_POST['sort_type'];				    //정렬타입
$sort_value         = $_POST['sort_value'];				    //정렬 기준값

/** 검색 조건 **/
$where = ' DL.COUNTRY = "'.$country.'" AND DEL_FLG = FALSE';
$where_cnt = $where;

if($area_name != null){
    $where .= ' AND ( DL.AREA_NAME LIKE "%'.$area_name.'%") ';
}
if($zipcode != null){
    $where .= " AND ( '".$zipcode."' BETWEEN DL.START_ZIPCODE AND DL.END_ZIPCODE )";
}
/** 정렬 조건 **/
$order = '';
if ($sort_value != null && $sort_type != null) {
	$order = ' DL.'.$sort_value." ".$sort_type." ";
} else {
	$order = ' DL.ISOLATED_FLG ASC, DL.IDX DESC';
}

$table = "
	DELIVERY_LOCATION DL
";

$total_cnt = $db->count($table,$where_cnt);
$json_result = array(
	'total' => $db->count($table,$where),
	'total_cnt' => $total_cnt,
	'page' => intval($page)
);

$limit_start = (intval($page)-1)*$rows;

//검색항목
$select_location_sql = "
	SELECT
		IDX,
        COUNTRY,
        AREA_NAME,
        START_ZIPCODE,
        END_ZIPCODE,
        DELIVERY_PRICE,
        ISOLATED_FLG
	FROM
		".$table."
	WHERE
		".$where."
	ORDER BY
		".$order."
";
if ($rows != null) {
	$select_location_sql .= " LIMIT ".$limit_start.",".$rows;
}
$db->query($select_location_sql);

foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'num'					=>$total_cnt--,
        'idx'                   => $data['IDX'],
        'country'               => $data['COUNTRY'],
        'area_name'             => $data['AREA_NAME'],
        'start_zipcode'         => $data['START_ZIPCODE'],
        'end_zipcode'           => $data['END_ZIPCODE'],
        'delivery_price'        => $data['DELIVERY_PRICE'],
        'isolated_flg'          => $data['ISOLATED_FLG']
	);
}
?>