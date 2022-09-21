<?php
$no = intval($no);
$category_no = intval($category_no);

$where = ' STATUS="Y" AND FATHER_NO=? ';
$where_values = array($category_no);

if($language) {
	$where .= ' AND LANGUAGE=? ';
	$where_values[] = strtoupper($language);
}
$json_result['total'] = $db->count($_TABLE['FAQ_CATE'],$where,$where_values);
$db->query('
	SELECT 
		IDX,
		TITLE,
		LANG 
	FROM 
		'.$_TABLE['FAQ_CATE'].' 
	WHERE 
		'.$where.' 
	ORDER BY 
		SEQ,
		IDX',
$where_values);
foreach($db->fetch() as $data) { 
	$json_result['data'][] = array(
		'no'=>intval($data['IDX']),
		'title'=>$data['TITLE'],
		'country'=>$data['LANG']
	);
}

?>