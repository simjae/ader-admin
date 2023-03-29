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
	SHOP_PRODUCT SP
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
				SP.COLOR_RGB				AS COLOR_RGB,
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
				SP.REORDER_CNT				AS REORDER_CNT,
                SP.SALES_PRICE_CN           AS SALES_PRICE_CN,
				SP.LIMIT_ID_FLG				AS LIMIT_ID_FLG,
                SP.LIMIT_MEMBER             AS LIMIT_MEMBER,
				SP.LIMIT_PRODUCT_QTY		AS LIMIT_PRODUCT_QTY,
                SP.LIMIT_PURCHASE_QTY_FLG   AS LIMIT_PURCHASE_QTY_FLG,
                SP.LIMIT_PURCHASE_QTY_MIN   AS LIMIT_PURCHASE_QTY_MIN,
                SP.LIMIT_PURCHASE_QTY_MAX   AS LIMIT_PURCHASE_QTY_MAX,
                SP.PRODUCT_KEYWORD          AS PRODUCT_KEYWORD,
                SP.PRODUCT_TAG              AS PRODUCT_TAG,
                SP.CLEARANCE_IDX            AS CLEARANCE_IDX,
                SP.RELEVANT_IDX             AS RELEVANT_IDX,
                SP.SOLD_OUT_QTY             AS SOLD_OUT_QTY,
				SP.SOLD_OUT_FLG             AS SOLD_OUT_FLG,
                SP.CARE_KR                	AS CARE_KR,
                SP.CARE_EN                	AS CARE_EN,
                SP.CARE_CN                	AS CARE_CN,
				SP.DETAIL_KR                AS DETAIL_KR,
                SP.DETAIL_EN                AS DETAIL_EN,
                SP.DETAIL_CN                AS DETAIL_CN,
                SP.MATERIAL_KR              AS MATERIAL_KR,
                SP.MATERIAL_EN              AS MATERIAL_EN,
                SP.MATERIAL_CN              AS MATERIAL_CN,
                SP.REFUND_FLG               AS REFUND_FLG,
                SP.REFUND_MSG_FLG           AS REFUND_MSG_FLG,
                SP.REFUND_MSG_KR            AS REFUND_MSG_KR,
				SP.REFUND_MSG_EN            AS REFUND_MSG_EN,
				SP.REFUND_MSG_CN            AS REFUND_MSG_CN,
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
				(
					SELECT
						REPLACE(S_PI.IMG_LOCATION,'/var/www/admin/www','')
					FROM
						PRODUCT_IMG S_PI
					WHERE
						S_PI.PRODUCT_IDX = SP.IDX AND
						S_PI.IMG_TYPE = 'P' AND
						S_PI.IMG_SIZE = 'S'
					ORDER BY
						IDX ASC
					LIMIT
						0,1
				) 							AS IMG_LOCATION,
                SP.SALE_FLG                 AS SALE_FLG,
                SP.INDP_FLG                 AS INDP_FLG,
				SP.FILTER_FT				AS FILTER_FT,
				SP.FILTER_GP				AS FILTER_GP,
				SP.FILTER_LN				AS FILTER_LN,
				SP.FILTER_CL				AS FILTER_CL,
				SP.FILTER_SZ				AS FILTER_SZ,
				SP.CREATE_DATE				AS CREATE_DATE,
				SP.UPDATE_DATE				AS UPDATE_DATE";
}

$sql = "
	SELECT
		".$select."
	FROM 
		".$tables."
	WHERE 
		".$where."
";

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
		$ordersheet_idx = $data['ORDERSHEET_IDX'];
		$product_idx = $data['PRODUCT_IDX'];
		
		$product_type = $data['PRODUCT_TYPE'];
		
		$product_option = array();
		if ($product_type == 'S') {
			$select_set_product_sql = "
				SELECT
					PR.IDX					AS PRODUCT_IDX,
					PR.ORDERSHEET_IDX		AS ORDERSHEET_IDX,
					PR.STYLE_CODE			AS STYLE_CODE,
					PR.COLOR_CODE			AS COLOR_CODE,
					PR.PRODUCT_CODE			AS PRODUCT_CODE,
					PR.PRODUCT_TYPE			AS PRODUCT_TYPE,
					PR.PRODUCT_NAME			AS PRODUCT_NAME,
					CASE
						WHEN
							(SELECT COUNT(*) FROM PRODUCT_IMG WHERE PRODUCT_IDX = PR.IDX) > 0
								THEN
									(
										SELECT
											REPLACE(S_PI.IMG_LOCATION,'/var/www/admin/www','')
										FROM
											PRODUCT_IMG S_PI
										WHERE
											S_PI.PRODUCT_IDX = PR.IDX AND
											S_PI.IMG_TYPE = 'P' AND
											S_PI.IMG_SIZE = 'S'
										LIMIT
											0,1
									)
							ELSE
								'/images/default_product_img.jpg'
					END						AS IMG_LOCATION,
					PR.PRICE_KR				AS PRICE_KR,
					PR.DISCOUNT_KR			AS DISCOUNT_KR,
					PR.SALES_PRICE_KR		AS SALES_PRICE_KR,
					PR.PRICE_EN				AS PRICE_EN,
					PR.DISCOUNT_EN			AS DISCOUNT_EN,
					PR.SALES_PRICE_EN		AS SALES_PRICE_EN,
					PR.PRICE_CN				AS PRICE_CN,
					PR.DISCOUNT_CN			AS DISCOUNT_CN,
					PR.SALES_PRICE_CN		AS SALES_PRICE_CN,
					(
						SELECT 
							S_SP.OPTION_IDX
						FROM 
							SET_PRODUCT S_SP
						WHERE
							S_SP.PRODUCT_IDX = PR.IDX
						AND
							SET_PRODUCT_IDX = ".$product_idx."
					)						AS OPTION_IDX,
					PR.CREATE_DATE 			AS CREATE_DATE,
					PR.UPDATE_DATE			AS UPDATE_DATE
				FROM
					SHOP_PRODUCT PR
				WHERE
					PR.IDX IN (
						SELECT
							S_SP.PRODUCT_IDX
						FROM
							SET_PRODUCT S_SP
						WHERE
							S_SP.SET_PRODUCT_IDX = ".$product_idx."
					)
			";
			
			$db->query($select_set_product_sql);
			
			$set_product_info = array();
			foreach($db->fetch() as $set_data) {
				$set_product_idx = $set_data['PRODUCT_IDX'];
				
				$set_product_stock = getProductStock($db,$set_product_idx);
				
				$set_product_info[] = array(
					'product_idx'		=>$set_data['PRODUCT_IDX'],
					'ordersheet_idx'	=>$set_data['ORDERSHEET_IDX'],
					'style_code'		=>$set_data['STYLE_CODE'],
					'color_code'		=>$set_data['COLOR_CODE'],
					'product_code'		=>$set_data['PRODUCT_CODE'],
					'product_type'		=>$set_data['PRODUCT_TYPE'],
					'product_name'		=>$set_data['PRODUCT_NAME'],
					'img_location'		=>$set_data['IMG_LOCATION'],
					'price_kr'			=>number_format($set_data['PRICE_KR']),
					'discount_kr'		=>number_format($set_data['DISCOUNT_KR']),
					'sales_price_kr'	=>number_format($set_data['SALES_PRICE_KR']),
					'price_en'			=>number_format($set_data['PRICE_EN']),
					'discount_en'		=>number_format($set_data['DISCOUNT_EN']),
					'sales_price_en'	=>number_format($set_data['SALES_PRICE_EN']),
					'price_cn'			=>number_format($set_data['PRICE_CN']),
					'discount_cn'		=>number_format($set_data['DISCOUNT_CN']),
					'sales_price_cn'	=>number_format($set_data['SALES_PRICE_CN']),
					'option_idx'		=>$set_data['OPTION_IDX'],
					'create_date'		=>$set_data['CREATE_DATE'],
					'update_date'		=>$set_data['UPDATE_DATE'],
					
					'set_product_stock'	=>$set_product_stock
				);
			}
		} else {
			$select_product_option_sql = "
				SELECT
					PO.IDX				AS PRODUCT_OPTION_IDX,
					OO.OPTION_NAME		AS OPTION_NAME,
					OO.BARCODE			AS BARCODE,
					PO.QTY				AS QTY,
					PO.LIMIT_QTY_FLG	AS LIMIT_QTY_FLG,
					PO.SALE_FLG			AS SALE_FLG
				FROM
					PRODUCT_OPTION PO
					LEFT JOIN ORDERSHEET_OPTION OO ON
					PO.OPTION_IDX = OO.IDX
				WHERE
					PO.PRODUCT_IDX = ".$product_idx."
			";
			
			$db->query($select_product_option_sql);
			
			foreach ($db->fetch() as $option_data) {
				$product_option[] = array(
					'product_option_idx'	=>$option_data['PRODUCT_OPTION_IDX'],
					'option_name'			=>$option_data['OPTION_NAME'],
					'barcode'				=>$option_data['BARCODE'],
					'qty'					=>$option_data['QTY'],
					'limit_qty_flg'			=>$option_data['LIMIT_QTY_FLG'],
					'sale_flg'				=>$option_data['SALE_FLG']
				);
			}
		}
		
		$relevant_idx = $data['RELEVANT_IDX'];
		
		$relevant_product_info = array();
		if (!empty($relevant_idx)) {
			$select_relevant_product_sql = "
				SELECT
					PR.IDX					AS PRODUCT_IDX,
					PR.PRODUCT_TYPE			AS PRODUCT_TYPE,
					CASE
						WHEN
							(SELECT COUNT(*) FROM PRODUCT_IMG WHERE PRODUCT_IDX = PR.IDX) > 0
								THEN
									(
										SELECT
											REPLACE(S_PI.IMG_LOCATION,'/var/www/admin/www','')
										FROM
											PRODUCT_IMG S_PI
										WHERE
											S_PI.PRODUCT_IDX = PR.IDX AND
											S_PI.IMG_TYPE = 'P' AND
											S_PI.IMG_SIZE = 'S'
										LIMIT
											0,1
									)
							ELSE
								'/images/default_product_img.jpg'
					END						AS IMG_LOCATION,
					PR.PRODUCT_CODE			AS PRODUCT_CODE,
					PR.PRODUCT_NAME			AS PRODUCT_NAME,
					PR.PRICE_KR				AS PRICE_KR,
					PR.PRICE_EN				AS PRICE_EN,
					PR.PRICE_CN				AS PRICE_CN,
					PR.DISCOUNT_KR			AS DISCOUNT_KR,
					PR.DISCOUNT_EN			AS DISCOUNT_EN,
					PR.DISCOUNT_CN			AS DISCOUNT_CN,
					PR.SALES_PRICE_KR		AS SALES_PRICE_KR,
					PR.SALES_PRICE_EN		AS SALES_PRICE_EN,
					PR.SALES_PRICE_CN		AS SALES_PRICE_CN,
					PR.CREATE_DATE			AS CREATE_DATE,
					PR.UPDATE_DATE			AS UPDATE_DATE
				FROM
					SHOP_PRODUCT PR
				WHERE
					IDX IN (".$relevant_idx.")
			";
			
			$db->query($select_relevant_product_sql);
			
			foreach($db->fetch() as $relevant_data) {
				$relevant_idx = $relevant_data['PRODUCT_IDX'];
				
				$relevant_product_stock = getProductStock($db,$relevant_idx);
				
				$relevant_product_info[] = array(
					'product_idx'				=>$relevant_data['PRODUCT_IDX'],
					'product_type'				=>$relevant_data['PRODUCT_TYPE'],
					'img_location'				=>$relevant_data['IMG_LOCATION'],
					'product_code'				=>$relevant_data['PRODUCT_CODE'],
					'product_name'				=>$relevant_data['PRODUCT_NAME'],
					'price_kr'					=>number_format($relevant_data['PRICE_KR']),
					'price_en'					=>number_format($relevant_data['PRICE_EN']),
					'price_cn'					=>number_format($relevant_data['PRICE_CN']),
					'discount_kr'				=>number_format($relevant_data['DISCOUNT_KR']),
					'discount_en'				=>number_format($relevant_data['DISCOUNT_EN']),
					'discount_cn'				=>number_format($relevant_data['DISCOUNT_CN']),
					'sales_price_kr'			=>number_format($relevant_data['SALES_PRICE_KR']),
					'sales_price_en'			=>number_format($relevant_data['SALES_PRICE_EN']),
					'sales_price_cn'			=>number_format($relevant_data['SALES_PRICE_CN']),
					'create_date'				=>$relevant_data['CRAETE_DATE'],
					'update_date'				=>$relevant_data['UPDATE_DATE'],
					
					'relevant_product_stock'	=>$relevant_product_stock
				);
			}
		}
		
		$product_stock = getProductStock($db,$product_idx);
		
		$json_result['data'][] = array(
			'product_idx'					=>$data['PRODUCT_IDX'],
			'img_location'					=>$data['IMG_LOCATION'],
            'ordersheet_idx'			    =>$data['ORDERSHEET_IDX'],
			'product_type'					=>$data['PRODUCT_TYPE'],
			'style_code'					=>$data['STYLE_CODE'],
            'color_code'					=>$data['COLOR_CODE'],
			'product_code'					=>$data['PRODUCT_CODE'],
			'product_name'					=>$data['PRODUCT_NAME'],
			'color_rgb'						=>$data['COLOR_RGB'],

			'md_category_1'					=>$data['MD_CATEGORY_1'],
			'md_category_2'					=>$data['MD_CATEGORY_2'],
			'md_category_3'					=>$data['MD_CATEGORY_3'],
			'md_category_4'					=>$data['MD_CATEGORY_4'],
			'md_category_5'					=>$data['MD_CATEGORY_5'],
			'md_category_6'					=>$data['MD_CATEGORY_6'],
			'category_idx'					=>$data['CATEGORY_IDX'],

			'reorder_cnt'					=>$data['REORDER_CNT'],
			'limit_product_qty'				=>$data['LIMIT_PRODUCT_QTY'],
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
			'limit_id_flg'					=>$data['LIMIT_ID_FLG'],
			'limit_member'				    =>$data['LIMIT_MEMBER'],
			'limit_purchase_qty_flg'		=>$data['LIMIT_PURCHASE_QTY_FLG'],
            'limit_purchase_qty_min'		=>$data['LIMIT_PURCHASE_QTY_MIN'],
            'limit_purchase_qty_max'		=>$data['LIMIT_PURCHASE_QTY_MAX'],
			'product_keyword'			    =>$data['PRODUCT_KEYWORD'],
			'product_tag'				    =>$data['PRODUCT_TAG'],
			'clearance_idx'			        =>$data['CLEARANCE_IDX'],
			'relevant_idx'					=>$data['RELEVANT_IDX'],
			'sold_out_qty'				    =>$data['SOLD_OUT_QTY'],
			'sold_out_flg'				    =>$data['SOLD_OUT_FLG'],
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
			'refund_msg_kr'				    =>$data['REFUND_MSG_KR'],
			'refund_msg_en'				    =>$data['REFUND_MSG_EN'],
			'refund_msg_cn'				    =>$data['REFUND_MSG_CN'],
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
			'filter_ft'				        =>$data['FILTER_FT'],
			'filter_gp'				        =>$data['FILTER_GP'],
			'filter_ln'				        =>$data['FILTER_LN'],
			'filter_cl'				        =>$data['FILTER_CL'],
			'filter_sz'				        =>$data['FILTER_SZ'],
			'stock_qty'						=>$data['STOCK_QTY'],
			'safe_qty'						=>$data['SAFE_QTY'],
			'order_qty'						=>$data['ORDER_QTY'],
			'create_date'					=>$data['CREATE_DATE'],
			'update_date'					=>$data['UPDATE_DATE'],
			
			'product_option'				=>$product_option,
			'relevant_product'				=>$relevant_product_info,
			'product_stock'					=>$product_stock,
			
			'set_product_info'				=>$set_product_info
		);
	}
}

function getProductStock($db,$product_idx){
	$select_product_stock_sql = "
		SELECT
			OO.IDX				AS OPTION_IDX,
			OO.OPTION_NAME		AS OPTION_NAME,
			OO.BARCODE			AS BARCODE,
			(
				SELECT
					IFNULL(SUM(S_PS.STOCK_QTY),0)
				FROM
					PRODUCT_STOCK S_PS
				WHERE
					S_PS.PRODUCT_IDX = PR.IDX AND
					S_PS.OPTION_IDX = OO.IDX AND
					S_PS.STOCK_DATE <= NOW()
			)					AS STOCK_QTY,
			(
				SELECT
					IFNULL(SUM(S_PS.STOCK_SAFE_QTY),0)
				FROM
					PRODUCT_STOCK S_PS
				WHERE
					S_PS.PRODUCT_IDX = PR.IDX AND
					S_PS.OPTION_IDX = OO.IDX AND
					S_PS.STOCK_DATE <= NOW()
			)					AS SAFE_QTY,
			(
				SELECT
					IFNULL(SUM(S_OP.PRODUCT_QTY),0)
				FROM
					ORDER_PRODUCT S_OP
				WHERE
					S_OP.ORDER_STATUS IN ('PCP','PPR','DPR','DPG','DCP') AND
					S_OP.PRODUCT_IDX = PR.IDX AND
					S_OP.OPTION_IDX = OO.IDX
			)					AS ORDER_QTY
		FROM
			SHOP_PRODUCT PR
			LEFT JOIN ORDERSHEET_OPTION OO ON
			PR.ORDERSHEET_IDX = OO.ORDERSHEET_IDX
		WHERE
			PR.IDX = ".$product_idx."
		ORDER BY
			OO.IDX
	";
	
	$db->query($select_product_stock_sql);
	
	$stock_info = array();
	foreach($db->fetch() as $stock_data) {
		$product_qty = intval($stock_data['STOCK_QTY']) - intval($stock_data['ORDER_QTY']);
		
		$stock_info[] = array(
			'option_idx'		=>$stock_data['OPTION_IDX'],
			'option_name'		=>$stock_data['OPTION_NAME'],
			'barcode'			=>$stock_data['BARCODE'],
			'stock_qty'			=>$stock_data['STOCK_QTY'],
			'safe_qty'			=>$stock_data['SAFE_QTY'],
			'order_qty'			=>$stock_data['ORDER_QTY'],
			'product_qty'		=>$product_qty
		);
	}
	
	return $stock_info;
}
?>