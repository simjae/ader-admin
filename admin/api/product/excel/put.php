<?php
/*
 +=============================================================================
 | 
 | 상품관리 : 엑셀-상품등록
 | ----------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.09.05
 | 최종 수정일	: 
 | 버전		: 1.1
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

$order_sheet   = $sheet_data['order_sheet'];
$sales_info_sheet = $sheet_data['sales_info_sheet'];
$option_info_sheet = $sheet_data['option_info_sheet'];

$img_sheet      = $sheet_data['img_sheet'];
$product_info = array();
$product_true = array();
$product_false = array();

date_default_timezone_set('Asia/Seoul');
$option_info_arr = array();

if($option_info_sheet != null && count($option_info_sheet) != 0){
    $excel_start_row = 3;
    foreach($option_info_sheet as $key => $val){
        $option_info_arr[$val[0]][$val[0]."_".$val[1]] = array($key + $excel_start_row, $val);
    }
}

if($order_sheet != null && count($order_sheet) != 0){
    $excel_start_row = 11;
    foreach($order_sheet as $key=>$val){
        $val[2] = trim($val[2]);
        $val[3] = trim($val[3]);

        $json_result['data_cnt'] = count($order_sheet);
        $product_code_cnt = $db->count("dev.SHOP_PRODUCT"," PRODUCT_CODE='".$val[3]."'");
        if($val[3] != null){
            if($product_code_cnt == 0 ){
                $product_insert_sql = "
                    INSERT INTO dev.SHOP_PRODUCT (
                        PRODUCT_TYPE,
                        PRODUCT_STYLE_CODE,
                        PRODUCT_CODE,
                        PL_LRG_CATEGORY,
                        PL_MDL_CATEGORY,
                        PL_SML_CATEGORY,
                        PL_DTL_CATEGORY,
                        MATERIAL,
                        GRAPHIC,
                        FIT,
                        PRODUCT_NAME,
                        SIZE,
                        COLOR,
                        COLOR_CODE,
                        NAVIGATION,
                        LIMIT_PURCHASE_MEMBER_EXT,
                        WKLA,
                        MATERIAL_KR,
                        MATERIAL_EN,
                        MATERIAL_CN,
                        SIZE_DETAIL_MODEL,
                        SIZE_DETAIL_WEAR,
                        SIZE_DETAIL_A1_KR,
                        SIZE_DETAIL_A2_KR,
                        SIZE_DETAIL_A3_KR,
                        SIZE_DETAIL_A4_KR,
                        SIZE_DETAIL_A5_KR,
                        SIZE_DETAIL_ONESIZE_KR,
                        SIZE_DETAIL_A1_EN,
                        SIZE_DETAIL_A2_EN,
                        SIZE_DETAIL_A3_EN,
                        SIZE_DETAIL_A4_EN,
                        SIZE_DETAIL_A5_EN,
                        SIZE_DETAIL_ONESIZE_EN,
                        SIZE_DETAIL_A1_CN,
                        SIZE_DETAIL_A2_CN,
                        SIZE_DETAIL_A3_CN,
                        SIZE_DETAIL_A4_CN,
                        SIZE_DETAIL_A5_CN,
                        SIZE_DETAIL_ONESIZE_CN,
                        CARE_KR,
                        CARE_EN,
                        CARE_CN,
                        DETAIL_KR,
                        DETAIL_EN,
                        DETAIL_CN,
                        MD_CATEGORY_1, 
                        MD_CATEGORY_2, 
                        MD_CATEGORY_3, 
                        MD_CATEGORY_4, 
                        MD_CATEGORY_5, 
                        MD_CATEGORY_6, 
                        CATEGORY_IDX, 
                        PRICE_KR, 
                        PRICE_KR_GB, 
                        PRICE_EN, 
                        PRICE_CN, 
                        CREATER, 
                        UPDATER
                    )
                VALUES(
                        'BASIC',
                        '".$val[2]."',
                        '".$val[3]."',
                        '".$val[4]."',
                        '".$val[5]."',
                        '".$val[6]."',
                        '".$val[7]."',
                        '".$val[8]."',
                        '".$val[9]."',
                        '".$val[10]."',
                        '".$val[11]."',
                        '".$val[12]."',
                        '".$val[13]."',
                        '".$val[14]."',
                        '".$val[15]."',
                        '".$val[16]."',
                        '".$val[17]."',
                        '".preg_replace('/\r\n|\r|\n/','<br>',$val[18])."',
                        '".preg_replace('/\r\n|\r|\n/','<br>',$val[19])."',
                        '".preg_replace('/\r\n|\r|\n/','<br>',$val[20])."',
                        '".$val[21]."',
                        '".$val[22]."',
                        '".preg_replace('/\r\n|\r|\n/','<br>',$val[23])."',
                        '".preg_replace('/\r\n|\r|\n/','<br>',$val[24])."',
                        '".preg_replace('/\r\n|\r|\n/','<br>',$val[25])."',
                        '".preg_replace('/\r\n|\r|\n/','<br>',$val[26])."',
                        '".preg_replace('/\r\n|\r|\n/','<br>',$val[27])."',
                        '".preg_replace('/\r\n|\r|\n/','<br>',$val[28])."',
                        '".preg_replace('/\r\n|\r|\n/','<br>',$val[29])."',
                        '".preg_replace('/\r\n|\r|\n/','<br>',$val[30])."',
                        '".preg_replace('/\r\n|\r|\n/','<br>',$val[31])."',
                        '".preg_replace('/\r\n|\r|\n/','<br>',$val[32])."',
                        '".preg_replace('/\r\n|\r|\n/','<br>',$val[33])."',
                        '".preg_replace('/\r\n|\r|\n/','<br>',$val[34])."',
                        '".preg_replace('/\r\n|\r|\n/','<br>',$val[35])."',
                        '".preg_replace('/\r\n|\r|\n/','<br>',$val[36])."',
                        '".preg_replace('/\r\n|\r|\n/','<br>',$val[37])."',
                        '".preg_replace('/\r\n|\r|\n/','<br>',$val[38])."',
                        '".preg_replace('/\r\n|\r|\n/','<br>',$val[39])."',
                        '".preg_replace('/\r\n|\r|\n/','<br>',$val[40])."',
                        '".preg_replace('/\r\n|\r|\n/','<br>',$val[41])."',
                        '".preg_replace('/\r\n|\r|\n/','<br>',$val[42])."',
                        '".preg_replace('/\r\n|\r|\n/','<br>',$val[43])."',
                        '".preg_replace('/\r\n|\r|\n/','<br>',$val[44])."',
                        '".preg_replace('/\r\n|\r|\n/','<br>',$val[45])."',
                        '".preg_replace('/\r\n|\r|\n/','<br>',$val[46])."',
                        0,
                        0,
                        0,
                        0,
                        0,
                        0,
                        0,
                        ".$val[47].",
                        ".$val[48].",
                        ".round($val[49],2).",
                        ".round($val[50],2).",
                        '".(count($option_set_array)>0?implode(',',$option_set_array):null)."',
                        'Admin',
                        'Admin'
                    )
                ";
                $db->query($product_insert_sql);
                $product_idx = $db->last_id();
            }
            //update
            else{
                $where_value = $val[3];
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
                    
                    'UPDATER'                   =>'Admin',
                    'UPDATE_DATE'               =>date("Y-m-d H:i:s",time())
                );
                $db->update('dev.SHOP_PRODUCT',$values,$where,array($val[3]));
                $db->query('SELECT IDX FROM dev.SHOP_PRODUCT WHERE PRODUCT_CODE = "'.$val[3].'" ');
                foreach( $db->fetch() as $data){
                    $product_idx = $data['IDX'];
                }
            }
            if($product_idx > 0 && $product_idx != null) {
                $product_info[$val[3]]['PRODUCT_CODE'] = $val[3];
                $product_info[$val[3]]['PRODUCT_IDX'] = $product_idx;
                array_push($product_true, array('product_code' => $val[3], 'product_name' => $val[11], 'row_num' => $key + $excel_start_row));

                if($option_info_arr[$val[3]] != null){
                    foreach($option_info_arr[$val[3]] as $option_data){
                        $option_cnt = $db->count("dev.PRODUCT_OPTION", "OPTION_CODE='".$option_data[1][0]."_".$option_data[1][1]."'");
                        if($option_cnt == 0){
                            $option_info_query = "
                                INSERT INTO dev.PRODUCT_OPTION
                                    (   OPTION_CODE,
                                        OPTION_NAME,
                                        PRODUCT_IDX,
                                        PRODUCT_CODE,
                                        STOCK_GRADE,
                                        CATEGORY_NAME,
                                        SIZE_INFO_1,
                                        SIZE_INFO_2,
                                        SIZE_INFO_3,
                                        SIZE_INFO_4,
                                        SIZE_INFO_5,
                                        SIZE_INFO_6
                                    )
                                VALUES (
                                    '".$option_data[1][0]."_".$option_data[1][1]."',
                                    '".$option_data[1][1]."',
                                    ".$product_idx.",
                                    '".$option_data[1][0]."',
                                    '".$option_data[1][2]."',
                                    '".$option_data[1][3]."',

                                    '".$option_data[1][4]."',
                                    '".$option_data[1][5]."',
                                    '".$option_data[1][6]."',
                                    '".$option_data[1][7]."',
                                    '".$option_data[1][8]."',
                                    '".$option_data[1][9]."',
                                )
                            ";
                            $db->query($option_info_query);
                        }
                        else{
                            $option_info_query = "
                                UPDATE dev.PRODUCT_OPTION
                                SET
                                    STOCK_GRADE         = '".$option_data[1][2]."',
                                    CATEGORY_NAME       = '".$option_data[1][3]."',
                                    SIZE_INFO_1         = '".$option_data[1][4]."',
                                    SIZE_INFO_2         = '".$option_data[1][5]."',
                                    SIZE_INFO_3         = '".$option_data[1][6]."',
                                    SIZE_INFO_4         = '".$option_data[1][7]."',
                                    SIZE_INFO_5         = '".$option_data[1][8]."',
                                    SIZE_INFO_6         = '".$option_data[1][9]."'
                                WHERE
                                    OPTION_CODE         = '".$option_data[1][0]."_".$option_data[1][1]."'
                            ";
                            $db->query($option_info_query);
                        }
                    }
                }
            }
            else{
                array_push($product_false, array('product_code' => $val[3], 'product_name' => $val[11], 'row_num' => $key + $excel_start_row));
            }
        }
    }
    $json_result['result']['product']['true']     = $product_true;
    $json_result['result']['product']['false']     = $product_false;
}

$option_info_true = array();    //size옵션 등록 성공
$option_info_false = array();

foreach($option_info_arr as $key => $val){
    foreach($option_info_arr[$key] as $option_key => $option_val){
        if($product_info[$key] != null){
            array_push($option_info_true, array('product_code' => $key, 'option_name' => $option_key, 'row_num' => $option_val[0]));
        }
        else{
            array_push($option_info_false, array('product_code' => $key, 'option_name' => $option_key, 'row_num' => $option_val[0], 'reason' => '오더시트에 상품이 없습니다.'));
        }     
    }
}
$json_result['result']['option_info']['true']     = $option_info_true;
$json_result['result']['option_info']['false']     = $option_info_false;

$sales_info_true = array();     //상품옵션 등록 성공
$sales_info_false = array();    //상품옵션 등록 실패
$sales_info_product_code = null;

if($sales_info_sheet != null && count($sales_info_sheet) != 0){
    $excel_start_row = 11;
    for ($i=0; $i<count($sales_info_sheet); $i++) {
        $where = 'PRODUCT_CODE = ?';
        $current_code = $sales_info_sheet[$i][0];
        
        if ($sales_info_product_code != $current_code) {
            if ($product_info[$current_code] == null) {
                array_push($sales_info_false, array('product_code' => $current_code, 'row_num' => $i + $excel_start_row, 'reason' => '오더시트에 없는 상품코드입니다.'));
                continue;
            } else {
                $sales_info_product_code = $current_code;
            }
        }
        $values = array(
            'LIMIT_PURCHASE_MEMBER'     =>($sales_info_sheet[$i][1]!=null?$sales_info_sheet[$i][1]:'0'),
            'LIMIT_PURCHASE_SINGLE'     =>($sales_info_sheet[$i][2]!=null?$sales_info_sheet[$i][2]:0),
            'LIMIT_PURCHASE_QTY_MIN_NUM'=>($sales_info_sheet[$i][3]!=null?$sales_info_sheet[$i][3]:1),
            'LIMIT_PURCHASE_QTY_MAX_NUM'=>($sales_info_sheet[$i][4]!=null?$sales_info_sheet[$i][4]:0),
            'PRODUCT_KEYWORD'           =>$sales_info_sheet[$i][5],
            'PRODUCT_TAG'               =>$sales_info_sheet[$i][6],
    
            'PRODUCT_TOTAL_WEIGHT'      =>($sales_info_sheet[$i][8]!=null?$$sales_info_sheet[$i][8]:'0'),
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
        $db->update('dev.SHOP_PRODUCT', $values,$where,array($current_code));
        array_push($sales_info_true, array('product_code' => $current_code, 'row_num' => $i + $excel_start_row));
        /*
        쿼리가 실행되지 못했을 경우의 조건 추가 개발 필요
        */
    }
    $json_result['result']['sales_info']['true']      = $sales_info_true;
    $json_result['result']['sales_info']['false']     = $sales_info_false;
}

$img_true = array();    //이미지 등록 성공
$img_false = array();   //이미지 등록 실패

$path = "/var/www/admin/www/images/product/";
$img_product_code = null;
if ($img_sheet != null) {
    $excel_start_row = 1;
    for ($i=1; $i<count($img_sheet); $i++) {
        $current_code = $img_sheet[$i][0];
        
        //print_r($product_info);
        if ($img_product_code != $current_code) {
            if ($product_info[$current_code] == null) {
                array_push($img_false, $current_code);
                continue;
            } else {
                $img_product_code = $current_code;
            }
        }
        
        $product_idx = $product_info[$img_product_code]['PRODUCT_IDX'];
        
        $upload_file_1 = array("img_size" => "org", "filename" => null);
        $upload_file_2 = array("img_size" => "mdl", "filename" => "img_product_outfit_BLASSSL01BK_mdl_1661773068.png");
        $upload_file_3 = array("img_size" => "sml", "filename" => "img_product_outfit_BLASSSL01BK_sml_1661773068.png");
        $upload_file_4 = array("img_size" => "org", "filename" => null);
        $upload_file_5 = array("img_size" => "mdl", "filename" => "img_product_product_BLASSSL01SM_mdl_1661838023.png");
        $upload_file_6 = array("img_size" => "sml", "filename" => "img_product_product_BLASSSL01SM_sml_1661838023.png");
        $upload_file_7 = array("img_size" => "org", "filename" => null);
        $upload_file_8 = array("img_size" => "mdl", "filename" => "img_product_wear_BLASSSL01WH_mdl_1661837025.png");
        $upload_file_9 = array("img_size" => "sml", "filename" => "img_product_wear_BLASSSL01WH_sml_1661837025.png");
        //임의로 배열생성 후 진행할 예정
        $upload_file = array($upload_file_1,$upload_file_2,$upload_file_3,$upload_file_4,$upload_file_5,$upload_file_6,$upload_file_7,$upload_file_8,$upload_file_9);
        
        //print_r($upload_file);
        //$upload_file = file_up(???);

        if ($upload_file != null) {
            for ($j=0; $j<count($upload_file); $j++) {
                $img_url = '';
                if($upload_file[$j]['img_size'] == 'org'){
                    $img_url = "''";
                }
                else{
                    $img_url = "'".$path.$upload_file[$j]['filename']."'";
                }
                $insert_sql = "INSERT INTO dev.PRODUCT_IMG (
                                        PRODUCT_IDX,
                                        IMG_TYPE,
                                        PRODUCT_CODE,
                                        IMG_SIZE,
                                        IMG_LOCATION,
                                        IMG_URL,
                                        CREATER,
                                        UPDATER
                                    ) 
                                VALUES (
                                        '".$product_idx."',
                                        '".$img_sheet[$i][1]."',
                                        '".$img_product_code."',
                                        '".$upload_file[$j]['img_size']."',
                                        ".$img_url.",
                                        '".$img_sheet[$i][2]."',
                                        'Admin',
                                        'Admin'
                                    )";
                $db->query($insert_sql);
                
                $img_name_arr = explode( '/', $img_sheet[$i][2] );
                $img_name = $img_name_arr[count($img_name_arr) - 1];

                $img_idx = $db->last_id();
                if ($img_idx != null) {
                    $img_chk = true;
                    foreach( $img_true as $img_data){
                        if($img_data['product_code'] == $current_code && $img_data['img_type'] == $img_sheet[$i][1]){
                            $img_chk = false;
                            break;        
                        }
                    }
                    if($img_chk){
                        
                        array_push($img_true, array(
                            'product_code' => $current_code, 
                            'img_type' => $img_sheet[$i][1], 
                            'img_name' => $img_name, 
                            'row_num' => $i + $excel_start_row)
                        );
                    }
                } 
                else {
                    $img_chk = true;
                    foreach( $img_false as $img_data){
                        if($img_data['product_code'] == $current_code && $img_data['img_type'] == $img_sheet[$i][1]){
                            $img_chk = false;
                            break;        
                        }
                    }
                    if($img_chk){
                        array_push($img_false, array(
                            'product_code' => $current_code, 
                            'img_type' => $img_sheet[$i][1], 
                            'img_name' => $img_name, 
                            'row_num' => $i + $excel_start_row)
                        );
                    }
                }
            }
        }
    }
    $json_result['result']['img']['true']      = $img_true;
    $json_result['result']['img']['false']     = $img_false;
}

