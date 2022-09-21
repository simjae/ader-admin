<?php
/*
 +=============================================================================
 | 
 | 삭제 상품 목록 조회 API
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.07.11
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

/** 변수 정리 **/
$tab_num = $_POST['tab_num'];
$search_type = $_POST['search_type'];
$search_keyword = $_POST['search_keyword'];

$inner_category_idx = $_POST['inner_category_idx'];
$child_search_flg = $_POST['child_search_flg'];
$none_category_flg = $_POST['none_category_flg'];

$date_type = $_POST['date_type'];
$search_date = $_POST['search_date'];
$create_from = $_POST['create_from'];
$create_to = $_POST['create_to'];

$price_type	= $_POST['price_type'];				//상품 가격타입
$price_min = $_POST['price_min'];				//검색가격 최대값
$price_max = $_POST['price_max'];				//검색가격 최소값

$translate_flg = $_POST['translate_flg'];

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

$tables = ' dev.SHOP_PRODUCT PRODUCT ';

$sort_value = $_POST['sort_value'];
$sort_type = $_POST['sort_type'];

/** 검색 조건 **/
$where = '1=1';
$cnt_where = "";
if ($tab_num != null) {
	if ($tab_num == "01") {
		$where .= ' AND (PRODUCT.PERSONAL_ORDER_FLG = FALSE AND PRODUCT.DEL_FLG = TRUE) ';
	} else {
		$where .= ' AND (PRODUCT.PERSONAL_ORDER_FLG = TRUE AND PRODUCT.DEL_FLG = TRUE) ';
	}
}
$cnt_where .= $where;

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

if ($search_date != null) {
	switch ($search_date) {
		case "today" :
			$where .= ' AND (PRODUCT.'.$date_type.' = CURDATE()) ';
			break;
		
		case "01d" :
			$where .= ' AND (PRODUCT.'.$date_type.' = (CURDATE() - INTERVAL 1 DAY)) ';
			break;
		
		case "03d" :
			$where .= ' AND (PRODUCT.'.$date_type.' >= (CURDATE() - INTERVAL 3 DAY)) ';
			break;
		
		case "07d" :
			$where .= ' AND (PRODUCT.'.$date_type.' >= (CURDATE() - INTERVAL 7 DAY)) ';
			break;
		
		case "15d" :
			$where .= ' AND (PRODUCT.'.$date_type.' >= (CURDATE() - INTERVAL 15 DAY)) ';
			break;
		
		case "01m" :
			$where .= ' AND (PRODUCT.'.$date_type.' >= (CURDATE() - INTERVAL 1 MONTH)) ';
			break;
		
		case "03m" :
			$where .= ' AND (PRODUCT.'.$date_type.' >= (CURDATE() - INTERVAL 3 MONTH)) ';
			break;
		
		case "01y" :
			$where .= ' AND (PRODUCT.'.$date_type.' >= (CURDATE() - INTERVAL 1 YEAR)) ';
			break;
	}
}

if ($create_from != null && $create_to != null) {
	$where .= " AND (PRODUCT.".$date_type." BETWEEN '".$create_from."' AND '".$create_to."') ";
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

if ($translate_flg != null) {
	if ($translate_flg == true) {
		$where .= " AND (PRODUCT.DETAIL_EN IS NOT NULL OR PRODUCT.DETAIL_CN IS NOT NULL) ";
	} else {
		$where .= " AND (PRODUCT.DETAIL_EN IS NULL AND PRODUCT.DETAIL_CN IS NULL) ";
	}
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
	$order = ' PRODUCT.IDX DESC ';
}

/** DB 처리 **/

$json_result = array(
	'total' => $db->count($tables,$where),
	'total_cnt' => $db->count($tables,$cnt_where),
	'page' => intval($page)
);

$limit_start = (intval($page)-1)*$rows;

$sql = "SELECT
			IDX,
			PRODUCT_TYPE,
			PRODUCT_CODE,
			PRODUCT_NAME,
			(
				SELECT
					REPLACE(IMG_LOCATION,'/var/www/admin/www','')
				FROM
					dev.PRODUCT_IMG
				WHERE
					DEL_FLG = FALSE AND
					IMG_TYPE = 'product' AND
					IMG_SIZE = 'sml' AND
					PRODUCT_IDX = PRODUCT.IDX
			) AS IMG_LOCATION,
			SALES_PRICE_KR,
			SALES_PRICE_EN,
			SALES_PRICE_CN,
			UPDATE_DATE
		FROM
			".$tables."
		WHERE
			".$where."
		ORDER BY
			".$order;
if ($rows != null) {
	$sql .= " LIMIT ".$limit_start.",".$rows;
}

$db->query($sql);
foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'length'=>$length,
		'no'=>intval($data['IDX']),
		'num'=>$total_cnt--,
		'product_type'=>$data['PRODUCT_TYPE'],
		'product_code'=>$data['PRODUCT_CODE'],
		'product_name'=>$data['PRODUCT_NAME'],
		'img_location'=>$data['IMG_LOCATION'],
		'sales_price_kr'=>$data['SALES_PRICE_KR'],
		'sales_price_cn'=>$data['SALES_PRICE_CN'],
		'sales_price_en'=>$data['SALES_PRICE_EN'],
		'update_date'=>$data['UPDATE_DATE']
	);
}
?>