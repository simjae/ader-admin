<?php
/*
 +=============================================================================
 | 
 | 상품 목록 조회(엑셀)
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2023.03.14
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/

$line_info_arr 					= array();
$get_line_sql = "
	SELECT
		IDX,
		LINE_NAME
	FROM
		LINE_INFO
";
$db->query($get_line_sql);
foreach($db->fetch() as $line_data){
	$line_info_arr[$line_data['IDX']]['LINE_NAME'] = $line_data['LINE_NAME'];
}

$wkla_info_arr 					= array();
$get_wkla_sql = "
	SELECT
		IDX,
		WKLA_NAME
	FROM
		WKLA_INFO
";
$db->query($get_wkla_sql);
foreach($db->fetch() as $wkla_data){
	$wkla_info_arr[$wkla_data['IDX']]['WKLA_NAME'] = $wkla_data['WKLA_NAME'];
}

$box_info_arr 					= array();
$get_box_sql = "
	SELECT
		IDX,
		BOX_TYPE,
		BOX_NAME,
		BOX_WIDTH,
		BOX_LENGTH,
		BOX_HEIGHT,
		BOX_VOLUME
	FROM
		BOX_INFO
";
$db->query($get_box_sql);
foreach($db->fetch() as $box_data){
	$box_info_arr[$box_data['IDX']]['BOX_TYPE'] 	= $box_data['BOX_TYPE'];
	$box_info_arr[$box_data['IDX']]['BOX_NAME'] 	= $box_data['BOX_NAME'];
	$box_info_arr[$box_data['IDX']]['BOX_WIDTH'] 	= $box_data['BOX_WIDTH'];
	$box_info_arr[$box_data['IDX']]['BOX_LENGTH'] 	= $box_data['BOX_LENGTH'];
	$box_info_arr[$box_data['IDX']]['BOX_HEIGHT'] 	= $box_data['BOX_HEIGHT'];
	$box_info_arr[$box_data['IDX']]['BOX_VOLUME'] 	= $box_data['BOX_VOLUME'];
}


$sub_material_info_arr 			= array();
$get_sub_material_sql = "
	SELECT
		IDX,
		SUB_MATERIAL_TYPE,
		SUB_MATERIAL_SORT,
		SUB_MATERIAL_CODE,
		SUB_MATERIAL_NAME,
		COMPANY_NAME,
		COMPANY_CHARGE,
		COMPANY_TEL,
		COMPANY_ADDR,
		MEMO
	FROM
		SUB_MATERIAL_INFO
";
$db->query($get_sub_material_sql);
foreach($db->fetch() as $sub_material_data){
	$sub_material_info_arr[$sub_material_data['IDX']]['SUB_MATERIAL_TYPE'] 	= $sub_material_data['SUB_MATERIAL_TYPE'];
	$sub_material_info_arr[$sub_material_data['IDX']]['SUB_MATERIAL_SORT'] 	= $sub_material_data['SUB_MATERIAL_SORT'];
	$sub_material_info_arr[$sub_material_data['IDX']]['SUB_MATERIAL_CODE'] 	= $sub_material_data['SUB_MATERIAL_CODE'];
	$sub_material_info_arr[$sub_material_data['IDX']]['SUB_MATERIAL_NAME'] 	= $sub_material_data['SUB_MATERIAL_NAME'];
	$sub_material_info_arr[$sub_material_data['IDX']]['COMPANY_NAME'] 		= $sub_material_data['COMPANY_NAME'];
	$sub_material_info_arr[$sub_material_data['IDX']]['COMPANY_CHARGE'] 	= $sub_material_data['COMPANY_CHARGE'];
	$sub_material_info_arr[$sub_material_data['IDX']]['COMPANY_TEL'] 		= $sub_material_data['COMPANY_TEL'];
	$sub_material_info_arr[$sub_material_data['IDX']]['COMPANY_ADDR'] 		= $sub_material_data['COMPANY_ADDR'];
	$sub_material_info_arr[$sub_material_data['IDX']]['MEMO'] 				= $sub_material_data['MEMO'];
}


$product_filter_info_arr 		= array();
$get_product_filter_sql = "
	SELECT
		IDX,
		FILTER_NAME_KR,
		FILTER_NAME_EN,
		FILTER_NAME_CN,
		RGB_COLOR
	FROM
		PRODUCT_FILTER
	WHERE
		DEL_FLG = FALSE
";
$db->query($get_product_filter_sql);
foreach($db->fetch() as $product_filter_data){
	$product_filter_info_arr[$product_filter_data['IDX']]['FILTER_NAME_KR'] 	= $product_filter_data['FILTER_NAME_KR'];
	$product_filter_info_arr[$product_filter_data['IDX']]['FILTER_NAME_EN'] 	= $product_filter_data['FILTER_NAME_EN'];
	$product_filter_info_arr[$product_filter_data['IDX']]['FILTER_NAME_CN'] 	= $product_filter_data['FILTER_NAME_CN'];
	$product_filter_info_arr[$product_filter_data['IDX']]['RGB_COLOR'] 			= $product_filter_data['RGB_COLOR'];
}


$md_category_info_arr 			= array();
$get_md_category_sql = "
	SELECT
		IDX,
		TITLE
	FROM
		MD_CATEGORY
";
$db->query($get_md_category_sql);
foreach($db->fetch() as $md_category_data){
	$md_category_info_arr[$md_category_data['IDX']]['TITLE'] 	= $md_category_data['TITLE'];
}

$ordersheet_category_info_arr 	= array();
$get_ordersheet_category_sql = "
	SELECT
		IDX,
		TITLE
	FROM
		ORDERSHEET_CATEGORY
";
$db->query($get_ordersheet_category_sql);
foreach($db->fetch() as $ordersheet_category_data){
	$ordersheet_category_info_arr[$ordersheet_category_data['IDX']]['TITLE'] 	= $ordersheet_category_data['TITLE'];
}

$member_level_info_arr 			= array();
$get_member_level_sql = "
	SELECT
		IDX,
		TITLE
	FROM
		MEMBER_LEVEL
	WHERE
		DEL_FLG = FALSE
";
$db->query($get_member_level_sql);
foreach($db->fetch() as $member_level_data){
	$member_level_info_arr[$member_level_data['IDX']]['TITLE'] = $member_level_data['TITLE'];
}

$clearance_info_arr 					= array();
$get_clearance_sql = "
	SELECT
		IDX,
		CATEGORY_NAME,
		HS_CODE
	FROM
		CUSTOM_CLEARANCE
";
$db->query($get_clearance_sql);
foreach($db->fetch() as $clearance_data){
	$clearance_info_arr[$clearance_data['IDX']]['CATEGORY_NAME'] = $line_data['CATEGORY_NAME'];
	$clearance_info_arr[$clearance_data['IDX']]['HS_CODE'] = $line_data['HS_CODE'];
}


/*
print_r($wkla_info_arr);
print_r($box_info_arr);
print_r($sub_material_info_arr);
print_r($product_filter_info_arr);
print_r($md_category_info_arr);
print_r($ordersheet_category_info_arr);
print_r($member_level_info_arr);
print_r($clearance_info_arr);
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
$prod_date_from 	= $_POST['prod_date_from'];		//검색시작일
$prod_date_to 		= $_POST['prod_date_to'];		//검색종료일

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

$sort_value			= $_POST['sort_value'];	
$sort_type			= $_POST['sort_type'];	

//검색 유형 - 디폴트
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
									IFNULL(OM.MATERIAL_KR,'-'),'|',
									IFNULL(OM.MATERIAL_EN,'-'),'|',
									IFNULL(OM.MATERIAL_CN,'-'),'|'
								) REGEXP '".$search_keyword[$i]."'
							)
						";
						break;

					case "care" :
						$keyword_where .= "
							(
								CONCAT(
									IFNULL(OM.CARE_KR,'-'),'|',
									IFNULL(OM.CARE_EN,'-'),'|',
									IFNULL(OM.CARE_CN,'-'),'|'
								) REGEXP '".$search_keyword[$i]."'
							)
						";

						break;

					case "detail" :
						$keyword_where .= "
							(
								CONCAT(
									IFNULL(OM.DETAIL_KR,'-'),'|',
									IFNULL(OM.DETAIL_EN,'-'),'|',
									IFNULL(OM.DETAIL_CN,'-'),'|'
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
if($price_type != null){
	$cnt = 0;
	for ($i=0; $i<count($price_type); $i++) {
		if (strlen($price_type[$i]) > 0 && (is_numeric($price_min[$i]) || is_numeric($price_max[$i])) ){
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
					if (strlen($price_type[$i]) > 0 && (is_numeric($price_min[$i]) || is_numeric($price_max[$i])) ) {
						$tmp_price .= " AND ";
					}
				}
				
				if (is_numeric($price_min[$i]) && !is_numeric($price_max[$i])) {
					$tmp_price .= " PR.".$price_type[$i]." >= ".$price_min[$i]." ";
				}
				
				if (!is_numeric($price_min[$i]) && is_numeric($price_max[$i])) {
					$tmp_price .= " PR.".$price_type[$i]." <= ".$price_max[$i]." ";
				}
				
				if(is_numeric($price_min[$i]) && is_numeric($price_max[$i])) {
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
		case "01d" :
			$where .= ' AND (PR.'.$date_type.' = (CURDATE() - INTERVAL 1 DAY)) ';
			break;
		case "03d" :
			$where .= ' AND (PR.'.$date_type.' >= (CURDATE() - INTERVAL 3 DAY)) ';
			break;
		case "01w" :
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

//검색 유형 - 상품 등록/수정일
if ($prod_date_from != null && $prod_date_to != null) {
	$where .= " AND (PR.".$date_type." BETWEEN '".$prod_date_from."' AND '".$prod_date_to."') ";
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
$order = '-';
if ($sort_value != null && $sort_type != null) {
	$order = ' '.$sort_value." ".$sort_type." ";
} else {
	$order = ' PR.IDX DESC';
}

$select_product_info_sql = "
	SELECT
		PR.IDX,
		PR.ORDERSHEET_IDX,
		PR.STYLE_CODE,
		PR.COLOR_CODE,
		PR.PRODUCT_CODE,
		PR.PRODUCT_NAME,
		PR.MD_CATEGORY_1,
		PR.MD_CATEGORY_2,
		PR.MD_CATEGORY_3,
		PR.MD_CATEGORY_4,
		PR.MD_CATEGORY_5,
		PR.MD_CATEGORY_6,
		OO.OPTION_NAME,
		OO.BARCODE,
		(SELECT
			IFNULL(SUM(S_PS.STOCK_QTY), 0)
		FROM
			PRODUCT_STOCK S_PS
		WHERE
			S_PS.OPTION_IDX = OO.IDX AND
			S_PS.STOCK_DATE <= NOW()) AS STOCK_QTY,
		(SELECT
			IFNULL(SUM(S_PS.STOCK_SAFE_QTY), 0)
		FROM
			PRODUCT_STOCK S_PS
		WHERE
			S_PS.OPTION_IDX = OO.IDX AND
			S_PS.STOCK_DATE <= NOW()) AS SAFE_QTY,
		PO.QTY,
		PR.CLEARANCE_IDX,
		PR.SALE_FLG,
		PR.SOLD_OUT_FLG,
		PR.MILEAGE_FLG,
		PR.EXCLUSIVE_FLG,
		PR.PRICE_KR,
		PR.SALES_PRICE_KR,
		PR.DISCOUNT_KR,
		PR.PRICE_EN,
		PR.SALES_PRICE_EN,
		PR.DISCOUNT_EN,
		PR.PRICE_CN,
		PR.SALES_PRICE_CN,
		PR.DISCOUNT_CN,
		PR.LIMIT_MEMBER,
		PR.LIMIT_ID_FLG,
		PR.REORDER_CNT,
		PR.LIMIT_PURCHASE_QTY_FLG,
		PR.LIMIT_PRODUCT_QTY,
		PR.RELEVANT_IDX,
		IFNULL(PR.SOLD_OUT_QTY, 0),
		IFNULL(PR.DETAIL_KR,'-'),
		IFNULL(PR.DETAIL_EN,'-'),
		IFNULL(PR.DETAIL_CN,'-'),
		IFNULL(PR.CARE_KR,'-'),
		IFNULL(PR.CARE_EN,'-'),
		IFNULL(PR.CARE_CN,'-'),
		IFNULL(PR.MATERIAL_KR,'-'),
		IFNULL(PR.MATERIAL_EN,'-'),
		IFNULL(PR.MATERIAL_CN,'-'),
		PR.REFUND_MSG_FLG,
		IFNULL(PR.REFUND_MSG_KR,'-'),
		IFNULL(PR.REFUND_MSG_EN,'-'),
		IFNULL(PR.REFUND_MSG_CN,'-'),
		IFNULL(PR.REFUND_KR,'-'),
		IFNULL(PR.REFUND_EN,'-'),
		IFNULL(PR.REFUND_CN,'-'),
		PR.FILTER_FT,
		PR.FILTER_GP,
		PR.FILTER_LN,
		PR.FILTER_CL,
		PR.FILTER_SZ
    FROM
        SHOP_PRODUCT PR
        LEFT JOIN ORDERSHEET_MST OM ON
        PR.ORDERSHEET_IDX = OM.IDX
        LEFT JOIN ORDERSHEET_OPTION OO ON
        PR.ORDERSHEET_IDX = OO.ORDERSHEET_IDX
        LEFT JOIN PRODUCT_OPTION PO ON
        PR.IDX = PO.PRODUCT_IDX AND
        OO.IDX = PO.OPTION_IDX
	WHERE
		".$where."
	ORDER BY 
		".$order."
";
$db->query($select_product_info_sql);
//print_r($line_info_arr);
$relevant_info_arr = array();
foreach($db->fetch() as $product_data){
	if($product_data['RELEVANT_IDX'] != null && strlen($product_data['RELEVANT_IDX']) > 0){
		$get_relevant_sql = "
			SELECT
				PRODUCT_CODE,
				PRODUCT_NAME
			FROM
				SHOP_PRODUCT
			WHERE
				IDX IN (".$product_data['RELEVANT_IDX'].")
		";
		$db->query($get_relevant_sql);
		
		foreach($db->fetch() as $relevant_data){
			$relevant_info_arr[] = $relevant_data['PRODUCT_NAME'].'('.$relevant_data['PRODUCT_CODE'].')';
		}
	}
	

	$member_level_arr = explode(',',$product_data['LIMIT_MEMBER']);
	foreach($member_level_arr as $idx=>$val){
		$member_level_arr[$idx] = $member_level_info_arr[$val]['TITLE'];
	}

	$filter_cl_arr = explode(',',$product_data['FILTER_CL']);
	foreach($filter_cl_arr as $idx=>$val){
		$filter_cl_arr[$idx] = $product_filter_info_arr[$val]['FILTER_NAME_KR'].'('.$product_filter_info_arr[$val]['RGB_COLOR'].')';
	}

	$filter_sz_arr = explode(',',$product_data['FILTER_SZ']);
	foreach($filter_sz_arr as $idx=>$val){
		$filter_sz_arr[$idx] = $product_filter_info_arr[$val]['FILTER_NAME_KR'].'('.$product_filter_info_arr[$val]['RGB_COLOR'].')';
	}
	
	$product_image_seq_sql = "
			SELECT 
				DISTINCT IMG_TYPE 
			FROM 
				PRODUCT_IMG 
			WHERE 
				PRODUCT_IDX = ".$product_data['IDX']." 
			ORDER BY 
				IDX ASC
	";

	$db->query($product_image_seq_sql);
	$product_img_seq_arr = array();
	foreach($db->fetch() as $img_seq_data){
		$product_img_seq_arr[] = $img_seq_data['IMG_TYPE'];
	}
	$json_result['data']['product'][] = array(
		'style_code'				=>$product_data['STYLE_CODE'],
		'color_code'				=>$product_data['COLOR_CODE'],
		'product_code'				=>$product_data['PRODUCT_CODE'],
		'product_name'				=>$product_data['PRODUCT_NAME'],
		'option_name'				=>$product_data['OPTION_NAME'],
		'barcode'					=>$product_data['BARCODE'],
		'stock_qty'					=>$product_data['STOCK_QTY'],
		'safe_qty'					=>$product_data['SAFE_QTY'],
		'qty'						=>$product_data['QTY'],
		'md_category_1'				=>$md_category_info_arr[$product_data['MD_CATEGORY_1']]['TITLE']==null?'-':$md_category_info_arr[$product_data['MD_CATEGORY_1']]['TITLE']==null,
		'md_category_2'				=>$md_category_info_arr[$product_data['MD_CATEGORY_2']]['TITLE']==null?'-':$md_category_info_arr[$product_data['MD_CATEGORY_2']]['TITLE']==null,
		'md_category_3'				=>$md_category_info_arr[$product_data['MD_CATEGORY_3']]['TITLE']==null?'-':$md_category_info_arr[$product_data['MD_CATEGORY_3']]['TITLE']==null,
		'md_category_4'				=>$md_category_info_arr[$product_data['MD_CATEGORY_4']]['TITLE']==null?'-':$md_category_info_arr[$product_data['MD_CATEGORY_4']]['TITLE']==null,
		'md_category_5'				=>$md_category_info_arr[$product_data['MD_CATEGORY_5']]['TITLE']==null?'-':$md_category_info_arr[$product_data['MD_CATEGORY_5']]['TITLE']==null,
		'md_category_6'				=>$md_category_info_arr[$product_data['MD_CATEGORY_6']]['TITLE']==null?'-':$md_category_info_arr[$product_data['MD_CATEGORY_6']]['TITLE']==null,
		'clearance_idx'				=>$clearance_info_arr[$product_data['CLEARANCE_IDX']]['HS_CODE']==null?'-':$clearance_info_arr[$product_data['CLEARANCE_IDX']]['HS_CODE']==null,
		'sale_flg'					=>$product_data['SALE_FLG'],
		'sold_out_flg'				=>$product_data['SOLD_OUT_FLG'],
		'mileage_flg'				=>$product_data['MILEAGE_FLG'],
		'exclusive_flg'				=>$product_data['EXCLUSIVE_FLG'],
		'price_kr'					=>$product_data['PRICE_KR'],
		'sales_price_kr'			=>$product_data['SALES_PRICE_KR'],
		'discount_kr'				=>$product_data['DISCOUNT_KR'],
		'price_en'					=>$product_data['PRICE_EN'],
		'sales_price_en'			=>$product_data['SALES_PRICE_EN'],
		'discount_en'				=>$product_data['DISCOUNT_EN'],
		'price_cn'					=>$product_data['PRICE_CN'],
		'sales_price_cn'			=>$product_data['SALES_PRICE_CN'],
		'discount_cn'				=>$product_data['DISCOUNT_CN'],
		'limit_member'				=>implode(',',$member_level_arr),
		'limit_id_flg'				=>$product_data['LIMIT_ID_FLG'],
		'reorder_cnt'				=>$product_data['REORDER_CNT'],
		'limit_purchase_qty_flg'	=>$product_data['LIMIT_PURCHASE_QTY_FLG'],
		'limit_product_qty'			=>$product_data['LIMIT_PRODUCT_QTY'],
		'relevant_idx'				=>implode(',',$relevant_info_arr),
		'sold_out_qty'				=>$product_data['SOLD_OUT_QTY'],
		'detail_kr'					=>$product_data['DETAIL_KR'],
		'detail_en'					=>$product_data['DETAIL_EN'],
		'detail_cn'					=>$product_data['DETAIL_CN'],
		'care_kr'					=>$product_data['CARE_KR'],
		'care_en'					=>$product_data['CARE_EN'],
		'care_cn'					=>$product_data['CARE_CN'],
		'material_kr'				=>$product_data['MATERIAL_KR'],
		'material_en'				=>$product_data['MATERIAL_EN'],
		'material_cn'				=>$product_data['MATERIAL_CN'],
		'refund_msg_flg'			=>$product_data['REFUND_MSG_FLG'],
		'refund_msg_kr'				=>$product_data['REFUND_MSG_KR'],
		'refund_msg_en'				=>$product_data['REFUND_MSG_EN'],
		'refund_msg_cn'				=>$product_data['REFUND_MSG_CN'],
		'refund_kr'					=>$product_data['REFUND_KR'],
		'refund_en'					=>$product_data['REFUND_EN'],
		'refund_cn'					=>$product_data['REFUND_CN'],
		'filter_ft'					=>$product_data['FILTER_FT'],
		'filter_gp'					=>$product_data['FILTER_GP'],
		'filter_ln'					=>$product_data['FILTER_LN'],
		'filter_cl'					=>implode(',',$filter_cl_arr)=='()'?'-':implode(',',$filter_cl_arr),
		'filter_sz'					=>implode(',',$filter_sz_arr)=='()'?'-':implode(',',$filter_sz_arr),
		'img_seq'					=>implode('->',$product_img_seq_arr)
	);
}
$get_ordersheet_info_sql = "
	SELECT
		IFNULL(OM.YEAR,'-'),
		OM.STYLE_CODE,
		OM.COLOR_CODE,
		OM.PRODUCT_CODE,
		OM.PREORDER_FLG,
		OM.REFUND_FLG,
		OM.LINE_IDX,
		OM.CATEGORY_LRG,
		OM.CATEGORY_MDL,
		OM.CATEGORY_SML,
		OM.CATEGORY_DTL,
		OM.PRODUCT_NAME,
		IFNULL(OM.GRAPHIC,'-')					AS GRAPHIC,
		IFNULL(OM.PRODUCT_SIZE,'-')				AS PRODUCT_SIZE,
		IFNULL(OM.COLOR,'-')						AS COLOR,
		IFNULL(OM.LIMIT_PRODUCT_QTY_FLG,'-')		AS LIMIT_PRODUCT_QTY_FLG,
		IFNULL(OM.LIMIT_PRODUCT_QTY,'-')			AS LIMIT_PRODUCT_QTY,
		IFNULL(OM.LIMIT_ID_FLG,'-')				AS LIMIT_ID_FLG,
		IFNULL(OM.LIMIT_MEMBER,'-')				AS LIMIT_MEMBER,
		OM.PRICE_COST,
		OM.PRICE_KR,
		OM.PRICE_KR_GB,
		OM.PRICE_EN,
		OM.PRICE_CN,
		OM.PRODUCT_QTY,
		OM.SAFE_QTY,
		IFNULL(OM.RECEIVE_REQUEST_DATE,'-')		AS RECEIVE_REQUEST_DATE,		
		IFNULL(OM.LAUNCHING_DATE,'-')			AS LAUNCHING_DATE,

		OM.WKLA_IDX,
		IFNULL(OM.MATERIAL,'-') 					AS MATERIAL,
		IFNULL(OM.FIT,'-') 						AS FIT,
		IFNULL(OM.COLOR_RGB,'-') 				AS COLOR_RGB,
		IFNULL(OM.PANTONE_CODE,'-') 				AS PANTONE_CODE,
		IFNULL(OM.MODEL,'-') 					AS MODEL,
		IFNULL(OM.MODEL_WEAR,'-') 				AS MODEL_WEAR,
		IFNULL(OM.DETAIL_KR,'-')					AS DETAIL_KR,
		IFNULL(OM.DETAIL_EN,'-')					AS DETAIL_EN,
		IFNULL(OM.DETAIL_CN,'-')					AS DETAIL_CN,
		IFNULL(OM.CARE_DSN_KR,'-')				AS CARE_DSN_KR,
		IFNULL(OM.CARE_DSN_EN,'-')				AS CARE_DSN_EN,
		IFNULL(OM.CARE_DSN_CN,'-')				AS CARE_DSN_CN,

		IFNULL(OM.CARE_TD_KR,'-')				AS CARE_TD_KR,
		IFNULL(OM.CARE_TD_EN,'-')				AS CARE_TD_EN,
		IFNULL(OM.CARE_TD_CN,'-')				AS CARE_TD_CN,
		IFNULL(OM.MATERIAL_KR,'-')				AS MATERIAL_KR,
		IFNULL(OM.MATERIAL_EN,'-')				AS MATERIAL_EN,
		IFNULL(OM.MATERIAL_CN,'-')				AS MATERIAL_CN,
		IFNULL(OM.MANUFACTURER,'-')				AS MANUFACTURER,
		IFNULL(OM.SUPPLIER,'-')					AS SUPPLIER,
		IFNULL(OM.ORIGIN_COUNTRY,'-')			AS ORIGIN_COUNTRY,
		IFNULL(OM.BRAND,'-')						AS BRAND
	FROM
        ORDERSHEET_MST OM
	WHERE
		IDX IN (
					SELECT
						DISTINCT OM.IDX
					FROM
						SHOP_PRODUCT PR
						LEFT JOIN ORDERSHEET_MST OM ON
						PR.ORDERSHEET_IDX = OM.IDX
						LEFT JOIN ORDERSHEET_OPTION OO ON
						PR.ORDERSHEET_IDX = OO.ORDERSHEET_IDX
						LEFT JOIN PRODUCT_OPTION PO ON
						PR.IDX = PO.PRODUCT_IDX AND
						OO.IDX = PO.OPTION_IDX
					WHERE
						".$where."
					ORDER BY 
						".$order."
	)
";

$db->query($get_ordersheet_info_sql);
$ordershset_data_arr = array();
foreach($db->fetch() as $ordersheet_data){
	$ordershset_data_arr['md'] = array(
		'year'					=> $ordersheet_data['YEAR'],
		'style_code'			=> $ordersheet_data['STYLE_CODE'],
		'color_code'			=> $ordersheet_data['COLOR_CODE'],
		'product_code'			=> $ordersheet_data['PRODUCT_CODE'],
		'preorder_flg'			=> $ordersheet_data['PREORDER_FLG'],
		'refund_flg'			=> $ordersheet_data['REFUND_FLG'],
		'line_idx'				=> $line_info_arr[$ordersheet_data['LINE_IDX']]['LINE_NAME']==null?'-':$line_info_arr[$ordersheet_data['LINE_IDX']]['LINE_NAME'],
		'category_lrg'			=> $ordersheet_category_info_arr[$ordersheet_data['CATEGORY_LRG']]['TITLE']==null?'-':$ordersheet_category_info_arr[$ordersheet_data['CATEGORY_LRG']]['TITLE'],
		'category_mdl'			=> $ordersheet_category_info_arr[$ordersheet_data['CATEGORY_MDL']]['TITLE']==null?'-':$ordersheet_category_info_arr[$ordersheet_data['CATEGORY_MDL']]['TITLE'],
		'category_sml'			=> $ordersheet_category_info_arr[$ordersheet_data['CATEGORY_SML']]['TITLE']==null?'-':$ordersheet_category_info_arr[$ordersheet_data['CATEGORY_SML']]['TITLE'],
		'category_dtl'			=> $ordersheet_category_info_arr[$ordersheet_data['CATEGORY_DTL']]['TITLE']==null?'-':$ordersheet_category_info_arr[$ordersheet_data['CATEGORY_DTL']]['TITLE'],
		'product_name'			=> $ordersheet_data['PRODUCT_NAME'],
		'graphic'				=> $ordersheet_data['GRAPHIC'],
		'product_size'			=> $ordersheet_data['PRODUCT_SIZE'],
		'color'					=> $ordersheet_data['COLOR'],
		'limit_product_qty_flg'	=> $ordersheet_data['LIMIT_PRODUCT_QTY_FLG'],
		'limit_product_qty'		=> $ordersheet_data['LIMIT_PRODUCT_QTY'],
		'limit_id_flg'			=> $ordersheet_data['LIMIT_ID_FLG'],
		'limit_member'			=> $ordersheet_data['LIMIT_MEMBER'],
		'price_cost'			=> $ordersheet_data['PRICE_COST'],
		'price_kr'				=> $ordersheet_data['PRICE_KR'],
		'price_kr_gb'			=> $ordersheet_data['PRICE_KR_GB'],
		'price_en'				=> $ordersheet_data['PRICE_EN'],
		'price_cn'				=> $ordersheet_data['PRICE_CN'],
		'product_qty'			=> $ordersheet_data['PRODUCT_QTY'],
		'safe_qty'				=> $ordersheet_data['SAFE_QTY'],
		'receive_request_date'	=> $ordersheet_data['RECEIVE_REQUEST_DATE'],
		'launching_date'		=> $ordersheet_data['LAUNCHING_DATE']
	);
	$ordershset_data_arr['dsn'] = array(
		'wkla_idx'				=>$wkla_info_arr[$ordersheet_data['WKLA_IDX']]['WKLA_NAME']!=null?$wkla_info_arr[$ordersheet_data['WKLA_IDX']]['WKLA_NAME']:'-',
		'material'				=>$ordersheet_data['MATERIAL'],
		'fit'					=>$ordersheet_data['FIT'],
		'color_rgb'				=>$ordersheet_data['COLOR_RGB'],
		'pantone_code'			=>$ordersheet_data['PANTONE_CODE'],
		'model'					=>$ordersheet_data['MODEL'],
		'model_wear'			=>$ordersheet_data['MODEL_WEAR'],
		'detail_kr'				=>$ordersheet_data['DETAIL_KR'],
		'detail_en'				=>$ordersheet_data['DETAIL_EN'],
		'detail_cn'				=>$ordersheet_data['DETAIL_CN'],
		'care_dsn_kr'			=>$ordersheet_data['CARE_DSN_KR'],
		'care_dsn_en'			=>$ordersheet_data['CARE_DSN_EN'],
		'care_dsn_cn'			=>$ordersheet_data['CARE_DSN_CN']
	);
	$ordershset_data_arr['td'] = array(
		'care_td_kr'			=>$ordersheet_data['CARE_TD_KR'],
		'care_td_en'			=>$ordersheet_data['CARE_TD_EN'],
		'care_td_cn'			=>$ordersheet_data['CARE_TD_CN'],
		'material_kr'			=>$ordersheet_data['MATERIAL_KR'],
		'material_en'			=>$ordersheet_data['MATERIAL_EN'],
		'material_cn'			=>$ordersheet_data['MATERIAL_CN'],
		'manufacturer'			=>$ordersheet_data['MANUFACTURER'],
		'supplier'				=>$ordersheet_data['SUPPLIER'],
		'origin_country'		=>$ordersheet_data['ORIGIN_COUNTRY'],
		'brand'					=>$ordersheet_data['BRAND']
	);
	$json_result['data']['ordersheet'][] = $ordershset_data_arr;
}
//print_r($json_result['data']);
?>