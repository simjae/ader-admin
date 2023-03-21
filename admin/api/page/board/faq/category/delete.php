<?php
/*
 +=============================================================================
 | 
 | FAQ 카테고리 삭제
 | -----------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.03.03
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

/** 변수 정리 **/
$category_no       = $_POST['no'];

if($category_no != null){
    $db->begin_transaction();
	
	try {
        $delete_query = "
            UPDATE FAQ_CATEGORY
            SET
                STATUS = 'N'
            WHERE
                IDX = ".$category_no."
            OR
                FATHER_NO = ".$category_no."
        ";
        $db->query($delete_query);

        $delete_faq_query = "
            UPDATE FAQ
            SET
                STATUS = 'N'
            WHERE
                CATEGORY_NO IN (
                        SELECT 
                            IDX
                        FROM 
                            FAQ_CATEGORY
                        WHERE
                            IDX = ".$category_no."
                        OR
                            FATHER_NO = ".$category_no."
            );
        ";
        $db->query($delete_faq_query);
        $db->commit();
    }
    catch(mysqli_sql_exception $exception){
		print_r($exception);
		$db->rollback();
		$json_result['code'] = 301;
        $json_result['msg'] = 'FAQ 카테고리 삭제가 실패했습니다.';
		return $json_result;
	}
}
?>