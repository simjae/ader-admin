
<?php

/*
 +=============================================================================
 | 
 | 독립몰 상품 등록
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.10.27
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
include_once("/var/www/admin/api/common/common.php");

$ordersheet_idx             = $_POST['ordersheet_idx'];
$product_idx                = $_POST['product_idx'];

// 독립몰 상품 항목
$style_code                 = $_POST['shop_style_code'];
$style_code_str             = '';
if($style_code != null){
    $style_code_str         = " STYLE_CODE = '".$style_code."', ";
}
$shop_color_code            = $_POST['shop_color_code'];
$shop_color_code_str        = '';
if($shop_color_code != null){
    $shop_color_code_str    = " COLOR_CODE = '".$shop_color_code."', ";
}
$product_code               = $_POST['shop_product_code'];
$product_code_str           = '';
if($product_code != null){
    $product_code_str       = " PRODUCT_CODE = '".$product_code."', ";
}

$shop_product_name              = $_POST['shop_product_name'];
$shop_product_name_update_flg   = $_POST['shop_product_name_update_flg'];
$shop_product_name_str          = '';
if($shop_product_name_update_flg == 'true'){
    $shop_product_name_str               = " PRODUCT_NAME = '".$shop_product_name."', ";
}

$md_category_flg = $_POST['md_category_flg'];
if($md_category_flg == 'true'){
    $category_idx = '0';
    $md_category_1              = $_POST['md_category_idx'][0];
    $md_category_1_str          = '';
    if($md_category_1 == '' || $md_category_1 == null){
        $md_category_1 = '0';
        $category_idx = '0';
    }
    $md_category_1_str          = " MD_CATEGORY_1 = ".$md_category_1.", ";

    $md_category_2              = $_POST['md_category_idx'][1];
    $md_category_2_str          = '';
    if($md_category_2 == '' || $md_category_2 == null){
        $md_category_2 = '0';
        if($md_category_1 != '0'){
            $category_idx = $md_category_1;
        }
    }
    $md_category_2_str          = " MD_CATEGORY_2 = ".$md_category_2.", ";

    $md_category_3              = $_POST['md_category_idx'][2];
    $md_category_3_str          = '';
    if($md_category_3 == '' || $md_category_3 == null){
        $md_category_3 = '0';
        if($md_category_2 != '0'){
            $category_idx = $md_category_2;
        }
    }
    $md_category_3_str          = " MD_CATEGORY_3 = ".$md_category_3.", ";

    $md_category_4              = $_POST['md_category_idx'][3];
    $md_category_4_str          = '';
    if($md_category_4 == '' || $md_category_4 == null){
        $md_category_4 = '0';
        if($md_category_3 != '0'){
            $category_idx = $md_category_3;
        }
    }
    $md_category_4_str          = " MD_CATEGORY_4 = ".$md_category_4.", ";

    $md_category_5              = $_POST['md_category_idx'][4];
    $md_category_5_str          = '';
    if($md_category_5 == '' || $md_category_5 == null){
        $md_category_5 = '0';
        if($md_category_4 != '0'){
            $category_idx = $md_category_4;
        }
    }
    $md_category_5_str          = " MD_CATEGORY_5 = ".$md_category_5.", ";

    $md_category_6              = $_POST['md_category_idx'][5];
    $md_category_6_str          = '';
    if($md_category_6 == '' || $md_category_6 == null){
        $md_category_6 = '0';
        if($md_category_5 != '0'){
            $category_idx = $md_category_5;
        }
    }
    $md_category_6_str          = " MD_CATEGORY_6 = ".$md_category_6.", ";
    $category_idx               = " CATEGORY_IDX = ".$category_idx.", ";
}

$mileage_flg                = $_POST['mileage_flg'];
$mileage_flg_str            = '';
if($mileage_flg != null){
    $mileage_flg_str        = " MILEAGE_FLG = ".$mileage_flg.", ";
}
$exclusive_flg              = $_POST['exclusive_flg'];
$exclusive_flg_str          = '';
if($exclusive_flg != null){
    $exclusive_flg_str      = " EXCLUSIVE_FLG = ".$exclusive_flg.", ";
}

$price_kr                       = $_POST['price_kr'];
$price_kr_update_flg            = $_POST['price_kr_update_flg'];
$price_kr_str = '';
if ($price_kr_update_flg == 'true') {
    if($price_kr == '' || $price_kr == null){
        $price_kr = '0';
    }
    $price_kr_str               = " PRICE_KR = ".$price_kr.",";
}
$price_en                       = $_POST['price_en'];
$price_en_update_flg            = $_POST['price_en_update_flg'];
$price_en_str = '';
if ($price_en_update_flg == 'true') {
    if($price_en == '' || $price_en == null){
        $price_en = '0';
    }
    $price_en_str               = " PRICE_EN = ".$price_en.",";
}
$price_cn                       = $_POST['price_cn'];
$price_cn_update_flg            = $_POST['price_cn_update_flg'];
$price_cn_str = '';
if ($price_cn_update_flg == 'true') {
    if($price_cn == '' || $price_cn == null){
        $price_cn = '0';
    }
    $price_cn_str               = " PRICE_CN = ".$price_cn.",";
}

$discount_kr                    = $_POST['discount_kr'];
$discount_kr_update_flg         = $_POST['discount_kr_update_flg'];
$discount_kr_str = '';
if ($discount_kr_update_flg == 'true') {
    if($discount_kr == '' || $discount_kr == null){
        $discount_kr = '0';
    }
    $discount_kr_str            = " DISCOUNT_KR = ".$discount_kr.",";
}
$discount_en                    = $_POST['discount_en'];
$discount_en_update_flg         = $_POST['discount_en_update_flg'];
$discount_en_str = '';
if ($discount_en_update_flg == 'true') {
    if($discount_en == '' || $discount_en == null){
        $discount_en = '0';
    }
    $discount_en_str            = " DISCOUNT_EN = ".$discount_en.",";
}
$discount_cn                    = $_POST['discount_cn'];
$discount_cn_update_flg         = $_POST['discount_cn_update_flg'];
$discount_cn_str = '';
if ($discount_cn_update_flg == 'true') {
    if($discount_cn == '' || $discount_cn == null){
        $discount_cn = '0';
    }
    $discount_cn_str            = " DISCOUNT_CN = ".$discount_cn.",";
}

$sales_price_kr                 = $_POST['sales_price_kr'];
$sales_price_kr_update_flg      = $_POST['sales_price_kr_update_flg'];
$sales_price_kr_str = '';
if ($sales_price_kr_update_flg == 'true') {
    if($sales_price_kr == '' || $sales_price_kr == null){
        $sales_price_kr = '0';
    }
    $sales_price_kr_str           = " SALES_PRICE_KR = ".$sales_price_kr.",";
}
$sales_price_en                 = $_POST['sales_price_en'];
$sales_price_en_update_flg      = $_POST['sales_price_en_update_flg'];
$sales_price_en_str = '';
if ($sales_price_en_update_flg == 'true') {
    if($sales_price_en == '' || $sales_price_en == null){
        $sales_price_en = '0';
    }
    $sales_price_en_str         = " SALES_PRICE_EN = ".$sales_price_en.",";
}
$sales_price_cn                 = $_POST['sales_price_cn'];
$sales_price_cn_update_flg      = $_POST['sales_price_cn_update_flg'];
$sales_price_cn_str = '';
if ($sales_price_cn_update_flg == 'true') {
    if($sales_price_cn == '' || $sales_price_cn == null){
        $sales_price_cn = '0';
    }
    $sales_price_cn_str         = " SALES_PRICE_CN = ".$sales_price_cn.",";
}

$limit_member_update_flg        = $_POST['limit_member_update_flg'];
$limit_member                   = $_POST['limit_member'];
$limit_member_str = '';
if ($limit_member_update_flg == 'true') {
    if(!isset($limit_member) || !is_array($limit_member)){
        $limit_member = 'NULL';
    }
    else{
        $limit_member = "'".implode(",", $limit_member)."'";
    }
    $limit_member_str           = " LIMIT_MEMBER = ".$limit_member.",";
}

$limit_purchase_qty_flg         = $_POST['limit_purchase_qty_flg'];
$limit_purchase_qty_flg_str = '';
if($limit_purchase_qty_flg != null){
    $limit_purchase_qty_flg_str = " LIMIT_PURCHASE_QTY_FLG = ".$limit_purchase_qty_flg.", ";
}

$limit_purchase_qty_min_update_flg  = $_POST['limit_purchase_qty_min_update_flg'];
$limit_purchase_qty_min             = $_POST['limit_purchase_qty_min'];
$limit_purchase_qty_min_str = '';
if ($limit_purchase_qty_min_update_flg == 'true') {
    if($limit_purchase_qty_min == '' || $limit_purchase_qty_min == null){
        $limit_purchase_qty_min = '0';
    }
    $limit_purchase_qty_min_str     = " LIMIT_PURCHASE_QTY_MIN = ".$limit_purchase_qty_min.",";
}

$limit_purchase_qty_max_update_flg  = $_POST['limit_purchase_qty_max_update_flg'];
$limit_purchase_qty_max             = $_POST['limit_purchase_qty_max'];
$limit_purchase_qty_max_str = '';
if ($limit_purchase_qty_max_update_flg == 'true') {
    if($limit_purchase_qty_max == '' || $limit_purchase_qty_max == null){
        $limit_purchase_qty_max = '0';
    }
    $limit_purchase_qty_max_str     = " LIMIT_PURCHASE_QTY_MAX = ".$limit_purchase_qty_max.",";
}

$product_keyword_update_flg     = $_POST['product_keyword_update_flg'];
$product_keyword                = $_POST['product_keyword'];
$product_keyword_str = '';
if ($product_keyword_update_flg == 'true') {
    $product_keyword_str        = " PRODUCT_KEYWORD = '".$product_keyword."',";
}

$product_tag_update_flg         = $_POST['product_tag_update_flg'];
$product_tag                    = $_POST['product_tag'];
$product_tag_str = '';
if ($product_tag_update_flg == 'true') {
    if(!isset($product_tag) || !is_array($product_tag)){
        $product_tag = 'NULL';
    }
    else{
        $product_tag = "'".implode(",", $product_tag)."'";
    }
    $product_tag_str           = " PRODUCT_TAG = ".$product_tag.",";
}

$custom_clearance_update_flg     = $_POST['custom_clearance_update_flg'];
$custom_clearance                = $_POST['custom_clearance'];
$clearance_idx_str = '';
if ($custom_clearance_update_flg == 'true') {
    if($clearance_idx == NULL){
        $clearance_idx = 'NULL';
    }
    $clearance_idx_str        = " CLEARANCE_IDX = (SELECT IDX FROM dev.CUSTOM_CLEARANCE WHERE HS_CODE = '".$custom_clearance."'),";
}

$relevant_update_flg     = $_POST['relevant_update_flg'];
$relevant_idx                = $_POST['relevant_idx'];
$relevant_idx_str = '';
if ($relevant_update_flg == 'true') {
    if($relevant_idx == NULL){
        $relevant_idx = 'NULL';
    }
    $relevant_idx_str        = " RELEVANT_IDX = '".$relevant_idx."',";
}

$sold_out_qty_update_flg    = $_POST['sold_out_qty_update_flg'];
$sold_out_qty               = $_POST['sold_out_qty'];
$sold_out_qty_str = '';
if ($sold_out_qty_update_flg == 'true') {
    if($sold_out_qty == '' || $sold_out_qty == null){
        $sold_out_qty = '0';
    }
    $sold_out_qty_str       = " SOLD_OUT_QTY = ".$sold_out_qty.",";
}

$detail_kr                  = $_POST['detail_kr'];
$detail_kr_update_flg       = $_POST['detail_kr_update_flg'];
$detail_kr_str = '';
if($detail_kr_update_flg == 'true'){
    $detail_kr = str_replace("<p>&nbsp;</p>","",$detail_kr);
    if ($detail_kr != null) {
        $detail_kr_str          = " DETAIL_KR = '".$detail_kr."',";
    }
    else{
        $detail_kr_str          = " DETAIL_KR = NULL,";
    }
}

$detail_en                  = $_POST['detail_en'];
$detail_en_update_flg       = $_POST['detail_en_update_flg'];
$detail_en_str = '';
if($detail_en_update_flg == 'true'){
    $detail_en = str_replace("<p>&nbsp;</p>","",$detail_en);
    if ($detail_en != null) {
        $detail_en_str      = " DETAIL_EN = '".$detail_en."',";
    }
    else{
        $detail_en_str      = " DETAIL_EN = NULL,";
    }
}
$detail_cn                  = $_POST['detail_cn'];
$detail_cn_update_flg       = $_POST['detail_cn_update_flg'];
$detail_cn_str = '';
if($detail_cn_update_flg == 'true'){
    $detail_cn = str_replace("<p>&nbsp;</p>","",$detail_cn);
    if ($detail_cn != null) {
        $detail_cn_str      = " DETAIL_CN = '".$detail_cn."',";
    }
    else{
        $detail_cn_str      = " DETAIL_CN = NULL,";
    }
}

$care_kr                    = $_POST['care_kr'];
$care_kr_update_flg         = $_POST['care_kr_update_flg'];
$care_kr_str = '';
$care_dsn_kr_str = '';
$care_td_kr_str = '';
if($care_kr_update_flg == 'true'){
    $care_kr = str_replace("<p>&nbsp;</p>","",$care_kr);
    if ($care_kr != null) {
        $care_kr_str        = " CARE_KR = '".$care_kr."',";
        $care_dsn_kr_str    = " CARE_DSN_KR = '".$care_kr."',";
        $care_td_kr_str     = " CARE_TD_KR = '".$care_kr."',";
    }
    else{
        $care_kr_str        = " CARE_KR = NULL,";
        $care_dsn_kr_str    = " CARE_DSN_KR = NULL,";
        $care_td_kr_str     = " CARE_TD_KR = NULL,";
    }
}
$care_en                    = $_POST['care_en'];
$care_en_update_flg         = $_POST['care_en_update_flg'];
$care_en_str = '';
$care_dsn_en_str = '';
$care_td_en_str = '';
if($care_en_update_flg == 'true'){
    $care_en = str_replace("<p>&nbsp;</p>","",$care_en);
    if ($care_en != null) {
        $care_en_str        = " CARE_EN = '".$care_en."',";
        $care_dsn_en_str    = " CARE_DSN_EN = '".$care_en."',";
        $care_td_en_str     = " CARE_TD_EN = '".$care_en."',";
    }
    else{
        $care_en_str        = " CARE_EN = NULL,";
        $care_dsn_en_str    = " CARE_DSN_EN = NULL,";
        $care_td_en_str     = " CARE_TD_EN = NULL,";
    }
}
$care_cn                    = $_POST['care_cn'];
$care_cn_update_flg         = $_POST['care_cn_update_flg'];
$care_cn_str = '';
$care_dsn_cn_str = '';
$care_td_cn_str = '';
if($care_cn_update_flg == 'true'){
    $care_cn = str_replace("<p>&nbsp;</p>","",$care_cn);
    if ($care_cn != null) {
        $care_cn_str        = " CARE_CN = '".$care_cn."',";
        $care_dsn_cn_str    = " CARE_DSN_CN = '".$care_cn."',";
        $care_td_cn_str     = " CARE_TD_CN = '".$care_cn."',";
    }
    else{
        $care_cn_str        = " CARE_CN = NULL,";
        $care_dsn_cn_str    = " CARE_DSN_CN = NULL,";
        $care_td_cn_str     = " CARE_TD_CN = NULL,";
    }
}

$material_kr                = $_POST['material_kr'];
$material_kr_update_flg     = $_POST['material_kr_update_flg'];
$material_kr_str = '';
if($material_kr_update_flg == 'true'){
    $material_kr = str_replace("<p>&nbsp;</p>","",$material_kr);
    if ($material_kr != null) {
        $material_kr_str    = " MATERIAL_KR = '".$material_kr."',";
    }
    else{
        $material_kr_str    = " MATERIAL_KR = NULL,";
    }
}
$material_en                = $_POST['material_en'];
$material_en_update_flg     = $_POST['material_en_update_flg'];
$material_en_str = '';
if($material_en_update_flg == 'true'){
    $material_en = str_replace("<p>&nbsp;</p>","",$material_en);
    if ($material_en != null) {
        $material_en_str    = " MATERIAL_EN = '".$material_en."',";
    }
    else{
        $material_en_str    = " MATERIAL_EN = NULL,";
    }
}
$material_cn                = $_POST['material_cn'];
$material_cn_update_flg     = $_POST['material_cn_update_flg'];
$material_cn_str = '';
if($material_cn_update_flg == 'true'){
    $material_cn = str_replace("<p>&nbsp;</p>","",$material_cn);
    if ($material_cn != null) {
        $material_cn_str    = " MATERIAL_CN = '".$material_cn."',";
    }
    else{
        $material_cn_str    = " MATERIAL_CN = NULL,";
    }
}
$refund_msg_flg             = $_POST['refund_msg_flg'];

$refund_msg_update_flg      = $_POST['refund_msg_update_flg'];
$refund_msg                 = $_POST['refund_msg'];
$refund_msg_str = '';
if ($refund_msg_update_flg == 'true') {
    $refund_msg_str         = " REFUND_MSG = '".$refund_msg."',";
}

$refund_kr                  = $_POST['refund_kr'];
$refund_kr_update_flg       = $_POST['refund_kr_update_flg'];
$refund_kr_str = '';
if($refund_kr_update_flg == 'true'){
    $refund_kr = str_replace("<p>&nbsp;</p>","",$refund_kr);
    if ($refund_kr != null) {
        $refund_kr_str      = " REFUND_KR = '".$refund_kr."',";
    }
    else{
        $refund_kr_str      = " REFUND_KR = NULL,";
    }
}
$refund_en                  = $_POST['refund_en'];
$refund_en_update_flg       = $_POST['refund_en_update_flg'];
$refund_en_str = '';
if($refund_en_update_flg == 'true'){
    $refund_en = str_replace("<p>&nbsp;</p>","",$refund_en);
    if ($refund_en != null) {
        $refund_en_str      = " REFUND_EN = '".$refund_en."',";
    }
    else{
        $refund_en_str      = " REFUND_EN = NULL,";
    }
}
$refund_cn                  = $_POST['refund_cn'];
$refund_cn_update_flg       = $_POST['refund_cn_update_flg'];
$refund_cn_str = '';
if($refund_cn_update_flg == 'true'){
    $refund_cn = str_replace("<p>&nbsp;</p>","",$refund_cn);
    if ($refund_cn != null) {
        $refund_cn_str      = " REFUND_CN = '".$refund_cn."',";
    }
    else{
        $refund_cn_str      = " REFUND_CN = NULL,";
    }
}

$memo                       = $_POST['memo'];
$memo_update_flg            = $_POST['memo_update_flg'];
$memo_str = '';
if($memo_update_flg == 'true'){
    $memo = str_replace("<p>&nbsp;</p>","",$memo);
    if ($memo != null) {
        $memo_str           = " MEMO = '".$memo."',";
    }
    else{
        $memo_str           = " MEMO = NULL,";
    }
}

$seo_exposure_flg           = $_POST['seo_exposure_flg'];

$seo_title_update_flg       = $_POST['seo_title_update_flg'];
$seo_title                  = $_POST['seo_title'];
$seo_title_str = '';
if ($seo_title_update_flg == 'true') {
    $seo_title_str        = " SEO_TITLE = '".$seo_title."',";
}
$seo_author_update_flg      = $_POST['seo_author_update_flg'];
$seo_author                 = $_POST['seo_author'];
$seo_author_str = '';
if ($seo_author_update_flg == 'true') {
    $seo_author_str        = " SEO_AUTHOR = '".$seo_author."',";
}
$seo_description            = $_POST['seo_description'];
$seo_description_update_flg = $_POST['seo_description_update_flg'];
$seo_description_str = '';
if($seo_description_update_flg == 'true'){
    $seo_description = str_replace("<p>&nbsp;</p>","",$seo_description);
    if ($seo_description != null) {
        $seo_description_str    = " SEO_DESCRIPTION = '".$seo_description."',";
    }
    else{
        $seo_description_str    = " SEO_DESCRIPTION = NULL,";
    }
}
$seo_keywords               = $_POST['seo_keywords'];
$seo_keywords_update_flg    = $_POST['seo_keywords_update_flg'];
$seo_keywords               = $_POST['seo_keywords'];
$seo_keywords_str = '';
if ($seo_keywords_update_flg == 'true') {
    $seo_keywords_str       = " SEO_KEYWORDS = '".$seo_keywords."',";
}
$seo_alt_text               = $_POST['seo_alt_text'];
$seo_alt_text_update_flg    = $_POST['seo_alt_text_update_flg'];
$seo_alt_text_str = '';
if($seo_alt_text_update_flg == 'true'){
    $seo_alt_text = str_replace("<p>&nbsp;</p>","",$seo_alt_text);
    if ($seo_alt_text != null) {
        $seo_alt_text_str   = " SEO_ALT_TEXT = '".$seo_alt_text."',";
    }
    else{
        $seo_alt_text_str   = " SEO_ALT_TEXT = NULL,";
    }
}

$product_idx_list           = $_POST['product_idx_list'];
$option_list_str            = $_POST['option_list_str'];

$filter_cl					= $_POST['filter_cl'];
$filter_cl_str = "";
if ($filter_cl != null) {
	$filter_cl_str = " FILTER_CL = '".implode(",",$filter_cl)."', ";
}

$filter_ft					= $_POST['filter_ft'];
$filter_gp					= $_POST['filter_gp'];
$filter_ln					= $_POST['filter_ln'];

$filter_sz					= $_POST['filter_sz'];
$filter_sz_str = "";
if ($filter_sz != null) {
	$filter_sz_str = " FILTER_SZ = '".implode(",",$filter_sz)."', ";
}

$db->begin_transaction();

try {
    if($ordersheet_idx != null){

        //오더시트 항목(세트상품 수정)
        $preorder_flg               = $_POST['preorder_flg'];
        $preorder_flg_str           = '';
        if($preorder_flg != null){
            $preorder_flg_str       = " PREORDER_FLG = ".$preorder_flg.", ";
        }
        $refund_flg                 = $_POST['refund_flg'];
        $refund_flg_str             = '';
        if($refund_flg != null){
            $refund_flg_str         = " REFUND_FLG = ".$refund_flg.", ";
        }

        $line_idx                   = $_POST['line_idx'];
        $line_update_flg            = $_POST['line_update_flg'];
        $line_idx_str               = '';
        if($line_update_flg == 'true'){
            $line_idx_str           = " LINE_IDX = ".$line_idx.", ";
        }

        $material                   = $_POST['material'];
        $material_update_flg        = $_POST['material_update_flg'];
        $material_str               = '';
        if($material_update_flg == 'true'){
            $material_str           = " MATERIAL = '".$material."', ";
        }
        $graphic                    = $_POST['graphic'];
        $graphic_update_flg         = $_POST['graphic_update_flg'];
        $graphic_str                = '';
        if($graphic_update_flg == 'true'){
            $graphic_str            = " GRAPHIC = '".$graphic."', ";
        }
        $fit                        = $_POST['fit'];
        $fit_update_flg             = $_POST['fit_update_flg'];
        $fit_str                    = '';
        if($fit_update_flg == 'true'){
            $fit_str                = " FIT = '".$fit."', ";
        }
        $product_name               = $_POST['product_name'];
        $product_name_update_flg    = $_POST['product_name_update_flg'];
        $product_name_str           = '';
        if($product_name_update_flg == 'true'){
            $product_name_str       = " PRODUCT_NAME = '".$product_name."', ";
        }
        
        $product_size               = $_POST['product_size'];
        $product_size_update_flg    = $_POST['product_size_update_flg'];
        $product_size_str           = '';
        if($product_size_update_flg == 'true'){
            $product_size_str       = " PRODUCT_SIZE = '".$product_size."', ";
        }
        $color                      = $_POST['color'];
        $color_update_flg           = $_POST['color_update_flg'];
        $color_str                  = '';
        if($color_update_flg == 'true'){
            $color_str              = " COLOR = '".$color."', ";
        }
        $color_rgb                  = $_POST['color_rgb'];
        $color_rgb_update_flg       = $_POST['color_rgb_update_flg'];
        $color_rgb_str              = '';
        if($color_rgb_update_flg == 'true'){
            $color_rgb_str          = " COLOR_RGB = '".$color_rgb."', ";
        }
        $pantone_code               = $_POST['pantone_code'];
        $pantone_code_update_flg    = $_POST['pantone_code_update_flg'];
        $pantone_code_str           = '';
        if($pantone_code_update_flg == 'true'){
            $pantone_code_str       = " PANTONE_CODE = '".$pantone_code."', ";
        }
        $wkla_idx                   = $_POST['wkla_idx'];
        $wkla_update_flg            = $_POST['wkla_update_flg'];
        $wkla_idx_str               = '';
        if($wkla_update_flg == 'true'){
            $wkla_idx_str           = " WKLA_IDX = ".$wkla_idx.", ";
        }
        $load_box_idx               = $_POST['load_box_idx'];
        $load_box_update_flg        = $_POST['load_box_update_flg'];
        $load_box_idx_str           = '';
        if($load_box_update_flg == 'true'){
            $load_box_idx_str       = " LOAD_BOX_IDX = ".$load_box_idx.", ";
        }

        $load_weight                = $_POST['load_weight'];
        $load_weight_update_flg     = $_POST['load_weight_update_flg'];
        $load_weight_str            = '';
        if($load_weight_update_flg == 'true'){
            if($load_weight == null){
                $load_weight = 'NULL';
            }
            $load_weight_str        = " LOAD_WEIGHT = ".$load_weight.", ";
        }
        $load_qty                   = $_POST['load_qty'];
        $load_qty_update_flg        = $_POST['load_qty_update_flg'];
        $load_qty_str               = '';
        if($load_qty_update_flg == 'true'){
            if($load_weight == null){
                $load_weight = 'NULL';
            }
            $load_qty_str           = " LOAD_QTY = ".$load_qty.", ";
        }

        $sub_material_update_flg            = $_POST['sub_material_update_flg'];
        if($sub_material_update_flg == 'true'){
            $td_sub_material_idx            = $_POST['td_sub_material_idx'];
            $td_sub_material_idx_str        = '';
            if($td_sub_material_idx == NULL || !is_array($td_sub_material_idx)){
                $td_sub_material_idx        = 'NULL';
            }
            else{
                $td_sub_material_idx        = "'".implode(",", $td_sub_material_idx)."'";
            }
            $td_sub_material_idx_str        = " TD_SUB_MATERIAL_IDX = ".$td_sub_material_idx.", ";

            $delivery_sub_material_idx      = $_POST['delivery_sub_material_idx'];
            $delivery_sub_material_idx_str  = '';
            if($delivery_sub_material_idx == NULL || !is_array($delivery_sub_material_idx)){
                $delivery_sub_material_idx = 'NULL';
            }
            else{
                $delivery_sub_material_idx = "'".implode(",", $delivery_sub_material_idx)."'";
            }
            $delivery_sub_material_idx_str        = " DELIVERY_SUB_MATERIAL_IDX = ".$delivery_sub_material_idx.", ";
        }

        $ordersheet_sql  = "
            UPDATE dev.ORDERSHEET_MST
            SET
                ".$style_code_str."
                ".$color_code_str."
                ".$product_code_str."
                ".$product_size_str."
                ".$preorder_flg_str."
                ".$refund_flg_str."
                ".$line_idx_str."
                ".$material_str."
                ".$graphic_str."
                ".$fit_str."
                ".$product_name_str."
                ".$color_str."
                ".$color_rgb_str."
                ".$pantone_code_str."
                ".$price_kr_str."
                ".$price_en_str."
                ".$price_cn_str."
                ".$wkla_idx_str."
                ".$detail_kr_str."
                ".$detail_en_str."
                ".$detail_cn_str."
                ".$care_dsn_kr_str."
                ".$care_dsn_en_str."
                ".$care_dsn_cn_str."
                ".$care_td_kr_str."
                ".$care_td_en_str."
                ".$care_td_cn_str."
                ".$material_kr_str."
                ".$material_en_str."
                ".$material_cn_str."
                ".$load_box_idx_str."
                ".$deliver_box_idx_str."
                ".$load_weight_str."
                ".$load_qty_str."
                ".$td_sub_material_idx_str."
                ".$delivery_sub_material_idx_str."
                UPDATE_DATE =   NOW()
            WHERE
                IDX = ".$ordersheet_idx."
            ";
        $db->query($ordersheet_sql);
        $ordersheet_update_cnt = 0;
        $ordersheet_update_cnt = $db->mysqli_affected_rows();
        
        if ($ordersheet_update_cnt > 0) {
            $product_sql = "
                    UPDATE
						dev.SHOP_PRODUCT
                    SET
                        ".$style_code_str."
                        ".$color_code_str."
                        ".$product_code_str."
                        ".$shop_product_name_str."
                        ".$md_category_1_str."
                        ".$md_category_2_str."
                        ".$md_category_3_str."
                        ".$md_category_4_str."
                        ".$md_category_5_str."
                        ".$md_category_6_str."
                        ".$category_idx_str."
                        ".$mileage_flg_str."
                        ".$exclusive_flg_str."
                        ".$price_kr_str."
                        ".$discount_kr_str."
                        ".$sales_price_kr_str."
                        ".$price_en_str."
                        ".$discount_en_str."
                        ".$sales_price_en_str."
                        ".$price_cn_str."
                        ".$discount_cn_str."
                        ".$sales_price_cn_str."
                        ".$limit_member_str."
                        ".$limit_purchase_qty_flg_str."
                        ".$limit_purchase_qty_min_str."
                        ".$limit_purchase_qty_max_str."
                        ".$product_keyword_str."
                        ".$product_tag_str."
                        ".$clearance_idx_str."
                        ".$relevant_idx_str."
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
                        ".$refund_msg_str."
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
						".$filter_cl_str."
						FILTER_FT = ".$filter_ft.",
						FILTER_GP = ".$filter_gp.",
						FILTER_LN = ".$filter_ln.",
						".$filter_sz_str."
                        UPDATE_DATE = NOW()
                    WHERE
                        IDX = ".$product_idx." ";
        }
        $db->query($product_sql);
        $prod_update_cnt = $db->mysqli_affected_rows();
        
        if ($prod_update_cnt > 0) {
            $delete_sql = "
                    DELETE FROM 
                        dev.SET_PRODUCT
                    WHERE
                        SET_PRODUCT_IDX = ".$product_idx." ";
            $db->query($delete_sql);

            for ($i=0; $i<count($product_idx_list); $i++) {
                $option_idx = '';
                if($option_list_str[$i] != null){
                    $option_idx = $option_list_str[$i];
                };
                $set_product_sql = "INSERT INTO
                                        dev.SET_PRODUCT
                                        (
                                            SET_PRODUCT_IDX,
                                            PRODUCT_IDX,
                                            OPTION_IDX,
                                            CREATER,
                                            UPDATER
                                        ) VALUES (
                                            ".$product_idx.",
                                            ".$product_idx_list[$i].",
                                            '".$option_idx."',
                                            'Admin',
                                            'Admin'
                                        )";
                $db->query($set_product_sql);
            }
        }
    }
    else{
        if ($product_idx != null) {
            $product_sql = "
                    UPDATE dev.SHOP_PRODUCT
                    SET
                        ".$style_code_str."
                        ".$color_code_str."
                        ".$product_code_str."
                        ".$shop_product_name_str."
                        ".$md_category_1_str."
                        ".$md_category_2_str."
                        ".$md_category_3_str."
                        ".$md_category_4_str."
                        ".$md_category_5_str."
                        ".$md_category_6_str."
                        ".$category_idx_str."
                        ".$mileage_flg_str."
                        ".$exclusive_flg_str."
                        ".$price_kr_str."
                        ".$discount_kr_str."
                        ".$sales_price_kr_str."
                        ".$price_en_str."
                        ".$discount_en_str."
                        ".$sales_price_en_str."
                        ".$price_cn_str."
                        ".$discount_cn_str."
                        ".$sales_price_cn_str."
                        ".$limit_member_str."
                        ".$limit_purchase_qty_flg_str."
                        ".$limit_purchase_qty_min_str."
                        ".$limit_purchase_qty_max_str."
                        ".$product_keyword_str."
                        ".$product_tag_str."
                        ".$clearance_idx_str."
                        ".$relevant_idx_str."
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
                        ".$refund_msg_str."
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
						".$filter_cl_str."
						FILTER_FT = ".$filter_ft.",
						FILTER_GP = ".$filter_gp.",
						FILTER_LN = ".$filter_ln.",
						".$filter_sz_str."
                        UPDATE_DATE = NOW()
                    WHERE
                        IDX = ".$product_idx." ";
        }
        $db->query($product_sql);
    }
    if($_POST['ftp_img_flg'] == 'true'){
        $img_url = $_POST['img_url'];
        $tmp_arr = explode('/',$img_url);

        $ftp_dir = $tmp_arr[count($tmp_arr)-2];
        $product_dir_name = $tmp_arr[count($tmp_arr)-1];
        
        
        //"/ader_prod_img";
        $server_img_path = "/var/www/admin/www/images/product/";
        
        $upload_file = url_to_file_up($ftp_dir, $server_img_path, $product_dir_name);
        
        if ($upload_file != null) {
            for ($i=0; $i<count($upload_file); $i++) {
                $img_type = $upload_file[$i]['img_type'];
                $img_url = $img_location = $upload_file[$i]['url'];
                $img_location = "";
                if($upload_file[$i]['img_size'] == 'L'){
                    $img_location = $upload_file[$i]['url'];
                } else{
                    $img_location = $server_img_path.$upload_file[$i]['filename'];
                }
                $img_size = $upload_file[$i]['img_size'];
                
                $img_sql = "
                            INSERT INTO
                                dev.PRODUCT_IMG
                            (
                                PRODUCT_IDX,
                                PRODUCT_CODE,
                                IMG_TYPE,
                                IMG_SIZE,
                                IMG_URL,
                                IMG_LOCATION,
                                CREATE_DATE,
                                CREATER,
                                UPDATE_DATE,
                                UPDATER
                            )
                            VALUES
                            (
                                ".$product_idx.",
                                '".$product_code."',
                                '".$img_type."',
                                '".$img_size."',
                                '".$img_url."',
                                '".$img_location."',
                                NOW(),
                                'Admin',
                                NOW(),
                                'Admin'
                            )";
                $db->query($img_sql);
            }
        }
    }
    $db->commit();
    
    $json_result['code'] = 200;
    return $json_result;
} 
catch(mysqli_sql_exception $exception){
    echo $exception->getMessage();
    $json_result['code'] = 301;
    $db->rollback();
    $msg = "등록작업에 실패했습니다.";
}

?>
