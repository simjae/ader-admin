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
$sale_status		= $_POST['sale_status'];			//판매여부

$price_type 		= $_POST['price_type'];				//상품 가격타입
$price_min 			= $_POST['price_min'];				//검색가격 최대값
$price_max 			= $_POST['price_max'];				//검색가격 최소값

$sort_type 			= $_POST['sort_type'];				//정렬 타입
$sort_value 		= $_POST['sort_value'];				//정렬 값

$translate 			= $_POST['translate'];				//번역 상태

$rows = $_POST['rows'];
$page = $_POST['page'];

//검색 유형 - 디폴트
$where = '1=1';
$where .= ' AND (PR.INDP_FLG = FALSE AND PR.DEL_FLG = FALSE) ';

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

//검색 유형 - 상품 등록일
if ($search_date != null) {
	switch ($search_date) {
		case "today" :
			$where .= ' AND (PR.'.$date_type.' = CURDATE()) ';
			break;
		case "3d" :
			$where .= ' AND (PR.'.$date_type.' = (CURDATE() - INTERVAL 3 DAY)) ';
			break;
		case "1w" :
			$where .= ' AND (PR.'.$date_type.' >= (CURDATE() - INTERVAL 7 DAY)) ';
			break;
		case "1m" :
			$where .= ' AND (PR.'.$date_type.' >= (CURDATE() - INTERVAL 1 MONTH)) ';
			break;
		case "3m" :
			$where .= ' AND (PR.'.$date_type.' >= (CURDATE() - INTERVAL 3 MONTH)) ';
			break;
		case "1y" :
			$where .= ' AND (PR.'.$date_type.' >= (CURDATE() - INTERVAL 1 YEAR)) ';
			break;
	}
}

//검색 유형 - 상품 등록/수정일
if ($date_from != null && $date_to != null) {
	$where .= " AND (PR.".$date_type." BETWEEN '".$date_from."' AND '".$date_to."') ";
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
					OM.DETAIL_EN IS NOT null 
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
								SUM(S_PS.STOCK_QUANTITY),
								0
							)
						FROM
							dev.PRODUCT_STOCK S_PS
						WHERE
							 S_PS.STOCK_DATE <= NOW() AND
							 S_PS.PRODUCT_IDX = PR.PRODUCT_IDX
					) > (
						SELECT
							IFNULL(
								SUM(PRODUCT_QTY),0
							)
						FROM
							dev.ORDER_INFO S_OI
							LEFT JOIN dev.ORDER_PRODUCT S_OP ON
							S_OI.IDX = S_OP.ORDER_INFO_IDX
						WHERE
							S_OI.ORDER_STATUS IN ('PCP','PPR','DPR','DPG','DCP') AND
							S_OP.PRODUCT_IDX = PR.IDX
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
	$order = ' '.$sort_value." ".$sort_type." ";
} else {
	$order = ' PRODUCT_IDX DESC';
}

$limit_start = (intval($page)-1)*$rows;

$select = "
	PR.ORDERSHEET_IDX			AS ORDERSHEET_IDX,
	PR.IDX						AS PRODUCT_IDX,
	PR.PRODUCT_TYPE				AS PRODUCT_TYPE,
	PR.STYLE_CODE				AS STYLE_CODE,
	PR.COLOR_CODE				AS COLOR_CODE,
	PR.PRODUCT_CODE				AS PRODUCT_CODE,
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
	END							AS IMG_LOCATION,
	PR.PRODUCT_NAME				AS PRODUCT_NAME,
	PR.PRICE_KR					AS PRICE_KR,
	PR.PRICE_EN					AS PRICE_EN,
	PR.PRICE_CN					AS PRICE_CN,
	PR.DISCOUNT_KR				AS DISCOUNT_KR,
	PR.DISCOUNT_EN				AS DISCOUNT_EN,
	PR.DISCOUNT_CN				AS DISCOUNT_CN,
	PR.SALES_PRICE_KR			AS SALES_PRICE_KR,
	PR.SALES_PRICE_EN			AS SALES_PRICE_EN,
	PR.SALES_PRICE_CN			AS SALES_PRICE_CN,
	PR.CREATER					AS CREATER,
	PR.CREATE_DATE				AS CREATE_DATE,
	PR.UPDATER					AS UPDATER,
	PR.UPDATE_DATE				AS UPDATE_DATE
";

$sql = "";
//검색 유형 - 상품구분
if($product_type != null){
	switch ($product_type) {
		case "B" :
			$sql = "SELECT
						".$select."
					FROM
						dev.SHOP_PRODUCT PR
						LEFT JOIN dev.ORDERSHEET_MST OM ON
						PR.ORDERSHEET_IDX = OM.IDX
					WHERE
						".$where."
						AND (PRODUCT_TYPE = 'B')
					ORDER BY 
						".$order;
			break;
		
		case "S" :
			$sql = "
					SELECT
						DISTINCT *
					FROM
						(
							(
								SELECT
									".$select."
								FROM
									dev.SHOP_PRODUCT PR
									LEFT JOIN dev.ORDERSHEET_MST OM ON
									PR.ORDERSHEET_IDX = OM.IDX
								WHERE
									".$where."
									AND (PR.PRODUCT_TYPE = 'S')
							) UNION (
								SELECT
									".$select."
								FROM
									dev.SHOP_PRODUCT PR
								WHERE
									PR.PRODUCT_TYPE = 'S' AND
									PR.IDX IN (
										SELECT
											DISTINCT SET_PRODUCT_IDX SP
										FROM
											dev.SET_PRODUCT SP
										WHERE
											SP.PRODUCT_IDX IN (
												SELECT
													PR.IDX
												FROM
													dev.SHOP_PRODUCT PR
													LEFT JOIN dev.ORDERSHEET_MST OM ON
													PR.ORDERSHEET_IDX = OM.IDX
												WHERE
													".$where."
													AND (
														PR.IDX IN (
															SELECT
																DISTINCT SP.PRODUCT_IDX
															FROM
																dev.SET_PRODUCT SP
														)
													)
											)
									)
								AND
									PR.DEL_FLG = FALSE							
							)
						) AS TMP
					ORDER BY
						".$order;
			break;
		
		case "ALL" :
			$sql = "SELECT
						*
					FROM
						(
							(
								SELECT
									".$select."
								FROM
									dev.SHOP_PRODUCT PR
								WHERE
									".$where."
									AND (PRODUCT_TYPE = 'B')
								ORDER BY 
									".$order."
							) UNION (
								SELECT
									".$select."
								FROM
									dev.SHOP_PRODUCT PR
								WHERE
									PR.PRODUCT_TYPE = 'S' AND
									PR.IDX IN (
										SELECT
											DISTINCT SET_PRODUCT_IDX SP
										FROM
											dev.SET_PRODUCT SP
										WHERE
											SP.PRODUCT_IDX IN (
												SELECT
													PR.IDX
												FROM
													dev.SHOP_PRODUCT PR
													LEFT JOIN dev.ORDERSHEET_MST OM ON
													PR.ORDERSHEET_IDX = OM.IDX
												WHERE
													".$where."
													AND (
														PR.IDX IN (
															SELECT
																DISTINCT SP.PRODUCT_IDX
															FROM
																dev.SET_PRODUCT SP
														)
													)
											)
									)
								AND
									PR.DEL_FLG = FALSE
								ORDER BY
									PRODUCT_IDX DESC
							)
						) AS TMP
					ORDER BY
						".$order;
			break;
	}
}

$json_result = array(
	'total' => $db->count("(".$sql.") AS TMP"),
	'total_cnt' => $db->count("dev.SHOP_PRODUCT PR",$where_cnt),
	'page' => $page
);

if ($rows != null && $select_idx_flg == null) {
	$sql .= " LIMIT ".$limit_start.",".$rows;
}

$product_cnt = array();
$cnt_sql = "SELECT
				(
					SELECT
						COUNT(IDX)
					FROM
						dev.SHOP_PRODUCT
				) AS PRODUCT_QTY,
				(
					SELECT
						COUNT(IDX)
					FROM
						dev.SHOP_PRODUCT
					WHERE
						SALE_FLG = TRUE
				) AS SALES_QTY,
				(
					SELECT
						COUNT(DISTINCT PG.PRODUCT_IDX)
					FROM
						dev.SHOP_PRODUCT PR
						LEFT JOIN dev.PRODUCT_GRID PG ON
						PR.IDX = PG.PRODUCT_IDX
				) AS DISPLAY_QTY
			FROM
				DUAL";
$db->query($cnt_sql);

$product_cnt = array();
foreach($db->fetch() as $cnt_data) {
	$product_qty = intval($cnt_data['PRODUCT_QTY']);
	$sales_qty = intval($cnt_data['SALES_QTY']);
	$display_qty = intval($cnt_data['DISPLAY_QTY']);
	
	$non_sales_qty = $product_qty - $sales_qty;
	$non_display_qty = $product_qty - $display_qty;
	
	$product_cnt[] = array(
		'product_qty'		=>$product_qty,
		'sales_qty'			=>$sales_qty,
		'non_sales_qty'		=>$non_sales_qty,
		'display_qty'		=>$display_qty,
		'non_display_qty'	=>$non_display_qty
	);
}

$json_result['data'][] = array(
	'product_cnt'	=>$product_cnt
);

//print_r($sql);
$db->query($sql);
foreach($db->fetch() as $data) {
	$product_idx = $data['PRODUCT_IDX'];
	$product_type = $data['PRODUCT_TYPE'];
	
	if ($product_type == "S") {
		$set_sql = "SELECT
						PR.STYLE_CODE				AS STYLE_CODE,
						PR.COLOR_CODE				AS COLOR_CODE,
						PR.PRODUCT_CODE				AS PRODUCT_CODE,
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
						END							AS IMG_LOCATION,
						PR.PRODUCT_NAME				AS PRODUCT_NAME,
						PR.PRICE_KR					AS PRICE_KR,
						PR.PRICE_EN					AS PRICE_EN,
						PR.PRICE_CN					AS PRICE_CN,
						PR.DISCOUNT_KR				AS DISCOUNT_KR,
						PR.DISCOUNT_EN				AS DISCOUNT_EN,
						PR.DISCOUNT_CN				AS DISCOUNT_CN,
						PR.SALES_PRICE_KR			AS SALES_PRICE_KR,
						PR.SALES_PRICE_EN			AS SALES_PRICE_EN,
						PR.SALES_PRICE_CN			AS SALES_PRICE_CN,
						PR.CREATER					AS CREATER,
						PR.CREATE_DATE				AS CREATE_DATE,
						PR.UPDATER					AS UPDATER,
						PR.UPDATE_DATE				AS UPDATE_DATE
					FROM
						dev.SHOP_PRODUCT PR
						LEFT JOIN dev.ORDERSHEET_MST OM ON
						PR.ORDERSHEET_IDX = OM.IDX
					WHERE
						PR.IDX IN (
							SELECT
								S_SP.PRODUCT_IDX
							FROM
								dev.SET_PRODUCT S_SP
							WHERE
								S_SP.SET_PRODUCT_IDX = ".$product_idx."
					)";
		$db->query($set_sql);
		$set_product_info = array();
		foreach($db->fetch() as $set_data) {
			$set_product_info[] = array(
				'style_code'					=>$set_data['STYLE_CODE'],
				'color_code'					=>$set_data['COLOR_CODE'],
				'product_code'					=>$set_data['PRODUCT_CODE'],
				'img_location'					=>$set_data['IMG_LOCATION'],
				'product_name'					=>$set_data['PRODUCT_NAME'],
				'price_kr'						=>$set_data['PRICE_KR'],
				'price_en'						=>$set_data['PRICE_EN'],
				'price_cn'						=>$set_data['PRICE_CN'],
				'discount_kr'					=>$set_data['DISCOUNT_KR'],
				'discount_en'					=>$set_data['DISCOUNT_EN'],
				'discount_cn'					=>$set_data['DISCOUNT_CN'],
				'sales_price_kr'				=>$set_data['SALES_PRICE_KR'],
				'sales_price_en'				=>$set_data['SALES_PRICE_EN'],
				'sales_price_cn'				=>$set_data['SALES_PRICE_CN'],
				'creater'						=>$set_data['CREATER'],
				'create_date'					=>$set_data['CREATE_DATE'],
				'updater'						=>$set_data['UPDATER'],
				'update_date'					=>$set_data['UPDATE_DATE']
			);
		}
	}
	
	$json_result['data'][] = array(
		'num'							=>$total_cnt--,
		'product_idx'					=>$product_idx,
		'product_type'					=>$product_type,
		'ordersheet_idx'				=>$data['ORDERSHEET_IDX'],
		'style_code'					=>$data['STYLE_CODE'],
		'color_code'					=>$data['COLOR_CODE'],
		'product_code'					=>$data['PRODUCT_CODE'],
		'img_location'					=>$data['IMG_LOCATION'],
		'product_name'					=>$data['PRODUCT_NAME'],
		'price_kr'						=>$data['PRICE_KR'],
		'price_en'						=>$data['PRICE_EN'],
		'price_cn'						=>$data['PRICE_CN'],
		'discount_kr'					=>$data['DISCOUNT_KR'],
		'discount_en'					=>$data['DISCOUNT_EN'],
		'discount_cn'					=>$data['DISCOUNT_CN'],
		'sales_price_kr'				=>$data['SALES_PRICE_KR'],
		'sales_price_en'				=>$data['SALES_PRICE_EN'],
		'sales_price_cn'				=>$data['SALES_PRICE_CN'],
		'creater'						=>$data['CREATER'],
		'create_date'					=>$data['CREATE_DATE'],
		'updater'						=>$data['UPDATER'],
		'update_date'					=>$data['UPDATE_DATE'],
		'set_product_info'				=>$set_product_info
	);
}
?>