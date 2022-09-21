<?PHP

    $seq = $_REQUEST['seq'];
    $depth = $_REQUEST['depth'];
    $father_id = $_REQUEST['father_id'];
    $id = $_REQUEST['id'];
    $title = $_REQUEST['title'];

    $where = '';
    $where_values = array();

    $db_sel = new db();
    $db_sel->query(' 
		SELECT IDX 
			FROM dev.MD_CATEGORY
		WHERE 
			NODE = ?
	',array($father_id));
	foreach($db_sel->fetch() as $data) {
		$father_no = intval($data['IDX']);
	}

    $values = array(
        'SEQ'=>$seq,
        'DEPTH'=>$depth,
        'FATHER_NO'=>$father_no,
        'NODE'=>$id,
        'TITLE'=>$title
    );
    $db->insert(
            'dev.MD_CATEGORY',
            $values,
            $where,
            $where_values
    );
?>