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

$stock_type			= $_POST['stock_type'];				//재고타입
$stock_min			= $_POST['stock_min'];				//재고수량 최소값
$stock_max			= $_POST['stock_max'];				//재고수량 최대값
$stock_grade		= $_POST['stock_grade'];			//재고 등급
$sold_out_flg		= $_POST['sold_out_flg'];			//품절사용
$sold_out_status	= $_POST['sold_out_status'];		//품절상태
$display_status		= $_POST['display_status'];			//진열상태
$sale_flg			= $_POST['sale_flg'];				//판매여부

$rows = $_POST['rows'];
$page = $_POST['page'];

$sort_value = $_POST['sort_value'];
$sort_type = $_POST['sort_type'];

/** 검색 조건 **/
$where = '1=1';
$cnt_where = "";
if ($tab_num != null) {
	if ($tab_num == "01") {
		$where .= ' AND (PR.DEL_FLG = TRUE) ';
	} else {
		$where .= ' AND (PR.INDP_FLG = TRUE) ';
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
						$keyword_where .= ' (PR.PRODUCT_NAME LIKE "%'.$search_keyword[$i].'%") ';
						break;
					
					case "code" :
						$keyword_where .= ' (PR.PRODUCT_CODE LIKE "%'.$search_keyword[$i].'%") ';
						break;

					case "category" :
						$keyword_where .= ' (
										PR.CATEGORY_IDX IN (
											SELECT
												S_MC.IDX
											FROM
												dev.MD_CATEGORY S_MC
											WHERE
												S_MC.TITLE LIKE "%'.$search_keyword[$i].'%"
										)
									) ';
						break;

					case "size" :
						$keyword_where .= " (
							CONCAT(
								IFNULL(OM.SIZE_A1_KR,''),'|',
								IFNULL(OM.SIZE_A2_KR,''),'|',
								IFNULL(OM.SIZE_A3_KR,''),'|',
								IFNULL(OM.SIZE_A4_KR,''),'|',
								IFNULL(OM.SIZE_A5_KR,''),'|',
								IFNULL(OM.SIZE_ONESIZE_KR,''),'|',
								IFNULL(OM.SIZE_A1_EN,''),'|',
								IFNULL(OM.SIZE_A2_EN,''),'|',
								IFNULL(OM.SIZE_A3_EN,''),'|',
								IFNULL(OM.SIZE_A4_EN,''),'|',
								IFNULL(OM.SIZE_A5_EN,''),'|',
								IFNULL(OM.SIZE_ONESIZE_EN,''),'|',
								IFNULL(OM.SIZE_A1_CN,''),'|',
								IFNULL(OM.SIZE_A2_CN,''),'|',
								IFNULL(OM.SIZE_A3_CN,''),'|',
								IFNULL(OM.SIZE_A4_CN,''),'|',
								IFNULL(OM.SIZE_A5_CN,''),'|',
								IFNULL(OM.SIZE_ONESIZE_CN,'')
							) REGEXP '".$search_keyword[$i]."'
						) ";
						break;

					case "material" :
						$keyword_where .= " (
										CONCAT(
											IFNULL(OM.MATERIAL_KR,''),'|',
											IFNULL(OM.MATERIAL_EN,''),'|',
											IFNULL(OM.MATERIAL_CN,''),'|'
										) REGEXP '".$search_keyword[$i]."'
										
									) ";
						break;

					case "care" :
						$keyword_where .= " (
										CONCAT(
											IFNULL(OM.CARE_KR,''),'|',
											IFNULL(OM.CARE_EN,''),'|',
											IFNULL(OM.CARE_CN,''),'|'
										) REGEXP '".$search_keyword[$i]."'
									) ";

						break;

					case "detail" :
						$keyword_where .= " (
										CONCAT(
											IFNULL(OM.DETAIL_KR,''),'|',
											IFNULL(OM.DETAIL_EN,''),'|',
											IFNULL(OM.DETAIL_CN,''),'|'
										) REGEXP '".$search_keyword[$i]."'
									) ";
						break;
					
					case "tag" :
						$keyword_where .= " (PR.PRODUCT_TAG REGEXP '".$search_keyword[$i]."') ";
						break;
					
					case "creater" :
						$tmp_where .= ' (PR.CREATER LIKE "%'.$search_keyword[$i].'%") ';
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
		
		$where .= " (PR.MD_CATEGORY_".$length." = ".$idx_array[intval($length) - 1].") ";
		if ($child_search_flg != true) {
			if ($length < 6) {
				$where .= " AND (PR.MD_CATEGORY_".(intval($length) + 1)." = 0) ";
			}
		}
		
		if ($none_category_flg != null) {
			$where .= " OR (PR.CATEGORY_IDX = 0) ";
		}
		
		$where .= " ) ";
	} else {
		if ($none_category_flg == true) {
			$where .= " AND (PR.CATEGORY_IDX = 0) ";
		}
	}
}

if ($search_date != null) {
	switch ($search_date) {
		case "today" :
			$where .= ' AND (PR.'.$date_type.' = CURDATE()) ';
			break;
		
		case "01d" :
			$where .= ' AND (PR.'.$date_type.' = (CURDATE() - INTERVAL 1 DAY)) ';
			break;
		
		case "03d" :
			$where .= ' AND (PR.'.$date_type.' >= (CURDATE() - INTERVAL 3 DAY)) ';
			break;
		
		case "07d" :
			$where .= ' AND (PR.'.$date_type.' >= (CURDATE() - INTERVAL 7 DAY)) ';
			break;
		
		case "15d" :
			$where .= ' AND (PR.'.$date_type.' >= (CURDATE() - INTERVAL 15 DAY)) ';
			break;
		
		case "01m" :
			$where .= ' AND (PR.'.$date_type.' >= (CURDATE() - INTERVAL 1 MONTH)) ';
			break;
		
		case "03m" :
			$where .= ' AND (PR.'.$date_type.' >= (CURDATE() - INTERVAL 3 MONTH)) ';
			break;
		
		case "01y" :
			$where .= ' AND (PR.'.$date_type.' >= (CURDATE() - INTERVAL 1 YEAR)) ';
			break;
	}
}

if ($create_from != null && $create_to != null) {
	$where .= " AND (PR.".$date_type." BETWEEN '".$create_from."' AND '".$create_to."') ";
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
					$tmp_price .= " PR.".$price_type[$i]." >= ".$price_min[$i]." ";
				}
				
				if(!is_numeric($price_min[$i]) && is_numeric($price_max[$i])) {
					$tmp_price .= " PR.".$price_type[$i]." <= ".$price_max[$i]." ";
				}
				
				if (is_numeric($price_min[$i]) && is_numeric($price_max[$i])) {
					$tmp_price .= " PR.".$price_type[$i]." BETWEEN ".$price_min[$i]." AND ".$price_max[$i]." ";
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
		$where .= " AND (PR.DETAIL_EN IS NOT NULL OR PR.DETAIL_CN IS NOT NULL) ";
	} else {
		$where .= " AND (PR.DETAIL_EN IS NULL AND PR.DETAIL_CN IS NULL) ";
	}
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
								dev.PRODUCT_STOCK S_PS
							WHERE
								 S_PS.STOCK_DATE <= NOW() AND
								 S_PS.PRODUCT_IDX = PR.IDX
						) - (
							SELECT
								IFNULL(
									SUM(S_OP.PRODUCT_QTY),0
								)
							FROM
								dev.ORDER_INFO S_OI
								LEFT JOIN dev.ORDER_PRODUCT S_OP ON
								S_OI.IDX = S_OP.ORDER_INFO_IDX
							WHERE
								S_OI.ORDER_STATUS IN ('DPG','DCP') AND
								S_OP.PRODUCT_IDX = PR.IDX
						) ";
	} else if ($stock_type == "safe") {
		$stock_sql = " (
							SELECT
								IFNULL(
									SUM(S_PS.STOCK_SAFE_QTY),0
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

//검색 유형 - 재고관리 등급
if ($stock_grade != null && $stock_grade != "all") {
	$where .= " AND (
						(
							SELECT
								COUNT(S_OO.IDX)
							FROM
								dev.ORDERSHEET_OPTION S_OO
							WHERE
								S_OO.PRODUCT_IDX = PR.PRODUCT_IDX AND
								S_OO.STOCK_GRADE = '".$stock_grade."'
						) > 0
				) ";
}

//검색 유형 - 품절상태
if ($sold_out_status != null && $sold_out_status != "all") {
	$where .= " AND (
						(
							SELECT
								IFNULL(
									SUM(S_PS.STOCK_QTY),0
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
								dev.ORDER_INFO S_OI
								LEFT JOIN dev.ORDER_PRODUCT S_OP ON
								S_OI.IDX = S_OP.ORDER_INFO_IDX
							WHERE
								S_OI.ORDER_STATUS IN ('DPG','DCP') AND
								S_OP.PRODUCT_IDX = PR.IDX
						) = ".$sold_out_status."
				) ";
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
							COUNT(S_PG.IDX)
						FROM
							dev.PRODUCT_GRID S_PG
						WHERE
							S_PG.PRODUCT_IDX = PR.IDX
					) ".$display_sql."
				) ";
}

//검색 유형 - 판매여부
if ($sale_flg != null && $sale_flg != "all") {
	$where .= " AND (PR.SALE_FLG = ".$sale_flg.") ";
}

/** 정렬 조건 **/
$order = '';
if ($sort_value != null && $sort_type != null) {
	$order = ' PR.'.$sort_value." ".$sort_type." ";
} else {
	$order = ' PR.IDX DESC ';
}

/** DB 처리 **/

$json_result = array(
	'total' => $db->count("dev.SHOP_PRODUCT PR",$where),
	'total_cnt' => $db->count("dev.SHOP_PRODUCT PR",$cnt_where),
	'page' => intval($page)
);

$limit_start = (intval($page)-1)*$rows;

$sql = "SELECT
			PR.IDX				AS PRODUCT_IDX,
			PR.PRODUCT_TYPE		AS PRODUCT_TYPE,
			PR.STYLE_CODE		AS STYLE_CODE,
			PR.COLOR_CODE		AS COLOR_CODE,
			PR.PRODUCT_CODE		AS PRODUCT_CODE,
			PR.PRODUCT_NAME		AS PRODUCT_NAME,
			CASE
				WHEN
					(
						SELECT
							COUNT(S_PI.IDX)
						FROM
							dev.PRODUCT_IMG S_PI
						WHERE
							S_PI.PRODUCT_IDX = PR.IDX AND
							S_PI.IMG_TYPE = 'P' AND
							S_PI.IMG_SIZE = 'S'
					) > 0
					THEN
						(
							SELECT
								REPLACE(S_PI.IMG_LOCATION,'/var/www/admin/www','')
							FROM
								dev.PRODUCT_IMG S_PI
							WHERE
								S_PI.PRODUCT_IDX = PR.IDX AND
								S_PI.DEL_FLG = FALSE AND
								S_PI.IMG_SIZE = 'S' AND
								S_PI.IMG_TYPE = 'P'
							ORDER BY
								S_PI.IDX ASC
							LIMIT
								0,1
						)
				ELSE
					'/images/default_product_img.jpg'
			END					AS IMG_LOCATION,
			PR.PRICE_KR			AS PRICE_KR,
			PR.PRICE_EN			AS PRICE_EN,
			PR.PRICE_CN			AS PRICE_CN,
			PR.DISCOUNT_KR		AS DISCOUNT_KR,
			PR.DISCOUNT_EN		AS DISCOUNT_EN,
			PR.DISCOUNT_CN		AS DISCOUNT_CN,
			PR.SALES_PRICE_KR	AS SALES_PRICE_KR,
			PR.SALES_PRICE_EN	AS SALES_PRICE_EN,
			PR.SALES_PRICE_CN	AS SALES_PRICE_CN,
			PR.UPDATE_DATE		AS UPDATE_DATE
		FROM
			dev.SHOP_PRODUCT PR
			LEFT JOIN dev.ORDERSHEET_MST OM ON
			PR.ORDERSHEET_IDX = OM.IDX
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
		'length'			=>$length,
		'num'				=>$total_cnt--,
		'no'				=>intval($data['PRODUCT_IDX']),
		'product_type'		=>$data['PRODUCT_TYPE'],
		'style_code'		=>$data['STYLE_CODE'],
		'color_code'		=>$data['COLOR_CODE'],
		'product_code'		=>$data['PRODUCT_CODE'],
		'product_name'		=>$data['PRODUCT_NAME'],
		'img_location'		=>$data['IMG_LOCATION'],
		'price_kr'			=>$data['PRICE_KR'],
		'price_en'			=>$data['PRICE_EN'],
		'price_cn'			=>$data['PRICE_CN'],
		'sales_price_kr'	=>$data['SALES_PRICE_KR'],
		'sales_price_en'	=>$data['SALES_PRICE_EN'],
		'sales_price_cn'	=>$data['SALES_PRICE_CN'],
		'update_date'		=>$data['UPDATE_DATE']
	);
}
?>