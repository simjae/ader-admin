<?php
/*
 +=============================================================================
 | 
 | 상품관리 : 엑셀-부자재 등록
 | ----------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.02.15
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

/** 변수 정리 **/
$sheet_str						= $_POST['sheet_data'];
$sheet_data						= json_decode($sheet_str, true);
$td_sub_material_sheet			= $sheet_data['td_sub_material_sheet'];
$delivery_sub_material_sheet	= $sheet_data['delivery_sub_material_sheet'];

$insert_column_arr = array();

$td_sub_material_true = array();     
$td_sub_material_false = array();

$delivery_sub_material_true = array();     
$delivery_sub_material_false = array();    

date_default_timezone_set('Asia/Seoul');

$db->begin_transaction();
try {
    if($td_sub_material_sheet != NULL && count($td_sub_material_sheet) != 0) {
        $excel_start_row = 2;
        $td_success_cnt = 0;
        
        foreach ($td_sub_material_sheet as $key => $val) {
            /*
            0~5 : box coloum
            $val[0] :     SUB_MATERIAL_SORT
            $val[1] :     SUB_MATERIAL_NAME
            $val[2] :     SUB_MATERIAL_CODE
            $val[3] :     MEMO
            $val[4] :     COMPANY_NAME
            $val[5] :     COMPANY_CHARGE
            $val[6] :     COMPANY_TEL
            $val[7] :     COMPANY_ADDR
            */
            
            $sub_material_code = NULL;
            $sub_material_code = $val[2];
    
            $exist_sub_material_cnt = -1;
            if($sub_material_code != NULL){
                $exist_sub_material_cnt = $db->count('SUB_MATERIAL_INFO', 'SUB_MATERIAL_CODE = "'.$sub_material_code.'" ');
            }
        
            //insert
            if($exist_sub_material_cnt == 0){
    
                $sub_material_sort = NULL;
                $sub_material_sort_arr = array();
                $sub_material_sort = $val[0];
                if($sub_material_sort != NULL){
                    $sub_material_sort_arr[0] = ' SUB_MATERIAL_SORT, ';
                    $sub_material_sort_arr[1] = ' "'.$sub_material_sort.'", ';
                }
    
                $sub_material_name = NULL;
                $sub_material_name_arr = array();
                $sub_material_name = $val[1];
                if($sub_material_name != NULL){
                    $sub_material_name_arr[0] = ' SUB_MATERIAL_NAME, ';
                    $sub_material_name_arr[1] = ' "'.$sub_material_name.'", ';
                }
    
                $memo = NULL;
                $memo_arr = array();
                $memo = $val[3];
                if($memo != NULL){
                    $memo_arr[0] = ' MEMO, ';
                    $memo_arr[1] = ' "'.$memo.'", ';
                }
    
                $company_name = NULL;
                $company_name_arr = array();
                $company_name = $val[4];
                if($company_name != NULL){
                    $company_name_arr[0] = ' COMPANY_NAME, ';
                    $company_name_arr[1] = ' "'.$company_name.'", ';
                }
    
                $company_charge = NULL;
                $company_charge_arr = array();
                $company_charge = $val[5];
                if($company_charge != NULL){
                    $company_charge_arr[0] = ' COMPANY_CHARGE, ';
                    $company_charge_arr[1] = ' "'.$company_charge.'", ';
                }
    
                $company_tel = NULL;
                $company_tel_arr = array();
                $company_tel = $val[3];
                if($company_tel != NULL){
                    $company_tel_arr[0] = ' COMPANY_TEL, ';
                    $company_tel_arr[1] = ' "'.$company_tel.'", ';
                }
    
                $company_addr = NULL;
                $company_addr_arr = array();
                $company_addr = $val[3];
                if($company_addr != NULL){
                    $company_addr_arr[0] = ' COMPANY_ADDR, ';
                    $company_addr_arr[1] = ' "'.$company_addr.'", ';
                }
    
                $regist_sub_material_sql = "
                    INSERT INTO
						SUB_MATERIAL_INFO
                    (
                        ".$sub_material_sort_arr[0]."
                        ".$sub_material_name_arr[0]."
                        ".$memo_arr[0]."
                        ".$company_name_arr[0]."
                        ".$company_charge_arr[0]."
                        ".$company_tel_arr[0]."
                        ".$company_addr_arr[0]."
                        SUB_MATERIAL_TYPE,
                        SUB_MATERIAL_CODE
                    ) VALUES (
                        ".$sub_material_sort_arr[1]."
                        ".$sub_material_name_arr[1]."
                        ".$memo_arr[1]."
                        ".$company_name_arr[1]."
                        ".$company_charge_arr[1]."
                        ".$company_tel_arr[1]."
                        ".$company_addr_arr[1]."
                        'T',
                        '".$sub_material_code."'
                    )
                ";
                $db->query($regist_sub_material_sql);
    
                $sub_material_idx = NULL;
                $sub_material_idx = $db->last_id();
    
                //오더시트 등록 실패시 롤백
                if(empty($sub_material_idx) || $sub_material_idx == NULL){
                    $json_result['code']    = 301;
                    $json_result['msg']     = '부자재 등록에 실패 했습니다. 부자재 정보를 다시한번 확인해주세요';
                    $db->rollback();
                    return $json_result;
                }
                else{
                    $td_success_cnt++;
                }
            }
            else if($exist_sub_material_cnt > 0){
                $json_result['code'] = 301;
                $db->rollback();
                $json_result['msg'] = '동일한 부자재코드가 이미 존재합니다.';
                return $json_result;
            }
        }
    }

    if($delivery_sub_material_sheet != NULL && count($delivery_sub_material_sheet) != 0) {
        $delivery_success_cnt = 0;
     
        foreach ($delivery_sub_material_sheet as $key => $val) {
            /*
            0~5 :  coloum
            $val[0] :     SUB_MATERIAL_SORT
            $val[1] :     SUB_MATERIAL_NAME
            $val[2] :     SUB_MATERIAL_CODE
            $val[3] :     MEMO
            $val[4] :     COMPANY_NAME
            $val[5] :     COMPANY_CHARGE
            $val[6] :     COMPANY_TEL
            $val[7] :     COMPANY_ADDR
            */
            
            $sub_material_code = NULL;
            $sub_material_code = $val[2];
    
            $exist_sub_material_cnt = -1;
            if($sub_material_code != NULL){
                $exist_sub_material_cnt = $db->count('SUB_MATERIAL_INFO', 'SUB_MATERIAL_CODE = "'.$sub_material_code.'" ');
            }
        
            //insert
            if($exist_sub_material_cnt == 0){
                $sub_material_sort = NULL;
                $sub_material_sort_arr = array();
                $sub_material_sort = $val[0];
                if($sub_material_sort != NULL){
                    $sub_material_sort_arr[0] = ' SUB_MATERIAL_SORT, ';
                    $sub_material_sort_arr[1] = ' "'.$sub_material_sort.'", ';
                }
    
                $sub_material_name = NULL;
                $sub_material_name_arr = array();
                $sub_material_name = $val[1];
                if($sub_material_name != NULL){
                    $sub_material_name_arr[0] = ' SUB_MATERIAL_NAME, ';
                    $sub_material_name_arr[1] = ' "'.$sub_material_name.'", ';
                }
    
                $memo = NULL;
                $memo_arr = array();
                $memo = $val[3];
                if($memo != NULL){
                    $memo_arr[0] = ' MEMO, ';
                    $memo_arr[1] = ' "'.$memo.'", ';
                }
    
                $company_name = NULL;
                $company_name_arr = array();
                $company_name = $val[4];
                if($company_name != NULL){
                    $company_name_arr[0] = ' COMPANY_NAME, ';
                    $company_name_arr[1] = ' "'.$company_name.'", ';
                }
    
                $company_charge = NULL;
                $company_charge_arr = array();
                $company_charge = $val[5];
                if($company_charge != NULL){
                    $company_charge_arr[0] = ' COMPANY_CHARGE, ';
                    $company_charge_arr[1] = ' "'.$company_charge.'", ';
                }
    
                $company_tel = NULL;
                $company_tel_arr = array();
                $company_tel = $val[3];
                if($company_tel != NULL){
                    $company_tel_arr[0] = ' COMPANY_TEL, ';
                    $company_tel_arr[1] = ' "'.$company_tel.'", ';
                }
    
                $company_addr = NULL;
                $company_addr_arr = array();
                $company_addr = $val[3];
                if($company_addr != NULL){
                    $company_addr_arr[0] = ' COMPANY_ADDR, ';
                    $company_addr_arr[1] = ' "'.$company_addr.'", ';
                }
    
                $regist_sub_material_sql = "
                    INSERT INTO SUB_MATERIAL_INFO
                    (
                        ".$sub_material_sort_arr[0]."
                        ".$sub_material_name_arr[0]."
                        ".$memo_arr[0]."
                        ".$company_name_arr[0]."
                        ".$company_charge_arr[0]."
                        ".$company_tel_arr[0]."
                        ".$company_addr_arr[0]."
                        SUB_MATERIAL_TYPE,
                        SUB_MATERIAL_CODE
                    )
                    VALUES
                    (
                        ".$sub_material_sort_arr[1]."
                        ".$sub_material_name_arr[1]."
                        ".$memo_arr[1]."
                        ".$company_name_arr[1]."
                        ".$company_charge_arr[1]."
                        ".$company_tel_arr[1]."
                        ".$company_addr_arr[1]."
                        'D',
                        '".$sub_material_code."'
                    )
                ";
                $db->query($regist_sub_material_sql);
    
                $sub_material_idx = NULL;
                $sub_material_idx = $db->last_id();
    
                //오더시트 등록 실패시 롤백
                if(empty($sub_material_idx) || $sub_material_idx == NULL){
                    $json_result['code']    = 301;
                    $json_result['msg']     = '부자재 등록에 실패 했습니다. 부자재 정보를 다시한번 확인해주세요';
                    $db->rollback();
                    return $json_result;
                }
                else{
                    $delivery_success_cnt++;
                }
            }
            else if($exist_sub_material_cnt > 0){
                $json_result['code'] = 301;
                $db->rollback();
                $json_result['msg'] = '동일한 부자재코드가 이미 존재합니다.';
                return $json_result;
            }
        }
    }
    $json_result['data']['td_success'] = $td_success_cnt;
    $json_result['data']['delivery_success'] = $delivery_success_cnt;
    $db->commit();
}
catch(mysqli_sql_exception $exception){
    $json_result['code'] = 301;
    $db->rollback();
    $json_result['msg'] = '부자재 등록작업이 실패했습니다.';
    return $json_result;
}



?>