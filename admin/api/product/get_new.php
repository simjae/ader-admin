<?php
/*
 +=============================================================================
 | 
 | 회원 목록
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.07.12
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$select_idx_flg     = filter_var($_POST['select_idx_flg'],FILTER_VALIDATE_BOOLEAN);
$product_idx		= $_POST['product_idx'];
$sel_idx		    = $_POST['sel_idx'];

$tables = "
	dev.SHOP_PRODUCT SP
";

//검색 유형 - 디폴트
$where = '1=1';
$where .= ' AND (SP.INDP_FLG = FALSE AND SP.DEL_FLG = FALSE) ';

//검색 유형 - 상품 IDX
if ($product_idx != null) {
	$where .= " AND (SP.IDX IN (".$product_idx.")) ";
}
if ($sel_idx != null) {
	$where .= " AND (SP.IDX = ".$sel_idx." )";
}

$select = "";
if ($select_idx_flg == true) {
	$select.= " GROUP_CONCAT(SP.IDX SEPARATOR ',') AS PRODUCT_IDX_ARR ";
} else {
    $select.= " SP.IDX                      AS PRODUCT_IDX,
                SP.ORDERSHEET_IDX           AS ORDERSHEET_IDX,
                SP.PRODUCT_TYPE             AS PRODUCT_TYPE,
                SP.STYLE_CODE               AS STYLE_CODE,
                SP.COLOR_CODE               AS COLOR_CODE,
                SP.PRODUCT_CODE             AS PRODUCT_CODE,
                SP.PRODUCT_NAME             AS PRODUCT_NAME,
                SP.MD_CATEGORY_1            AS MD_CATEGORY_1,
                SP.MD_CATEGORY_2            AS MD_CATEGORY_2,
                SP.MD_CATEGORY_3            AS MD_CATEGORY_3,
                SP.MD_CATEGORY_4            AS MD_CATEGORY_4,
                SP.MD_CATEGORY_5            AS MD_CATEGORY_5,
                SP.MD_CATEGORY_6            AS MD_CATEGORY_6,
                SP.CATEGORY_IDX             AS CATEGORY_IDX,
                SP.MILEAGE_FLG              AS MILEAGE_FLG,
                SP.EXCLUSIVE_FLG            AS EXCLUSIVE_FLG,
                SP.PRICE_KR                 AS PRICE_KR, 
                SP.DISCOUNT_KR              AS DISCOUNT_KR,
                SP.SALES_PRICE_KR           AS SALES_PRICE_KR,
                SP.PRICE_EN                 AS PRICE_EN, 
                SP.DISCOUNT_EN              AS DISCOUNT_EN,
                SP.SALES_PRICE_EN           AS SALES_PRICE_EN,
                SP.PRICE_CN                 AS PRICE_CN, 
                SP.DISCOUNT_CN              AS DISCOUNT_CN,
                SP.SALES_PRICE_CN           AS SALES_PRICE_CN,
                SP.LIMIT_MEMBER             AS LIMIT_MEMBER,
                SP.LIMIT_PURCHASE_QTY_FLG   AS LIMIT_PURCHASE_QTY_FLG,
                SP.LIMIT_PURCHASE_QTY_MIN   AS LIMIT_PURCHASE_QTY_MIN,
                SP.LIMIT_PURCHASE_QTY_MAX   AS LIMIT_PURCHASE_QTY_MAX,
                SP.PRODUCT_KEYWORD          AS PRODUCT_KEYWORD,
                SP.PRODUCT_TAG              AS PRODUCT_TAG,
                SP.CLEARANCE_IDX            AS CLEARANCE_IDX,
                SP.RELEVANT_IDX             AS RELEVANT_IDX,
                SP.SOLD_OUT_QTY             AS SOLD_OUT_QTY,
                SP.DETAIL_KR                AS DETAIL_KR,
                SP.DETAIL_EN                AS DETAIL_EN,
                SP.DETAIL_CN                AS DETAIL_CN,
                SP.MATERIAL_KR              AS MATERIAL_KR,
                SP.MATERIAL_EN              AS MATERIAL_EN,
                SP.MATERIAL_CN              AS MATERIAL_CN,
                SP.REFUND_FLG               AS REFUND_FLG,
                SP.REFUND_MSG_FLG           AS REFUND_MSG_FLG,
                SP.REFUND_MSG               AS REFUND_MSG,
                SP.REFUND_KR                AS REFUND_KR,
                SP.REFUND_EN                AS REFUND_EN,
                SP.REFUND_CN                AS REFUND_CN,
                SP.MEMO                     AS MEMO,
                SP.SEO_EXPOSURE_FLG         AS SEO_EXPOSURE_FLG,
                SP.SEO_TITLE                AS SEO_TITLE,
                SP.SEO_AUTHOR               AS SEO_AUTHOR,
                SP.SEO_DESCRIPTION          AS SEO_DESCRIPTION,
                SP.SEO_KEYWORDS             AS SEO_KEYWORDS,
                SP.SEO_ALT_TEXT             AS SEO_ALT_TEXT,
                SP.SALE_FLG                 AS SALE_FLG,
                SP.INDP_FLG                 AS INDP_FLG";
}
$sql = 	'SELECT
			'.$select.'
		FROM 
			'.$tables.'
		WHERE 
			'.$where;

$img_result = array();
if ($product_idx != null) {
	$img_sql = "SELECT
					IDX AS IMG_IDX,
					IMG_TYPE,
					IMG_SIZE,
					IMG_LOCATION
				FROM
					dev.PRODUCT_IMG
				WHERE
					DEL_FLG = FALSE AND
					IMG_SIZE = 'org' AND
					PRODUCT_IDX = '".$product_idx."'";
	$db->query($img_sql);
	
	foreach($db->fetch() as $img_data) {
		$img_result['data'][] = array(
			'img_idx'						=>$img_data['IMG_IDX'],
			'img_type'						=>$img_data['IMG_TYPE'],
			'img_size'						=>$img_data['IMG_SIZE'],
			'img_location'					=>$img_data['IMG_LOCATION']
		);
	}
}

$db->query($sql);
if ($select_idx_flg == true) {
	foreach($db->fetch() as $data) {
		$json_result['data'][] = array(
			'select_idx_flg'	=>$select_idx_flg,
			'product_idx_arr'	=>$data['PRODUCT_IDX_ARR']
		);
	}
} else {
	foreach($db->fetch() as $data) {
		$relevant_idx = $data['RELEVANT_IDX'];
		$relevant_product = array();
		if ($relevant_idx != null) {
			$relevant_sql ="SELECT
								IDX,
								PRODUCT_NAME
							FROM
								dev.SHOP_PRODUCT
							WHERE
								IDX IN (".$relevant_idx.")";
			$db->query($relevant_sql);
			foreach($db->fetch() as $relevant_data) {
				$relevant_product['data'][] = array(
					'idx'			=>$relevant_data['IDX'],
					'product_name'	=>$relevant_data['PRODUCT_NAME']
				);
			}
		}
		
		$json_result['data'][] = array(
			'num'							=>$total_cnt--,
			'no'							=>intval($data['PRODUCT_IDX']),
			'img_result'					=>$img_result,
            'ordersheet_idx'			    =>$data['ORDERSHEET_IDX'],
			'product_type'					=>$data['PRODUCT_TYPE'],
			'style_code'					=>$data['STYLE_CODE'],
            'color_code'					=>$data['COLOR_CODE'],
			'product_code'					=>$data['PRODUCT_CODE'],
			'product_name'					=>$data['PRODUCT_NAME'],

			'md_category_1'					=>$data['MD_CATEGORY_1'],
			'md_category_2'					=>$data['MD_CATEGORY_2'],
			'md_category_3'					=>$data['MD_CATEGORY_3'],
			'md_category_4'					=>$data['MD_CATEGORY_4'],
			'md_category_5'					=>$data['MD_CATEGORY_5'],
			'md_category_6'					=>$data['MD_CATEGORY_6'],
			'category_idx'					=>$data['CATEGORY_IDX'],

			'mileage_flg'				    =>$data['MILEAGE_FLG'],
			'exclusive_flg'				    =>$data['EXCLUSIVE_FLG'],
			'price_kr'				        =>$data['PRICE_KR'],
			'discount_kr'				    =>$data['DISCOUNT_KR'],
			'sales_price_kr'			    =>$data['SALES_PRICE_KR'],
			'price_en'  			        =>$data['PRICE_EN'],
			'discount_en'	                =>$data['DISCOUNT_EN'],
			'sales_price_en'	            =>$data['SALES_PRICE_EN'],
			'price_cn'				        =>$data['PRICE_CN'],
			'discount_cn'				    =>$data['DISCOUNT_CN'],
			'sales_price_cn'				=>$data['SALES_PRICE_CN'],
			'limit_member'				    =>$data['LIMIT_MEMBER'],
			'limit_purchase_qty_flg'		=>$data['LIMIT_PURCHASE_QTY_FLG'],
            'limit_purchase_qty_min'		=>$data['LIMIT_PURCHASE_QTY_MIN'],
            'limit_purchase_qty_max'		=>$data['LIMIT_PURCHASE_QTY_MAX'],
			'product_keyword'			    =>$data['PRODUCT_KEYWORD'],
			'product_tag'				    =>$data['PRODUCT_TAG'],
			'clearance_idx'			        =>$data['CLEARANCE_IDX'],
			'relevant_idx'					=>$data['RELEVANT_IDX'],
			'sold_out_qty'				    =>$data['SOLD_OUT_QTY'],
			'detail_kr'			            =>$data['DETAIL_KR'],
			'detail_en'			            =>$data['DETAIL_EN'],
			'detail_cn'						=>$data['DETAIL_CN'],
            'care_kr'			            =>$data['CARE_KR'],
			'care_en'			            =>$data['CARE_EN'],
			'care_cn'						=>$data['CARE_CN'],
            'material_kr'			        =>$data['MATERIAL_KR'],
			'material_en'			        =>$data['MATERIAL_EN'],
			'material_cn'				    =>$data['MATERIAL_CN'],
			'refund_flg'					=>$data['REFUND_FLG'],
			'refund_msg_flg'				=>$data['REFUND_MSG_FLG'],
			'refund_msg'				    =>$data['REFUND_MSG'],
			'refund_kr'						=>$data['REFUND_KR'],
			'refund_en'						=>$data['REFUND_EN'],
			'refund_cn'						=>$data['REFUND_CN'],
			'memo'					        =>$data['MEMO'],
			'seo_exposure_flg'  			=>$data['SEO_EXPOSURE_FLG'],
			'seo_title'				        =>$data['SEO_TITLE'],
			'seo_author'				    =>$data['SEO_AUTHOR'],
			'seo_description'				=>$data['SEO_DESCRIPTION'],
			'seo_keywords'					=>$data['SEO_KEYWORDS'],
			'seo_alt_text'				    =>$data['SEO_ALT_TEXT'],
			'sale_flg'				        =>$data['SALE_FLG'],
			'indp_flg'				        =>$data['INDP_FLG'],
			'create_date'					=>$data['CREATE_DATE'],
			'update_date'					=>$data['UPDATE_DATE'],
			'relevant_product'				=>$relevant_product
		);
	}
}
?>