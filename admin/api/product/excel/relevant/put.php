<?php
/*
 +=============================================================================
 | 
 | 상품관리 : 엑셀-관련상품 등록
 | ----------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.10.04
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

/** 변수 정리 **/
$sheet_str = $_POST['sheet_data'];

$sheet_data = json_decode($sheet_str, true);

$relevant_sheet   = $sheet_data['relevant_sheet'];

$relevant_info = array();
$relevant_true = array();
$relevant_false = array();

date_default_timezone_set('Asia/Seoul');

if($relevant_sheet != null && count($relevant_sheet) != 0){
    $excel_start_row = 3;
    foreach($relevant_sheet as $key=>$val){
        $val[0] = trim($val[0]);
        $val[1] = trim($val[1]);

       // $json_result['data_cnt'] = count($related_product_sheet);
        $product_code_cnt = $db->count("dev.SHOP_PRODUCT"," PRODUCT_CODE='".$val[0]."'");
        if($val[0] != null){
            if($product_code_cnt > 0 ){
                //있음
                $new_relevant_idx = null;

                $db->query("SELECT IDX FROM dev.SHOP_PRODUCT WHERE PRODUCT_CODE = '".$val[1]."'");
                foreach($db->fetch() as $data){
                    $new_relevant_idx = $data['IDX'];
                }
                if($new_relevant_idx != null){
                    //처음
                    if(!isset($relevant_info[$val[0]])){
                        $relevant_info[$val[0]] = $new_relevant_idx;
                    }
                    //처음아님
                    else{
                        $relevant_info[$val[0]] .= ",".$new_relevant_idx;
                    }
                    $sql = "
                        UPDATE 
                            dev.SHOP_PRODUCT 
                        SET
                            RELEVANT_IDX = '".$relevant_info[$val[0]]."'
                        WHERE
                            PRODUCT_CODE = '".$val[0]."'
                    ";
                    $db->query($sql);
                    array_push($relevant_true, array('product_code' => $val[0], 'relevant_code' => $val[1], 'row_num' => $key + $excel_start_row));
                }
                else{
                    array_push($relevant_false, array('product_code' => $val[0], 'relevant_code' => $val[1], 'row_num' => $key + $excel_start_row, "reason" => '관련상품이 존재하지않습니다.'));
                }

            }
            else{
                array_push($relevant_false, array('product_code' => $val[0], 'relevant_code' => $val[1], 'row_num' => $key + $excel_start_row, "reason" => "상품이 존재하지 않습니다."));
            }
        }
        else{
            array_push($relevant_false, array('product_code' => $val[0], 'relevant_code' => $val[1], 'row_num' => $key + $excel_start_row, "reason" => "상품코드가 입력되지 않았습니다."));
        }
        $json_result['result']['relevant']['true']      = $relevant_true;
        $json_result['result']['relevant']['false']     = $relevant_false; 
    }
}
