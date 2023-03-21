
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

$style_code                 = $_POST['style_code'];
$color_code                 = $_POST['color_code'];
$product_code               = $_POST['product_code'];
$preorder_flg               = $_POST['preorder_flg'];
$refund_flg                 = $_POST['refund_flg'];
$line_idx                   = $_POST['line_idx'];
$material                   = $_POST['material'];
$graphic                    = $_POST['graphic'];
$fit                        = $_POST['fit'];
$product_name               = $_POST['product_name'];
$shop_product_name          = $_POST['shop_product_name'];
$product_size               = $_POST['product_size'];
$color                      = $_POST['color'];
$color_rgb                  = $_POST['color_rgb'];
$pantone_code               = $_POST['pantone_code'];
$wkla_idx                   = $_POST['wkla_idx'];
$load_box_idx               = $_POST['load_box_idx'];
$update_flg                 = $_POST['update_flg'];
$set_flg                    = $_POST['set_flg'];
$del_flg                    = $_POST['del_flg'];
$creater                    = $_POST['creater'];
$updater                    = $_POST['updater'];
$mileage_flg                = $_POST['mileage_flg'];
$exclusive_flg              = $_POST['exclusive_flg'];
$price_kr                   = $_POST['price_kr'];
$discount_kr                = $_POST['discount_kr'];
$sales_price_kr             = $_POST['sales_price_kr'];
$price_en                   = $_POST['price_en'];
$discount_en                = $_POST['discount_en'];
$sales_price_en             = $_POST['sales_price_en'];
$price_cn                   = $_POST['price_cn'];
$discount_cn                = $_POST['discount_cn'];
$sales_price_cn             = $_POST['sales_price_cn'];

$limit_id_flg     			= $_POST['limit_id_flg'];
$limit_purchase_qty_flg     = $_POST['limit_purchase_qty_flg'];
$product_keyword            = $_POST['product_keyword'];
$product_tag                = $_POST['product_tag'];
$relevant_idx               = $_POST['relevant_idx'];
$sold_out_qty               = $_POST['sold_out_qty'];
$detail_kr                  = $_POST['detail_kr'];
$detail_en                  = $_POST['detail_en'];
$detail_cn                  = $_POST['detail_cn'];
$care_kr                    = $_POST['care_kr'];
$care_en                    = $_POST['care_en'];
$care_cn                    = $_POST['care_cn'];
$material_kr                = $_POST['material_kr'];
$material_en                = $_POST['material_en'];
$material_cn                = $_POST['material_cn'];
$refund_msg_flg             = $_POST['refund_msg_flg'];
$refund_msg                 = $_POST['refund_msg'];
$refund_kr                  = $_POST['refund_kr'];
$refund_en                  = $_POST['refund_en'];
$refund_cn                  = $_POST['refund_cn'];
$memo                       = $_POST['memo'];
$seo_exposure_flg           = $_POST['seo_exposure_flg'];
$seo_title                  = $_POST['seo_title'];
$seo_author                 = $_POST['seo_author'];
$seo_description            = $_POST['seo_description'];
$seo_keywords               = $_POST['seo_keywords'];
$seo_alt_text               = $_POST['seo_alt_text'];
$sale_flg                   = $_POST['sale_flg'];
$indp_flg                   = $_POST['indp_flg'];
$creater                    = $_POST['creater'];
$updater                    = $_POST['updater'];

if($load_box_idx == null && $load_box_idx == ''){
    $load_box_idx = 'NULL';
}
$deliver_box_idx            = $_POST['deliver_box_idx'];
if($deliver_box_idx == null && $deliver_box_idx == ''){
    $deliver_box_idx = 'NULL';
}
$load_weight                = $_POST['load_weight'];
if($load_weight == null && $load_weight == ''){
    $load_weight = 'NULL';
}
$load_qty                   = $_POST['load_qty'];

$td_sub_material_idx        = $_POST['td_sub_material_idx'];
if(!isset($td_sub_material_idx) || !is_array($td_sub_material_idx)){
    $td_sub_material_idx = NULL;
}

$delivery_sub_material_idx  = $_POST['delivery_sub_material_idx'];
if(!isset($delivery_sub_material_idx) || !is_array($delivery_sub_material_idx)){
    $delivery_sub_material_idx = NULL;
}

$limit_member               = $_POST['limit_member'];
if(!isset($limit_member) || !is_array($limit_member)){
    $limit_member = 'NULL';
} else{
    $limit_member = "'".implode(",", $limit_member)."'";
}

$reorder_cnt               	= $_POST['reorder_cnt'];
if($reorder_cnt == null && $reorder_cnt == ''){
    $limit_qty = '0';
}

$limit_product_qty          = $_POST['limit_product_qty'];
if($limit_qty == null && $limit_qty == ''){
    $limit_qty = '0';
}

$md_category_1              = $_POST['md_category_1'];
if($md_category_1 == null && $md_category_1 == ''){
    $md_category_1 = '0';
}
$md_category_2              = $_POST['md_category_2'];
if($md_category_2 == null && $md_category_2 == ''){
    $md_category_2 = '0';
}
$md_category_3              = $_POST['md_category_3'];
if($md_category_3 == null && $md_category_3 == ''){
    $md_category_3 = '0';
}
$md_category_4              = $_POST['md_category_4'];
if($md_category_4 == null && $md_category_4 == ''){
    $md_category_4 = '0';
}
$md_category_5              = $_POST['md_category_5'];
if($md_category_5 == null && $md_category_5 == ''){
    $md_category_5 = '0';
}
$md_category_6              = $_POST['md_category_6'];
if($md_category_6 == null && $md_category_6 == ''){
    $md_category_6 = '0';
}
$category_idx               = $_POST['category_idx'];
if($category_idx == null && $category_idx == ''){
    $category_idx = 'NULL';
}

$clearance_idx              = $_POST['clearance_idx'];
if($clearance_idx == null && $clearance_idx == ''){
    $clearance_idx = 'NULL';
}

$product_idx_list           = $_POST['product_idx_list'];

$filter_cl					= $_POST['filter_cl'];
$filter_cl_str = " NULL, ";
if ($filter_cl != null) {
	$filter_cl_str = " '".implode(",",$filter_cl)."', ";
}

$filter_ft = ' NULL, ';
if(isset($_POST['filter_ft'])){
	$filter_ft					= $_POST['filter_ft'];
}

$filter_gp = ' NULL, ';
if(isset($_POST['filter_gp'])){
	$filter_gp					= $_POST['filter_gp'];
}

$filter_ln = ' NULL, ';
if(isset($_POST['filter_ln'])){
	$filter_ln					= $_POST['filter_ln'];
}

$filter_sz					= $_POST['filter_sz'];
$filter_sz_str = " NULL, ";
if ($filter_sz != null) {
	$filter_sz_str = " '".implode(",",$filter_sz)."', ";
}

$option_list_str            = $_POST['option_list_str'];

$db->begin_transaction();

try {
    $insert_ordersheet_sql  = "
		INSERT INTO
			ORDERSHEET_MST
		(
			STYLE_CODE,
			COLOR_CODE,
			PRODUCT_CODE,
			PREORDER_FLG,
			REFUND_FLG,
			LINE_IDX,
			MATERIAL,
			GRAPHIC,
			FIT,
			PRODUCT_NAME,
			COLOR,
			COLOR_RGB,
			PANTONE_CODE,
			PRICE_KR,
			PRICE_EN,
			PRICE_CN,
			WKLA_IDX,
			DETAIL_KR,
			DETAIL_EN,
			DETAIL_CN,
			CARE_DSN_KR,
			CARE_DSN_EN,
			CARE_DSN_CN,
			CARE_TD_KR,
			CARE_TD_EN,
			CARE_TD_CN,
			MATERIAL_KR,
			MATERIAL_EN,
			MATERIAL_CN,
			LOAD_BOX_IDX,
			DELIVER_BOX_IDX,
			LOAD_WEIGHT,
			LOAD_QTY,
			UPDATE_FLG,
			SET_FLG,
			CREATER,
			UPDATER
		) VALUES (
			'".$style_code."',
			'".$color_code."',
			'".$product_code."',
			".$preorder_flg.",
			".$refund_flg.",
			".$line_idx.",
			'".$material."',
			'".$graphic."',
			'".$fit."',
			'".$product_name."',
			'".$color."',
			'".$color_rgb."',
			'".$pantone_code."',
			".$price_kr.",
			".$price_en.",
			".$price_cn.",
			".$wkla_idx.",
			'".$detail_kr."',
			'".$detail_en."',
			'".$detail_cn."',
			'".$care_kr."',
			'".$care_en."',
			'".$care_cn."',
			'".$care_kr."',
			'".$care_en."',
			'".$care_cn."',
			'".$material_kr."',
			'".$material_en."',
			'".$material_cn."',
			".$load_box_idx.",
			".$deliver_box_idx.",
			".$load_weight.",
			".$load_qty.",
			TRUE,
			TRUE,
			'Admin',
			'Admin'
		)
	";
	
    $db->query($insert_ordersheet_sql);
	
    $ordersheet_idx = $db->last_id();
	
    if (!empty($ordersheet_idx)) {
        $insert_product_sql = "
			INSERT INTO
				SHOP_PRODUCT
			(
				ORDERSHEET_IDX,
				PRODUCT_TYPE,
				STYLE_CODE,
				COLOR_CODE,
				PRODUCT_CODE,
				PRODUCT_NAME,
				MD_CATEGORY_1,
				MD_CATEGORY_2,
				MD_CATEGORY_3,
				MD_CATEGORY_4,
				MD_CATEGORY_5,
				MD_CATEGORY_6,
				CATEGORY_IDX,
				MILEAGE_FLG,
				EXCLUSIVE_FLG,
				PRICE_KR,
				DISCOUNT_KR,
				SALES_PRICE_KR,
				PRICE_EN,
				DISCOUNT_EN,
				SALES_PRICE_EN,
				PRICE_CN,
				DISCOUNT_CN,
				SALES_PRICE_CN,
				LIMIT_MEMBER,
				LIMIT_ID_FLG,
				REORDER_CNT,
				LIMIT_PURCHASE_QTY_FLG,
				LIMIT_PRODUCT_QTY,
				PRODUCT_KEYWORD,
				PRODUCT_TAG,
				CLEARANCE_IDX,
				RELEVANT_IDX,
				SOLD_OUT_QTY,
				CARE_KR,
				CARE_EN,
				CARE_CN,
				DETAIL_KR,
				DETAIL_EN,
				DETAIL_CN,
				MATERIAL_KR,
				MATERIAL_EN,
				MATERIAL_CN,
				REFUND_FLG,
				REFUND_MSG_FLG,
				REFUND_MSG,
				REFUND_KR,
				REFUND_EN,
				REFUND_CN,
				MEMO,
				SEO_EXPOSURE_FLG,
				SEO_TITLE,
				SEO_AUTHOR,
				SEO_DESCRIPTION,
				SEO_KEYWORDS,
				SEO_ALT_TEXT,
				FILTER_CL,
				FILTER_FT,
				FILTER_GP,
				FILTER_LN,
				FILTER_SZ,

				SALE_FLG,
				INDP_FLG,
				CREATER,
				UPDATER
			) VALUES (
				".$ordersheet_idx.",
				'S',
				'".$style_code."',
				'".$color_code."',
				'".$product_code."',
				'".$shop_product_name."',
				".$md_category_1.",
				".$md_category_2.",
				".$md_category_3.",
				".$md_category_4.",
				".$md_category_5.",
				".$md_category_6.",
				".$category_idx.",
				".$mileage_flg.",
				".$exclusive_flg.",
				".$price_kr.",
				".$discount_kr.",
				".$sales_price_kr.",
				".$price_en.",
				".$discount_en.",
				".$sales_price_en.",
				".$price_cn.",
				".$discount_cn.",
				".$sales_price_cn.",
				".$limit_member.",
				".$limit_id_flg.",
				".$reorder_cnt.",
				".$limit_purchase_qty_flg.",
				".$limit_product_qty.",
				'".$product_keyword."',
				'".$product_tag."',
				".$clearance_idx.",
				".$relevant_idx.",
				".$sold_out_qty.",
				'".$care_kr."',
				'".$care_en."',
				'".$care_cn."',
				'".$detail_kr."',
				'".$detail_en."',
				'".$detail_cn."',
				'".$material_kr."',
				'".$material_en."',
				'".$material_cn."',
				'".$refund_flg."',
				'".$refund_msg_flg."',
				'".$refund_msg."',
				'".$refund_kr."',
				'".$refund_en."',
				'".$refund_cn."',
				'".$memo."',
				".$seo_exposure_flg.",
				'".$seo_title."',
				'".$seo_author."',
				'".$seo_description."',
				'".$seo_keywords."',
				'".$seo_alt_text."',
				".$filter_cl_str."
				".$filter_ft.",
				".$filter_gp.",
				".$filter_ln.",
				".$filter_sz_str."
				1,
				0,
				'Admin',
				'Admin'
			)
		";
		
		$db->query($insert_product_sql);
	
		$set_product_idx = $db->last_id();
		
		if (!empty($set_product_idx) && !empty($product_idx_list)) {
			for ($i=0; $i<count($product_idx_list); $i++) {
				$option_idx = '';
                if($option_list_str[$i] != null){
                    $option_idx = $option_list_str[$i];
                };

				$insert_set_product_sql = "
					INSERT INTO
						SET_PRODUCT
					(
						SET_PRODUCT_IDX,
						PRODUCT_IDX,
						OPTION_IDX,
						CREATER,
						UPDATER
					) VALUES (
						".$set_product_idx.",
						".$product_idx_list[$i].",
						'".$option_idx."',
						'Admin',
						'Admin'
					)
				";
				
				$db->query($insert_set_product_sql);
			}
		}
		if($td_sub_material_idx != NULL && $td_sub_material_idx != NULL){
			$sub_material_delete_sql = "
				DELETE FROM
					SUB_MATERIAL_MAPPING
				WHERE
					ORDERSHEET_IDX = ".$ordersheet_idx."
			";
			$db->query($sub_material_delete_sql);
	
			$sub_arr_cnt = count($td_sub_material_idx) + count($td_sub_material_idx);
			$insert_cnt = 0;
			$sub_mapping_idx = 0;
			foreach ($td_sub_material_idx as $td_sub_idx) {
				$td_sub_material_sql = "
					INSERT INTO SUB_MATERIAL_MAPPING
					( 
						SUB_MATERIAL_TYPE,
						SUB_MATERIAL_IDX,
						ORDERSHEET_IDX
					)
					SELECT
						SUB_MATERIAL_TYPE,
						IDX,
						" . $ordersheet_idx . "
					FROM
						SUB_MATERIAL_INFO
					WHERE
						IDX = " . $td_sub_idx . "
				";
	
				$db->query($td_sub_material_sql);
	
				$sub_mapping_idx = $db->last_id();
	
				if (!empty($sub_mapping_idx)) {
					$insert_cnt++;
				}
			}
			$sub_mapping_idx = 0;
			foreach ($delivery_sub_material_idx as $delivery_sub_idx) {
				$delivery_sub_material_sql = "
					INSERT INTO SUB_MATERIAL_MAPPING
					( 
						SUB_MATERIAL_TYPE,
						SUB_MATERIAL_IDX,
						ORDERSHEET_IDX
					)
					SELECT
						SUB_MATERIAL_TYPE,
						IDX,
						" . $ordersheet_idx . "
					FROM
						SUB_MATERIAL_INFO
					WHERE
						IDX = " . $delivery_sub_idx . "
				";
	
				$db->query($delivery_sub_material_sql);
	
				$sub_mapping_idx = $db->last_id();
	
				if (!empty($sub_mapping_idx)) {
					$insert_cnt++;
				}
			}
		}

		$db->commit();
		
		$json_result['code'] = 200;
		$json_result['msg'] = "세트상품이 등록되었습니다.";
    }
} catch(mysqli_sql_exception $exception){
	$db->rollback();
	
    print_r($exception);
    $json_result['code'] = 301;
	$json_result['msg'] = "세트상품 등록에 실패했습니다.";
}

?>
