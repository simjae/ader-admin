<?php
$tab_num		= $_POST['tab_num'];

$action_type 	= $_REQUEST['action_type']; 
$father_id 		= $_REQUEST['father_id'];
$node 			= $_REQUEST['id'];
$node_arr 		= $_REQUEST['id_list'];
$title 			= $_REQUEST['title'];
$desc 			= $_REQUEST['desc'];
$depth 			= $_REQUEST['depth'];
$seq 			= $_REQUEST['seq'];

if($tab_num == '01'){
	$table = 'ORDERSHEET_CATEGORY';
}
else if($tab_num == '02'){
	$table = 'MD_CATEGORY';
}

$node_list = '';
if ($node_arr != null) {
	foreach($node_arr as $data) {
		$node_list .= "'".$data."',";
	}
	$node_list = rtrim($node_list, ",");
}

if($action_type != null){
	switch($action_type){
		case 'delete':
			$sql = "
				DELETE FROM 
					".$table." 
				WHERE 
					NODE IN (".$node_list.")
			";
			break;
		case 'rename':
			$sql = "
				UPDATE 
					".$table."
				SET 
					TITLE = '".$title."' 
				WHERE 
					NODE = '".$node."'
			";
			break;
		case 'move_save':
			if($father_id == '#'){
				$father_no = 0;    
			}
			else{
				$db_sel = new db();
				$db_sel->query("
					SELECT 
						IDX 
					FROM 
						".$table."
					WHERE 
						NODE = '".$father_id."'
				");
				foreach($db_sel->fetch() as $data) {
					$father_no = intval($data['IDX']);
				}
			}
			$sql = "
					UPDATE 
					".$table."
				SET 
					FATHER_NO 	= ".$father_no.",
					SEQ 		= ".$seq.",
					DEPTH 		= ".$depth."
				WHERE 
					NODE = '".$node."'
			";
			break;
		case 'info_update':
			$sql = "
				UPDATE 
					".$table."
				SET 
					TITLE 		= '".$title."', 
					DESCRIPTION = '".$desc."' 
				WHERE 
					NODE = '".$node."'
			";
			break;
	}
	$db->query($sql);
}
else{
	$code = 500;
}
?>