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

$relevant_info = array();
$relevant_true = array();
$relevant_false = array();

date_default_timezone_set('Asia/Seoul');

if($relevant_sheet != null && count($relevant_sheet) != 0){
    $excel_start_row = 2;
    $success_cnt = 0;
    $db->begin_transaction();
    try {
        foreach($relevant_sheet as $key=>$relevant_val){
            //$val[0] : 상품 코드
            //$val[0] : 관련 상품 코드
            
            $relevant_val[0] = trim($relevant_val[0]);
            $relevant_val[1] = trim($relevant_val[1]);
    
            if($relevant_val[0] != null && $relevant_val[1] != null){
           // $json_result['data_cnt'] = count($related_product_sheet);
                $product_code_cnt = $db->count("SHOP_PRODUCT"," PRODUCT_CODE='".$relevant_val[0]."'");
            
                if($product_code_cnt > 0 ){
                    //있음
                    $new_relevant_idx = null;
    
                    $db->query("
                        SELECT 
                            IDX 
                        FROM 
                            SHOP_PRODUCT 
                        WHERE 
                            PRODUCT_CODE = '".$relevant_val[1]."'");
                    foreach($db->fetch() as $data){
                        $new_relevant_idx = $data['IDX'];
                    }
                    if($new_relevant_idx != null){
                        //처음
                        if(!isset($relevant_info[$relevant_val[0]])){
                            $relevant_info[$relevant_val[0]] = $new_relevant_idx;
                        }
                        //처음아님
                        else{
                            $relevant_info[$relevant_val[0]] .= ",".$new_relevant_idx;
                        }
                    }
                }
            }
        }
        foreach($relevant_info as $array_key=>$array_val){
            $sql = "
                UPDATE 
                    SHOP_PRODUCT 
                SET
                    RELEVANT_IDX = '".$array_val."',
                    UPDATER = '".$session_id."',
                    UPDATE_DATE = NOW()
                WHERE
                    PRODUCT_CODE = '".$array_key."'
            ";

            $db->query($sql);
            $success_cnt++;
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


?>