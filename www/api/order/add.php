<?php
/*
 +=============================================================================
 | 
 | 상품 색상 별 사이즈 재고 확인
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.10.13
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$product_style_code = $_POST['product_style_code'];
$product_style_code_arr = array();
if ($product_style_code != null) {
	$product_style_code_arr[0] = ' PRODUCT_STYLE_CODE, ';
	$product_style_code_arr[1] = "'".$product_style_code."',";
}

$product_code = $_POST['product_code'];
$product_code_arr = array();
if ($product_code != null) {
	$product_code_arr[0] = ' PRODUCT_CODE, ';
	$product_code_arr[1] = "'".$product_code."',";
}

$pl_lrg_category = $_POST['pl_lrg_category'];
$pl_lrg_category_arr = array();
if ($pl_lrg_category != null) {
	$pl_lrg_category_arr[0] = ' PL_LRG_CATEGORY, ';
	$pl_lrg_category_arr[1] = "'".$pl_lrg_category."',";
}

$pl_mdl_category = $_POST['pl_mdl_category'];
$pl_mdl_category_arr = array();
if ($pl_mdl_category != null) {
	$pl_mdl_category_arr[0] = ' PL_MDL_CATEGORY, ';
	$pl_mdl_category_arr[1] = "'".$pl_mdl_category."',";
}

$pl_sml_category = $_POST['pl_sml_category'];
$pl_sml_category_arr = array();
if ($pl_sml_category != null) {
	$pl_sml_category_arr[0] = ' PL_SML_CATEGORY, ';
	$pl_sml_category_arr[1] = "'".$pl_sml_category."',";
}

$pl_dtl_category = $_POST['pl_dtl_category'];
$pl_dtl_category_arr = array();
if ($pl_dtl_category != null) {
	$pl_dtl_category_arr[0] = ' PL_DTL_CATEGORY, ';
	$pl_dtl_category_arr[1] = "'".$pl_dtl_category."',";
}

$material = $_POST['material'];
$material_arr = array();
if ($material != null) {
	$material_arr[0] = ' MATERIAL, ';
	$material_arr[1] = "'".$material."',";
}

$graphic = $_POST['graphic'];
$graphic_arr = array();
if ($graphic != null) {
	$graphic_arr[0] = ' GRAPHIC, ';
	$graphic_arr[1] = "'".$graphic."',";
}

$fit = $_POST['fit'];
$fit_arr = array();
if ($fit != null) {
	$fit_arr[0] = ' FIT, ';
	$fit_arr[1] = "'".$fit."',";
}

$product_name = $_POST['product_name'];
$product_name_arr = array();
if ($product_name != null) {
	$product_name_arr[0] = ' PRODUCT_NAME, ';
	$product_name_arr[1] = "'".$product_name."',";
}

$size = $_POST['size'];
$size_arr = array();
if ($size != null) {
	$size_arr[0] = ' SIZE, ';
	$size_arr[1] = "'".$size."',";
}

$color = $_POST['color'];
$color_arr = array();
if ($color != null) {
	$color_arr[0] = ' COLOR, ';
	$color_arr[1] = "'".$color."',";
}

$color_code = $_POST['color_code'];
$color_code_arr = array();
if ($color_code != null) {
	$color_code_arr[0] = ' COLOR_CODE, ';
	$color_code_arr[1] = "'".$color_code."',";
}

$navigation = $_POST['navigation'];
$navigation_arr = array();
if ($navigation != null) {
	$navigation_arr[0] = ' NAVIGATION, ';
	$navigation_arr[1] = "'".$navigation."',";
}

$limit_purchase_member_ext = $_POST['limit_purchase_member_ext'];
$limit_purchase_member_ext_arr = array();
if ($limit_purchase_member_ext != null) {
	$limit_purchase_member_ext_arr[0] = ' LIMIT_PURCHASE_MEMBER_EXT, ';
	$limit_purchase_member_ext_arr[1] = "'".$tmp_str."',";
}

$pl_qty = $_POST['pl_qty'];
$pl_qty_arr = array();
if ($pl_qty != null) {
	$pl_qty_arr[0] = ' PL_QTY, ';
	$pl_qty_arr[1] = $pl_qty.",";
}

$pre_order_flg = $_POST['pre_order_flg'];
$pre_order_flg_arr = array();
if ($pre_order_flg != null) {
	$pre_order_flg_arr[0] = ' PRE_ORDER_FLG, ';
	$pre_order_flg_arr[1] = $pre_order_flg.",";
}

//오더시트 - material
$wkla = $_POST['wkla'];
$wkla_arr = array();
if ($wkla != null) {
	$wkla_arr[0] = ' WKLA, ';
	$wkla_arr[1] = "'".$wkla."',";
}

$material_kr = $_POST['material_kr'];
$material_kr = str_replace("<p>&nbsp;</p>","",$material_kr);
$material_kr_arr = array();
if ($material_kr != null) {
	$material_kr_arr[0] = ' MATERIAL_KR, ';
	$material_kr_arr[1] = "'".$material_kr."',";
}

$material_en = $_POST['material_en'];
$material_en = str_replace("<p>&nbsp;</p>","",$material_en);
$material_en_arr = array();
if ($material_en != null) {
	$material_en_arr[0] = ' MATERIAL_EN, ';
	$material_en_arr[1] = "'".$material_en."',";
}

$material_cn = $_POST['material_cn'];
$material_cn = str_replace("<p>&nbsp;</p>","",$material_cn);
$material_cn_arr = array();
if ($material_cn != null) {
	$material_cn_arr[0] = ' MATERIAL_CN, ';
	$material_cn_arr[1] = "'".$material_cn."',";
}

//오더시트 - size
$size_detail_model = $_POST['size_detail_model'];
$size_detail_model_arr = array();
if ($size_detail_model != null) {
	$size_detail_model_arr[0] = ' SIZE_DETAIL_MODEL, ';
	$size_detail_model_arr[1] = "'".$size_detail_model."',";
}

$size_detail_wear = $_POST['size_detail_wear'];
$size_detail_wear_arr = array();
if ($size_detail_wear != null) {
	$size_detail_wear_arr[0] = ' SIZE_DETAIL_WEAR, ';
	$size_detail_wear_arr[1] = "'".$size_detail_wear."',";
}

$size_detail_a1_kr = $_POST['size_detail_a1_kr'];
$size_detail_a1_kr = str_replace("<p>&nbsp;</p>","",$size_detail_a1_kr);
$size_detail_a1_kr_arr = array();
if ($size_detail_a1_kr != null) {
	$size_detail_a1_kr_arr[0] = ' SIZE_DETAIL_A1_KR, ';
	$size_detail_a1_kr_arr[1] = "'".$size_detail_a1_kr."',";
}

$size_detail_a2_kr = $_POST['size_detail_a2_kr'];
$size_detail_a2_kr = str_replace("<p>&nbsp;</p>","",$size_detail_a2_kr);
$size_detail_a2_kr_arr = array();
if ($size_detail_a2_kr != null) {
	$size_detail_a2_kr_arr[0] = ' SIZE_DETAIL_A2_KR, ';
	$size_detail_a2_kr_arr[1] = "'".$size_detail_a2_kr."',";
}

$size_detail_a3_kr = $_POST['size_detail_a3_kr'];
$size_detail_a3_kr = str_replace("<p>&nbsp;</p>","",$size_detail_a3_kr);
$size_detail_a3_kr_arr = array();
if ($size_detail_a3_kr != null) {
	$size_detail_a3_kr_arr[0] = ' SIZE_DETAIL_A3_KR, ';
	$size_detail_a3_kr_arr[1] = "'".$size_detail_a3_kr."',";
}

$size_detail_a4_kr = $_POST['size_detail_a4_kr'];
$size_detail_a4_kr = str_replace("<p>&nbsp;</p>","",$size_detail_a4_kr);
$size_detail_a4_kr_arr = array();
if ($size_detail_a4_kr != null) {
	$size_detail_a4_kr_arr[0] = ' SIZE_DETAIL_A4_KR, ';
	$size_detail_a4_kr_arr[1] = "'".$size_detail_a4_kr."',";
}

$size_detail_a5_kr = $_POST['size_detail_a5_kr'];
$size_detail_a5_kr = str_replace("<p>&nbsp;</p>","",$size_detail_a5_kr);
$size_detail_a5_kr_arr = array();
if ($size_detail_a5_kr != null) {
	$size_detail_a5_kr_arr[0] = ' SIZE_DETAIL_A5_KR, ';
	$size_detail_a5_kr_arr[1] = "'".$size_detail_a5_kr."',";
}

$size_detail_onesize_kr = $_POST['size_detail_onesize_kr'];
$size_detail_onesize_kr = str_replace("<p>&nbsp;</p>","",$size_detail_onesize_kr);
$size_detail_onesize_kr_arr = array();
if ($size_detail_onesize_kr != null) {
	$size_detail_onesize_kr_arr[0] = ' SIZE_DETAIL_ONESIZE_KR, ';
	$size_detail_onesize_kr_arr[1] = "'".$size_detail_onesize_kr."',";
}

$size_detail_a1_en = $_POST['size_detail_a1_en'];
$size_detail_a1_en = str_replace("<p>&nbsp;</p>","",$size_detail_a1_en);
$size_detail_a1_en_arr = array();
if ($size_detail_a1_en != null) {
	$size_detail_a1_en_arr[0] = ' SIZE_DETAIL_A1_EN, ';
	$size_detail_a1_en_arr[1] = "'".$size_detail_a1_en."',";
}

$size_detail_a2_en = $_POST['size_detail_a2_en'];
$size_detail_a2_en = str_replace("<p>&nbsp;</p>","",$size_detail_a2_en);
$size_detail_a2_en_arr = array();
if ($size_detail_a2_en != null) {
	$size_detail_a2_en_arr[0] = ' SIZE_DETAIL_A2_EN, ';
	$size_detail_a2_en_arr[1] = "'".$size_detail_a2_en."',";
}

$size_detail_a3_en = $_POST['size_detail_a3_en'];
$size_detail_a3_en = str_replace("<p>&nbsp;</p>","",$size_detail_a3_en);
$size_detail_a3_en_arr = array();
if ($size_detail_a3_en != null) {
	$size_detail_a3_en_arr[0] = ' SIZE_DETAIL_A3_EN, ';
	$size_detail_a3_en_arr[1] = "'".$size_detail_a3_en."',";
}

$size_detail_a4_en = $_POST['size_detail_a4_en'];
$size_detail_a4_en = str_replace("<p>&nbsp;</p>","",$size_detail_a4_en);
$size_detail_a4_en_arr = array();
if ($size_detail_a4_en != null) {
	$size_detail_a4_en_arr[0] = ' SIZE_DETAIL_A4_EN, ';
	$size_detail_a4_en_arr[1] = "'".$size_detail_a4_en."',";
}

$size_detail_a5_en = $_POST['size_detail_a5_en'];
$size_detail_a5_en = str_replace("<p>&nbsp;</p>","",$size_detail_a5_en);
$size_detail_a5_en_arr = array();
if ($size_detail_a5_en != null) {
	$size_detail_a5_en_arr[0] = ' SIZE_DETAIL_A5_EN, ';
	$size_detail_a5_en_arr[1] = "'".$size_detail_a5_en."',";
}

$size_detail_onesize_en = $_POST['size_detail_onesize_en'];
$size_detail_onesize_en = str_replace("<p>&nbsp;</p>","",$size_detail_onesize_en);
$size_detail_onesize_en_arr = array();
if ($size_detail_onesize_en != null) {
	$size_detail_onesize_en_arr[0] = ' SIZE_DETAIL_ONESIZE_EN, ';
	$size_detail_onesize_en_arr[1] = "'".$size_detail_onesize_en."',";
}

$size_detail_a1_cn = $_POST['size_detail_a1_cn'];
$size_detail_a1_cn = str_replace("<p>&nbsp;</p>","",$size_detail_a1_cn);
$size_detail_a1_cn_arr = array();
if ($size_detail_a1_cn != null) {
	$size_detail_a1_cn_arr[0] = ' SIZE_DETAIL_A1_CN, ';
	$size_detail_a1_cn_arr[1] = "'".$size_detail_a1_cn."',";
}

$size_detail_a2_cn = $_POST['size_detail_a2_cn'];
$size_detail_a2_cn = str_replace("<p>&nbsp;</p>","",$size_detail_a2_cn);
$size_detail_a2_cn_arr = array();
if ($size_detail_a2_cn != null) {
	$size_detail_a2_cn_arr[0] = ' SIZE_DETAIL_A2_CN, ';
	$size_detail_a2_cn_arr[1] = "'".$size_detail_a2_cn."',";
}

$size_detail_a3_cn = $_POST['size_detail_a3_cn'];
$size_detail_a3_cn = str_replace("<p>&nbsp;</p>","",$size_detail_a3_cn);
$size_detail_a3_cn_arr = array();
if ($size_detail_a3_cn != null) {
	$size_detail_a3_cn_arr[0] = ' SIZE_DETAIL_A3_CN, ';
	$size_detail_a3_cn_arr[1] = "'".$size_detail_a3_cn."',";
}

$size_detail_a4_cn = $_POST['size_detail_a4_cn'];
$size_detail_a4_cn = str_replace("<p>&nbsp;</p>","",$size_detail_a4_cn);
$size_detail_a4_cn_arr = array();
if ($size_detail_a4_cn != null) {
	$size_detail_a4_cn_arr[0] = ' SIZE_DETAIL_A4_CN, ';
	$size_detail_a4_cn_arr[1] = "'".$size_detail_a4_cn."',";
}

$size_detail_a5_cn = $_POST['size_detail_a5_cn'];
$size_detail_a5_cn = str_replace("<p>&nbsp;</p>","",$size_detail_a5_cn);
$size_detail_a5_cn_arr = array();
if ($size_detail_a5_cn != null) {
	$size_detail_a5_cn_arr[0] = ' SIZE_DETAIL_A5_CN, ';
	$size_detail_a5_cn_arr[1] = "'".$size_detail_a5_cn."',";
}

$size_detail_onesize_cn = $_POST['size_detail_onesize_cn'];
$size_detail_onesize_cn = str_replace("<p>&nbsp;</p>","",$size_detail_onesize_cn);
$size_detail_onesize_cn_arr = array();
if ($size_detail_onesize_cn != null) {
	$size_detail_onesize_cn_arr[0] = ' SIZE_DETAIL_ONESIZE_CN, ';
	$size_detail_onesize_cn_arr[1] = "'".$size_detail_onesize_cn."',";
}

//오더시트 - care
$care_kr = $_POST['care_kr'];
$care_kr = str_replace("<p>&nbsp;</p>","",$care_kr);
$care_kr_arr = array();
if ($care_kr != null) {
	$care_kr_arr[0] = ' CARE_KR, ';
	$care_kr_arr[1] = "'".$care_kr."',";
}

$care_en = $_POST['care_en'];
$care_en = str_replace("<p>&nbsp;</p>","",$care_en);
$care_en_arr = array();
if ($care_en != null) {
	$care_en_arr[0] = ' CARE_EN, ';
	$care_en_arr[1] = "'".$care_en."',";
}

$care_cn = $_POST['care_cn'];
$care_cn = str_replace("<p>&nbsp;</p>","",$care_cn);
$care_cn_arr = array();
if ($care_cn != null) {
	$care_cn_arr[0] = ' CARE_CN, ';
	$care_cn_arr[1] = "'".$care_cn."',";
}

//오더시트 - detail
$detail_kr = $_POST['detail_kr'];
$detail_kr = str_replace("<p>&nbsp;</p>","",$detail_kr);
$detail_kr_arr = array();
if ($detail_kr != null) {
	$detail_kr_arr[0] = ' DETAIL_KR, ';
	$detail_kr_arr[1] = "'".$detail_kr."',";
}

$detail_en = $_POST['detail_en'];
$detail_en = str_replace("<p>&nbsp;</p>","",$detail_en);
$detail_en_arr = array();
if ($detail_en != null) {
	$detail_en_arr[0] = ' DETAIL_EN, ';
	$detail_en_arr[1] = "'".$detail_en."',";
}

$detail_cn = $_POST['detail_cn'];
$detail_cn = str_replace("<p>&nbsp;</p>","",$detail_cn);
$detail_cn_arr = array();
if ($detail_cn != null) {
	$detail_cn_arr[0] = ' DETAIL_CN, ';
	$detail_cn_arr[1] = "'".$detail_cn."',";
}

//오더시트 - price
$price_kr = $_POST['price_kr'];
$price_kr_arr = array();
if ($price_kr != null) {
	$price_kr_arr[0] = ' PRICE_KR, ';
	$price_kr_arr[1] = $price_kr.",";
}

$price_kr_gb = $_POST['price_kr_gb'];
$price_kr_gb_arr = array();
if ($price_kr_gb != null) {
	$price_kr_gb_arr[0] = ' PRICE_KR_GB, ';
	$price_kr_gb_arr[1] = $price_kr_gb.",";
}

$price_en = $_POST['price_en'];
$price_en_arr = array();
if ($price_en != null) {
	$price_en_arr[0] = ' PRICE_EN, ';
	$price_en_arr[1] = $price_en.",";
}

$price_cn = $_POST['price_cn'];
$price_cn_arr = array();
if ($price_cn != null) {
	$price_cn_arr[0] = ' PRICE_CN, ';
	$price_cn_arr[1] = $price_cn.",";
}

//판매정보 - 판매정보
$md_category_1 = $_POST['md_category_1'];
$md_category_1_arr = array();
if ($md_category_1 != null) {
	$md_category_1_arr[0] = ' MD_CATEGORY_1, ';
	$md_category_1_arr[1] = $md_category_1.",";
}

$md_category_2 = $_POST['md_category_2'];
$md_category_2_arr = array();
if ($md_category_2 != null) {
	$md_category_2_arr[0] = ' MD_CATEGORY_2, ';
	$md_category_2_arr[1] = $md_category_2.",";
}

$md_category_3 = $_POST['md_category_3'];
$md_category_3_arr = array();
if ($md_category_3 != null) {
	$md_category_3_arr[0] = ' MD_CATEGORY_3, ';
	$md_category_3_arr[1] = $md_category_3.",";
}

$md_category_4 = $_POST['md_category_4'];
$md_category_4_arr = array();
if ($md_category_4 != null) {
	$md_category_4_arr[0] = ' MD_CATEGORY_4, ';
	$md_category_4_arr[1] = $md_category_4.",";
}

$md_category_5 = $_POST['md_category_5'];
$md_category_5_arr = array();
if ($md_category_5 != null) {
	$md_category_5_arr[0] = ' MD_CATEGORY_5, ';
	$md_category_5_arr[1] = $md_category_5.",";
}

$md_category_6 = $_POST['md_category_6'];
$md_category_6_arr = array();
if ($md_category_6 != null) {
	$md_category_6_arr[0] = ' MD_CATEGORY_6, ';
	$md_category_6_arr[1] = $md_category_6.",";
}

$category_idx = $_POST['category_idx'];
$category_idx_arr = array();
if ($category_idx != null) {
	$category_idx_arr[0] = ' CATEGORY_IDX, ';
	$category_idx_arr[1] = $category_idx.",";
}

$sales_price_kr = $_POST['sales_price_kr'];
$sales_price_kr_arr = array();
if ($sales_price_kr != null) {
	$sales_price_kr_arr[0] = ' SALES_PRICE_KR, ';
	$sales_price_kr_arr[1] = $sales_price_kr.",";
}

$sales_price_en = $_POST['sales_price_en'];
$sales_price_en_arr = array();
if ($sales_price_en != null) {
	$sales_price_en_arr[0] = ' SALES_PRICE_EN, ';
	$sales_price_en_arr[1] = $sales_price_en.",";
}

$sales_price_cn = $_POST['sales_price_cn'];
$sales_price_cn_arr = array();
if ($sales_price_cn != null) {
	$sales_price_cn_arr[0] = ' SALES_PRICE_CN, ';
	$sales_price_cn_arr[1] = $sales_price_cn.",";
}

$option_stock_set = $_POST['option_stock_set'];
$option_stock_set_arr = array();
if ($option_stock_set != null) {
	$option_stock_set_arr[0] = ' OPTION_STOCK_SET, ';
	$option_stock_set_arr[1] = "'".$option_stock_set."',";
}

$limit_purchase_member = $_POST['limit_purchase_member'];
$limit_purchase_member_arr = array();
if ($limit_purchase_member != null) {
	$limit_purchase_member_arr[0] = ' LIMIT_PURCHASE_MEMBER, ';
	$tmp_str = implode(',',$limit_purchase_member);
	$limit_purchase_member_arr[1] = "'".$tmp_str."',";
}

$mileage_flg = $_POST['mileage_flg'];
$mileage_flg_arr = array();
if ($mileage_flg != null) {
	$mileage_flg_arr[0] = ' MILEAGE_FLG, ';
	$mileage_flg_arr[1] = $mileage_flg.",";
}

$limit_purchase_single = $_POST['limit_purchase_single'];
$limit_purchase_single_arr = array();
if ($limit_purchase_single != null) {
	$limit_purchase_single_arr[0] = ' LIMIT_PURCHASE_SINGLE, ';
	$limit_purchase_single_arr[1] = $limit_purchase_single.",";
}

$limit_purchase_qty_min_num = $_POST['limit_purchase_qty_min_num'];
$limit_purchase_qty_min_num_arr = array();
if ($limit_purchase_qty_min_num != null) {
	$limit_purchase_qty_min_num_arr[0] = ' LIMIT_PURCHASE_QTY_MIN_NUM, ';
	$limit_purchase_qty_min_num_arr[1] = $limit_purchase_qty_min_num.",";
}

$limit_purchase_qty_max_num = $_POST['limit_purchase_qty_max_num'];
$limit_purchase_qty_max_num_arr = array();
if ($limit_purchase_qty_max_num != null) {
	$limit_purchase_qty_max_num_arr[0] = ' LIMIT_PURCHASE_QTY_MAX_NUM, ';
	$limit_purchase_qty_max_num_arr[1] = $limit_purchase_qty_max_num.",";
}

$detail_refund_kr = $_POST['detail_refund_kr'];
$detail_refund_kr = str_replace("<p>&nbsp;</p>","",$detail_refund_kr);
$detail_refund_kr_arr = array();
if ($detail_refund_kr != null) {
	$detail_refund_kr_arr[0] = ' DETAIL_REFUND_KR, ';
	$detail_refund_kr_arr[1] = "'".$detail_refund_kr."',";
}

$detail_refund_en = $_POST['detail_refund_en'];
$detail_refund_en = str_replace("<p>&nbsp;</p>","",$detail_refund_en);
$detail_refund_en_arr = array();
if ($detail_refund_en != null) {
	$detail_refund_en_arr[0] = ' DETAIL_REFUND_EN, ';
	$detail_refund_en_arr[1] = "'".$detail_refund_en."',";
}

$detail_refund_cn = $_POST['detail_refund_cn'];
$detail_refund_cn = str_replace("<p>&nbsp;</p>","",$detail_refund_cn);
$detail_refund_cn_arr = array();
if ($detail_refund_cn != null) {
	$detail_refund_cn_arr[0] = ' DETAIL_REFUND_CN, ';
	$detail_refund_cn_arr[1] = "'".$detail_refund_cn."',";
}

$product_keyword = $_POST['product_keyword'];
$product_keyword_arr = array();
if ($product_keyword != null) {
	$product_keyword_arr[0] = ' PRODUCT_KEYWORD, ';
	$product_keyword_arr[1] = "'".$product_keyword."',";
}

$product_tag = $_POST['product_tag'];
$product_tag_arr = array();
if ($product_tag != null) {
	$product_tag_arr[0] = ' PRODUCT_TAG, ';
	$product_tag_arr[1] = "'".implode(",",$product_tag)."', ";
}

$img_product_detail = $_POST['img_product_detail'];
$img_product_detail = str_replace("<p>&nbsp;</p>","",$img_product_detail);
$img_product_detail_arr = array();
if ($img_product_detail != null) {
	$img_product_detail_arr[0] = ' IMG_PRODUCT_DETAIL, ';
	$img_product_detail_arr[1] = "'".$img_product_detail."',";
}

$img_wear_detail = $_POST['img_wear_detail'];
$img_wear_detail = str_replace("<p>&nbsp;</p>","",$img_wear_detail);
$img_wear_detail_arr = array();
if ($img_wear_detail != null) {
	$img_wear_detail_arr[0] = ' IMG_WEAR_DETAIL, ';
	$img_wear_detail_arr[1] = "'".$img_wear_detail."',";
}

//판매정보 - 배송정보
$hs_code = $_POST['hs_code'];
$hs_code_arr = array();
if ($hs_code != null) {
	$hs_code_arr[0] = ' HS_CODE, ';
	$hs_code_arr[1] = "'".$hs_code."',";
}

$product_total_weight = $_POST['product_total_weight'];
$product_total_weight_arr = array();
if ($product_total_weight != null) {
	$product_total_weight_arr[0] = ' PRODUCT_TOTAL_WEIGHT, ';
	$product_total_weight_arr[1] = $product_total_weight.",";
}

$product_division = $_POST['product_division'];
$product_division_arr = array();
if ($product_division != null) {
	$product_division_arr[0] = ' PRODUCT_DIVISION, ';
	$product_division_arr[1] = "'".$product_division."',";
}

$product_material_kr = $_POST['product_material_kr'];
$product_material_kr_arr = array();
if ($product_material_kr != null) {
	$product_material_kr_arr[0] = ' PRODUCT_MATERIAL_KR, ';
	$product_material_kr_arr[1] = "'".$product_material_kr."',";
}

$product_material_en = $_POST['product_material_en'];
$product_material_en_arr = array();
if ($product_material_en != null) {
	$product_material_en_arr[0] = ' PRODUCT_MATERIAL_EN, ';
	$product_material_en_arr[1] = "'".$product_material_en."',";
}

$fabric = $_POST['fabric'];
$fabric_arr = array();
if ($fabric != null) {
	$fabric_arr[0] = ' FABRIC, ';
	$fabric_arr[1] = "'".$fabric."',";
}


//판매정보 - 제작정보
$manufacturer = $_POST['manufacturer'];
$manufacturer_arr = array();
if ($manufacturer != null) {
	$manufacturer_arr[0] = ' MANUFACTURER, ';
	$manufacturer_arr[1] = "'".$manufacturer."',";
}

$supplier = $_POST['supplier'];
$supplier_arr = array();
if ($supplier != null) {
	$supplier_arr[0] = ' SUPPLIER, ';
	$supplier_arr[1] = "'".$supplier."',";
}

$origin_country = $_POST['origin_country'];
$origin_country_arr = array();
if ($origin_country != null) {
	$origin_country_arr[0] = ' ORIGIN_COUNTRY, ';
	$origin_country_arr[1] = "'".$origin_country."',";
}

$brand = $_POST['brand'];
$brand_arr = array();
if ($brand != null) {
	$brand_arr[0] = ' BRAND, ';
	$brand_arr[1] = "'".$brand."',";
}

$trend = $_POST['trend'];
$trend_arr = array();
if ($trend != null) {
	$trend_arr[0] = ' TREND, ';
	$trend_arr[1] = "'".$trend."',";
}

$self_classification = $_POST['self_classification'];
$self_classification_arr = array();
if ($self_classification != null) {
	$self_classification_arr[0] = ' SELF_CLASSIFICATION, ';
	$self_classification_arr[1] = "'".$self_classification."',";
}

$manufacturing_date = $_POST['manufacturing_date'];
$manufacturing_date_arr = array();
if ($manufacturing_date != null) {
	$manufacturing_date_arr[0] = ' MANUFACTURING_DATE, ';
	$manufacturing_date_arr[1] = "'".$manufacturing_date."',";
}

$release_date = $_POST['release_date'];
$release_date_arr = array();
if ($release_date != null) {
	$release_date_arr[0] = ' RELEASE_DATE, ';
	$release_date_arr[1] = "'".$release_date."',";
}

$validate_start_date = $_POST['validate_start_date'];
$validate_start_date_arr = array();
if ($validate_start_date != null) {
	$validate_start_date_arr[0] = ' VALIDATE_START_DATE, ';
	$validate_start_date_arr[1] = "'".$validate_start_date."',";
}

$validate_end_date = $_POST['validate_end_date'];
$validate_end_date_arr = array();
if ($validate_end_date != null) {
	$validate_end_date_arr[0] = ' VALIDATE_END_DATE, ';
	$validate_end_date_arr[1] = "'".$validate_end_date."',";
}

$product_width = $_POST['product_width'];
$product_width_arr = array();
if ($product_width != null) {
	$product_width_arr[0] = ' PRODUCT_WIDTH, ';
	$product_width_arr[1] = $product_width.",";
}

$product_depth = $_POST['product_depth'];
$product_depth_arr = array();
if ($product_depth != null) {
	$product_depth_arr[0] = ' PRODUCT_DEPTH, ';
	$product_depth_arr[1] = $product_depth.",";
}

$product_height = $_POST['product_height'];
$product_height_arr = array();
if ($product_height != null) {
	$product_height_arr[0] = ' PRODUCT_HEIGHT, ';
	$product_height_arr[1] = $product_height.",";
}

$product_volume = $_POST['product_volume'];
$product_volume_arr = array();
if ($product_volume != null) {
	$product_volume_arr[0] = ' PRODUCT_VOLUME, ';
	$product_volume_arr[1] = $product_volume.",";
}

$seo_exposure_flg = $_POST['seo_exposure_flg'];
$seo_exposure_flg_arr = array();
if ($seo_exposure_flg != null) {
	$seo_exposure_flg_arr[0] = ' SEO_EXPOSURE_FLG, ';
	$seo_exposure_flg_arr[1] = $seo_exposure_flg.", ";
}

$seo_title = $_POST['seo_title'];
$seo_title_arr = array();
if ($seo_title != null) {
	$seo_title_arr[0] = ' SEO_TITLE, ';
	$seo_title_arr[1] = "'".$seo_title."', ";
}

$seo_author = $_POST['seo_author'];
$seo_author_arr = array();
if ($seo_author != null) {
	$seo_author_arr[0] = ' SEO_AUTHOR, ';
	$seo_author_arr[1] = "'".$seo_author."', ";
}

$seo_description = $_POST['seo_description'];
$seo_description_arr = array();
if ($seo_description != null) {
	$seo_description_arr[0] = ' SEO_DESCRIPTION, ';
	$seo_description_arr[1] = "'".$seo_description."', ";
}

$seo_keywords = $_POST['seo_keywords'];
$seo_keywords_arr = array();
if ($seo_keywords != null) {
	$seo_keywords_arr[0] = ' SEO_KEYWORDS, ';
	$seo_keywords_arr[1] = "'".$seo_keywords."', ";
}

$seo_alt_text = $_POST['seo_alt_text'];
$seo_alt_text_arr = array();
if ($seo_alt_text != null) {
	$seo_alt_text_arr[0] = ' SEO_ALT_TEXT, ';
	$seo_alt_text_arr[1] = "'".$seo_alt_text."', ";
}

//검색 유형 - 디폴트
$sql = 	"INSERT INTO
			SHOP_PRODUCT
		(
			".$product_style_code_arr[0]."
			".$product_code_arr[0]."
			".$pl_lrg_category_arr[0]."
			".$pl_mdl_category_arr[0]."
			".$pl_sml_category_arr[0]."
			".$pl_dtl_category_arr[0]."
			".$material_arr[0]."
			".$graphic_arr[0]."
			".$fit_arr[0]."
			".$product_name_arr[0]."
			".$size_arr[0]."
			".$color_arr[0]."
			".$color_code_arr[0]."
			".$navigation_arr[0]."
			".$limit_purchase_member_ext_arr[0]."
			".$pl_qty_arr[0]."
			".$pre_order_flg_arr[0]."
			".$wkla_arr[0]."
			".$material_kr_arr[0]."
			".$material_en_arr[0]."
			".$material_cn_arr[0]."
			".$size_detail_model_arr[0]."
			".$size_detail_wear_arr[0]."
			".$size_detail_a1_kr_arr[0]."
			".$size_detail_a2_kr_arr[0]."
			".$size_detail_a3_kr_arr[0]."
			".$size_detail_a4_kr_arr[0]."
			".$size_detail_a5_kr_arr[0]."
			".$size_detail_onesize_kr_arr[0]."
			".$size_detail_a1_en_arr[0]."
			".$size_detail_a2_en_arr[0]."
			".$size_detail_a3_en_arr[0]."
			".$size_detail_a4_en_arr[0]."
			".$size_detail_a5_en_arr[0]."
			".$size_detail_onesize_en_arr[0]."
			".$size_detail_a1_cn_arr[0]."
			".$size_detail_a2_cn_arr[0]."
			".$size_detail_a3_cn_arr[0]."
			".$size_detail_a4_cn_arr[0]."
			".$size_detail_a5_cn_arr[0]."
			".$size_detail_onesize_cn_arr[0]."
			".$care_kr_arr[0]."
			".$care_en_arr[0]."
			".$care_cn_arr[0]."
			".$detail_kr_arr[0]."
			".$detail_en_arr[0]."
			".$detail_cn_arr[0]."
			".$price_kr_arr[0]."
			".$price_kr_gb_arr[0]."
			".$price_en_arr[0]."
			".$price_cn_arr[0]."
			".$md_category_1_arr[0]."
			".$md_category_2_arr[0]."
			".$md_category_3_arr[0]."
			".$md_category_4_arr[0]."
			".$md_category_5_arr[0]."
			".$md_category_6_arr[0]."
			".$category_idx_arr[0]."
			".$sales_price_kr_arr[0]."
			".$sales_price_en_arr[0]."
			".$sales_price_cn_arr[0]."
			".$option_stock_set_arr[0]."
			".$limit_purchase_member_arr[0]."
			".$mileage_flg_arr[0]."
			".$limit_purchase_single_arr[0]."
			".$limit_purchase_qty_min_num_arr[0]."
			".$limit_purchase_qty_max_num_arr[0]."
			".$detail_refund_kr_arr[0]."
			".$detail_refund_en_arr[0]."
			".$detail_refund_cn_arr[0]."
			".$product_keyword_arr[0]."
			".$product_tag_arr[0]."
			".$img_product_detail_arr[0]."
			".$img_wear_detail_arr[0]."
			".$hs_code_arr[0]."
			".$product_total_weight_arr[0]."
			".$product_division_arr[0]."
			".$product_material_kr_arr[0]."
			".$product_material_en_arr[0]."
			".$fabric_arr[0]."
			".$manufacturer_arr[0]."
			".$supplier_arr[0]."
			".$origin_country_arr[0]."
			".$brand_arr[0]."
			".$trend_arr[0]."
			".$self_classification_arr[0]."
			".$manufacturing_date_arr[0]."
			".$release_date_arr[0]."
			".$validate_start_date_arr[0]."
			".$validate_end_date_arr[0]."
			".$product_width_arr[0]."
			".$product_depth_arr[0]."
			".$product_height_arr[0]."
			".$product_volume_arr[0]."
			".$seo_exposure_flg_arr[0]."
			".$seo_title_arr[0]."
			".$seo_author_arr[0]."
			".$seo_description_arr[0]."
			".$seo_keywords_arr[0]."
			".$seo_alt_text_arr[0]."
			CREATE_DATE,
			CREATER,
			UPDATE_DATE,
			UPDATER
		)
		VALUES
		(
			".$product_style_code_arr[1]."
			".$product_code_arr[1]."
			".$pl_lrg_category_arr[1]."
			".$pl_mdl_category_arr[1]."
			".$pl_sml_category_arr[1]."
			".$pl_dtl_category_arr[1]."
			".$material_arr[1]."
			".$graphic_arr[1]."
			".$fit_arr[1]."
			".$product_name_arr[1]."
			".$size_arr[1]."
			".$color_arr[1]."
			".$color_code_arr[1]."
			".$navigation_arr[1]."
			".$limit_purchase_member_ext_arr[1]."
			".$pl_qty_arr[1]."
			".$pre_order_flg_arr[1]."
			".$wkla_arr[1]."
			".$material_kr_arr[1]."
			".$material_en_arr[1]."
			".$material_cn_arr[1]."
			".$size_detail_model_arr[1]."
			".$size_detail_wear_arr[1]."
			".$size_detail_a1_kr_arr[1]."
			".$size_detail_a2_kr_arr[1]."
			".$size_detail_a3_kr_arr[1]."
			".$size_detail_a4_kr_arr[1]."
			".$size_detail_a5_kr_arr[1]."
			".$size_detail_onesize_kr_arr[1]."
			".$size_detail_a1_en_arr[1]."
			".$size_detail_a2_en_arr[1]."
			".$size_detail_a3_en_arr[1]."
			".$size_detail_a4_en_arr[1]."
			".$size_detail_a5_en_arr[1]."
			".$size_detail_onesize_en_arr[1]."
			".$size_detail_a1_cn_arr[1]."
			".$size_detail_a2_cn_arr[1]."
			".$size_detail_a3_cn_arr[1]."
			".$size_detail_a4_cn_arr[1]."
			".$size_detail_a5_cn_arr[1]."
			".$size_detail_onesize_cn_arr[1]."
			".$care_kr_arr[1]."
			".$care_en_arr[1]."
			".$care_cn_arr[1]."
			".$detail_kr_arr[1]."
			".$detail_en_arr[1]."
			".$detail_cn_arr[1]."
			".$price_kr_arr[1]."
			".$price_kr_gb_arr[1]."
			".$price_en_arr[1]."
			".$price_cn_arr[1]."
			".$md_category_1_arr[1]."
			".$md_category_2_arr[1]."
			".$md_category_3_arr[1]."
			".$md_category_4_arr[1]."
			".$md_category_5_arr[1]."
			".$md_category_6_arr[1]."
			".$category_idx_arr[1]."
			".$sales_price_kr_arr[1]."
			".$sales_price_en_arr[1]."
			".$sales_price_cn_arr[1]."
			".$option_stock_set_arr[1]."
			".$limit_purchase_member_arr[1]."
			".$mileage_flg_arr[1]."
			".$limit_purchase_single_arr[1]."
			".$limit_purchase_qty_min_num_arr[1]."
			".$limit_purchase_qty_max_num_arr[1]."
			".$detail_refund_kr_arr[1]."
			".$detail_refund_en_arr[1]."
			".$detail_refund_cn_arr[1]."
			".$product_keyword_arr[1]."
			".$product_tag_arr[1]."
			".$img_product_detail_arr[1]."
			".$img_wear_detail_arr[1]."
			".$hs_code_arr[1]."
			".$product_total_weight_arr[1]."
			".$product_division_arr[1]."
			".$product_material_kr_arr[1]."
			".$product_material_en_arr[1]."
			".$fabric_arr[1]."
			".$manufacturer_arr[1]."
			".$supplier_arr[1]."
			".$origin_country_arr[1]."
			".$brand_arr[1]."
			".$trend_arr[1]."
			".$self_classification_arr[1]."
			".$manufacturing_date_arr[1]."
			".$release_date_arr[1]."
			".$validate_start_date_arr[1]."
			".$validate_end_date_arr[1]."
			".$product_width_arr[1]."
			".$product_depth_arr[1]."
			".$product_height_arr[1]."
			".$product_volume_arr[1]."
			".$seo_exposure_flg_arr[1]."
			".$seo_title_arr[1]."
			".$seo_author_arr[1]."
			".$seo_description_arr[1]."
			".$seo_keywords_arr[1]."
			".$seo_alt_text_arr[1]."
			NOW(),
			'Admin',
			NOW(),
			'Admin'
		)
		";
$db->query($sql);

$product_idx = $db->last_id();

if (!empty($product_idx)) {
	// 상품 이미지 업로드
	$path = "/var/www/admin/www/images/product/";
	if($_FILES['img_outfit']['size'] > 0) {
		$file_name_arr = explode('.',$_FILES['img_outfit']['name']);
		$ext = $file_name_arr[1];
		
		$_FILES['img_outfit']['name'] = "img_product_outfit_".$product_code.".".$ext;
		$upload_file = file_up('img_outfit',$path); // 이미지 업로드
		
		for ($i=0; $i<count($upload_file); $i++) {
			$img_sql = "INSERT INTO
						PRODUCT_IMG
					(
						PRODUCT_IDX,
						IMG_TYPE,
						PRODUCT_CODE,
						IMG_SIZE,
						IMG_LOCATION,
						IMG_URL,
						CREATER,
						UPDATER
					) VALUES (
						".$product_idx.",
						'outfit',
						'".$product_code."',
						'".$upload_file[$i]['img_size']."',
						'".$path.$upload_file[$i]['filename']."',
						'".$path.$upload_file[$i]['filename']."',
						'Admin',
						'Admin'
					)";
			$db->query($img_sql);
		}
	}

	if($_FILES['img_product']['size'] > 0) {
		$file_name_arr = explode('.',$_FILES['img_product']['name']);
		$ext = $file_name_arr[1];
		
		$_FILES['img_product']['name'] = "img_product_product_".$product_code.".".$ext;
		$upload_file = file_up('img_product',$path); // 이미지 업로드
		
		for ($i=0; $i<count($upload_file); $i++) {
			$img_sql = "INSERT INTO
						PRODUCT_IMG
					(
						PRODUCT_IDX,
						IMG_TYPE,
						PRODUCT_CODE,
						IMG_SIZE,
						IMG_LOCATION,
						IMG_URL,
						CREATER,
						UPDATER
					) VALUES (
						".$product_idx.",
						'product',
						'".$product_code."',
						'".$upload_file[$i]['img_size']."',
						'".$path.$upload_file[$i]['filename']."',
						'".$path.$upload_file[$i]['filename']."',
						'Admin',
						'Admin'
					)";
			$db->query($img_sql);
		}
	}

	if($_FILES['img_wear']['size'] > 0) {
		$file_name_arr = explode('.',$_FILES['img_wear']['name']);
		$ext = $file_name_arr[1];
		
		$_FILES['img_wear']['name'] = "img_product_wear_".$product_code.".".$ext;
		$upload_file = file_up('img_wear',$path); // 이미지 업로드
		
		for ($i=0; $i<count($upload_file); $i++) {
			$img_sql = "INSERT INTO
						PRODUCT_IMG
					(
						PRODUCT_IDX,
						IMG_TYPE,
						PRODUCT_CODE,
						IMG_SIZE,
						IMG_LOCATION,
						IMG_URL,
						CREATER,
						UPDATER
					) VALUES (
						".$product_idx.",
						'wear',
						'".$product_code."',
						'".$upload_file[$i]['img_size']."',
						'".$path.$upload_file[$i]['filename']."',
						'".$path.$upload_file[$i]['filename']."',
						'Admin',
						'Admin'
					)";
			$db->query($img_sql);
		}
	}
}
?>