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
$product_update_sheet = $sheet_data['product_update_sheet'];
$product_option_sheet = $sheet_data['product_option_sheet'];
$relevant_sheet = $sheet_data['relevant_sheet'];

$update_column_arr = array();

date_default_timezone_set('Asia/Seoul');

if ($product_update_sheet != NULL && count($product_update_sheet) != 0) {
    $excel_start_row = 4;
    $success_cnt = 0;
    $db->begin_transaction();
    try {
        foreach ($product_update_sheet as $key => $val) {

            /*
            0 ~ 69 : basic product coloum
            $val[0] : PRODUCT_CODE
            $val[1] : PRODUCT_NAME
            $val[3] : MD_CATEGORY_1
            $val[5] : MD_CATEGORY_2
            $val[7] : MD_CATEGORY_3
            $val[9] : MD_CATEGORY_4
            $val[11] : MD_CATEGORY_5
            $val[13] : MD_CATEGORY_6
            $val[15] : MILEAGE_FLG
            $val[17] : EXCLUSIVE_FLG
            $val[18] : PRICE_KR
            $val[19] : SALES_PRICE_KR
            $val[20] : DISCOUNT_KR
            $val[21] : PRICE_EN
            $val[22] : SALES_PRICE_EN
            $val[23] : DISCOUNT_EN
            $val[24] : PRICE_CN
            $val[25] : SALES_PRICE_CN
            $val[26] : DISCOUNT_CN
            $val[28] : LIMIT_MEMBER_FLG
            $val[30] : LIMIT_ID_FLG
            $val[31] : REORDER_CNT
            $val[33] : LIMIT_PURCHASE_QTY_FLG
            $val[34] : LIMIT_PRODUCT_QTY
            $val[35] : PRODUCT_KEYWORD
            $val[36] : PRODUCT_TAG
            $val[38] : CLEARANCE_IDX
            $val[39] : SOLD_OUT_QTY
            $val[40] : CARE_KR
            $val[41] : CARE_EN
            $val[42] : CARE_CN
            $val[43] : DETAIL_KR
            $val[44] : DETAIL_EN
            $val[45] : DETAIL_CN
            $val[46] : MATERIAL_KR
            $val[47] : MATERIAL_EN
            $val[48] : MATERIAL_CN
            $val[50] : REFUND_FLG
            $val[52] : REFUND_MSG_FLG
            $val[53] : REFUND_MSG
            $val[54] : REFUND_KR
            $val[55] : REFUND_EN
            $val[56] : REFUND_CN
            $val[57] : MEMO
            $val[59] : SEO_EXPOSURE_FLG
            $val[60] : SEO_TITLE
            $val[61] : SEO_AUTHOR
            $val[62] : SEO_DESCRIPTION
            $val[63] : SEO_KEYWORDS
            $val[64] : SEO_ALT_TEXT
            $val[66] : FILTER_FT
            $val[68] : FILTER_GP
            $val[70] : FILTER_LN
            */

            $product_code = NULL;
            $product_code = $val[0];
            if($product_code != NULL){
                $product_cnt = $db->count('SHOP_PRODUCT', 'PRODUCT_CODE="'.$product_code.'" ');

                if($product_cnt > 0){
                    $product_name = NULL;
                    $product_name_arr = array();
                    $product_name = $val[1];
                    if($product_name != NULL){
                        $product_name_str = ' PRODUCT_NAME = "'.$product_name.'", ';
                    }
        
                    $sale_flg = NULL;
                    $sale_flg_arr = array();
                    $sale_flg = $val[3];
                    if($sale_flg != NULL){
                        $sale_flg_str = ' SALE_FLG = '.$sale_flg.', ';
                    }

                    $md_category_1 = NULL;
                    $md_category_1_arr = array();
                    $md_category_1 = $val[5];
                    if($md_category_1 != NULL){
                        $md_category_1_str = ' MD_CATEGORY_1 = '.$md_category_1.', ';
                    }
        
                    $md_category_2 = NULL;
                    $md_category_2_arr = array();
                    $md_category_2 = $val[7];
                    if($md_category_2 != NULL){
                        $md_category_2_str = ' MD_CATEGORY_2 = '.$md_category_2.', ';
                    }
        
                    $md_category_3 = NULL;
                    $md_category_3_arr = array();
                    $md_category_3 = $val[9];
                    if($md_category_3 != NULL){
                        $md_category_3_str = ' MD_CATEGORY_3 = '.$md_category_3.', ';
                    }
        
                    $md_category_4 = NULL;
                    $md_category_4_arr = array();
                    $md_category_4 = $val[11];
                    if($md_category_4 != NULL){
                        $md_category_4_str = ' MD_CATEGORY_4 = '.$md_category_4.', ';
                    }
        
                    $md_category_5 = NULL;
                    $md_category_5_arr = array();
                    $md_category_5 = $val[13];
                    if($md_category_5 != NULL){
                        $md_category_5_str = ' MD_CATEGORY_5 = '.$md_category_5.', ';
                    }
        
                    $md_category_6 = NULL;
                    $md_category_6_arr = array();
                    $md_category_6 = $val[15];
                    if($md_category_6 != NULL){
                        $md_category_6_str = ' MD_CATEGORY_6 = '.$md_category_6.', ';
                    }
        
                    $mileage_flg = NULL;
                    $mileage_flg_arr = array();
                    $mileage_flg = $val[17];
                    if($mileage_flg != NULL){
                        $mileage_flg_str = ' MILEAGE_FLG = '.$mileage_flg.', ';
                    }
        
                    $exclusive_flg = NULL;
                    $exclusive_flg_arr = array();
                    $exclusive_flg = $val[19];
                    if($exclusive_flg != NULL){
                        $exclusive_flg_str = ' EXCLUSIVE_FLG = '.$exclusive_flg.', ';
                    }
        
                    $price_kr = NULL;
                    $price_kr_arr = array();
                    $price_kr = $val[20];
                    if($price_kr != NULL){
                        $price_kr_str = ' PRICE_KR = '.$price_kr.', ';
                    }
        
                    $sales_price_kr = NULL;
                    $sales_price_kr_arr = array();
                    $sales_price_kr = $val[21];
                    if($sales_price_kr != NULL){
                        $sales_price_kr_str = ' SALES_PRICE_KR = '.$sales_price_kr.', ';
                    }
        
                    $discount_kr = NULL;
                    $discount_kr_arr = array();
                    $discount_kr = $val[22];
                    if($discount_kr != NULL){
                        $discount_kr_str = ' DISCOUNT_KR = '.$discount_kr.', ';
                    }
        
                    $price_en = NULL;
                    $price_en_arr = array();
                    $price_en = $val[23];
                    if($price_en != NULL){
                        $price_en_str = ' PRICE_EN = '.$price_en.', ';
                    }
        
                    $sales_price_en = NULL;
                    $sales_price_en_arr = array();
                    $sales_price_en = $val[24];
                    if($sales_price_en != NULL){
                        $sales_price_en_str = ' SALES_PRICE_EN = '.$sales_price_en.', ';
                    }
        
                    $discount_en = NULL;
                    $discount_en_arr = array();
                    $discount_en = $val[25];
                    if($discount_en != NULL){
                        $discount_en_str = ' DISCOUNT_EN = '.$discount_en.', ';
                    }
        
                    $price_cn = NULL;
                    $price_cn_arr = array();
                    $price_cn = $val[26];
                    if($price_cn != NULL){
                        $price_cn_str = ' PRICE_CN = '.$price_cn.', ';
                    }
        
                    $sales_price_cn = NULL;
                    $sales_price_cn_str = '';
                    $sales_price_cn = $val[27];
                    if($sales_price_cn != NULL){
                        $sales_price_cn_str = ' SALES_PRICE_CN = '.$sales_price_cn.', ';
                    }
        
                    $discount_cn = NULL;
                    $discount_cn_str = '';
                    $discount_cn = $val[28];
                    if($discount_cn != NULL){
                        $discount_cn_str = ' DISCOUNT_CN = '.$discount_cn.', ';
                    }
                    /*
                    $val[28] : LIMIT_MEMBER_FLG
                    $val[30] : LIMIT_ID_FLG
                    $val[31] : REORDER_CNT
                    $val[33] : LIMIT_PURCHASE_QTY_FLG
                    $val[34] : limit_product_qtyLIMIT_PRODUCT_QTY

                    $limit_member_flg = NULL;
                    $limit_member_flg_str = '';
                    $limit_member_flg = $val[28];
                    if($limit_member_flg != NULL){
                        $limit_member_flg_str = ' LIMIT_MEMBER_FLG = '.$limit_member_flg.', ';
                    }
 */                   
                    $limit_id_flg = NULL;
                    $limit_id_flg_str = '';
                    $limit_id_flg = $val[32];
                    if($limit_id_flg != NULL){
                        $limit_id_flg = ' LIMIT_ID_FLG = '.$limit_id_flg.', ';
                    }

                    $reorder_cnt = NULL;
                    $reorder_cnt_str = '';
                    $reorder_cnt = $val[33];
                    if($reorder_cnt != NULL){
                        $reorder_cnt_str = ' REORDER_CNT = '.$reorder_cnt.', ';
                    }
        
                    $limit_purchase_qty_flg = NULL;
                    $limit_purchase_qty_flg_str = '';
                    $limit_purchase_qty_flg = $val[35];
                    if($limit_purchase_qty_flg != NULL){
                        $limit_purchase_qty_flg_str = ' LIMIT_PURCHASE_QTY_FLG = '.$limit_purchase_qty_flg.', ';
                    }
        
                    $limit_product_qty = NULL;
                    $limit_product_qty_str = array();
                    $limit_product_qty = $val[36];
                    if($limit_product_qty != NULL){
                        $limit_product_qty_str = ' LIMIT_PRODUCT_QTY = '.$limit_product_qty.', ';
                    }

                    $product_keyword = NULL;
                    $product_keyword_str = '';
                    $product_keyword = $val[37];
                    if($product_keyword != NULL){
                        $product_keyword_str = ' PRODUCT_KEYWORD = "'.$product_keyword.'", ';
                    }
        
                    $product_tag = NULL;
                    $product_tag_str = '';
                    $product_tag = $val[38];
                    if($product_tag != NULL){
                        $product_tag_str = ' PRODUCT_TAG = "'.$product_tag.'", ';
                    }

                    $clearance_code = NULL;
                    $clearance_idx_str = '';
                    $clearance_code = $val[40];
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
                    $sold_out_flg = $val[42];
                    if($sold_out_flg != NULL){
                        $sold_out_flg_str = ' SOLD_OUT_FLG = '.$sold_out_flg.', ';
                    }

                    $sold_out_qty = NULL;
                    $sold_out_qty_str = '';
                    $sold_out_qty = $val[43];
                    if($sold_out_qty != NULL){
                        $sold_out_qty_str = ' SOLD_OUT_QTY = "'.$sold_out_qty.'", ';
                    }
        
                    $care_kr = NULL;
                    $care_kr_str = '';
                    $care_kr = $val[44];
                    if($care_kr != NULL){
                        $care_kr_str = ' CARE_KR = "'.$care_kr.'", ';
                    }
        
                    $care_en = NULL;
                    $care_en_str = '';
                    $care_en = $val[45];
                    if($care_en != NULL){
                        $care_en_str = ' CARE_EN = "'.$care_en.'", ';
                    }
        
                    $care_cn = NULL;
                    $care_cn_str = '';
                    $care_cn = $val[46];
                    if($care_cn != NULL){
                        $care_cn_str = ' CARE_CN = "'.$care_cn.'", ';
                    }
        
                    $detail_kr = NULL;
                    $detail_kr_str = '';
                    $detail_kr = $val[47];
                    if($detail_kr != NULL){
                        $detail_kr_str = ' DETAIL_KR = "'.$detail_kr.'", ';
                    }
        
                    $detail_en = NULL;
                    $detail_en_str = '';
                    $detail_en = $val[48];
                    if($detail_en != NULL){
                        $detail_en_str = ' DETAIL_EN = "'.$detail_en.'", ';
                    }
        
                    $detail_cn = NULL;
                    $detail_cn_str = '';
                    $detail_cn = $val[49];
                    if($detail_cn != NULL){
                        $detail_cn_str = ' DETAIL_CN = "'.$detail_cn.'", ';
                    }
        
                    $material_kr = NULL;
                    $material_kr_str = '';
                    $material_kr = $val[50];
                    if($material_kr != NULL){
                        $material_kr_str = ' MATERIAL_KR = "'.$material_kr.'", ';
                    }
        
                    $material_en = NULL;
                    $material_en_str = '';
                    $material_en = $val[51];
                    if($material_en != NULL){
                        $material_en_str = ' MATERIAL_EN = "'.$material_en.'", ';
                    }
        
                    $material_cn = NULL;
                    $material_cn_str = '';
                    $material_cn = $val[52];
                    if($material_cn != NULL){
                        $material_cn_str = ' MATERIAL_CN = "'.$material_cn.'", ';
                    }
        
                    $refund_flg = NULL;
                    $refund_flg_str = '';
                    $refund_flg = $val[54];
                    if($refund_flg != NULL){
                        $refund_flg_str = ' REFUND_FLG = '.$refund_flg.', ';
                    }
        
                    $refund_msg_flg = NULL;
                    $refund_msg_flg_str = '';
                    $refund_msg_flg = $val[56];
                    if($refund_msg_flg != NULL){
                        $refund_msg_flg_str = ' REFUND_MSG_FLG = '.$refund_msg_flg.', ';
                    }
        
                    $refund_msg_kr = NULL;
                    $refund_msg_kr_str = '';
                    $refund_msg_kr = $val[57];
                    if($refund_msg_kr != NULL){
                        $refund_msg_kr_str = ' REFUND_MSG_KR = "'.$refund_msg_kr.'", ';
                    }

                    $refund_msg_en = NULL;
                    $refund_msg_en_str = '';
                    $refund_msg_en = $val[58];
                    if($refund_msg_en != NULL){
                        $refund_msg_en_str = ' REFUND_MSG_EN = "'.$refund_msg_en.'", ';
                    }

                    $refund_msg_cn = NULL;
                    $refund_msg_cn_str = '';
                    $refund_msg_cn = $val[59];
                    if($refund_msg_cn != NULL){
                        $refund_msg_cn_str = ' REFUND_MSG_CN = "'.$refund_msg_cn.'", ';
                    }
        
                    $refund_kr = NULL;
                    $refund_kr_str = '';
                    $refund_kr = $val[60];
                    if($refund_kr != NULL){
                        $refund_kr_str = ' REFUND_KR = "'.$refund_kr.'", ';
                    }
        
                    $refund_en = NULL;
                    $refund_en_str = '';
                    $refund_en = $val[61];
                    if($refund_en != NULL){
                        $refund_en_str = ' REFUND_EN = "'.$refund_en.'", ';
                    }
        
                    $refund_cn = NULL;
                    $refund_cn_str = '';
                    $refund_cn = $val[62];
                    if($refund_cn != NULL){
                        $refund_cn_str = ' REFUND_CN = "'.$refund_cn.'", ';
                    }

                    $memo = NULL;
                    $memo_str = '';
                    $memo = $val[63];
                    if($memo != NULL){
                        $memo_str = ' MEMO = "'.$memo.'", ';
                    }
        
                    $seo_exposure_flg = NULL;
                    $seo_exposure_flg_str = '';
                    $seo_exposure_flg = $val[65];
                    if($seo_exposure_flg != NULL){
                        $seo_exposure_flg_str = ' SEO_EXPOSURE_FLG = '.$seo_exposure_flg.', ';
                    }
        
                    $seo_title = NULL;
                    $seo_title_str = '';
                    $seo_title = $val[66];
                    if($seo_title != NULL){
                        $seo_title_str = ' SEO_TITLE = "'.$seo_title.'", ';
                    }
        
                    $seo_author = NULL;
                    $seo_author_str = '';
                    $seo_author = $val[67];
                    if($seo_author != NULL){
                        $seo_author_str = ' SEO_AUTHOR = "'.$seo_author.'", ';
                    }
        
                    $seo_description = NULL;
                    $seo_description_str = '';
                    $seo_description = $val[68];
                    if($seo_description != NULL){
                        $seo_description_str = ' SEO_DESCRIPTION = "'.$seo_description.'", ';
                    }
        
                    $seo_keywords = NULL;
                    $seo_keywords_str = '';
                    $seo_keywords = $val[69];
                    if($seo_keywords != NULL){
                        $seo_keywords_str = ' SEO_KEYWORDS = "'.$seo_keywords.'", ';
                    }
        
                    $seo_alt_text = NULL;
                    $seo_alt_text_str = '';
                    $seo_alt_text = $val[70];
                    if($seo_alt_text != NULL){
                        $seo_alt_text_str = ' SEO_ALT_TEXT = "'.$seo_alt_text.'", ';
                    }
        
                    $filter_ft = NULL;
                    $filter_ft_str = '';
                    $filter_ft = $val[72];
                    if($pantone_code != NULL){
                        $filter_ft_str = ' FILTER_FT = '.$filter_ft.', ';
                    }
        
                    $filter_gp = NULL;
                    $filter_gp_str = '';
                    $filter_gp = $val[74];
                    if($filter_gp != NULL){
                        $filter_gp_str = ' FILTER_GP = '.$filter_gp.', ';
                    }
        
                    $filter_ln = NULL;
                    $filter_ln_str = '';
                    $filter_ln = $val[76];
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
                            ".$sold_out_flg_str."
                            ".$sold_out_qty_str."
                            ".$care_kr_str."
                            ".$care_en_str."
                            ".$care_cn_str."
                            ".$detail_kr_str."
                            ".$detail_en_str."
                            ".$detail_cn_str."
                            ".$material_kr_str."
                            ".$material_en_str."
                            ".$material_cn_str."
                            ".$refund_flg_str."
                            ".$refund_msg_flg_str."
                            ".$refund_msg_kr_str."
                            ".$refund_msg_en_str."
                            ".$refund_msg_cn_str."
                            ".$refund_kr_str."
                            ".$refund_en_str."
                            ".$refund_cn_str."
                            ".$memo_str."
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
                    //print_r($regist_set_product_sql);
                    $db->query($regist_set_product_sql);

                    $product_update_cnt = NULL;
                    $product_update_cnt = $db->affectedRows();
                    if(empty($product_update_cnt) || $product_update_cnt == NULL){
                        $json_result['code']    = 301;
                        $json_result['msg']     = '단일상품 수정에 실패 했습니다. 독립몰 상품정보를 다시한번 확인해주세요';
                        $db->rollback();
                        return $json_result;
                    }
                    else{
                        $success_cnt++;
                    }
                }
            }
        }
        $json_result['data']['success'] = $success_cnt;
        $db->commit();
    }
    catch(mysqli_sql_exception $exception){
        $json_result['code'] = 301;
        $db->rollback();
        $json_result['msg'] = '단일상품 수정작업이 실패했습니다.';
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
if($product_option_sheet != null && count($product_option_sheet) != 0){
    $excel_start_row = 2;
    $db->begin_transaction();
    try {
        foreach($product_option_sheet as $key=>$product_option_val){
            //$product_option_val[0] : 상품 코드
            //$product_option_val[1] : 바코드
            //$product_option_val[2] : 제한수량
            //$product_option_val[4] : 옵션별 판매수량
            
            $product_code = NULL;
            $product_code = $product_option_val[0];
            
            if($product_code != NULL){
                $product_exist_cnt = $db->count('SHOP_PRODUCT', 'PRODUCT_CODE = "'.$product_code.'" ');

                if($product_exist_cnt > 0){
                    $get_product_idx_sql = "
                        SELECT
                            IDX
                        FROM
                            SHOP_PRODUCT
                        WHERE
                            PRODUCT_CODE = '".$product_code."'
                    ";

                    $db->query($get_product_idx_sql);
                    $product_idx = NULL;
                    foreach($db->fetch() as $product_info){
                        $product_idx = $product_info['IDX'];
                    }

                    $barcode = NULL;
                    $barcode = $product_option_val[1];
                    
                    $qty = NULL;
                    $qty = $product_option_val[2];

                    $option_sale_flg = NULL;
                    $option_sale_flg = $product_option_val[4];

                    if($product_idx != NULL && $barcode != NULL){
                        $update_product_option_sql = "
                            UPDATE PRODUCT_OPTION
                            SET
                                QTY = ".$qty.",
                                SALE_FLG = ".$option_sale_flg."
                            WHERE
                                PRODUCT_IDX = ".$product_idx."
                            AND
                                OPTION_IDX = (  SELECT 
                                                    IDX
                                                FROM
                                                    ORDERSHEET_OPTION
                                                WHERE
                                                    BARCODE = '".$barcode."' )

                        ";
                        $db->query($update_product_option_sql);
                    } 
                }
            }
        }
        $db->commit();
    }
    catch(mysqli_sql_exception $exception){
        $json_result['code'] = 301;
        $db->rollback();
        $json_result['msg'] = '옵션별 수량제한정보 등록작업이 실패했습니다.';
        return $json_result;
    }
}
?>
