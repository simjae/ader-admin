<?PHP

    $tab_num = $_POST['tab_num'];

    $seq = $_REQUEST['seq'];
    $depth = $_REQUEST['depth'];
    $father_id = $_REQUEST['father_id'];
    $id = $_REQUEST['id'];
    $title = $_REQUEST['title'];

    if($tab_num == '01'){
        $table = 'dev.ORDERSHEET_CATEGORY';
    }
    else if($tab_num == '02'){
        $table = 'dev.MD_CATEGORY';
    }
    $where = '';
    $where_values = array();

    $db_sel = new db();
    $db_sel->query(' 
		SELECT IDX 
			FROM '.$table.'
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
            $table,
            $values,
            $where,
            $where_values
    );
?>