<?php
/*
 +=============================================================================
 | 
 | 상품관리 : 엑셀-상품업데이트
 | ----------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.07.14
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

/** 변수 정리 **/

$sheet_str = $_POST['sheet_data'];
$where = 'PRODUCT_CODE = ?';
$where_opt = 'OPTION_CODE = ?';
$where_opt_values = array();

$sheet_data = json_decode($sheet_str, true);
$sales_info_sheet = $sheet_data['sales_info_sheet'];

$sales_info_true = array();     //상품옵션 등록 성공
$sales_info_false = array();    //상품옵션 등록 실패

date_default_timezone_set('Asia/Seoul');

if($sales_info_sheet != null && count($sales_info_sheet) != 0){
    $excel_start_row = 11;
    for ($i=0; $i<count($sales_info_sheet); $i++) {
        $where = 'PRODUCT_CODE = ?';
        $current_code = $sales_info_sheet[$i][0];
        $values = array(
            'LIMIT_PURCHASE_MEMBER'     =>($sales_info_sheet[$i][1]!=null?$sales_info_sheet[$i][1]:'0'),
            'LIMIT_PURCHASE_SINGLE'     =>($sales_info_sheet[$i][2]!=null?$sales_info_sheet[$i][2]:0),
            'LIMIT_PURCHASE_QTY_MIN_NUM'=>($sales_info_sheet[$i][3]!=null?$sales_info_sheet[$i][3]:1),
            'LIMIT_PURCHASE_QTY_MAX_NUM'=>($sales_info_sheet[$i][4]!=null?$sales_info_sheet[$i][4]:0),
            'PRODUCT_KEYWORD'           =>$sales_info_sheet[$i][5],
            'PRODUCT_TAG'               =>$sales_info_sheet[$i][6],
    
            'PRODUCT_TOTAL_WEIGHT'      =>($sales_info_sheet[$i][8]!=null?$sales_info_sheet[$i][8]:'0'),
            'HS_CODE'                   =>$sales_info_sheet[$i][9],
            'PRODUCT_DIVISION'          =>$sales_info_sheet[$i][10],
            'PRODUCT_MATERIAL_KR'       =>$sales_info_sheet[$i][11],
            'PRODUCT_MATERIAL_EN'       =>$sales_info_sheet[$i][12],
            'FABRIC'                    =>$sales_info_sheet[$i][13],
    
            'MANUFACTURER'              =>$sales_info_sheet[$i][14],
            'SUPPLIER'                  =>$sales_info_sheet[$i][15],
            'BRAND'                     =>$sales_info_sheet[$i][16],
            'TREND'                     =>$sales_info_sheet[$i][17],
            'SELF_CLASSIFICATION'       =>$sales_info_sheet[$i][18],
            'MANUFACTURING_DATE'        =>$sales_info_sheet[$i][19],
            'RELEASE_DATE'              =>$sales_info_sheet[$i][20],
            'VALIDATE_START_DATE'       =>$sales_info_sheet[$i][21],
            'VALIDATE_END_DATE'         =>$sales_info_sheet[$i][22],
            'ORIGIN_COUNTRY'            =>$sales_info_sheet[$i][23],
            'PRODUCT_WIDTH'             =>$sales_info_sheet[$i][24],
            'PRODUCT_DEPTH'             =>$sales_info_sheet[$i][25],
            'PRODUCT_HEIGHT'            =>$sales_info_sheet[$i][26],
    
            'SEO_EXPOSURE_FLG'          =>$sales_info_sheet[$i][27],
            'SEO_TITLE'                 =>$sales_info_sheet[$i][28],
            'SEO_AUTHOR'                =>$sales_info_sheet[$i][29],
            'SEO_DESCRIPTION'           =>$sales_info_sheet[$i][30],
            'SEO_KEYWORDS'              =>$sales_info_sheet[$i][31],
            'SEO_ALT_TEXT'              =>$sales_info_sheet[$i][32],
            'MEMO'                      =>$sales_info_sheet[$i][33],

            'UPDATER'                   =>'Admin',
            'UPDATE_DATE'               =>date("Y-m-d H:i:s",time())
        );
        if($db->count('dev.SHOP_PRODUCT',$where, array($current_code)) > 0) {
            $db->update('dev.SHOP_PRODUCT', $values,$where,array($current_code));
            array_push($sales_info_true, array('product_code' => $current_code, 'row_num' => $i + $excel_start_row));
        }
        else{
            array_push($sales_info_false, array('product_code' => $current_code, 'row_num' => $i + $excel_start_row, 'reason' => '오더시트에 없는 상품코드입니다.'));
        }
    }
    $json_result['result']['sales_info']['true']      = $sales_info_true;
    $json_result['result']['sales_info']['false']     = $sales_info_false;
}
?>