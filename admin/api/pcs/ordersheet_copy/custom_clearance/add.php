<?php
/*
 +=============================================================================
 | 
 | 해외통관정보 추가
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.02.24
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$category_code          = $_POST['category_code'];
$category_name          = $_POST['category_name'];
$hs_code                = $_POST['hs_code'];


if($category_code != null && $category_name != null && $hs_code != null){
    $db->begin_transaction();
    try {
        $insert_clearance_query = "
            INSERT INTO
				CUSTOM_CLEARANCE
            (
                CATEGORY_CODE,
                CATEGORY_NAME,
                HS_CODE
            ) VALUE (
                '".$category_code."',
                '".$category_name."',
                '".$hs_code."'
            )
        ";
		
        $db->query($insert_clearance_query);

        $db->commit();
    }
    catch(mysqli_sql_exception $exception){
        $json_result['code'] = 301;
        $db->rollback();
        $json_result['msg'] = '해외통관정보 등록작업이 실패했습니다.';
        return $json_result;
    }
}
?>