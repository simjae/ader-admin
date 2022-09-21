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
$total_flg			= $_POST['total_flg'];				//전체 검색용 플래그
$product_code		= $_POST['product_code'];			//전체 검색용 상품코드
$option_code		= $_POST['option_code'];			//전체 검색용 옵션코드
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

$rows = $_POST['rows'];
$page = $_POST['page'];

$tables = " dev.PRODUCT_STOCK STOCK
			LEFT JOIN dev.SHOP_PRODUCT PRODUCT ON
			STOCK.PRODUCT_CODE = PRODUCT.PRODUCT_CODE ";

//검색 유형 - 디폴트
$where = " 1=1 ";
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
											PRODUCT.SIZE ,"|",
											PRODUCT.SIZE_DETAIL_A1_KR,"|",
											PRODUCT.SIZE_DETAIL_A2_KR,"|",
											PRODUCT.SIZE_DETAIL_A3_KR,"|",
											PRODUCT.SIZE_DETAIL_A4_KR,"|",
											PRODUCT.SIZE_DETAIL_A5_KR,"|",
											PRODUCT.SIZE_DETAIL_ONESIZE_KR,"|",
											PRODUCT.SIZE_DETAIL_A1_EN,"|",
											PRODUCT.SIZE_DETAIL_A2_EN,"|",
											PRODUCT.SIZE_DETAIL_A3_EN,"|",
											PRODUCT.SIZE_DETAIL_A4_EN,"|",
											PRODUCT.SIZE_DETAIL_A5_EN,"|",
											PRODUCT.SIZE_DETAIL_ONESIZE_EN,"|",
											PRODUCT.SIZE_DETAIL_A1_CN,"|",
											PRODUCT.SIZE_DETAIL_A2_CN,"|",
											PRODUCT.SIZE_DETAIL_A3_CN,"|",
											PRODUCT.SIZE_DETAIL_A4_CN,"|",
											PRODUCT.SIZE_DETAIL_A5_CN,"|",
											PRODUCT.SIZE_DETAIL_ONESIZE_CN
										) REGEXP '".$search_keyword[$i]."'
									) ";
						break;

					case "material" :
						$keyword_where .= " (
										CONCAT(
											PRODUCT.MATERIAL_KR,'|',
											PRODUCT.MATERIAL_EN,'|',
											PRODUCT.MATERIAL_CN,'|'
										) REGEXP '".$search_keyword[$i]."'
										
									) ";
						break;

					case "care" :
						$keyword_where .= " (
										CONCAT(
											PRODUCT.CARE_KR,'|',
											PRODUCT.CARE_EN,'|',
											PRODUCT.CARE_CN,'|'
										) REGEXP '".$search_keyword[$i]."'
									) ";

						break;

					case "detail" :
						$keyword_where .= " (
										CONCAT(
											PRODUCT.DETAIL_KR,'|',
											PRODUCT.DETAIL_EN,'|',
											PRODUCT.DETAIL_CN,'|'
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

$sql = "";
if ($total_flg != null) {
	$select_sql = "";
	$where_sql = "";
	$group_sql = "";
	if ($product_code != null) {
		$select_sql = " PRODUCT_CODE, PRODUCT_NAME, OPTION_CODE, OPTION_NAME, ";
		$where_sql = "PRODUCT_CODE = '".$product_code."'";
		$group_sql = " GROUP BY OPTION_CODE ";
	}
	
	if ($option_code != null) {
		$select_sql = " PRODUCT_CODE, PRODUCT_NAME, OPTION_CODE, OPTION_NAME, ";
		$where_sql = "OPTION_CODE = '".$option_code."'";
		$group_sql = " GROUP BY OPTION_CODE ";
	}
	
	$sql = "SELECT
				".$select_sql."
				SUM(STOCK_QUANTITY) AS STOCK_QTY,
				SUM(STOCK_SAFE_QUANTITY) AS SAFE_QTY,
				SUM(TOTAL_SALES_CNT) AS TOTAL_SALES_CNT
			FROM
				dev.PRODUCT_STOCK
			WHERE
				".$where_sql."
			".$group_sql;	
} else {
	$sql = "SELECT
				STOCK.IDX,
				STOCK.PRODUCT_CODE,
				STOCK.PRODUCT_NAME,
				STOCK.OPTION_CODE,
				STOCK.OPTION_NAME,
				STOCK.STOCK_QUANTITY AS STOCK_QTY,
				STOCK.STOCK_SAFE_QUANTITY AS SAFE_QTY,
				STOCK.TOTAL_SALES_CNT,
				DATE_FORMAT(STOCK.STOCK_DATE, '%Y-%m-%d %H:%i') AS STOCK_DATE,
				CASE
					WHEN STOCK_DATE <= NOW()
						THEN TRUE
						ELSE FALSE
				END AS STOCK_APPL_FLG,
				DATE_FORMAT(STOCK.CREATE_DATE,'%Y-%m-%d %H:%i') AS CREATE_DATE,
				STOCK.CREATER
			FROM
				dev.PRODUCT_STOCK STOCK
				LEFT JOIN dev.SHOP_PRODUCT PRODUCT ON
				STOCK.PRODUCT_CODE = PRODUCT.PRODUCT_CODE
			WHERE
				".$where."
			ORDER BY
				STOCK.STOCK_DATE DESC
			LIMIT
				".$limit;
}

$json_result = array(
	'total' => $db->count($tables,$where),
	'total_cnt' => $db->count($tables,$where_cnt),
	'page' => $page
);

$db->query($sql);
foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'num'						=>$total_cnt--,
		'no'						=>$data['IDX'],
		'product_code'				=>$data['PRODUCT_CODE'],
		'product_name'				=>$data['PRODUCT_NAME'],
		'option_code'				=>$data['OPTION_CODE'],
		'option_name'				=>$data['OPTION_NAME'],
		'stock_qty'					=>intval($data['STOCK_QTY']),
		'safe_qty'					=>intval($data['SAFE_QTY']),
		'total_sales_cnt'			=>intval($data['TOTAL_SALES_CNT']),
		'stock_date'				=>$data['STOCK_DATE'],
		'stock_appl_flg'			=>$data['STOCK_APPL_FLG'],
		'create_date'				=>$data['CREATE_DATE'],
		'creater'					=>$data['CREATER']
	);
}
?>