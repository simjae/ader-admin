<?php
$selected = true;
$tab_num = $_POST['tab_num'];

if($tab_num != null){
	$code = null;
	$json_result = get_category_node(0, $tab_num);
	exit(json_encode($json_result));
}
else{
	$code = 300;
	$msg = '카테고리 정보 불러오기에 실패 했습니다.';
	exit(json_encode($json_result));
}

function get_category_node($father_no, $num_str) {
	global $_TABLE,$selected;

	$table = '';
	if($num_str == '01'){
		$table = 'dev.ORDERSHEET_CATEGORY';
	}
	else{
		$table = 'dev.MD_CATEGORY';
	}
	$db = new db();
	$db->query(' 
		SELECT * 
			FROM '.$table.'
		WHERE 
			FATHER_NO = ? 
		ORDER BY 
			SEQ,IDX
	',array($father_no));
	foreach($db->fetch() as $data) {
		$no = intval($data['IDX']);
		$result[] = array(
			'no'=>$no,
			'id'=>$data['NODE'],
			'text'=>$data['TITLE'],
			'reg_date'=>$data['CREATE_DATE'],
			'description'=>$data['DESCRIPTION'],
			'state'=>array(
				'opened'=>($no==1)?true:false,
				'selected'=>($no==1)?true:false
			),
			'children'=>get_category_node($no, $num_str)
		);
	}
	if($selected) $selected = false;
	return $result;
}


?>