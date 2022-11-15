<?php

$depth = $_REQUEST['depth'];
$father_no = $_REQUEST['no'];

$where = '1=1';
if($depth != null) {
	$where .= ' AND DEPTH = '.$depth.'';
}
if($father_no != null) {
	$where .= ' AND FATHER_NO = '.$father_no.'';
}
$db->query('
	SELECT 
		IDX,
		NODE,
		TITLE
	FROM 
        dev.ORDERSHEET_CATEGORY
	WHERE 
		'.$where);

foreach($db->fetch() as $data) {
    $json_result['data'][] = array(
        'no'=>intval($data['IDX']),
        'id'=>$data['NODE'],
        'text'=>$data['TITLE']
    );
}
?>