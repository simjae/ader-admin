<?php
/*
 +=============================================================================
 | 
 | 실시간 인기 제품 모달 검색 조회
 | -------
 |
 | 최초 작성	: 손성환
 | 최초 작성일	: 2022.11.28
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$country			= $_POST['country'];				//국가

$search_type 		= $_POST['search_type'];			//검색분류
$search_keyword 	= $_POST['search_keyword'];			//검색 키워드
$product_type 		= $_POST['product_type'];			//상품 구분
$stock_type			= $_POST['stock_type'];				//재고타입
$stock_min			= $_POST['stock_min'];				//재고수량 최소값
$stock_max			= $_POST['stock_max'];				//재고수량 최대값
$sold_out_status	= $_POST['sold_out_status'];		//품절상태
$price_type 		= $_POST['price_type'];				//상품 가격타입
$price_min 			= $_POST['price_min'];				//검색가격 최대값
$price_max 			= $_POST['price_max'];				//검색가격 최소값

$sort_type 			= $_POST['sort_type'];				//정렬 타입
$sort_value 		= $_POST['sort_value'];				//정렬 값

$rows = $_POST['rows'];
$page = $_POST['page'];

$where_cnt="PR.SALE_FLG = TRUE AND
			PR.IDX IN (
				SELECT
					DISTINCT PRODUCT_IDX
				FROM
					dev.PRODUCT_GRID S_PG
					LEFT JOIN dev.PAGE_PRODUCT S_PP ON
					S_PG.PAGE_IDX = S_PP.IDX
				WHERE
					S_PP.DISPLAY_FLG = TRUE AND
					CURDATE() BETWEEN S_PP.DISPLAY_START_DATE AND S_PP.DISPLAY_END_DATE
			) AND
			PR.IDX NOT IN (
				SELECT
					S_PP.PRODUCT_IDX
				FROM
					dev.POPULAR_PRODUCT S_PP
				WHERE
					S_PP.COUNTRY = '".$country."'
			)";

$where = "";

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
						$keyword_where .= ' (PR.PRODUCT_NAME LIKE "%'.$search_keyword[$i].'%") ';
						break;
					
					case "code" :
						$keyword_where .= ' (PR.PRODUCT_CODE LIKE "%'.$search_keyword[$i].'%") ';
						break;
				}
				
				$tmp_where .= $keyword_where;
			}
		}
		
		$where .= $tmp_where;
		
		$where .= " ) ";
	}
}

//검색 유형 - 상품구분
if($product_type != null && $product_type!='ALL'){
	$where .= ' AND (PR.PRODUCT_TYPE LIKE "%'.$product_type.'%") ';
}

//검색 유형 - 재고수량
if($stock_type != null && ($stock_min != null || $stock_max != null)){
	$where .= " AND ( ";
		
	$tmp_where = "";
	
	if ($stock_type == "stock") {
		$stock_sql = "  (
							SELECT
								IFNULL(
									SUM(S_PS.STOCK_QTY),0
								)
							FROM
								dev.PRODUCT_STOCK PS
							WHERE
								 PS.STOCK_DATE <= NOW() AND
								 PS.PRODUCT_IDX = PR.IDX
						) - (
							SELECT
								IFNULL(
									SUM(S_OP.PRODUCT_QTY),0
								)
							FROM
								dev.ORDER_PRODUCT S_OP
							WHERE
								S_OP.PRODUCT_IDX = PR.IDX AND
								S_OP.ORDER_STATUS IN ('PCP','PPR','DPR','DPG','DCP')
						)	AS ORDER_QTY ";
	} else if ($stock_type == "safe") {
		$stock_sql  = " (
							SELECT
								IFNULL(
									SUM(STOCK_SAFE_QTY),0
								)
							FROM
								dev.PRODUCT_STOCK S_PS
							WHERE
								S_PS.PRODUCT_IDX = PR.IDX
						) ";
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

//검색 유형 - 품절상태
if ($sold_out_status != null && $sold_out_status != "all") {
	$where .= " AND (
					(
						SELECT
							IFNULL(
								SUM(S_PS.STOCK_QTY),
								0
							)
						FROM
							dev.PRODUCT_STOCK S_PS
						WHERE
							 S_PS.STOCK_DATE <= NOW() AND
							 S_PS.PRODUCT_IDX = PR.IDX
					) > (
						SELECT
							IFNULL(
								SUM(S_OP.PRODUCT_QTY),0
							)
						FROM
							dev.ORDER_PRODUCT S_OP
						WHERE
							S_OP.ORDER_STATUS IN ('PCP','PPR','DPR','DPG','DCP') AND
							S_OP.PRODUCT_IDX = PR.IDX
					) = ".$sold_out_status."
				)";
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
					$tmp_price .= " PR.".$price_type[$i]." >= ".$price_min[$i]." ";
				}
				
				if ($price_min[$i] == null && $price_max[$i] != null) {
					$tmp_price .= " PR.".$price_type[$i]." <= ".$price_max[$i]." ";
				}
				
				if($price_min[$i] != null && $price_max[$i] != null) {
					$tmp_price .= " PR.".$price_type[$i]." BETWEEN ".$price_min[$i]." AND ".$price_max[$i]." ";
				}
			}
			
			$tmp_where .= $tmp_price;
		}
		$where .= $tmp_where;
		
		$where .= " )";
	}
}

$where = $where_cnt.$where;

/** 정렬 조건 **/
$order = '';
if ($sort_value != null && $sort_type != null) {
	$order = ' PR.'.$sort_value." ".$sort_type." ";
} else {
	$order = ' PR.IDX DESC';
}

$limit_start = (intval($page)-1)*$rows;
$json_result = array(
	'total' => $db->count("dev.SHOP_PRODUCT PR",$where),
	'total_cnt' => $db->count("dev.SHOP_PRODUCT PR",$where_cnt),
	'page' => $page
);

$sql = "SELECT
			PR.IDX				AS PRODUCT_IDX,
			PR.STYLE_CODE		AS STYLE_CODE,
			PR.COLOR_CODE		AS COLOR_CODE,
			PR.PRODUCT_CODE		AS PRODUCT_CODE,
			PR.PRODUCT_TYPE		AS PRODUCT_TYPE,
			PR.PRODUCT_NAME		AS PRODUCT_NAME,
			(
				SELECT
					REPLACE(S_PI.IMG_LOCATION,'/var/www/admin/www','')
				FROM
					dev.PRODUCT_IMG S_PI
				WHERE
					S_PI.PRODUCT_IDX = PR.IDX AND
					S_PI.IMG_TYPE = 'P' AND
					S_PI.IMG_SIZE = 'S'
				ORDER BY
					IDX ASC
				LIMIT
					0,1
			) AS IMG_LOCATION,
			PR.PRICE_KR			AS PRICE_KR,
			PR.DISCOUNT_KR		AS DISCOUNT_KR,
			PR.SALES_PRICE_KR	AS SALES_PRICE_KR,
			PR.PRICE_EN			AS PRICE_EN,
			PR.DISCOUNT_EN		AS DISCOUNT_EN,
			PR.SALES_PRICE_EN	AS SALES_PRICE_EN,
			PR.PRICE_CN			AS PRICE_CN,
			PR.DISCOUNT_CN		AS DISCOUNT_CN,
			PR.SALES_PRICE_CN	AS SALES_PRICE_CN,
			(
				SELECT
					IFNULL(SUM(S_PS.STOCK_QTY),0)
				FROM
					dev.PRODUCT_STOCK S_PS
				WHERE
					S_PS.PRODUCT_IDX = PR.IDX AND
					S_PS.STOCK_DATE <= NOW()
			)	AS STOCK_QTY,
			(
				SELECT
					IFNULL(SUM(S_PS.STOCK_SAFE_QTY),0)
				FROM
					dev.PRODUCT_STOCK S_PS
				WHERE
					S_PS.PRODUCT_IDX = PR.IDX AND
					S_PS.STOCK_DATE <= NOW()
			)	AS SAFE_QTY,
			(
				SELECT
					IFNULL(SUM(S_OP.PRODUCT_QTY),0)
				FROM
					dev.ORDER_PRODUCT S_OP
				WHERE
					S_OP.ORDER_STATUS IN ('PCP','PPR','DPR','DPG','DCP') AND
					S_OP.PRODUCT_IDX = PR.IDX
			)	AS ORDER_QTY,
			PR.UPDATE_DATE		AS UPDATE_DATE
		FROM
			dev.SHOP_PRODUCT PR
		WHERE
			".$where."
		ORDER BY
			".$order;

if ($rows != null && $select_idx_flg == null) {
	$sql .= " LIMIT ".$limit_start.",".$rows;
}

$db->query($sql);
foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'product_idx'		=>$data['PRODUCT_IDX'],
		'style_code'		=>$data['STYLE_CODE'],
		'color_code'		=>$data['COLOR_CODE'],
		'product_code'		=>$data['PRODUCT_CODE'],
		'product_type'		=>$data['PRODUCT_TYPE'],
		'product_name'		=>$data['PRODUCT_NAME'],
		'img_location'		=>$data['IMG_LOCATION'],
		'price_kr'			=>$data['PRICE_KR'],
		'discount_kr'		=>$data['DISCOUNT_KR'],
		'sales_price_kr'	=>$data['SALES_PRICE_KR'],
		'price_en'			=>$data['PRICE_EN'],
		'discount_en'		=>$data['DISCOUNT_EN'],
		'sales_price_en'	=>$data['SALES_PRICE_EN'],
		'price_cn'			=>$data['PRICE_CN'],
		'discount_cn'		=>$data['DISCOUNT_CN'],
		'sales_price_cn'	=>$data['SALES_PRICE_CN'],
		'stock_qty'			=>$data['STOCK_QTY'],
		'order_qty'			=>$data['ORDER_QTY'],
		'safe_qty'			=>$data['SAFE_QTY'],
		'update_date'		=>$data['UPDATE_DATE']
	);
}
?>