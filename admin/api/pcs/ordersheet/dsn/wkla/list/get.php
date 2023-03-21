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
$wkla_name 			= $_POST['wkla_name'];				//WKLA 명
$use_product_flg 	= $_POST['use_product_flg'];		//사용중인 상품여부 플래그

$sort_type 			= $_POST['sort_type'];				//정렬 타입
$sort_value 		= $_POST['sort_value'];				//정렬 값

$rows = $_POST['rows'];
$page = $_POST['page'];
    
$table = "WKLA_INFO";
$where = '1=1';
$having = '';

if($wkla_name != null){
	$where .= ' AND (WKLA.WKLA_NAME LIKE "%'.$wkla_name.'%") ';
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
	$order = ' WKLA.'.$sort_value." ".$sort_type." ";
} else {
	$order = ' WKLA.IDX DESC';
}

$limit_start = (intval($page)-1)*$rows;
$json_result = array(
    'total' => $db->count($table),
    'total_cnt' => $db->count($table),
    'page' => $page
);
$sql = 	'SELECT
            WKLA.IDX                                            AS WKLA_IDX,
            WKLA.WKLA_NAME                                      AS WKLA_NAME,
            WKLA.MEMO                                           AS WKLA_MEMO,
            (SELECT     
                COUNT(0)        
            FROM
                ORDERSHEET_MST
            WHERE
                WKLA_IDX = WKLA.IDX)                                AS USE_PRODUCT_CNT
        FROM 
            WKLA_INFO    AS WKLA
        ORDER BY 
            WKLA.IDX DESC
';

$sql = 	'
        SELECT
            WKLA.IDX                                        AS WKLA_IDX,
            WKLA.WKLA_NAME                                  AS WKLA_NAME,
            WKLA.MEMO                                       AS WKLA_MEMO,
            COUNT(OM.IDX)									AS USE_PRODUCT_CNT
        FROM 
            WKLA_INFO    	AS WKLA LEFT JOIN
            ORDERSHEET_MST	AS OM 
        ON
            WKLA.IDX = OM.WKLA_IDX
        WHERE
            '.$where.'
        GROUP BY 
            WKLA.IDX
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
        'wkla_idx'		                =>intval($data['WKLA_IDX']),
        'wkla_name'				        =>$data['WKLA_NAME'],
        'wkla_memo'			            =>$data['WKLA_MEMO'],
        'use_product_cnt'			    =>$data['USE_PRODUCT_CNT']
    );
}
?>