<?php
/*
 +=============================================================================
 | 
 | 상품관리 : 엑셀-상품옵션 업데이트
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
$option_sheet = $sheet_data['optional_sheet'];

$option_true = array();     //상품옵션 등록 성공
$option_false = array();    //상품옵션 등록 실패
$option_product_code = null;

date_default_timezone_set('Asia/Seoul');

if($option_sheet != null && count($option_sheet) != 0){
    for ($i=0; $i<count($option_sheet); $i++) {
        $where = 'PRODUCT_CODE = ?';
        $current_code = $option_sheet[$i][0];
        $values = array(
            'LIMIT_PURCHASE_MEMBER'     =>($option_sheet[$i][1]!=null?$option_sheet[$i][1]:'0'),
            'LIMIT_PURCHASE_SINGLE'     =>($option_sheet[$i][2]!=null?$option_sheet[$i][2]:0),
            'LIMIT_PURCHASE_QTY_MIN_NUM'=>($option_sheet[$i][3]!=null?$option_sheet[$i][3]:1),
            'LIMIT_PURCHASE_QTY_MAX_NUM'=>($option_sheet[$i][4]!=null?$option_sheet[$i][4]:0),
            'PRODUCT_KEYWORD'           =>$option_sheet[$i][5],
            'PRODUCT_TAG'               =>$option_sheet[$i][6],
    
            'PRODUCT_TOTAL_WEIGHT'      =>($option_sheet[$i][8]!=null?$option_sheet[$i][8]:'0'),
            'HS_CODE'                   =>$option_sheet[$i][9],
            'PRODUCT_DIVISION'          =>$option_sheet[$i][10],
            'PRODUCT_MATERIAL_KR'       =>$option_sheet[$i][11],
            'PRODUCT_MATERIAL_EN'       =>$option_sheet[$i][12],
            'FABRIC'                    =>$option_sheet[$i][13],
    
            'MANUFACTURER'              =>$option_sheet[$i][14],
            'SUPPLIER'                  =>$option_sheet[$i][15],
            'BRAND'                     =>$option_sheet[$i][16],
            'TREND'                     =>$option_sheet[$i][17],
            'SELF_CLASSIFICATION'       =>$option_sheet[$i][18],
            'MANUFACTURING_DATE'        =>$option_sheet[$i][19],
            'RELEASE_DATE'              =>$option_sheet[$i][20],
            'VALIDATE_START_DATE'       =>$option_sheet[$i][21],
            'VALIDATE_END_DATE'         =>$option_sheet[$i][22],
            'ORIGIN_COUNTRY'            =>$option_sheet[$i][23],
            'PRODUCT_WIDTH'             =>$option_sheet[$i][24],
            'PRODUCT_DEPTH'             =>$option_sheet[$i][25],
            'PRODUCT_HEIGHT'            =>$option_sheet[$i][26],
    
            'SEO_EXPOSURE_FLG'          =>$option_sheet[$i][27],
            'SEO_TITLE'                 =>$option_sheet[$i][28],
            'SEO_AUTHOR'                =>$option_sheet[$i][29],
            'SEO_DESCRIPTION'           =>$option_sheet[$i][30],
            'SEO_KEYWORDS'              =>$option_sheet[$i][31],
            'SEO_ALT_TEXT'              =>$option_sheet[$i][32],
            'MEMO'                      =>$option_sheet[$i][33],

            'UPDATER'                   =>'Admin',
            'UPDATE_DATE'               =>date("Y-m-d H:i:s",time())
        );
        if($db->count('dev.SHOP_PRODUCT',$where, array($current_code)) > 0) {
            $db->update('dev.SHOP_PRODUCT', $values,$where,array($current_code));
            array_push($option_true, array('product_code' => $current_code, 'row_num' => $i));
        }
        else{
            array_push($option_false, array('product_code' => $current_code, 'row_num' => $i));
        }
    }
    $json_result['result']['option']['true']      = $option_true;
    $json_result['result']['option']['false']     = $option_false;
}
?>