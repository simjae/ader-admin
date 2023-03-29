<?php
/*
 +=============================================================================
 | 
 | WKLA 삭제
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.11.11
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$wkla_idx_list = $_POST['wkla_idx_list'];
$wkla_name_list = $_POST['wkla_name_list'];
$wkla_memo_list = $_POST['wkla_memo_list'];

$sel_idx        = $_POST['sel_idx'];
$wkla_name      = $_POST['wkla_name'];
$wkla_memo      = $_POST['wkla_memo'];

if($sel_idx != null){
    $line_cnt = $db->count('WKLA_INFO', ' WKLA_NAME = "'.$wkla_name.'" AND IDX != '.$sel_idx.' ');
    if($line_cnt == 0){
        $sql = 	'
            UPDATE
                WKLA_INFO
            SET
                WKLA_NAME   = "'.$wkla_name.'",
                MEMO  = "'.$wkla_memo.'"
            WHERE 
                IDX = '.$sel_idx.'
        ';
        $db->query($sql);
    }
    else{
        $json_result['code'] = 300;
        $json_result['msg'] = '이미 동일 이름의 WKLA가 있습니다.';
        return $json_result;
    }
}
else if(is_array($wkla_idx_list)){
    $db->begin_transaction();
	try {
        if(count($wkla_idx_list) > 0){
            foreach($wkla_idx_list as $key => $value){
                $sql = 	'
                    UPDATE
                        WKLA_INFO
                    SET
                        WKLA_NAME   = "'.$wkla_name_list[$key].'",
                        MEMO  = "'.$wkla_memo_list[$key].'"
                    WHERE 
                        IDX = '.$value.'
                ';
                $db->query($sql);
            }
            $db->commit();
        }
        else{
            $json_result['code'] = 300;
            $json_result['msg'] = '수정가능한 W/K/L/A가 존재하지 않습니다.';
            return $json_result;
        }
    }
    catch(mysqli_sql_exception $exception){
		$db->rollback();
		
		$json_result['code'] = 301;
		$json_result['msg'] = "W/K/L/A 일괄수정작업이 실패했습니다.";
	}
}
?>