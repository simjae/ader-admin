<?php
$selected = true;
function get_category_node($father_no) {
	global $_TABLE,$selected;
	$db = new db();

	$db->query(' 
		SELECT * 
			FROM '.$_TABLE['SHOP_WARE_CATEGORY'].'
		WHERE 
			FATHER_NO = ? 
		ORDER BY 
			SEQ,IDX
	',array($father_no));
	foreach($db->fetch() as $data) {
		$data['IDX'] = intval($data['IDX']);
		$result[] = array(
			'no'=>$data['IDX'],
			'id'=>$data['NODE'],
			'text'=>$data['TITLE'],
			'reg_date'=>$data['REG_DATE'],
			'state'=>array(
				'opened'=>$selected,
				'selected'=>false
			),
			'children'=>get_category_node($data['IDX'])
		);
	}
	if($selected) $selected = false;
	return $result;
}
$code = null;
$json_result = get_category_node(0);
exit(json_encode($json_result));
?>