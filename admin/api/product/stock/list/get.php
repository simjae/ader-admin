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
$search_type 		= $_POST['search_type'];			//검색분류
$search_keyword 	= $_POST['search_keyword'];			//검색 키워드

$product_type 		= $_POST['product_type'];			//상품 구분

$md_category_node	= $_POST['md_category_node'];
$md_category_depth  = $_POST['md_category_depth'];

$inner_category_idx = $_POST['inner_category_idx'];		//카테고리
$child_search_flg	= $_POST['child_search_flg'];		//하위 분류 포함 검색
$none_category_flg	= $_POST['none_category_flg'];		//분류 미등록 상품 검색

$date_type 			= $_POST['date_type'];				//상품검색일 타입
$search_date 		= $_POST['search_date'];			//일자검색 옵션
$date_from 			= $_POST['date_from'];				//검색시작일
$date_to 			= $_POST['date_to'];				//검색종료일

$stock_type			= $_POST['stock_type'];				//재고타입
$stock_min			= $_POST['stock_min'];				//재고수량 최소값
$stock_max			= $_POST['stock_max'];				//재고수량 최대값

$stock_grade		= $_POST['stock_grade'];			//재고관리 등급

$sold_out_status	= $_POST['sold_out_status'];		//품절상태
$display_status		= $_POST['display_status'];			//진열상태
$sale_status		= $_POST['sale_flg'];				//판매여부

$price_type 		= $_POST['price_type'];				//상품 가격타입
$price_min 			= $_POST['price_min'];				//검색가격 최대값
$price_max 			= $_POST['price_max'];				//검색가격 최소값

$sort_type 			= $_POST['sort_type'];				//정렬 타입
$sort_value 		= $_POST['sort_value'];				//정렬 값

$unclassified 		= $_POST['unclassified'];		//통관 미등록 플래그

$rows = $_POST['rows'];
$page = $_POST['page'];

//검색 유형 - 디폴트
$where = " PS.STOCK_DATE <= NOW() ";
$where_cnt = $where;

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
						$keyword_where .= ' (PS.PRODUCT_NAME LIKE "%'.$search_keyword[$i].'%") ';
						break;
					
					case "code" :
						$keyword_where .= ' (PS.PRODUCT_CODE LIKE "%'.$search_keyword[$i].'%") ';
						break;

					case "category" :
						$keyword_where .= ' (
										PR.CATEGORY_IDX IN (
											SELECT
												S_MC.IDX
											FROM
												MD_CATEGORY S_MC
											WHERE
												S_MC.TITLE LIKE "%'.$search_keyword[$i].'%"
										)
									) ';
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
													IFNULL(OM.CARE_DSN_KR,''),'|',
													IFNULL(OM.CARE_DSN_EN,''),'|',
													IFNULL(OM.CARE_DSN_CN,''),'|',
													
													IFNULL(OM.CARE_TD_KR,''),'|',
													IFNULL(OM.CARE_TD_EN,''),'|',
													IFNULL(OM.CARE_TD_CN,''),'|'
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
						$tmp_where .= ' (PS.CREATER LIKE "%'.$search_keyword[$i].'%") ';
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
} else if($md_category_depth != null){
	if($md_category_node == null){
		$md_category_node = -1;
	}
	$where .= " AND (PR.MD_CATEGORY_".$md_category_depth." = ".$md_category_node." ) ";
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
//검색 유형 - 상품 등록일
if ($search_date != null && $search_date != 'all') {
	$tmp_date = "DATE_FORMAT(PS.".$date_type.",'%Y-%m-%d')";
	
	switch ($search_date) {
		case "today" :
			$where .= ' AND ('.$tmp_date.' = CURDATE()) ';
			break;
		
		case "01d" :
			$where .= ' AND ('.$tmp_date.' >= (CURDATE() - INTERVAL 1 DAY)) ';
			break;
		
		case "03d" :
			$where .= ' AND ('.$tmp_date.' >= (CURDATE() - INTERVAL 3 DAY)) ';
			break;
		
		case "07d" :
			$where .= ' AND ('.$tmp_date.' >= (CURDATE() - INTERVAL 7 DAY)) ';
			break;
		
		case "15d" :
			$where .= ' AND ('.$tmp_date.' >= (CURDATE() - INTERVAL 15 DAY)) ';
			break;
		
		case "01m" :
			$where .= ' AND ('.$tmp_date.' >= (CURDATE() - INTERVAL 1 MONTH)) ';
			break;
		
		case "03m" :
			$where .= ' AND ('.$tmp_date.' >= (CURDATE() - INTERVAL 3 MONTH)) ';
			break;
		
		case "01y" :
			$where .= ' AND ('.$tmp_date.' >= (CURDATE() - INTERVAL 1 YEAR)) ';
			break;
	}
}
if ($date_from != null && $date_to != null) {
	$where .= " AND (PS.".$date_type." BETWEEN '".$date_from."' AND '".$date_to."') ";
}

//검색 유형 - 통관정보 등록 유무
if($unclassified == 'TRUE'){
	$where .= " AND (
					PR.CLEARANCE_IDX IS NULL OR
					PR.CLEARANCE_IDX = 0
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
									SUM(PS.STOCK_QTY),0
								)
							FROM
								PRODUCT_STOCK PS
							WHERE
								 PS.STOCK_DATE <= NOW() AND
								 PS.PRODUCT_IDX = PR.IDX
						) - (
							SELECT
								IFNULL(
									SUM(S_OP.PRODUCT_QTY),0
								)
							FROM
								ORDER_PRODUCT S_OP
							WHERE
								S_OP.PRODUCT_IDX = PR.IDX AND
								S_OP.ORDER_STATUS IN ('PCP','PPR','DPR','DPG','DCP')
						)	";
	} else if ($stock_type == "safe") {
		$stock_sql  = " (
							SELECT
								IFNULL(
									SUM(STOCK_SAFE_QTY),0
								)
							FROM
								PRODUCT_STOCK S_PS
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
if ($sold_out_status != "all" && $sold_out_status != null) {
	$where .= "
		AND (
			(
				SELECT
					IFNULL(
						SUM(S_PS.STOCK_QTY),
						0
					)
				FROM
					PRODUCT_STOCK S_PS
				WHERE
					 S_PS.STOCK_DATE <= NOW() AND
					 S_PS.PRODUCT_IDX = PR.IDX
			) > (
				SELECT
					IFNULL(
						SUM(PRODUCT_QTY),0
					)
				FROM
					ORDER_PRODUCT S_OP
				WHERE
					S_OP.ORDER_STATUS IN ('PCP','PPR','DPR','DPG','DCP') AND
					S_OP.PRODUCT_IDX = PR.IDX AND
					S_OP.OPTION_IDX = PS.OPTION_IDX
			) = ".$sold_out_status."
		)
	";
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
							PRODUCT_GRID S_PG
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
	$order = ' PS.'.$sort_value." ".$sort_type." ";
} else {
	$order = ' PR.IDX DESC';
}

$limit_start = (intval($page)-1)*$rows;
$limit = "";
if ($rows != null) {
	$limit = " ".$limit_start.",".$rows." ";
}

$total = 0;
$total_cnt = 0;

$select_total_sql = "
	SELECT
		COUNT(
			DISTINCT PS.OPTION_IDX
		)		AS CNT
	FROM
		PRODUCT_STOCK PS
		LEFT JOIN SHOP_PRODUCT PR ON
		PS.PRODUCT_IDX = PR.IDX
		LEFT JOIN ORDERSHEET_MST OM ON
		PR.ORDERSHEET_IDX = OM.IDX
		LEFT JOIN ORDERSHEET_OPTION OO ON
		OM.IDX = OO.ORDERSHEET_IDX
	WHERE
		
";

$db->query($select_total_sql.$where);

foreach($db->fetch() as $data) {
	$total = $data['CNT'];
}

$db->query($select_total_sql.$where_cnt);

foreach($db->fetch() as $data) {
	$total_cnt = $data['CNT'];
}

$json_result = array(
	'total_cnt' =>$total_cnt,
	'total' =>$total,
	'page' =>$page
);

$sql = "SELECT
			PS.PRODUCT_IDX			AS PRODUCT_IDX,
			PS.PRODUCT_CODE			AS PRODUCT_CODE,
			(
				SELECT
					REPLACE(S_PI.IMG_LOCATION,'/var/www/admin/www','')
				FROM
					PRODUCT_IMG S_PI
				WHERE
					S_PI.DEL_FLG = FALSE AND
					S_PI.PRODUCT_IDX = PS.PRODUCT_IDX AND
					S_PI.IMG_TYPE = 'P' AND
					S_PI.IMG_SIZE = 'S'
				ORDER BY
					S_PI.IDX ASC
				LIMIT
					0,1
			)						AS IMG_LOCATION,
			PS.PRODUCT_NAME			AS PRODUCT_NAME,
			PS.OPTION_IDX			AS OPTION_IDX,
			PS.BARCODE				AS BARCODE,
			PS.OPTION_NAME			AS OPTION_NAME,
			IFNULL(
				SUM(PS.STOCK_QTY),0
			)						AS STOCK_QTY,
			(
				SELECT
					IFNULL(
						SUM(PRODUCT_QTY),0
					)
				FROM
					ORDER_PRODUCT S_OP
				WHERE
					S_OP.PRODUCT_IDX = PS.PRODUCT_IDX AND
					S_OP.OPTION_IDX = PS.OPTION_IDX AND
					S_OP.ORDER_STATUS IN ('PCP','PPR','DPR','DPG','DCP')
			)						AS ORDER_QTY,
			IFNULL(
				SUM(PS.STOCK_SAFE_QTY),0
			)						AS STOCK_SAFE_QTY,
			CASE
				WHEN (
					SELECT
						COUNT(S_PG.IDX)
					FROM
						PRODUCT_GRID S_PG
					WHERE
						S_PG.PRODUCT_IDX = PS.PRODUCT_IDX
				) > 0
					THEN
						TRUE
				ELSE
						FALSE
			END						AS DISPLAY_FLG,
			PR.SALE_FLG
		FROM
			PRODUCT_STOCK PS
			LEFT JOIN SHOP_PRODUCT PR ON
			PS.PRODUCT_IDX = PR.IDX
			LEFT JOIN ORDERSHEET_MST OM ON
			PR.ORDERSHEET_IDX = OM.IDX
			LEFT JOIN ORDERSHEET_OPTION OO ON
			OM.IDX = OO.ORDERSHEET_IDX AND
			PS.OPTION_IDX = OO.IDX
		WHERE
			".$where."
		GROUP BY
			PS.OPTION_IDX
		ORDER BY
			PS.PRODUCT_CODE,
			PS.OPTION_NAME,
			PS.STOCK_DATE
			DESC
		LIMIT
			".$limit;

$db->query($sql);
foreach($db->fetch() as $data) {
	$json_result['data'][] = array(
		'sql'				=>$sql,
		'num'				=>$total_cnt--,
		'product_idx'		=>$data['PRODUCT_IDX'],
		'product_code'		=>$data['PRODUCT_CODE'],
		'product_name'		=>$data['PRODUCT_NAME'],
		'img_location'		=>$data['IMG_LOCATION'],
		'option_idx'		=>$data['OPTION_IDX'],
		'barcode'			=>$data['BARCODE'],
		'option_name'		=>$data['OPTION_NAME'],
		'stock_qty'			=>$data['STOCK_QTY'],
		'order_qty'			=>$data['ORDER_QTY'],
		'stock_safe_qty'	=>$data['STOCK_SAFE_QTY'],
		'display_flg'		=>$data['DISPLAY_FLG'],
		'sale_flg'			=>$data['SALE_FLG'],
	);
}
?>