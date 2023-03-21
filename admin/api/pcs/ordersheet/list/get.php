<?php
/*
 +=============================================================================
 | 
 | 오더시트 목록
 | -------
 |
 | 최초 작성	: 박성혁
 | 최초 작성일	: 2022.10.11
 | 최종 수정일	: 
 | 버전		: 1.0
 | 설명		: 
 | 
 +=============================================================================
*/
include_once("/var/www/admin/api/common/common.php");

$search_type 			= $_POST['search_type'];			//검색분류
$search_keyword 		= $_POST['search_keyword'];			//검색 키워드

$style_code 			= $_POST['style_code'];				//스타일 코드
$color_code 			= $_POST['color_code'];				//색깔코드
$product_code 			= $_POST['product_code'];			//상품코드
$product_name 			= $_POST['product_name'];			//상품명

$preorder_flg 			= $_POST['preorder_flg'];			//프리오더 플래그

$category_lrg	    	= $_POST['category_lrg'];           //대분류
$category_mdl	    	= $_POST['category_mdl'];           //중분류
$category_sml	    	= $_POST['category_sml'];           //소분류
$category_dtl	    	= $_POST['category_dtl'];           //세분류
$category_idx 			= $_POST['category_idx'];			//카테고리 IDX

$material           	= $_POST['material'];		        //원자재
$graphic	        	= $_POST['graphic'];		        //그래픽
$fit	            	= $_POST['fit'];		            //핏

$product_size 			= $_POST['product_size'];			//상품 사이즈
$color 		        	= $_POST['color'];			        //색상
$color_rgb 				= $_POST['color_rgb'];				//색상코드

$price_type 			= $_POST['price_type'];				//상품 가격타입
$price_min 				= $_POST['price_min'];				//검색가격 최대값
$price_max 				= $_POST['price_max'];				//검색가격 최소값

$sub_material_name		= $_POST['sub_material_name'];		//부자재명

$min_launching_date		= $_POST['min_launching_date'];		//런칭 검색일자 시작점
$max_launching_date		= $_POST['max_launching_date'];		//런칭 검색일자 종점

$regist_flg				= $_POST['regist_flg'];

$sort_type 				= $_POST['sort_type'];				//정렬 타입
$sort_value 			= $_POST['sort_value'];				//정렬 값

$rows = $_POST['rows'];
$page = $_POST['page'];

$tables = "
	ORDERSHEET_MST OM
";

//검색 유형 - 디폴트
$where = '1=1';
$where .= ' AND OM.DEL_FLG = FALSE
			AND OM.SET_FLG = FALSE';

if($regist_flg != null && $regist_flg == 'true'){
	$where .= ' AND OM.UPDATE_FLG = TRUE ';
	//AND (SELECT COUNT(0) FROM WHOLESALE_INFO WHERE ORDERSHEET_IDX = OM.IDX) > 0
	$where .= ' AND (SELECT COUNT(0) FROM SHOP_PRODUCT WHERE ORDERSHEET_IDX = OM.IDX) = 0';
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
					case "product_name" :
						$keyword_where .= ' (OM.PRODUCT_NAME LIKE "%'.$search_keyword[$i].'%") ';
						break;
					
					case "product_code" :
						$keyword_where .= ' (OM.PRODUCT_CODE LIKE "%'.$search_keyword[$i].'%") ';
						break;
				}
				
				$tmp_where .= $keyword_where;
			}
		}
		
		$where .= $tmp_where;
		
		$where .= " ) ";
	}
}

//검색 유형 - 스타일/색상/상품코드, 상품명
if($style_code != null){
	$where .= ' AND (OM.STYLE_CODE LIKE "%'.$style_code.'%") ';
}
if($color_code != null){
	$where .= ' AND (OM.COLOR_CODE LIKE "%'.$color_code.'%") ';
}
if($product_code != null){
	$where .= ' AND (OM.PRODUCT_CODE LIKE "%'.$product_code.'%") ';
}
if($product_name != null){
	$where .= ' AND (OM.PRODUCT_NAME LIKE "%'.$product_name.'%") ';
}

//검색 유형 - 프리오더
if ($preorder_flg != null && $preorder_flg != "all") {
	$where .= " AND OM.PREORDER_FLG = ".$preorder_flg." ";
}

//검색유형 상품 대/중/소/세분류
if($category_lrg != null){
	$where .= ' AND (OM.CATEGORY_LRG LIKE "%'.$category_lrg.'%") ';
}
if($category_mdl != null){
	$where .= ' AND (OM.CATEGORY_MDL LIKE "%'.$category_mdl.'%") ';
}
if($category_sml != null){
	$where .= ' AND (OM.CATEGORY_SML LIKE "%'.$category_sml.'%") ';
}
if($category_dtl != null){
	$where .= ' AND (OM.CATEGORY_DTL LIKE "%'.$category_dtl.'%") ';
}

if($category_idx != null && $category_idx != '0'){
	$where .= ' AND (OM.CATEGORY_IDX = '.$category_idx.') ';
}

//검색 유형 - 원자재
if($material != null){
	$where .= ' AND (OM.MATERIAL LIKE "%'.$material.'%") ';
}

//검색 유형 - 그래픽
if($graphic != null){
	$where .= ' AND (OM.GRAPHIC LIKE "%'.$graphic.'%") ';
}

//검색 유형 - 재고 등급
if($fit != null){
	$where .= ' AND (OM.FIT LIKE "%'.$fit.'%") ';
}

//검색 유형 - 상품 사이즈
if($product_size != null){
	$where .= ' AND (OM.PRODUCT_SIZE LIKE "%'.$product_size.'%") ';
}

//검색 유형 - 색상명
if($color != null){
	$where .= ' AND (OM.COLOR LIKE "%'.$color.'%") ';
}

//검색 유형 - 색상코드
if($color_rgb != null){
	$where .= ' AND (OM.COLOR_RGB LIKE "%'.$color_rgb.'%") ';
}

//검색 유형 - 부자재
if($sub_material_name != null){
	$where .= " AND OM.IDX IN (SELECT
									DISTINCT SMM.ORDERSHEET_IDX
								FROM
									SUB_MATERIAL_MAPPING 	AS SMM LEFT JOIN
									SUB_MATERIAL_INFO		AS SMI
								ON
									SMM.SUB_MATERIAL_IDX = SMI.IDX
								WHERE
									SMI.SUB_MATERIAL_NAME LIKE '%".$sub_material_name."%') ";
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
					$tmp_price .= " OM.".$price_type[$i]." >= ".$price_min[$i]." ";
				}
				
				if (!is_numeric($price_min[$i]) && is_numeric($price_max[$i])) {
					$tmp_price .= " OM.".$price_type[$i]." <= ".$price_max[$i]." ";
				}
				
				if(is_numeric($price_min[$i]) && is_numeric($price_max[$i])) {
					$tmp_price .= " OM.".$price_type[$i]." BETWEEN ".$price_min[$i]." AND ".$price_max[$i]." ";
				}
			}
			
			$tmp_where .= $tmp_price;
		}
		$where .= $tmp_where;
		
		$where .= " )";
	}
}

//검색 유형 - 런칭일
if($min_launching_date != null){
    $where .= " AND OM.LAUNCHING_DATE >= '".$min_launching_date." ";
}
if($max_launching_date != null){
    $where .= " AND OM.LAUNCHING_DATE <= '".$max_launching_date." ";
}

/** 정렬 조건 **/
$order = '';
if ($sort_value != null && $sort_type != null) {
	$order = ' OM.'.$sort_value." ".$sort_type." ";
} else {
	$order = ' OM.IDX DESC';
}

$limit_start = (intval($page)-1)*$rows;
$json_result = array(
	'total' => $db->count($tables,$where),
	'total_cnt' => $db->count($tables,$where_cnt),
	'page' => $page
);

$select = "     OM.IDX											AS ORDERSHEET_IDX,
				OM.STYLE_CODE									AS STYLE_CODE,
				OM.COLOR_CODE									AS COLOR_CODE,
				OM.PRODUCT_CODE									AS PRODUCT_CODE,
				OM.PREORDER_FLG									AS PREORDER_FLG,
				OM.CATEGORY_LRG									AS CATEGORY_LRG,
				OM.CATEGORY_MDL									AS CATEGORY_MDL,
				OM.CATEGORY_SML									AS CATEGORY_SML,
				OM.CATEGORY_DTL									AS CATEGORY_DTL,
				OM.MATERIAL										AS MATERIAL,
				OM.GRAPHIC										AS GRAPHIC,
				OM.FIT											AS FIT,
				CASE
					WHEN
						(
							SELECT
								COUNT(S_OI.IDX)
							FROM
								ORDERSHEET_IMG S_OI
							WHERE
								S_OI.ORDERSHEET_IDX = OM.IDX AND
								IMG_TYPE = 'P' AND
								IMG_SIZE = 'S'
						) > 0
						THEN
							(
								SELECT
									S_OI.IMG_LOCATION
								FROM
									ORDERSHEET_IMG S_OI
								WHERE
									S_OI.ORDERSHEET_IDX = OM.IDX AND
									S_OI.IMG_TYPE = 'P' AND
									S_OI.IMG_SIZE = 'S'
								ORDER BY
									S_OI.IDX ASC
								LIMIT
									0,1
							)
					ELSE
						'/images/default_product_img.jpg'
				END												AS ORDERSHEET_IMG,
				OM.PRODUCT_NAME									AS PRODUCT_NAME,
				OM.PRODUCT_SIZE									AS PRODUCT_SIZE,
				OM.COLOR										AS COLOR,
				OM.COLOR_RGB									AS COLOR_RGB,
				OM.LIMIT_MEMBER									AS LIMIT_MEMBER,
				OM.LIMIT_QTY									AS LIMIT_QTY,
				OM.PRICE_KR										AS PRICE_KR,
				OM.PRICE_EN										AS PRICE_EN,
				OM.PRICE_CN										AS PRICE_CN,
				OM.PRODUCT_QTY									AS PRODUCT_QTY,
				OM.LAUNCHING_DATE								AS LAUNCHING_DATE,
				OM.UPDATE_FLG									AS UPDATE_FLG,
				
				OM.CREATE_DATE									AS CREATE_DATE,
				OM.CREATER										AS CREATER,
				OM.UPDATE_DATE									AS UPDATE_DATE,
				OM.UPDATER										AS UPDATER ";


$sql = 	'SELECT
			'.$select.'
		FROM 
			'.$tables.'
		WHERE 
			'.$where.'
		ORDER BY 
			'.$order;

if ($rows != null && $select_idx_flg == null) {
	$sql .= " LIMIT ".$limit_start.",".$rows;
}

$db->query($sql,$where_values);
foreach($db->fetch() as $data) {
	$product_image_info = array();

	if($regist_flg != null && $regist_flg == 'true'){
		$result_arr = getProductFileCnt($db,$data['PRODUCT_CODE']);

		if($result_arr['folder_exist'] == true){
			$product_image_info['output_cnt'] = $result_arr['output_cnt']==null?0:$result_arr['output_cnt'];
			$product_image_info['product_cnt'] = $result_arr['product_cnt']==null?0:$result_arr['product_cnt'];
			$product_image_info['detail_cnt'] = $result_arr['detail_cnt']==null?0:$result_arr['detail_cnt'];
		}
	}

    $json_result['data'][] = array(
        'num'							=>$total_cnt--,
        'ordersheet_idx'				=>intval($data['ORDERSHEET_IDX']),
        'style_code'					=>$data['STYLE_CODE'],
		'color_code'					=>$data['COLOR_CODE'],
		'product_code'					=>$data['PRODUCT_CODE'],
        'preorder_flg'			        =>$data['PREORDER_FLG'],
        'category_lrg'			        =>$data['CATEGORY_LRG'],
        'category_mdl'			        =>$data['CATEGORY_MDL'],
        'category_sml'			        =>$data['CATEGORY_SML'],
        'category_dtl'			        =>$data['CATEGORY_DTL'],
        'material'			            =>$data['MATERIAL'],
        'graphic'			            =>$data['GRAPHIC'],
        'fit'			                =>$data['FIT'],
		'ordersheet_img'				=>$data['ORDERSHEET_IMG'],
		'product_name'					=>$data['PRODUCT_NAME'],
		'product_size'					=>$data['PRODUCT_SIZE'],
		'color'							=>$data['COLOR'],
		'color_rgb'						=>$data['COLOR_RGB'],
		'limit_member'					=>$data['LIMIT_MEMBER'],
		'limit_qty'						=>$data['LIMIT_QTY'],
		'price_kr'						=>$data['PRICE_KR'],
		'price_en'						=>$data['PRICE_EN'],
		'price_cn'						=>$data['PRICE_CN'],
		'product_qty'					=>$data['PRODUCT_QTY'],
		'launching_date'				=>$data['LAUNCHING_DATE'],
		'update_flg'					=>$data['UPDATE_FLG'],

		'sample_flg'					=>($db->count("SAMPLE_INFO","ORDERSHEET_IDX = ".intval($data['ORDERSHEET_IDX'])." ")) == 0 ? false : true,
		'wholesale_flg'				 	=>($db->count("WHOLESALE_INFO","ORDERSHEET_IDX = ".intval($data['ORDERSHEET_IDX'])." ")) == 0 ? false : true,
		'factory_flg'					=>($db->count("FACTORY_INFO","ORDERSHEET_IDX = ".intval($data['ORDERSHEET_IDX'])." ")) == 0 ? false : true,
		'product_image_info'			=>$product_image_info,
		'creater'						=>$data['CREATER'],
		'create_date'					=>$data['CREATE_DATE'],
		'updater'						=>$data['UPDATER'],
		'update_date'					=>$data['UPDATE_DATE']
	);
}
?>