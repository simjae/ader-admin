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

$stock_type			= $_POST['stock_type'];				//재고타입
$stock_min			= $_POST['stock_min'];				//재고수량 최소값
$stock_max			= $_POST['stock_max'];				//재고수량 최대값
$sold_out_status	= $_POST['sold_out_status'];		//품절상태
$display_status		= $_POST['display_status'];			//진열상태
$sale_status		= $_POST['sale_status'];			//판매여부

$rows = $_POST['rows'];
$page = $_POST['page'];

//검색 유형 - 디폴트
$where = " PS.STOCK_DATE <= NOW() ";

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
												dev.MD_CATEGORY S_MC
											WHERE
												S_MC.TITLE LIKE "%'.$search_keyword[$i].'%"
										)
									) ';
						break;

					case "size" :
						$keyword_where .= " (
												CONCAT(
													IFNULL(OM.SIZE__A1_KR,''),'|',
													IFNULL(OM.SIZE__A2_KR,''),'|',
													IFNULL(OM.SIZE__A3_KR,''),'|',
													IFNULL(OM.SIZE__A4_KR,''),'|',
													IFNULL(OM.SIZE__A5_KR,''),'|',
													IFNULL(OM.SIZE__ONESIZE_KR,''),'|',
													IFNULL(OM.SIZE__A1_EN,''),'|',
													IFNULL(OM.SIZE__A2_EN,''),'|',
													IFNULL(OM.SIZE__A3_EN,''),'|',
													IFNULL(OM.SIZE__A4_EN,''),'|',
													IFNULL(OM.SIZE__A5_EN,''),'|',
													IFNULL(OM.SIZE__ONESIZE_EN,''),'|',
													IFNULL(OM.SIZE__A1_CN,''),'|',
													IFNULL(OM.SIZE__A2_CN,''),'|',
													IFNULL(OM.SIZE__A3_CN,''),'|',
													IFNULL(OM.SIZE__A4_CN,''),'|',
													IFNULL(OM.SIZE__A5_CN,''),'|',
													IFNULL(OM.SIZE__ONESIZE_CN,'')
												) REGEXP '".$search_keyword[$i]."'
											) ";
						break;

					case "material" :
						$keyword_where .= " (
												CONCAT(
													IFNULL(PR.MATERIAL_KR,''),'|',
													IFNULL(PR.MATERIAL_EN,''),'|',
													IFNULL(PR.MATERIAL_CN,''),'|'
												) REGEXP '".$search_keyword[$i]."'
												
											) ";
						break;

					case "care" :
						$keyword_where .= " (
												CONCAT(
													IFNULL(PR.CARE_KR,''),'|',
													IFNULL(PR.CARE_EN,''),'|',
													IFNULL(PR.CARE_CN,''),'|'
												) REGEXP '".$search_keyword[$i]."'
											) ";

						break;

					case "detail" :
						$keyword_where .= " (
												CONCAT(
													IFNULL(PR.DETAIL_KR,''),'|',
													IFNULL(PR.DETAIL_EN,''),'|',
													IFNULL(PR.DETAIL_CN,''),'|'
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
if ($search_date != null) {
	switch ($search_date) {
		case "today" :
			$where .= ' AND (PS.'.$date_type.' = CURDATE()) ';
			break;
		case "3d" :
			$where .= ' AND (PS.'.$date_type.' = (CURDATE() - INTERVAL 3 DAY)) ';
			break;
		case "1w" :
			$where .= ' AND (PS.'.$date_type.' >= (CURDATE() - INTERVAL 7 DAY)) ';
			break;
		case "1m" :
			$where .= ' AND (PS.'.$date_type.' >= (CURDATE() - INTERVAL 1 MONTH)) ';
			break;
		case "3m" :
			$where .= ' AND (PS.'.$date_type.' >= (CURDATE() - INTERVAL 3 MONTH)) ';
			break;
		case "1y" :
			$where .= ' AND (PS.'.$date_type.' >= (CURDATE() - INTERVAL 1 YEAR)) ';
			break;
	}
}
if ($date_from != null && $date_to != null) {
	$where .= " AND (PS.".$date_type." BETWEEN '".$date_from."' AND '".$date_to."') ";
}

//검색 유형 - 번역 유무
if($translate == 'F'){
	$where .= " AND (
					OM.DETAIL_EN IS NULL AND
					OM.DETAIL_CN IS NULL
				) ";
}

else if($translate == 'T'){
	$where .= " AND (
					OM.DETAIL_EN IS NOT NULL 
					OR OM.DETAIL_CN IS NOT NULL
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
								S_OP.PRODUCT_IDX = PS.PRODUCT_IDX AND
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
						PS.STOCK_QTY > (
							SELECT
								IFNULL(
									SUM(S_OP.PRODUCT_QTY),0
								)
							FROM
								dev.ORDER_INFO S_OI
								LEFT JOIN dev.ORDER_PRODUCT S_OP ON
								S_OI.IDX = S_OP.ORDER_IDX
							WHERE
								S_OI.ORDER_STATUS IN ('PCP','PPR','DPR','DPG','DCP') AND
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
							S_PG.PRODUCT_IDX = PS.PRODUCT_IDX
					) ".$display_sql."
				) ";
}

//검색 유형 - 판매여부
if ($sale_status != null && $sale_status != "all") {
	$where .= " AND (PR.SALE_FLG = ".$sale_status.") ";
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

$cnt = 0;
$cnt_sql = "SELECT
				COUNT(DISTINCT PS.OPTION_IDX) AS CNT
			FROM
				dev.PRODUCT_STOCK PS
				LEFT JOIN dev.SHOP_PRODUCT PR ON
				PS.PRODUCT_IDX = PR.IDX
				LEFT JOIN dev.ORDERSHEET_MST OM ON
				PR.ORDERSHEET_IDX = OM.IDX
				LEFT JOIN dev.ORDERSHEET_OPTION OO ON
				OM.IDX = OO.ORDERSHEET_IDX
			WHERE
				".$where;

$db->query($cnt_sql);

foreach($db->fetch() as $data) {
	$cnt = $data['CNT'];
}

$json_result = array(
	'total_cnt' => $db->count("dev.PRODUCT_STOCK PS","STOCK_DATE <= NOW()"),
	'total' => $cnt,
	'page' => $page
);

$sql = "SELECT
			PS.PRODUCT_IDX			AS PRODUCT_IDX,
			PS.PRODUCT_CODE			AS PRODUCT_CODE,
			(
				SELECT
					REPLACE(S_PI.IMG_LOCATION,'/var/www/admin/www','')
				FROM
					dev.PRODUCT_IMG S_PI
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
					dev.ORDER_PRODUCT S_OP
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
			dev.PRODUCT_STOCK PS
			LEFT JOIN dev.SHOP_PRODUCT PR ON
			PS.PRODUCT_IDX = PR.IDX
			LEFT JOIN dev.ORDERSHEET_MST OM ON
			PR.ORDERSHEET_IDX = OM.IDX
			LEFT JOIN dev.ORDERSHEET_OPTION OO ON
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