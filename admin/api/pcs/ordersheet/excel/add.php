<?php
/*
 +=============================================================================
 | 
 | 상품관리 : 엑셀-오더시트 등록(기획 MD정보)
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

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

/** 변수 정리 **/
$session_id			= sessionCheck();
$sheet_str			= $_POST['sheet_data'];
$sheet_data			= json_decode($sheet_str, true);
$ordersheet_sheet	= $sheet_data['ordersheet_regist_sheet'];

$insert_column_arr = array();
$ordersheet_true = array();     //상품옵션 등록 성공
$ordersheet_false = array();    //상품옵션 등록 실패

date_default_timezone_set('Asia/Seoul');
if ($ordersheet_sheet != NULL && count($ordersheet_sheet) != 0) {
    $excel_start_row = 4;
    $success_cnt = 0;
    $db->begin_transaction();
    try {
        foreach ($ordersheet_sheet as $key => $val) {
            /*
            1~17 : ordersheet 
            $val[0] :     YEAR
            $val[1] :     STYLE_CODE
            $val[2] :     COLOR_CODE
            $val[3] :     PRODUCT_CODE
            $val[5] :     PREORDER_FLG
            $val[7] :     REFUND_FLG
            $val[9] :     LINE_IDX
            $val[10] :     CATEGORY_LRG
            $val[12] :    CATEGORY_MDL
            $val[14] :    CATEGORY_SML
            $val[15] :    CATEGORY_DTL
            $val[19] :    GRAPHIC
            $val[21] :    PRODUCT_NAME
            $val[22] :    PRODUCT_SIZE
            $val[23] :    COLOR
            $val[26] :    MD_CATEGORY_GUIDE
            $val[27] :    LIMIT_MEMBER
            $val[28] :    LIMIT_QTY
            
            $val[30] :    LIMIT_ID_FLG
            $val[32] :    LIMIT_PRODUCT_QTY_FLG
            $val[33] :    LIMIT_PRODUCT_QTY

            $val[34] :    PRICE_COST
            $val[35] :    PRICE_KR
            $val[36] :    PRICE_KR_GB
            $val[37] :    PRICE_EN
            $val[38] :    PRICE_CN
            $val[39] :    PRODUCT_QTY
            $val[40] :    SAFE_QTY
            */
            $product_code = NULL;
            $exist_ordersheet_cnt = -1;
            $product_code = $val[2];
            if($product_code != NULL){
                $exist_ordersheet_cnt = $db->count('ORDERSHEET_MST', 'PRODUCT_CODE = "'.$product_code.'" ');
            }
            
            //insert
            if($exist_ordersheet_cnt == 0){
                $year = NULL;
                $year_arr = array();
                $year = $val[0];
                if($year != NULL){
                    $year_arr[0] = ' YEAR, ';
                    $year_arr[1] = ' "'.$year.'", ';
                }

                $style_code = NULL;
                $style_code_arr = array();
                $style_code = $val[1];
                if($style_code != NULL){
                    $style_code_arr[0] = ' STYLE_CODE, ';
                    $style_code_arr[1] = ' "'.$style_code.'", ';
                }
                $color_code = NULL;
                $color_code_arr = array();
                $color_code = $val[2];
                if($color_code != NULL){
                    $color_code_arr[0] = ' COLOR_CODE, ';
                    $color_code_arr[1] = ' "'.$color_code.'", ';
                }
                $product_code = NULL;
                $product_code_arr = array();
                $product_code = $val[3];
                if($product_code != NULL){
                    $product_code_arr[0] = ' PRODUCT_CODE, ';
                    $product_code_arr[1] = ' "'.$product_code.'", ';
                }
                $preorder_flg = NULL;
                $preorder_flg_arr = array();
                $preorder_flg = $val[5];
                if($preorder_flg != NULL){
                    $preorder_flg_arr[0] = ' PREORDER_FLG, ';
                    $preorder_flg_arr[1] = ' '.$preorder_flg.', ';
                }
                $refund_flg = NULL;
                $refund_flg_arr = array();
                $refund_flg = $val[7];
                if($refund_flg != NULL){
                    $refund_flg_arr[0] = ' REFUND_FLG, ';
                    $refund_flg_arr[1] = ' '.$refund_flg.', ';
                }
                $line_idx = NULL;
                $line_idx_arr = array();
                $line_idx = $val[9];
                if($line_idx != NULL){
                    $line_idx_arr[0] = ' LINE_IDX, ';
                    $line_idx_arr[1] = ' '.$line_idx.', ';
                }
                $category_lrg = NULL;
                $category_lrg_arr = array();
                $category_lrg = $val[11];
                if($category_lrg != NULL){
                    $category_lrg_arr[0] = ' CATEGORY_LRG, ';
                    $category_lrg_arr[1] = ' '.$category_lrg.', ';
                }
                $category_mdl = NULL;
                $category_mdl_arr = array();
                $category_mdl = $val[13];
                if($category_mdl != NULL){
                    $category_mdl_arr[0] = ' CATEGORY_MDL, ';
                    $category_mdl_arr[1] = ' '.$category_mdl.', ';
                }
                $category_sml = NULL;
                $category_sml_arr = array();
                $category_sml = $val[15];
                if($category_sml != NULL){
                    $category_sml_arr[0] = ' CATEGORY_SML, ';
                    $category_sml_arr[1] = ' '.$category_sml.', ';
                }
                $category_dtl = NULL;
                $category_dtl_arr = array();
                $category_idx_arr = array();
                $category_dtl = $val[17];
                if($category_dtl != NULL){
                    $category_dtl_arr[0] = ' CATEGORY_DTL, ';
                    $category_dtl_arr[1] = ' '.$category_dtl.', ';

                    $category_idx_arr[0] = ' CATEGORY_IDX, ';
                    $category_idx_arr[1] = ' '.$category_dtl.', ';
                }
                $graphic = NULL;
                $graphic_arr = array();
                $graphic = $val[19];
                if($graphic != NULL){
                    $graphic_arr[0] = ' GRAPHIC, ';
                    $graphic_arr[1] = ' "'.$graphic.'", ';
                }
                $product_name = NULL;
                $product_name_arr = array();
                $product_name = $val[21];
                if($product_name != NULL){
                    $product_name_arr[0] = ' PRODUCT_NAME, ';
                    $product_name_arr[1] = ' "'.$product_name.'", ';
                }
                $product_size = NULL;
                $product_size_arr = array();
                $product_size = $val[22];
                if($product_size != NULL){
                    $product_size_arr[0] = ' PRODUCT_SIZE, ';
                    $product_size_arr[1] = ' "'.$product_size.'", ';
                }
                $color = NULL;
                $color_arr = array();
                $color = $val[23];
                if($color != NULL){
                    $color_arr[0] = ' COLOR, ';
                    $color_arr[1] = ' "'.$color.'", ';
                }

                $md_category_guide = NULL;
                $md_category_guide_arr = array();
                $md_category_guide = $val[26];
                if($md_category_guide != NULL){
                    $md_category_guide_arr[0] = ' MD_CATEGORY_GUIDE, ';
                    $md_category_guide_arr[1] = ' "'.$md_category_guide.'", ';
                }
                $limit_member = NULL;
                $limit_member_arr = array();
                $limit_member = $val[27];
                if($limit_member != NULL){
                    $limit_member_arr[0] = ' LIMIT_MEMBER, ';
                    $limit_member_arr[1] = ' "'.$limit_member.'", ';
                }
                $limit_qty = NULL;
                $limit_qty_arr = array();
                $limit_qty = $val[28];
                if($limit_qty != NULL){
                    $limit_qty_arr[0] = ' LIMIT_QTY, ';
                    $limit_qty_arr[1] = ' "'.$limit_qty.'", ';
                }


                $limit_id_flg = NULL;
                $limit_id_flg_arr = array();
                $limit_id_flg = $val[30];
                if($limit_id_flg != NULL){
                    $limit_id_flg_arr[0] = ' LIMIT_ID_FLG, ';
                    $limit_id_flg_arr[1] = ' '.$limit_id_flg.', ';
                }
                $limit_product_qty_flg = NULL;
                $limit_product_qty_flg_arr = array();
                $limit_product_qty_flg = $val[32];
                if($limit_product_qty_flg != NULL){
                    $limit_product_qty_flg_arr[0] = ' LIMIT_PRODUCT_QTY_FLG, ';
                    $limit_product_qty_flg_arr[1] = ' '.$limit_product_qty_flg.', ';
                }
                $limit_product_qty = NULL;
                $limit_product_qty_arr = array();
                $limit_product_qty = $val[33];
                if($limit_product_qty != NULL){
                    $limit_product_qty_arr[0] = ' LIMIT_PRODUCT_QTY, ';
                    $limit_product_qty_arr[1] = ' '.$limit_product_qty.', ';
                }


                $price_cost = NULL;
                $price_cost_arr = array();
                $price_cost = $val[34];
                if($price_cost != NULL){
                    $price_cost_arr[0] = ' PRICE_COST, ';
                    $price_cost_arr[1] = ' '.$price_cost.', ';
                }
                $price_kr = NULL;
                $price_kr_arr = array();
                $price_kr = $val[35];
                if($price_kr != NULL){
                    $price_kr_arr[0] = ' PRICE_KR, ';
                    $price_kr_arr[1] = ' '.$price_kr.', ';
                }
                /*
                $price_kr_gb = NULL;
                $price_kr_gb_arr = array();
                $price_kr_gb = $val[36];
                if($price_kr_gb != NULL){
                    $price_kr_gb_arr[0] = ' PRICE_KR_GB, ';
                    $price_kr_gb_arr[1] = ' '.$price_kr_gb.', ';
                }
                $price_en = NULL;
                $price_en_arr = array();
                $price_en = $val[37];
                if($price_en != NULL){
                    $price_en_arr[0] = ' PRICE_EN, ';
                    $price_en_arr[1] = ' '.$price_en.', ';
                }
                $price_cn = NULL;
                $price_cn_arr = array();
                $price_cn = $val[38];
                if($price_cn != NULL){
                    $price_cn_arr[0] = ' PRICE_CN, ';
                    $price_cn_arr[1] = ' '.$price_cn.', ';
                }
                */
                $product_qty = NULL;
                $product_qty_arr = array();
                $product_qty = $val[39];
                if($product_qty != NULL){
                    $product_qty_arr[0] = ' PRODUCT_QTY, ';
                    $product_qty_arr[1] = ' '.$product_qty.', ';
                }
                $safe_qty = NULL;
                $safe_qty_arr = array();
                $safe_qty = $val[40];
                if($safe_qty != NULL){
                    $safe_qty_arr[0] = ' SAFE_QTY, ';
                    $safe_qty_arr[1] = ' '.$safe_qty.', ';
                }

                $regist_ordersheet_sql = "
                    INSERT INTO ORDERSHEET_MST
                    (
                        ".$year_arr[0]."
                        ".$style_code_arr[0]."
                        ".$color_code_arr[0]."
                        ".$product_code_arr[0]."
                        ".$preorder_flg_arr[0]."
                        ".$refund_flg_arr[0]."
                        ".$line_idx_arr[0]."
                        ".$category_lrg_arr[0]."
                        ".$category_mdl_arr[0]."
                        ".$category_sml_arr[0]."
                        ".$category_dtl_arr[0]."
                        ".$category_idx_arr[0]."
                        ".$graphic_arr[0]."
                        ".$product_name_arr[0]."
                        ".$product_size_arr[0]."
                        ".$color_arr[0]."
                        ".$md_category_guide_arr[0]."
                        ".$limit_member_arr[0]."
                        ".$limit_qty_arr[0]."
                        ".$limit_id_flg_arr[0]."
                        ".$limit_product_qty_flg_arr[0]."
                        ".$limit_product_qty_arr[0]."
                        ".$price_cost_arr[0]."
                        ".$price_kr_arr[0]."
                        ".$product_qty_arr[0]."
                        ".$safe_qty_arr[0]."
                        CREATER,
                        UPDATER
                    )
                    VALUES
                    (
                        ".$year_arr[1]."
                        ".$style_code_arr[1]."
                        ".$color_code_arr[1]."
                        ".$product_code_arr[1]."
                        ".$preorder_flg_arr[1]."
                        ".$refund_flg_arr[1]."
                        ".$line_idx_arr[1]."
                        ".$category_lrg_arr[1]."
                        ".$category_mdl_arr[1]."
                        ".$category_sml_arr[1]."
                        ".$category_dtl_arr[1]."
                        ".$category_idx_arr[1]."
                        ".$graphic_arr[1]."
                        ".$product_name_arr[1]."
                        ".$product_size_arr[1]."
                        ".$color_arr[1]."
                        ".$md_category_guide_arr[1]."
                        ".$limit_member_arr[1]."
                        ".$limit_qty_arr[1]."
                        ".$limit_id_flg_arr[1]."
                        ".$limit_product_qty_flg_arr[1]."
                        ".$limit_product_qty_arr[1]."
                        ".$price_cost_arr[1]."
                        ".$price_kr_arr[1]."
                        ".$product_qty_arr[1]."
                        ".$safe_qty_arr[1]."
                        '".$session_id."',
                        '".$session_id."'
                    )
                ";
				
                $db->query($regist_ordersheet_sql);

                $ordersheet_idx = NULL;
                $ordersheet_idx = $db->last_id();

                //오더시트 등록 실패시 롤백
                if(empty($ordersheet_idx) || $ordersheet_idx == NULL){
                    $json_result['code']    = 301;
                    $json_result['msg']     = '오더시트 등록에 실패 했습니다. 오더시트 정보를 다시한번 확인해주세요';
                    $db->rollback();
                    return $json_result;
                }
                else{
                    $success_cnt++;
                }
            }
            else if($exist_ordersheet_cnt > 0){
                $json_result['code']    = 301;
                $json_result['msg']     = '이미등록되어 있는 상품코드가 포함되어있습니다. 오더시트 정보를 다시한번 확인해주세요';
                $db->rollback();
                return $json_result;
            }
        }
        $json_result['data']['success'] = $success_cnt;
        $db->commit();
    }
    catch(mysqli_sql_exception $exception){
        $json_result['code'] = 301;
        $db->rollback();
        $json_result['msg'] = '오더시트 등록작업이 실패했습니다.';
        return $json_result;
    }
}
else{
    $json_result['code']    = 301;
    $json_result['msg']     = '빈 시트입니다. 파일을 다시 확인해주세요';
    return $json_result;
}

?>