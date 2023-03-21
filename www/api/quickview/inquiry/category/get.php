<?php
/*
 +=============================================================================
 | 
 | 퀵뷰 - FAQ 카테고리 불러오기 API
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.03.14
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$category_type = $_POST['category_type'];

$country = null;
if (isset($_SESSION['COUNTRY'])) {
	$country = $_SESSION['COUNTRY'];
} else if (isset($_POST['country'])) {
	$country = $_POST['country'];
}

if ($country != null && $category_type != null) {
	if($category_type == 'FAQ'){
		$faq_category_get_sql = "
				SELECT
					IDX,
					TITLE
				FROM 
					FAQ_CATEGORY
				WHERE
					FATHER_NO = 0
				AND
					STATUS = 'Y' 
				AND
					LANG = '".$country."'
				ORDER BY 
					SEQ ASC
		";
		$db->query($faq_category_get_sql);
		foreach($db->fetch() as $data){
			$json_result['data'][] = array(
				'idx'		=> $data['IDX'],
				'title'		=> $data['TITLE']
			);
		}
	}
	
	else if($category_type == 'INQ'){
		$inquiry_category_get_sql = "
				SELECT 
					DISTINCT CODE_VALUE,
					CODE_NAME
				FROM
					CODE_MST
				WHERE
					CODE_TYPE = 'BOARD_CATEGORY'
				AND 
					CODE_VALUE IN ('CAR','OAP','FAD','RAE','AFS','DAE','RST','PIQ','BGP','VUC','OSV')
					
		";
		$db->query($inquiry_category_get_sql);
		foreach($db->fetch() as $data){
			$json_result['data'][] = array(
				'code_value' 	=> $data['CODE_VALUE'],
				'code_name' 	=> $data['CODE_NAME']
			);
		}
	}
}

?>