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

if($country != null){
	$json_result['data'] = get_category_node(0 , $country, $db);
}
else{
	$json_result['code'] = 300;
	$json_result['msg'] = 'FAQ 카테고리 취득 API를 실행할 수 없습니다.';
}

function get_category_node($father_no, $country, $db) {
    $result = array();
	$db->query(' 
		SELECT 
            * 
		FROM 
            dev.FAQ_CATEGORY
		WHERE 
			FATHER_NO = '.$father_no.'
        AND
            LANG = "'.$country.'"
		ORDER BY 
			SEQ,IDX
	');

	foreach($db->fetch() as $data) {
		$no = intval($data['IDX']);
		$result[] = array(
			'no'=>$no,
			'title'=>$data['TITLE'],
			'reg_date'=>$data['REG_DATE'],
			'children'=>get_category_node($no, $country, $db)
		);
	}
	
    return $result;
}


?>