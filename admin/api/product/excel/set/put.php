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
$set_update_sheet = $sheet_data['set_update_sheet'];

$update_column_arr = array();
$set_product_true = array();     //상품옵션 등록 성공
$set_product_false = array();    //상품옵션 등록 실패

date_default_timezone_set('Asia/Seoul');
$success_cnt = 0;
if ($set_update_sheet != NULL && count($set_update_sheet) != 0) {
    $excel_start_row = 4;

    $db->begin_transaction();
    try {
        foreach ($set_update_sheet as $key => $val) {
            /*
            1~17 : ordersheet coloum
            $val[0] : STYLE_CODE
            $val[1] : COLOR_CODE
            $val[2] : PRODUCT_CODE
            $val[4] : PREORDER_FLG
            $val[7] : REFUND_FLG
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
            if($exist_ordersheet_cnt > 0){

                $style_code = NULL;
                $style_code_str = '';
                $style_code = $val[0];
                if($style_code != NULL){
                    $style_code_str = ' STYLE_CODE = "'.$style_code.'", ';
                }

                $color_code = NULL;
                $color_code_str = '';
                $color_code = $val[1];
                if($color_code != NULL){
                    $color_code_str = ' COLOR_CODE = "'.$color_code.'", ';
                }

                $product_code = NULL;
                $product_code_str = '';
                $product_code = $val[2];
                if($product_code != NULL){
                    $product_code_str = ' PRODUCT_CODE = "'.$product_code.'", ';
                }

                $preorder_code = NULL;
                $preorder_code_str = '';
                $preorder_code = $val[4];
                if($preorder_code != NULL){
                    $preorder_code_str = ' PREORDER_FLG = '.$preorder_code.', ';
                }

                $refund_flg = NULL;
                $refund_flg_str = '';
                $refund_flg = $val[6];
                if($refund_flg != NULL){
                    $refund_flg_str = ' REFUND_FLG = '.$refund_flg.', ';
                }

                $refund_flg = NULL;
                $refund_flg_str = '';
                $refund_flg = $val[8];
                if($refund_flg != NULL){
                    $refund_flg_str = ' LINE_IDX = '.$refund_flg.', ';
                }

                $material = NULL;
                $material_str = '';
                $material = $val[9];
                if($material != NULL){
                    $material_str = ' MATERIAL = "'.$material.'", ';
                }

                $graphic = NULL;
                $graphic_str = '';
                $graphic = $val[10];
                if($graphic != NULL){
                    $graphic_str = ' GRAPHIC = "'.$graphic.'", ';
                }

                $fit = NULL;
                $fit_str = '';
                $fit = $val[11];
                if($fit != NULL){
                    $fit_str = ' FIT = "'.$fit.'", ';
                }

                $product_name = NULL;
                $product_name_str = '';
                $product_name = $val[12];
                if($product_name != NULL){
                    $product_name_str = ' PRODUCT_NAME = "'.$product_name.'", ';
                }

                $product_size = NULL;
                $product_size_str = '';
                $product_size = $val[13];
                if($product_size != NULL){
                    $product_size_str = ' PRODUCT_SIZE = "'.$product_size.'", ';
                }

                $color = NULL;
                $color_str = '';
                $color = $val[14];
                if($color != NULL){
                    $color_str = ' COLOR = "'.$color.'", ';
                }

                $color_rgb = NULL;
                $color_rgb_str = '';
                $color_rgb = $val[15];
                if($color_rgb != NULL){
                    $color_rgb_str = ' COLOR_RGB = "'.$color_rgb.'", ';
                }

                $pantone_code = NULL;
                $pantone_code_str = '';
                $pantone_code = $val[16];
                if($pantone_code != NULL){
                    $pantone_code_str = ' PANTONE_CODE = "'.$pantone_code.'", ';
                }

                $wkla_idx = NULL;
                $wkla_idx_str = '';
                $wkla_idx = $val[18];
                if($wkla_idx != NULL){
                    $wkla_idx_str = ' WKLA_IDX = '.$wkla_idx.', ';
                }

                $load_box_idx = NULL;
                $load_box_idx_str = '';
                $load_box_idx = $val[20];
                if($load_box_idx != NULL){
                    $load_box_idx_str = ' LOAD_BOX_IDX = '.$load_box_idx.', ';
                }

                $load_weight = NULL;
                $load_weight_str = '';
                $load_weight = $val[21];
                if($load_weight != NULL){
                    $load_weight_str = ' LOAD_WEIGHT = '.$load_weight.', ';
                }

                $load_qty = NULL;
                $load_qty_str = '';
                $load_qty = $val[22];
                if($load_qty != NULL){
                    $load_qty_str = ' LOAD_QTY = '.$load_qty.', ';
                }

                $update_ordersheet_sql = "
                    UPDATE ORDERSHEET_MST
                    SET
                        ".$style_code_str."
                        ".$color_code_str."
                        ".$product_codstr."
                        ".$preorder_flstr."
                        ".$refund_flg_str."
                        ".$line_idx_str."
                        ".$material_str."
                        ".$graphic_str."
                        ".$fit_str."
                        ".$product_name_str."
                        ".$product_size_str."
                        ".$color_str."
                        ".$color_rgb_str."
                        ".$pantone_code_str."
                        ".$wkla_idx_str."
                        ".$load_box_idx_str."
                        ".$load_weight_str."
                        ".$load_qty_str."
                        ".$sub_material_idx_str."
                        UPDATER = '".$session_id."',
                        UPDATE_DATE = NOW()
                    WHERE
                        PRODUCT_CODE = '".$product_code."'
                ";
                $db->query($update_ordersheet_sql);
                $ordersheet_update_cnt = NULL;
                $ordersheet_update_cnt = $db->affectedRows();
                //오더시트 등록 성공시, 세트 상품 등록작업 시작
                if(!empty($ordersheet_update_cnt)){
                    $db->query('SELECT IDX,ORDERSHEET_IDX FROM SHOP_PRODUCT WHERE PRODUCT_CODE = "'.$product_code.'" ');
                    $product_idx = NULL;
                    foreach($db->fetch() as $prod_info){
                        $product_idx = $prod_info['IDX'];
                        $ordersheet_idx = $prod_info['ORDERSHEET_IDX'];
                    }
                    $sub_material_code_list = NULL;
                    $sub_material_code_list = $val[23];
                    if($sub_material_code_list != NULL){
                        $sub_code_arr = array();
                        $sub_code_arr = array_map('makeVarchar',explode(',',$sub_material_code_list));
                        $sub_init_sql = "
                            DELETE FROM SUB_MATERIAL_MAPPING
                            WHERE ORDERSHEET_IDX = ".$ordersheet_idx."
                        ";
                        
                        $sub_add_sql = "
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
                        $db->query($sub_add_sql);
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
                    $val[93] : SET PRODUCT_CODE LIST
                    $val[94] : BARCODE LIST
                    */
                    if($product_idx != NULL){
                        $product_name = NULL;
                        $product_name_str = '';
                        $product_name = $val[24];
                        if($product_name != NULL){
                            $product_name_str = ' PRODUCT_NAME = "'.$product_name.'", ';
                        }

                        $sale_flg = NULL;
                        $sale_flg_str = '';
                        $sale_flg = $val[26];
                        if($sale_flg != NULL){
                            $sale_flg_str = ' SALE_FLG = "'.$sale_flg.'", ';
                        }

                        $md_category_idx = '0';

                        $md_category_1 = NULL;
                        $md_category_1_str = '';
                        $md_category_1 = $val[28];
                        if($md_category_1 != NULL){
                            $md_category_1_str = ' MD_CATEGORY_1 = '.$md_category_1.', ';
                            $md_category_idx = $md_category_1;
                        }

                        $md_category_2 = NULL;
                        $md_category_2_str = '';
                        $md_category_2 = $val[30];
                        if($md_category_2 != NULL){
                            $md_category_2_str = ' MD_CATEGORY_2 = '.$md_category_2.', ';
                            $md_category_idx = $md_category_2;
                        }

                        $md_category_3 = NULL;
                        $md_category_3_str = '';
                        $md_category_3 = $val[32];
                        if($md_category_3 != NULL){
                            $md_category_3_str = ' MD_CATEGORY_3 = '.$md_category_3.', ';
                            $md_category_idx = $md_category_3;
                        }

                        $md_category_4 = NULL;
                        $md_category_4_str = '';
                        $md_category_4 = $val[34];
                        if($md_category_4 != NULL){
                            $md_category_4_str = ' MD_CATEGORY_4 = '.$md_category_4.', ';
                            $md_category_idx = $md_category_4;
                        }

                        $md_category_5 = NULL;
                        $md_category_5_str = '';
                        $md_category_5 = $val[36];
                        if($md_category_5 != NULL){
                            $md_category_5_str = ' MD_CATEGORY_5 = '.$md_category_5.', ';
                            $md_category_idx = $md_category_5;
                        }

                        $md_category_6 = NULL;
                        $md_category_6_str = '';
                        $md_category_6 = $val[38];
                        if($md_category_6 != NULL){
                            $md_category_6_str = ' MD_CATEGORY_6 = '.$md_category_6.', ';
                            $md_category_idx = $md_category_6;
                        }

                        $md_category_idx_str = "CATEGORY_IDX = ".$md_category_idx.", ";

                        $mileage_flg = NULL;
                        $mileage_flg_str = '';
                        $mileage_flg = $val[40];
                        if($mileage_flg != NULL){
                            $mileage_flg_str = ' MILEAGE_FLG = '.$mileage_flg.', ';
                        }

                        $exclusive_flg = NULL;
                        $exclusive_flg_str = '';
                        $exclusive_flg = $val[42];
                        if($exclusive_flg != NULL){
                            $exclusive_flg_str = ' EXCLUSIVE_FLG = '.$exclusive_flg.', ';
                        }

                        $price_kr = NULL;
                        $price_kr_str = '';
                        $price_kr = $val[43];
                        if($price_kr != NULL){
                            $price_kr_str = ' PRICE_KR = '.$price_kr.', ';
                        }

                        $sales_price_kr = NULL;
                        $sales_price_kr_str = '';
                        $sales_price_kr = $val[44];
                        if($sales_price_kr != NULL){
                            $sales_price_kr_str = ' SALES_PRICE_KR = '.$sales_price_kr.', ';
                        }

                        $discount_kr = NULL;
                        $discount_kr_str = '';
                        $discount_kr = $val[45];
                        if($discount_kr != NULL){
                            $discount_kr_str = ' DISCOUNT_KR = '.$discount_kr.', ';
                        }

                        $price_en = NULL;
                        $price_en_str = '';
                        $price_en = $val[46];
                        if($price_en != NULL){
                            $price_en_str = ' PRICE_EN = '.$price_en.', ';
                        }

                        $sales_price_en = NULL;
                        $sales_price_en_str = '';
                        $sales_price_en = $val[47];
                        if($sales_price_en != NULL){
                            $sales_price_en_str = ' SALES_PRICE_EN = '.$sales_price_en.', ';
                        }

                        $discount_en = NULL;
                        $discount_en_str = '';
                        $discount_en = $val[48];
                        if($discount_en != NULL){
                            $discount_en_str = ' DISCOUNT_EN = '.$discount_en.', ';
                        }

                        $price_cn = NULL;
                        $price_cn_str = '';
                        $price_cn = $val[49];
                        if($price_cn != NULL){
                            $price_cn_str = ' PRICE_CN = '.$price_cn.', ';
                        }

                        $sales_price_cn = NULL;
                        $sales_price_cn_str = '';
                        $sales_price_cn = $val[50];
                        if($sales_price_cn != NULL){
                            $sales_price_cn_str = ' SALES_PRICE_CN = '.$sales_price_cn.', ';
                        }

                        $discount_cn = NULL;
                        $discount_cn_str = '';
                        $discount_cn = $val[51];
                        if($discount_cn != NULL){
                            $discount_cn_str = ' DISCOUNT_CN = '.$discount_cn.', ';
                        }


                        $limit_id_flg = NULL;
                        $limit_id_flg_str = '';
                        $limit_id_flg = $val[53];
                        if($limit_id_flg != NULL){
                            $limit_id_flg_str = ' LIMIT_ID_FLG = '.$limit_id_flg.', ';
                        }

                        $reorder_cnt = NULL;
                        $reorder_cnt_str = '';
                        $reorder_cnt = $val[54];
                        if($reorder_cnt != NULL){
                            $reorder_cnt_str = ' REORDER_CNT = '.$reorder_cnt.', ';
                        }

                        $limit_purchase_qty_flg = NULL;
                        $limit_purchase_qty_flg_str = '';
                        $limit_purchase_qty_flg = $val[56];
                        if($limit_purchase_qty_flg != NULL){
                            $limit_purchase_qty_flg_str = ' LIMIT_PURCHASE_QTY_FLG = '.$limit_purchase_qty_flg.', ';
                        }

                        $limit_product_qty = NULL;
                        $limit_product_qty_str = '';
                        $limit_product_qty = $val[57];
                        if($limit_product_qty != NULL){
                            $limit_product_qty_str = ' LIMIT_PRODUCT_QTY = '.$limit_product_qty.', ';
                        }




                        $product_keyword = NULL;
                        $product_keyword_str = '';
                        $product_keyword = $val[58];
                        if($product_keyword != NULL){
                            $product_keyword_str = ' PRODUCT_KEYWORD = "'.$product_keyword.'", ';
                        }

                        $product_tag = NULL;
                        $product_tag_str = '';
                        $product_tag = $val[59];
                        if($product_tag != NULL){
                            $product_tag_str = ' PRODUCT_TAG = "'.$product_tag.'", ';
                        }
                        $clearance_code = NULL;
                        $clearance_idx_str = '';
                        $clearance_code = $val[61];
                        if($clearance_code != NULL){
                            $clearance_idx = 0;
                            $db->query('SELECT IDX FROM CUSTOM_CLEARANCE WHERE HS_CODE = "' . $clearance_code . '" ');
                            foreach($db->fetch() as $clearance_info){
                                $clearance_idx = $clearance_info['IDX'];
                            }
                            $clearance_idx_str = ' CLEARANCE_IDX = '.$clearance_idx.', ';
                        }

                        $sold_out_flg = NULL;
                        $sold_out_flg_str = '';
                        $sold_out_flg = $val[63];
                        if($sold_out_flg != NULL){
                            $sold_out_flg_str = ' SOLD_OUT_FLG = "'.$sold_out_flg.'", ';
                        }

                        $sold_out_qty = NULL;
                        $sold_out_qty_str = '';
                        $sold_out_qty = $val[64];
                        if($sold_out_qty != NULL){
                            $sold_out_qty_str = ' SOLD_OUT_QTY = "'.$sold_out_qty.'", ';
                        }

                        $care_kr = NULL;
                        $care_kr_str = '';
                        $care_kr = $val[65];
                        if($care_kr != NULL){
                            $care_kr_str = ' CARE_KR = "'.$care_kr.'", ';
                        }

                        $care_en = NULL;
                        $care_en_str = '';
                        $care_en = $val[66];
                        if($care_en != NULL){
                            $care_en_str = ' CARE_EN = "'.$care_en.'", ';
                        }

                        $care_cn = NULL;
                        $care_cn_str = '';
                        $care_cn = $val[67];
                        if($care_cn != NULL){
                            $care_cn_str = ' CARE_CN = "'.$care_cn.'", ';
                        }

                        $detail_kr = NULL;
                        $detail_kr_str = '';
                        $detail_kr = $val[68];
                        if($detail_kr != NULL){
                            $detail_kr_str = ' DETAIL_KR = "'.$detail_kr.'", ';
                        }

                        $detail_en = NULL;
                        $detail_en_str = '';
                        $detail_en = $val[69];
                        if($detail_en != NULL){
                            $detail_en_str = ' DETAIL_EN = "'.$detail_en.'", ';
                        }

                        $detail_cn = NULL;
                        $detail_cn_str = '';
                        $detail_cn = $val[70];
                        if($detail_cn != NULL){
                            $detail_cn_str = ' DETAIL_CN = "'.$detail_cn.'", ';
                        }

                        $material_kr = NULL;
                        $material_kr_str = '';
                        $material_kr = $val[71];
                        if($material_kr != NULL){
                            $material_kr_str = ' MATERIAL_KR = "'.$material_kr.'", ';
                        }

                        $material_en = NULL;
                        $material_en_str = '';
                        $material_en = $val[72];
                        if($material_en != NULL){
                            $material_en_str = ' MATERIAL_EN = "'.$material_en.'", ';
                        }

                        $material_cn = NULL;
                        $material_cn_str = '';
                        $material_cn = $val[73];
                        if($material_cn != NULL){
                            $material_cn_str = ' MATERIAL_CN = "'.$material_cn.'", ';
                        }

                        $refund_flg = NULL;
                        $refund_flg_str = '';
                        $refund_flg = $val[75];
                        if($refund_flg != NULL){
                            $refund_flg_str = ' REFUND_FLG = '.$refund_flg.', ';
                        }

                        $refund_msg_flg = NULL;
                        $refund_msg_flg_str = '';
                        $refund_msg_flg = $val[77];
                        if($refund_msg_flg != NULL){
                            $refund_msg_flg_str = ' REFUND_MSG_FLG = '.$refund_msg_flg.', ';
                        }

                        $refund_msg_kr = NULL;
                        $refund_msg_kr_str = '';
                        $refund_msg_kr = $val[78];
                        if($refund_msg_kr != NULL){
                            $refund_msg_kr_str = ' REFUND_MSG_KR = "'.$refund_msg_kr.'", ';
                        }

                        $refund_msg_en = NULL;
                        $refund_msg_en_str = '';
                        $refund_msg_en = $val[79];
                        if($refund_msg_en != NULL){
                            $refund_msg_en_str = ' REFUND_MSG_EN = "'.$refund_msg_en.'", ';
                        }

                        $refund_msg_cn = NULL;
                        $refund_msg_cn_str = '';
                        $refund_msg_cn = $val[80];
                        if($refund_msg_cn != NULL){
                            $refund_msg_cn_str = ' REFUND_MSG_CN = "'.$refund_msg_cn.'", ';
                        }

                        $refund_kr = NULL;
                        $refund_kr_str = '';
                        $refund_kr = $val[81];
                        if($refund_kr != NULL){
                            $refund_kr_str = ' REFUND_KR = "'.$refund_kr.'", ';
                        }

                        $refund_en = NULL;
                        $refund_en_str = '';
                        $refund_en = $val[82];
                        if($refund_en != NULL){
                            $refund_en_str = ' REFUND_EN = "'.$refund_en.'", ';
                        }

                        $refund_cn = NULL;
                        $refund_cn_str = '';
                        $refund_cn = $val[83];
                        if($refund_cn != NULL){
                            $refund_cn_str = ' REFUND_CN = "'.$refund_cn.'", ';
                        }

                        $memo = NULL;
                        $memo_str = '';
                        $memo = $val[84];
                        if($memo != NULL){
                            $memo_str = ' MEMO = "'.$memo.'", ';
                        }

                        $seo_exposure_flg = NULL;
                        $seo_exposure_flg_str = '';
                        $seo_exposure_flg = $val[86];
                        if($seo_exposure_flg != NULL){
                            $seo_exposure_flg_str = ' SEO_EXPOSURE_FLG = '.$seo_exposure_flg.', ';
                        }

                        $seo_title = NULL;
                        $seo_title_str = '';
                        $seo_title = $val[87];
                        if($seo_title != NULL){
                            $seo_title_str = ' SEO_TITLE = "'.$seo_title.'", ';
                        }

                        $seo_author = NULL;
                        $seo_author_str = '';
                        $seo_author = $val[88];
                        if($seo_author != NULL){
                            $seo_author_str = ' SEO_AUTHOR = "'.$seo_author.'", ';
                        }

                        $seo_description = NULL;
                        $seo_description_str = '';
                        $seo_description = $val[89];
                        if($seo_description != NULL){
                            $seo_description_str = ' SEO_DESCRIPTION = "'.$seo_description.'", ';
                        }

                        $seo_keywords = NULL;
                        $seo_keywords_str = '';
                        $seo_keywords = $val[90];
                        if($seo_keywords != NULL){
                            $seo_keywords_str = ' SEO_KEYWORDS = "'.$seo_keywords.'", ';
                        }

                        $seo_alt_text = NULL;
                        $seo_alt_text_str = '';
                        $seo_alt_text = $val[91];
                        if($seo_alt_text != NULL){
                            $seo_alt_text_str = ' SEO_ALT_TEXT = "'.$seo_alt_text.'", ';
                        }

                        $filter_ft = NULL;
                        $filter_ft_str = '';
                        $filter_ft = $val[93];
                        if($pantone_code != NULL){
                            $filter_ft_str = ' FILTER_FT = '.$filter_ft.', ';
                        }

                        $filter_gp = NULL;
                        $filter_gp_str = '';
                        $filter_gp = $val[95];
                        if($filter_gp != NULL){
                            $filter_gp_str = ' FILTER_GP = '.$filter_gp.', ';
                        }

                        $filter_ln = NULL;
                        $filter_ln_str = '';
                        $filter_ln = $val[97];
                        if($filter_ln != NULL){
                            $filter_ln_str = ' FILTER_LN = '.$filter_ln.', ';
                        }

                        $regist_set_product_sql = "
                            UPDATE SHOP_PRODUCT
                            SET
                                ".$product_name_str."
                                ".$sale_flg_str."
                                ".$md_category_1_str."
                                ".$md_category_2_str."
                                ".$md_category_3_str."
                                ".$md_category_4_str."
                                ".$md_category_5_str."
                                ".$md_category_6_str."
                                ".$md_category_idx_str."
                                ".$mileage_flg_str."
                                ".$exclusize_flg_str."
                                ".$price_kr_str."
                                ".$sales_price_kr_str."
                                ".$discount_kr_str."
                                ".$price_en_str."
                                ".$sales_price_en_str."
                                ".$discount_en_str."
                                ".$price_cn_str."
                                ".$sales_price_cn_str."
                                ".$discount_cn_str."
                                ".$limit_id_flg_str."
                                ".$reorder_cnt_str."
                                ".$limit_purchase_qty_flg_str."
                                ".$limit_product_qty_str."
                                ".$product_keyword_str."
                                ".$product_tag_str."
                                ".$clearance_idx_str."
                                ".$relevant_idx_str."
                                ".$sold_out_flg_str ."
                                ".$sold_out_qty_str."
                                ".$care_kr_str."
                                ".$care_en_str."
                                ".$care_cn_str."
                                ".$detail_kr_str."
                                ".$detail_en_str."
                                ".$detail_cn_str."
                                ".$refund_flg_str."
                                ".$refund_msg_flg_str."
                                ".$refund_msg_kr_str."
                                ".$refund_msg_en_str."
                                ".$refund_msg_cn_str."
                                ".$refund_kr_str."
                                ".$refund_en_str."
                                ".$refund_cn_str."
                                ".$seo_exposure_flg_str."
                                ".$seo_title_str."
                                ".$seo_author_str."
                                ".$seo_description_str."
                                ".$seo_keywords_str."
                                ".$seo_alt_text_str."
                                ".$filter_ft_str."
                                ".$filter_gp_str."
                                ".$filter_ln_str."
                                UPDATER = '".$session_id."',
                                UPDATE_DATE = NOW()
                            WHERE
                                PRODUCT_CODE = '".$product_code."'
                            
                        ";
                        $db->query($regist_set_product_sql);
                        $product_update_cnt = $db->affectedRows();
                        
                        $success_cnt++;
                        if(!empty($product_update_cnt)){
                            $delete_sql = "
                                    DELETE FROM 
                                        SET_PRODUCT
                                    WHERE
                                        SET_PRODUCT_IDX = ".$product_idx." ";
                            $db->query($delete_sql);
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

                                            $product_update_cnt = NULL;
                                            $product_update_cnt = $db->affectedRows();
                                            if(empty($product_update_cnt) || $product_update_cnt == NULL){
                                                $json_result['code']    = 301;
                                                $json_result['msg']     = '단일상품 수정에 실패 했습니다. 독립몰 상품정보를 다시한번 확인해주세요';
                                                $db->rollback();
                                                return $json_result;
                                            }
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
                        }
                        else{
                            $json_result['code']    = 301;
                            $json_result['msg']     = '세트상품 수정에 실패 했습니다. 독립몰 상품정보를 다시한번 확인해주세요';
                            $db->rollback();
                            return $json_result;
                        }
                    }
                    else{
                        $json_result['code']    = 301;
                        $json_result['msg']     = '등록된 상품이 없습니다. 오더시트 정보를 다시한번 확인해주세요';
                        $db->rollback();
                        return $json_result;
                    }
                }
                else{
                    $json_result['code']    = 301;
                    $json_result['msg']     = '오더시트 항목 수정을 완료하지 못했습니다. 오더시트 정보를 다시한번 확인해주세요';
                    $db->rollback();
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
        $json_result['msg'] = '세트상품 수정작업이 실패했습니다.';
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