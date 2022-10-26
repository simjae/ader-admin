<?php
/*
 +=============================================================================
 | 
 | 오더시트 히스토리 목록
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.10.18
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$product_name    	= $_POST['product_name'];			//상품명
$product_code    	= $_POST['product_code'];			//상품코드
$ordersheet_auth    = $_POST['ordersheet_auth'];		//권한
$action_type	    = $_POST['action_type'];            //엑션타입
$category_mdl	    = $_POST['creater'];                //작성자
$min_launching_date	= $_POST['min_create_date'];		//런칭 검색일자 시작점
$max_launching_date	= $_POST['max_create_date'];		//런칭 검색일자 종점

$sort_type 			= $_POST['sort_type'];				//정렬 타입
$sort_value 		= $_POST['sort_value'];				//정렬 값

$rows = $_POST['rows'];
$page = $_POST['page'];

$tables = "
	dev.ORDERSHEET_HISTORY OH
";

//검색 유형 - 디폴트
$where = '1=1';

$where_cnt = $where;

//검색 유형 - 상품명
if($product_name != null){
	$where .= ' AND (OH.PRODUCT_NAME LIKE "%'.$product_name.'%") ';
}

//검색 유형 - 상품코드
if($product_code != null){
	$where .= ' AND (OH.PRODUCT_CODE LIKE "%'.$product_code.'%") ';
}

//검색 유형 - 권한
if ($ordersheet_auth != null && $ordersheet_auth != "ALL") {
	$where .= " AND OH.ORDERSHEET_AUTH = '".$ordersheet_auth."' ";
}

//검색 유형 - 엑션타입
if ($action_type != null && $action_type != "ALL") {
	$where .= " AND OH.ACTION_TYPE = '".$action_type."' ";
}

//검색유형 - 작성자
if($creater != null){
	$where .= ' AND (OH.CREATER LIKE "%'.$creater.'%") ';
}

//검색 유형 - 생성일
if($min_create_date != null){
    $where .= " AND OH.CREATE_DATE >= '".$min_create_date." ";
}
if($max_launching_date != null){
    $where .= " AND OH.CREATE_DATE <= '".$max_create_date." ";
}

/** 정렬 조건 **/
$order = '';
if ($sort_value != null && $sort_type != null) {
	$order = ' OH.'.$sort_value." ".$sort_type." ";
} else {
	$order = ' OH.IDX DESC';
}

$limit_start = (intval($page)-1)*$rows;
$json_result = array(
	'total' => $db->count($tables,$where),
	'total_cnt' => $db->count($tables,$where_cnt),
	'page' => $page
);

$select = "";
$select.= "     OH.IDX											AS ORDERSHEET_HISTORY_IDX,
				OH.ORDERSHEET_AUTH								AS ORDERSHEET_AUTH,
				OH.ACTION_TYPE									AS ACTION_TYPE,
				OH.PRODUCT_CODE									AS PRODUCT_CODE,
				OH.PRODUCT_NAME									AS PRODUCT_NAME,
				OH.HISTORY_MSG									AS HISTORY_MSG,
                OH.CREATER									    AS CREATER,
				OH.CREATE_DATE									AS CREATE_DATE ";


$sql = 	'SELECT
			'.$select.'
		FROM 
			'.$tables.'
		WHERE 
			'.$where.'
		ORDER BY 
			'.$order;

if ($rows != null && $select_idx_flg == null) {
	$sql .= " LIMIT ".$limit_start.",".$rows;
}

$db->query($sql,$where_values);
foreach($db->fetch() as $data) {
    $json_result['data'][] = array(
        'num'							=>$total_cnt--,
        'ordersheet_history_idx'		=>intval($data['ORDERSHEET_HISTORY_IDX']),
        'ordersheet_auth'				=>$data['ORDERSHEET_AUTH'],
        'action_type'			        =>$data['ACTION_TYPE'],
        'product_code'			        =>$data['PRODUCT_CODE'],
        'product_name'			        =>$data['PRODUCT_NAME'],
        'history_msg'			        =>$data['HISTORY_MSG'],
        'creater'			            =>$data['CREATER'],
        'create_date'			        =>$data['CREATE_DATE']
    );
}
?>