<?php
$num = 0;
$where = '1=1';
if(is_numeric($cat)) $where .= ' AND CATEGORY='.$cat;
if(is_numeric($no)) $where .= ' AND IDX="'.$no.'"';
$query = '
	SELECT * 
		FROM '.$_TABLE['SITE_FAQ'].'
	WHERE 
		'.$where.'
	ORDER BY 
		SEQ,IDX
';
$sql = db_query($query);
$json_result['total'] = db_count($_TABLE['SITE_FAQ'],$where);
while($data = db_array($sql)) {
	$no = intval($data['IDX']);
	$cat = intval($data['CATEGORY']);
	$question = $data['QUESTION'];
	$answer = $data['ANSWER'];
	
	$json_result['data'][$num++] = array(
		'no'=>$no,
		'category'=>$cat,
		'question'=>$question,
		'answer'=>$answer
	);
}



?>