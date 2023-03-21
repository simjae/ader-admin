<?php
/*
 +=============================================================================
 | 
 | 상품목록 - 선택상품 상태수정
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.09.6
 | 최종 수정일	: 2022.12.13
 | 버전		:   1.2
 | 설명		:   1.1v 변경점 - TABLE COLUMN 최신화
 |              1.2v 변경점 - 트랜젝션 적용 및 불필요 쿼리 제거 
 | 
 +=============================================================================
*/
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
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

$no             = $_POST['no'];
$action_type    = $_POST['action_type'];

if ($action_type != null && is_array($no)) {
    $sql = '
        UPDATE
            SHOP_PRODUCT
        SET
            DEL_FLG = TRUE
        WHERE 
            IDX IN (' . implode(",", $no) . ')
        ';

    $update_row_cnt = 0;

    $db->query($sql);
}
else{
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
                                        IFNULL(OM.CARE_KR,''),'|',
                                        IFNULL(OM.CARE_EN,''),'|',
                                        IFNULL(OM.CARE_CN,''),'|'
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

    $select = "
        DISTINCT PR.IDX						AS PRODUCT_IDX
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
    $select_product_sql = "
        SELECT
            IFNULL(COUNT(0),0) AS COUNT
        FROM
            SHOP_PRODUCT PR
            LEFT JOIN ORDERSHEET_MST OM ON
            PR.ORDERSHEET_IDX = OM.IDX
        WHERE
            ".$where."
    ";

    $db->query($select_product_sql);
    $count = 0;
    foreach($db->fetch() as $data) {
        $count = $data['COUNT'];
    }

    if($count > 0){
        // 독립몰 상품 항목
        $style_code						= $_POST['shop_style_code'];
        $style_code_str					= '';
        if($style_code != null){
            $style_code_str				= " PR.STYLE_CODE = '".$style_code."', ";
        }
        $shop_color_code				= $_POST['shop_color_code'];
        $shop_color_code_str			= '';
        if($shop_color_code != null){
            $shop_color_code_str		= " PR.COLOR_CODE = '".$shop_color_code."', ";
        }
        $product_code					= $_POST['shop_product_code'];
        $product_code_str				= '';
        if($product_code != null){
            $product_code_str	  		= " PR.PRODUCT_CODE = '".$product_code."', ";
        }

        $shop_product_name				= $_POST['shop_product_name'];
        $shop_product_name_update_flg   = $_POST['shop_product_name_update_flg'];
        $shop_product_name_str		  = '';
        if($shop_product_name_update_flg == 'true'){
            $shop_product_name_str		= " PR.PRODUCT_NAME = '".$shop_product_name."', ";
        }

        $md_category_flg = $_POST['md_category_flg'];
        if($md_category_flg == 'true'){
            $category_idx = '0';
            $md_category_1				= $_POST['md_category_idx'][0];
            $md_category_1_str			= '';
            if($md_category_1 == '' || $md_category_1 == null){
                $md_category_1 = '0';
                $category_idx = '0';
            }
            $md_category_1_str			= " PR.MD_CATEGORY_1 = ".$md_category_1.", ";

            $md_category_2				= $_POST['md_category_idx'][1];
            $md_category_2_str			= '';
            if($md_category_2 == '' || $md_category_2 == null){
                $md_category_2 = '0';
                if($md_category_1 != '0'){
                    $category_idx = $md_category_1;
                }
            }
            $md_category_2_str		  = " PR.MD_CATEGORY_2 = ".$md_category_2.", ";

            $md_category_3			  = $_POST['md_category_idx'][2];
            $md_category_3_str		  = '';
            if($md_category_3 == '' || $md_category_3 == null){
                $md_category_3 = '0';
                if($md_category_2 != '0'){
                    $category_idx = $md_category_2;
                }
            }
            $md_category_3_str		  = " PR.MD_CATEGORY_3 = ".$md_category_3.", ";

            $md_category_4			  = $_POST['md_category_idx'][3];
            $md_category_4_str		  = '';
            if($md_category_4 == '' || $md_category_4 == null){
                $md_category_4 = '0';
                if($md_category_3 != '0'){
                    $category_idx = $md_category_3;
                }
            }
            $md_category_4_str		  = " PR.MD_CATEGORY_4 = ".$md_category_4.", ";

            $md_category_5			  = $_POST['md_category_idx'][4];
            $md_category_5_str		  = '';
            if($md_category_5 == '' || $md_category_5 == null){
                $md_category_5 = '0';
                if($md_category_4 != '0'){
                    $category_idx = $md_category_4;
                }
            }
            $md_category_5_str		  = " PR.MD_CATEGORY_5 = ".$md_category_5.", ";

            $md_category_6			  = $_POST['md_category_idx'][5];
            $md_category_6_str		  = '';
            if($md_category_6 == '' || $md_category_6 == null){
                $md_category_6 = '0';
                if($md_category_5 != '0'){
                    $category_idx = $md_category_5;
                }
            }
            $md_category_6_str		  = " PR.MD_CATEGORY_6 = ".$md_category_6.", ";
            $category_idx			   = " PR.CATEGORY_IDX = ".$category_idx.", ";
        }

        $sale_flg				= $_POST['sale_update_flg'];
        $sale_flg_str			= '';
        if($sale_flg != null){
            $sale_flg_str		= " PR.SALE_FLG = ".$sale_flg.", ";
        }

        $sold_out_flg				= $_POST['sold_out_flg'];
        $sold_out_flg_str			= '';
        if($sale_flg != null){
            $sold_out_flg_str		= " PR.SOLD_OUT_FLG = ".$sold_out_flg.", ";
        }

        $mileage_flg				= $_POST['mileage_flg'];
        $mileage_flg_str			= '';
        if($mileage_flg != null){
            $mileage_flg_str		= " PR.MILEAGE_FLG = ".$mileage_flg.", ";
        }

        $exclusive_flg			  = $_POST['exclusive_flg'];
        $exclusive_flg_str		  = '';
        if($exclusive_flg != null){
            $exclusive_flg_str	  = " PR.EXCLUSIVE_FLG = ".$exclusive_flg.", ";
        }

        $price_kr					   = $_POST['price_kr'];
        $price_kr_update_flg			= $_POST['price_kr_update_flg'];
        $price_kr_str = '';
        if ($price_kr_update_flg == 'true') {
            if($price_kr == '' || $price_kr == null){
                $price_kr = '0';
            }
            $price_kr_str			   = " PR.PRICE_KR = ".$price_kr.",";
        }
        $price_en					   = $_POST['price_en'];
        $price_en_update_flg			= $_POST['price_en_update_flg'];
        $price_en_str = '';
        if ($price_en_update_flg == 'true') {
            if($price_en == '' || $price_en == null){
                $price_en = '0';
            }
            $price_en_str			   = " PR.PRICE_EN = ".$price_en.",";
        }
        $price_cn					   = $_POST['price_cn'];
        $price_cn_update_flg			= $_POST['price_cn_update_flg'];
        $price_cn_str = '';
        if ($price_cn_update_flg == 'true') {
            if($price_cn == '' || $price_cn == null){
                $price_cn = '0';
            }
            $price_cn_str			   = " PR.PRICE_CN = ".$price_cn.",";
        }

        $discount_kr					= $_POST['discount_kr'];
        $discount_kr_update_flg		 = $_POST['discount_kr_update_flg'];
        $discount_kr_str = '';
        if ($discount_kr_update_flg == 'true') {
            if($discount_kr == '' || $discount_kr == null){
                $discount_kr = '0';
            }
            $discount_kr_str			= " PR.DISCOUNT_KR = ".$discount_kr.",";
        }
        $discount_en					= $_POST['discount_en'];
        $discount_en_update_flg		 = $_POST['discount_en_update_flg'];
        $discount_en_str = '';
        if ($discount_en_update_flg == 'true') {
            if($discount_en == '' || $discount_en == null){
                $discount_en = '0';
            }
            $discount_en_str			= " PR.DISCOUNT_EN = ".$discount_en.",";
        }
        $discount_cn					= $_POST['discount_cn'];
        $discount_cn_update_flg		 = $_POST['discount_cn_update_flg'];
        $discount_cn_str = '';
        if ($discount_cn_update_flg == 'true') {
            if($discount_cn == '' || $discount_cn == null){
                $discount_cn = '0';
            }
            $discount_cn_str			= " PR.DISCOUNT_CN = ".$discount_cn.",";
        }

        $sales_price_kr				 = $_POST['sales_price_kr'];
        $sales_price_kr_update_flg	  = $_POST['sales_price_kr_update_flg'];
        $sales_price_kr_str = '';
        if ($sales_price_kr_update_flg == 'true') {
            if($sales_price_kr == '' || $sales_price_kr == null){
                $sales_price_kr = '0';
            }
            $sales_price_kr_str		   = " PR.SALES_PRICE_KR = ".$sales_price_kr.",";
        }
        $sales_price_en				 = $_POST['sales_price_en'];
        $sales_price_en_update_flg	  = $_POST['sales_price_en_update_flg'];
        $sales_price_en_str = '';
        if ($sales_price_en_update_flg == 'true') {
            if($sales_price_en == '' || $sales_price_en == null){
                $sales_price_en = '0';
            }
            $sales_price_en_str		 = " PR.SALES_PRICE_EN = ".$sales_price_en.",";
        }
        $sales_price_cn				 = $_POST['sales_price_cn'];
        $sales_price_cn_update_flg	  = $_POST['sales_price_cn_update_flg'];
        $sales_price_cn_str = '';
        if ($sales_price_cn_update_flg == 'true') {
            if($sales_price_cn == '' || $sales_price_cn == null){
                $sales_price_cn = '0';
            }
            $sales_price_cn_str		 = " PR.SALES_PRICE_CN = ".$sales_price_cn.",";
        }

        $limit_id_flg		 = $_POST['limit_id_flg'];
        $limit_id_flg_str = '';
        if($limit_id_flg != null){
            $limit_id_flg_str = " PR.LIMIT_ID_FLG = ".$limit_id_flg.", ";
        }

        $reorder_cnt				 = $_POST['reorder_cnt'];
        $reorder_cnt_update_flg	  = $_POST['reorder_cnt_update_flg'];
        $reorder_cnt_str = '';
        if ($reorder_cnt_update_flg == 'true') {
            if($reorder_cnt == '' || $reorder_cnt == null){
                $reorder_cnt = '0';
            }
            $reorder_cnt_str		 = " PR.REORDER_CNT = ".$reorder_cnt.",";
        }

        $limit_member_update_flg		= $_POST['limit_member_update_flg'];
        $limit_member				   = $_POST['limit_member'];
        $limit_member_str = '';
        if ($limit_member_update_flg == 'true') {
            if(!isset($limit_member) || !is_array($limit_member)){
                $limit_member = 'NULL';
            }
            else{
                $limit_member = "'".implode(",", $limit_member)."'";
            }
            $limit_member_str		   = " PR.LIMIT_MEMBER = ".$limit_member.",";
        }

        $limit_purchase_qty_flg		 = $_POST['limit_purchase_qty_flg'];
        $limit_purchase_qty_flg_str = '';
        if($limit_purchase_qty_flg != null){
            $limit_purchase_qty_flg_str = " PR.LIMIT_PURCHASE_QTY_FLG = ".$limit_purchase_qty_flg.", ";
        }

        $limit_product_qty_update_flg  = $_POST['limit_product_qty_update_flg'];
        $limit_product_qty			 = $_POST['limit_product_qty'];
        $limit_product_qty_str = '';
        if ($limit_product_qty_update_flg == 'true') {
            if($limit_product_qty == '' || $limit_product_qty == null){
                $limit_product_qty = '0';
            }
            $limit_product_qty_str	 = " PR.LIMIT_PRODUCT_QTY = ".$limit_product_qty.",";
        }

        $product_keyword_update_flg	 = $_POST['product_keyword_update_flg'];
        $product_keyword				= $_POST['product_keyword'];
        $product_keyword_str = '';
        if ($product_keyword_update_flg == 'true') {
            $product_keyword_str		= " PR.PRODUCT_KEYWORD = '".$product_keyword."',";
        }

        $product_tag_update_flg		 = $_POST['product_tag_update_flg'];
        $product_tag					= $_POST['product_tag'];
        $product_tag_str = '';
        if ($product_tag_update_flg == 'true') {
            if(!isset($product_tag) || !is_array($product_tag)){
                $product_tag = 'NULL';
            }
            else{
                $product_tag = "'".implode(",", $product_tag)."'";
            }
            $product_tag_str		   = " PR.PRODUCT_TAG = ".$product_tag.",";
        }

        $custom_clearance_update_flg	= $_POST['custom_clearance_update_flg'];
        $custom_clearance			   = NULL;
        $custom_clearance			   = $_POST['custom_clearance'];
        $clearance_idx_str = '';
        if ($custom_clearance_update_flg == 'true') {
            if($custom_clearance != NULL){
                $clearance_idx_str	  = " PR.CLEARANCE_IDX = (SELECT IDX FROM CUSTOM_CLEARANCE WHERE HS_CODE = '".$custom_clearance."'),";
            }
            
        }

        $relevant_update_flg	 = $_POST['relevant_update_flg'];
        $relevant_idx_list	   = NULL;
        $relevant_idx_list	   = $_POST['relevant_idx'];
        $relevant_idx_str = '';
        if ($relevant_update_flg == 'true') {
            if($relevant_idx_list != NULL){
                $relevant_idx_str		= " PR.RELEVANT_IDX = '".implode(',',$relevant_idx_list)."',";
            }
        }

        $sold_out_qty_update_flg	= $_POST['sold_out_qty_update_flg'];
        $sold_out_qty			   = NULL;
        $sold_out_qty			   = $_POST['sold_out_qty'];
        $sold_out_qty_str = '';
        if ($sold_out_qty_update_flg == 'true') {
            if($sold_out_qty != '' && $sold_out_qty != NULL){
                $sold_out_qty_str	   = " PR.SOLD_OUT_QTY = ".$sold_out_qty.",";
            }
            
        }

        $detail_kr				  = $_POST['detail_kr'];
        $detail_kr_update_flg	   = $_POST['detail_kr_update_flg'];
        $detail_kr_str = '';
        if($detail_kr_update_flg == 'true'){
            $detail_kr = str_replace("<p>&nbsp;</p>","",$detail_kr);
            if ($detail_kr != null) {
                $detail_kr_str		  = " PR.DETAIL_KR = '".$detail_kr."',";
            }
            else{
                $detail_kr_str		  = " PR.DETAIL_KR = NULL,";
            }
        }

        $detail_en				  = $_POST['detail_en'];
        $detail_en_update_flg	   = $_POST['detail_en_update_flg'];
        $detail_en_str = '';
        if($detail_en_update_flg == 'true'){
            $detail_en = str_replace("<p>&nbsp;</p>","",$detail_en);
            if ($detail_en != null) {
                $detail_en_str	  = " PR.DETAIL_EN = '".$detail_en."',";
            }
            else{
                $detail_en_str	  = " PR.DETAIL_EN = NULL,";
            }
        }
        $detail_cn				  = $_POST['detail_cn'];
        $detail_cn_update_flg	   = $_POST['detail_cn_update_flg'];
        $detail_cn_str = '';
        if($detail_cn_update_flg == 'true'){
            $detail_cn = str_replace("<p>&nbsp;</p>","",$detail_cn);
            if ($detail_cn != null) {
                $detail_cn_str	  = " PR.DETAIL_CN = '".$detail_cn."',";
            }
            else{
                $detail_cn_str	  = " PR.DETAIL_CN = NULL,";
            }
        }

        $care_kr					= $_POST['care_kr'];
        $care_kr_update_flg		 = $_POST['care_kr_update_flg'];
        $care_kr_str = '';
        $care_dsn_kr_str = '';
        $care_td_kr_str = '';
        if($care_kr_update_flg == 'true'){
            $care_kr = str_replace("<p>&nbsp;</p>","",$care_kr);
            if ($care_kr != null) {
                $care_kr_str		= " PR.CARE_KR = '".$care_kr."',";
                $care_dsn_kr_str	= " PR.CARE_DSN_KR = '".$care_kr."',";
                $care_td_kr_str	 = " PR.CARE_TD_KR = '".$care_kr."',";
            }
            else{
                $care_kr_str		= " PR.CARE_KR = NULL,";
                $care_dsn_kr_str	= " PR.CARE_DSN_KR = NULL,";
                $care_td_kr_str	 = " PR.CARE_TD_KR = NULL,";
            }
        }
        $care_en					= $_POST['care_en'];
        $care_en_update_flg		 = $_POST['care_en_update_flg'];
        $care_en_str = '';
        $care_dsn_en_str = '';
        $care_td_en_str = '';
        if($care_en_update_flg == 'true'){
            $care_en = str_replace("<p>&nbsp;</p>","",$care_en);
            if ($care_en != null) {
                $care_en_str		= " PR.CARE_EN = '".$care_en."',";
                $care_dsn_en_str	= " PR.CARE_DSN_EN = '".$care_en."',";
                $care_td_en_str	 = " PR.CARE_TD_EN = '".$care_en."',";
            }
            else{
                $care_en_str		= " PR.CARE_EN = NULL,";
                $care_dsn_en_str	= " PR.CARE_DSN_EN = NULL,";
                $care_td_en_str	 = " PR.CARE_TD_EN = NULL,";
            }
        }
        $care_cn					= $_POST['care_cn'];
        $care_cn_update_flg		 = $_POST['care_cn_update_flg'];
        $care_cn_str = '';
        $care_dsn_cn_str = '';
        $care_td_cn_str = '';
        if($care_cn_update_flg == 'true'){
            $care_cn = str_replace("<p>&nbsp;</p>","",$care_cn);
            if ($care_cn != null) {
                $care_cn_str		= " PR.CARE_CN = '".$care_cn."',";
                $care_dsn_cn_str	= " PR.CARE_DSN_CN = '".$care_cn."',";
                $care_td_cn_str	 = " PR.CARE_TD_CN = '".$care_cn."',";
            }
            else{
                $care_cn_str		= " PR.CARE_CN = NULL,";
                $care_dsn_cn_str	= " PR.CARE_DSN_CN = NULL,";
                $care_td_cn_str	 = " PR.CARE_TD_CN = NULL,";
            }
        }

        $material_kr				= $_POST['material_kr'];
        $material_kr_update_flg	 = $_POST['material_kr_update_flg'];
        $material_kr_str = '';
        if($material_kr_update_flg == 'true'){
            $material_kr = str_replace("<p>&nbsp;</p>","",$material_kr);
            if ($material_kr != null) {
                $material_kr_str	= " PR.MATERIAL_KR = '".$material_kr."',";
            }
            else{
                $material_kr_str	= " PR.MATERIAL_KR = NULL,";
            }
        }
        $material_en				= $_POST['material_en'];
        $material_en_update_flg	 = $_POST['material_en_update_flg'];
        $material_en_str = '';
        if($material_en_update_flg == 'true'){
            $material_en = str_replace("<p>&nbsp;</p>","",$material_en);
            if ($material_en != null) {
                $material_en_str	= " PR.MATERIAL_EN = '".$material_en."',";
            }
            else{
                $material_en_str	= " PR.MATERIAL_EN = NULL,";
            }
        }
        $material_cn				= $_POST['material_cn'];
        $material_cn_update_flg	 = $_POST['material_cn_update_flg'];
        $material_cn_str = '';
        if($material_cn_update_flg == 'true'){
            $material_cn = str_replace("<p>&nbsp;</p>","",$material_cn);
            if ($material_cn != null) {
                $material_cn_str	= " PR.MATERIAL_CN = '".$material_cn."',";
            }
            else{
                $material_cn_str	= " PR.MATERIAL_CN = NULL,";
            }
        }
        $refund_msg_flg			 	= $_POST['refund_msg_flg'];
        $refund_msg_flg_str = "";
        if($refund_msg_flg != null){
            $refund_msg_flg_str	 	= " PR.REFUND_MSG_FLG = ".$refund_msg_flg.", ";
        }

        $refund_msg_kr_update_flg	 = $_POST['refund_msg_kr_update_flg'];
        $refund_msg_kr				 = $_POST['refund_msg_kr'];
        $refund_msg_kr_str = '';
        if ($refund_msg_kr_update_flg == 'true') {
            $refund_msg_kr_str		 = " PR.REFUND_MSG_KR = '".$refund_msg_kr."',";
        }

        $refund_msg_en_update_flg	  = $_POST['refund_msg_en_update_flg'];
        $refund_msg_en				 = $_POST['refund_msg_en'];
        $refund_msg_en_str = '';
        if ($refund_msg_en_update_flg == 'true') {
            $refund_msg_en_str		 = " PR.REFUND_MSG_EN = '".$refund_msg_en."',";
        }

        $refund_msg_cn_update_flg	  = $_POST['refund_msg_cn_update_flg'];
        $refund_msg_cn				 = $_POST['refund_msg_cn'];
        $refund_msg_cn_str = '';
        if ($refund_msg_cn_update_flg == 'true') {
            $refund_msg_cn_str		 = " PR.REFUND_MSG_CN = '".$refund_msg_cn."',";
        }

        $refund_kr				  = $_POST['refund_kr'];
        $refund_kr_update_flg	   = $_POST['refund_kr_update_flg'];
        $refund_kr_str = '';
        if($refund_kr_update_flg == 'true'){
            $refund_kr = str_replace("<p>&nbsp;</p>","",$refund_kr);
            if ($refund_kr != null) {
                $refund_kr_str	  = " PR.REFUND_KR = '".$refund_kr."',";
            }
            else{
                $refund_kr_str	  = " PR.REFUND_KR = NULL,";
            }
        }
        $refund_en				  = $_POST['refund_en'];
        $refund_en_update_flg	   = $_POST['refund_en_update_flg'];
        $refund_en_str = '';
        if($refund_en_update_flg == 'true'){
            $refund_en = str_replace("<p>&nbsp;</p>","",$refund_en);
            if ($refund_en != null) {
                $refund_en_str	  = " PR.REFUND_EN = '".$refund_en."',";
            }
            else{
                $refund_en_str	  = " PR.REFUND_EN = NULL,";
            }
        }
        $refund_cn				   = $_POST['refund_cn'];
        $refund_cn_update_flg	   = $_POST['refund_cn_update_flg'];
        $refund_cn_str = '';
        if($refund_cn_update_flg == 'true'){
            $refund_cn = str_replace("<p>&nbsp;</p>","",$refund_cn);
            if ($refund_cn != null) {
                $refund_cn_str	  = " PR.REFUND_CN = '".$refund_cn."',";
            }
            else{
                $refund_cn_str	  = " PR.REFUND_CN = NULL,";
            }
        }

        $memo					   = $_POST['memo'];
        $memo_update_flg			= $_POST['memo_update_flg'];
        $memo_str = '';
        if($memo_update_flg == 'true'){
            $memo = str_replace("<p>&nbsp;</p>","",$memo);
            if ($memo != null) {
                $memo_str		   = " PR.MEMO = '".$memo."',";
            }
            else{
                $memo_str		   = " PR.MEMO = NULL,";
            }
        }

        $seo_exposure_flg		   	= $_POST['seo_exposure_flg'];
        $seo_exposure_flg_str 		= "";
        if($seo_exposure_flg != null){
            $seo_exposure_flg_str = " PR.SEO_EXPOSURE_FLG = ".$seo_exposure_flg.", ";
        }

        $seo_title_update_flg	   = $_POST['seo_title_update_flg'];
        $seo_title				  = $_POST['seo_title'];
        $seo_title_str = '';
        if ($seo_title_update_flg == 'true') {
            $seo_title_str		= " PR.SEO_TITLE = '".$seo_title."',";
        }
        $seo_author_update_flg	  = $_POST['seo_author_update_flg'];
        $seo_author				 = $_POST['seo_author'];
        $seo_author_str = '';
        if ($seo_author_update_flg == 'true') {
            $seo_author_str		= " PR.SEO_AUTHOR = '".$seo_author."',";
        }
        $seo_description			= $_POST['seo_description'];
        $seo_description_update_flg = $_POST['seo_description_update_flg'];
        $seo_description_str = '';
        if($seo_description_update_flg == 'true'){
            $seo_description = str_replace("<p>&nbsp;</p>","",$seo_description);
            if ($seo_description != null) {
                $seo_description_str	= " PR.SEO_DESCRIPTION = '".$seo_description."',";
            }
            else{
                $seo_description_str	= " PR.SEO_DESCRIPTION = NULL,";
            }
        }
        $seo_keywords			   = $_POST['seo_keywords'];
        $seo_keywords_update_flg	= $_POST['seo_keywords_update_flg'];
        $seo_keywords			   = $_POST['seo_keywords'];
        $seo_keywords_str = '';
        if ($seo_keywords_update_flg == 'true') {
            $seo_keywords_str	   = " PR.SEO_KEYWORDS = '".$seo_keywords."',";
        }
        $seo_alt_text			   = $_POST['seo_alt_text'];
        $seo_alt_text_update_flg	= $_POST['seo_alt_text_update_flg'];
        $seo_alt_text_str = '';
        if($seo_alt_text_update_flg == 'true'){
            $seo_alt_text = str_replace("<p>&nbsp;</p>","",$seo_alt_text);
            if ($seo_alt_text != null) {
                $seo_alt_text_str   = " PR.SEO_ALT_TEXT = '".$seo_alt_text."',";
            }
            else{
                $seo_alt_text_str   = " PR.SEO_ALT_TEXT = NULL,";
            }
        }

        $product_idx_list			= $_POST['product_idx_list'];
        $option_list				= $_POST['option_list'];

        $filter_cl					= $_POST['filter_cl'];
        $filter_cl_str = "";
        if ($filter_cl != null) {
            $filter_cl_str = " PR.FILTER_CL = '".implode(",",$filter_cl)."', ";
        }

        $filter_ft					= $_POST['filter_ft'];
        $filter_ft					= $_POST['filter_ft'];
        $filter_ft_str = "";
        if ($filter_ft != null) {
            $filter_ft_str = " PR.FILTER_FT = ".$filter_ft.", ";
        }

        $filter_gp					= $_POST['filter_gp'];
        $filter_gp_str = "";
        if ($filter_gp != null) {
            $filter_gp_str = " PR.FILTER_GP = ".$filter_gp.", ";
        }

        $filter_ln					= $_POST['filter_ln'];
        $filter_ln_str = "";
        if ($filter_ln != null) {
            $filter_ln_str = " PR.FILTER_LN = ".$filter_ln.", ";
        }

        $filter_sz					= $_POST['filter_sz'];
        $filter_sz_str = "";
        if ($filter_sz != null) {
            $filter_sz_str = " PR.FILTER_SZ = '".implode(",",$filter_sz)."', ";
        }

        $db->begin_transaction();
        try {
            $product_sql = "
                UPDATE 
                    SHOP_PRODUCT PR
                    LEFT JOIN ORDERSHEET_MST OM ON
                    PR.ORDERSHEET_IDX = OM.IDX
                SET
                    ".$style_code_str."
                    ".$color_code_str."
                    ".$product_code_str."
                    ".$shop_product_name_str."
                    ".$md_category_1_str."
                    ".$md_category_2_str."
                    ".$md_category_3_str."
                    ".$md_category_4_str."
                    ".$md_category_5_str."
                    ".$md_category_6_str."
                    ".$category_idx_str."
                    ".$sale_flg_str."
                    ".$sold_out_flg_str."
                    ".$mileage_flg_str."
                    ".$exclusive_flg_str."
                    ".$price_kr_str."
                    ".$discount_kr_str."
                    ".$sales_price_kr_str."
                    ".$price_en_str."
                    ".$discount_en_str."
                    ".$sales_price_en_str."
                    ".$price_cn_str."
                    ".$discount_cn_str."
                    ".$sales_price_cn_str."
                    ".$limit_member_str."
                    ".$limit_id_flg_str."
                    ".$reorder_cnt_str."
                    ".$limit_purchase_qty_flg_str."
                    ".$limit_product_qty_str."
                    ".$product_keyword_str."
                    ".$product_tag_str."
                    ".$clearance_idx_str."
                    ".$relevant_idx_str."
                    ".$sold_out_qty_str."
                    ".$care_kr_str."
                    ".$care_en_str."
                    ".$care_cn_str."
                    ".$detail_kr_str."
                    ".$detail_en_str."
                    ".$detail_cn_str."
                    ".$material_kr_str."
                    ".$material_en_str."
                    ".$material_cn_str."
                    ".$refund_flg_str."
                    ".$refund_msg_flg_str."
                    ".$refund_msg_kr_str."
                    ".$refund_msg_en_str."
                    ".$refund_msg_cn_str."
                    ".$refund_kr_str."
                    ".$refund_en_str."
                    ".$refund_cn_str."
                    ".$memo_str."
                    ".$seo_exposure_flg_str."
                    ".$seo_title_str."
                    ".$seo_author_str."
                    ".$seo_description_str."
                    ".$seo_keywords_str."
                    ".$seo_alt_text_str."
                    ".$filter_cl_str."
                    ".$filter_ft_str."
                    ".$filter_gp_str."
                    ".$filter_ln_str."
                    ".$filter_sz_str."
                    PR.UPDATE_DATE = NOW()
                WHERE
                    ".$where."
            ";
            $db->query($product_sql);
            $db->commit();
        }  
        catch(mysqli_sql_exception $exception){
            $db->rollback();
            print_r($exception);
            
            $json_result['code'] = 301;
            $json_result['msg'] = "등록작업에 실패했습니다.";
        }
    }
}


?>