<?php
/*
 +=============================================================================
 | 
 | 회원 목록
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.07.27
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
$sold_out_flg		= $_POST['sold_out_flg'];			//품절재고 검색 플래그

$search_type 		= $_POST['search_type'];			//검색분류
$search_keyword 	= $_POST['search_keyword'];			//검색 키워드

$product_type 		= $_POST['product_type'];			//상품 구분

$inner_category_idx = $_POST['inner_category_idx'];		//카테고리
$child_search_flg	= $_POST['child_search_flg'];		//하위 분류 포함 검색
$none_category_flg	= $_POST['none_category_flg'];		//분류 미등록 상품 검색

$date_type 			= $_POST['date_type'];				//상품검색일 타입
$search_date 		= $_POST['search_date'];			//일자검색 옵션
$date_from 			= $_POST['date_from'];				//검색시작일
$date_to 			= $_POST['date_to'];				//검색종료일

$price_type 		= $_POST['price_type'];				//상품 가격타입
$price_min 			= $_POST['price_min'];				//검색가격 최대값
$price_max 			= $_POST['price_max'];				//검색가격 최소값

$sort_type 			= $_POST['sort_type'];				//정렬 타입
$sort_value 		= $_POST['sort_value'];				//정렬 값

$translate 			= $_POST['translate'];				//번역 상태

$stock_management	= $_POST['stock_management'];		//재고관리 사용
$stock_type			= $_POST['stock_type'];				//재고타입
$stock_min			= $_POST['stock_min'];				//재고수량 최소값
$stock_max			= $_POST['stock_max'];				//재고수량 최대값
$stock_grade		= $_POST['stock_grade'];			//재고관리 등급
$sold_out_flg		= $_POST['sold_out_flg'];			//품절사용
$sold_out_status	= $_POST['sold_out_status'];		//품절상태
$display_status		= $_POST['display_status'];			//진열상태
$sale_flg			= $_POST['sale_flg'];				//판매여부

$rows = $_POST['rows'];
$page = $_POST['page'];

$tables = " dev.PRODUCT_STOCK STOCK
			LEFT JOIN dev.SHOP_PRODUCT PRODUCT ON
			STOCK.PRODUCT_CODE = PRODUCT.PRODUCT_CODE
			LEFT JOIN dev.PRODUCT_OPTION OPTION ON
			STOCK.OPTION_CODE = OPTION.OPTION_CODE ";

//검색 유형 - 디폴트
$where = " 1=1 ";
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
					
					case "keyword_where" :
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
						$tmp_price .= " OR ";
					}
				}
				
				if(is_numeric($price_min[$i]) && !is_numeric($price_max[$i])) {
					$tmp_price .= " PRODUCT.".$price_type[$i]." >= ".$price_min[$i]." ";
				}
				
				if(!is_numeric($price_min[$i]) && is_numeric($price_max[$i])) {
					$tmp_price .= " PRODUCT.".$price_type[$i]." <= ".$price_max[$i]." ";
				}
				
				if (is_numeric($price_min[$i]) && is_numeric($price_max[$i])) {
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
						)";
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
$limit = "";
if ($rows != null) {
	$limit = " ".$limit_start.",".$rows." ";
}

$order_stock_sql = "SELECT
						OPTION_CODE,
						SUM(QTY) AS OPTION_QTY
					FROM
						(
							SELECT
								OPTION.OPTION_CODE,
								ORDERS.STATUS AS ORDERS_STATUS,
								GOODS.STATUS AS ORDERS_GOODS_STATUS,
								GOODS.QTY
							FROM
								dev.ORDERS_GOODS GOODS
								LEFT JOIN dev.SHOP_PRODUCT PRODUCT ON
								GOODS.GOODS_NO = PRODUCT.IDX
								LEFT JOIN dev.PRODUCT_OPTION OPTION ON
								GOODS.OPTION_NO = OPTION.IDX
								LEFT JOIN dev.ORDERS ON
								GOODS.ORDER_NO = ORDERS.IDX
							WHERE
								".$where."
						) AS STOCK_INFO
					WHERE
						ORDERS_STATUS NOT IN ('주문완료','결제대기','졀제확인','배송준비') AND
						ORDERS_GOODS_STATUS NOT IN ('준비중','준비완료','재고부족')
					GROUP BY
						OPTION_CODE";

$db->query($order_stock_sql);
$order_stock = array();
foreach($db->fetch() as $data) {
	$option_code = $data['OPTION_CODE'];
	
	$order_stock[$option_code] = $data['OPTION_QTY'];
}

$where_cnt = " (STOCK.STOCK_DATE <= NOW()) ";
$where .= " AND ".$where_cnt;

$total_cnt_table = "(
				SELECT
					COUNT(*)
				FROM
					dev.PRODUCT_STOCK STOCK
					LEFT JOIN dev.SHOP_PRODUCT PRODUCT ON
					STOCK.PRODUCT_CODE = PRODUCT.PRODUCT_CODE
					LEFT JOIN dev.PRODUCT_OPTION OPTION ON
					STOCK.OPTION_CODE = OPTION.OPTION_CODE
				WHERE
					".$where_cnt."
				GROUP BY
					STOCK.OPTION_CODE
			) AS TMP";

$cnt_table = "(
				SELECT
					COUNT(*)
				FROM
					dev.PRODUCT_STOCK STOCK
					LEFT JOIN dev.SHOP_PRODUCT PRODUCT ON
					STOCK.PRODUCT_CODE = PRODUCT.PRODUCT_CODE
					LEFT JOIN dev.PRODUCT_OPTION OPTION ON
					STOCK.OPTION_CODE = OPTION.OPTION_CODE
				WHERE
					".$where."
				GROUP BY
					STOCK.OPTION_CODE
			) AS TMP";

$json_result = array(
	'total' => $db->count($cnt_table),
	'total_cnt' => $db->count($total_cnt_table),
	'page' => $page
);

$product_stock_sql ="SELECT
						STOCK.PRODUCT_CODE,
						(
							SELECT
								REPLACE(IMG.IMG_LOCATION,'/var/www/admin/www','')
							FROM
								dev.PRODUCT_IMG IMG
							WHERE
								DEL_FLG = FALSE AND
								IMG.PRODUCT_CODE = STOCK.PRODUCT_CODE AND
								IMG.IMG_TYPE = 'PRODUCT' AND
								IMG.IMG_SIZE = 'sml'
						) AS IMG_LOCATION,
                        STOCK.PRODUCT_NAME,
                        OPTION.IDX AS OPTION_IDX,
						OPTION.OPTION_CODE,
						OPTION.OPTION_NAME,
						OPTION.STOCK_MANAGEMENT,
						OPTION.STOCK_GRADE,
						OPTION.QTY_CHECK_TYPE,
						OPTION.SOLD_OUT_FLG,
						SUM(STOCK.STOCK_QUANTITY) AS STOCK_QUANTITY,
						SUM(STOCK.STOCK_SAFE_QUANTITY) AS STOCK_SAFE_QUANTITY,
						SUM(STOCK.TOTAL_SALES_CNT) AS TOTAL_SALES_CNT
					FROM
						dev.PRODUCT_STOCK STOCK
						LEFT JOIN dev.SHOP_PRODUCT PRODUCT ON
						STOCK.PRODUCT_CODE = PRODUCT.PRODUCT_CODE
						LEFT JOIN dev.PRODUCT_OPTION OPTION ON
						STOCK.OPTION_CODE = OPTION.OPTION_CODE
					WHERE
						".$where."
					GROUP BY
						STOCK.OPTION_CODE
					ORDER BY
						STOCK.PRODUCT_CODE, STOCK.OPTION_NAME, STOCK.STOCK_DATE DESC
					LIMIT
						".$limit;

$db->query($product_stock_sql);
foreach($db->fetch() as $data) {
	if ($sold_out_flg != null) {
		if (intval($data['STOCK_QUANTITY']) - intval($order_stock[$data['OPTION_CODE']]) > 0 ) {
			continue;
		}
	}
	
	$json_result['data'][] = array(
		'num'						=>$total_cnt--,
		'product_code'				=>$data['PRODUCT_CODE'],
		'product_name'				=>$data['PRODUCT_NAME'],
		'img_location'				=>$data['IMG_LOCATION'],
		'option_idx'				=>$data['OPTION_IDX'],
		'option_code'				=>$data['OPTION_CODE'],
		'option_name'				=>$data['OPTION_NAME'],
		'stock_management'			=>$data['STOCK_MANAGEMENT'],
		'stock_grade'				=>$data['STOCK_GRADE'],
		'qty_check_type'			=>$data['QTY_CHECK_TYPE'],
		'sold_out_flg'				=>$data['SOLD_OUT_FLG'],
		'stock_quantity'			=>intval($data['STOCK_QUANTITY']),
		'safe_quantity'				=>intval($data['STOCK_SAFE_QUANTITY']),
		'order_stock'				=>intval($order_stock[$data['OPTION_CODE']]),
		'total_sales_cnt'			=>intval($data['TOTAL_SALES_CNT'])
	);
}
?>