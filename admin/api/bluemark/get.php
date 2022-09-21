<?php
/** 변수 정리 **/
$serialcode = trim($serialcode);
$barcode = trim($barcode);
$createdate_s = trim($createdate_s);
$createdate_e = trim($createdate_e);
$certify = strtoupper(trim($certify));
$id = trim($id);
$name = trim($name);
$tel = trim($tel);
$email = trim($email);
$confirmdate_s = trim($confirmdate_s);
$confirmdate_e = trim($confirmdate_e);

$tables = '
	'.$_TABLE['BLUEMARK'].' AS A 
	LEFT JOIN '.$_TABLE['MEMBER'].' AS B ON A.ID = B.ID 
';

/** 검색 조건 **/
$where = '1=1';
if($serialcode != '') {
	$where .= ' AND A.SERIAL_CODE LIKE ? ';
	$where_values[] = '%'.$serialcode.'%';
}
if($barcode != '') {
	$where .= ' AND A.BARCODE LIKE ? ';
	$where_values[] = '%'.$barcode.'%';
}
if($season != '') {
	$where .= ' AND A.SEASON = ? ';
	$where_values[] = $season;
}
if($createdate_s != '') {
	$where .= ' AND A.CREATE_DATE >= ? ';
	$where_values[] = $createdate_s.' 00:00:00';
}
if($createdate_e != '') {
	$where .= ' AND A.CREATE_DATE <= ? ';
	$where_values[] = $createdate_e.' 23:59:59';
}
if($certify == 'CONFIRM') {
	$where .= ' AND A.STATUS = ? ';
	$where_values[] = $certify;
}
if($id != '') {
	$where .= ' AND A.ID LIKE ? ';
	$where_values[] = '%'.$id.'%';
}
if($name != '') {
	$where .= ' AND A.NAME LIKE ? ';
	$where_values[] = '%'.$name.'%';
}
if($tel != '') {
	$where .= ' AND A.MOBILE LIKE ? ';
	$where_values[] = '%'.$tel;
}
if($email != '') {
	$where .= ' AND A.EMAIL LIKE ? ';
	$where_values[] = '%'.$email.'%';
}
if($confirmdate_s != '') {
	$where .= ' AND A.CONFIRM_DATE >= ? ';
	$where_values[] = $confirmdate_s.' 00:00:00';
}
if($confirmdate_e != '') {
	$where .= ' AND A.CONFIRM_DATE <= ? ';
	$where_values[] = $confirmdate_e.' 23:59:59';
}

$json_result = array(
	'total' => $db->count($tables,$where,$where_values),
	'page' => intval($page),
	'pagenum' => $pagenum
);
$db->query('
	SELECT 
			A.* 
		FROM '.$tables.'
	WHERE
		'.$where.' 
	ORDER BY 
		A.IDX DESC 
	LIMIT '.(($page-1)*$pagenum).','.$pagenum.'
',$where_values);
foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'no'=>intval($data['IDX']),
		'serial_code'=>$data['SERIAL_CODE'],
		'barcode'=>$data['BARCODE'],
		'season'=>$data['SEASON'],
		'status'=>strtolower($data['STATUS']),
		'create_date'=>$data['CREATE_DATE'],
		'confirm_date'=>$data['CONFIRM_DATE'],
		'id'=>$data['ID'],
		'name'=>$data['NAME'],
		'mobile'=>$data['MOBILE'],
		'email'=>$data['EMAIL']
	);
}
?>