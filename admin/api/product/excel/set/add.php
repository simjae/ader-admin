<?php
/*
 +=============================================================================
 | 
 | 상품관리 : 엑셀-상품업데이트
 | ----------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.02.12
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
include_once("/var/www/admin/api/common/common.php");
$session_id		= sessionCheck();

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

/** 변수 정리 **/
$sheet_str = $_POST['sheet_data'];
$sheet_data = json_decode($sheet_str, true);
$set_regist_sheet = $sheet_data['set_regist_sheet'];
$relevant_sheet = $sheet_data['relevant_sheet'];

$insert_column_arr = array();
$set_product_true = array();     //상품옵션 등록 성공
$set_product_false = array();    //상품옵션 등록 실패

date_default_timezone_set('Asia/Seoul');
if ($set_regist_sheet != NULL && count($set_regist_sheet) != 0) {
    $excel_start_row = 4;
    $success_cnt = 0;
    $db->begin_transaction();
    try {
        foreach ($set_regist_sheet as $key => $val) {
            
            /*
            1~17 : ordersheet coloum
            $val[0] : STYLE_CODE
            $val[1] : COLOR_CODE
            $val[2] : PRODUCT_CODE
            $val[4] : PREORDER_FLG
            $val[6] : REFUND_FLG
            $val[8] : LINE_IDX
            $val[9] : MATERIAL
            $val[10] : GRAPHIC
            $val[11] : FIT
            $val[12] : PRODUCT_NAME
            $val[13] : PRODUCT_SIZE
            $val[14] : COLOR
            $val[15] : COLOR_RGB
            $val[16] : PANTONE_CODE
            $val[18] : WKLA_IDX
            $val[20] : LOAD_BOX_IDX
            $val[21] : LOAD_WEIGHT
            $val[22] : LOAD_QTY
            $val[23] : SUB_MATERIAL_CODE_LIST
            */

            $product_code = NULL;
            $exist_ordersheet_cnt = -1;
            $product_code = $val[2];
            if($product_code != NULL){
                $exist_ordersheet_cnt = $db->count('ORDERSHEET_MST', 'PRODUCT_CODE = "'.$product_code.'" ');
            }
            //insert
            if($exist_ordersheet_cnt == 0){
                
                $style_code = NULL;
                $style_code_arr = array();
                $style_code = $val[0];
                if($style_code != NULL){
                    $style_code_arr[0] = ' STYLE_CODE, ';
                    $style_code_arr[1] = ' "'.$style_code.'", ';
                }

                $color_code = NULL;
                $color_code_arr = array();
                $color_code = $val[1];
                if($color_code != NULL){
                    $color_code_arr[0] = ' COLOR_CODE, ';
                    $color_code_arr[1] = ' "'.$color_code.'", ';
                }

                $product_code = NULL;
                $product_code_arr = array();
                $product_code = $val[2];
                if($product_code != NULL){
                    $product_code_arr[0] = ' PRODUCT_CODE, ';
                    $product_code_arr[1] = ' "'.$product_code.'", ';
                }

                $preorder_code = NULL;
                $preorder_code_arr = array();
                $preorder_code = $val[4];
                if($preorder_code != NULL){
                    $preorder_code_arr[0] = ' PREORDER_FLG, ';
                    $preorder_code_arr[1] = ' '.$preorder_code.', ';
                }

                $refund_flg = NULL;
                $refund_flg_arr = array();
                $refund_flg = $val[6];
                if($refund_flg != NULL){
                    $refund_flg_arr[0] = ' REFUND_FLG, ';
                    $refund_flg_arr[1] = ' '.$refund_flg.', ';
                }

                $refund_flg = NULL;
                $refund_flg_arr = array();
                $refund_flg = $val[8];
                if($refund_flg != NULL){
                    $refund_flg_arr[0] = ' LINE_IDX, ';
                    $refund_flg_arr[1] = ' '.$refund_flg.', ';
                }

                $material = NULL;
                $material_arr = array();
                $material = $val[9];
                if($material != NULL){
                    $material_arr[0] = ' MATERIAL, ';
                    $material_arr[1] = ' "'.$material.'", ';
                }

                $graphic = NULL;
                $graphic_arr = array();
                $graphic = $val[10];
                if($graphic != NULL){
                    $graphic_arr[0] = ' GRAPHIC, ';
                    $graphic_arr[1] = ' "'.$graphic.'", ';
                }

                $fit = NULL;
                $fit_arr = array();
                $fit = $val[11];
                if($fit != NULL){
                    $fit_arr[0] = ' FIT, ';
                    $fit_arr[1] = ' "'.$fit.'", ';
                }

                $product_name = NULL;
                $product_name_arr = array();
                $product_name = $val[12];
                if($product_name != NULL){
                    $product_name_arr[0] = ' PRODUCT_NAME, ';
                    $product_name_arr[1] = ' "'.$product_name.'", ';
                }

                $product_size = NULL;
                $product_size_arr = array();
                $product_size = $val[13];
                if($product_size != NULL){
                    $product_size_arr[0] = ' PRODUCT_SIZE, ';
                    $product_size_arr[1] = ' "'.$product_size.'", ';
                }

                $color = NULL;
                $color_arr = array();
                $color = $val[14];
                if($color != NULL){
                    $color_arr[0] = ' COLOR, ';
                    $color_arr[1] = ' "'.$color.'", ';
                }

                $color_rgb = NULL;
                $color_rgb_arr = array();
                $color_rgb = $val[15];
                if($color_rgb != NULL){
                    $color_rgb_arr[0] = ' COLOR_RGB, ';
                    $color_rgb_arr[1] = ' "'.$color_rgb.'", ';
                }

                $pantone_code = NULL;
                $pantone_code_arr = array();
                $pantone_code = $val[16];
                if($pantone_code != NULL){
                    $pantone_code_arr[0] = ' PANTONE_CODE, ';
                    $pantone_code_arr[1] = ' "'.$pantone_code.'", ';
                }

                $wkla_idx = NULL;
                $wkla_idx_arr = array();
                $wkla_idx = $val[18];
                if($wkla_idx != NULL){
                    $wkla_idx_arr[0] = ' WKLA_IDX, ';
                    $wkla_idx_arr[1] = ' '.$wkla_idx.', ';
                }

                $load_box_idx = NULL;
                $load_box_idx_arr = array();
                $load_box_idx = $val[20];
                if($load_box_idx != NULL){
                    $load_box_idx_arr[0] = ' LOAD_BOX_IDX, ';
                    $load_box_idx_arr[1] = ' '.$load_box_idx.', ';
                }

                $load_weight = NULL;
                $load_weight_arr = array();
                $load_weight = $val[21];
                if($load_weight != NULL){
                    $load_weight_arr[0] = ' LOAD_WEIGHT, ';
                    $load_weight_arr[1] = ' '.$load_weight.', ';
                }

                $load_qty = NULL;
                $load_qty_arr = array();
                $load_qty = $val[22];
                if($load_qty != NULL){
                    $load_qty_arr[0] = ' LOAD_QTY, ';
                    $load_qty_arr[1] = ' '.$load_qty.', ';
                }
                
                $regist_ordersheet_sql = "
                    INSERT INTO ORDERSHEET_MST
                    (
                        ".$style_code_arr[0]."
                        ".$color_code_arr[0]."
                        ".$product_code_arr[0]."
                        ".$preorder_flg_arr[0]."
                        ".$refund_flg_arr[0]."
                        ".$line_idx_arr[0]."
                        ".$material_arr[0]."
                        ".$graphic_arr[0]."
                        ".$fit_arr[0]."
                        ".$product_name_arr[0]."
                        ".$product_size_arr[0]."
                        ".$color_arr[0]."
                        ".$color_rgb_arr[0]."
                        ".$pantone_code_arr[0]."
                        ".$wkla_idx_arr[0]."
                        ".$load_box_idx_arr[0]."
                        ".$load_weight_arr[0]."
                        ".$load_qty_arr[0]."
                        ".$sub_material_idx_arr[0]."
                        creater,
                        updater
                    )
                    VALUES
                    (
                        ".$style_code_arr[1]."
                        ".$color_code_arr[1]."
                        ".$product_code_arr[1]."
                        ".$preorder_flg_arr[1]."
                        ".$refund_flg_arr[1]."
                        ".$line_idx_arr[1]."
                        ".$material_arr[1]."
                        ".$graphic_arr[1]."
                        ".$fit_arr[1]."
                        ".$product_name_arr[1]."
                        ".$product_size_arr[1]."
                        ".$color_arr[1]."
                        ".$color_rgb_arr[1]."
                        ".$pantone_code_arr[1]."
                        ".$wkla_idx_arr[1]."
                        ".$load_box_idx_arr[1]."
                        ".$load_weight_arr[1]."
                        ".$load_qty_arr[1]."
                        ".$sub_material_idx_arr[1]."
                        '".$session_id."',
                        '".$session_id."'
                    )
                ";
                
                $db->query($regist_ordersheet_sql);

                $ordersheet_idx = NULL;
                $ordersheet_idx = $db->last_id();

                //오더시트 등록 성공시, 세트 상품 등록작업 시작
                if(!empty($ordersheet_idx)){
                    $sub_material_code_list = NULL;
                    $sub_material_code_list = $val[23];
                    if($sub_material_code_list != NULL){
                        $sub_code_arr = array();
                        $sub_code_arr = array_map('makeVarchar',explode(',',$sub_material_code_list));
                        $sub_info_get_sql = "
                            INSERT INTO SUB_MATERIAL_MAPPING
                            (
                                SUB_MATERIAL_IDX,
                                SUB_MATERIAL_TYPE,
                                ORDERSHEET_IDX
                            )
                            SELECT 
                                IDX,
                                SUB_MATERIAL_TYPE,
                                ".$ordersheet_idx."
                            FROM
                                SUB_MATERIAL_INFO
                            WHERE
                                SUB_MATERIAL_CODE IN (".implode(',',$sub_code_arr).") 
                        ";
                        $db->query($sub_info_get_sql);
                    }
                    /*
                    24~86 : set product coloum
                    $val[24] : PRODUCT_NAME
                    $val[26] : MD_CATEGORY_1
                    $val[28] : MD_CATEGORY_2
                    $val[30] : MD_CATEGORY_3
                    $val[32] : MD_CATEGORY_4
                    $val[34] : MD_CATEGORY_5
                    $val[36] : MD_CATEGORY_6
                    $val[38] : MILEAGE_FLG
                    $val[40] : EXCLUSIVE_FLG
                    $val[41] : PRICE_KR
                    $val[42] : SALES_PRICE_KR
                    $val[43] : DISCOUNT_KR
                    $val[44] : PRICE_EN
                    $val[45] : SALES_PRICE_EN
                    $val[46] : DISCOUNT_EN
                    $val[47] : PRICE_CN
                    $val[48] : SALES_PRICE_CN
                    $val[49] : DISCOUNT_CN
                    $val[51] : LIMIT_ID_FLG
                    $val[52] : REORDER_CNT
                    $val[54] : LIMIT_PURCHASE_QTY_FLG
                    $val[55] : LIMIT_PRODUCT_QTY

                    $val[56] : PRODUCT_KEYWORD
                    $val[57] : PRODUCT_TAG
                    $val[59] : CLEARANCE_IDX
                    $val[60] : SOLD_OUT_QTY
                    $val[61] : CARE_KR
                    $val[62] : CARE_EN
                    $val[63] : CARE_CN
                    $val[64] : DETAIL_KR
                    $val[65] : DETAIL_EN
                    $val[66] : DETAIL_CN
                    $val[67] : MATERIAL_KR
                    $val[68] : MATERIAL_EN
                    $val[69] : MATERIAL_CN
                    $val[71] : REFUND_FLG
                    $val[73] : REFUND_MSG_FLG
                    $val[74] : REFUND_MSG
                    $val[75] : REFUND_KR
                    $val[76] : REFUND_EN
                    $val[77] : REFUND_CN
                    $val[78] : MEMO
                    $val[80] : SEO_EXPOSURE_FLG
                    $val[81] : SEO_TITLE
                    $val[82] : SEO_AUTHOR
                    $val[83] : SEO_DESCRIPTION
                    $val[84] : SEO_KEYWORDS
                    $val[85] : SEO_ALT_TEXT
                    $val[87] : FILTER_FT
                    $val[89] : FILTER_GP
                    $val[91] : FILTER_LN
                    */
                    
                    $product_name = NULL;
                    $product_name_arr = array();
                    $product_name = $val[24];
                    if($product_name != NULL){
                        $product_name_arr[0] = ' PRODUCT_NAME, ';
                        $product_name_arr[1] = ' "'.$product_name.'", ';
                    }

                    $sale_flg = NULL;
                    $sale_flg_arr = array();
                    $sale_flg = $val[26];
                    if($sale_flg != NULL){
                        $sale_flg_arr[0] = ' SALE_FLG, ';
                        $sale_flg_arr[1] = ' "'.$sale_flg.'", ';
                    }

                    $md_category_idx = '0'; 

                    $md_category_1 = NULL;
                    $md_category_1_arr = array();
                    $md_category_1 = $val[28];
                    if($md_category_1 != NULL){
                        $md_category_1_arr[0] = ' MD_CATEGORY_1, ';
                        $md_category_1_arr[1] = ' '.$md_category_1.', ';

                        $md_category_idx = $md_category_1;
                    }

                    $md_category_2 = NULL;
                    $md_category_2_arr = array();
                    $md_category_2 = $val[30];
                    if($md_category_2 != NULL){
                        $md_category_2_arr[0] = ' MD_CATEGORY_2, ';
                        $md_category_2_arr[1] = ' '.$md_category_2.', ';

                        $md_category_idx = $md_category_2;
                    }

                    $md_category_3 = NULL;
                    $md_category_3_arr = array();
                    $md_category_3 = $val[32];
                    if($md_category_3 != NULL){
                        $md_category_3_arr[0] = ' MD_CATEGORY_3, ';
                        $md_category_3_arr[1] = ' '.$md_category_3.', ';

                        $md_category_idx = $md_category_3;
                    }

                    $md_category_4 = NULL;
                    $md_category_4_arr = array();
                    $md_category_4 = $val[34];
                    if($md_category_4 != NULL){
                        $md_category_4_arr[0] = ' MD_CATEGORY_4, ';
                        $md_category_4_arr[1] = ' '.$md_category_4.', ';

                        $md_category_idx = $md_category_4;
                    }

                    $md_category_5 = NULL;
                    $md_category_5_arr = array();
                    $md_category_5 = $val[36];
                    if($md_category_5 != NULL){
                        $md_category_5_arr[0] = ' MD_CATEGORY_5, ';
                        $md_category_5_arr[1] = ' '.$md_category_5.', ';

                        $md_category_idx = $md_category_5;
                    }

                    $md_category_6 = NULL;
                    $md_category_6_arr = array();
                    $md_category_6 = $val[38];
                    if($md_category_6 != NULL){
                        $md_category_6_arr[0] = ' MD_CATEGORY_6, ';
                        $md_category_6_arr[1] = ' '.$md_category_6.', ';

                        $md_category_idx = $md_category_6;
                    }

                    $md_category_idx_arr = array();
                    $md_category_idx_arr[0] = ' CATEGORY_IDX, ';
                    $md_category_idx_arr[1] = ' '.$md_category_idx.', ';

                    $mileage_flg = NULL;
                    $mileage_flg_arr = array();
                    $mileage_flg = $val[40];
                    if($mileage_flg != NULL){
                        $mileage_flg_arr[0] = ' MILEAGE_FLG, ';
                        $mileage_flg_arr[1] = ' '.$mileage_flg.', ';
                    }

                    $exclusive_flg = NULL;
                    $exclusive_flg_arr = array();
                    $exclusive_flg = $val[42];
                    if($exclusive_flg != NULL){
                        $exclusive_flg_arr[0] = ' EXCLUSIVE_FLG, ';
                        $exclusive_flg_arr[1] = ' '.$exclusive_flg.', ';
                    }

                    $price_kr = NULL;
                    $price_kr_arr = array();
                    $price_kr = $val[43];
                    if($price_kr != NULL){
                        $price_kr_arr[0] = ' PRICE_KR, ';
                        $price_kr_arr[1] = ' '.$price_kr.', ';
                    }

                    $sales_price_kr = NULL;
                    $sales_price_kr_arr = array();
                    $sales_price_kr = $val[44];
                    if($sales_price_kr != NULL){
                        $sales_price_kr_arr[0] = ' SALES_PRICE_KR, ';
                        $sales_price_kr_arr[1] = ' '.$sales_price_kr.', ';
                    }

                    $discount_kr = NULL;
                    $discount_kr_arr = array();
                    $discount_kr = $val[45];
                    if($discount_kr != NULL){
                        $discount_kr_arr[0] = ' DISCOUNT_KR, ';
                        $discount_kr_arr[1] = ' '.$discount_kr.', ';
                    }

                    $price_en = NULL;
                    $price_en_arr = array();
                    $price_en = $val[46];
                    if($price_en != NULL){
                        $price_en_arr[0] = ' PRICE_EN, ';
                        $price_en_arr[1] = ' '.$price_en.', ';
                    }

                    $sales_price_en = NULL;
                    $sales_price_en_arr = array();
                    $sales_price_en = $val[47];
                    if($sales_price_en != NULL){
                        $sales_price_en_arr[0] = ' SALES_PRICE_EN, ';
                        $sales_price_en_arr[1] = ' '.$sales_price_en.', ';
                    }

                    $discount_en = NULL;
                    $discount_en_arr = array();
                    $discount_en = $val[48];
                    if($discount_en != NULL){
                        $discount_en_arr[0] = ' DISCOUNT_EN, ';
                        $discount_en_arr[1] = ' '.$discount_en.', ';
                    }

                    $price_cn = NULL;
                    $price_cn_arr = array();
                    $price_cn = $val[49];
                    if($price_cn != NULL){
                        $price_cn_arr[0] = ' PRICE_CN, ';
                        $price_cn_arr[1] = ' '.$price_cn.', ';
                    }

                    $sales_price_cn = NULL;
                    $sales_price_cn_arr = array();
                    $sales_price_cn = $val[50];
                    if($sales_price_cn != NULL){
                        $sales_price_cn_arr[0] = ' SALES_PRICE_CN, ';
                        $sales_price_cn_arr[1] = ' '.$sales_price_cn.', ';
                    }

                    $discount_cn = NULL;
                    $discount_cn_arr = array();
                    $discount_cn = $val[51];
                    if($discount_cn != NULL){
                        $discount_cn_arr[0] = ' DISCOUNT_CN, ';
                        $discount_cn_arr[1] = ' '.$discount_cn.', ';
                    }


                    $limit_id_flg = NULL;
                    $limit_id_flg_arr = array();
                    $limit_id_flg = $val[53];
                    if($limit_id_flg != NULL){
                        $limit_id_flg_arr[0] = ' LIMIT_ID_FLG, ';
                        $limit_id_flg_arr[1] = ' '.$limit_id_flg.', ';
                    }

                    $reorder_cnt = NULL;
                    $reorder_cnt_arr = array();
                    $reorder_cnt = $val[54];
                    if($reorder_cnt != NULL){
                        $reorder_cnt_arr[0] = ' REORDER_CNT, ';
                        $reorder_cnt_arr[1] = ' '.$reorder_cnt.', ';
                    }

                    $limit_purchase_qty_flg = NULL;
                    $limit_purchase_qty_flg_arr = array();
                    $limit_purchase_qty_flg = $val[56];
                    if($limit_purchase_qty_flg != NULL){
                        $limit_purchase_qty_flg_arr[0] = ' LIMIT_PURCHASE_QTY_FLG, ';
                        $limit_purchase_qty_flg_arr[1] = ' '.$limit_purchase_qty_flg.', ';
                    }

                    $limit_product_qty = NULL;
                    $limit_product_qty_arr = array();
                    $limit_product_qty = $val[57];
                    if($limit_product_qty != NULL){
                        $limit_product_qty_arr[0] = ' LIMIT_PRODUCT_QTY, ';
                        $limit_product_qty_arr[1] = ' '.$limit_product_qty.', ';
                    }


                    $product_keyword = NULL;
                    $product_keyword_arr = array();
                    $product_keyword = $val[58];
                    if($product_keyword != NULL){
                        $product_keyword_arr[0] = ' PRODUCT_KEYWORD, ';
                        $product_keyword_arr[1] = ' "'.$product_keyword.'", ';
                    }

                    $product_tag = NULL;
                    $product_tag_arr = array();
                    $product_tag = $val[59];
                    if($product_tag != NULL){
                        $product_tag_arr[0] = ' PRODUCT_TAG, ';
                        $product_tag_arr[1] = ' "'.$product_tag.'", ';
                    }

                    $clearance_code = NULL;
                    $clearance_idx_arr = array();
                    $clearance_code = $val[61];
                    if($clearance_code != NULL){
                        $clearance_idx = 0;
                        $db->query('SELECT IDX FROM CUSTOM_CLEARANCE WHERE HS_CODE = "' . $clearance_code . '" ');
                        foreach($db->fetch() as $clearance_info){
                            $clearance_idx = $clearance_info['IDX'];
                        }
                        $clearance_idx_arr[0] = ' CLEARANCE_IDX, ';
                        $clearance_idx_arr[1] = ' '.$clearance_idx.', ';
                    }

                    $sold_out_flg = NULL;
                    $sold_out_flg_arr = array();
                    $sold_out_flg = $val[63];
                    if($sold_out_flg != NULL){
                        $sold_out_flg_arr[0] = ' SOLD_OUT_FLG, ';
                        $sold_out_flg_arr[1] = ' '.$sold_out_flg.', ';
                    }

                    $sold_out_qty = NULL;
                    $sold_out_qty_arr = array();
                    $sold_out_qty = $val[64];
                    if($sold_out_qty != NULL){
                        $sold_out_qty_arr[0] = ' SOLD_OUT_QTY, ';
                        $sold_out_qty_arr[1] = ' '.$sold_out_qty.', ';
                    }

                    $care_kr = NULL;
                    $care_kr_arr = array();
                    $care_kr = $val[65];
                    if($care_kr != NULL){
                        $care_kr_arr[0] = ' CARE_KR, ';
                        $care_kr_arr[1] = ' "'.$care_kr.'", ';
                    }

                    $care_en = NULL;
                    $care_en_arr = array();
                    $care_en = $val[66];
                    if($care_en != NULL){
                        $care_en_arr[0] = ' CARE_EN, ';
                        $care_en_arr[1] = ' "'.$care_en.'", ';
                    }

                    $care_cn = NULL;
                    $care_cn_arr = array();
                    $care_cn = $val[67];
                    if($care_cn != NULL){
                        $care_cn_arr[0] = ' CARE_CN, ';
                        $care_cn_arr[1] = ' "'.$care_cn.'", ';
                    }

                    $detail_kr = NULL;
                    $detail_kr_arr = array();
                    $detail_kr = $val[68];
                    if($detail_kr != NULL){
                        $detail_kr_arr[0] = ' DETAIL_KR, ';
                        $detail_kr_arr[1] = ' "'.$detail_kr.'", ';
                    }

                    $detail_en = NULL;
                    $detail_en_arr = array();
                    $detail_en = $val[69];
                    if($detail_en != NULL){
                        $detail_en_arr[0] = ' DETAIL_EN, ';
                        $detail_en_arr[1] = ' "'.$detail_en.'", ';
                    }

                    $detail_cn = NULL;
                    $detail_cn_arr = array();
                    $detail_cn = $val[70];
                    if($detail_cn != NULL){
                        $detail_cn_arr[0] = ' DETAIL_CN, ';
                        $detail_cn_arr[1] = ' "'.$detail_cn.'", ';
                    }

                    $material_kr = NULL;
                    $material_kr_arr = array();
                    $material_kr = $val[71];
                    if($material_kr != NULL){
                        $material_kr_arr[0] = ' MATERIAL_KR, ';
                        $material_kr_arr[1] = ' "'.$material_kr.'", ';
                    }

                    $material_en = NULL;
                    $material_en_arr = array();
                    $material_en = $val[72];
                    if($material_en != NULL){
                        $material_en_arr[0] = ' MATERIAL_EN, ';
                        $material_en_arr[1] = ' "'.$material_en.'", ';
                    }

                    $material_cn = NULL;
                    $material_cn_arr = array();
                    $material_cn = $val[73];
                    if($material_cn != NULL){
                        $material_cn_arr[0] = ' MATERIAL_CN, ';
                        $material_cn_arr[1] = ' "'.$material_cn.'", ';
                    }

                    $refund_flg = NULL;
                    $refund_flg_arr = array();
                    $refund_flg = $val[75];
                    if($refund_flg != NULL){
                        $refund_flg_arr[0] = ' REFUND_FLG, ';
                        $refund_flg_arr[1] = ' '.$refund_flg.', ';
                    }

                    $refund_msg_flg = NULL;
                    $refund_msg_flg_arr = array();
                    $refund_msg_flg = $val[77];
                    if($refund_msg_flg != NULL){
                        $refund_msg_flg_arr[0] = ' REFUND_MSG_FLG, ';
                        $refund_msg_flg_arr[1] = ' '.$refund_msg_flg.', ';
                    }

                    $refund_msg_kr = NULL;
                    $refund_msg_kr_arr = array();
                    $refund_msg_kr = $val[78];
                    if($refund_msg_kr != NULL){
                        $refund_msg_kr_arr[0] = ' REFUND_MSG_KR, ';
                        $refund_msg_kr_arr[1] = ' "'.$refund_msg_kr.'", ';
                    }

                    $refund_msg_en = NULL;
                    $refund_msg_en_arr = array();
                    $refund_msg_en = $val[79];
                    if($refund_msg_en != NULL){
                        $refund_msg_en_arr[0] = ' REFUND_MSG_EN, ';
                        $refund_msg_en_arr[1] = ' "'.$refund_msg_en.'", ';
                    }

                    $refund_msg_cn = NULL;
                    $refund_msg_cn_arr = array();
                    $refund_msg_cn = $val[80];
                    if($refund_msg_cn != NULL){
                        $refund_msg_cn_arr[0] = ' REFUND_MSG_CN, ';
                        $refund_msg_cn_arr[1] = ' "'.$refund_msg_cn.'", ';
                    }

                    $refund_kr = NULL;
                    $refund_kr_arr = array();
                    $refund_kr = $val[81];
                    if($refund_kr != NULL){
                        $refund_kr_arr[0] = ' REFUND_KR, ';
                        $refund_kr_arr[1] = ' "'.$refund_kr.'", ';
                    }

                    $refund_en = NULL;
                    $refund_en_arr = array();
                    $refund_en = $val[82];
                    if($refund_en != NULL){
                        $refund_en_arr[0] = ' REFUND_EN, ';
                        $refund_en_arr[1] = ' "'.$refund_en.'", ';
                    }

                    $refund_cn = NULL;
                    $refund_cn_arr = array();
                    $refund_cn = $val[83];
                    if($refund_cn != NULL){
                        $refund_cn_arr[0] = ' REFUND_CN, ';
                        $refund_cn_arr[1] = ' "'.$refund_cn.'", ';
                    }

                    $memo = NULL;
                    $memo_arr = array();
                    $memo = $val[84];
                    if($memo != NULL){
                        $memo_arr[0] = ' MEMO, ';
                        $memo_arr[1] = ' "'.$memo.'", ';
                    }

                    $seo_exposure_flg = NULL;
                    $seo_exposure_flg_arr = array();
                    $seo_exposure_flg = $val[86];
                    if($seo_exposure_flg != NULL){
                        $seo_exposure_flg_arr[0] = ' SEO_EXPOSURE_FLG, ';
                        $seo_exposure_flg_arr[1] = ' '.$seo_exposure_flg.', ';
                    }

                    $seo_title = NULL;
                    $seo_title_arr = array();
                    $seo_title = $val[87];
                    if($seo_title != NULL){
                        $seo_title_arr[0] = ' SEO_TITLE, ';
                        $seo_title_arr[1] = ' "'.$seo_title.'", ';
                    }

                    $seo_author = NULL;
                    $seo_author_arr = array();
                    $seo_author = $val[88];
                    if($seo_author != NULL){
                        $seo_author_arr[0] = ' SEO_AUTHOR, ';
                        $seo_author_arr[1] = ' "'.$seo_author.'", ';
                    }

                    $seo_description = NULL;
                    $seo_description_arr = array();
                    $seo_description = $val[89];
                    if($seo_description != NULL){
                        $seo_description_arr[0] = ' SEO_DESCRIPTION, ';
                        $seo_description_arr[1] = ' "'.$seo_description.'", ';
                    }

                    $seo_keywords = NULL;
                    $seo_keywords_arr = array();
                    $seo_keywords = $val[90];
                    if($seo_keywords != NULL){
                        $seo_keywords_arr[0] = ' SEO_KEYWORDS, ';
                        $seo_keywords_arr[1] = ' "'.$seo_keywords.'", ';
                    }

                    $seo_alt_text = NULL;
                    $seo_alt_text_arr = array();
                    $seo_alt_text = $val[91];
                    if($seo_alt_text != NULL){
                        $seo_alt_text_arr[0] = ' SEO_ALT_TEXT, ';
                        $seo_alt_text_arr[1] = ' "'.$seo_alt_text.'", ';
                    }

                    $filter_ft = NULL;
                    $filter_ft_arr = array();
                    $filter_ft = $val[93];
                    if($filter_ft != NULL){
                        $filter_ft_arr[0] = ' FILTER_FT, ';
                        $filter_ft_arr[1] = ' '.$filter_ft.', ';
                    }

                    $filter_gp = NULL;
                    $filter_gp_arr = array();
                    $filter_gp = $val[95];
                    if($filter_gp != NULL){
                        $filter_gp_arr[0] = ' FILTER_GP, ';
                        $filter_gp_arr[1] = ' '.$filter_gp.', ';
                    }

                    $filter_ln = NULL;
                    $filter_ln_arr = array();
                    $filter_ln = $val[97];
                    if($filter_ln != NULL){
                        $filter_ln_arr[0] = ' FILTER_LN, ';
                        $filter_ln_arr[1] = ' '.$filter_ln.', ';
                    }

                    $regist_set_product_sql = "
                        INSERT INTO SHOP_PRODUCT
                        (
                            ORDERSHEET_IDX,
                            PRODUCT_TYPE,
                            STYLE_CODE,
                            COLOR_CODE,
                            PRODUCT_CODE,
                            ".$product_name_arr[0]."
                            ".$sale_flg_arr[0]."
                            ".$md_category_1_arr[0]."
                            ".$md_category_2_arr[0]."
                            ".$md_category_3_arr[0]."
                            ".$md_category_4_arr[0]."
                            ".$md_category_5_arr[0]."
                            ".$md_category_6_arr[0]."
                            ".$md_category_idx_arr[0]."
                            ".$mileage_flg_arr[0]."
                            ".$exclusive_flg_arr[0]."
                            ".$price_kr_arr[0]."
                            ".$sales_price_kr_arr[0]."
                            ".$discount_kr_arr[0]."
                            ".$price_en_arr[0]."
                            ".$sales_price_en_arr[0]."
                            ".$discount_en_arr[0]."
                            ".$price_cn_arr[0]."
                            ".$sales_price_cn_arr[0]."
                            ".$discount_cn_arr[0]."
                            ".$limit_id_flg_arr[0]."
                            ".$reorder_cnt_arr[0]."
                            ".$limit_purchase_qty_flg_arr[0]."
                            ".$limit_product_qty_arr[0]."
                            ".$product_keyword_arr[0]."
                            ".$product_tag_arr[0]."
                            ".$clearance_idx_arr[0]."
                            ".$relevant_idx_arr[0]."
                            ".$sold_out_flg_arr[0]."
                            ".$sold_out_qty_arr[0]."
                            ".$care_kr_arr[0]."
                            ".$care_en_arr[0]."
                            ".$care_cn_arr[0]."
                            ".$detail_kr_arr[0]."
                            ".$detail_en_arr[0]."
                            ".$detail_cn_arr[0]."
                            ".$material_kr_arr[0]."
                            ".$material_en_arr[0]."
                            ".$material_cn_arr[0]."
                            ".$refund_flg_arr[0]."
                            ".$refund_msg_flg_arr[0]."
                            ".$refund_msg_kr_arr[0]."
                            ".$refund_msg_en_arr[0]."
                            ".$refund_msg_cn_arr[0]."
                            ".$refund_kr_arr[0]."
                            ".$refund_en_arr[0]."
                            ".$refund_cn_arr[0]."
                            ".$memo_arr[0]."
                            ".$seo_exposure_flg_arr[0]."
                            ".$seo_title_arr[0]."
                            ".$seo_author_arr[0]."
                            ".$seo_description_arr[0]."
                            ".$seo_keywords_arr[0]."
                            ".$seo_alt_text_arr[0]."
                            ".$filter_ft_arr[0]."
                            ".$filter_gp_arr[0]."
                            ".$filter_ln_arr[0]."
                            creater,
                            updater
                        )
                        VALUES
                        (
                            ".$ordersheet_idx.",
                            'S',
                            '".$val[0]."',
                            '".$val[1]."',
                            '".$val[2]."',
                            ".$product_name_arr[1]."
                            ".$sale_flg_arr[1]."
                            ".$md_category_1_arr[1]."
                            ".$md_category_2_arr[1]."
                            ".$md_category_3_arr[1]."
                            ".$md_category_4_arr[1]."
                            ".$md_category_5_arr[1]."
                            ".$md_category_6_arr[1]."
                            ".$md_category_idx_arr[1]."
                            ".$mileage_flg_arr[1]."
                            ".$exclusive_flg_arr[1]."
                            ".$price_kr_arr[1]."
                            ".$sales_price_kr_arr[1]."
                            ".$discount_kr_arr[1]."
                            ".$price_en_arr[1]."
                            ".$sales_price_en_arr[1]."
                            ".$discount_en_arr[1]."
                            ".$price_cn_arr[1]."
                            ".$sales_price_cn_arr[1]."
                            ".$discount_cn_arr[1]."
                            ".$limit_id_flg_arr[1]."
                            ".$reorder_cnt_arr[1]."
                            ".$limit_purchase_qty_flg_arr[1]."
                            ".$limit_product_qty_arr[1]."
                            ".$product_keyword_arr[1]."
                            ".$product_tag_arr[1]."
                            ".$clearance_idx_arr[1]."
                            ".$relevant_idx_arr[1]."
                            ".$sold_out_flg_arr[1]."
                            ".$sold_out_qty_arr[1]."
                            ".$care_kr_arr[1]."
                            ".$care_en_arr[1]."
                            ".$care_cn_arr[1]."
                            ".$detail_kr_arr[1]."
                            ".$detail_en_arr[1]."
                            ".$detail_cn_arr[1]."
                            ".$material_kr_arr[1]."
                            ".$material_en_arr[1]."
                            ".$material_cn_arr[1]."
                            ".$refund_flg_arr[1]."
                            ".$refund_msg_flg_arr[1]."
                            ".$refund_msg_kr_arr[1]."
                            ".$refund_msg_en_arr[1]."
                            ".$refund_msg_cn_arr[1]."
                            ".$refund_kr_arr[1]."
                            ".$refund_en_arr[1]."
                            ".$refund_cn_arr[1]."
                            ".$memo_arr[1]."
                            ".$seo_exposure_flg_arr[1]."
                            ".$seo_title_arr[1]."
                            ".$seo_author_arr[1]."
                            ".$seo_description_arr[1]."
                            ".$seo_keywords_arr[1]."
                            ".$seo_alt_text_arr[1]."
                            ".$filter_ft_arr[1]."
                            ".$filter_gp_arr[1]."
                            ".$filter_ln_arr[1]."
                            '".$session_id."',
                            '".$session_id."'
                        )
                    ";
                    $db->query($regist_set_product_sql);

                    $product_idx == NULL;
                    $product_idx = $db->last_id();

                    if(!empty($product_idx)){
                        $success_cnt++;
                        // makeVarchar(explode(',',$sub_material_code_list));
                        $product_code_arr = NULL;
                        $product_code_arr = $val[99];
                        if($product_code_arr != NULL){
                            $product_code_arr = array_map('makeVarchar',explode(',',$product_code_arr));
                            $product_idx_get_sql = "
                                SELECT 
                                    IDX
                                FROM
                                    SHOP_PRODUCT
                                WHERE
                                    PRODUCT_CODE IN (".implode(',',$product_code_arr).")
                            ";
                            $db->query($product_idx_get_sql);

                            $product_idx_arr = array();
                            foreach($db->fetch() as $prod_data){
                                array_push($product_idx_arr, $prod_data['IDX']);
                            }

                            $barcode_arr = NULL;
                            $barcode_arr = $val[100];
                            if($barcode_arr != NULL){
                                $barcode_arr = array_map('makeVarchar',explode(',',$barcode_arr));
                                foreach($product_idx_arr as $prod_idx){
                                    $option_idx_get_sql = "
                                        SELECT
                                            IDX
                                        FROM
                                            ORDERSHEET_OPTION
                                        WHERE
                                            BARCODE IN (".implode(',',$barcode_arr).")
                                        AND
                                            ORDERSHEET_IDX = (  SELECT 
                                                                    ORDERSHEET_IDX
                                                                FROM
                                                                    SHOP_PRODUCT
                                                                WHERE
                                                                    IDX = ".$prod_idx." )
                                    ";
                                    $db->query($option_idx_get_sql);                                
                                    $option_idx_arr = array();
                                    foreach($db->fetch() as $option_info){
                                        array_push($option_idx_arr, $option_info['IDX']);
                                    }
                                    if(count($option_idx_arr) > 0){
                                        $set_product_sql = "
                                            INSERT INTO SET_PRODUCT
                                            (
                                                SET_PRODUCT_IDX,
                                                PRODUCT_IDX,
                                                OPTION_IDX,
                                                CREATER,
                                                UPDATER
                                            )
                                            VALUES
                                            (
                                                ".$product_idx.",
                                                '.$prod_idx.',
                                                '".implode(',',$option_idx_arr)."',
                                                '".$session_id."',
                                                '".$session_id."'
                                            )
                                        ";
                                        $db->query($set_product_sql);
                                    }                               
                                } 
                            }
                            else{
                                $json_result['code']    = 301;
                                $json_result['msg']     = '세트 구성품 바코드 값이 존재하지 않습니다. 독립몰 상품정보를 다시한번 확인해주세요';
                                $db->rollback();
                                return $json_result;
                            }
                        }
                        else{
                            $json_result['code']    = 301;
                            $json_result['msg']     = '세트 구성품 상품코드 값이 존재하지 않습니다. 독립몰 상품정보를 다시한번 확인해주세요';
                            $db->rollback();
                            return $json_result;
                        }
                    }
                    else{
                        $json_result['code']    = 301;
                        $json_result['msg']     = '세트상품 등록에 실패 했습니다. 독립몰 상품정보를 다시한번 확인해주세요';
                        $db->rollback();
                        return $json_result;
                    }
                }
                else{
                    $json_result['code']    = 301;
                    $json_result['msg']     = '세트상품 등록에 실패 했습니다. 오더시트 정보를 다시한번 확인해주세요';
                    $db->rollback();
                    return $json_result;
                }
            }
            else{
                $json_result['code']    = 301;
                $json_result['msg']     = '중복된 상품코드의 상품이 이미 존재합니다. 정보를 다시한번 확인해주세요';
                $db->rollback();
                return $json_result;
            }
        }
        $json_result['data']['success'] = $success_cnt;
        $db->commit();
    }
    catch(mysqli_sql_exception $exception){
        print_r($exception);
        $json_result['code'] = 301;
        $db->rollback();
        $json_result['msg'] = '세트상품 등록작업이 실패했습니다.';
        return $json_result;
    }
}
else{
    $json_result['code']    = 301;
    $json_result['msg']     = '빈 시트입니다. 파일을 다시 확인해주세요';
    return $json_result;
}


if($relevant_sheet != null && count($relevant_sheet) != 0){
    $excel_start_row = 2;

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
            $db->commit();
        }
    }
    catch(mysqli_sql_exception $exception){
        $json_result['code'] = 301;
        $db->rollback();
        $json_result['msg'] = '관련상품 등록작업이 실패했습니다.';
        return $json_result;
    }
}

function makeVarchar($item){
    $item = "'".$item."'";
    return $item;
}
?>