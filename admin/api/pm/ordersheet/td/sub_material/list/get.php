<?php
/*
 +=============================================================================
 | 
 | 부자재 정보 리스트
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
$sub_material_type 	= $_POST['sub_material_type'];		//부자재 타입
$sub_material_name 	= $_POST['sub_material_name'];	    //부자재 명
$use_product_flg 	= $_POST['use_product_flg'];		//사용중인 상품여부 플래그

$sort_type 			= $_POST['sort_type'];				//정렬 타입
$sort_value 		= $_POST['sort_value'];				//정렬 값

$rows = $_POST['rows'];
$page = $_POST['page'];
    
$table = "dev.SUB_MATERIAL_INFO SMI";
$where = '1=1';
$having = '';

if($sub_material_type != null && $sub_material_type != 'ALL'){
	$where .= ' AND (SMI.SUB_MATERIAL_TYPE = "'.$sub_material_type.'") ';
}

$total_where = $where;

if($sub_material_name != null){
	$where .= ' AND (SMI.SUB_MATERIAL_NAME LIKE "%'.$sub_material_name.'%") ';
}

/** 정렬 조건 **/
$order = '';
if ($sort_value != null && $sort_type != null) {
	$order = ' SMI.'.$sort_value." ".$sort_type." ";
} else {
	$order = ' SMI.IDX DESC';
}

$limit_start = (intval($page)-1)*$rows;
$json_result = array(
    'total' => $db->count($table,$total_where),
    'total_cnt' => $db->count($table,$where),
    'page' => $page
);
$sql = 	'SELECT
            SMI.IDX                                             AS SUB_MATERIAL_IDX,
            SMI.SUB_MATERIAL_NAME                               AS SUB_MATERIAL_NAME,
            SMI.SUB_MATERIAL_TYPE                               AS SUB_MATERIAL_TYPE,
            SMI.MEMO                                            AS SUB_MATERIAL_MEMO
        FROM 
            dev.SUB_MATERIAL_INFO    	AS SMI
        WHERE
            '.$where.'
        GROUP BY 
            SMI.IDX
        ORDER BY 
			'.$order;
if ($rows != null) {
    $sql .= " LIMIT ".$limit_start.",".$rows;
}

$db->query($sql);
foreach($db->fetch() as $data) {
    $json_result['data'][] = array(
        'num'							=>$total_cnt--,
        'sub_material_idx'		        =>intval($data['SUB_MATERIAL_IDX']),
        'sub_material_name'				=>$data['SUB_MATERIAL_NAME'],
        'sub_material_type'             =>$data['SUB_MATERIAL_TYPE'],
        'sub_material_memo'			    =>$data['SUB_MATERIAL_MEMO']
    );
}
?>