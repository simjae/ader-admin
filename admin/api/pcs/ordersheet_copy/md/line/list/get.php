<?php
/*
 +=============================================================================
 | 
 | 라인 정보 리스트
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.11.04
 | 최종 수정일	: 
 | 버전		: 1.1
 | 설명		: 
 | 
 +=============================================================================
*/

$line_name 			= $_POST['line_name'];				//라인 명
$line_type_idx 		    = $_POST['line_type_idx'];			//라인 타입
$use_product_flg 	= $_POST['use_product_flg'];		//사용중인 상품여부 플래그

$sort_type 			= $_POST['sort_type'];				//정렬 타입
$sort_value 		= $_POST['sort_value'];				//정렬 값

$rows = $_POST['rows'];
$page = $_POST['page'];
    
$table = "LINE_INFO";
$where = '1=1';
$having = '';

if($line_name != null){
	$where .= ' AND (LI.LINE_NAME LIKE "%'.$line_name.'%") ';
}

if($line_type_idx != null){
	$where .= ' AND (LI.LINE_TYPE_IDX = '.$line_type_idx.') ';
}

if($use_product_flg != null && $use_product_flg != 'ALL'){
	if($use_product_flg == 'TRUE'){
        $having .= ' HAVING COUNT(OM.IDX) > 0 ';
    }
    else if($use_product_flg == 'FALSE'){
        $having .= ' HAVING COUNT(OM.IDX) = 0 ';
    }
}

/** 정렬 조건 **/
$order = '';
if ($sort_value != null && $sort_type != null) {
	$order = ' LI.'.$sort_value." ".$sort_type." ";
} else {
	$order = ' LI.IDX DESC';
}

$limit_start = (intval($page)-1)*$rows;
$json_result = array(
    'total' => $db->count($table),
    'total_cnt' => $db->count($table),
    'page' => $page
);
$sql = 	'
        SELECT
            LI.IDX                                          AS LINE_IDX,
            LI.LINE_NAME                                    AS LINE_NAME,
            LI.LINE_TYPE_IDX                                AS LINE_TYPE_IDX,
            LT.TYPE_NAME                                    AS TYPE_NAME,
            LI.MEMO                                         AS LINE_MEMO,
            COUNT(OM.IDX)									AS USE_PRODUCT_CNT
        FROM 
            LINE_INFO    	AS LI LEFT JOIN
            ORDERSHEET_MST	AS OM 
        ON
            LI.IDX = OM.LINE_IDX LEFT JOIN
            LINE_TYPE LT
        ON
            LI.LINE_TYPE_IDX = LT.IDX
        WHERE
            '.$where.'
        GROUP BY 
            LI.IDX
        '.$having.'
        ORDER BY 
			'.$order;

if ($rows != null) {
    $sql .= " LIMIT ".$limit_start.",".$rows;
}

$db->query($sql);
foreach($db->fetch() as $data) {
    $json_result['data'][] = array(
        'num'							=>$total_cnt--,
        'line_idx'		                =>intval($data['LINE_IDX']),
        'line_name'				        =>$data['LINE_NAME'],
        'line_type_idx'			        =>$data['LINE_TYPE_IDX'],
        'type_name'			            =>$data['TYPE_NAME'],
        'line_memo'			            =>$data['LINE_MEMO'],
        'use_product_cnt'			    =>$data['USE_PRODUCT_CNT']
    );
}
?>