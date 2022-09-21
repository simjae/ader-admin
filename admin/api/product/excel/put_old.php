<?php
/*
 +=============================================================================
 | 
 | 상품관리 : 엑셀-상품등록
 | ----------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.07.05
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
$where_ist = '';
$where_ist_values = array();

$sheet_data = json_decode($sheet_str, true);

$commen_sheet = $sheet_data['commen_sheet'];
$optional_sheet = $sheet_data['optional_sheet'];

$option_val_arr = array();
foreach($optional_sheet as $data){
    $barcode = $data[0];
    $option_val_arr[$barcode] = array(
        //'OPTION_STOCK_SET'          =>$option_column,
        'LIMIT_PURCHASE_MEMBER'     =>($data[1]!=null?$data[1]:'0'),
        'LIMIT_PURCHASE_SINGLE'     =>($data[2]!=null?$data[2]:0),
        'LIMIT_PURCHASE_QTY_MIN_NUM'=>($data[4]!=null?$data[3]:1),
        'LIMIT_PURCHASE_QTY_MAX_NUM'=>($data[3]!=null?$data[4]:0),
        'PRODUCT_KEYWORD'           =>$data[5],
        'PRODUCT_TAG'               =>$data[6],

        'PRODUCT_TOTAL_WEIGHT'      =>($data[8]!=null?$data[8]:'0'),
        'HS_CODE'                   =>$data[9],
        'PRODUCT_DIVISION'          =>$data[10],
        'PRODUCT_MATERIAL_KR'       =>$data[11],
        'PRODUCT_MATERIAL_EN'       =>$data[12],
        'FABRIC'                    =>$data[13],

        'MANUFACTURER'              =>$data[14],
        'SUPPLIER'                  =>$data[15],
        'BRAND'                     =>$data[16],
        'TREND'                     =>$data[17],
        'SELF_CLASSIFICATION'       =>$data[18],
        'MANUFACTURING_DATE'        =>$data[19],
        'RELEASE_DATE'              =>$data[20],
        'VALIDATE_START_DATE'       =>$data[21],
        'VALIDATE_END_DATE'         =>$data[22],
        'ORIGIN_COUNTRY'            =>$data[23],
        'PRODUCT_WIDTH'             =>$data[24],
        'PRODUCT_DEPTH'             =>$data[25],
        'PRODUCT_HEIGHT'            =>$data[26],

        'SEO_EXPOSURE_FLG'          =>$data[27],
        'SEO_TITLE'                 =>$data[28],
        'SEO_AUTHOR'                =>$data[29],
        'SEO_DESCRIPTION'           =>$data[30],
        'SEO_KEYWORDS'              =>$data[31],
        'SEO_ALT_TEXT'              =>$data[32],
        'MEMO'                      =>$data[33]
    );
}


$fail_data = array();
$result_cnt = 0;
$overlap_cnt = 0;
if($commen_sheet != null && count($commen_sheet) != 0){
    foreach($commen_sheet as $val){
        $val[2] = trim($val[2]);
        $val[3] = trim($val[3]);
        for($i = 0; $i < 5; $i++){
            $chk_str =  strval($val[$i+23]).       //KR
                        strval($val[$i+29]).       //EN
                        strval($val[$i+35]);       //CN
                        
            if(strlen($chk_str) > 0 ){ 
                $option_code_cnt = $db->count("dev.PRODUCT_OPTION","OPTION_CODE='".$val[3]."_A".strval(($i+1))."'");
                if ($option_code_cnt == 0) {
                    $option_values = array(
                        'OPTION_CODE'       =>$val[3]."_A".strval($i+1),
                        'OPTION_NAME'       =>'A'.strval($i+1),
                        'PRODUCT_CODE'      =>$val[3]
                    );
                    $db->insert(
                        'dev.PRODUCT_OPTION',
                        $option_values,
                        $where_ist,
                        $where_ist_values
                    );
                } 
                else{
                    $where_opt_value = $val[3]."_A".strval(($i+1));
                    $option_values = array(
                        'OPTION_NAME'       =>'A'.strval($i+1),
                        'PRODUCT_CODE'      =>$val[3]
                    );
                    $db->update('dev.PRODUCT_OPTION',$option_values,$where_opt,array($where_opt_value)
                    );
                }
            }
        }
        $chk_str =  strval($val[28]).       //KR
                    strval($val[34]).       //EN
                    strval($val[40]);       //CN
                    
        if(strlen($chk_str) > 0 ){ 
            $option_code_cnt = $db->count("dev.PRODUCT_OPTION","OPTION_CODE='".$val[3]."_ONE'");
            if ($option_code_cnt == 0) {
                $option_values = array(
                    'OPTION_CODE'       =>$val[3]."_ONE",
                    'OPTION_NAME'       =>"ONE",
                    'PRODUCT_CODE'      =>$val[3]
                );
                $db->insert(
                    'dev.PRODUCT_OPTION',
                    $option_values,
                    $where_ist,
                    $where_ist_values
                );
            } 
            else{
                $where_opt_value = $val[3]."_ONE";
                $option_values = array(
                    'OPTION_NAME'       =>"ONE",
                    'PRODUCT_CODE'      =>$val[3]
                );
                $db->update('dev.PRODUCT_OPTION',$option_values,$where_opt,array($where_opt_value)
                );
            }
        }


        $tables = 'dev.PRODUCT_OPTION';
        $sql = "
                SELECT      IDX,
                            PRODUCT_CODE
                FROM        ".$tables."
                WHERE       PRODUCT_CODE = '".$val[3]."'
            ";
        $db->query($sql);
        foreach($db->fetch() as $opt_data) {
            if(strlen($option_stock_arr[$val[3]]['OPTION_STOCK_SET']) == 0){
                $option_stock_arr[$val[3]]['OPTION_STOCK_SET'] = $opt_data['IDX'];
            }
            else{
                $option_stock_arr[$val[3]]['OPTION_STOCK_SET'] .= ','.$opt_data['IDX'];
            }
        }

        $json_result['data_cnt'] = count($commen_sheet);
        $stock_set = $option_stock_arr[$val[3]]['OPTION_STOCK_SET'];
        $product_code_cnt = $db->count("dev.SHOP_PRODUCT"," PRODUCT_CODE='".$val[3]."'");
        if($val[3] != null){
            if($product_code_cnt == 0 ){
                if(!$option_val_arr[$val[3]]){
                    $values = array(
                        'PRODUCT_TYPE'              => 'BASIC',
                        'PRODUCT_STYLE_CODE'        => $val[2],
                        'PRODUCT_CODE'              => $val[3],
                        'PL_LRG_CATEGORY'           => $val[4],
                        'PL_MDL_CATEGORY'           => $val[5],
                        'PL_SML_CATEGORY'           => $val[6],
                        'PL_DTL_CATEGORY'           => $val[7],
                        'MATERIAL'                  => $val[8],
                        'GRAPHIC'                   => $val[9],
                        'FIT'                       => $val[10],
                        'PRODUCT_NAME'              => $val[11],
                        'SIZE'                      => $val[12],
                        'COLOR'                     => $val[13],
                        'COLOR_CODE'                => $val[14],
                        'NAVIGATION'                => $val[15],
                        'LIMIT_PURCHASE_MEMBER_EXT' => $val[16],
                        'WKLA'                      => $val[17],
                        //preg_replace('/\r\n|\r|\n/','',$text);
                        'MATERIAL_KR'               => preg_replace('/\r\n|\r|\n/','<br>',$val[18]),
                        'MATERIAL_EN'               => preg_replace('/\r\n|\r|\n/','<br>',$val[19]),
                        'MATERIAL_CN'               => preg_replace('/\r\n|\r|\n/','<br>',$val[20]),
                        'SIZE_DETAIL_MODEL'         => $val[21],
                        'SIZE_DETAIL_WEAR'          => $val[22],
                        'SIZE_DETAIL_A1_KR'         => preg_replace('/\r\n|\r|\n/','<br>',$val[23]),
                        'SIZE_DETAIL_A2_KR'         => preg_replace('/\r\n|\r|\n/','<br>',$val[24]),
                        'SIZE_DETAIL_A3_KR'         => preg_replace('/\r\n|\r|\n/','<br>',$val[25]),
                        'SIZE_DETAIL_A4_KR'         => preg_replace('/\r\n|\r|\n/','<br>',$val[26]),
                        'SIZE_DETAIL_A5_KR'         => preg_replace('/\r\n|\r|\n/','<br>',$val[27]),
                        'SIZE_DETAIL_ONESIZE_KR'    => preg_replace('/\r\n|\r|\n/','<br>',$val[28]),
                        'SIZE_DETAIL_A1_EN'         => preg_replace('/\r\n|\r|\n/','<br>',$val[29]),
                        'SIZE_DETAIL_A2_EN'         => preg_replace('/\r\n|\r|\n/','<br>',$val[30]),
                        'SIZE_DETAIL_A3_EN'         => preg_replace('/\r\n|\r|\n/','<br>',$val[31]),
                        'SIZE_DETAIL_A4_EN'         => preg_replace('/\r\n|\r|\n/','<br>',$val[32]),
                        'SIZE_DETAIL_A5_EN'         => preg_replace('/\r\n|\r|\n/','<br>',$val[33]),
                        'SIZE_DETAIL_ONESIZE_EN'    => preg_replace('/\r\n|\r|\n/','<br>',$val[34]),
                        'SIZE_DETAIL_A1_CN'         => preg_replace('/\r\n|\r|\n/','<br>',$val[35]),
                        'SIZE_DETAIL_A2_CN'         => preg_replace('/\r\n|\r|\n/','<br>',$val[36]),
                        'SIZE_DETAIL_A3_CN'         => preg_replace('/\r\n|\r|\n/','<br>',$val[37]),
                        'SIZE_DETAIL_A4_CN'         => preg_replace('/\r\n|\r|\n/','<br>',$val[38]),
                        'SIZE_DETAIL_A5_CN'         => preg_replace('/\r\n|\r|\n/','<br>',$val[39]),
                        'SIZE_DETAIL_ONESIZE_CN'    => preg_replace('/\r\n|\r|\n/','<br>',$val[40]),
                        'CARE_KR'                   => preg_replace('/\r\n|\r|\n/','<br>',$val[41]),
                        'CARE_EN'                   => preg_replace('/\r\n|\r|\n/','<br>',$val[42]),
                        'CARE_CN'                   => preg_replace('/\r\n|\r|\n/','<br>',$val[43]),
                        'DETAIL_KR'                 => preg_replace('/\r\n|\r|\n/','<br>',$val[44]),
                        'DETAIL_EN'                 => preg_replace('/\r\n|\r|\n/','<br>',$val[45]),
                        'DETAIL_CN'                 => preg_replace('/\r\n|\r|\n/','<br>',$val[46]),
                        'PRICE_KR'                  => $val[47],
                        'PRICE_KR_GB'               => $val[48],
                        'PRICE_EN'                  => $val[49],
                        'PRICE_CN'                  => $val[50],
        
                        'MD_CATEGORY_1'             => 0,
                        'MD_CATEGORY_2'             => 0,
                        'MD_CATEGORY_3'             => 0,
                        'MD_CATEGORY_4'             => 0,
                        'MD_CATEGORY_5'             => 0,
                        'MD_CATEGORY_6'             => 0,
                        'CATEGORY_IDX'              => 0,
                        'SALES_PRICE_KR'            => $val[47],
                        'PRICE_EN'                  => number_format($val[49],2),
                        'PRICE_CN'                  => number_format($val[50],2),

                        'OPTION_STOCK_SET'          =>(strlen($stock_set)>0?$stock_set:0),
        
                        'CREATER'                   =>'Admin',
                        'UPDATER'                   =>'Admin'
                    );
                }
                else {
                    $values = array(
                        'PRODUCT_TYPE'              => 'BASIC',
                        'PRODUCT_STYLE_CODE'        => $val[2],
                        'PRODUCT_CODE'              => $val[3],
                        'PL_LRG_CATEGORY'           => $val[4],
                        'PL_MDL_CATEGORY'           => $val[5],
                        'PL_SML_CATEGORY'           => $val[6],
                        'PL_DTL_CATEGORY'           => $val[7],
                        'MATERIAL'                  => $val[8],
                        'GRAPHIC'                   => $val[9],
                        'FIT'                       => $val[10],
                        'PRODUCT_NAME'              => $val[11],
                        'SIZE'                      => $val[12],
                        'COLOR'                     => $val[13],
                        'COLOR_CODE'                => $val[14],
                        'NAVIGATION'                => $val[15],
                        'LIMIT_PURCHASE_MEMBER_EXT' => $val[16],
                        'WKLA'                      => $val[17],
                        'MATERIAL_KR'               => preg_replace('/\r\n|\r|\n/','<br>',$val[18]),
                        'MATERIAL_EN'               => preg_replace('/\r\n|\r|\n/','<br>',$val[19]),
                        'MATERIAL_CN'               => preg_replace('/\r\n|\r|\n/','<br>',$val[20]),
                        'SIZE_DETAIL_MODEL'         => $val[21],
                        'SIZE_DETAIL_WEAR'          => $val[22],
                        'SIZE_DETAIL_A1_KR'         => preg_replace('/\r\n|\r|\n/','<br>',$val[23]),
                        'SIZE_DETAIL_A2_KR'         => preg_replace('/\r\n|\r|\n/','<br>',$val[24]),
                        'SIZE_DETAIL_A3_KR'         => preg_replace('/\r\n|\r|\n/','<br>',$val[25]),
                        'SIZE_DETAIL_A4_KR'         => preg_replace('/\r\n|\r|\n/','<br>',$val[26]),
                        'SIZE_DETAIL_A5_KR'         => preg_replace('/\r\n|\r|\n/','<br>',$val[27]),
                        'SIZE_DETAIL_ONESIZE_KR'    => preg_replace('/\r\n|\r|\n/','<br>',$val[28]),
                        'SIZE_DETAIL_A1_EN'         => preg_replace('/\r\n|\r|\n/','<br>',$val[29]),
                        'SIZE_DETAIL_A2_EN'         => preg_replace('/\r\n|\r|\n/','<br>',$val[30]),
                        'SIZE_DETAIL_A3_EN'         => preg_replace('/\r\n|\r|\n/','<br>',$val[31]),
                        'SIZE_DETAIL_A4_EN'         => preg_replace('/\r\n|\r|\n/','<br>',$val[32]),
                        'SIZE_DETAIL_A5_EN'         => preg_replace('/\r\n|\r|\n/','<br>',$val[33]),
                        'SIZE_DETAIL_ONESIZE_EN'    => preg_replace('/\r\n|\r|\n/','<br>',$val[34]),
                        'SIZE_DETAIL_A1_CN'         => preg_replace('/\r\n|\r|\n/','<br>',$val[35]),
                        'SIZE_DETAIL_A2_CN'         => preg_replace('/\r\n|\r|\n/','<br>',$val[36]),
                        'SIZE_DETAIL_A3_CN'         => preg_replace('/\r\n|\r|\n/','<br>',$val[37]),
                        'SIZE_DETAIL_A4_CN'         => preg_replace('/\r\n|\r|\n/','<br>',$val[38]),
                        'SIZE_DETAIL_A5_CN'         => preg_replace('/\r\n|\r|\n/','<br>',$val[39]),
                        'SIZE_DETAIL_ONESIZE_CN'    => preg_replace('/\r\n|\r|\n/','<br>',$val[40]),
                        'CARE_KR'                   => preg_replace('/\r\n|\r|\n/','<br>',$val[41]),
                        'CARE_EN'                   => preg_replace('/\r\n|\r|\n/','<br>',$val[42]),
                        'CARE_CN'                   => preg_replace('/\r\n|\r|\n/','<br>',$val[43]),
                        'DETAIL_KR'                 => preg_replace('/\r\n|\r|\n/','<br>',$val[44]),
                        'DETAIL_EN'                 => preg_replace('/\r\n|\r|\n/','<br>',$val[45]),
                        'DETAIL_CN'                 => preg_replace('/\r\n|\r|\n/','<br>',$val[46]),
                        'PRICE_KR'                  => $val[47],
                        'PRICE_KR_GB'               => $val[48],
                        'PRICE_EN'                  => number_format($val[49],2),
                        'PRICE_CN'                  => number_format($val[50],2),
        
                        'MD_CATEGORY_1'             => 0,
                        'MD_CATEGORY_2'             => 0,
                        'MD_CATEGORY_3'             => 0,
                        'MD_CATEGORY_4'             => 0,
                        'MD_CATEGORY_5'             => 0,
                        'MD_CATEGORY_6'             => 0,
                        'CATEGORY_IDX'              => 0,
                        'SALES_PRICE_KR'            => $val[47],
                        'SALES_PRICE_EN'            => $val[49],
                        'SALES_PRICE_CN'            => $val[50],
        
                        'OPTION_STOCK_SET'          =>(strlen($stock_set)>0?$stock_set:0),
                        'LIMIT_PURCHASE_MEMBER'     =>$option_val_arr[$val[3]]['LIMIT_PURCHASE_MEMBER'],
                        'LIMIT_PURCHASE_SINGLE'     =>$option_val_arr[$val[3]]['LIMIT_PURCHASE_SINGLE'],
                        'LIMIT_PURCHASE_QTY_MIN_NUM'=>$option_val_arr[$val[3]]['LIMIT_PURCHASE_QTY_MIN_NUM'],
                        'LIMIT_PURCHASE_QTY_MAX_NUM'=>$option_val_arr[$val[3]]['LIMIT_PURCHASE_QTY_MAX_NUM'],
                        'PRODUCT_KEYWORD'           =>$option_val_arr[$val[3]]['PRODUCT_KEYWORD'],
                        'PRODUCT_TAG'               =>$option_val_arr[$val[3]]['PRODUCT_TAG'],
        
                        'PRODUCT_TOTAL_WEIGHT'      =>$option_val_arr[$val[3]]['PRODUCT_TOTAL_WEIGHT'],
                        'HS_CODE'                   =>$option_val_arr[$val[3]]['HS_CODE'],
                        'PRODUCT_DIVISION'          =>$option_val_arr[$val[3]]['PRODUCT_DIVISION'],
                        'PRODUCT_MATERIAL_KR'       =>$option_val_arr[$val[3]]['PRODUCT_MATERIAL_KR'],
                        'PRODUCT_MATERIAL_EN'       =>$option_val_arr[$val[3]]['PRODUCT_MATERIAL_EN'],
                        'FABRIC'                    =>$option_val_arr[$val[3]]['FABRIC'],
        
                        'MANUFACTURER'              =>$option_val_arr[$val[3]]['MANUFACTURER'],
                        'SUPPLIER'                  =>$option_val_arr[$val[3]]['SUPPLIER'],
                        'BRAND'                     =>$option_val_arr[$val[3]]['BRAND'],
                        'TREND'                     =>$option_val_arr[$val[3]]['TREND'],
                        'SELF_CLASSIFICATION'       =>$option_val_arr[$val[3]]['SELF_CLASSIFICATION'],
                        'MANUFACTURING_DATE'        =>$option_val_arr[$val[3]]['MANUFACTURING_DATE'],
                        'RELEASE_DATE'              =>$option_val_arr[$val[3]]['RELEASE_DATE'],
                        'VALIDATE_START_DATE'       =>$option_val_arr[$val[3]]['VALIDATE_START_DATE'],
                        'VALIDATE_END_DATE'         =>$option_val_arr[$val[3]]['VALIDATE_END_DATE'],
                        'ORIGIN_COUNTRY'            =>$option_val_arr[$val[3]]['ORIGIN_COUNTRY'],
                        'PRODUCT_WIDTH'             =>$option_val_arr[$val[3]]['PRODUCT_WIDTH'],
                        'PRODUCT_DEPTH'             =>$option_val_arr[$val[3]]['PRODUCT_DEPTH'],
                        'PRODUCT_HEIGHT'            =>$option_val_arr[$val[3]]['PRODUCT_HEIGHT'],
                        'PRODUCT_VOLUME'            =>( $option_val_arr[$val[3]]['PRODUCT_WIDTH'] *
                                                        $option_val_arr[$val[3]]['PRODUCT_DEPTH'] *
                                                        $option_val_arr[$val[3]]['PRODUCT_HEIGHT']),
        
                        'SEO_EXPOSURE_FLG'          =>$option_val_arr[$val[3]]['SEO_EXPOSURE_FLG'],
                        'SEO_TITLE'                 =>$option_val_arr[$val[3]]['SEO_TITLE'],
                        'SEO_AUTHOR'                =>$option_val_arr[$val[3]]['SEO_AUTHOR'],
                        'SEO_DESCRIPTION'           =>$option_val_arr[$val[3]]['SEO_DESCRIPTION'],
                        'SEO_KEYWORDS'              =>$option_val_arr[$val[3]]['SEO_KEYWORDS'],
                        'SEO_ALT_TEXT'              =>$option_val_arr[$val[3]]['SEO_ALT_TEXT'],
        
                        'MEMO'                      =>$option_val_arr[$val[3]]['MEMO'],
                        
                        'CREATER'                   =>'Admin',
                        'UPDATER'                   =>'Admin'
                    );
                }
                $db->insert(
                    'dev.SHOP_PRODUCT',
                    $values,
                    $where_ist,
                    $where_ist_values
                );
            }
            else{
                $where_value = $val[3];
            
                if(!$option_val_arr[$val[3]]){
                    $values = array(
                        'PRODUCT_TYPE'              => 'BASIC',
                        'PRODUCT_STYLE_CODE'        => $val[2],
                        'PL_LRG_CATEGORY'           => $val[4],
                        'PL_MDL_CATEGORY'           => $val[5],
                        'PL_SML_CATEGORY'           => $val[6],
                        'PL_DTL_CATEGORY'           => $val[7],
                        'MATERIAL'                  => $val[8],
                        'GRAPHIC'                   => $val[9],
                        'FIT'                       => $val[10],
                        'PRODUCT_NAME'              => $val[11],
                        'SIZE'                      => $val[12],
                        'COLOR'                     => $val[13],
                        'COLOR_CODE'                => $val[14],
                        'NAVIGATION'                => $val[15],
                        'LIMIT_PURCHASE_MEMBER_EXT' => $val[16],
                        'WKLA'                      => $val[17],
                        'MATERIAL_KR'               => preg_replace('/\r\n|\r|\n/','<br>',$val[18]),
                        'MATERIAL_EN'               => preg_replace('/\r\n|\r|\n/','<br>',$val[19]),
                        'MATERIAL_CN'               => preg_replace('/\r\n|\r|\n/','<br>',$val[20]),
                        'SIZE_DETAIL_MODEL'         => $val[21],
                        'SIZE_DETAIL_WEAR'          => $val[22],
                        'SIZE_DETAIL_A1_KR'         => preg_replace('/\r\n|\r|\n/','<br>',$val[23]),
                        'SIZE_DETAIL_A2_KR'         => preg_replace('/\r\n|\r|\n/','<br>',$val[24]),
                        'SIZE_DETAIL_A3_KR'         => preg_replace('/\r\n|\r|\n/','<br>',$val[25]),
                        'SIZE_DETAIL_A4_KR'         => preg_replace('/\r\n|\r|\n/','<br>',$val[26]),
                        'SIZE_DETAIL_A5_KR'         => preg_replace('/\r\n|\r|\n/','<br>',$val[27]),
                        'SIZE_DETAIL_ONESIZE_KR'    => preg_replace('/\r\n|\r|\n/','<br>',$val[28]),
                        'SIZE_DETAIL_A1_EN'         => preg_replace('/\r\n|\r|\n/','<br>',$val[29]),
                        'SIZE_DETAIL_A2_EN'         => preg_replace('/\r\n|\r|\n/','<br>',$val[30]),
                        'SIZE_DETAIL_A3_EN'         => preg_replace('/\r\n|\r|\n/','<br>',$val[31]),
                        'SIZE_DETAIL_A4_EN'         => preg_replace('/\r\n|\r|\n/','<br>',$val[32]),
                        'SIZE_DETAIL_A5_EN'         => preg_replace('/\r\n|\r|\n/','<br>',$val[33]),
                        'SIZE_DETAIL_ONESIZE_EN'    => preg_replace('/\r\n|\r|\n/','<br>',$val[34]),
                        'SIZE_DETAIL_A1_CN'         => preg_replace('/\r\n|\r|\n/','<br>',$val[35]),
                        'SIZE_DETAIL_A2_CN'         => preg_replace('/\r\n|\r|\n/','<br>',$val[36]),
                        'SIZE_DETAIL_A3_CN'         => preg_replace('/\r\n|\r|\n/','<br>',$val[37]),
                        'SIZE_DETAIL_A4_CN'         => preg_replace('/\r\n|\r|\n/','<br>',$val[38]),
                        'SIZE_DETAIL_A5_CN'         => preg_replace('/\r\n|\r|\n/','<br>',$val[39]),
                        'SIZE_DETAIL_ONESIZE_CN'    => preg_replace('/\r\n|\r|\n/','<br>',$val[40]),
                        'CARE_KR'                   => preg_replace('/\r\n|\r|\n/','<br>',$val[41]),
                        'CARE_EN'                   => preg_replace('/\r\n|\r|\n/','<br>',$val[42]),
                        'CARE_CN'                   => preg_replace('/\r\n|\r|\n/','<br>',$val[43]),
                        'DETAIL_KR'                 => preg_replace('/\r\n|\r|\n/','<br>',$val[44]),
                        'DETAIL_EN'                 => preg_replace('/\r\n|\r|\n/','<br>',$val[45]),
                        'DETAIL_CN'                 => preg_replace('/\r\n|\r|\n/','<br>',$val[46]),
                        'PRICE_KR'                  => $val[47],
                        'PRICE_KR_GB'               => $val[48],
                        'PRICE_EN'                  => number_format($val[49],2),
                        'PRICE_CN'                  => number_format($val[50],2),
        
                        'MD_CATEGORY_1'             => 0,
                        'MD_CATEGORY_2'             => 0,
                        'MD_CATEGORY_3'             => 0,
                        'MD_CATEGORY_4'             => 0,
                        'MD_CATEGORY_5'             => 0,
                        'MD_CATEGORY_6'             => 0,
                        'CATEGORY_IDX'              => 0,
                        'SALES_PRICE_KR'            => $val[47],
                        'SALES_PRICE_EN'            => $val[49],
                        'SALES_PRICE_CN'            => $val[50],

                        'OPTION_STOCK_SET'          =>(strlen($stock_set)>0?$stock_set:0),
        
                        'CREATER'                   =>'Admin',
                        'UPDATER'                   =>'Admin'
                    );
                }
                else {
                    $values = array(
                        'PRODUCT_TYPE'              => 'BASIC',
                        'PRODUCT_STYLE_CODE'        => $val[2],
                        'PL_LRG_CATEGORY'           => $val[4],
                        'PL_MDL_CATEGORY'           => $val[5],
                        'PL_SML_CATEGORY'           => $val[6],
                        'PL_DTL_CATEGORY'           => $val[7],
                        'MATERIAL'                  => $val[8],
                        'GRAPHIC'                   => $val[9],
                        'FIT'                       => $val[10],
                        'PRODUCT_NAME'              => $val[11],
                        'SIZE'                      => $val[12],
                        'COLOR'                     => $val[13],
                        'COLOR_CODE'                => $val[14],
                        'NAVIGATION'                => $val[15],
                        'LIMIT_PURCHASE_MEMBER_EXT' => $val[16],
                        'WKLA'                      => $val[17],
                        'MATERIAL_KR'               => preg_replace('/\r\n|\r|\n/','<br>',$val[18]),
                        'MATERIAL_EN'               => preg_replace('/\r\n|\r|\n/','<br>',$val[19]),
                        'MATERIAL_CN'               => preg_replace('/\r\n|\r|\n/','<br>',$val[20]),
                        'SIZE_DETAIL_MODEL'         => $val[21],
                        'SIZE_DETAIL_WEAR'          => $val[22],
                        'SIZE_DETAIL_A1_KR'         => preg_replace('/\r\n|\r|\n/','<br>',$val[23]),
                        'SIZE_DETAIL_A2_KR'         => preg_replace('/\r\n|\r|\n/','<br>',$val[24]),
                        'SIZE_DETAIL_A3_KR'         => preg_replace('/\r\n|\r|\n/','<br>',$val[25]),
                        'SIZE_DETAIL_A4_KR'         => preg_replace('/\r\n|\r|\n/','<br>',$val[26]),
                        'SIZE_DETAIL_A5_KR'         => preg_replace('/\r\n|\r|\n/','<br>',$val[27]),
                        'SIZE_DETAIL_ONESIZE_KR'    => preg_replace('/\r\n|\r|\n/','<br>',$val[28]),
                        'SIZE_DETAIL_A1_EN'         => preg_replace('/\r\n|\r|\n/','<br>',$val[29]),
                        'SIZE_DETAIL_A2_EN'         => preg_replace('/\r\n|\r|\n/','<br>',$val[30]),
                        'SIZE_DETAIL_A3_EN'         => preg_replace('/\r\n|\r|\n/','<br>',$val[31]),
                        'SIZE_DETAIL_A4_EN'         => preg_replace('/\r\n|\r|\n/','<br>',$val[32]),
                        'SIZE_DETAIL_A5_EN'         => preg_replace('/\r\n|\r|\n/','<br>',$val[33]),
                        'SIZE_DETAIL_ONESIZE_EN'    => preg_replace('/\r\n|\r|\n/','<br>',$val[34]),
                        'SIZE_DETAIL_A1_CN'         => preg_replace('/\r\n|\r|\n/','<br>',$val[35]),
                        'SIZE_DETAIL_A2_CN'         => preg_replace('/\r\n|\r|\n/','<br>',$val[36]),
                        'SIZE_DETAIL_A3_CN'         => preg_replace('/\r\n|\r|\n/','<br>',$val[37]),
                        'SIZE_DETAIL_A4_CN'         => preg_replace('/\r\n|\r|\n/','<br>',$val[38]),
                        'SIZE_DETAIL_A5_CN'         => preg_replace('/\r\n|\r|\n/','<br>',$val[39]),
                        'SIZE_DETAIL_ONESIZE_CN'    => preg_replace('/\r\n|\r|\n/','<br>',$val[40]),
                        'CARE_KR'                   => preg_replace('/\r\n|\r|\n/','<br>',$val[41]),
                        'CARE_EN'                   => preg_replace('/\r\n|\r|\n/','<br>',$val[42]),
                        'CARE_CN'                   => preg_replace('/\r\n|\r|\n/','<br>',$val[43]),
                        'DETAIL_KR'                 => preg_replace('/\r\n|\r|\n/','<br>',$val[44]),
                        'DETAIL_EN'                 => preg_replace('/\r\n|\r|\n/','<br>',$val[45]),
                        'DETAIL_CN'                 => preg_replace('/\r\n|\r|\n/','<br>',$val[46]),
                        'PRICE_KR'                  => $val[47],
                        'PRICE_KR_GB'               => $val[48],
                        'PRICE_EN'                  => number_format($val[49],2),
                        'PRICE_CN'                  => number_format($val[50],2),
        
                        'MD_CATEGORY_1'             => 0,
                        'MD_CATEGORY_2'             => 0,
                        'MD_CATEGORY_3'             => 0,
                        'MD_CATEGORY_4'             => 0,
                        'MD_CATEGORY_5'             => 0,
                        'MD_CATEGORY_6'             => 0,
                        'CATEGORY_IDX'              => 0,
                        'SALES_PRICE_KR'            => $val[47],
                        'SALES_PRICE_EN'            => $val[49],
                        'SALES_PRICE_CN'            => $val[50],
        
                        'OPTION_STOCK_SET'          =>(strlen($stock_set)>0?$stock_set:'0'),

                        'LIMIT_PURCHASE_MEMBER'     =>$option_val_arr[$val[3]]['LIMIT_PURCHASE_MEMBER'],
                        'LIMIT_PURCHASE_SINGLE'     =>$option_val_arr[$val[3]]['LIMIT_PURCHASE_SINGLE'],
                        'LIMIT_PURCHASE_QTY_MIN_NUM'=>$option_val_arr[$val[3]]['LIMIT_PURCHASE_QTY_MIN_NUM'],
                        'LIMIT_PURCHASE_QTY_MAX_NUM'=>$option_val_arr[$val[3]]['LIMIT_PURCHASE_QTY_MAX_NUM'],
                        'PRODUCT_KEYWORD'           =>$option_val_arr[$val[3]]['PRODUCT_KEYWORD'],
                        'PRODUCT_TAG'               =>$option_val_arr[$val[3]]['PRODUCT_TAG'],
        
                        'PRODUCT_TOTAL_WEIGHT'      =>$option_val_arr[$val[3]]['PRODUCT_TOTAL_WEIGHT'],
                        'HS_CODE'                   =>$option_val_arr[$val[3]]['HS_CODE'],
                        'PRODUCT_DIVISION'          =>$option_val_arr[$val[3]]['PRODUCT_DIVISION'],
                        'PRODUCT_MATERIAL_KR'       =>$option_val_arr[$val[3]]['PRODUCT_MATERIAL_KR'],
                        'PRODUCT_MATERIAL_EN'       =>$option_val_arr[$val[3]]['PRODUCT_MATERIAL_EN'],
                        'FABRIC'                    =>$option_val_arr[$val[3]]['FABRIC'],
        
                        'MANUFACTURER'              =>$option_val_arr[$val[3]]['MANUFACTURER'],
                        'SUPPLIER'                  =>$option_val_arr[$val[3]]['SUPPLIER'],
                        'BRAND'                     =>$option_val_arr[$val[3]]['BRAND'],
                        'TREND'                     =>$option_val_arr[$val[3]]['TREND'],
                        'SELF_CLASSIFICATION'       =>$option_val_arr[$val[3]]['SELF_CLASSIFICATION'],
                        'MANUFACTURING_DATE'        =>$option_val_arr[$val[3]]['MANUFACTURING_DATE'],
                        'RELEASE_DATE'              =>$option_val_arr[$val[3]]['RELEASE_DATE'],
                        'VALIDATE_START_DATE'       =>$option_val_arr[$val[3]]['VALIDATE_START_DATE'],
                        'VALIDATE_END_DATE'         =>$option_val_arr[$val[3]]['VALIDATE_END_DATE'],
                        'ORIGIN_COUNTRY'            =>$option_val_arr[$val[3]]['ORIGIN_COUNTRY'],
                        'PRODUCT_WIDTH'             =>$option_val_arr[$val[3]]['PRODUCT_WIDTH'],
                        'PRODUCT_DEPTH'             =>$option_val_arr[$val[3]]['PRODUCT_DEPTH'],
                        'PRODUCT_HEIGHT'            =>$option_val_arr[$val[3]]['PRODUCT_HEIGHT'],
                        'PRODUCT_VOLUME'            =>( $option_val_arr[$val[3]]['PRODUCT_WIDTH'] *
                                                        $option_val_arr[$val[3]]['PRODUCT_DEPTH'] *
                                                        $option_val_arr[$val[3]]['PRODUCT_HEIGHT']),
        
                        'SEO_EXPOSURE_FLG'          =>$option_val_arr[$val[3]]['SEO_EXPOSURE_FLG'],
                        'SEO_TITLE'                 =>$option_val_arr[$val[3]]['SEO_TITLE'],
                        'SEO_AUTHOR'                =>$option_val_arr[$val[3]]['SEO_AUTHOR'],
                        'SEO_DESCRIPTION'           =>$option_val_arr[$val[3]]['SEO_DESCRIPTION'],
                        'SEO_KEYWORDS'              =>$option_val_arr[$val[3]]['SEO_KEYWORDS'],
                        'SEO_ALT_TEXT'              =>$option_val_arr[$val[3]]['SEO_ALT_TEXT'],
        
                        'MEMO'                      =>$option_val_arr[$val[3]]['MEMO'],
                        
                        'CREATER'                   =>'Admin',
                        'UPDATER'                   =>'Admin'
                    );
                }
                if(!$db->update('dev.SHOP_PRODUCT',
                $values,$where,array($where_value))) {
                    $code = 200;
                }
            }
        }
        else{
            $overlap_cnt++;
        }
        $result_cnt++;
    }
}

if($result_cnt == count($sheet_data)){
    $json_result['result'] = true; 
}
else{
    $json_result['result'] = false; 
}

$json_result['result_cnt'] = $result_cnt;
$json_result['overlap_cnt'] = $overlap_cnt;
?>