<?php
/*
 +=============================================================================
 | 
 | 라인타입 수정
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
$line_type_idx_list      = $_POST['line_type_idx_list'];
$line_name_list     = $_POST['type_name_list'];

$sel_idx            = $_POST['sel_idx'];
$type_name          = $_POST['type_name'];

if($sel_idx != null){
    if($type_name != null){
        $update_sql = "
            UPDATE LINE_TYPE
            SET
                TYPE_NAME = '".$type_name."'
            WHERE
                IDX = ".$sel_idx."
        ";

        $db->query($update_sql);
    }
    else{
        $code = 301;
        $msg = '필수항목은 반드시 기재해야 합니다.';
    }
}
else if(is_array($line_type_idx_list)){
    $db->begin_transaction();
	try {
        if(count($line_type_idx_list) > 0){
            foreach($line_type_idx_list as $key => $value){
                $sql = 	'
                    UPDATE
                        LINE_TYPE
                    SET
                        TYPE_NAME   = "'.$type_name_list[$key].'"
                    WHERE 
                        IDX = '.$value.'
                ';
                $db->query($sql);
            }
            $db->commit();
        }
        else{
            $json_result['code'] = 300;
            $json_result['msg'] = '수정가능한 라인타입이 존재하지 않습니다.';
            return $json_result;
        }
    }
    catch(mysqli_sql_exception $exception){
		$db->rollback();
		
		$json_result['code'] = 301;
		$json_result['msg'] = "라인타입 일괄수정작업이 실패했습니다.";
	}
}

?>