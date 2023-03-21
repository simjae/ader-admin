<?php
/*
 +=============================================================================
 | 
 | FAQ 카테고리 취득 api
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.01.09
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$country = null;
if(isset($_POST['country'])){
	$country = $_POST['country'];
}

if ($country == "" || $country == null) {
	$json_result['code'] = 300;
	$json_result['msg'] = 'FAQ정보 불러오기에 실패했습니다.';
	
	return $json_result;
}
else{
	$json_result['data'] = get_category_node(0,$country,$db);
}

function get_category_node($father_no, $country, $db) {
    $result = array();
	
	$select_category_sql = "
		SELECT
			FC.IDX			AS FC_IDX,
			FC.SEQ			AS SEQ,
			FC.FATHER_NO	AS FATHER_NO,
			FC.LANG			AS LANG,
			FC.SUBTITLE		AS SUBTITLE,
			FC.TITLE		AS TITLE,
			FC.STATUS		AS STATUS,
			FC.REG_DATE		AS REG_DATE
		FROM
			FAQ_CATEGORY FC
		WHERE
			FATHER_NO = ".$father_no." AND
			LANG = '".$country."'
		ORDER BY
			SEQ, IDX ASC
	";
	
	$db->query($select_category_sql);

	foreach($db->fetch() as $data) {
		$no = intval($data['FC_IDX']);
		
		$result[] = array(
			'no'			=>$no,
			'title'			=>$data['TITLE'],
			'reg_date'		=>$data['REG_DATE'],
			'children'		=>get_category_node($no, $country, $db)
		);
	}
	
    return $result;
}

?>