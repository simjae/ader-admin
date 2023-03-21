<?php
/*
 +=============================================================================
 | 
 | 퀵뷰 - FAQ 리스트 가져오기 API
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
$category_no = $_POST['category_no'];

$country = null;
if (isset($_SESSION['COUNTRY'])) {
	$country = $_SESSION['COUNTRY'];
} else if (isset($_POST['country'])) {
	$country = $_POST['country'];
}

if ($country != null && $category_no != null) {
	$get_faq_sql = "
		SELECT
			IDX,
			SUBCATEGORY
		FROM
			FAQ
		WHERE
			(CATEGORY_NO = ".$category_no." OR
             CATEGORY_NO IN (SELECT
                                IDX
                            FROM
                                FAQ_CATEGORY
                            WHERE 
                                FATHER_NO = ".$category_no.")
            )
        AND
            STATUS = 'Y'
	";
	$db->query($get_faq_sql);
	foreach($db->fetch() as $data){
		$json_result['data'][] = array(
			'idx'	            => $data['IDX'],
			'subcategory'		=> $data['SUBCATEGORY']
		);
	}
}

?>