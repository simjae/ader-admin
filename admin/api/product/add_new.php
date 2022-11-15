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

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$ordersheet_idx_list        = $_POST['ordersheet_idx_list'];

if($ordersheet_idx_list != null){
    $ordersheet_cnt = $db->count("dev.SHOP_PRODUCT", "ORDERSHEET_IDX IN (".implode(",", $ordersheet_idx_list).")");
    
    if($ordersheet_cnt == 0){
        $sql = "
            INSERT INTO dev.SHOP_PRODUCT
                (   
                    ORDERSHEET_IDX,
                    STYLE_CODE,
                    COLOR_CODE,
                    PRODUCT_CODE,
                    PRODUCT_NAME,
                    INDEPENDENCE_FLG,
                    CREATER,
                    UPDATER
                )
            SELECT
                    IDX,
                    STYLE_CODE,
                    COLOR_CODE,
                    PRODUCT_CODE,
                    PRODUCT_NAME,
                    FALSE,
                    'Admin',
                    'Admin'
            FROM
                    dev.ORDERSHEET_MST
            WHERE
                    IDX IN (".implode(",", $ordersheet_idx_list).")
        ";
        $db->query($sql);
        
        $json_result['code'] = 200;
        return $json_result;
    }
    else{
        $json_result['code'] = 300;
        $json_result['msg'] = "이미 동일한 제품이 독립몰에 등록되었습니다.";
        return $json_result;
    }
}
else{
    $verify_ordersheet_cnt = $db->count('dev.ORDERSHEET_MST', 'PRODUCT_CODE = "'.$product_code.'" ');
    
    $style_code = $_POST['style_code'];
    $style_code_arr = array();
    if ($style_code != null) {
        $style_code_arr[0] = ' STYLE_CODE, ';
        $style_code_arr[1] = "'".$style_code."',";
    }
    
    $color_code = $_POST['color_code'];
    $color_code_arr = array();
    if ($color_code != null) {
        $color_code_arr[0] = ' COLOR_CODE, ';
        $color_code_arr[1] = "'".$color_code."',";
    }
    
    // " ' , . 치환 처리 (이름같이 문자열 긴것들)
    $product_code = $_POST['product_code'];
    $product_code_arr = array();
    if ($product_code != null) {
        $product_code_arr[0] = ' PRODUCT_CODE, ';
        $product_code_arr[1] = "'".$product_code."',";
    }
    
    $preorder_flg = $_POST['preorder_flg'];
    $preorder_flg_arr = array();
    if ($preorder_flg != null) {
        $preorder_flg_arr[0] = ' PREORDER_FLG, ';
        $preorder_flg_arr[1] = $preorder_flg.",";
    }
    $category_lrg = $_POST['category_lrg'];
    $category_lrg_arr = array();
    if ($category_lrg != null) {
        $category_lrg_arr[0] = ' CATEGORY_LRG, ';
        $category_lrg_arr[1] = "'".$category_lrg."',";
    }
    
    $category_mdl = $_POST['category_mdl'];
    $category_mdl_arr = array();
    if ($category_mdl != null) {
        $category_mdl_arr[0] = ' CATEGORY_MDL, ';
        $category_mdl_arr[1] = "'".$category_mdl."',";
    }
    
    $category_sml = $_POST['category_sml'];
    $category_sml_arr = array();
    if ($category_sml != null) {
        $category_sml_arr[0] = ' CATEGORY_SML, ';
        $category_sml_arr[1] = "'".$category_sml."',";
    }
    
    $category_dtl = $_POST['category_dtl'];
    $category_dtl_arr = array();
    if ($category_dtl != null) {
        $category_dtl_arr[0] = ' CATEGORY_DTL, ';
        $category_dtl_arr[1] = "'".$category_dtl."',";
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
    
    $material = $_POST['material'];
    $material_arr = array();
    if ($material != null) {
        $material_arr[0] = ' MATERIAL, ';
        $material_arr[1] = "'".$material."',";
    }
    
    $navigation = $_POST['navigation'];
    $navigation_arr = array();
    if ($navigation != null) {
        $navigation_arr[0] = ' NAVIGATION, ';
        $navigation_arr[1] = "'".$navigation."',";
    }
    
    $product_name = $_POST['product_name'];
    $product_name_arr = array();
    if ($product_name != null) {
        $product_name_arr[0] = ' PRODUCT_NAME, ';
        $product_name_arr[1] = "'".$product_name."',";
    }
    
    $product_size = $_POST['product_size'];
    $product_size_arr = array();
    if ($product_size != null) {
        $product_size_arr[0] = ' PRODUCT_SIZE, ';
        $product_size_arr[1] = "'".$product_size."',";
    }
    
    $color = $_POST['color'];
    $color_arr = array();
    if ($color != null) {
        $color_arr[0] = ' COLOR, ';
        $color_arr[1] = "'".$color."',";
    }
    
    $color_rgb = $_POST['color_rgb'];
    $color_rgb_arr = array();
    if ($color_rgb != null) {
        $color_rgb_arr[0] = ' COLOR_RGB, ';
        $color_rgb_arr[1] = "'".$color_rgb."',";
    }
    
    $limit_qty = $_POST['limit_qty'];
    $limit_qty_arr = array();
    if ($limit_qty != null) {
        $limit_qty_arr[0] = ' LIMIT_QTY, ';
        $limit_qty_arr[1] = "'".$limit_qty."',";
    }
    
    $limit_member = $_POST['limit_member'];
    $limit_memberpl_qty_arr = array();
    if ($limit_member != null) {
        $limit_member_arr[0] = ' LIMIT_MEMBER, ';
        $limit_member_arr[1] = "'".$limit_member."',";
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
    
    $product_qty = $_POST['product_qty'];
    $product_qty_arr = array();
    if ($product_qty != null) {
        $product_qty_arr[0] = ' PRODUCT_QTY, ';
        $product_qty_arr[1] = $product_qty.",";
    }
    
    $product_stock_grade = $_POST['product_stock_grade'];
    $product_stock_grade_arr = array();
    if ($product_stock_grade != null) {
        $product_stock_grade_arr[0] = ' PRODUCT_STOCK_GRADE, ';
        $product_stock_grade_arr[1] = "'".$product_stock_grade."',";
    }
    
    $mileage_flg = $_POST['mileage_flg'];
    $mileage_flg_arr = array();
    if ($mileage_flg != null) {
        $mileage_flg_arr[0] = ' MILEAGE_FLG, ';
        $mileage_flg_arr[1] = $mileage_flg.",";
    }
    
    $exclusive_flg = $_POST['exclusive_flg'];
    $exclusive_flg_arr = array();
    if ($exclusive_flg != null) {
        $exclusive_flg_arr[0] = ' EXCLUSIVE_FLG, ';
        $exclusive_flg_arr[1] = $exclusive_flg.",";
    }
    
    $launching_date = $_POST['launching_date'];
    $launching_date_arr = array();
    if ($launching_date != null) {
        $launching_date_arr[0] = ' LAUNCHING_DATE, ';
        $launching_date_arr[1] = "'".$launching_date."',";
    }
    
    $column_cnt     = $_POST['column_cnt'];
    $stock_grade    = $_POST['stock_grade'];
    $size_category  = $_POST['size_category'];
    $option_name    = $_POST['option_name'];
    $size_code      = $_POST['size_code'];
    $option_size_1  = $_POST['option_size_1'];
    $option_size_2  = $_POST['option_size_2'];
    $option_size_3  = $_POST['option_size_3'];
    $option_size_4  = $_POST['option_size_4'];
    $option_size_5  = $_POST['option_size_5'];
    $option_size_6  = $_POST['option_size_6'];

    $wkla = $_POST['wkla'];
    $wkla_arr = array();
    if ($wkla != null) {
        $wkla_arr[0] = ' WKLA, ';
        $wkla_arr[1] = "'".$wkla."',";
    }

    $model = $_POST['model'];
    $model_arr = array();
    if ($model != null) {
        $model_arr[0] = ' MODEL, ';
        $model_arr[1] = "'".$model."',";
    }

    $model_wear = $_POST['model_wear'];
    $model_wear_arr = array();
    if ($model_wear != null) {
        $model_wear_arr[0] = ' MODEL_WEAR, ';
        $model_wear_arr[1] = "'".$model_wear."',";
    }
    
    $size_a1_kr = xssEncode($_POST['size_a1_kr']);
    $size_a1_kr_arr = array();
    if ($size_a1_kr != null) {
        $size_a1_kr_arr[0] = ' SIZE_A1_KR, ';
        $size_a1_kr_arr[1] = "'".$size_a1_kr."',";

    }

    $size_a2_kr = xssEncode($_POST['size_a2_kr']);
    $size_a2_kr_arr = array();
    if ($size_a2_kr != null) {
        $size_a2_kr_arr[0] = ' SIZE_A2_KR, ';
        $size_a2_kr_arr[1] = "'".$size_a2_kr."',";
    }
    $size_a3_kr = xssEncode($_POST['size_a3_kr']);
    $size_a3_kr_arr = array();
    if ($size_a3_kr != null) {
        $size_a3_kr_arr[0] = ' SIZE_A3_KR, ';
        $size_a3_kr_arr[1] = "'".$size_a3_kr."',";
    }

    $size_a4_kr = xssEncode($_POST['size_a4_kr']);
    $size_a4_kr_arr = array();
    if ($size_a4_kr != null) {
        $size_a4_kr_arr[0] = ' SIZE_A4_KR, ';
        $size_a4_kr_arr[1] = "'".$size_a4_kr."',";
    }

    $size_a5_kr = xssEncode($_POST['size_a5_kr']);
    $size_a5_kr_arr = array();
    if ($size_a5_kr != null) {
        $size_a5_kr_arr[0] = ' SIZE_A5_KR, ';
        $size_a5_kr_arr[1] = "'".$size_a5_kr."',";
    }

    $size_onesize_kr = xssEncode($_POST['size_onesize_kr']);
    $size_onesize_kr_arr = array();
    if ($size_onesize_kr != null) {
        $size_onesize_kr_arr[0] = ' SIZE_ONESIZE_KR, ';
        $size_onesize_kr_arr[1] = "'".$size_onesize_kr."',";
    }

    $size_a1_en = xssEncode($_POST['size_a1_en']);
    $size_a1_en_arr = array();
    if ($size_a1_en != null) {
        $size_a1_en_arr[0] = ' SIZE_A1_EN, ';
        $size_a1_en_arr[1] = "'".$size_a1_en."',";

    }
    $size_a2_en = xssEncode($_POST['size_a2_en']);
    $size_a2_en_arr = array();
    if ($size_a2_en != null) {
        $size_a2_en_arr[0] = ' SIZE_A2_EN, ';
        $size_a2_en_arr[1] = "'".$size_a2_en."',";
    }
    $size_a3_en = xssEncode($_POST['size_a3_en']);
    $size_a3_en_arr = array();
    if ($size_a3_en != null) {
        $size_a3_en_arr[0] = ' SIZE_A3_EN, ';
        $size_a3_en_arr[1] = "'".$size_a3_en."',";
    }

    $size_a4_en = xssEncode($_POST['size_a4_en']);
    $size_a4_en_arr = array();
    if ($size_a4_en != null) {
        $size_a4_en_arr[0] = ' SIZE_A4_EN, ';
        $size_a4_en_arr[1] = "'".$size_a4_en."',";
    }

    $size_a5_en = xssEncode($_POST['size_a5_en']);
    $size_a5_en_arr = array();
    if ($size_a5_en != null) {
        $size_a5_en_arr[0] = ' SIZE_A5_EN, ';
        $size_a5_en_arr[1] = "'".$size_a5_en."',";
    }

    $size_onesize_en = xssEncode($_POST['size_onesize_en']);
    $size_onesize_en_arr = array();
    if ($size_onesize_en != null) {
        $size_onesize_en_arr[0] = ' SIZE_ONESIZE_EN, ';
        $size_onesize_en_arr[1] = "'".$size_onesize_en."',";
    }


    $size_a1_cn = xssEncode($_POST['size_a1_cn']);
    $size_a1_cn_arr = array();
    if ($size_a1_cn != null) {
        $size_a1_cn_arr[0] = ' SIZE_A1_CN, ';
        $size_a1_cn_arr[1] = "'".$size_a1_cn."',";

    }
    $size_a2_cn = xssEncode($_POST['size_a2_cn']);
    $size_a2_cn_arr = array();
    if ($size_a2_cn != null) {
        $size_a2_cn_arr[0] = ' SIZE_A2_CN, ';
        $size_a2_cn_arr[1] = "'".$size_a2_cn."',";
    }
    $size_a3_cn = xssEncode($_POST['size_a3_cn']);
    $size_a3_cn_arr = array();
    if ($size_a3_cn != null) {
        $size_a3_cn_arr[0] = ' SIZE_A3_CN, ';
        $size_a3_cn_arr[1] = "'".$size_a3_cn."',";
    }

    $size_a4_cn = xssEncode($_POST['size_a4_cn']);
    $size_a4_cn_arr = array();
    if ($size_a4_cn != null) {
        $size_a4_cn_arr[0] = ' SIZE_A4_CN, ';
        $size_a4_cn_arr[1] = "'".$size_a4_cn."',";
    }

    $size_a5_cn = xssEncode($_POST['size_a5_cn']);
    $size_a5_cn_arr = array();
    if ($size_a5_cn != null) {
        $size_a5_cn_arr[0] = ' SIZE_A5_CN, ';
        $size_a5_cn_arr[1] = "'".$size_a5_cn."',";
    }

    $size_onesize_cn = xssEncode($_POST['size_onesize_cn']);
    $size_onesize_cn_arr = array();
    if ($size_onesize_cn != null) {
        $size_onesize_cn_arr[0] = ' SIZE_ONESIZE_CN, ';
        $size_onesize_cn_arr[1] = "'".$size_onesize_cn."',";
    }

    $care_kr = $_POST['care_kr'];
    $care_kr_arr = array();
    if ($care_kr != null) {
        $care_kr_arr[0] = ' CARE_KR, ';
        $care_kr_arr[1] = "'".$care_kr."',";
    }

    $care_en = $_POST['care_en'];
    $care_en_arr = array();
    if ($care_en != null) {
        $care_en_arr[0] = ' CARE_en, ';
        $care_en_arr[1] = "'".$care_en."',";
    }

    $care_cn = $_POST['care_cn'];
    $care_cn_arr = array();
    if ($care_cn != null) {
        $care_cn_arr[0] = ' CARE_CN, ';
        $care_cn_arr[1] = "'".$care_cn."',";
    }

    $detail_kr = $_POST['detail_kr'];
    $detail_kr_arr = array();
    if ($detail_kr != null) {
        $detail_kr_arr[0] = ' DETAIL_KR, ';
        $detail_kr_arr[1] = "'".$detail_kr."',";
    }

    $detail_en = $_POST['detail_en'];
    $detail_en_arr = array();
    if ($detail_en != null) {
        $detail_en_arr[0] = ' DETAIL_EN, ';
        $detail_en_arr[1] = "'".$detail_en."',";
    }

    $detail_cn = $_POST['detail_cn'];
    $detail_cn_arr = array();
    if ($detail_cn != null) {
        $detail_cn_arr[0] = ' DETAIL_CN, ';
        $detail_cn_arr[1] = "'".$detail_cn."',";
    }

    $material_kr = $_POST['material_kr'];
	$material_kr_arr = array();
	if ($material_kr != null) {
        $material_kr_arr[0] = ' MATERIAL_KR, ';
        $material_kr_arr[1] = "'".$material_kr."',";
	}

	$material_en = $_POST['material_en'];
	$material_en_arr = array();
	if ($material_en != null) {
        $material_en_arr[0] = ' MATERIAL_EN, ';
        $material_en_arr[1] = "'".$material_en."',";
	}

	$material_cn = $_POST['material_cn'];
	$material_cn_arr = array();
	if ($material_cn != null) {
        $material_cn_arr[0] = ' MATERIAL_CN, ';
        $material_cn_arr[1] = "'".$material_cn."',";
	}

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

	$box_idx = $_POST['box_idx'];
	$box_idx_arr = array();
	if ($box_idx != null) {
        $box_idx_arr[0] = ' BOX_IDX, ';
        $box_idx_arr[1] = $box_idx.",";
	}

	$product_weight = $_POST['product_weight'];
	$product_weight_arr = array();
	if ($product_weight != null) {
        $product_weight_arr[0] = ' PRODUCT_WEIGHT, ';
        $product_weight_arr[1] = $product_weight.",";
	}

    if($product_code != null){
    
        $db->begin_transaction();
    
        try {
            //검색 유형 - 디폴트
            $sql = 	"INSERT INTO
                        dev.ORDERSHEET_MST
                    (
                        ".$style_code_arr[0]."
                        ".$color_code_arr[0]."
                        ".$product_code_arr[0]."
                        ".$preorder_flg_arr[0]."
                        ".$category_lrg_arr[0]."
                        ".$category_mdl_arr[0]."
                        ".$category_sml_arr[0]."
                        ".$category_dtl_arr[0]."
                        ".$material_arr[0]."
                        ".$graphic_arr[0]."
                        ".$fit_arr[0]."
                        ".$product_name_arr[0]."
                        ".$product_size_arr[0]."
                        ".$color_arr[0]."
                        ".$color_rgb_arr[0]."
                        ".$navigation_arr[0]."
                        ".$limit_member_arr[0]."
                        ".$limit_qty_arr[0]."
                        ".$price_kr_arr[0]."
                        ".$price_kr_gb_arr[0]."
                        ".$price_en_arr[0]."
                        ".$price_cn_arr[0]."
                        ".$product_qty_arr[0]."
                        ".$product_stock_grade_arr[0]."
                        ".$mileage_flg_arr[0]."
                        ".$exclusive_flg_arr[0]."
                        ".$launching_date_arr[0]."

                        ".$wkla_arr[0]."
                        ".$model_arr[0]."
                        ".$model_wear_arr[0]."
                        ".$size_a1_kr_arr[0]."
                        ".$size_a2_kr_arr[0]."
                        ".$size_a3_kr_arr[0]."
                        ".$size_a4_kr_str_arr[0]."
                        ".$size_a5_kr_arr[0]."
                        ".$size_onesize_kr_arr[0]."
                        ".$size_a1_en_arr[0]."
                        ".$size_a2_en_arr[0]."
                        ".$size_a3_en_arr[0]."
                        ".$size_a4_en_arr[0]."
                        ".$size_a5_en_arr[0]."
                        ".$size_onesize_en_arr[0]."
                        ".$size_a1_cn_arr[0]."
                        ".$size_a2_cn_arr[0]."
                        ".$size_a3_cn_arr[0]."
                        ".$size_a4_cn_arr[0]."
                        ".$size_a5_cn_arr[0]."
                        ".$size_onesize_cn_arr[0]."
                        ".$care_kr_arr[0]."
                        ".$care_en_arr[0]."
                        ".$care_cn_arr[0]."
                        ".$detail_kr_arr[0]."
                        ".$detail_en_arr[0]."
                        ".$detail_cn_arr[0]."

                        ".$material_kr_arr[0]."
                        ".$material_en_arr[0]."
                        ".$material_cn_arr[0]."
                        ".$manufacturer_arr[0]."
                        ".$supplier_arr[0]."
                        ".$supplier_arr[0]."
                        ".$origin_country_arr[0]."
                        ".$brand_arr[0]."
                        ".$trend_arr[0]."
                        ".$box_idx_arr[0]."
                        ".$product_weight_arr[0]."
    
                        CREATE_DATE,
                        CREATER,
                        UPDATE_DATE,
                        UPDATER
                    )
                    VALUES
                    (
                        ".$style_code_arr[1]."
                        ".$color_code_arr[1]."
                        ".$product_code_arr[1]."
                        ".$preorder_flg_arr[1]."
                        ".$category_lrg_arr[1]."
                        ".$category_mdl_arr[1]."
                        ".$category_sml_arr[1]."
                        ".$category_dtl_arr[1]."
                        ".$material_arr[1]."
                        ".$graphic_arr[1]."
                        ".$fit_arr[1]."
                        ".$product_name_arr[1]."
                        ".$product_size_arr[1]."
                        ".$color_arr[1]."
                        ".$color_rgb_arr[1]."
                        ".$navigation_arr[1]."
                        ".$limit_member_arr[1]."
                        ".$limit_qty_arr[1]."
                        ".$price_kr_arr[1]."
                        ".$price_kr_gb_arr[1]."
                        ".$price_en_arr[1]."
                        ".$price_cn_arr[1]."
                        ".$product_qty_arr[1]."
                        ".$product_stock_grade_arr[1]."
                        ".$mileage_flg_arr[1]."
                        ".$exclusive_flg_arr[1]."
                        ".$launching_date_arr[1]."
    
                        ".$wkla_arr[1]."
                        ".$model_arr[1]."
                        ".$model_wear_arr[1]."
                        ".$size_a1_kr_arr[1]."
                        ".$size_a2_kr_arr[1]."
                        ".$size_a3_kr_arr[1]."
                        ".$size_a4_kr_str_arr[1]."
                        ".$size_a5_kr_arr[1]."
                        ".$size_onesize_kr_arr[1]."
                        ".$size_a1_en_arr[1]."
                        ".$size_a2_en_arr[1]."
                        ".$size_a3_en_arr[1]."
                        ".$size_a4_en_arr[1]."
                        ".$size_a5_en_arr[1]."
                        ".$size_onesize_en_arr[1]."
                        ".$size_a1_cn_arr[1]."
                        ".$size_a2_cn_arr[1]."
                        ".$size_a3_cn_arr[1]."
                        ".$size_a4_cn_arr[1]."
                        ".$size_a5_cn_arr[1]."
                        ".$size_onesize_cn_arr[1]."
                        ".$care_kr_arr[1]."
                        ".$care_en_arr[1]."
                        ".$care_cn_arr[1]."
                        ".$detail_kr_arr[1]."
                        ".$detail_en_arr[1]."
                        ".$detail_cn_arr[1]."

                        ".$material_kr_arr[1]."
                        ".$material_en_arr[1]."
                        ".$material_cn_arr[1]."
                        ".$manufacturer_arr[1]."
                        ".$supplier_arr[1]."
                        ".$supplier_arr[1]."
                        ".$origin_country_arr[1]."
                        ".$brand_arr[1]."
                        ".$trend_arr[1]."
                        ".$box_idx_arr[1]."
                        ".$product_weight_arr[1]."

                        NOW(),
                        'Admin',
                        NOW(),
                        'Admin'
                    )
            ";
    
            $db->query($sql);
            $ordersheet_idx = $db->last_id();
    
            if (!empty($ordersheet_idx)) {
                if(is_array($option_name)){
                    $db->query('DELETE FROM dev.ORDERSHEET_OPTION WHERE ORDERSHEET_IDX = '.$ordersheet_idx);

                    for($i=0; $i<count($option_name); $i++){
                        $option_size_1_val = strlen($option_size_1[$i]) > 0 ? $option_size_1[$i] : 'NULL';
                        $option_size_2_val = strlen($option_size_2[$i]) > 0 ? $option_size_2[$i] : 'NULL';
                        $option_size_3_val = strlen($option_size_3[$i]) > 0 ? $option_size_3[$i] : 'NULL';
                        $option_size_4_val = strlen($option_size_4[$i]) > 0 ? $option_size_4[$i] : 'NULL';
                        $option_size_5_val = strlen($option_size_5[$i]) > 0 ? $option_size_5[$i] : 'NULL';
                        $option_size_6_val = strlen($option_size_6[$i]) > 0 ? $option_size_6[$i] : 'NULL';
                        $sql = "
                            INSERT INTO dev.ORDERSHEET_OPTION (
                                ORDERSHEET_IDX,
                                PRODUCT_CODE,
                                BARCODE,
                                OPTION_NAME,
                                OPTION_STOCK_GRADE,
                                OPTION_SIZE_1,
                                OPTION_SIZE_2,
                                OPTION_SIZE_3,
                                OPTION_SIZE_4,
                                OPTION_SIZE_5,
                                OPTION_SIZE_6,
                                SIZE_CATEGORY,
                                CREATE_DATE,
                                CREATER,
                                UPDATE_DATE,
                                UPDATER
                            )
                            VALUE
                            (
                                ".$ordersheet_idx.",
                                '".$product_code."',
                                '".$product_code.$size_code[$i]."',
                                '".$option_name[$i]."',
                                '".$stock_grade[$i]."',
                                ".$option_size_1_val.",
                                ".$option_size_2_val.",
                                ".$option_size_3_val.",
                                ".$option_size_4_val.",
                                ".$option_size_5_val.",
                                ".$option_size_6_val.",
                                '".$size_category."',
                                NOW(),
                                'Admin',
                                NOW(),
                                'Admin'
                            )
                        ";
                        $db->query($sql);
                    }
                }

                $history_sql = "
                    INSERT INTO dev.ORDERSHEET_HISTORY
                    (	
                        ORDERSHEET_IDX,
                        ORDERSHEET_AUTH,
                        ACTION_TYPE,
                        PRODUCT_CODE,
                        PRODUCT_NAME,
                        HISTORY_MSG,
                        CREATE_DATE,
                        CREATER
                    )
                    VALUES
                    (
                        ".$ordersheet_idx.",
                        'MD',
                        'W',
                        '".$product_code."',
                        '".$product_name."',
                        '[".$product_code."] ".$product_name." 의 오더시트 기획 작성 이 완료되었습니다.',
                        NOW(),
                        'Admin'
                    )
                ";
                $db->query($history_sql);
                
                $md_category_idx = $_POST['md_category_idx'];
                $md_category_idx_arr = array();
                if(is_array($md_category_idx)){
                    for($i = count($md_category_idx)-1; $i >= 0 ;$i--){
                        if($md_category_idx[$i] != null){
                            $category_idx = $md_category_idx[$i];
                            $md_category_idx_arr[0] = ' CATEGORY_IDX, ';
                            $md_category_idx_arr[1] = $category_idx.",";
                            break;
                        }
                    }
                    
                }

                $relevant_idx = $_POST['relevant_idx'];
                $relevant_idx_arr = array();
                if($relevant_idx != null){
                    $relevant_idx_arr[0] = ' RELEVANT_IDX, ';
                    $relevant_idx_arr[1] = "'".$relevant_idx."',";
                }

                $product_tag = $_POST['product_tag'];
                $product_tag_arr = array();
                if ($product_tag != null) {
                    $product_tag_arr[0] = ' PRODUCT_TAG, ';
                    $product_tag_arr[1] = "'".implode(",",$product_tag)."', ";
                }

                $shop_style_code = $_POST['shop_style_code'];
                $shop_style_code_arr = array();
                if ($shop_style_code != null) {
                    $shop_style_code_arr[0] = ' STYLE_CODE, ';
                    $shop_style_code_arr[1] = "'".$shop_style_code."', ";
                }

                $shop_color_code = $_POST['shop_color_code'];
                $shop_color_code_arr = array();
                if ($shop_color_code != null) {
                    $shop_color_code_arr[0] = ' COLOR_CODE, ';
                    $shop_color_code_arr[1] = "'".$shop_color_code."', ";
                }

                $shop_product_code = $_POST['shop_product_code'];
                $shop_product_code_arr = array();
                if ($shop_product_code != null) {
                    $shop_product_code_arr[0] = ' PRODUCT_CODE, ';
                    $shop_product_code_arr[1] = "'".$shop_product_code."', ";
                }

                $shop_product_name = $_POST['shop_product_name'];
                $shop_product_name_arr = array();
                if ($shop_product_name != null) {
                    $shop_product_name_arr[0] = ' PRODUCT_NAME, ';
                    $shop_product_name_arr[1] = "'".$shop_product_name."', ";
                }

                $md_category_1 = $_POST['md_category_1'];
                $md_category_1_arr = array();
                if ($md_category_1 != null) {
                    $md_category_1_arr[0] = ' MD_CATEGORY_1, ';
                    $md_category_1_arr[1] = "'".$md_category_1."', ";
                }

                $md_category_2 = $_POST['md_category_2'];
                $md_category_2shop_product_name_arr = array();
                if ($md_category_2 != null) {
                    $md_category_2_arr[0] = ' MD_CATEGORY_2, ';
                    $md_category_2_arr[1] = "'".$md_category_2."', ";
                }

                $md_category_3 = $_POST['md_category_3'];
                $md_category_3_arr = array();
                if ($md_category_3 != null) {
                    $md_category_3_arr[0] = ' MD_CATEGORY_3, ';
                    $md_category_3_arr[1] = "'".$md_category_3."', ";
                }

                $md_category_4 = $_POST['md_category_4'];
                $md_category_4_arr = array();
                if ($md_category_4 != null) {
                    $md_category_4_arr[0] = ' MD_CATEGORY_4, ';
                    $md_category_4_arr[1] = "'".$md_category_4."', ";
                }

                $md_category_5 = $_POST['md_category_5'];
                $md_category_5_arr = array();
                if ($md_category_5 != null) {
                    $md_category_5_arr[0] = ' MD_CATEGORY_5, ';
                    $md_category_5_arr[1] = "'".$md_category_5."', ";
                }

                $md_category_6 = $_POST['md_category_6'];
                $md_category_6_arr = array();
                if ($md_category_6 != null) {
                    $md_category_6_arr[0] = ' MD_CATEGORY_6, ';
                    $md_category_6_arr[1] = "'".$md_category_6."', ";
                }

                $price_kr = $_POST['price_kr'];
                $price_kr_arr = array();
                if ($price_kr != null) {
                    $price_kr_arr[0] = ' PRICE_KR, ';
                    $price_kr_arr[1] = $price_kr.", ";
                }

                $sales_price_kr = $_POST['sales_price_kr'];
                $sales_price_kr_arr = array();
                if ($sales_price_kr != null) {
                    $sales_price_kr_arr[0] = ' SALES_PRICE_KR, ';
                    $sales_price_kr_arr[1] = $sales_price_kr.", ";
                }

                $discount_kr = $_POST['discount_kr'];
                $discount_kr_arr = array();
                if ($discount_kr != null) {
                    $discount_kr_arr[0] = ' DISCOUNT_KR, ';
                    $discount_kr_arr[1] = $discount_kr.", ";
                }

                $price_en = $_POST['price_en'];
                $price_en_arr = array();
                if ($price_en != null) {
                    $price_en_arr[0] = ' PRICE_EN, ';
                    $price_en_arr[1] = $price_en.", ";
                }

                $sales_price_en = $_POST['sales_price_en'];
                $sales_price_en_arr = array();
                if ($sales_price_en != null) {
                    $sales_price_en_arr[0] = ' SALES_PRICE_EN, ';
                    $sales_price_en_arr[1] = $sales_price_en.", ";
                }

                $discount_en = $_POST['discount_en'];
                $discount_en_arr = array();
                if ($discount_en != null) {
                    $discount_en_arr[0] = ' DISCOUNT_EN, ';
                    $discount_en_arr[1] = $discount_en.", ";
                }

                $price_cn = $_POST['price_cn'];
                $price_cn_arr = array();
                if ($price_cn != null) {
                    $price_cn_arr[0] = ' PRICE_CN, ';
                    $price_cn_arr[1] = $price_cn.", ";
                }

                $sales_price_cn = $_POST['sales_price_cn'];
                $sales_price_cn_arr = array();
                if ($sales_price_cn != null) {
                    $sales_price_cn_arr[0] = ' SALES_PRICE_CN, ';
                    $sales_price_cn_arr[1] = $sales_price_cn.", ";
                }

                $discount_cn = $_POST['discount_cn'];
                $discount_cn_arr = array();
                if ($discount_cn != null) {
                    $discount_cn_arr[0] = ' DISCOUNT_CN, ';
                    $discount_cn_arr[1] = $discount_cn.", ";
                }

                $limit_member = $_POST['limit_member'];
                $limit_member_arr = array();
                if ($limit_member != null) {
                    $limit_member_arr[0] = ' LIMIT_MEMBER, ';
                    $limit_member_arr[1] = "'".$limit_member."', ";
                }

                $limit_purchase_qty_flg = $_POST['limit_purchase_qty_flg'];
                $limit_purchase_qty_flg_arr = array();
                if ($limit_purchase_qty_flg != null) {
                    $limit_purchase_qty_flg_arr[0] = ' LIMIT_PURCHASE_QTY_FLG, ';
                    $limit_purchase_qty_flg_arr[1] = $limit_purchase_qty_flg.", ";
                }

                $limit_purchase_qty_min = $_POST['limit_purchase_qty_min'];
                $limit_purchase_qty_min_arr = array();
                if ($limit_purchase_qty_min != null) {
                    $limit_purchase_qty_min_arr[0] = ' LIMIT_PURCHASE_QTY_MIN, ';
                    $limit_purchase_qty_min_arr[1] = $limit_purchase_qty_min.", ";
                }

                $limit_purchase_qty_max = $_POST['limit_purchase_qty_max'];
                $limit_purchase_qty_max_arr = array();
                if ($limit_purchase_qty_max != null) {
                    $limit_purchase_qty_max_arr[0] = ' LIMIT_PURCHASE_QTY_MAX, ';
                    $limit_purchase_qty_max_arr[1] = $limit_purchase_qty_max.", ";
                }

                $product_keyword = $_POST['product_keyword'];
                $product_keyword_arr = array();
                if ($product_keyword != null) {
                    $product_keyword_arr[0] = ' PRODUCT_KEYWORD, ';
                    $product_keyword_arr[1] = "'".$product_keyword."', ";
                }

                $custom_clearance = $_POST['custom_clearance'];
                $custom_clearance_arr = array();
                if ($custom_clearance != null) {
                    $custom_clearance_arr[0] = ' CLEARANCE_IDX, ';
                    $custom_clearance_arr[1] = 'IFNULL(
                                                        (SELECT 
                                                            IDX 
                                                        FROM 
                                                            dev.CUSTOM_CLEARANCE 
                                                        WHERE 
                                                            CATEGORY_NAME = "'.$custom_clearance.'"),0),';
                }
                
                $sold_out_qty = $_POST['sold_out_qty'];
                $sold_out_qty_arr = array();
                if ($sold_out_qty != null) {
                    $sold_out_qty_arr[0] = ' SOLD_OUT_QTY, ';
                    $sold_out_qty_arr[1] = $sold_out_qty.", ";
                }

                $refund_flg = $_POST['refund_flg'];
                $refund_flg_arr = array();
                if ($refund_flg != null) {
                    $refund_flg_arr[0] = ' REFUND_FLG, ';
                    $refund_flg_arr[1] = $refund_flg.", ";
                }

                $refund_kr = $_POST['refund_kr'];
                $refund_kr_arr = array();
                if ($refund_kr != null) {
                    $refund_kr_arr[0] = ' REFUND_KR, ';
                    $refund_kr_arr[1] = "'".$refund_kr."', ";
                }

                $refund_en = $_POST['refund_en'];
                $refund_en_arr = array();
                if ($refund_en != null) {
                    $refund_en_arr[0] = ' REFUND_EN, ';
                    $refund_en_arr[1] = "'".$refund_en."', ";
                }

                $refund_cn = $_POST['refund_cn'];
                $refund_cn_arr = array();
                if ($refund_cn != null) {
                    $refund_cn_arr[0] = ' REFUND_CN, ';
                    $refund_cn_arr[1] = "'".$refund_cn."', ";
                }

                $memo = $_POST['memo'];
                $memo_arr = array();
                if ($memo != null) {
                    $memo_arr[0] = ' MEMO, ';
                    $memo_arr[1] = "'".$memo."', ";
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

                $sql = "
                        INSERT INTO dev.SHOP_PRODUCT
                            (   
                                ORDERSHEET_IDX,
                                ".$shop_style_code_arr[0]."
                                ".$shop_color_code_arr[0]."
                                ".$shop_product_code_arr[0]."
                                ".$shop_product_name_arr[0]."
                                INDEPENDENCE_FLG,
                                ".$md_category_1_arr[0]."
                                ".$md_category_2_arr[0]."
                                ".$md_category_3_arr[0]."
                                ".$md_category_4_arr[0]."
                                ".$md_category_5_arr[0]."
                                ".$md_category_6_arr[0]."
                                ".$md_category_idx_arr[0]."
                                ".$relevant_idx_arr[0]."
                                ".$product_tag_arr[0]."

                                ".$price_kr_arr[0]."
                                ".$sales_price_kr_arr[0]."
                                ".$discount_kr_arr[0]."
                                ".$price_en_arr[0]."
                                ".$sales_price_en_arr[0]."
                                ".$discount_en_arr[0]."
                                ".$price_cn_arr[0]."
                                ".$sales_price_cn_arr[0]."
                                ".$discount_cn_arr[0]."

                                ".$limit_member_arr[0]."
                                ".$limit_purchase_qty_flg_arr[0]."
                                ".$limit_purchase_qty_min_arr[0]."
                                ".$limit_purchase_qty_max_arr[0]."

                                ".$product_keyword_arr[0]."
                                ".$custom_clearance_arr[0]."
                                ".$sold_out_qty_arr[0]."

                                ".$refund_flg_arr[0]."
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
                                CREATER,
                                UPDATER
                            )
                        SELECT
                                IDX,
                                ".$shop_style_code_arr[1]."
                                ".$shop_color_code_arr[1]."
                                ".$shop_product_code_arr[1]."
                                ".$shop_product_name_arr[1]."
                                TRUE,
                                ".$md_category_1_arr[1]."
                                ".$md_category_2_arr[1]."
                                ".$md_category_3_arr[1]."
                                ".$md_category_4_arr[1]."
                                ".$md_category_5_arr[1]."
                                ".$md_category_6_arr[1]."
                                ".$md_category_idx_arr[1]."
                                ".$relevant_idx_arr[1]."
                                ".$product_tag_arr[1]."

                                ".$price_kr_arr[1]."
                                ".$sales_price_kr_arr[1]."
                                ".$discount_kr_arr[1]."
                                ".$price_en_arr[1]."
                                ".$sales_price_en_arr[1]."
                                ".$discount_en_arr[1]."
                                ".$price_cn_arr[1]."
                                ".$sales_price_cn_arr[1]."
                                ".$discount_cn_arr[1]."

                                ".$limit_member_arr[1]."
                                ".$limit_purchase_qty_flg_arr[1]."
                                ".$limit_purchase_qty_min_arr[1]."
                                ".$limit_purchase_qty_max_arr[1]."

                                ".$product_keyword_arr[1]."
                                ".$custom_clearance_arr[1]."
                                ".$sold_out_qty_arr[1]."

                                ".$refund_flg_arr[1]."
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
                                'Admin',
                                'Admin'
                        FROM
                                dev.ORDERSHEET_MST
                        WHERE
                                IDX = ".$ordersheet_idx."
                ";
                $db->query($sql);
            }
            $db->commit();
        } 
        catch(mysqli_sql_exception $exception){
            $json_result['code'] = 301;
            $db->rollback();
            $json_result['msg'] = '오더시트 등록에 실패했습니다.';
            return $json_result;
        }
    }
    else{
        $json_result['code'] = 301;
        $json_result['msg'] = '오더시트 등록에 실패했습니다.';
        return $json_result;
    }
}

function xssEncode($value){
    $value = str_replace("&","&amp;",$value);
    $value = str_replace("\"","&quot;",$value);
    $value = str_replace("'","&apos;",$value);
    $value = str_replace("<","&lt;",$value);
    $value = str_replace(">","&gt;",$value);
    $value = str_replace("\r","<br>",$value);
    $value = str_replace("\n","<p>",$value);

    return $value;
}
?>