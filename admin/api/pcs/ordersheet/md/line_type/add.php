<?php
/*
 +=============================================================================
 | 
 | 라인 타입 추가
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
$type_name          = $_POST['type_name'];

if($type_name != null){
    $db->begin_transaction();
    try {
        $insert_query = "
            INSERT INTO LINE_TYPE
            (
                TYPE_NAME
            )
            VALUE(
                '".$type_name."'
            )
        ";
        $db->query($insert_query);

        $db->commit();
    }
    catch(mysqli_sql_exception $exception){
        $json_result['code'] = 301;
        $db->rollback();
        $json_result['msg'] = '라인타입 등록작업이 실패했습니다.';
        return $json_result;
    }
}
else{
    $json_result['code'] = 301;
    $db->rollback();
    $json_result['msg'] = '필수항목값이 존재하지 않습니다.';
    return $json_result;
}
?>