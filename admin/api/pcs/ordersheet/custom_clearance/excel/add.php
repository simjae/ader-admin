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
$clearance_sheet = $_POST['clearance_sheet'];
$sheet_data = json_decode($clearance_sheet, true);
//print_r($sheet_data);
if($sheet_data != null){
    /*
        $val[0]:카테고리 코드,
        $val[1]:카테고리 명,
        $val[2]:HS 코드
    */
    $success_cnt = 0;
    $db->begin_transaction();
    try {
        foreach($sheet_data as $val){
            if($val[0] != null){
                if ($db->count('CUSTOM_CLEARANCE'," CATEGORY_CODE = '".$val[0]."' ") == 0) {
                    $insert_query = "
                        INSERT INTO CUSTOM_CLEARANCE
                        (
                            CATEGORY_CODE,
                            CATEGORY_NAME,
                            HS_CODE
                        )
                        VALUE(
                            '".$val[0]."',
                            '".$val[1]."',
                            '".$val[2]."'
                        )
                    ";
                    $db->query($insert_query);
                    $clearance_idx = $db->last_id();
    
                    if(!empty($clearance_idx)){
                        $success_cnt++;
                    }
                }
                else{
                    $json_result['code'] = 301;
                    $json_result['msg'] = "동일한 카테고리명의 통관정보가 이미 존재합니다.";
                    $db->rollback();
                    return $json_result;
                }
            }
        }
        $db->commit();
        $json_result['data']['success_cnt'] = $success_cnt;
    }
    catch(mysqli_sql_exception $exception){
        $json_result['code'] = 301;
        $db->rollback();
        $json_result['msg'] = '해외통관정보 등록작업이 실패했습니다.';
        return $json_result;
    }
}
else{
    $json_result['code'] = 300;
    $json_result['msg'] = "빈 엑셀시트입니다. 엑셀 파일을 다시 확인해주세요";
    return $json_result;
}
?>