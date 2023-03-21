<?php
/*
 +=============================================================================
 | 
 | 상품 목록
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

$tab_status			= $_POST['tab_status'];

$search_type 		= $_POST['search_type'];		//검색분류
$search_keyword 	= $_POST['search_keyword'];		//검색 키워드

$product_type 		= $_POST['product_type'];		//상품 구분

$md_category_node	= $_POST['md_category_node'];
$md_category_depth  = $_POST['md_category_depth'];

$inner_category_idx = $_POST['inner_category_idx'];	//카테고리
$child_search_flg	= $_POST['child_search_flg'];	//하위 분류 포함 검색
$none_category_flg	= $_POST['none_category_flg'];	//분류 미등록 상품 검색

$date_type 			= $_POST['date_type'];			//상품검색일 타입
$search_date 		= $_POST['search_date'];		//일자검색 옵션
$date_from 			= $_POST['date_from'];			//검색시작일
$date_to 			= $_POST['date_to'];			//검색종료일

$stock_type			= $_POST['stock_type'];			//재고타입
$stock_min			= $_POST['stock_min'];			//재고수량 최소값
$stock_max			= $_POST['stock_max'];			//재고수량 최대값

$stock_grade		= $_POST['stock_grade'];		//재고관리 등급

$sold_out_status	= $_POST['sold_out_status'];	//품절상태
$display_status		= $_POST['display_status'];		//진열상태
$sale_status		= $_POST['sale_flg'];			//판매여부

$price_type 		= $_POST['price_type'];			//상품 가격타입
$price_min 			= $_POST['price_min'];			//검색가격 최대값
$price_max 			= $_POST['price_max'];			//검색가격 최소값

$sort_type 			= $_POST['sort_type'];			//정렬 타입
$sort_value 		= $_POST['sort_value'];			//정렬 값

$unclassified 		= $_POST['unclassified'];		//통관 미등록 플래그

$idx_flg			= $_POST['idx_flg'];
$select_column		= $_POST['select_column'];

$rows				= $_POST['rows'];
$page				= $_POST['page'];

$table ="
	SHOP_PRODUCT PR
	LEFT JOIN ORDERSHEET_MST OM ON
	PR.ORDERSHEET_IDX = OM.IDX
";

//검색 유형 - 디폴트
$where = "1=1";
if ($tab_status != "" && $tab_status != null) {
	if ($tab_status == "DEL") {
		$where .= " AND (PR.DEL_FLG = TRUE) ";
	} else if ($tab_status == "IND") {
		$where .= " AND (PR.INDP_FLG = TRUE) ";
	}
} else {
	$where .= " AND (PR.INDP_FLG = FALSE AND PR.DEL_FLG = FALSE) ";
}

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
						$keyword_where .= " (PR.PRODUCT_NAME LIKE '%".$search_keyword[$i]."%') ";
						break;
					
					case "code" :
						$keyword_where .= " (PR.PRODUCT_CODE LIKE '%".$search_keyword[$i]."%') ";
						break;

					case "category" :
						$keyword_where .= "
							(
								PR.CATEGORY_IDX IN (
									SELECT
										S_MC.IDX
									FROM
										MD_CATEGORY S_MC
									WHERE
										S_MC.TITLE LIKE '%".$search_keyword[$i]."%'
								)
							)
						";
						break;

					case "material" :
						$keyword_where .= "
							(
								CONCAT(
									IFNULL(OM.MATERIAL_KR,''),'|',
									IFNULL(OM.MATERIAL_EN,''),'|',
									IFNULL(OM.MATERIAL_CN,''),'|'
								) REGEXP '".$search_keyword[$i]."'
							)
						";
						break;

					case "care" :
						$keyword_where .= "
							(
								CONCAT(
									IFNULL(OM.CARE_DSN_KR,''),'|',
									IFNULL(OM.CARE_DSN_EN,''),'|',
									IFNULL(OM.CARE_DSN_CN,''),'|',
									
									IFNULL(OM.CARE_TD_KR,''),'|',
									IFNULL(OM.CARE_TD_EN,''),'|',
									IFNULL(OM.CARE_TD_CN,''),'|'
								) REGEXP '".$search_keyword[$i]."'
							)
						";

						break;

					case "detail" :
						$keyword_where .= "
							(
								CONCAT(
									IFNULL(OM.DETAIL_KR,''),'|',
									IFNULL(OM.DETAIL_EN,''),'|',
									IFNULL(OM.DETAIL_CN,''),'|'
								) REGEXP '".$search_keyword[$i]."'
							)
						";
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
	$tmp_date = "DATE_FORMAT(PR.".$date_type.",'%Y-%m-%d')";
	switch ($search_date) {
		case "today" :
			$where .= " AND (".$tmp_date." = CURDATE()) ";
			break;
		
		case "1d" :
			$where .= " AND (".$tmp_date." >= (CURDATE() - INTERVAL 1 DAY)) ";
			break;
		
		case "3d" :
			$where .= " AND (".$tmp_date." >= (CURDATE() - INTERVAL 3 DAY)) ";
			break;
		
		case "1w" :
			$where .= " AND (".$tmp_date." >= (CURDATE() - INTERVAL 7 DAY)) ";
			break;
		
		case "1m" :
			$where .= " AND (".$tmp_date." >= (CURDATE() - INTERVAL 1 MONTH)) ";
			break;
		
		case "3m" :
			$where .= " AND (".$tmp_date." >= (CURDATE() - INTERVAL 3 MONTH)) ";
			break;
		
		case "1y" :
			$where .= " AND (".$tmp_date." >= (CURDATE() - INTERVAL 1 YEAR)) ";
			break;
	}
}

//검색 유형 - 상품 등록/수정일
if ($date_from != null && $date_to != null) {
	$where .= " AND (PR.".$date_type." BETWEEN '".$date_from."' AND '".$date_to."') ";
}

//검색 유형 - 해외통관 분류 미등록 상품 검색
if($unclassified == 'TRUE'){
	$where .= "
		AND (
			PR.CLEARANCE_IDX = 0
		)
	";
}

//검색 유형 - 재고수량
if($stock_type != null && ($stock_min != null || $stock_max != null)){
	$where .= " AND ( ";
		
	$tmp_where = "";
	
	if ($stock_type == "stock") {
		$stock_sql = " 
			(
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
			)
		";
	} else if ($stock_type == "safe") {
		$stock_sql = "
			(
				SELECT
					IFNULL(
						SUM(STOCK_SAFE_QTY),0
					)
				FROM
					PRODUCT_STOCK S_PS
				WHERE
					S_PS.PRODUCT_IDX = PR.IDX
			)
		";
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
					ORDER_INFO S_OI
					LEFT JOIN ORDER_PRODUCT S_OP ON
					S_OI.IDX = S_OP.ORDER_IDX
				WHERE
					S_OI.ORDER_STATUS IN ('PCP','PPR','DPR','DPG','DCP') AND
					S_OP.PRODUCT_IDX = PR.IDX
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
	
	$where .= "
		AND (
			(
				SELECT
					COUNT(S_PG.IDX)
				FROM
					PRODUCT_GRID S_PG
				WHERE
					S_PG.PRODUCT_IDX = PR.IDX
			) ".$display_sql."
		)
	";
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

$extra_sql = "";
if (strlen($select_column) > 0 && $select_column != null) {
	$column_arr = explode(",",$select_column);
	$extra_sql = setExtraSql($db,$column_arr);
}

$select = "
	PR.IDX						AS PRODUCT_IDX,
	PR.ORDERSHEET_IDX			AS ORDERSHEET_IDX,
	PR.PRODUCT_TYPE				AS PRODUCT_TYPE,
	PR.STYLE_CODE				AS STYLE_CODE,
	PR.COLOR_CODE				AS COLOR_CODE,
	PR.PRODUCT_CODE				AS PRODUCT_CODE,
	PR.PRODUCT_NAME				AS PRODUCT_NAME,
	PR.PRICE_KR					AS PRICE_KR,
	PR.DISCOUNT_KR				AS DISCOUNT_KR,
	PR.SALES_PRICE_KR			AS SALES_PRICE_KR,
	PR.PRICE_EN					AS PRICE_EN,
	PR.DISCOUNT_EN				AS DISCOUNT_EN,
	PR.SALES_PRICE_EN			AS SALES_PRICE_EN,
	PR.PRICE_CN					AS PRICE_CN,
	PR.DISCOUNT_CN				AS DISCOUNT_CN,
	PR.SALES_PRICE_CN			AS SALES_PRICE_CN,
	(
		SELECT
			REPLACE(
				S_PI.IMG_LOCATION,
				'/var/www/admin/www',
				''
			)
		FROM
			PRODUCT_IMG S_PI
		WHERE
			S_PI.PRODUCT_IDX = PR.IDX AND
			S_PI.DEL_FLG = FALSE AND
			S_PI.IMG_SIZE = 'S' AND
			S_PI.IMG_TYPE = 'P'
		ORDER BY
			S_PI.IDX ASC
		LIMIT
			0,1
	)							AS IMG_LOCATION,
	(
		SELECT
			IFNULL(SUM(S_PS.STOCK_QTY),0)
		FROM
			PRODUCT_STOCK S_PS
		WHERE
			S_PS.PRODUCT_IDX = PR.IDX AND
			S_PS.STOCK_DATE <= NOW()
	)							AS STOCK_QTY,
	(
		SELECT
			IFNULL(SUM(S_PS.STOCK_SAFE_QTY),0)
		FROM
			PRODUCT_STOCK S_PS
		WHERE
			S_PS.PRODUCT_IDX = PR.IDX AND
			S_PS.STOCK_DATE <= NOW()
	)							AS SAFE_QTY,
	(
		SELECT
			IFNULL(SUM(S_OP.PRODUCT_QTY),0)
		FROM
			ORDER_PRODUCT S_OP
		WHERE
			S_OP.ORDER_STATUS IN ('PCP','PPR','DPR','DPG','DCP') AND
			S_OP.PRODUCT_IDX = PR.IDX
	)							AS ORDER_QTY,
	".$extra_sql."
	PR.CREATER					AS CREATER,
	PR.CREATE_DATE				AS CREATE_DATE,
	PR.UPDATER					AS UPDATER,
	PR.UPDATE_DATE				AS UPDATE_DATE
";

//검색 유형 - 상품구분
if($product_type != null ){
	if ($product_type == "B" || $product_type == "S") {
		$where .= " AND (PR.PRODUCT_TYPE = '".$product_type."') ";
	} else if ($product_type == "D") {
		$where .= "
			AND (
				PR.IDX IN (
					SELECT
						S_SP.PRODUCT_IDX
					FROM
						SET_PRODUCT S_SP
						LEFT JOIN SHOP_PRODUCT S_PR ON
						S_SP.PRODUCT_IDX = S_PR.IDX
					WHERE
						S_PR.DEL_FLG = FALSE AND
						S_PR.INDP_FLG = FALSE
				)
			)
		";
	}
}

$total_cnt = $db->count($table,$where_cnt);

$json_result = array(
	'total' => $db->count($table,$where),
	'total_cnt' => $total_cnt,
	'page' => $page
);

$select_product_sql = "
	SELECT
		".$select."
	FROM
		".$table."
	WHERE
		".$where."
	ORDER BY 
		".$order."
";

if ($rows != null && $idx_flg == "false") {
	$select_product_sql .= " LIMIT ".$limit_start.",".$rows;
}

$select_product_cnt_sql = "
	SELECT
		(
			SELECT
				COUNT(IDX)
			FROM
				SHOP_PRODUCT
			WHERE
				DEL_FLG = FALSE AND
				INDP_FLG = FALSE
		) AS PRODUCT_QTY,
		(
			SELECT
				COUNT(IDX)
			FROM
				SHOP_PRODUCT
			WHERE
				DEL_FLG = FALSE AND
				INDP_FLG = FALSE AND
				SALE_FLG = TRUE
		) AS SALES_QTY,
		(
			SELECT
				COUNT(
					DISTINCT PG.PRODUCT_IDX
				)
			FROM
				PRODUCT_GRID PG
			WHERE
				PG.DEL_FLG = FALSE
		) AS DISPLAY_QTY
	FROM
		DUAL";
$db->query($select_product_cnt_sql);

$product_cnt = array();
foreach($db->fetch() as $cnt_data) {
	$non_sales_qty = intval($product_qty) - intval($sales_qty);
	$non_display_qty = intval($product_qty) - intval($display_qty);
	
	$product_cnt = array(
		'product_qty'		=>$cnt_data['PRODUCT_QTY'],
		'sales_qty'			=>$cnt_data['SALES_QTY'],
		'non_sales_qty'		=>$non_sales_qty,
		'display_qty'		=>$cnt_data['DISPLAY_QTY'],
		'non_display_qty'	=>$non_display_qty
	);
}
$json_result['data'][] = $product_cnt;

$db->query($select_product_sql);

foreach($db->fetch() as $data) {
	$product_idx = $data['PRODUCT_IDX'];
	$product_type = "";
	
	$img_location = "/images/default_product_img.jpg";
	if ($data['IMG_LOCATION'] != "" || $data['IMG_LOCATION'] != null) {
		$img_location = $data['IMG_LOCATION'];
	}
	
	$display_status = "";
	$display_cnt = $db->count("PRODUCT_GRID","PRODUCT_IDX = ".$product_idx." AND DEL_FLG = FALSE ");
	if ($display_cnt > 0) {
		$display_status = "진열중";
	} else {
		$display_status = "미진열";
	}
	
	$sale_flg = "";
	if ($data['SALE_FLG'] == true) {
		$sale_flg = "판매중";
	} else if ($data['SALE_FLG'] == false) {
		$sale_flg = "판매안함";
	}
	
	$sold_out_flg = "";
	if ($data['SOLD_OUT_FLG'] == true) {
		$sold_out_flg = "품절설정";
	} else if ($data['SOLD_OUT_FLG'] == false) {
		$sold_out_flg = "품절설정<br/>안함";
	}
	
	$whish_cnt = $db->count("WHISH_LIST","PRODUCT_IDX = ".$product_idx." AND DEL_FLG = FALSE");
	$basket_cnt = $db->count("BASKET_INFO","PRODUCT_IDX = ".$product_idx." AND DEL_FLG = FALSE");
	$order_pcp_cnt = $db->count("ORDER_PRODUCT","PRODUCT_IDX = ".$product_idx." AND ORDER_STATUS = 'PCP'");
	$order_dpg_cnt = $db->count("ORDER_PRODUCT","PRODUCT_IDX = ".$product_idx." AND ORDER_STATUS = 'DPG'");
	$order_dcp_cnt = $db->count("ORDER_PRODUCT","PRODUCT_IDX = ".$product_idx." AND ORDER_STATUS = 'DCP'");
	
	$set_product_info = array();
	if ($data['PRODUCT_TYPE'] == "S") {
		$product_type = "세트";
		$select_set_product_sql = "
			SELECT
				PR.STYLE_CODE				AS STYLE_CODE,
				PR.COLOR_CODE				AS COLOR_CODE,
				PR.PRODUCT_CODE				AS PRODUCT_CODE,
				(
					SELECT
						REPLACE(
							S_PI.IMG_LOCATION,
							'/var/www/admin/www',
							''
						)
					FROM
						PRODUCT_IMG S_PI
					WHERE
						S_PI.PRODUCT_IDX = PR.IDX AND
						S_PI.DEL_FLG = FALSE AND
						S_PI.IMG_SIZE = 'S' AND
						S_PI.IMG_TYPE = 'P'
					ORDER BY
						S_PI.IDX ASC
					LIMIT
						0,1
				)							AS IMG_LOCATION,
				PR.PRODUCT_NAME				AS PRODUCT_NAME,
				PR.UPDATE_DATE				AS UPDATE_DATE
			FROM
				SHOP_PRODUCT PR
				LEFT JOIN ORDERSHEET_MST OM ON
				PR.ORDERSHEET_IDX = OM.IDX
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
		
		foreach($db->fetch() as $set_data) {
			$set_img_location = "/images/default_product_img.jpg";
			if ($set_data['IMG_LOCATION'] != "" || $set_data['IMG_LOCATION'] != null) {
				$set_img_location = $set_data['IMG_LOCATION'];
			}
			
			$set_product_info[] = array(
				'style_code'					=>$set_data['STYLE_CODE'],
				'color_code'					=>$set_data['COLOR_CODE'],
				'product_code'					=>$set_data['PRODUCT_CODE'],
				'img_location'					=>$set_img_location,
				'product_name'					=>$set_data['PRODUCT_NAME'],
				'update_date'					=>$set_data['UPDATE_DATE'],
			);
		}
	} else {
		$product_type = "일반";
	}
	
	$json_result['data'][] = array(
		'num'							=>$total_cnt--,
		'product_idx'					=>$product_idx,
		'product_type'					=>$product_type,
		'ordersheet_idx'				=>$data['ORDERSHEET_IDX'],
		'style_code'					=>$data['STYLE_CODE'],
		'color_code'					=>$data['COLOR_CODE'],
		'product_code'					=>$data['PRODUCT_CODE'],
		'img_location'					=>$img_location,
		'stock_qty'						=>$data['STOCK_QTY'],
		'safe_qty'						=>$data['SAFE_QTY'],
		'order_qty'						=>$data['ORDER_QTY'],
		'product_qty'					=>intval($data['STOCK_QTY']) - intval($data['ORDER_QTY']),
		'product_name'					=>$data['PRODUCT_NAME'],
		'price_kr'						=>number_format($data['PRICE_KR']),
		'price_en'						=>number_format($data['PRICE_EN']),
		'price_cn'						=>number_format($data['PRICE_CN']),
		'discount_kr'					=>number_format($data['DISCOUNT_KR']),
		'discount_en'					=>number_format($data['DISCOUNT_EN']),
		'discount_cn'					=>number_format($data['DISCOUNT_CN']),
		'sales_price_kr'				=>number_format($data['SALES_PRICE_KR']),
		'sales_price_en'				=>number_format($data['SALES_PRICE_EN']),
		'sales_price_cn'				=>number_format($data['SALES_PRICE_CN']),
		'creater'						=>$data['CREATER'],
		'create_date'					=>$data['CREATE_DATE'],
		'updater'						=>$data['UPDATER'],
		'update_date'					=>$data['UPDATE_DATE'],
		
		'category_title'				=>$data['CATEGORY_TITLE'],
		'display_status'				=>$display_status,
		'sale_flg'						=>$sale_flg,
		'sold_out_flg'					=>$sold_out_flg,
		'manufacturer'					=>$data['MANUFACTURER'],
		'supplier'						=>$data['SUPPLIER'],
		'brand'							=>$data['BRAND'],
		'om_price_kr'					=>number_format($data['OM_PRICE_KR']),
		'om_price_en'					=>number_format($data['OM_PRICE_EN']),
		'om_price_cn'					=>number_format($data['OM_PRICE_CN']),
		'origin_country'				=>$data['ORIGIN_COUNTRY'],
		'model'							=>$data['MODEL'],
		'model_wear'					=>$data['MODEL_WEAR'],
		'product_keyword'				=>$data['PRODUCT_KEYWORD'],
		'product_tag'					=>$data['PRODUCT_TAG'],
		'whish_cnt'						=>$data['WHISH_CNT'],
		'basket_cnt'					=>$data['BASKET_CNT'],
		'order_pcp_cnt'					=>$data['ORDER_PRP_CNT'],
		'order_dpg_cnt'					=>$data['ORDER_DPG_CNT'],
		'order_dcp_cnt'					=>$data['ORDER_DCP_CNT'],
		'memo'							=>$data['MEMO'],
		
		'set_product_info'				=>$set_product_info
	);
}

function setExtraSql($db,$column_arr) {
	$extra_sql = "";
	
	for ($i=0; $i<count($column_arr); $i++) {
		switch ($column_arr[$i]) {
			case "md_category" :
				$extra_sql .= "
					IFNULL(
						(
							SELECT
								S_MC.TITLE
							FROM
								MD_CATEGORY S_MC
							WHERE
								S_MC.IDX = PR.CATEGORY_IDX
						),'-'
					)									AS CATEGORY_TITLE, ";
				break;
			
			case "sale_flg" :
				$extra_sql .= " PR.SALE_FLG				AS SALE_FLG, ";
				break;
			
			case "sold_out_flg" :
				$extra_sql .= " PR.SOLD_OUT_FLG			AS SOLD_OUT_FLG, ";
				break;
			
			case "manufacturer" :
				$extra_sql .= "
					IFNULL(
						OM.MANUFACTURER,'-'
					)									AS MANUFACTURER,
				";
				break;
			
			case "supplier" :
				$extra_sql .= "
					IFNULL(
						OM.SUPPLIER,'-'
					)									AS SUPPLIER,
				";
				break;
			
			case "brand" :
				$extra_sql .= "
					IFNULL(
						OM.BRAND,'-'
					)									AS BRAND,
				";
				break;
			
			case "origin_country" :
				$extra_sql .= "
					IFNULL(
						OM.ORIGIN_COUNTRY,'-'
					)									AS ORIGIN_COUNTRY,
				";
				break;
			
			case "price" :
				$extra_sql .= "
					OM.PRICE_KR							AS OM_PRICE_KR,
					OM.PRICE_EN							AS OM_PRICE_EN,
					OM.PRICE_CN							AS OM_PRICE_CN,
				";
				break;
			
			case "model" :
				$extra_sql .= "
					IFNULL(
						OM.MODEL,'-'
					)									AS MODEL,
				";
				break;
			
			case "model_wear" :
				$extra_sql .= "
					IFNULL(
						OM.MODEL_WEAR,'-'
					)									AS MODEL_WEAR,
				";
				break;
			
			case "product_keyword" :
				$extra_sql .= "
					IFNULL(
						PR.PRODUCT_KEYWORD,'상품 키워드 없음'
					)									AS PRODUCT_KEYWORD,
				";
				break;
			
			case "product_tag" :
				$extra_sql .= "
					IFNULL(
						PR.PRODUCT_TAG,'상품 태그 없음'
					)									AS PRODUCT_TAG,
				";
				break;
			
			case "memo" :
				$extra_sql .= " IFNULL(PR.MEMO,'')		AS MEMO, ";
				break;
		}
	}
	
	return $extra_sql;
}
?>