<?php
/*
 +=============================================================================
 | 
 | 상자 목록
 | -------
 |
 | 최초 작성	: 양한빈
 | 최초 작성일	: 2017.05.12
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$tables = $_TABLE['SHOP_DELIVERY_BOX'];
$where = '1=1';
if(is_numeric($no)) {
	$where .= ' AND IDX=? ';
	$where_values[] = $no;
}
$json_result['total'] = $db->count($tables);
$db->query('
	SELECT 
			* 
		FROM '.$tables.'
	WHERE 
		'.$where.'
	ORDER BY 
		IDX
',$where_values);
foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'no'=>intval($data['IDX']),
		'name'=>$data['NAME'],
		'weight'=>intval($data['WEIGHT']),
		'size_w'=>intval($data['SIZE_W']),
		'size_h'=>intval($data['SIZE_H']),
		'size_d'=>intval($data['SIZE_D']),
		'cost'=>intval($data['COST']),
		'next_box_no'=>intval($data['NEXT_BOX_IDX']),
		'next_box_count'=>intval($data['NEXT_COUNT']),
		'status'=>($data['STATUS_YN']=='Y')?true:false,
		'reg_date'=>$data['REG_DATE']
	);
}
?>