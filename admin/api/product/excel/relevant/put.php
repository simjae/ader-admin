<?php
/*
 +=============================================================================
 | 
 | 상품관리 : 엑셀-관련상품 등록
 | ----------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.02.09
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
include_once("/var/www/admin/api/common/common.php");
$session_id		= sessionCheck();
/** 변수 정리 **/
$sheet_str = $_POST['sheet_data'];
$sheet_data = json_decode($sheet_str, true);
$relevant_sheet   = $sheet_data['relevant_sheet'];

date_default_timezone_set('Asia/Seoul');

if($relevant_sheet != null && count($relevant_sheet) != 0){
    $db->begin_transaction();
    try {
        foreach($relevant_sheet as $key=>$relevant_val){
            //$val[0] : 상품 코드
            //$val[0] : 관련 상품 코드
            
            $relevant_val[0] = trim($relevant_val[0]);
            $relevant_val[1] = trim($relevant_val[1]);
    
            if($relevant_val[0] != null && $relevant_val[1] != null){
                $product_code_cnt = $db->count("SHOP_PRODUCT"," PRODUCT_CODE='".$relevant_val[0]."'");
            
                if($product_code_cnt > 0 ){
                    $relevant_code_arr = array();
                    $relevant_idx_arr = array();
                    $relevant_code_arr = array_map('makeVarchar',explode(',',$relevant_val[1]));

                    $db->query("
                        SELECT 
                            IDX 
                        FROM 
                            SHOP_PRODUCT 
                        WHERE 
                            PRODUCT_CODE IN (".implode(',',$relevant_code_arr).")");

                    foreach($db->fetch() as $data){
                        array_push($relevant_idx_arr, $data['IDX']);
                    }

                    if(count($relevant_idx_arr) > 0){
                        $sql = "
                            UPDATE 
                                SHOP_PRODUCT 
                            SET
                                RELEVANT_IDX = '".implode(',', $relevant_idx_arr)."',
                                UPDATER = '".$session_id."',
                                UPDATE_DATE = NOW()
                            WHERE
                                PRODUCT_CODE = '".$relevant_val[0]."'
                        ";
            
                        $db->query($sql);
                        $success_cnt++;
                    }
                    else{
                        $json_result['code'] = 301;
                        $db->rollback();
                        $json_result['msg'] = '기입한 관련상품 코드가 유효하지 않습니다.';
                        return $json_result;
                    }
                }
                else{
                    $json_result['code'] = 301;
                    $db->rollback();
                    $json_result['msg'] = '기입한 상품코드가 유효하지 않습니다.';
                    return $json_result;
                }
            }
        }
        $json_result['data']['success'] = $success_cnt;
        $db->commit();
    }
    catch(mysqli_sql_exception $exception){
        $json_result['code'] = 301;
        $db->rollback();
        $json_result['msg'] = '관련상품 등록작업이 실패했습니다.';
        return $json_result;
    }
}
else{
    $json_result['code']    = 301;
    $json_result['msg']     = '빈 시트입니다. 파일을 다시 확인해주세요';
    return $json_result;
}
function makeVarchar($item){
    $item = "'".$item."'";
    return $item;
}
?>