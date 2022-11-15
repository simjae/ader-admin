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

$search_type 		= $_POST['search_type'];			//검색분류
$search_keyword 	= $_POST['search_keyword'];			//검색 키워드

$product_type 		= $_POST['product_type'];			//상품 구분

$md_category_node	= $_POST['md_category_node'];
$md_category_depth  	= $_POST['md_category_depth'];

$inner_category_idx = $_POST['inner_category_idx'];		//카테고리
$child_search_flg	= $_POST['child_search_flg'];		//하위 분류 포함 검색
$none_category_flg	= $_POST['none_category_flg'];		//분류 미등록 상품 검색

$date_type 			= $_POST['date_type'];				//상품검색일 타입
$search_date 		= $_POST['search_date'];			//일자검색 옵션
$date_from 			= $_POST['date_from'];				//검색시작일
$date_to 			= $_POST['date_to'];				//검색종료일

$stock_management	= $_POST['stock_management'];		//재고관리 사용
$stock_type			= $_POST['stock_type'];				//재고타입
$stock_min			= $_POST['stock_min'];				//재고수량 최소값
$stock_max			= $_POST['stock_max'];				//재고수량 최대값
$stock_grade		= $_POST['stock_grade'];			//재고관리 등급
$sold_out_flg		= $_POST['sold_out_flg'];			//품절사용
$sold_out_status	= $_POST['sold_out_status'];		//품절상태
$display_status		= $_POST['display_status'];			//진열상태
$sale_flg			= $_POST['sale_flg'];				//판매여부

$price_type 		= $_POST['price_type'];				//상품 가격타입
$price_min 			= $_POST['price_min'];				//검색가격 최대값
$price_max 			= $_POST['price_max'];				//검색가격 최소값

$sort_type 			= $_POST['sort_type'];				//정렬 타입
$sort_value 		= $_POST['sort_value'];				//정렬 값
$translate 			= $_POST['translate'];				//번역 상태

$rows = $_POST['rows'];
$page = $_POST['page'];

$tables = "
	dev.SHOP_PRODUCT PRODUCT
";

//검색 유형 - 디폴트
$where = '1=1';
$where .= ' AND (PRODUCT.INDP_FLG = FALSE AND PRODUCT.DEL_FLG = FALSE) ';

$where_cnt = $where;
//검색 유형 - 상품 IDX
if ($product_idx != null) {
	$where .= " AND (PRODUCT.IDX IN (".$product_idx.")) ";
}

//검색 유형 - 검색분류
if ($search_type != null && $search_keyword != null) {
	$type_arr = array();
	for ($i=0; $i<count($search_type); $i++) {
		if (strlen($search_type[$i]) != 0) {
			array_push($type_arr,$search_type[$i]);
		}
	}
	
	$keyword_arr = array();
	for ($i=0; $i<count($search_keyword); $i++) {
		if (strlen($search_keyword[$i]) != 0) {
			array_push($keyword_arr,$search_keyword[$i]);
		}
	}
	
	if (count($type_arr) > 0 && count($keyword_arr) > 0) {
		$where .= " AND (";
		
		$tmp_where .= "";
		for ($i=0; $i<count($search_type); $i++) {
			$keyword_where = "";
			if ($search_type[$i] != null && $search_keyword[$i] != null) {
				if (strlen($tmp_where) > 0) {
					$tmp_where .= " AND ";
				}
				switch ($search_type[$i]) {
					case "name" :
						$keyword_where .= ' (PRODUCT.PRODUCT_NAME LIKE "%'.$search_keyword[$i].'%") ';
						break;
					
					case "code" :
						$keyword_where .= ' (PRODUCT.PRODUCT_CODE LIKE "%'.$search_keyword[$i].'%") ';
						break;

					case "category" :
						$keyword_where .= ' (
										PRODUCT.CATEGORY_IDX IN (
											SELECT
												IDX
											FROM
												dev.MD_CATEGORY
											WHERE
												TITLE LIKE "%'.$search_keyword[$i].'%"
										)
									) ';
						break;

					case "size" :
						$keyword_where .= " (
							CONCAT(
								IFNULL(PRODUCT.SIZE,''),'|',
								IFNULL(PRODUCT.SIZE_DETAIL_A1_KR,''),'|',
								IFNULL(PRODUCT.SIZE_DETAIL_A2_KR,''),'|',
								IFNULL(PRODUCT.SIZE_DETAIL_A3_KR,''),'|',
								IFNULL(PRODUCT.SIZE_DETAIL_A4_KR,''),'|',
								IFNULL(PRODUCT.SIZE_DETAIL_A5_KR,''),'|',
								IFNULL(PRODUCT.SIZE_DETAIL_ONESIZE_KR,''),'|',
								IFNULL(PRODUCT.SIZE_DETAIL_A1_EN,''),'|',
								IFNULL(PRODUCT.SIZE_DETAIL_A2_EN,''),'|',
								IFNULL(PRODUCT.SIZE_DETAIL_A3_EN,''),'|',
								IFNULL(PRODUCT.SIZE_DETAIL_A4_EN,''),'|',
								IFNULL(PRODUCT.SIZE_DETAIL_A5_EN,''),'|',
								IFNULL(PRODUCT.SIZE_DETAIL_ONESIZE_EN,''),'|',
								IFNULL(PRODUCT.SIZE_DETAIL_A1_CN,''),'|',
								IFNULL(PRODUCT.SIZE_DETAIL_A2_CN,''),'|',
								IFNULL(PRODUCT.SIZE_DETAIL_A3_CN,''),'|',
								IFNULL(PRODUCT.SIZE_DETAIL_A4_CN,''),'|',
								IFNULL(PRODUCT.SIZE_DETAIL_A5_CN,''),'|',
								IFNULL(PRODUCT.SIZE_DETAIL_ONESIZE_CN,'')
							) REGEXP '".$search_keyword[$i]."'
						) ";
						break;

					case "material" :
						$keyword_where .= " (
										CONCAT(
											IFNULL(PRODUCT.MATERIAL_KR,''),'|',
											IFNULL(PRODUCT.MATERIAL_EN,''),'|',
											IFNULL(PRODUCT.MATERIAL_CN,''),'|'
										) REGEXP '".$search_keyword[$i]."'
										
									) ";
						break;

					case "care" :
						$keyword_where .= " (
										CONCAT(
											IFNULL(PRODUCT.CARE_KR,''),'|',
											IFNULL(PRODUCT.CARE_EN,''),'|',
											IFNULL(PRODUCT.CARE_CN,''),'|'
										) REGEXP '".$search_keyword[$i]."'
									) ";

						break;

					case "detail" :
						$keyword_where .= " (
										CONCAT(
											IFNULL(PRODUCT.DETAIL_KR,''),'|',
											IFNULL(PRODUCT.DETAIL_EN,''),'|',
											IFNULL(PRODUCT.DETAIL_CN,''),'|'
										) REGEXP '".$search_keyword[$i]."'
									) ";
						break;
					
					case "tag" :
						$keyword_where .= " (PRODUCT.PRODUCT_TAG REGEXP '".$search_keyword[$i]."') ";
						break;
					
					case "creater" :
						$tmp_where .= ' (PRODUCT.CREATER LIKE "%'.$search_keyword[$i].'%") ';
						break;
				}
				
				$tmp_where .= $keyword_where;
			}
		}
		
		$where .= $tmp_where;
		
		$where .= " ) ";
	}
}

//검색 유형 - 카테고리
$length = 0;
$idx_array = array();
if ($inner_category_idx != null) {
	for ($i=0; $i<count($inner_category_idx); $i++) {
		if (strlen($inner_category_idx[$i]) != 0) {
			array_push($idx_array,$inner_category_idx[$i]);
		}
	}
	
	$length = count($idx_array);
	if ($length > 0) {
		$where .= " AND ( ";
		
		$where .= " (PRODUCT.MD_CATEGORY_".$length." = ".$idx_array[intval($length) - 1].") ";
		if ($child_search_flg != true) {
			if ($length < 6) {
				$where .= " AND (PRODUCT.MD_CATEGORY_".(intval($length) + 1)." = 0) ";
			}
		}
		
		if ($none_category_flg != null) {
			$where .= " OR (PRODUCT.CATEGORY_IDX = 0) ";
		}
		
		$where .= " ) ";
	} else {
		if ($none_category_flg == true) {
			$where .= " AND (PRODUCT.CATEGORY_IDX = 0) ";
		}
	}
}
else if($md_category_depth != null){
	if($md_category_node == null){
		$md_category_node = -1;
	}
	$where .= " AND (PRODUCT.MD_CATEGORY_".$md_category_depth." = ".$md_category_node." ) ";
}

//검색 유형 - 상품구분
if($product_type != null && $product_type!='ALL'){
	$where .= ' AND (PRODUCT.PRODUCT_TYPE LIKE "%'.$product_type.'%") ';
}

//검색 유형 - 상품가격
if($price_type != null && $price_min != null && $price_max != null){
	$cnt = 0;
	for ($i=0; $i<count($price_type); $i++) {
		if (strlen($price_type[$i]) > 0) {
			$cnt++;
		}
	}
	
	if ($cnt > 0) {
		$where .= " AND ( ";
		
		$tmp_where = "";
		for($i=0; $i<count($price_type); $i++) {
			$tmp_price = "";
			if (strlen($price_type[$i]) > 0) {
				if ($i > 0) {
					if (strlen($price_type[$i-1]) > 0) {
						$tmp_price .= " AND ";
					}
				}
				
				if ($price_min[$i] != null && $price_max[$i] == null) {
					$tmp_price .= " PRODUCT.".$price_type[$i]." >= ".$price_min[$i]." ";
				}
				
				if ($price_min[$i] == null && $price_max[$i] != null) {
					$tmp_price .= " PRODUCT.".$price_type[$i]." <= ".$price_max[$i]." ";
				}
				
				if($price_min[$i] != null && $price_max[$i] != null) {
					$tmp_price .= " PRODUCT.".$price_type[$i]." BETWEEN ".$price_min[$i]." AND ".$price_max[$i]." ";
				}
			}
			
			$tmp_where .= $tmp_price;
		}
		$where .= $tmp_where;
		
		$where .= " )";
	}
}

//검색 유형 - 상품 등록일
if ($search_date != null) {
	switch ($search_date) {
		case "today" :
			$where .= ' AND (PRODUCT.'.$date_type.' = CURDATE()) ';
			break;
		case "3d" :
			$where .= ' AND (PRODUCT.'.$date_type.' = (CURDATE() - INTERVAL 3 DAY)) ';
			break;
		case "1w" :
			$where .= ' AND (PRODUCT.'.$date_type.' >= (CURDATE() - INTERVAL 7 DAY)) ';
			break;
		case "1m" :
			$where .= ' AND (PRODUCT.'.$date_type.' >= (CURDATE() - INTERVAL 1 MONTH)) ';
			break;
		case "3m" :
			$where .= ' AND (PRODUCT.'.$date_type.' >= (CURDATE() - INTERVAL 3 MONTH)) ';
			break;
		case "1y" :
			$where .= ' AND (PRODUCT.'.$date_type.' >= (CURDATE() - INTERVAL 1 YEAR)) ';
			break;
	}
}

//검색 유형 - 상품 등록/수정일
if ($date_from != null && $date_to != null) {
	$where .= " AND (PRODUCT.".$date_type." BETWEEN '".$date_from."' AND '".$date_to."') ";
}
//검색 유형 - 번역 유무
if($translate == 'F'){
	$where .= " AND PRODUCT.DETAIL_EN IS null 
				AND PRODUCT.DETAIL_CN IS null ";
}
else if($translate == 'T'){
	$where .= " AND (PRODUCT.DETAIL_EN IS NOT null 
				OR PRODUCT.DETAIL_CN IS NOT null) ";
}

//검색 유형 - 재고관리 사용유무
if ($stock_management != null && $stock_management != "all") {
	$where .= " AND(
						(
							SELECT
								COUNT(IDX)
							FROM
								dev.PRODUCT_OPTION
							WHERE
								PRODUCT_CODE = PRODUCT.PRODUCT_CODE AND
								STOCK_MANAGEMENT = ".$stock_management."
						) > 0
				) ";
}

//검색 유형 - 재고수량
if($stock_type != null && ($stock_min != null || $stock_max != null)){
	$where .= " AND ( ";
		
	$tmp_where = "";
	
	if ($stock_type == "stock") {
		$stock_sql = "  (
							SELECT
								IFNULL(
									SUM(STOCK.STOCK_QUANTITY),0
								) AS STOCK_QUANTITY
							FROM
								dev.PRODUCT_STOCK STOCK
							WHERE
								 STOCK.STOCK_DATE <= NOW() AND
								 STOCK.PRODUCT_CODE = PRODUCT.PRODUCT_CODE
						) - (
							SELECT
								SUM(QTY) AS OPTION_QTY
							FROM
								(
									SELECT
										PRODUCT_TMP.PRODUCT_CODE,
										ORDERS.STATUS AS ORDERS_STATUS,
										GOODS.STATUS AS ORDERS_GOODS_STATUS,
										GOODS.QTY
									FROM
										dev.ORDERS_GOODS GOODS
										LEFT JOIN dev.SHOP_PRODUCT PRODUCT_TMP ON
										GOODS.GOODS_NO = PRODUCT_TMP.IDX
										LEFT JOIN dev.PRODUCT_OPTION OPTION ON
										GOODS.OPTION_NO = OPTION.IDX
										LEFT JOIN dev.ORDERS ON
										GOODS.ORDER_NO = ORDERS.IDX
								) AS STOCK_INFO
							WHERE
								PRODUCT_CODE = PRODUCT.PRODUCT_CODE AND
								ORDERS_STATUS NOT IN ('주문완료','결제대기','졀제확인','배송준비') AND
								ORDERS_GOODS_STATUS NOT IN ('준비중','준비완료','재고부족')
						) ";
	} else if ($stock_type == "safe") {
		$stock_sql = " (SELECT SUM(STOCK_SAFE_QUANTITY) FROM dev.PRODUCT_STOCK WHERE PRODUCT_CODE = PRODUCT.PRODUCT_CODE) ";
	}
	
	$tmp_where = "";
		
		
	if ($stock_min != null && $stock_max == null) {
		$tmp_where .= " (".$stock_sql." >= ".$stock_min.") ";
	}
	
	if ($stock_min == null && $stock_max != null) {
		$tmp_where .= " (".$stock_sql." BETWEEN 0 AND ".$stock_max.") ";
	}
	
	if($stock_min != null && $stock_max != null) {
		$tmp_where .= " (".$stock_sql." BETWEEN ".$stock_min." AND ".$stock_max.") ";
	}
	
	$where .= $tmp_where;
	
	$where .= " )";
}

//검색 유형 - 재고관리 등급
if ($stock_grade != null && $stock_grade != "all") {
	$where .= " AND (
						(
							SELECT
								COUNT(IDX)
							FROM
								dev.PRODUCT_OPTION
							WHERE
								PRODUCT_CODE = PRODUCT.PRODUCT_CODE AND
								STOCK_GRADE = '".$stock_grade."'
						) > 0
				) ";
}
//검색 유형 - 품절사용
if ($sold_out_flg != null && $sold_out_flg != "all") {
	$where .= " AND (
					(
						SELECT
							COUNT(IDX)
						FROM
							dev.PRODUCT_OPTION
						WHERE
							PRODUCT_CODE = PRODUCT.PRODUCT_CODE AND
							SOLD_OUT_FLG = ".$sold_out_flg."
					) > 0
				) ";
}

//검색 유형 - 품절상태
if ($sold_out_status != null && $sold_out_status != "all") {
	$where .= " AND (
					(
						SELECT
							IFNULL(
								SUM(STOCK.STOCK_QUANTITY),
								0
							) AS STOCK_QUANTITY
						FROM
							dev.PRODUCT_STOCK STOCK
						WHERE
							 STOCK.STOCK_DATE <= NOW() AND
							 STOCK.PRODUCT_CODE = PRODUCT.PRODUCT_CODE
					) > (
						SELECT
							SUM(QTY) AS OPTION_QTY
						FROM
							(
								SELECT
									PRODUCT_TMP.PRODUCT_CODE,
									ORDERS.STATUS AS ORDERS_STATUS,
									GOODS.STATUS AS ORDERS_GOODS_STATUS,
									SUM(GOODS.QTY) AS QTY
								FROM
									dev.ORDERS_GOODS GOODS
									LEFT JOIN dev.SHOP_PRODUCT PRODUCT_TMP ON
									GOODS.GOODS_NO = PRODUCT_TMP.IDX
									LEFT JOIN dev.PRODUCT_OPTION OPTION ON
									GOODS.OPTION_NO = OPTION.IDX
									LEFT JOIN dev.ORDERS ON
									GOODS.ORDER_NO = ORDERS.IDX
								WHERE
									GOODS.GOODS_NO = PRODUCT_TMP.IDX
								GROUP BY
									PRODUCT_TMP.PRODUCT_CODE
							) AS STOCK_INFO
						WHERE
							PRODUCT_CODE = PRODUCT.PRODUCT_CODE AND
							ORDERS_STATUS NOT IN ('주문완료','결제대기','졀제확인','배송준비') AND
							ORDERS_GOODS_STATUS NOT IN ('준비중','준비완료','재고부족')
					) = ".$sold_out_status."
				)";
}

//검색 유형 - 진열상태
if ($display_status != null && $display_status != "all") {
	if ($display_status == "true") {
		$display_sql = " > 0 ";
	} else if ($display_status == "false") {
		$display_sql = " = 0 ";
	}
	$where .= " AND (
					(
						SELECT
							COUNT(IDX)
						FROM
							dev.PRODUCT_GRID
						WHERE
							PRODUCT_IDX = PRODUCT.IDX
					) ".$display_sql."
				) ";
}

//검색 유형 - 판매여부
if ($sale_flg != null && $sale_flg != "all") {
	$where .= " AND (PRODUCT.SALE_FLG = ".$sale_flg.") ";
}

/** 정렬 조건 **/
$order = '';
if ($sort_value != null && $sort_type != null) {
	$order = ' PRODUCT.'.$sort_value." ".$sort_type." ";
} else {
	$order = ' PRODUCT.IDX DESC';
}

$limit_start = (intval($page)-1)*$rows;
$json_result = array(
	'total' => $db->count($tables,$where),
	'total_cnt' => $db->count($tables,$where_cnt),
	'page' => $page
);

$select = "";
if ($select_idx_flg == true) {
	$select.= " GROUP_CONCAT(PRODUCT.IDX SEPARATOR ',') AS PRODUCT_IDX_ARR ";
} else {
	$select.= " PRODUCT.IDX												AS IDX,
				(
					SELECT
						REPLACE(IMG.IMG_LOCATION,'/var/www/admin/www','')
					FROM
						dev.PRODUCT_IMG IMG
					WHERE
						IMG.PRODUCT_IDX = PRODUCT.IDX AND
						IMG.DEL_FLG = FALSE AND
						IMG.IMG_SIZE = 'sml' AND
						IMG.IMG_TYPE = 'PRODUCT'
				) AS IMG_LOCATION,
				PRODUCT.PRODUCT_TYPE									AS PRODUCT_TYPE,
				PRODUCT.STYLE_CODE										AS STYLE_CODE,
				PRODUCT.PRODUCT_CODE									AS PRODUCT_CODE,
				PRODUCT.CATEGORY_LRG									AS CATEGORY_LRG,
				PRODUCT.CATEGORY_MDL									AS CATEGORY_MDL,
				PRODUCT.CATEGORY_SML									AS CATEGORY_SML,
				PRODUCT.CATEGORY_DTL									AS CATEGORY_DTL,
				PRODUCT.MATERIAL										AS MATERIAL,
				PRODUCT.GRAPHIC											AS GRAPHIC,
				PRODUCT.FIT												AS FIT,
				PRODUCT.PRODUCT_NAME									AS PRODUCT_NAME,
				PRODUCT.SIZE											AS SIZE,
				PRODUCT.COLOR											AS COLOR,
				PRODUCT.COLOR_CODE										AS COLOR_CODE,
				PRODUCT.NAVIGATION										AS NAVIGATION,
				PRODUCT.LIMIT_PURCHASE_MEMBER_EXT						AS LIMIT_PURCHASE_MEMBER_EXT,
				PRODUCT.WKLA											AS WKLA,
				PRODUCT.MATERIAL_KR										AS MATERIAL_KR,
				PRODUCT.MATERIAL_EN										AS MATERIAL_EN,
				PRODUCT.MATERIAL_CN										AS MATERIAL_CN,
				PRODUCT.SIZE_DETAIL_MODEL								AS SIZE_DETAIL_MODEL,
				PRODUCT.SIZE_DETAIL_WEAR								AS SIZE_DETAIL_WEAR,
				PRODUCT.SIZE_DETAIL_A1_KR								AS SIZE_DETAIL_A1_KR,
				PRODUCT.SIZE_DETAIL_A2_KR								AS SIZE_DETAIL_A2_KR,
				PRODUCT.SIZE_DETAIL_A3_KR								AS SIZE_DETAIL_A3_KR,
				PRODUCT.SIZE_DETAIL_A4_KR								AS SIZE_DETAIL_A4_KR,
				PRODUCT.SIZE_DETAIL_A5_KR								AS SIZE_DETAIL_A5_KR,
				PRODUCT.SIZE_DETAIL_ONESIZE_KR							AS SIZE_DETAIL_ONESIZE_KR,
				PRODUCT.SIZE_DETAIL_A1_EN								AS SIZE_DETAIL_A1_EN,
				PRODUCT.SIZE_DETAIL_A2_EN								AS SIZE_DETAIL_A2_EN,
				PRODUCT.SIZE_DETAIL_A3_EN								AS SIZE_DETAIL_A3_EN,
				PRODUCT.SIZE_DETAIL_A4_EN								AS SIZE_DETAIL_A4_EN,
				PRODUCT.SIZE_DETAIL_A5_EN								AS SIZE_DETAIL_A5_EN,
				PRODUCT.SIZE_DETAIL_ONESIZE_EN							AS SIZE_DETAIL_ONESIZE_EN,
				PRODUCT.SIZE_DETAIL_A1_CN								AS SIZE_DETAIL_A1_CN,
				PRODUCT.SIZE_DETAIL_A2_CN								AS SIZE_DETAIL_A2_CN,
				PRODUCT.SIZE_DETAIL_A3_CN								AS SIZE_DETAIL_A3_CN,
				PRODUCT.SIZE_DETAIL_A4_CN								AS SIZE_DETAIL_A4_CN,
				PRODUCT.SIZE_DETAIL_A5_CN								AS SIZE_DETAIL_A5_CN,
				PRODUCT.SIZE_DETAIL_ONESIZE_CN							AS SIZE_DETAIL_ONESIZE_CN,
				PRODUCT.CARE_KR											AS CARE_KR,
				PRODUCT.CARE_EN											AS CARE_EN,
				PRODUCT.CARE_CN											AS CARE_CN,
				PRODUCT.DETAIL_KR										AS DETAIL_KR,
				PRODUCT.DETAIL_EN										AS DETAIL_EN,
				PRODUCT.DETAIL_CN										AS DETAIL_CN,
				PRODUCT.PRICE_KR										AS PRICE_KR,
				PRODUCT.PRICE_KR_GB										AS PRICE_KR_GB,
				PRODUCT.PRICE_EN										AS PRICE_EN,
				PRODUCT.PRICE_CN										AS PRICE_CN,
				PRODUCT.MD_CATEGORY_1									AS MD_CATEGORY_1,
				PRODUCT.MD_CATEGORY_2									AS MD_CATEGORY_2,
				PRODUCT.MD_CATEGORY_3									AS MD_CATEGORY_3,
				PRODUCT.MD_CATEGORY_4									AS MD_CATEGORY_4,
				PRODUCT.MD_CATEGORY_5									AS MD_CATEGORY_5,
				PRODUCT.MD_CATEGORY_6									AS MD_CATEGORY_6,
				PRODUCT.CATEGORY_IDX									AS CATEGORY_IDX,
				PRODUCT.SALES_PRICE_KR									AS SALES_PRICE_KR,
				PRODUCT.SALES_PRICE_EN									AS SALES_PRICE_EN,
				PRODUCT.SALES_PRICE_CN									AS SALES_PRICE_CN,
				PRODUCT.OPTION_STOCK_SET								AS OPTION_STOCK_SET,
				PRODUCT.LIMIT_PURCHASE_MEMBER							AS LIMIT_PURCHASE_MEMBER,
				PRODUCT.LIMIT_PURCHASE_SINGLE							AS LIMIT_PURCHASE_SINGLE,
				PRODUCT.LIMIT_PURCHASE_QTY_MIN_NUM						AS LIMIT_PURCHASE_QTY_MIN_NUM,
				PRODUCT.LIMIT_PURCHASE_QTY_MAX_NUM						AS LIMIT_PURCHASE_QTY_MAX_NUM,
				PRODUCT.DETAIL_REFUND_KR								AS DETAIL_REFUND_KR,
				PRODUCT.DETAIL_REFUND_EN								AS DETAIL_REFUND_EN,
				PRODUCT.DETAIL_REFUND_CN								AS DETAIL_REFUND_CN,
				PRODUCT.PRODUCT_KEYWORD									AS PRODUCT_KEYWORD,
				PRODUCT.PRODUCT_TAG										AS PRODUCT_TAG,
				PRODUCT.IMG_PRODUCT_DETAIL								AS IMG_PRODUCT_DETAIL,
				PRODUCT.IMG_WEAR_DETAIL									AS IMG_WEAR_DETAIL,
				PRODUCT.PRODUCT_TOTAL_WEIGHT							AS PRODUCT_TOTAL_WEIGHT,
				PRODUCT.HS_CODE											AS HS_CODE,
				PRODUCT.PRODUCT_DIVISION								AS PRODUCT_DIVISION,
				PRODUCT.PRODUCT_MATERIAL_KR								AS PRODUCT_MATERIAL_KR,
				PRODUCT.PRODUCT_MATERIAL_EN								AS PRODUCT_MATERIAL_EN,
				PRODUCT.FABRIC											AS FABRIC,
				PRODUCT.MANUFACTURER									AS MANUFACTURER,
				PRODUCT.SUPPLIER										AS SUPPLIER,
				PRODUCT.BRAND											AS BRAND,
				PRODUCT.TREND											AS TREND,
				PRODUCT.SELF_CLASSIFICATION								AS SELF_CLASSIFICATION,
				DATE_FORMAT(PRODUCT.MANUFACTURING_DATE,'%Y-%m-%d')		AS MANUFACTURING_DATE,
				DATE_FORMAT(PRODUCT.RELEASE_DATE,'%Y-%m-%d')			AS RELEASE_DATE,
				DATE_FORMAT(PRODUCT.VALIDATE_START_DATE,'%Y-%m-%d')		AS VALIDATE_START_DATE,
				DATE_FORMAT(PRODUCT.VALIDATE_END_DATE,'%Y-%m-%d')		AS VALIDATE_END_DATE,
				PRODUCT.ORIGIN_COUNTRY									AS ORIGIN_COUNTRY,
				PRODUCT.PRODUCT_WIDTH									AS PRODUCT_WIDTH,
				PRODUCT.PRODUCT_DEPTH									AS PRODUCT_DEPTH,
				PRODUCT.PRODUCT_VOLUME									AS PRODUCT_VOLUME,
				PRODUCT.SEO_EXPOSURE_FLG								AS SEO_EXPOSURE_FLG,
				PRODUCT.SEO_TITLE										AS SEO_TITLE,
				PRODUCT.SEO_AUTHOR										AS SEO_AUTHOR,
				PRODUCT.SEO_DESCRIPTION									AS SEO_DESCRIPTION,
				PRODUCT.SEO_KEYWORDS									AS SEO_KEYWORDS,
				PRODUCT.SEO_ALT_TEXT									AS SEO_ALT_TEXT,
				PRODUCT.MEMO											AS MEMO,
				PRODUCT.RELEVANT_IDX									AS RELEVANT_IDX,
				DATE_FORMAT(PRODUCT.RELEASE_START_DATE,'%Y-%m-%d')		AS RELEASE_START_DATE,
				DATE_FORMAT(PRODUCT.RELEASE_END_DATE,'%Y-%m-%d')		AS RELEASE_END_DATE,
				DATE_FORMAT(PRODUCT.DISPLAY_START_DATE,'%Y-%m-%d')		AS DISPLAY_START_DATE,
				DATE_FORMAT(PRODUCT.DISPLAY_END_DATE,'%Y-%m-%d')		AS DISPLAY_END_DATE,
				PRODUCT.NON_RELEASE_REASON								AS NON_RELEASE_REASON,
				PRODUCT.INDP_FLG										AS INDP_FLG,
				PRODUCT.DEL_FLG											AS DEL_FLG,
				PRODUCT.CREATE_DATE										AS CREATE_DATE,
				PRODUCT.CREATER											AS CREATER,
				PRODUCT.UPDATE_DATE										AS UPDATE_DATE,
				PRODUCT.UPDATER											AS UPDATER ";
}

$sql = 	'SELECT
			'.$select.'
		FROM 
			'.$tables.'
		WHERE 
			'.$where.'
		ORDER BY 
			'.$order;

if ($rows != null && $select_idx_flg == null) {
	$sql .= " LIMIT ".$limit_start.",".$rows;
}

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

$db->query($sql,$where_values);
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
			'no'							=>intval($data['IDX']),
			'img_location'					=>$data['IMG_LOCATION'],
			'img_result'					=>$img_result,
			'product_type'					=>$data['PRODUCT_TYPE'],
			'style_code'					=>$data['STYLE_CODE'],
			'product_code'					=>$data['PRODUCT_CODE'],
			'category_lrg'					=>$data['CATEGORY_LRG'],
			'category_mdl'					=>$data['CATEGORY_MDL'],
			'category_sml'					=>$data['CATEGORY_SML'],
			'category_dtl'					=>$data['CATEGORY_DTL'],
			'material'						=>$data['MATERIAL'],
			'graphic'						=>$data['GRAPHIC'],
			'fit'							=>$data['FIT'],
			'product_name'					=>$data['PRODUCT_NAME'],
			'size'							=>$data['SIZE'],
			'color'							=>$data['COLOR'],
			'color_code'					=>$data['COLOR_CODE'],
			'navigation'					=>$data['NAVIGATION'],
			'limit_purchase_member_ext'		=>$data['LIMI_PURCHASE_MEMBER_EXT'],
			'wkla'							=>$data['WKLA'],
			'material_kr'					=>$data['MATERIAL_KR'],
			'material_en'					=>$data['MATERIAL_EN'],
			'material_cn'					=>$data['MATERIAL_CN'],
			'size_detail_model'				=>$data['SIZE_DETAIL_MODEL'],
			'size_detail_wear'				=>$data['SIZE_DETAIL_WEAR'],
			'size_detail_a1_kr'				=>$data['SIZE_DETAIL_A1_KR'],
			'size_detail_a2_kr'				=>$data['SIZE_DETAIL_A2_KR'],
			'size_detail_a3_kr'				=>$data['SIZE_DETAIL_A3_KR'],
			'size_detail_a4_kr'				=>$data['SIZE_DETAIL_A4_KR'],
			'size_detail_a5_kr'				=>$data['SIZE_DETAIL_A5_KR'],
			'size_detail_onesize_kr'		=>$data['SIZE_DETAIL_ONESIZE_KR'],
			'size_detail_a1_en'				=>$data['SIZE_DETAIL_A1_EN'],
			'size_detail_a2_en'				=>$data['SIZE_DETAIL_A2_EN'],
			'size_detail_a3_en'				=>$data['SIZE_DETAIL_A3_EN'],
			'size_detail_a4_en'				=>$data['SIZE_DETAIL_A4_EN'],
			'size_detail_a5_en'				=>$data['SIZE_DETAIL_A5_EN'],
			'size_detail_onesize_en'		=>$data['SIZE_DETAIL_ONESIZE_EN'],
			'size_detail_a1_cn'				=>$data['SIZE_DETAIL_A1_CN'],
			'size_detail_a2_cn'				=>$data['SIZE_DETAIL_A2_CN'],
			'size_detail_a3_cn'				=>$data['SIZE_DETAIL_A3_CN'],
			'size_detail_a4_cn'				=>$data['SIZE_DETAIL_A4_CN'],
			'size_detail_a5_cn'				=>$data['SIZE_DETAIL_A5_CN'],
			'size_detail_onesize_cn'		=>$data['SIZE_DETAIL_ONESIZE_CN'],
			'care_kr'						=>$data['CARE_KR'],
			'care_en'						=>$data['CARE_EN'],
			'care_cn'						=>$data['CARE_CN'],
			'detail_kr'						=>$data['DETAIL_KR'],
			'detail_en'						=>$data['DETAIL_EN'],
			'detail_cn'						=>$data['DETAIL_CN'],
			'price_kr'						=>$data['PRICE_KR'],
			'price_kr_gb'					=>$data['PRICE_KR_GB'],
			'price_en'						=>$data['PRICE_EN'],
			'price_cn'						=>$data['PRICE_CN'],
			'md_category_1'					=>$data['MD_CATEGORY_1'],
			'md_category_2'					=>$data['MD_CATEGORY_2'],
			'md_category_3'					=>$data['MD_CATEGORY_3'],
			'md_category_4'					=>$data['MD_CATEGORY_4'],
			'md_category_5'					=>$data['MD_CATEGORY_5'],
			'md_category_6'					=>$data['MD_CATEGORY_6'],
			'category_idx'					=>$data['CATEGORY_IDX'],
			'sales_price_kr'				=>$data['SALES_PRICE_KR'],
			'sales_price_en'				=>$data['SALES_PRICE_EN'],
			'sales_price_cn'				=>$data['SALES_PRICE_CN'],
			'option_stock_set'				=>$data['OPTION_STOCK_SET'],
			'limit_purchase_member'			=>$data['LIMIT_PURCHASE_MEMBER'],
			'limit_purchase_single'			=>$data['LIMIT_PURCHASE_SINGLE'],
			'limit_purchase_qty_min_num'	=>$data['LIMIT_PURCHASE_QTY_MIN_NUM'],
			'limit_purchase_qty_max_num'	=>$data['LIMIT_PURCHASE_QTY_MAX_NUM'],
			'detail_refund_kr'				=>$data['DETAIL_REFUND_KR'],
			'detail_refund_en'				=>$data['DETAIL_REFUND_EN'],
			'detail_refund_cn'				=>$data['DETAIL_REFUND_CN'],
			'product_keyword'				=>$data['PRODUCT_KEYWORD'],
			'product_tag'					=>$data['PRODUCT_TAG'],
			'img_product_detail'			=>$data['IMG_PRODUCT_DETAIL'],
			'img_wear_detail'				=>$data['IMG_WEAR_DETAIL'],
			'img_result'					=>$img_result,
			'product_total_weight'			=>$data['PRODUCT_TOTAL_WEIGHT'],
			'hs_code'						=>$data['HS_CODE'],
			'product_division'				=>$data['PRODUCT_DIVISION'],
			'product_material_kr'			=>$data['PRODUCT_MATERIAL_KR'],
			'product_material_en'			=>$data['PRODUCT_MATERIAL_EN'],
			'fabric'						=>$data['FABRIC'],
			'manufacturer'					=>$data['MANUFACTURER'],
			'supplier'						=>$data['SUPPLIER'],
			'brand'							=>$data['BRAND'],
			'trend'							=>$data['TREND'],
			'self_classification'			=>$data['SELF_CLASSIFICATION'],
			'manufacturing_date'			=>$data['MANUFACTURING_DATE'],
			'release_date'					=>$data['RELEASE_DATE'],
			'validate_start_date'			=>$data['VALIDATE_START_DATE'],
			'validate_end_date'				=>$data['VALIDATE_END_DATE'],
			'origin_country'				=>$data['ORIGIN_COUNTRY'],
			'product_width'					=>$data['PRODUCT_WIDTH'],
			'product_depth'					=>$data['PRODUCT_DEPTH'],
			'product_height'				=>$data['PRODUCT_HEIGHT'],
			'product_volume'				=>$data['PRODUCT_VOLUME'],
			'seo_exposure_flg'				=>$data['SEO_EXPOSURE_FLG'],
			'seo_title'						=>$data['SEO_TITLE'],
			'seo_author'					=>$data['SEO_AUTHOR'],
			'seo_description'				=>$data['SEO_DESCRIPTION'],
			'seo_keywords'					=>$data['SEO_KEYWORDS'],
			'seo_alt_text'					=>$data['SEO_ALT_TEXT'],
			'memo'							=>$data['MEMO'],
			'relevant_idx'					=>$data['RELEVANT_IDX'],
			'release_start_date'			=>$data['RELEASE_START_DATE'],
			'release_end_date'				=>$data['RELEASE_END_DATE'],
			'display_start_date'			=>$data['DISPLAY_START_DATE'],
			'display_end_date'				=>$data['DISPLAY_END_DATE'],
			'non_release_reason'			=>$data['NON_RELEASE_REASON'],
			'create_date'					=>$data['CREATE_DATE'],
			'update_date'					=>$data['UPDATE_DATE'],
			'relevant_product'				=>$relevant_product
		);
	}
}
?>