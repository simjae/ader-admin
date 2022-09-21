<?php
$store_no = intval($store_no);
$client_no = intval($client_no);

$where = ' 1=1 ';
if($client_no > 0) {
	$where .= ' AND A.STORE_NO IN (SELECT IDX FROM '.$_TABLE['STORE'].' WHERE CLIENT_NO=? ) ';
	$where_value[] = $client_no;
}
if($store_no > 0) {
	$where .= ' AND A.STORE_NO=?';
	$where_value[] = $store_no;
}
if($template_no > 0) {
	$where .= ' AND A.IDX=?';
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


$json_result['page'] = $page;
$json_result['total'] = $db->count($_TABLE['BIZTALK_DEF'],$where,$where_value);
$where_value[] = ($page-1)*$pagenum;
$where_value[] = $pagenum;
$db->query('
	SELECT 
			*
		FROM '.$_TABLE['BIZTALK_DEF'].' 
	WHERE 
		'.$where.' 
	ORDER BY 
		IDX DESC 
	LIMIT ?,?
',$where_value);
foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'no'=>intval($data['IDX']),
		'category'=>$data['CATEGORY'],
		'title'=>$data['TEMPLETE'],
		'status'=>($data['STATUS']=='성공')?true:false
	);
}

?>