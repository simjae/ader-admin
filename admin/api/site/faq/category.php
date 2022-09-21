<?php
$num = 0;
if(is_numeric($no)) {
	$category = intval(db_get($_TABLE['SITE_FAQ'],'CATEGORY','IDX='.$no));
}
else {
	$category_select = true;
}
$query = 'SELECT IDX,TITLE FROM '.$_TABLE['SITE_FAQ_CATE'].' ORDER BY SEQ,IDX';
$sql = db_query($query);
while($data = db_array($sql)) { 
	$no = intval($data['IDX']);
	$title = $data['TITLE'];
	if(is_numeric($no) && $no == $category) $category_select = true;

	$json_result['data'][$num++] = array(
		'no'=>$no,
		'title'=>$title,
		'is_select'=>$category_select
	);
	if($category_select==true) $category_select=false;
}

?>