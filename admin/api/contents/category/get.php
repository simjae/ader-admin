<?php
$where = ' 1=1 ';

if(isset($father_no) && is_numeric($father_no)) {
	$where .= ' AND FATHER_NO = ? ';
	$where_values[] = $father_no;
}

$db->query('
	SELECT
			*
		FROM '.$_TABLE['CAT'].' 
	WHERE
		'.$where.'
	ORDER BY
		SEQ,IDX
',$where_values);
foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'no'=>intval($data['IDX']),
		'title'=>$data['TITLE'],
		'status'=>($data['STATUS']=='Y')?true:false
	);
}

?>