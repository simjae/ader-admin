<?php
$tel = trim($tel);
$store_no = intval($store_no);
$client_no = intval($client_no);
$template_no = intval($template_no);

$where = ' 1=1 ';
if(is_numeric($tel) && $tel != '') {
	$where .= ' AND A.TEL LIKE ? ';
	$where_value[] = '%'.$tel;
}
if($template_no > 0) {
	$where .= ' AND A.BIZTALK_NO=?';
	$where_value[] = $template_no;
}
if(in_array($status,array('y','n'))) {
	$where .= ' AND A.STATUS = ?';
	$where_value[] = ($status=='y')?'성공':'실패';
}
if($date_s != '') {
	$where .= ' AND A.INPUT_DATE >= ? ';
	$where_value[] = $s_date_s.' 00:00:00';
}
if($date_e != '') {
	$where .= ' AND A.INPUT_DATE <= ? ';
	$where_value[] = $s_date_e.' 23:59:59';
}
if($contents != '') {
	$where .= ' AND A.CONTENTS LIKE ? ';
	$where_value[] = '%'.$contents.'%';
}
$tables = '
	'.$_TABLE['BIZTALK_LOG'].' AS A 
	LEFT JOIN '.$_TABLE['BIZTALK_DEF'].' AS C ON A.BIZTALK_NO = C.IDX
';
$json_result = array(
	'total' => $db->count($tables,$where,$where_values),
	'page' => $page,
	'pagenum' => $pagenum
);
$where_values[] = ($page-1)*$pagenum;
$where_values[] = $pagenum;
$db->query('
	SELECT 
			A.*,
			C.TEMPLETE 
		FROM '.$tables.' 
	WHERE 
		'.$where.' 
	ORDER BY 
		A.IDX DESC 
	LIMIT 
		?,?
',$where_values);
foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'no'=>intval($data['IDX']),
		'template'=>$data['TEMPLETE'],
		'contents'=>$data['CONTENTS'],
		'response'=>$data['RESPONSE_REMARK'],
		'reg_date'=>$data['INPUT_DATE'],
		'status'=>($data['STATUS']=='성공')?true:false
	);
}

?>