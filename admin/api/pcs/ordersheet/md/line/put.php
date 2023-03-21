<?php
/*
 +=============================================================================
 | 
 | 라인수정
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.10.12
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$line_idx_list  = $_POST['line_idx_list'];
$line_name_list = $_POST['line_name_list'];
$line_memo_list = $_POST['line_memo_list'];

$sel_idx        = $_POST['sel_idx'];
$line_name      = $_POST['line_name'];
$line_type      = $_POST['line_type'];
$line_memo      = $_POST['line_memo'];

if($sel_idx != null){
    $line_cnt = $db->count('LINE_INFO', ' LINE_NAME = "'.$line_name.'" AND IDX != '.$sel_idx.' ');
    if($line_cnt == 0){
        $sql = 	'
            UPDATE
                LINE_INFO
            SET
                LINE_NAME   = "'.$line_name.'",
                MEMO  = "'.$line_memo.'"
            WHERE 
                IDX = '.$sel_idx.'
        ';
        $db->query($sql);
    }
    else{
        $json_result['code'] = 300;
        $json_result['msg'] = '이미 동일 이름의 라인이 있습니다.';
        return $json_result;
    }
}
else if(is_array($line_idx_list)){
    $db->begin_transaction();
	try {
        if(count($line_idx_list) > 0){
            foreach($line_idx_list as $key => $value){
                $sql = 	'
                    UPDATE
                        LINE_INFO
                    SET
                        LINE_NAME   = "'.$line_name_list[$key].'",
                        MEMO  = "'.$line_memo_list[$key].'"
                    WHERE 
                        IDX = '.$value.'
                ';
                $db->query($sql);
            }
            $db->commit();
        }
        else{
            $json_result['code'] = 300;
            $json_result['msg'] = '수정가능한 라인이 존재하지 않습니다.';
            return $json_result;
        }
    }
    catch(mysqli_sql_exception $exception){
		$db->rollback();
		
		$json_result['code'] = 301;
		$json_result['msg'] = "라인 일괄수정작업이 실패했습니다.";
	}
}
?>