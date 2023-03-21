<?php
/*
 +=============================================================================
 | 
 | 상품관리 : 엑셀-상품업데이트
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
$sales_info_sheet = $sheet_data['sales_info_sheet'];

$update_column_arr = array();
$sales_info_true = array();     //상품옵션 등록 성공
$sales_info_false = array();    //상품옵션 등록 실패

date_default_timezone_set('Asia/Seoul');

if ($sales_info_sheet != null && count($sales_info_sheet) != 0) {
    $excel_start_row = 2;

    foreach ($sales_info_sheet as $key => $val) {
        /*
        $sales_info_sheet[$i][0] : product_code
        $sales_info_sheet[$i][1] : PRICE_KR
        $sales_info_sheet[$i][2] : SALES_PRICE_KR
        $sales_info_sheet[$i][3] : DISCOUNT_KR
        $sales_info_sheet[$i][4] : PRICE_EN
        $sales_info_sheet[$i][5] : SALES_PRICE_EN
        $sales_info_sheet[$i][6] : DISCOUNT_EN
        $sales_info_sheet[$i][7] : PRICE_CN
        $sales_info_sheet[$i][8] : SALES_PRICE_CN
        $sales_info_sheet[$i][9] : DISCOUNT_CN
        */

        $product_cnt_sql = "    SELECT 
                                    COUNT(0) AS PRODUCT_CNT 
                                FROM 
                                    SHOP_PRODUCT 
                                WHERE 
                                    PRODUCT_CODE = '" . $sales_info_sheet[$i][0] . "'
                            ";
        $db->query($product_cnt_sql);

        $product_cnt = 0;
        foreach ($db->fetch() as $cnt_data) {
            $product_cnt = $cnt_data['PRODUCT_CNT'];

            if ($product_cnt > 0) {
                $price_kr_str = "";
                if ($sales_info_sheet[$i][1] != null) {
                    $price_kr_str = " PRICE_KR = " . round($sales_info_sheet[$i][1], 2) . ", ";
                    array_push($update_column_arr, '한국몰 가격');
                }
    
                $sales_price_kr_str = "";
                if ($sales_info_sheet[$i][2] != null) {
                    $sales_price_kr_str = " SALES_PRICE_KR = " . round($sales_info_sheet[$i][2], 2) . ", ";
                    array_push($update_column_arr, '한국몰 판매가격');
                }
    
                $discount_kr_str = "";
                if ($sales_info_sheet[$i][3] != null) {
                    $discount_kr_str = " DISCOUNT_KR = " . round($sales_info_sheet[$i][3], 2) . ", ";
                    array_push($update_column_arr, '한국몰 할인율');
                }
    
                $price_en_str = "";
                if ($sales_info_sheet[$i][4] != null) {
                    $price_en_str = " PRICE_EN = " . round($sales_info_sheet[$i][4], 2) . ", ";
                    array_push($update_column_arr, '영문몰 가격');
                }
    
                $sales_price_en_str = "";
                if ($sales_info_sheet[$i][5] != null) {
                    $sales_price_en_str = " SALES_PRICE_EN = " . round($sales_info_sheet[$i][5], 2) . ", ";
                    array_push($update_column_arr, '영문몰 판매가격');
                }
    
                $discount_en_str = "";
                if ($sales_info_sheet[$i][6] != null) {
                    $discount_en_str = " DISCOUNT_EN = " . round($sales_info_sheet[$i][6], 2) . ", ";
                    array_push($update_column_arr, '영문몰 할인율');
                }
    
                $price_cn_str = "";
                if ($sales_info_sheet[$i][7] != null) {
                    $price_cn_str = " PRICE_CN = " . round($sales_info_sheet[$i][7], 2) . ", ";
                    array_push($update_column_arr, '중국몰 가격');
                }
    
                $sales_price_cn_str = "";
                if ($sales_info_sheet[$i][8] != null) {
                    $sales_price_cn_str = " SALES_PRICE_CN = " . round($sales_info_sheet[$i][8], 2) . ", ";
                    array_push($update_column_arr, '중국몰 판매가격');
                }
    
                $discount_cn_str = "";
                if ($sales_info_sheet[$i][9] != null) {
                    $discount_cn_str = " DISCOUNT_CN = " . round($sales_info_sheet[$i][9], 2) . ", ";
                    array_push($update_column_arr, '중국몰 할인율');
                }
    
                $sale_info_sql = "
                    UPDATE
                        SHOP_PRODUCT
                    SET
                        " . $price_kr_str . "
                        " . $sales_price_kr_str . "
                        " . $discount_kr_str . "
                        " . $price_en_str . "
                        " . $sales_price_en_str . "
                        " . $discount_en_str . "
                        " . $price_cn_str . "
                        " . $sales_price_cn_str . "
                        " . $discount_cn_str . "
    
                        UPDATER = '".$session_id."',
                        UPDATE_DATE = NOW()
                    WHERE
                        PRODUCT_CODE = '" . $sales_info_sheet[$i][0] . "'
                ";

                $db->query($sale_info_sql);
                array_push($sales_info_true, array('product_code' => $val[0], 'update_column' => implode($update_column_arr, ','), 'row_num' => $key + $excel_start_row));
            } else {
                array_push($sales_info_false, array('product_code' => $val[0], 'row_num' => $key + $excel_start_row, "reason" => "필수항목[상품코드]가 입력되지 않았습니다."));
            }
        }
        $json_result['result']['sale_info']['true']      = $relevant_true;
        $json_result['result']['sale_info']['false']     = $relevant_false; 
    }
}
else{
    $code = 300;
    $msg = '빈 시트입니다. 파일을 다시 확인해주세요';
}
?>